---
author:
    - mos
category:
    - mysql
    - sql
    - kurs dbjs
revision:
    "2017-03-28": "(A, mos) Första versionen."
...
Index och prestanda i MySQL
===================================

[FIGURE src=/image/snapvt17/mysql-show-profile.png?w=c5 class="right"]

Vi skall titta på vissa tekniker som hjälper dig att optimera din databas. Vi tittar främst på optimering i databasen och vi ser hur olika index påverkar antalet rader som måste besökas för att finna ett svar och vi lär oss innebörden av frågeoptimerarens jobb och vad termen _full table scan_ innebär.


<!--more-->



Förutsättning {#pre}
-------------------------------

Du har goda kunskaper i SQL och i MySQL.

En del av underlaget till denna artikel har utgått från [delen Optimization i manualen för MySQL](https://dev.mysql.com/doc/refman/5.7/en/optimization.html).



Skapa egen tabell för tester {#testabell}
------------------------------

I ditt kursrepo (dbjs) under `example/sql/index.sql` finns grunden till de exempel som används i artikeln.

Gör så här för att skapa en egen tabell i godtycklig databas, men dubbelkolla i SQL-filen först så du ser vad den gör.

```bash
$ mysql -uuser -ppass nodedb < example/sql/index.sql
```

För att du på bästa sätt skall lära dig de delar som artikeln behandlar, så bör du köra dem själv och på egen hand. Nu har du möjlighet till det.



Prestandaoptimering av databaser {#generell}
------------------------------

Det finns många olika sätt att optimera en databas på. Det kan röra sig om tabellstrukturen, hur vi ställer SQL-frågor och hur uppdateringar görs, det rör sig om den fysiska lagringen på disk, det rör sig om hur mycket resurser databasmotorn har tillgång till i form av minne och CPU, det kan röra antalet samtidiga kopplingar till databasen eller hur databasinstallationen är utförd avseende backuper och om databasen är kopplad till replikering och/eller high availability.

Det finns många aspekter att beakta.

Låt oss undvika delen med hårdvaran och hur installationen på MySQL är utförd och konfigurerad. Istället fokuserar vi på vad som kan göras med optimering på databasnivå.

Här handlar det om grundläggande saker som om databasen har en hälsosam struktur där tabeller och kolumner matchar den typen av applikation man vill ha. De frågor man ställer mot databasen bör vara optimerade och endast hämta/använda de resurser som krävs.

Använd inte mer resurser än du behöver och krångla inte till det.

Låt oss se vilka tips vi kan föreslå, för att jobba med optimering av databasen på databas- och SQL-nivå.



Frågeoptimeraren {#qoptimiser}
------------------------------

Frågeoptimeraren, eller _query optimizer_, har till uppgift att optimera utförandet av de frågor du ställer mot databasen. Den försöker finna en optimal plan för exekvering av frågan, en _execution plan_. Skillnaden mellan en bra och dålig plan kan vara mycket stor (sekunder, timmar, dagar) så frågeoptimerarens arbete är mycket viktigt.

Man kan konfigurera vissa förutsättningarna för frågeoptimerarens arbete, men det klassar vi som klar överkurs och vi nöjer oss med att veta om att det finns en frågeoptimerare inuti databasen som analyserar alla våra SQL frågor och försöker hitta den optimala planen för att exekvera dem.

När vi skriver vår SQL-fråga så är det frågeoptimeraren som tar hand om den. Vi behöver ge frågeoptimeraren de bästa förutsättningarna möjliga, för att underlätta dess jobb.

Ingen vill vänta extra sekunder, timmar, dagar på ett resultat, iallafall inte om det inte krävs.



Använd index {#index}
------------------------------

Den enklaste regeln må vara att alla dina sökningar i databasen görs på kolumner som har ett index kopplat till sig. Låt se vad det innebär i praktiken och hur vi kan försäkra oss om att så sker.



###Full table scan {#tablescan}

Det vi vill undvika är en full table scan [^1]. Det är när frågeoptimeraren måste gå igenom samtliga rader i tabellen för att finna det vi söker efter.

Utan index så har frågeoptimeraren ingen möjlighet att finna genvägar till svaret, genvägar som gör att endast en delmängd av tabellens rader behöver besökas.

När vi tittar på en fråga så bör vi alltså minimera möjligheten att det görs en full table scan, genom att tillföra index på relevanta kolumner.

Att ha för många onödiga index är en kostnad i sig då det tar upp plats på hårddisken och det tar tid för frågeoptimeraren att välja vilket/vilka index den skall använda. Det är alltså ingen hållbar lösning att lägga till index på samtliga kolumner. Man lägger rätt index där de behövs.



###Tabellens grundstruktur {#grunden}

Det bästa sättet att optimera en SELECT-fråga är att de kolumner som _testas_ i frågan, är indexerade.

Låt säga att vi har en tabell enligt följande.

```sql
CREATE TABLE Course
(
	`code` CHAR(6),
	`nick` CHAR(8),
    `points` DECIMAL(3, 1),
	`name` VARCHAR(40)
);
```

Det finns inget index i tabellen. Vi fyller tabellen med rader och gör en `SELECT *`. Det är naturligt att det innebär en full table scan, alla rader måste hanteras för att producera ett resultat.

Så här blir resultatet, table scan eller ej.

```text
mysql> select * from Course;
+--------+----------+--------+-------------------------------------------+
| code   | nick     | points | name                                      |
+--------+----------+--------+-------------------------------------------+
| DV1531 | python   |    7.5 | Programmering och Problemlösning med Pyt  |
| PA1439 | htmlphp  |    7.5 | Webbteknologier                           |
| DV1561 | javascri |    7.5 | Programmering med JavaScript              |
| PA1436 | design   |    7.5 | Teknisk webbdesign och användbarhet       |
| DV1547 | linux    |    7.5 | Programmera webbtjänster i Linux          |
| PA1437 | oopython |    7.5 | Objektorienterad design och programmerin  |
| DV1546 | webapp   |    7.5 | Webbapplikationer för mobila enheter      |
| DV1506 | webgl    |    7.5 | Spelteknik för webben                     |
| PA1444 | dbjs     |   10.0 | Webbprogrammering och databaser           |
+--------+----------+--------+-------------------------------------------+
9 rows in set (0.00 sec)
```

Vi kan använda EXPLAIN [^2] mot tabellen, för att se hur tabellen är strukturerad.

```text
mysql> EXPLAIN Course;
+--------+--------------+------+-----+---------+-------+
| Field  | Type         | Null | Key | Default | Extra |
+--------+--------------+------+-----+---------+-------+
| code   | char(6)      | YES  |     | NULL    |       |
| nick   | char(8)      | YES  |     | NULL    |       |
| points | decimal(3,1) | YES  |     | NULL    |       |
| name   | varchar(40)  | YES  |     | NULL    |       |
+--------+--------------+------+-----+---------+-------+
4 rows in set (0.01 sec)
```

Det vi ser är alltså tabellens grundstruktur och hur kolumnerna är definierade.

Vi kan även använda EXPLAIN mot frågor som SELECT, UPDATE, INSERT eller DELETE. Det ger oss information om hur frågeoptimeraren tolkar frågan och vilken exekveringsplan vi kan förvänta oss.

```text
mysql> EXPLAIN SELECT * FROM Course;
+----+-------------+--------+------+---------------+------+---------+------+------+-------+
| id | select_type | table  | type | possible_keys | key  | key_len | ref  | rows | Extra |
+----+-------------+--------+------+---------------+------+---------+------+------+-------+
|  1 | SIMPLE      | Course | ALL  | NULL          | NULL | NULL    | NULL |    9 | NULL  |
+----+-------------+--------+------+---------------+------+---------+------+------+-------+
1 row in set (0.00 sec)
```

Ovan använder vi `EXPLAIN` för att ge oss information om hur frågeoptimeraren tolkar SELECT-frågan och ledtrådar till vilken exekveringsplan den avser använda.

Vår SELECT-fråga berör bara en tabell (`SIMPLE`), utan joins eller subqueries, och det finns inga möjliga nycklar (`possible_keys`) att använda och ingen nyckel är heller vald (`key`). Vi ser att frågan kommer att gå igenom 9 rader (`rows`) vilket också är samtliga rader, det vill säga en full table scan.



###Skapa index via primärnyckel {#primary}

Låt oss pröva en ny fråga där vi endast letar efter en rad.

```text
mysql> SELECT * FROM Course WHERE code = "PA1444";
+--------+------+--------+---------------------------------+
| code   | nick | points | name                            |
+--------+------+--------+---------------------------------+
| PA1444 | dbjs |   10.0 | Webbprogrammering och databaser |
+--------+------+--------+---------------------------------+
1 row in set (0.00 sec)

mysql> EXPLAIN SELECT * FROM Course WHERE code = "PA1444";
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
| id | select_type | table  | type | possible_keys | key  | key_len | ref  | rows | Extra       |
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
|  1 | SIMPLE      | Course | ALL  | NULL          | NULL | NULL    | NULL |    9 | Using where |
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
1 row in set (0.00 sec)
```

Det är samma läge som tidigare, en full table scan mot 9 rader. Men vi vet implicit att det endast är en rad som kan matcha. Men det vet inte frågeoptimeraren. Vi kan lösa det med ett index, så att frågeoptimeraren får bättre ledtrådar.

I detta fallet har vi ännu ingen primärnyckel och eftersom kolumnen `code` är en potentiell kandidatnyckel så får det bli den som blir primärnyckel. En primärnyckel bidrar automatiskt med ett index.

Här väljer jag att lägga till primärnyckeln på den befintliga tabellen. Sedan kör jag EXPLAIN på frågan igen, nu med primärnyckel som ger ett index.

```text
mysql> ALTER TABLE Course ADD PRIMARY KEY(code);
Query OK, 9 rows affected (0.10 sec)
Records: 9  Duplicates: 0  Warnings: 0

mysql> EXPLAIN SELECT * FROM Course WHERE code = "PA1444";
+----+-------------+--------+-------+---------------+---------+---------+-------+------+-------+
| id | select_type | table  | type  | possible_keys | key     | key_len | ref   | rows | Extra |
+----+-------------+--------+-------+---------------+---------+---------+-------+------+-------+
|  1 | SIMPLE      | Course | const | PRIMARY       | PRIMARY | 6       | const |    1 | NULL  |
+----+-------------+--------+-------+---------------+---------+---------+-------+------+-------+
1 row in set (0.00 sec)
```

Nu börjar det bli ordning. Nu behöver endast en rad gås igenom (`rows`) vi ser också av `const` i `type` att frågeoptimeraren vet att det finns som mest en matchande rad i tabellen och den läses in i början av frågan. Tabeller med `const` är mycket snabba eftersom de endast behöver läsas en gång.

Hur kan jag veta var `const` betyder i `type`? Jag läser dokumentationen för MySQL och EXPLAIN. Den är bra att ha tillhanda för att förstå vad EXPLAIN försöker berätta för mig.

När vi gör EXPLAIN på tabellen så ser vi nu att det finns en primärnyckel (`PRI`) via kolumnen `Key`.

```text
mysql> EXPLAIN Course;
+--------+--------------+------+-----+---------+-------+
| Field  | Type         | Null | Key | Default | Extra |
+--------+--------------+------+-----+---------+-------+
| code   | char(6)      | NO   | PRI |         |       |
| nick   | char(8)      | YES  |     | NULL    |       |
| points | decimal(3,1) | YES  |     | NULL    |       |
| name   | varchar(40)  | YES  |     | NULL    |       |
+--------+--------------+------+-----+---------+-------+
4 rows in set (0.00 sec)
```

Det var vårt första index och vi förändrade en table scan till att bara beröra en rad. 



###Nytt index med Unique {#unique}

Vi vill nu ställa en ny fråga på kursens smeknamn och finna en matchande rad.

```text
mysql> EXPLAIN SELECT * FROM Course WHERE nick = "dbjs";
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
| id | select_type | table  | type | possible_keys | key  | key_len | ref  | rows | Extra       |
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
|  1 | SIMPLE      | Course | ALL  | NULL          | NULL | NULL    | NULL |    9 | Using where |
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
1 row in set (0.00 sec)
```

Här får vi inget stöd av primärnyckeln, eftersom vi söker baserat på en annan kolumn. Vi är tillbaka i en full table scan.

Det löser vi med att sätta kolumnen som UNIQUE vilket innebär att varje värde i kolumnen är unikt, på samma sätt som primärnyckeln. UNIQUE ger oss ett index på kolumnen.

```text
mysql> ALTER TABLE Course ADD CONSTRAINT nick_unique UNIQUE (nick);
Query OK, 0 rows affected (0.04 sec)
Records: 0  Duplicates: 0  Warnings: 0

mysql> EXPLAIN SELECT * FROM Course WHERE nick = "dbjs";
+----+-------------+--------+-------+---------------+-------------+---------+-------+------+-------+
| id | select_type | table  | type  | possible_keys | key         | key_len | ref   | rows | Extra |
+----+-------------+--------+-------+---------------+-------------+---------+-------+------+-------+
|  1 | SIMPLE      | Course | const | nick_unique   | nick_unique | 9       | const |    1 | NULL  |
+----+-------------+--------+-------+---------------+-------------+---------+-------+------+-------+
1 row in set (0.00 sec)

mysql> EXPLAIN Course;
+--------+--------------+------+-----+---------+-------+
| Field  | Type         | Null | Key | Default | Extra |
+--------+--------------+------+-----+---------+-------+
| code   | char(6)      | NO   | PRI |         |       |
| nick   | char(8)      | YES  | UNI | NULL    |       |
| points | decimal(3,1) | YES  |     | NULL    |       |
| name   | varchar(40)  | YES  |     | NULL    |       |
+--------+--------------+------+-----+---------+-------+
4 rows in set (0.00 sec)
```

Bra, då är vi tillbaka i ett läge där frågan kommer hitta svaret direkt, en rad behövs gås igenom och tittar vi på tabellens struktur så ser vi att det nu är en UNIQUE nyckel (`UNI`) på nick-kolumnen.

För varje fråga vi ställer så kan vi alltså analysera hur många rader den kommer behöva titta på. En rad är bra, en full table scan är mindre bra.

Nåväl, man måste alltid sätta saker i perspektiv, om vi bara har 9 rader och en tabell, då spelar prestanda och optimering inte så stor roll. Det behövs större och komplexare databaser och mer krävande användning för att vi skall se skillnaden. Men det behovet kan komma tidigare än du tror. Det är bra att vara förberedd och göra rätt i grunden.



###Index för delsökning av sträng {#strinindex}

Då tar vi nästa fråga och nu vill vi göra delsökningar på kursens namn.

```text
mysql> SELECT * FROM Course WHERE name LIKE "Webb%";
+--------+---------+--------+---------------------------------------+
| code   | nick    | points | name                                  |
+--------+---------+--------+---------------------------------------+
| DV1546 | webapp  |    7.5 | Webbapplikationer för mobila enheter  |
| PA1439 | htmlphp |    7.5 | Webbteknologier                       |
| PA1444 | dbjs    |   10.0 | Webbprogrammering och databaser       |
+--------+---------+--------+---------------------------------------+
3 rows in set (0.00 sec)

mysql> EXPLAIN SELECT * FROM Course WHERE name LIKE "Webb%";
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
| id | select_type | table  | type | possible_keys | key  | key_len | ref  | rows | Extra       |
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
|  1 | SIMPLE      | Course | ALL  | NULL          | NULL | NULL    | NULL |    9 | Using where |
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
1 row in set (0.00 sec)
```

Det finns tre träffar på `LIKE "Webb%"` men det krävs en table scan. Låt se hur bra ett index kan lösa detta.

```text
mysql> CREATE INDEX index_name ON Course(name);
Query OK, 0 rows affected (0.04 sec)
Records: 0  Duplicates: 0  Warnings: 0

mysql> EXPLAIN SELECT * FROM Course WHERE name LIKE "Webb%";
+----+-------------+--------+-------+---------------+------------+---------+------+------+-----------------------+
| id | select_type | table  | type  | possible_keys | key        | key_len | ref  | rows | Extra                 |
+----+-------------+--------+-------+---------------+------------+---------+------+------+-----------------------+
|  1 | SIMPLE      | Course | range | index_name    | index_name | 43      | NULL |    3 | Using index condition |
+----+-------------+--------+-------+---------------+------------+---------+------+------+-----------------------+
1 row in set (0.00 sec)

mysql> EXPLAIN Course;
+--------+--------------+------+-----+---------+-------+
| Field  | Type         | Null | Key | Default | Extra |
+--------+--------------+------+-----+---------+-------+
| code   | char(6)      | NO   | PRI |         |       |
| nick   | char(8)      | YES  | UNI | NULL    |       |
| points | decimal(3,1) | YES  |     | NULL    |       |
| name   | varchar(40)  | YES  | MUL | NULL    |       |
+--------+--------------+------+-----+---------+-------+
4 rows in set (0.00 sec)
```

Jag tackar och tar emot när EXPLAIN visar att det nu är tre rader som behöver finnas, kunde inte varit bättre ju. Ett index på en varchar-kolumn som används i sökningar verkar vara en bra sak.

Vi ser också att tabellen har fått en `MUL` nyckel på kolumnen name.

Man undrar om det även löser frågor likt `LIKE "%prog%"` eller `LIKE "%Python"`? Följande tester säger dock nej.

```text
mysql> EXPLAIN SELECT * FROM Course WHERE name LIKE "%prog%";
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
| id | select_type | table  | type | possible_keys | key  | key_len | ref  | rows | Extra       |
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
|  1 | SIMPLE      | Course | ALL  | NULL          | NULL | NULL    | NULL |    9 | Using where |
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
1 row in set (0.00 sec)

mysql> EXPLAIN SELECT * FROM Course WHERE name LIKE "%Python";
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
| id | select_type | table  | type | possible_keys | key  | key_len | ref  | rows | Extra       |
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
|  1 | SIMPLE      | Course | ALL  | NULL          | NULL | NULL    | NULL |    9 | Using where |
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
1 row in set (0.00 sec)
```

Vi är tillbaka i en table scan, i båda fallen. Nåväl det finns andra typer av index om jag nu vill envisas att utföra sökningar av delsträng.



###Full text index {#fulltext}

Detta är egentligen ett sidospår från optimeringen, men det handlar trots allt om ett index.

MySQL stödjer något som heter FULLTEXT index vilket tillåter mer avancerad sökning än `LIKE` på större textdokument eller strängar.

Vi skall inte dyka in i detta men tar ändå ett litet exempel, bara för att visa hur det fungerar.

Vi skapar ett FULLTEXT index och använder sedan MATCH och AGAINST för att utföra en fulltext-sökning som returnerar en poäng för hur väl söksträngen matchade texten.

```text
mysql> CREATE FULLTEXT INDEX full_name ON Course(name);
Query OK, 0 rows affected (0.19 sec)
Records: 0  Duplicates: 0  Warnings: 0

mysql> SELECT name, MATCH(name) AGAINST ("Program* web*" IN BOOLEAN MODE) AS score FROM Course ORDER BY score DESC;
+-------------------------------------------+----------------------+
| name                                      | score                |
+-------------------------------------------+----------------------+
| Programmera webbtjänster i Linux          |   0.1550406515598297 |
| Programmering och Problemlösning med Pyt  |  0.12403252720832825 |
| Programmering med JavaScript              |  0.12403252720832825 |
| Objektorienterad design och programmerin  |  0.12403252720832825 |
| Spelteknik för webben                     | 0.031008131802082062 |
| Webbapplikationer för mobila enheter      | 0.031008131802082062 |
| Teknisk webbdesign och användbarhet       | 0.031008131802082062 |
| Webbteknologier                           | 0.031008131802082062 |
| Webbprogrammering och databaser           | 0.031008131802082062 |
+-------------------------------------------+----------------------+
9 rows in set (0.00 sec)
```

Som sagt, detta handlar inte om optimering, det handlar mer om möjligheten att bygga upp ett fulltext index som tillåter en en fritextsökning i en eller flera kolumner. Index kommer i olika former, men i grunden hjälper de databasen och frågeoptimeraren att vara effektiv i sitt jobb.



###Index för numeriska värden {#larger}

Låt oss pröva en variant av SELECT och index där jag vill ha fram alla rader som är större än ettt numeriskt värde, säg `points > 7.5` för alla kurser som är större än 7.5hp.

Förs kontrollerar vi frågan utan index.

```text
mysql> SELECT * FROM Course WHERE points > 7.5;
+--------+------+--------+---------------------------------+
| code   | nick | points | name                            |
+--------+------+--------+---------------------------------+
| PA1444 | dbjs |   10.0 | Webbprogrammering och databaser |
+--------+------+--------+---------------------------------+
1 row in set (0.00 sec)

mysql> EXPLAIN SELECT * FROM Course WHERE points > 7.5;
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
| id | select_type | table  | type | possible_keys | key  | key_len | ref  | rows | Extra       |
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
|  1 | SIMPLE      | Course | ALL  | NULL          | NULL | NULL    | NULL |    9 | Using where |
+----+-------------+--------+------+---------------+------+---------+------+------+-------------+
1 row in set (0.00 sec)
```

Det blev en table scan. Vi prövar att optimera med ett vanligt index.

```text
mysql> CREATE INDEX index_points ON Course(points);
Query OK, 0 rows affected (0.04 sec)
Records: 0  Duplicates: 0  Warnings: 0

mysql> EXPLAIN SELECT * FROM Course WHERE points > 7.5;
+----+-------------+--------+-------+---------------+--------------+---------+------+------+-----------------------+
| id | select_type | table  | type  | possible_keys | key          | key_len | ref  | rows | Extra                 |
+----+-------------+--------+-------+---------------+--------------+---------+------+------+-----------------------+
|  1 | SIMPLE      | Course | range | index_points  | index_points | 3       | NULL |    1 | Using index condition |
+----+-------------+--------+-------+---------------+--------------+---------+------+------+-----------------------+
1 row in set (0.00 sec)
```

Här ser vi att det gick bra igen, indexet av typen `range` lyckas minimera antalet rader till 1 rad. Det är bra gjort.

Vi ser att index verkligen hjälper frågeoptimeraren att ta bra beslut.



Visa och ta bort index {#drop}
------------------------------

Du kan visa alla index som finns på en tabell med `SHOW INDEX`. Då kan du även se vilket namn ett index har.

```text
mysql> SHOW INDEX FROM Course;
+--------+------------+--------------+--------------+-------------+-----------+-------------+----------+--------+------+------------+---------+---------------+
| Table  | Non_unique | Key_name     | Seq_in_index | Column_name | Collation | Cardinality | Sub_part | Packed | Null | Index_type | Comment | Index_comment |
+--------+------------+--------------+--------------+-------------+-----------+-------------+----------+--------+------+------------+---------+---------------+
| Course |          0 | PRIMARY      |            1 | code        | A         |           9 |     NULL | NULL   |      | BTREE      |         |               |
| Course |          0 | nick_unique  |            1 | nick        | A         |           9 |     NULL | NULL   | YES  | BTREE      |         |               |
| Course |          1 | index_name   |            1 | name        | A         |           9 |     NULL | NULL   | YES  | BTREE      |         |               |
| Course |          1 | index_points |            1 | points      | A         |           4 |     NULL | NULL   | YES  | BTREE      |         |               |
| Course |          1 | full_name    |            1 | name        | NULL      |           9 |     NULL | NULL   | YES  | FULLTEXT   |         |               |
+--------+------------+--------------+--------------+-------------+-----------+-------------+----------+--------+------+------------+---------+---------------+
5 rows in set (0.00 sec)
```

Vill du ta bort ett index så går det bra att droppa det via dess namn.

```text
mysql> DROP INDEX fulltext_name ON Course;
```

När man väl går in och tittar mer noggrant på tabellernas struktur så vill man gärna se mer och mer detaljer för att förstå vad som händer.



Visa CREATE TABLE {#createtable}
------------------------------

Vi har nu lagt till ett antal nycklar och index till tabellen och det hade varit trevligt att se SQL-koden för att göra `CREATE TABLE Course`.

Vi löser detta med kommandot `SHOW CREATE TABLE Course;`.

Resultatet vi får fram säger följande.

```sql
CREATE TABLE `Course` (
    `code` char(6) NOT NULL DEFAULT '',
    `nick` char(8) DEFAULT NULL,
    `points` decimal(3,1) DEFAULT NULL,
    `name` varchar(40) DEFAULT NULL,
    PRIMARY KEY (`code`),
    UNIQUE KEY `nick_unique` (`nick`),
    KEY `index_name` (`name`),
    KEY `index_points` (`points`),
    FULLTEXT KEY `full_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 
```

Där har vi resultatet av hela övningen, en tabell med primärnyckel, en unique kolumn, ett par index varav ett är fulltext.

Det är alltså på detta viset som vi bör skapa våra tabeller.

Dock, innan man väljer index så bör man tänka igenom vilka frågor som kommer att ske mot databasen, det underlättar att se vilka kolumner som behöver indexeras.



Storage Engine MEMORY {#memory}
------------------------------

Valet av storage engine, där de vanligaste är InnoDB och MyISAM, kan påverka prestandan. De olika lagringsmotorerna har olika karaktäristik som gör att de passar bättre och sämre under olika förhållanden. Man bör således bekanta sig med deras för- och nackdelar och välja noga.

Ibland kan man dra nytta av att lagra tabeller i minnet, till det finns lagringsmotorn MEMORY. Har man möjligheten att samla en viss datamängd som man avser ställa många frågor mot, så kan det vara gynnsamt att först samla datamängden i en MEMORY-tabell och därefter ställa frågorna mot den.

Val av storage engine kan alltså vara en viktig faktor.



Logga långsamma frågor {#logga}
------------------------------

När man väl kör en databas i drift så kan man be den att logga långsamma och potentiellt problematiska frågor till. Det är ett sätt att jobba med det man har och finslipa efterhand som man blir uppmärksam på problemen.

En databas är ett levande ting och beteer sig olika över tiden, så det är bra att ha koll på denna möjligheten.

Man kan också sätta på loggning i en session man jobbar med, man kan utföra ett antal frågor och sedan visa hur lång tid de tog och hur mycker resurser de använde. Detta styr man med `SHOW PROFILE` [^3].

Här är ett exempel i ett flöde där jag sätter på profileringen, ställer ett par frågor och visar status för de frågor som gjorts.

```text
mysql> SET profiling = 1;
Query OK, 0 rows affected, 1 warning (0.00 sec)

mysql> SELECT * FROM Course WHERE nick = "dbjs";
+--------+------+--------+---------------------------------+
| code   | nick | points | name                            |
+--------+------+--------+---------------------------------+
| PA1444 | dbjs |   10.0 | Webbprogrammering och databaser |
+--------+------+--------+---------------------------------+
1 row in set (0.00 sec)

mysql> SELECT * FROM Course WHERE name LIKE "Webb%";
+--------+---------+--------+---------------------------------------+
| code   | nick    | points | name                                  |
+--------+---------+--------+---------------------------------------+
| DV1546 | webapp  |    7.5 | Webbapplikationer för mobila enheter  |
| PA1444 | dbjs    |   10.0 | Webbprogrammering och databaser       |
| PA1439 | htmlphp |    7.5 | Webbteknologier                       |
+--------+---------+--------+---------------------------------------+
3 rows in set (0.00 sec)

mysql> SELECT name, MATCH(name) AGAINST ("Program* web*" IN BOOLEAN MODE) AS score FROM Course ORDER BY score DESC;
+-------------------------------------------+----------------------+
| name                                      | score                |
+-------------------------------------------+----------------------+
| Programmera webbtjänster i Linux          |   0.1550406515598297 |
| Programmering och Problemlösning med Pyt  |  0.12403252720832825 |
| Programmering med JavaScript              |  0.12403252720832825 |
| Objektorienterad design och programmerin  |  0.12403252720832825 |
| Spelteknik för webben                     | 0.031008131802082062 |
| Webbapplikationer för mobila enheter      | 0.031008131802082062 |
| Teknisk webbdesign och användbarhet       | 0.031008131802082062 |
| Webbteknologier                           | 0.031008131802082062 |
| Webbprogrammering och databaser           | 0.031008131802082062 |
+-------------------------------------------+----------------------+
9 rows in set (0.00 sec)

mysql> SHOW PROFILES;
+----------+------------+-------------------------------------------------------------------------------------------------------------+
| Query_ID | Duration   | Query                                                                                                       |
+----------+------------+-------------------------------------------------------------------------------------------------------------+
|        1 | 0.00014100 | SELECT * FROM Course WHERE nick = "dbjs"                                                                    |
|        2 | 0.00016350 | SELECT * FROM Course WHERE name LIKE "Webb%"                                                                |
|        3 | 0.00028875 | SELECT name, MATCH(name) AGAINST ("Program* web*" IN BOOLEAN MODE) AS score FROM Course ORDER BY score DESC |
+----------+------------+-------------------------------------------------------------------------------------------------------------+
5 rows in set, 1 warning (0.00 sec)

mysql> SHOW PROFILE FOR QUERY 3;
+-------------------------+----------+
| Status                  | Duration |
+-------------------------+----------+
| starting                | 0.000042 |
| checking permissions    | 0.000004 |
| Opening tables          | 0.000010 |
| init                    | 0.000013 |
| System lock             | 0.000004 |
| optimizing              | 0.000004 |
| statistics              | 0.000008 |
| preparing               | 0.000004 |
| FULLTEXT initialization | 0.000120 |
| Sorting result          | 0.000003 |
| executing               | 0.000001 |
| Sending data            | 0.000004 |
| Creating sort index     | 0.000052 |
| end                     | 0.000003 |
| query end               | 0.000003 |
| closing tables          | 0.000004 |
| freeing items           | 0.000007 |
| cleaning up             | 0.000005 |
+-------------------------+----------+
18 rows in set, 1 warning (0.00 sec)
```

I utskriften från `SHOW PROFILES` kan man utläsa vilken fråga som tar mest tid, och analyserar man en sådan fråga vidare med `SHOW PROFILE` så kan man vidare analysera vilka delar i frågan som är mest krävande.

Med SHOW PROFILE kan man också se vilka delar av frågan som kräver mest resurser i form av CPU eller minne.

Det kan vara intressant att finna problemfyllda frågor vis SHOW PROFILES, för att sedan vidare undersöka dem med EXPLAIN.



Avslutningsvis {#avslutning}
------------------------------

Du har nu fått en allmän genomgång av aspekter som kan påverka prestandan av din databas och fokus har varit på index. Vill du läsa mer så är manualen för MySQL och den delen som handlar om Optimization, en god punkt att fortsätta.

Artikeln har en [egen forumtråd](t/6375) där du kan ställa frågor eller bidra med tips och trix.



[^1]: [Wikipedia om Full table scan](https://en.wikipedia.org/wiki/Full_table_scan).

[^2]: [MySQL documentation för EXPLAIN](https://dev.mysql.com/doc/refman/5.7/en/explain.html).

[^3]: [MySQL documentation för SHOW PROFILE](https://dev.mysql.com/doc/refman/5.7/en/show-profile.html).
