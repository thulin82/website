---
author: mos
category:
    - databas
    - kurs dbjs
revision:
    "2017-03-06": (A, mos) Första utgåvan inför kursen dbjs.
...
Egendefinierade funktioner i databas
==================================

[FIGURE src=/image/snapvt17/udf.png?w=c5&a=10,30,60,0 class="right"]

Låt oss kika på vad en egen-definierad funktion är, i en databas. Konceptet kallas även UDF som *User Defined Function* och det kan erbjuda en möjlighet att skriva snyggare och mer kraftfull SQL-kod.

Dagens ämne är alltså egen-definerade funktioner i databasen.

<!--more-->



Förutsättning {#pre}
--------------------------------------

Artikeln bygger på kunskap som du fått i artikeln "[Triggers i databas](kunskap/lagrade-procedurer-i-databas)" och de artiklar som föregick den.

Artikeln visar grunderna i [egendefinierade funktioner](https://dev.mysql.com/doc/refman/5.7/en/create-procedure.html) som kan skrivas med [compund statements](https://dev.mysql.com/doc/refman/5.7/en/sql-syntax-compound-statements.html).

SQLite har inte stöd för egendefinierade funktioner som kan skrivas likt MySQL. Däremot erbjuder [SQLite ett API](http://www.sqlite.org/c3ref/create_function.html) där du kan skriva egna C-funktioner som kan användas i dina SQL uttryck. Det ger dig liknande möjligheter.

[SQL-koden som visas i exemplet](https://github.com/dbwebb-se/dbjs/blob/master/example/sql/function.sql) finner du på GitHub.



Exempel {#ex}
--------------------------------------

Låt mig visa dig ett exempel där läraren Sture tänker gradera betyg på en tentamen som hans studenter har gjort. Han har sparat undan all information i en tabell och nu är det enbart betygsättningen kvar.


```sql
--
-- Example
--
DROP TABLE IF EXISTS Exam;
CREATE TABLE Exam
(
	`acronym` CHAR(4) PRIMARY KEY,
    `score` INTEGER
);

INSERT INTO Exam
VALUES
	("adam", 77),
    ("ubbe", 52),
    ("june", 49),
    ("john", 63),
    ("meta", 97),
    ("siva", 88);

SELECT * FROM Exam;
```

Se där. Då behöver vi en betygskala, denna blir bra.

| A-F | Poäng | Definition |
|:---:|:-----:|------------|
| A   | 90+   | UTMÄRKT – enastående resultat. |
| B   | 80+   | MYCKET BRA – klart över medelstandard. |
| C   | 70+   | BÄTTRE ÄN BRA – allmänt bra arbete. |
| D   | 60+   | BRA – en fullgod prestation. |
| E   | 55+   | GODKÄNT – resultatet uppfyller minimikriterierna. |
| FX  | 54-   | KOMPLETTERA – mer arbete krävs innan betyg kan sättas. |
| F   | 50-   | OTILLRÄCKLIGT – (avsevärt) mer arbete krävs. |

Japp, då var det bara att koppla ihop tabellen med poängen.

Till vår hjälp, egendefinierade funktioner.



CREATE FUNCTION {#create}
--------------------------------------

Låt oss börja med en enkel function, en som bara returnerar inkommande parameter. Det är bara för att ha ett skal att komma igång med.

Här är skalet till en sådan funktion.

```sql
--
-- Function for grading an exam.
--
DELIMITER //

DROP FUNCTION IF EXISTS Grade //
CREATE FUNCTION Grade(
	score INTEGER
)
RETURNS INTEGER
BEGIN
	RETURN score;
END
//

DELIMITER ;
```

Som du ser så använder jag nu delimiter till att avgränsa koden så att semikolon fungerar som avslutare, inne i funktionens body.

Funktionen fungerar och den kan användas så här.

```sql
SELECT 
    *,
    Grade(score) AS `Grade`
FROM Exam;
```

Kör man mot tabellen så blir utskriften så här.

```sql
mysql> SELECT
    ->     *,
    ->     Grade(score) AS `Grade`
    -> FROM Exam;
+---------+-------+-------+
| acronym | score | Grade |
+---------+-------+-------+
| adam    |    77 |    77 |
| john    |    63 |    63 |
| june    |    49 |    49 |
| meta    |    97 |    97 |
| siva    |    88 |    88 |
| ubbe    |    52 |    52 |
+---------+-------+-------+
6 rows in set (0.00 sec)
```

Låt oss göra en mer intelligent funktion.



Funktion för betygsättning {#grade}
--------------------------------------

I en funktion kan vi skriva compund statements. Det låter som vi kan lösa uppgiften med en IF, ELSEIF och END IF-sats som är en variant av de [varianter för kontrollflöden](https://dev.mysql.com/doc/refman/5.7/en/flow-control-statements.html) som erbjuds.

Glöm inte att ändra return-typen till `CHAR(1)`.

```sql
--
-- Function for grading an exam.
--
DELIMITER //

DROP FUNCTION IF EXISTS Grade //
CREATE FUNCTION Grade(
	score INTEGER
)
RETURNS CHAR(1)
BEGIN
	IF score >= 90 THEN
		RETURN "A";
	ELSEIF score >= 80 THEN
		RETURN "B";
	ELSEIF score >= 70 THEN
		RETURN "C";
	ELSEIF score >= 60 THEN
		RETURN "D";
	ELSEIF score >= 55 THEN
		RETURN "E";
	ELSEIF score >= 50 THEN
		RETURN "FX";
	END IF;
    RETURN "F";
END
//

DELIMITER ;
```

Nu är det bara att köra SELECT för att plocka fram betygslistan.

```sql
SELECT 
	*,
    Grade(score) AS `Grade`
FROM Exam
ORDER BY Grade;
```

Så här kan det se ut.

```sql
mysql> SELECT
    ->     *,
    ->     Grade(score) AS `Grade`
    -> FROM Exam
    -> ORDER BY Grade;
+---------+-------+-------+
| acronym | score | Grade |
+---------+-------+-------+
| meta    |    97 | A     |
| siva    |    88 | B     |
| adam    |    77 | C     |
| john    |    63 | D     |
| june    |    49 | F     |
| ubbe    |    52 | F     |
+---------+-------+-------+
6 rows in set, 1 warning (0.00 sec)
```

Strålande. Det fungerar.

Vi har alltså gjort en funktion som vi kan använda tillsammans med en SELECT-sats. Det här kan vara ett bra verktyg.



Skapa ytterligare en funktion {#func2}
--------------------------------------

Läraren Sture har fått problem, tydligen var det en annan betygsskala som några av studenterna skulle använda. En skala som gick mellan 3-5 och U.

Så här ser det ut numer.

| A-F | U,3-5 | Poäng | Definition |
|:---:|:-----:|:-----:|------------|
| A   | 5     | 90+   | UTMÄRKT – enastående resultat. |
| B   | 4     | 80+   | MYCKET BRA – klart över medelstandard. |
| C   | 4     | 70+   | BÄTTRE ÄN BRA – allmänt bra arbete. |
| D   | 3     | 60+   | BRA – en fullgod prestation. |
| E   | 3     | 55+   | GODKÄNT – resultatet uppfyller minimikriterierna. |
| FX  | -     | 54-   | KOMPLETTERA – mer arbete krävs innan betyg kan sättas. |
| F   | U     | 50-   | OTILLRÄCKLIGT – (avsevärt) mer arbete krävs. |

Nåja, Sture löser det med en ny funktion som ger betyg enligt skalan U, 3-5.

```sql
--
-- Function for grading an exam U, 3-5.
--
DELIMITER //

DROP FUNCTION IF EXISTS Grade2 //
CREATE FUNCTION Grade2(
	score INTEGER
)
RETURNS CHAR(1)
BEGIN
	IF score >= 90 THEN
		RETURN "5";
	ELSEIF score >= 70 THEN
		RETURN "4";
	ELSEIF score >= 55 THEN
		RETURN "3";
	END IF;
    RETURN "F";
END
//

DELIMITER ;
```

Egentligen samma sak igen, bara andra värden som testas och returneras.

Nu kan Sture ta ut sin betygslista så kan studenterna själva välja enligt vilket betygsystem de får sitt betyg.

```sql
mysql> SELECT
    -> *,
    ->     Grade(score) AS `A-F, FX`,
    ->     Grade2(score) AS `U, 3-5`
    -> FROM Exam
    -> ORDER BY score DESC;
+---------+-------+---------+--------+
| acronym | score | A-F, FX | U, 3-5 |
+---------+-------+---------+--------+
| meta    |    97 | A       | 5      |
| siva    |    88 | B       | 4      |
| adam    |    77 | C       | 4      |
| john    |    63 | D       | 3      |
| ubbe    |    52 | F       | F      |
| june    |    49 | F       | F      |
+---------+-------+---------+--------+
6 rows in set, 1 warning (0.00 sec)
```

Vi har fått ett exempel på hur egendefinierade funktioner kan användas för att presentera informationen på olika sätt.



Funderingar {#fundering}
--------------------------------------

Finns det inte andra sätt att lösa exemplet? Jo det finns det säkert. Men det är ändå ett rimligt exempel som visar hur du kan ha nytta av funktioner. Eftersom du kan skriva compund statements i funktions-bodyn så har du stora möjligheter att utföra saker i en funktion. Det må vara enklare utskrifts/rapportstöd, eller kanske en uppslagning i andra tabeller för att hämta värden liknande en subquery.

Möjligheter är flera. Kanske kunde man löst exemplet med en JOIN mot en tabell som innehöll nivåerna för betygen.

Vi har många verktyg i lådan som används för att lösa uppgiften. Man ska bara välja rätt verktyg i rätt situation, det är lite det som är utmaningen. 



SHOW FUNCTION {#show}
--------------------------------------

När man vill se vilka funktioner som finns i databasen så kan man visa dem.

```sql
SHOW FUNCTION STATUS;
```

Svaret blir en lista med alla de funktioner som finns och till vilken databas de är kopplade.

Vill du sedan titta på koden som ligger bakom funktioner så frågar du efter den.

```sql
SHOW CREATE FUNCTION Grade;
```

Fram kommer källkoden för funktionen.



Avslutningsvis {#avslutning}
--------------------------------------

Detta var grunderna i hur funktioner fungerar, hur du skapar och använder dem.

Liksom lagrade procedurer och triggers så erbjuder även funktioner ett sätt att tänka i form av API mot en databas. Funktioner kan användas för att styra upp vilken information som användaren får vid en viss fråga.

Har du [tips, förslag eller frågor om artikeln](t/6294) så finns det en specifik forumtråd för det.
