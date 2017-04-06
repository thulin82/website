---
author:
    - mos
category:
    - php
    - databas
    - mysql
    - kurs oophp
revision:
    "2017-03-28": "(PE1, mos) Stööre genomarbetning inför oophp-v3."
    "2014-03-05": "(D, mos) Gick inte radera, lade till stycke om att radera även Movie2Genre samt återställning på windows."
    "2013-11-26": "(C, mos) Textstycke om att fånga fel i connection med try-catch, reset.sql och smärre justeringar."
    "2013-10-29": "(B, mos) Problem med inloggning löses genom att speca teckenkodningen på tabellen User."
    "2013-09-03": "(A, mos) Första utgåvan som en del av kursen [oophp](oophp)."
...
Kom igång med PHP PDO och MySQL
==================================

Guiden hjälper dig att komma i gång med PHP PDO och MySQL genom att bygga upp en webbapplikation kring en filmdatabas. Stegvis skapar du ett gränssnitt som jobbar mot databasen och ställer de vanliga frågorna för utsökning av objekt, skapa nya objekt, radera objekt och uppdatera informationen om ett objekt. När du är klar kan du applicera koden för din filmdatabas mot en annan databas, förfarandet är detsamma och guiden ger dig grunderna till en databasdriven webbplats, oavsett det är en filmdatabas eller webbshop.

<!--more-->

Det bästa sättet att gå igenom guiden är att läsa exemplen och sedan pröva dem själv. Skapa dina egna testprogram där du testar olika kod-konstruktioner. Du måste testa själv för att lära dig.

> **Du måste själv skriva koden, det finns inga genvägar.**

Lyssna på de felmeddelande du får. De kommer från PHP eller från MySQL och de har **alltid** rätt. Lär dig tyda dem och förstå dem, det är som att föra en dialog med programmeringsspråket.

> *Felmeddelandet har alltid rätt.*

När du felsöker PHP mot MySQL så kör du alltid SQL-frågorna i en egen klient och testar att de fungerar, innan du lägger in dem i PHP-koden. Två vägar att felsöka och testa koden.

Så här kan det se ut när du är klar.

[FIGURE src=/image/snapshot/Visa_filmer_med_sokalternativ_kombinerade___Min_Filmdatabas.jpg?w=w1&q=60 caption="Olika sätt att söka ut informationen ur filmdatabasen."]



Förkunskaper {#forkunskaper}
-------------------------------------------------------------------------------

Guiden förutsätter att du har kunskaper i PHP och webbutveckling. Känner du dig osäker på PHP så bör du först läsa igenom guiden ["Kom i gång med PHP på 20 steg"](kunskap/kom-i-gang-med-php-pa-20-steg).

Det är bra om du är van vid objektorienterad PHP-programmering. Behöver du grunderna så kan du jobba igenom guiden ["Kom i gång med objektorienterad PHP-programmering på 20 steg"](kunskap/kom-i-gang-med-oophp-pa-20-steg).

Du behöver vara bekant med MySQL och dess olika klienter. Guiden "[Kom igång med databasen MySQL och dess klienter](kunskap/kom-igang-med-databasen-mysql-och-dess-klienter)" hjälper dig att komma i gång med det.

Källkoden till artikelns exampel finns i kursrepot (oophp) under [`example/php-pdo-mysql`](https://github.com/dbwebb-se/oophp/tree/master/example/php-pdo-mysql).



PHP PDO som gränssnitt mot MySQL {#granssnitt}
-------------------------------------------------------------------------------

Det finns olika sätt att via PHP koppla sig mot en MySQL-databas. Om du använder äldre webbapplikationer så används ofta gränsnitten [mysql](http://php.net/manual/en/book.mysql.php) eller [mysqli](http://php.net/manual/en/book.mysqli.php). Det är bra att bekanta sig med dem, men för denna övningen har jag valt interfacet [PHP PDO](http://www.php.net/manual/en/book.pdo.php), eller PHP Data Objects som det kallas. PHP PDO är ett nyare gränssnitt, jämfört med mysql och mysqli, och fungerar mot en mängd olika databaser. Det är alltså *ett* gränsnitt som fungerar mot flera olika databaser. Det är en klar fördel att endast behöva lära sig ett gränssnitt, oavsett vilken databas man jobbar emot, det blir lättare att anpassa koden mot andra databaser, man behöver inte lära sig ett nytt gränssnitt för varje databas. Här finns tid att spara.



En övning med PHP PDO och MySQL {#plan}
-------------------------------------------------------------------------------

Så, för att komma i gång och bekanta sig med PHP PDO behövs en liten övning. Jag tänkte att vi bygger en webbplats som skall visa min filmsamling. Jag vill visa alla filmer jag har, i en lista på webbsida. För varje film vill jag visa lite information om själva filmen. Jag vill kunna söka bland filmerna och det skall vara enkelt att navigera kring filmerna för att hitta rätt i filmsamlingen. Det skall också gå att lägga till, ta bort samt redigera informationen om en film. 

Så får det bli.



En databas för filmer {#db}
-------------------------------------------------------------------------------

Först vill jag skapa databasen och det gör jag med ren SQL kod i godtycklig klient.



###Skapa databasen {#createdatabase}

Jag behöver en databas för att testa. Kanske borde jag döpa den till Movie. Men, eftersom du troligen läser denna artikel som en del i en kurs, så kan vi skapa en testdatabas som vi kan ha till diverse saker.

```sql
CREATE DATABASE IF NOT EXISTS oophp;
USE oophp;
```

För att göra saker enklare så väljer jag att dessutom skapa en användare som kan använda sig av databasen, en testanvändare med ett lösenord jag kommer ihåg.

```sql
GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";
```

Så här ser det ut när jag skapar databasen och användaren.

```text
mysql> CREATE DATABASE IF NOT EXISTS oophp;
Query OK, 1 row affected, 1 warning (0.00 sec)

mysql> GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";
Query OK, 0 rows affected (0.02 sec)
```

Nu är databasen skapad och till den kopplade jag en användare `user` som har lösenordet `pass` och användaren har fulla rättigheter mot databasen och kan koppla sig mot databasen från `localhost` (den lokala datorn).

Nu kan jag starta en klient och hoppa rätt in i databasen.

```bash
$ mysql -uuser -ppass oophp
```

Bra, då vet jag att vi alla har liknande grund för det som nu komma skall.



###Skapa och fyll tabell {#createtable}

Då tar vi och skapar en tabell till vår filmdatabas.

```sql
--
-- Create table for my own movie database
--
DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie`
(
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `director` VARCHAR(100),
  `length` INT DEFAULT NULL,            -- Length in minutes
  `year` INT NOT NULL DEFAULT 1900,
  `plot` TEXT,                          -- Short intro to the movie
  `image` VARCHAR(100) DEFAULT NULL,    -- Link to an image
  `subtext` CHAR(3) DEFAULT NULL,       -- swe, fin, en, etc
  `speech` CHAR(3) DEFAULT NULL,        -- swe, fin, en, etc
  `quality` CHAR(3) DEFAULT NULL,
  `format` CHAR(3) DEFAULT NULL         -- mp4, divx, etc
) ENGINE INNODB CHARACTER SET utf8;

DELETE FROM `movie`;
INSERT INTO `movie` (`title`, `year`, `image`) VALUES
  ('Pulp fiction', 1994, 'img/pulp-fiction.jpg'),
  ('American Pie', 1999, 'img/american-pie.jpg'),
  ('Pokémon The Movie 2000', 1999, 'img/pokemon.jpg'),  
  ('Kopps', 2003, 'img/kopps.jpg'),
  ('From Dusk Till Dawn', 1996, 'img/from-dusk-till-dawn.jpg')
;

SELECT * FROM `movie`;
```

Om du lägger koden ovan i en fil så kan du skapa tabellen så här via terminalen.

```bash
$ mysql -uuser -ppass oophp < sql/setup.sql
Warning: Using a password on the command line interface can be insecure.
id      title   director        length  year    plot    image   subtext speech  quality format
1       Pulp fiction    NULL    NULL    1994    NULL    img/pulp-fiction.jpg    NULL    NULL    NULL    NULL
2       American Pie    NULL    NULL    1999    NULL    img/american-pie.jpg    NULL    NULL    NULL    NULL
3       Pokémon The Movie 2000  NULL    NULL    1999    NULL    img/pokemon.jpg NULL    NULL    NULL    NULL
4       Kopps   NULL    NULL    2003    NULL    img/kopps.jpg   NULL    NULL    NULL    NULL
5       From Dusk Till Dawn     NULL    NULL    1996    NULL    img/from-dusk-till-dawn.jpg     NULL    NULL    NULL    NULL
```

Det går lika bra att skapa tabellen i MySQL Workbench.

Så där, nu har jag en databas.

Filerna sparar jag på disk och sökvägen till dem sparar jag i databasen. Det är mest effektivt att göra så, det är onödigt att lagra bilder i databasen. Filsystemet är mer effektivt i att hantera bilderna.

```bash
$ tree img
img
├── american-pie.jpg
├── from-dusk-till-dawn.jpg
├── kopps.jpg
├── pokemon.jpg
└── pulp-fiction.jpg

0 directories, 5 files
```

Nu skall jag koppla ett PHP-skript till databasen och börja koda.



Koppla ett PHP-skript till en MySQL-databas med PDO {#skript}
-------------------------------------------------------------------------------

Då bygger vi upp ett enkelt skript som kopplar sig mot databasen och visar dess innhehåll i en tabell. Jag tänker skriva enklast möjliga PHP-kod nu, det är databasen jag vill testa, tillsammans med PHP, en vacker dag kan jag ta och överföra principerna för denna koden till ett annat sammanhang, ett ramverk till exempel.

Det kan se ut så här när vi är klara med att koppla upp oss och visa en `SELECT * FROM movie`.

**FIGURE**



###Detaljer för koppling {#kopplaconfig}

Först måste jag skapa en koppling mot databasen. För att skapa en koppling så behöver jag detaljer för att logga in på databasservern.

Jag lägger de detaljerna i en array.

```php
/**
 * Details for connecting to the database.
 */
$databaseConfig = [
    $dsn      = "mysql:host=localhost;dbname=oophp;",
    $login    = "user",
    $password = "pass",
    $options  = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
];
```

Jag använder de detaljer som behövs för att koppla upp sig mot databasen, server *host*, databas *dbname*, användare *login* och lösenord *password*. Med hjälp av dem skapar jag ett objekt av klassen [PDO](http://www.php.net/manual/en/class.pdo.php). Kika gärna på [klassens konstruktor](http://www.php.net/manual/en/pdo.construct.php) så ser du hur argumenten kan anges. 

DSN står för *[Data Source Name](http://en.wikipedia.org/wiki/Data_source_name)* och är ett generellt sätt att ange en datakälla på.

Beroende på vilken databas du kopplar upp dig till kan argumenten se lite olika ut. Det finns dokumentation om hur [olika PDO-drivers](http://www.php.net/manual/en/pdo.drivers.php) kan hanteras. En option som jag använder är att skicka med instruktionen för att jag vill använda teckenkodningen UTF8. Det behövs för att bestämma vilken teckenkodning som skall användas på kopplingen mellan PHP och MySQL. Annars fungerar inte UTF8. Du kan läsa mer om [specialinställningar för MySQL](http://www.php.net/manual/en/ref.pdo-mysql.php) i manualen.



###Koppla upp {#kopplaupp}

Då initierar vi själva kopplingen genom att skapa ett objekt av typen PDO.

```php
try {
    $pdo = new PDO(...$databaseconfig);
} catch (Exception $e) {
    // Rethrow to hide connection details, through the original
    // exception to view all connection details.
    //throw $e;
    throw new PDOException("Could not connect to database, hiding details.");
}
```

Nu finns vår databaskoppling i `$db`.

Om uppkopplingen går fel så kastas ett exception där felet anges. De vanligaste problemen är att man skriver in fel server, databas, användare, lösenord eller att man missat att sätta UTF8 på överföringen.

När exception kastas så visas alla parametrarna i felutskrifter, även inloggningsdetaljerna som användarnamn och lösenord. Därför är det bäst att göra uppkopplingen inom ramen för en try-catch-sats så att man inte oavsiktligt riskerar att visa upp användare och lösenord för hela världen.



###Hämta data från databasen {#select}

I PHP PDO använder vi [*prepared statements*](http://www.php.net/manual/en/pdo.prepared-statements.php) när vi jobbar mot databasen. Först tar man en SQL-fråga och förbereder den, sedan exekverar man själva frågan och till slut hämtar man resultatet. Så här kan det se ut.

```php
$sql = "SELECT * FROM movie;";
$sth = $pdo->prepare($sql);
$sth->execute();
$res = $sth->fetchAll();
```

Variabeln `$sth` representerar ett objekt av klassen [PDO Statement](http://www.php.net/manual/en/class.pdostatement.php). Man tar alltså en SQL-fråga och skapar ett objekt av klassen PDO Statement utifrån frågan. Sedan exekverar man med metoden `execute()` och resultatet `$res` kommer i form av en 2-dimensionell array.

Du kan nu göra `var_dump()` eller `print_r()` på innehållet i `$res`. Som du kan se är det en array som i sin tur innehåller en array för varje rad i tabellen.

Så här kan resultatet se ut (jag plockade bort ett par värden för att minska utskriften).

```php
Array
(
    [0] => Array
        (
            [id] => 1
            [0] => 1
            [title] => Pulp fiction
            [1] => Pulp fiction
            [director] => 
            [2] => 
            [length] => 
            [3] => 
            [year] => 1994
            [4] => 1994
        )

    [1] => Array
        (
            [id] => 2
            [0] => 2
            [title] => American Pie
            [1] => American Pie
            [director] => 
            [2] => 
            [length] => 
            [3] => 
            [year] => 1999
            [4] => 1999
        )
```

Resultatarrayen innehåller alla raderna i en array och varje rad innehåller en array med kolumnerna, en variant med positionsargument 0-4 och en variant med kolumnens namn som nyckel.

Man kan alltså nå namnet på den första filmen på två olika sätt.

```php
$name = $resultset[0][1];
$name = $resultset[0]["title"];
```



###Olika fetchstyles {#fetchstyle}

Det finns olika sätt att hämta informationen ur databasen, olika *fetch-styles*, du kan läsa om de olika varianterna i manualsidan för metoden [`fetch()`](http://www.php.net/manual/en/pdostatement.fetch.php). 

Jag brukar föredra att få tillbaka resultatet som ett objekt genom att använda *fetch-style* `PDO::FETCH_OBJ`. Detta är något jag kan ange varje gång jag anropar `fetchAll()` men jag väljer att sätta den som standard för alla mina anrop med hjälp av metoden [`setAttribute()`](http://www.php.net/manual/en/pdo.setattribute.php).

```php
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
```

Nu ser resultatet istället ut så här, arrayen innehåller ett objekt med properties (vissa element är borttagna för att minska urskriften).

```php
Array
(
    [0] => stdClass Object
        (
            [id] => 1
            [title] => Pulp fiction
            [director] => 
            [length] => 
            [year] => 1994
            [plot] => 
            [image] => img/pulp-fiction.jpg
        )

    [1] => stdClass Object
        (
            [id] => 2
            [title] => American Pie
            [director] => 
            [length] => 
            [year] => 1999
            [plot] => 
            [image] => img/american-pie.jpg
        )
```

Nu kan man nå namnet på första filmen så här istället, med objektnotation.

```php
$name = $resultset[0]->title;
```

Så här kan man loopa genom resultsetet.

```php
foreach ($resultset as $key => $val) {
    echo "Filmens titel är ${val->title}.";
}
```

Nåväl, det finns olika sätt att hämta ut resultsetet. Vilket man använder beror på vad man föredrar och hur resten av koden är skriven. Vi jobbar objektorienterat så objektstilen känns logiskt.

Nu kan jag loopa igenom resultatet `$res` och skapa en HTML-tabell för att visa upp resultatet.

[FIGURE src=image/snapvt17/movie-show-all.png?w=w2 caption="Innehållet i databastabellen visas i en webbsida."]

Bra, då har vi en start. Innehållet i databastabellen finns nu presenterat och tillgängligt i min webbsida.

Dessutom gjorde jag en testsida som kan vara bra vid debugging, test och lek.

[FIGURE src=image/snapvt17/movie-select-all.png?w=w2 caption="Råa utskrifter av SQL-fråga och resultset."]

Då fortsätter vi leka runt med databasen.



Återställ databasen med ett SQL-skript {#restore}
-------------------------------------------------------------------------------

För att göra det enkelt att testa, så gör jag en sida där jag kan återställa hela databasen från en SQL-fil.

Manuellt gör jag det så här, på samma sätt som när jag initierade databasen från början.

```bash
$ mysql -uuser -ppass oophp < sql/setup.sql
```

Vill jag utföra samma sak från en webbsida, säg när man trycker på en knapp, så är principen följande.

```php
// Restore the database to its original settings
$file   = "sql/setup.sql";
$mysql  = "/usr/bin/mysql";

if (isset($_POST["reset"])) {
    $cmd = "$mysql -h{$host} -u{$login} -p{$password} $database < $file 2>&1";
    $res = exec($cmd);
    $output = "<p>The database is reset to its default content:<br/><code>{$cmd}</code></p><p>{$res}</p>";
}
```

Det är alltså ett enkelt sätt att skicka en hög med SQL-frågor till databasen via en fil och kommandoradsklienten till MySQL. 

Du behöver kontrollera sökvägen till kommandoradsklienten och ändra den för ditt eget systems förutsättningar. Du behöver också lägga till innehåll i variablerna som anger inloggnings- och databasdetaljer.

Delen men `2>&1` gör så att eventuella felmeddelanden syns på en Unix-maskin. Det är ett sätt att omdirigera stderr till stdout.

[FIGURE src=image/snapvt17/movie-reset.png?w=w2 caption="Återställ databasen till sitt ursprungliga skick."]

När man testar och leker runt så är det bra att kunna rensa databasen ibland.



Sök på delsträng i titel {#sok-titel}
-------------------------------------------------------------------------------

Jag vill införa möjligheten att söka ut filmer baserat på delsträngar i filmens titel. Det blir bra för att lära känna databasen och vilken typ av kod jag behöver skriva.

Till att börja med så skapar jag ett formulär.



###Sökformulär för titel {#soktitel}

Grunden för ett sökformulär kan se ut så här.

```html
<form method="get">
    <fieldset>
    <legend>Search</legend>
    <input type="hidden" name="route" value="search-title">
    <p>
        <label>Title (use % as wildcard):
            <input type="search" name="searchTitle" value="<?= esc($searchTitle) ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Search">
    </p>
    <p><a href="?">Show all</a></p>
    </fieldset>
</form>
```

Ovan formulär är från mitt exempelprogram så det är anpassat, men grunden finns där, om hur ett sökformulär kan se ut.

[FIGURE src=image/snapvt17/movie-search-title.png?w=w2 caption="Exempel på sökformulär för filmens titel."]

Jag väljer ett GET-formulär, som lägger alla parameterar i querysträngen, det gör att jag kan dela själva länken till en sökning och visa kompisen exakt samma sökresultat. Det hade inte fungerat om jag använt ett POST formulär.



###Hantering av sökningen {#hanterasok}

Koden som utför själva sökningen handlar om att kontrollera om formuläret är postat och isåfall utföra en databasfråga och visa svaret.

Koden som hanterar min sökning ser ut så här. Notera att koden bygger på strukturen som finns i exempelprogrammet där funktionen `getGet()` läser av inkommande GET-variabler och `$db->executeFetchAll()` utför själva databasfrågan och den koden ligger i en klass.

```php
case "search-title":
    $title = "SELECT * WHERE title";
    $view[] = "view/search-title.php";
    $view[] = "view/show-all.php";
    $searchTitle = getGet("searchTitle");
    if ($searchTitle) {
        $sql = "SELECT * FROM movie WHERE title LIKE ?;";
        $resultset = $db->executeFetchAll($sql, [$searchTitle]);
    }
    break;
```

Kort kan man säga att om formuläret är postat så kommer det att köras en SELECT mot databasen och svaret kommer att visas i en tabell som finns i en av vyerna.

Du kan se att jag använder ett `?` och lägger parametern som skall kopplas i en array via `[$searchTitle]`. Om du kikar vidare på koden bakom `$db->executeFetchAll()` och `execute()` så ser du att det är _prepared statements_ som används via `PDO::prepare` och `PDO::execute`. Det gör att jag skyddar mig mot SQL injections.

```php
/**
 * Do SELECT with optional parameters and return a resultset.
 *
 * @param string $sql   statement to execute
 * @param array  $param to match ? in statement
 *
 * @return array with resultset
 */
public function executeFetchAll($sql, $param = [])
{
    $sth = $this->execute($sql, $param);
    $res = $sth->fetchAll();
    if ($res === false) {
        $this->statementException($sth, $sql, $param);
    }
    return $res;
}



/**
 * Do INSERT/UPDATE/DELETE with optional parameters.
 *
 * @param string $sql   statement to execute
 * @param array  $param to match ? in statement
 *
 * @return PDOStatement
 */
public function execute($sql, $param = [])
{
    $sth = $this->pdo->prepare($sql);
    if (!$sth) {
        $this->statementException($sth, $sql, $param);
    }

    $status = $sth->execute($param);
    if (!$status) {
        $this->statementException($sth, $sql, $param);
    }

    return $sth;
}
```

I mitt exempelprogram har jag valt att lägga in databasrelaterad kod i en klass. Det förenklar min hantering av kod som går mot databasen samt felhanteringen. 

De två metoder som visas ovan är `execute()` som förbereder och exekverar databasfrågan. Den varianten som heter `executeFetchAll()` levererar dessutom ett resultset som svar på frågan. Den första metoden lämpar sig för INSERT, UPDATE, DELETE och den andra är tänkt för SELECT.

Du kan läsa om prepared statements, och fler sätt att koppla ihop parametrar med variabler, i manualen om [prepared statemements](http://www.php.net/manual/en/pdo.prepared-statements.php) eller där [metoden `execute()`](http://www.php.net/manual/en/pdostatement.execute.php) beskrivs.

Så här blev mitt resultat när jag gör min sökning.

[FIGURE src=image/snapvt17/movie-search-title-res.png?w=w2 caption="Nu kan jag söka på delsträng a titel."]

Bra start, eller?



XSS och Cross site scripting {#xss}
-------------------------------------------------------------------------------

Det är alltid skoj att kolla om kompisens webbplats har öppningar för XSS, där någon kan stoppa in och köra JavaScript.

> `?searchTitle=<script>alert("hej")</script>`

Eller genom att skriva in samma sak direkt i sökfältet?

[FIGURE src="image/snapvt17/movie-xss.png?w=w2" caption="Ajdå, jag behöver nog se över så att jag skyddar min sida från XSS."]

Kom ihåg att alltid kontrollera och använda [`htmlentities()`](http://php.net/manual/en/function.htmlentities.php) på information som du inte har full kontroll över och som skrivs ut i din webbsida. Detta gäller till exempel inkommande parametrar och strängar som byggs upp av dem.

Skriv aldrig ut något, i webbsidan, som kommer från en extern part. Det gäller information i såväl GET, POST som SERVER.

I mitt fall löser jag det med följande kod.

```php
<label>Title (use % as wildcard):
    <input type="search" name="searchTitle" value="<?= esc($searchTitle) ?>"/>
</label>
```

Det är delen `esc($searchTitle)` där funktionen `esc()` är min egen wrapper till PHPs `htmlentities()`. Jag gjorde en wrapper för att skriva mindre kod i mina vyer.



Sök efter året då filmen skapades {#sok-ar}
-------------------------------------------------------------------------------

Jag vill kunna använda året då filmen skapades som en grund för min sökning. Ibland vill jag se alla filmer som är äldre än 1990 och ibland vill jag se de filmer som skapats under första årtiondet av tvåtusentalet (2000 - 2010). Jag gör en ny testsida för att visa hur det kan se ut.

Tanken är något i denna stilen.

[FIGURE src=image/snapvt17/movie-search-year.png?w=w2 caption="Nu kan jag söka på filmer mellan två år."]

Formuläret ger mig två värden som kan användas för att söka ut filmer som är skapade inom en period av år.

Nu löste jag med formuläret så att man alltid skriver in två år. Så egentligen borde jag kunna räkna med att alltid få två år inskickade till mitt skript.

Men, trots det så valde jag en mer flexibel hantering i skriptet som säger att användaren egentligen kunde valt att skicka in bara det ena eller det andra året. Kanske valde jag att inte lite fullt ut på användaren av min sökmotor.

Nåväl, hanteringen av sökningen per år ser ut så här.

```php
case "search-year":
    $title = "SELECT * WHERE year";
    $view[] = "view/search-year.php";
    $view[] = "view/show-all.php";
    $year1 = getGet("year1");
    $year2 = getGet("year2");
    if ($year1 && $year2) {
        $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
        $resultset = $db->executeFetchAll($sql, [$year1, $year2]);
    } elseif ($year1) {
        $sql = "SELECT * FROM movie WHERE year >= ?;";
        $resultset = $db->executeFetchAll($sql, [$year1]);
    } elseif ($year2) {
        $sql = "SELECT * FROM movie WHERE year <= ?;";
        $resultset = $db->executeFetchAll($sql, [$year2]);
    }
    break;
```

Det är liknande hantering som när man sökte på titeln. Här har jag två inkommande fält att förhålla mig till och jag valde att göra tre varianter av SQL-kod, beroende på vad mitt skript får skickat till sig. Jag hade klarat mig med första SELECT-satsen som söker på båda åren. Men, nu är mitt skript mer motståndskraftigt och kan hantera fler varianter beroende av vad användaren postar till mig.



Uppdatera en film {#update-movie}
-------------------------------------------------------------------------------

Säg att jag vill uppdatera informationen om en film, hur skulle det kunna se ut?

Först behöver jag på något sätt välja ut vilken film jag vill uppdatera, därefter behövs ett formulär för att uppdatera själva filmen och slutligen kan ändringarna sparas i databasen.



###Välj film från en lista {#select-list}

Det finns flera alternativ när man väljer ut filmen som skall redigeras. Det är lite hur man vill koppla ihop olika sidor och hur formulär och länkar skapas.

Jag funderar lite och väljer att göra ett formulär med en SELECT/OPTION som visar samtliga filmer. Jag måste välja en film för att sedan klicka på "Edit" för att komma vidare till ett formulär som visar filmens detaljer.

Här är första formuläret där jag väljer film.

[FIGURE src=image/snapvt17/movie-select.png?w=w2 caption="Välj film för att redigera dess detaljer."]

Koden som hanterar det postade formuläret ser ut så här.

```php
case "movie-select":
    $movieId = getPost("movieId");
    if (getPost("doEdit") && is_numeric($movieId)) {
        header("Location: ?route=movie-edit&movieId=$movieId");
        exit;
    }

    $title = "Select a movie";
    $view[] = "view/movie-select.php";
    $sql = "SELECT id, title FROM movie;";
    $movies = $db->executeFetchAll($sql);
    break;
```

Här ser vi att formuläret använder POST och om knappen, som här representeras av `"doEdit"`, är klickad, så skickas användaren vidare till formuläret där filmen kan redigeras. Filmens id skickas med som en GET-variabel.

Om formuläret inte är postat så hämtas samtliga filmer från databasen och visas upp i formuläret, eller vyn om man så vill.

```php
<form method="post">
    <fieldset>
    <legend>Select Movie</legend>

    <p>
        <label>Movie:<br>
        <select name="movieId">
            <option value="">Select movie...</option>
            <?php foreach ($movies as $movie) : ?>
            <option value="<?= $movie->id ?>"><?= $movie->title ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <p>
        <input type="submit" name="doEdit" value="Edit">
    </p>
    <p><a href="?">Show all</a></p>
    </fieldset>
</form>
```

Notera ovan konstruktion med `foreach()` som skapar en OPTION för varje film.



###Uppdatera information om filmen {#update-details}

Då tittar vi på formuläret där vi kan uppdatera information om respektive film.

[FIGURE src=image/snapvt17/movie-update.png?w=w2  caption="Ett formulär för att redigera detaljer om en film."]

Nu är det bara att fylla i värden och klicka på "Save" för att spara.

Koden som hanterar det postade formuläret ser ut så här.

```php
case "movie-edit":
    $title = "UPDATE movie";
    $view[] = "view/movie-edit.php";
    $movieId = getPost("movieId") ?: getGet("movieId");
    $movieTitle = getPost("movieTitle");
    $movieYear = getPost("movieYear");
    $movieImage = getPost("movieImage");

    if (getPost("doSave")) {
        $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
        $db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
        header("Location: ?route=movie-edit&movieId=$movieId");
        exit;
    }

    $sql = "SELECT * FROM movie WHERE id = ?;";
    $movie = $db->executeFetchAll($sql, [$movieId]);
    $movie = $movie[0];
    break;
```

Första gången man kommer till sidan så hämtas filmens id från `getGet("movieId")` och SELECT-satsen i slutet hämtar information om filmen. 

I nästa skede är formuläret postat och all information hämtas från `getPost()` och det görs en UPDATE följt av en `header()` tillbaka till samma sida där informationen om filmen visas igen.



Skapa en ny film {#new-movie}
-------------------------------------------------------------------------------

Låt oss nu se om vi kan vara lite kluriga och skapa en ny film genom att återanvända vårt Edit-formulär.

Jag lägger till en knapp för "Add" i vyn där vi kunde välja filmer.

[FIGURE src=image/snapvt17/movie-add.png?w=w2 caption="Nu kan man klicka för att lägga till nya filmer."]

När man klickar "Add" så händer följande kod.

```php
case "movie-select":
    if (getPost("doAdd")) {
        $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
        $db->execute($sql, ["A title", 2017, "img/noimage.png"]);
        $movieId = $db->lastInsertId();
        header("Location: ?route=movie-edit&movieId=$movieId");
        exit;
    }
```

Det läggs till en ny film med standardvärden. Metoden `$db->lastInsertId()` tar reda på det id som blev resultatet av den senaste INSERT-satsen och med hjälp av den informationen så skickas användaren vidare till formuläret där filmens detaljer kan redigeras.

Vi lyckas alltså återanvända flera delar i detta fallet och sparar lite tid.

Så här ser det ut när man klickar på "Add".

[FIGURE src=image/snapvt17/movie-update-new.png?w=w2 caption="Den nya filmen kan direkt redigeras."]

Om man klickar "Save" och sedan visar alla filmer så kan det se ut så här.

[FIGURE src=image/snapvt17/movie-add-view-all.png?w=w2 caption="Den nya filmen visas i översikten."]

Då är det lika bra vi lär oss radera en film.



Radera en ny film {#del-movie}
-------------------------------------------------------------------------------

Det känns som vi kan fotsätta en del med återanvändningen. Jag väljer att lägga en "Delete" knapp på sidan där filmer kan väljas.

[FIGURE src=image/snapvt17/movie-delete.png?w=w2 caption="Ny knapp för att radera en film."]

När man klickar på knappen händer följande kod.

```php
case "movie-select":
    $movieId = getPost("movieId");
    if (getPost("doDelete")) {
        $sql = "DELETE FROM movie WHERE id = ?;";
        $db->execute($sql, [$movieId]);
        header("Location: ?route=movie-select");
        exit;
    }
```

Filmen raderas med en DELETE sats och senad skickas användaren till samma sida igen.

Nu kan vi visa, lägga till, redigera och radera filmer. Det är CRUD det, Create, Read, Update, Delete.



Sortera filmerna på olika kolumner {#sortera}
-------------------------------------------------------------------------------

När min filmsamling blir större så behöver jag stöd för att sortera tabellen. Jag tänkte sortera per kolumn genom att klicka på kolumnrubriken.

Jag behöver skapa en länk för att sortera kolumnen i stigande ordning och en länk för att sortera i sjunkande ordning.



###Funktion för att skriva ut pilarna {#updown}

Eftersom varje kolumn behöver upp- och ner-pilen så väljer jag att lägga den delen av koden i en funktion.

```php
/**
 * Function to create links for sorting.
 *
 * @param string $column the name of the database column to sort by
 * @param string $route  prepend this to the anchor href
 *
 * @return string with links to order by column.
 */
function orderby($column, $route)
{
    return <<<EOD
<span class='orderby'>
<a href="{$route}orderby={$column}&order=asc">&darr;</a>
<a href="{$route}orderby={$column}&order=desc">&uarr;</a>
</span>
EOD;
}
```

Nu kan jag skapa min header till tabellen och använda funktionen för att lägga till länkarna för sortering.

```php
<?php
$defaultRoute = "?route=show-all-sort&"
?>
<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id <?= orderby("id", $defaultRoute) ?></th>
        <th>Bild <?= orderby("image", $defaultRoute) ?></th>
        <th>Titel <?= orderby("title", $defaultRoute) ?></th>
        <th>År <?= orderby("year", $defaultRoute) ?></th>
    </tr>
```

Resultatet kan se ut så här.

[FIGURE src=image/snapvt17/movie-sort.png?w=w2 caption="Nu kan man sortera tabellen genom att klicka på pilarna."]

Visar man upp en tabell i en webbsida så är det inte orimligt att användaren kan vilja sortera resultatet i den. Nu har vi löst det i vår filmdatabas.



###Extra koll av säkerheten {#secsort}

Om vi tittar på routens hanterare så kommer vi se att vi har ett läge där prepared statements inte kan hjälpa oss, vi riskerar att öppna upp för SQL injections.

```php
case "show-all-sort":
    $title = "Show and sort all movies";
    $view[] = "view/show-all-sort.php";

    // Only these values are valid
    $columns = ["id", "title", "year", "image"];
    $orders = ["asc", "desc"];

    // Get settings from GET or use defaults
    $orderBy = getGet("orderby") ?: "id";
    $order = getGet("order") ?: "asc";

    // Incoming matches valid value sets
    if (!(in_array($orderBy, $columns) && in_array($order, $orders))) {
        die("Not valid input for sorting.");
    }

    $sql = "SELECT * FROM movie ORDER BY $orderBy $order;";
    $resultset = $db->executeFetchAll($sql);
    break;
```

I SELECT-satsen gör vi stränkonkatenering av de variabler som säger i vilken ordning som sortering skall ske.

```php
$sql = "SELECT * FROM movie ORDER BY $orderBy $order;";
```

Det är vanskligt, iallafall om vi inte har full koll på vilka värden som ligger i variablerna `$orderBy` och `$order`. Grunden för de variablerna kommer ju från GET. Men, i detta fallet så har jag lagt in arrayer med de värden som jag tolererar, och jag kollar att inkommande verkligen matchar giltiga värden, så här har jag mitt på det torra och klarar mig.

Har man bara full koll på vad variablerna kan innehålla så kan man göra som man vill.



Dela upp resultatet på flera sidor {#page}
-------------------------------------------------------------------------------

När filmsamlingen växer så blir det svårt att se alla filmer på en sida, jag behöver dela upp visningen i olika sidor, paginering. Det är relativt lätt att göra detta i SQL med klausulen `LIMIT` och `OFFSET`. 

Här väljer jag att visa två rader (LIMIT) och börja på den tredje raden genom att hoppa över de två första (OFFSET).

```sql
SELECT * FROM movie LIMIT 2 OFFSET 2;
```

Med hjälp av denna enkla SQL-konstruktion kan vi skapa en mer komplex navigering kring filmerna. Dels kan vi bestämma hur många filmer skall visas per sida och dels kan vi navigera mellan sidorna. Så här kan det se ut när det är klart.

[FIGURE src=/image/snapshot/Visa_resultatet_i_flera_sidor___Min_Filmdatabas.jpg?w=w1&q=60 caption="Två filmer visas per sida och sida 2 visas för tillfället."]

Det är en del kluriga saker att lösa för en sådan här webbsida. Dels är det länkningen och dels är det att bestämma vilken information man behöver ha tillgänglig.



###Variabler som krävs för paginering {#variabler}

För det första, jag måste ha tillgång till ett par variabler.

```php
$hits // How many rows to display per page.
$page // Current page to display, use to calculate offset value
$max  // Max pages in the table: SELECT COUNT(id) AS rows FROM movie
```

En länk till att visa sida 2 med 2 rader per sida kan alltså se ut så här.

> `?hits=2&page=2`

Länken bör i sin tur resultera i en SELECT-sats enligt följande.

```php
$sql = "SELECT * FROM movie LIMIT $hits OFFSET " . (($page - 1) * $hits);
//SELECT * FROM movie LIMIT 2 OFFSET 2
```

Det var principen det.

Om vi kikar rent kodmässigt så kan routens hanterare se ut så här, lite grovt.

Först gäller det att hantera hur många filmer som skall visas per sida. Här väljer jag ett defaultvärde till 4 filmer per sida, men jag vill inte tillåta värden högre än 8 träffar per sida.

```php
// Get number of hits per page
$hits = getGet("hits", 4);
if (!(is_numeric($hits) && $hits > 0 && $hits <= 8)) {
    die("Not valid for hits.");
}
```

Sedan behöver jag ha koll på hur många filmer som ligger i tabellen. Det ger mig ett max värde på antalet sidor som kan visas, om jag delar det med önskat antal träffar per sida.

```php
// Get max number of pages
$sql = "SELECT COUNT(id) AS max FROM movie;";
$max = $db->executeFetchAll($sql);
$max = ceil($max[0]->max / $hits);
```

Värdet på nuvarande sida hämtar jag och standardvärde är 1. Nu har jag tillräckligt med information för att räkna fram ett värde på OFFSET.

```php
// Get current page
$page = getGet("page", 1);
if (!(is_numeric($hits) && $page > 0 && $page <= $max)) {
    die("Not valid for page.");
}
$offset = $hits * ($page - 1);
```

Summa summarum kan jag nu komponera en SELECT-sats som ser ut så här.

```php
$sql = "SELECT * FROM movie ORDER BY $orderBy $order LIMIT $hits OFFSET $offset;";
$resultset = $db->executeFetchAll($sql);
```

Nu kan jag testa att visa resultatet genom att redigera länken direkt.

> `?page=1&hits=2`

[FIGURE src=image/snapvt17/movie-paginate-1.png?w=w2 caption="Första sidan visas med två träffar."]

> `?page=3&hits=2`

[FIGURE src=image/snapvt17/movie-paginate-2.png?w=w2 caption="Sista sidan visas med och där finns bara en träff."]

Då ska vi se om vi kan lösa själva länkandet, på ett bra sätt.



Länking genom att modifiera nuvarande querystring {#mod-qs}
------------------------------------------------------------------------------

Det behövs två "menyer" för att navigera i tabellen. En för att bestämma antalet träffar per sida och en för att bestämma vilken sida som skall visas.

Den ena menyn justerar värdet på `$hits` medans `$page` är oförändrat, den andra gör tvärtom och justerar `$page` medans `$hits` är oförändrat.

För att lyckas med detta så behöver jag lite funktioner.



###Använd nuvarande querystring som bas {#qsbas}

Det handlar om att utgå från nuvarande querystring och modifiera värdet i en viss parameter. För att göra detta på ett mer generellt sätt skapar jag en funktion `getQueryString()`.


```php
/**
 * Use the current querystring as base, modify it according to $options and return the modified query string.
 *
 * @param array $options to set/change.
 * @param string $prepend this to the resulting query string
 * @return string with an updated query string.
 */
function getQueryString($options, $prepend='?') {
  // parse query string into array
  $query = array();
  parse_str($_SERVER['QUERY_STRING'], $query);

  // Modify the existing query string with new options
  $query = array_merge($query, $options);

  // Return the modified querystring
  return $prepend . http_build_query($query);
}
```

I mitt fall är detta en funktion jag behöver för att fortsätta och skapa de båda navigeringsmenyerna.



###Navigeringsmeny för att välja antalet träffar {#sel-hits}

[FIGURE src=/image/snapshot/hits-Visa_resultatet_i_flera_sidor___Min_Filmdatabas.jpg?w=w1&q=60 caption="Menyn för att bestämma hur många träffar som visas per sida."]

För att hålla ordning i min kod så skapar jag en ny metod för att generera menyn för antalet träffar. Jag skickar in en array med de alternativ jag vill ha och resultatet blir menyn i form av html-kod. För att skapa menyn används funktionen `getQueryString()`.

**Funktion för att skapa meny för antal träffar.**

```php
/**
 * Create links for hits per page.
 *
 * @param array $hits a list of hits-options to display.
 * @return string as a link to this page.
 */
function getHitsPerPage($hits) {
  $nav = "Träffar per sida: ";
  foreach($hits AS $val) {
    $nav .= "<a href='" . getQueryString(array('hits' => $val)) . "'>$val</a> ";
  }  
  return $nav;
}

echo getHitsPerPage(array(2, 4, 8));
```


###Navigeringemeny för sidor {#sel-page}

[FIGURE src=/image/snapshot/pages-Visa_resultatet_i_flera_sidor___Min_Filmdatabas.jpg?w=w1&q=60 caption="Menyn för att bestämma hur många träffar som visas per sida."]

Jag behöver ytterligare en meny för att bestämma vilken sida som skall visas. Här blir det också snyggare att lägga koden i en funktion och funktionen `getQueryString()` används för att skapa länkarna.

**Funktion för att skapa meny för navigering av sidor.**

```php
/**
 * Create navigation among pages.
 *
 * @param integer $hits per page.
 * @param integer $page current page.
 * @param integer $max number of pages. 
 * @param integer $min is the first page number, usually 0 or 1. 
 * @return string as a link to this page.
 */
function getPageNavigation($hits, $page, $max, $min=1) {
  $nav  = "<a href='" . getQueryString(array('page' => $min)) . "'>&lt;&lt;</a> ";
  $nav .= "<a href='" . getQueryString(array('page' => ($page > $min ? $page - 1 : $min) )) . "'>&lt;</a> ";

  for($i=$min; $i<=$max; $i++) {
    $nav .= "<a href='" . getQueryString(array('page' => $i)) . "'>$i</a> ";
  }

  $nav .= "<a href='" . getQueryString(array('page' => ($page < $max ? $page + 1 : $max) )) . "'>&gt;</a> ";
  $nav .= "<a href='" . getQueryString(array('page' => $max)) . "'>&gt;&gt;</a> ";
  return $nav;
}

echo getPageNavigation($hits, $page, $max);
```

När allt är klart kan det se ut som i mitt [exempel med sidnavigering](kod-exempel/gor-din-egen-filmdatabas/movie_page.php).



Spara debugginformation i sessionen mellan sidanrop {#session}
-------------------------------------------------------------------------------

Som du kunde se i exemplet ovan så användes en ny metod, `CDatabase::SaveDebug()`. Vi tittar på det sammanhang där den används.

```php
$db->ExecuteQuery($sql, array($title));
$db->SaveDebug();
header('Location: movie_edit.php?id=' . $db->LastInsertId());
```

Först exekveras en databasfråga, som vanligt lagras det undan information som sedan kan skrivas ut, men vad händer när man dirigerar sidan till en annan resultatsida med `header()`, då försvinner all information om frågan. Det är synd. 

Lösningen blir att spara undan informationen i sessionen, en mellanlagring, som ett flash-minne. Spara undan genom att anropa `SaveDebug()` och när klassen initieras i nästa sidkontroller så läses informationen in från sessionen. På det viset kan vi ha mer komplexa dirigeringar mellan sidor men ändå behålla debug-information om vad som händer med databasen.

Så här ser koden ut.

**Spara undan i sessionen med `SaveDebug()`.**

```php
  /**
   * Save debug information in session, useful as a flashmemory when redirecting to another page.
   * 
   * @param string $debug enables to save some extra debug information.
   */
  public function SaveDebug($debug=null) {
    if($debug) {
      self::$queries[] = $debug;
      self::$params[] = null;
    }

    self::$queries[] = 'Saved debuginformation to session.';
    self::$params[] = null;

    $_SESSION['CDatabase']['numQueries'] = self::$numQueries;
    $_SESSION['CDatabase']['queries']    = self::$queries;
    $_SESSION['CDatabase']['params']     = self::$params;
  }
```

Med denna metod sparas all information i sessionen. När vi sedan hämtar tillbaka informationen så görs det i konstruktorn.

**Hämta information från sessionen i konstruktorn.**

```php
    // Get debug information from session if any.
    if(isset($_SESSION['CDatabase'])) {
      self::$numQueries = $_SESSION['CDatabase']['numQueries'];
      self::$queries    = $_SESSION['CDatabase']['queries'];
      self::$params     = $_SESSION['CDatabase']['params'];
      unset($_SESSION['CDatabase']);
    }
```

Som vanligt när det gäller sessioner så när du får problem så är det bra att skriva ut innehållet i sessionen för att felsöka på det. 

Nu kan vi jobba vidare med databasen och databasklassen oavsett dirigeringar mellan sidor. Perfekt!



Avslutningsvis {#sum}
-------------------------------------------------------------------------------

Nu har du grunderna i PHP PDO och MySQL och lite till. Detta är egentligen grunderna i de flesta databasdrivna webbapplikationer så desto bättre du lär dig -- och organiserar din kod, desto lättare blir det att återanvända och vidareutveckla det du nu gjort.

Det finns en [forumtråd](t/XXX) där du kan ställa frågor eller komma med tips.



<!--
Kategorisera filmer per genre {#sok-genre}
-----------------------------------------------------------------------------------------------

Jag vill kategorisera mina filmer i olika genrer och jag vill kunna visa alla filmer som finns i en viss genre. 



###Tabeller för att hantera genre {#table-genre}

Först behöver jag uppdatera databasen och lägga in information om vilka genrer som respektive film tillhör.

**SQL för att koppla film till genre.**

```sql
--
-- Add tables for genre
--
DROP TABLE IF EXISTS Genre;
CREATE TABLE Genre
(
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  name CHAR(20) NOT NULL -- crime, svenskt, college, drama, etc
) ENGINE INNODB CHARACTER SET utf8;

INSERT INTO Genre (name) VALUES 
  ('comedy'), ('romance'), ('college'), 
  ('crime'), ('drama'), ('thriller'), 
  ('animation'), ('adventure'), ('family'), 
  ('svenskt'), ('action'), ('horror')
;

DROP TABLE IF EXISTS Movie2Genre;
CREATE TABLE Movie2Genre
(
  idMovie INT NOT NULL,
  idGenre INT NOT NULL,

  FOREIGN KEY (idMovie) REFERENCES Movie (id),
  FOREIGN KEY (idGenre) REFERENCES Genre (id),

  PRIMARY KEY (idMovie, idGenre)
) ENGINE INNODB;


INSERT INTO Movie2Genre (idMovie, idGenre) VALUES
  (1, 1),
  (1, 5),
  (1, 6),
  (2, 1),
  (2, 2),
  (2, 3),
  (3, 7), 
  (3, 8), 
  (3, 9), 
  (4, 11),
  (4, 1),
  (4, 10),
  (4, 9),
  (5, 11),
  (5, 4),
  (5, 12)
;

DROP VIEW IF EXISTS VMovie;

CREATE VIEW VMovie
AS
SELECT 
  M.*,
  GROUP_CONCAT(G.name) AS genre
FROM Movie AS M
  LEFT OUTER JOIN Movie2Genre AS M2G
    ON M.id = M2G.idMovie
  LEFT OUTER JOIN Genre AS G
    ON M2G.idGenre = G.id
GROUP BY M.id
;

SELECT * FROM VMovie;
```

Sådär, nu finns det två nya tabeller, en tabell med alla giltiga genrer (`Genre`) och en tabell (`Movie2Genre`), eller kopplingstabell om man så vill, för att koppla ihop en film till en eller flera genrer.

För att göra det enkelt att jobba med datan så skapar jag en vy där jag joinar alla tre tabeller. När jag sedan jobbar i PHP så räcker det att jobba mot vyn `VMovie` när jag vill visa alla filmer. 

En sak i detta sammanhanget är att använda den MySQL-specifika funktionen [`GROUP_CONCAT()`](http://dev.mysql.com/doc/refman/5.6/en/group-by-functions.html#function_group-concat) för att samla alla genrer i en kolumn. Den slår samman alla genrer för en film och gör det till en sträng som samlas i en kolumn. 

[FIGURE src=/image/snapshot/workbench-genre.jpg?w=w1&q=60 caption="Nu är filmerna kategoriserade enligt genre."]



###Visa filmer som tillhör en viss genre {#visa-genre}

Det första jag tänkte göra är att visa alla genrer som har minst en film. Sedan tänkte jag att användaren kan klicka på en genre och visa de filmer som är klassade enligt den. Först behöver jag alltså ta reda på vilka genrer som är *aktiva*, det vill säga de genrer som är kopplade till en eller flera filmer.

**SQL för att kolla aktiva genrer.**

```sql
SELECT DISTINCT G.name
FROM Genre AS G
  INNER JOIN Movie2Genre AS M2G
    ON G.id = M2G.idGenre
```

Nu har jag en lista på de genrer som används, med hjälp av dem gör jag en klickbar lista. 

När jag sedan vill visa alla filmer per en viss genre så använder jag följande SQL-kod.

**Visa filmer från en viss genre.**

```sql
SELECT 
  M.*,
  G.name AS genre
FROM Movie AS M
  LEFT OUTER JOIN Movie2Genre AS M2G
    ON M.id = M2G.idMovie
  LEFT OUTER JOIN Genre AS G
    ON M2G.idGenre = G.id
WHERE G.name = ?
;
```

Den är rätt lik vyn `VMovie` där alla tre tabellerna joinas, men det är enbart filmer från den valda genren som visas.

[FIGURE src=/image/snapshot/Sok_film_per_genre___Min_Filmdatabas.jpg?w=w1&q=60 caption="Visa alla filmer som hör till en viss genre."]

Bra, nu finns det flera sätt att söka ut filmerna på.

-->
