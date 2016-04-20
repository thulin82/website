---
author: mos
category: sql
revision:
  "2015-10-13": (B, mos) Stava rätt på filnamn till databasen.
  "2015-06-10": (A, mos) Första utgåvan för htmlphp version 2 av kursen.
updated: "2015-10-13 17:18:06"
created: "2015-06-05 09:58:04"
...
Kom igång med SQLite och PHP PDO
==================================

[FIGURE src=/image/snapvt15/pdo-select-table.png?w=c5&a=0,50,50,0 class="right" caption="PHP PDO och SQLite."]

Att bygga webbplatser innebär ofta kopplingar mot databaser och när det gäller PHP så är det numer gränssnittet PDO som är det som främst används. Detta är en guide för att stegvis komma igång med PHP PDO tillsammans med databasen SQLite.

Guiden hanterar grunderna i hur du använder PHP PDO för att koppla upp dig mot en SQLite-databas. Därefter visas de vanligaste CRUD (Create, Read, Update, Delete) operationerna som du behöver för att skapa en databasdriven webbapplikation med SQLite och PHP PDO.

<!--more-->

Bästa sättet att gå igenom guiden är att genomföra varje övning på egen hand. Gör precis som jag gjort, fast på egen hand. Kopiera eller skriv om kodexemplen, det viktiga är att du återskapar koden i din egna miljö. Läsa är bra men man måste göra själv, "kan själv", för att lära sig.



Förkunskaper {#for}
--------------------------------------

Du bör ha förkunskaper om databaser och specifikt SQLite motsvarande de som hanteras i guiden "[Kom igång med databasen SQLite](kunskap/kom-igang-med-databasen-sqlite)".

Det kan också vara en fördel att vara bekant med klienter för SQLlite, både för [kommandoraden](kunskap/en-kommandoradsklient-for-sqlite) och för [webbaserat bruk](kunskap/en-webbaserad-klient-for-sqlite-phpliteadmin).



Om PHP PDO och SQLite {#om}
--------------------------------------

Via PHP kan man komma åt informationen i en SQLite-databas. Det finns olika PHP-interface för att jobba mot SQLite, det finns [sqlite](http://php.net/manual/en/book.sqlite.php), [sqlite3](http://php.net/manual/en/book.sqlite3.php) eller [pdo-sqlite](http://php.net/manual/en/ref.pdo-sqlite.php). 

Jag kommer att använda interfacet PDO för att jobba mot SQLite. Databasen SQLite är version 3.

Läs den korta [introduktionen om PHP PDO](http://php.net/manual/en/intro.pdo.php).

PHP Data Objects (PDO) är ett generiskt gränssnitt för att jobba mot olika underliggande databaser. Det ger ett gemensamt gränssnitt, oavsett vilken databas man använder. PDO stödjer även databaser som MySQL, PostgreSQL och Microsoft SQL Server. 

En PDO driver krävs för att PDO ska kunna prata med den valda databasen. En PDO driver sköter den specifika kommunikationen mellan PDO och databasen. I manualen finns en [lista över de PDO driver som finns](http://php.net/manual/en/pdo.drivers.php).



Prepared statements och SQL injections {#sqlinjections}
--------------------------------------

En feature som stöds av många databaser är "Prepared Statements". Prepared statements har ett säkert sätt att hantera argument, ett sätt som undviker säkerhetshål som SQL injections.

Läs det inledande stycket om [prepared statements och studera översiktligt exemplen](http://www.php.net/manual/en/pdo.prepared-statements.php). Där får du en kort introduktion till hur prepared staments fungerar.

Låt oss säga några ord om säkerhetshål och SQL injections innan vi fortsätter.

[FIGURE src=http://imgs.xkcd.com/comics/exploits_of_a_mom.png caption="Strip om SQL injections från [http://xkcd.com/327/](http://xkcd.com/327/)."]

SQL injections är ett sätt för en "cracker" att "bryta sig in" i en webbapplikation genom att via URL:en, eller formulär, modifiera SQL-satserna som körs av webbapplikationen. Ett sådant säkerhetshål kan ge en inbrytare tillgång till alla användare och lösenord i en databas.

Läs lite snabbt (och översiktligt) om [SQL injections på Wikipedia](http://en.wikipedia.org/wiki/SQL_injection).

I forumet finns en generell tråd om [säker programmering i PHP](t/1702). Där finns även [inlägg om SQL injections](f/13580) som visar ett exempel på när det kan gå fel. Läs mer där om du är intresserad av säker programmering. Men för tillfället räcker det att veta att PDO och prepared statements, *rätt använt*, skyddar dig mot SQL injections.

Men, låt oss nu komma igång och använda PDO.



Finns PDO och PDO SQLite installerat? {#install}
--------------------------------------

Med PHP-kod kan du kontrollera om din PHP-installation har stöd för PDO och SQLite. Lägg följande kod i en PHP-fil och kör den på din webbserver för att se om det finns stöd för PDO och SQLite.

*PHP-skript för att kontrollera om din server har stöd för pdo-sqlite.*

```php
<?php
if (class_exists('PDO')) {
    echo "<p>PDO exists and the following PDO drivers are loaded.<pre>";
    print_r(PDO::getAvailableDrivers());
}

if (in_array("sqlite", PDO::getAvailableDrivers())) {
    echo "<p style='color:green'>sqlite PDO driver IS enabled";
} else {
    echo "<p style='color:red'>sqlite PDO driver IS NOT enabled";
}
```

Så här kan det se ut när skriptet säger att PHP-installationen har stöd för PDO och SQLite.

[FIGURE src=/image/snapvt15/pdo-sqlite-exists.png?w=w2 caption="Installationen har stöd för PHP PDO och PDO extension för SQLite finns installerad."]

Du kan testköra skriptet på [studentservern](http://www.student.bth.se/~mosstud/repo/htmlphp/example/pdo-sqlite/check-if-available.php). Det kan se ut ungefär så här.

[FIGURE src=/image/snapvt15/pdo-sqlite-studserver.png?w=w2 caption="PDO och SQLite finns på studentservern."]

Använd nu ovanstående PHP-kod för att kontrollera att PHP PDO och SQLite är installerat på din egen maskin.



Koppla ett PHP-skript till en SQLite-databas med PDO {#connect}
--------------------------------------

Vi gör ett minsta möjliga skript som kopplar sig mot en SQLite databas via PHP PDO och ställer en fråga samt skriver ut resultatet till webbläsare. Låt oss använda samma databas som [vi jobbade med tidigare](kunskap/kom-igang-med-databasen-sqlite). Ta en kopia av databasfilen `boats.sqlite` och spara den till en katalog på din webbserver. Jag sparade min databas som `jetty.sqlite` i underkatalogen `db`. 

Därefter kan du skapa ett PHP-skript med följande kod.

*PHP-kod för att kopppla till en SQLite databas och ställa en fråga.*

```php
<?php
// Create a DSN for the database using its filename
$fileName = __DIR__ . "/db/jetty.sqlite";
$dsn = "sqlite:$fileName";

// Open the database file and catch the exception it it fails.
try {
    $db = new PDO($dsn);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed to connect to the database using DSN:<br>$dsn<br>";
    throw $e;
}

// Prepare and execute the SQL statement
$stmt = $db->prepare("SELECT * FROM Jetty");
$stmt->execute();

// Get the results as an array with column names as array keys
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>", print_r($res, true), "</pre>";
```

Du kan [testköra ovanstående exempelkod på dbwebb](htmlphp/repo/example/pdo-sqlite/connect.php). Det bör se ut ungefär så här.

[FIGURE src=/image/snapvt15/pdo20-connect.png?w=w2 capition="Utskrift av resultatet från databasfrågan."]

Svaret kommer alltså som en array, där varje rad i arrayen är en rad från databasen. Det är en array som innehåller arrayer. Man kallar det även för tvådimensionell array. Men det är inte så viktigt just nu.

Studera istället källkoden i exemplet och försök att skapa dig en mental bild av flödet i PHP-koden.

1. Definera sökvägen till filen (databasen).
2. Skapa en DSN, *Data Source Name*, för databasen.
3. Skapa ett nytt databasobjekt och peka det mot filen.
4. Förbered, *prepare*, en SQL-sats.
5. Utför, *execute*, SQL-satsen.
6. Hämta resultatet från SQL-frågan, *fetch*, svaret kommer i en array.
7. Skriv ut resultatet.

Kopiera koden till din egna fil och gör ett eget exempel. Testa så att det fungerar. Detta är grunden i att koppla PHP mot en databas. Inte så svårt va?

Databasfilen ligger i underkatalogen `db` och sökvägen dit är alltså `db/jetty.sqlite`. 

En DSN är en sträng som innehåller informationen för att koppla dig till databasen. En DSN ser olika ut för varje databas. I vårt fall består den av strängen `sqlite:` följt av filens sökväg. 

Du kan läsa lite om DSN i metoden för att koppla upp sig mot databasen, [PDO::__construct()](http://php.net/manual/en/pdo.construct.php), kika under stycket om *Parameters*. Du kan också kort [läsa om DSN på Wikipedia](https://en.wikipedia.org/wiki/Data_source_name).

Det är bra att ha en mental bild av flödet i programmet. Så man vet i vilken ordning saker sker.

Då kikar vi vidare.



Felmeddelande om PDO inte har skrivrättigheter i katalogen {#err-open}
--------------------------------------

Om du skriver fel sökväg till databasen, eller om databasfilen inte finns, så försöker PDO att skapa databasfilen. För att lyckas med det så behöver PDO ha skrivrättigheter i den katalogen där databasfilen skall ligga. 

I vårt exempel så har vi redan databasfilen så det bör inte bli ett problem.

Men, om vi till exempel stavar fel på databasfilen eller dess sökväg så kan det se ut så här.

> *"Fatal error: Uncaught exception 'PDOException' with message 'SQLSTATE[HY000] [14] unable to open database file' in /home/mos/git/htmlphp/example/pdo-sqlite/connect.php on line 8"*

[FIGURE src=/image/snapvt15/pdo-connect-fail.png?w=w2 caption="Misslyckades med att koppla sig, eller skapa den felstavade databasen."]

Det som skrivs ut är dels vår egen felsökningstext som visar sökvägen/dsn och dels felmeddelandet från PHP om det fel som kastades. 

Kom ihåg att det alltid är det översta felet som är intressant, resten av felen är ofta följdfel och fixar man det första så kan de försvinna. 

> *"Lös alltid det översta felet först och lös ett fel i taget."*

Om du vill att databasen skall skapas automatiskt så behöver du ge användaren som kör webbservern skrivrättigheter till katalogen. Ett enkelt sätt att göra det är kommandot `chmod`.

```bash
chmod 777 db
```

Notera att ovan problem med rättigheter inte inträffar på Windows. Men på Mac OS och Unix-baserade operativsystem så är det desto viktigare. Studentservern kör på Debian/Linux så där är det väldigt viktigt att ha koll på rättigheterna.



Visa innehållet i tabellen med SELECT {#select}
--------------------------------------

Vi skapar ett nytt testskriptet med fler SELECT-satser. Men, ta först ett par minuter och studera [SQL-satsen SELECT på www.sqlite.org](http://www.sqlite.org/lang_select.html).

Det kanske inte är inte uppenbart hur syntaxen fungerar, men studera bilderna och försök se hur SQL-satsen kan konstrueras. I längden är det denna typen av manualsidor som du skall lita på. Så du behöver träna på att läsa dem.

> *"Referensmanualen är din bästa vän."*

Då gör vi ett nytt exempel där SELECT används. Låt oss skriva ut svaret i en HTML-tabell. Det blir lite snyggare så.

Så här kan det se ut.

[FIGURE src=/image/snapvt15/pdo-select-table.png?w=w2 caption="Resultatet från SELECT utskrivet i en HTML-tabell."]

Det som är specifikt för detta exemplet är utskriften då vi loopar genom arrayen och skapar HTML-tabellen. Just den delen kan se ut så här.

```php
// Prepare and execute the SQL statement
$sql = "SELECT * FROM Jetty";
$stmt = $db->prepare($sql);

echo "<p>Execute the SQL-statement:<br><code>$sql</code><p>";
$stmt->execute();

// Get the results as an array with column names as array keys
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<p>The result contains " . count($res) . " rows.</p>";

// Loop through the array and gather the data into table rows
$rows = null;
foreach ($res as $row) {
    $rows .= "<tr>";
    $rows .= "<td>{$row['jettyPosition']}</td>";
    $rows .= "<td>{$row['boatType']}</td>";
    $rows .= "<td>{$row['boatEngine']}</td>";
    $rows .= "<td>{$row['boatLength']}</td>";
    $rows .= "<td>{$row['boatWidth']}</td>";
    $rows .= "<td>{$row['ownerName']}</td>";
    $rows .= "</tr>\n";
}

// Print out the result as a HTML table using PHP heredoc
echo <<<EOD
<table>
<tr>
    <th>jettyPostion</th>
    <th>boatType</th>
    <th>boatEngine</th>
    <th>boatLength</th>
    <th>boatWidth</th>
    <th>ownerName</th>
</tr>
$rows
</table>
EOD;
```

Du kan [testa skriptet i sin helhet på dbwebb](htmlphp/repo/example/pdo-sqlite/select-table.php) och du kan se dess [källkod på GitHub](https://github.com/mosbth/htmlphp/tree/master/example/pdo-sqlite/select-table.php).

Ta nu och gör ett likadant skript i din egen miljö. Kika på mitt skript och skriv av det. Det är en bättre taktik att lära sig, än att bara råkopiera skriptet. För mycket råkopiering straffar sig i längden.



Gör ett sökformulär med SELECT {#select-form}
--------------------------------------

Låt oss se hur vi kan kombinera ett formulär med en databasfråga och skapa ett sökformulär som låter användaren ställa frågor till databasen.

Så här kan det se ut.

Först ett formulär där vi skriver in en söksträng. Likt SQL så använder vi här `%` som *wildcard* för att söka på delsträngar.

[FIGURE src=/image/snapvt15/pdo-search-form-start.png?w=w2 caption="Skriv in en söksträng, med eller utan `%`."]

Sedan klickar vi på "Sök"-knappen och resultatet visar sig.

[FIGURE src=/image/snapvt15/pdo-search-form-results.png?w=w2 caption="Resultatet från sökningen presenteras."]

Nu blandar vi in formulärhantering med en databasefråga. Nu gäller det att ha den mentala bilden av hur skriptet exekveras. Var skall koden för formuläret vara och var kollar vi om foruläret är postat och var skriver vi databasfrågan? Här är ett par viktiga saker i hur exekveringen av PHP-skriptet sker. Övning ger färdighet så bygg upp din mentala bild av hur exekveringen sker.

Låt oss kika på de delar av exempelkoden som skiljer sig från tidigare exempel.

Först kollar vi om formuläret är postat. Eftersom skriptet beteer sig olika beroende på om formuläret är postat eller ej, så gör vi det först.

```php
<?php
// Get incoming from search form
$search = isset($_GET['search'])
    ? $_GET['search']
    : null;

?>
```
 
Sedan väljer jag att skriva ut webbsidan inklusive formuläret. Nu kan jag även skriva ut nuvarande söksträng, det ser bra ut.

```php
<!doctype html>
<meta charset=utf8>
<link href="style.css" rel="stylesheet">

<form>
    <input type="search" name="search" value="<?=$search?>" placeholder="Enter substring to search for, use % as wildcard.">
    <input type="submit" value="Search">
</form>
```

Därefter kollar jag om formuläret var postat, annars skriver jag bara ut en uppmaning om att skriva in en söksträng.

```php
<?php
// Break script if empty $search
if (is_null($search)) {
    exit("<p>Nothing to display, please enter a searchstring.");
}
```

Därefter så kopplar jag upp mig mot databasen och förbereder SQL-frågan. SQL-frågan innehåller nu en WHERE-del som tillsammans med LIKE gör att strängar kan jämföras med inslag av `%`.

```php
// Prepare the SQL statement
$sql = "SELECT * FROM Jetty WHERE boatType LIKE ? OR boatEngine LIKE ?";
$stmt = $db->prepare($sql);
echo "<p>Preparing the SQL-statement:<br><code>$sql</code><p>";
```

Du noterar att det är två frågetecken i SQL-frågan? Nu är det dags att koppla dessa frågetecken till det som skrevs in i sökformuläret. Det sker via en array av parametrar som skickas med som ett argument när frågan exekveras.

```php
// Execute the SQL statement using parameters to replace the ?
$params = [$search, $search];
$stmt->execute($params);
echo "<p>Executing using parameters:<br><pre>" . htmlentities(print_r($params, true)) . "</pre>";
```

Sådär. Nu är vi klara. Vi skapade en SQL-fråga och använde ?-tecken för att koppla till en array av parametrar som vi skickade in till själva frågan. Resten handlar om att skriva ut resultatet och det är som tidigare.



###Felmeddelande om antalet parametrar är fler än frågetecknen {#err-param}

Det är vikigt att antalet frågetecken i SQL-frågan matchar antalet parametrar i arrayen. Annars kan du se följande felmeddelande.

> *Fatal error: Uncaught exception 'PDOException' with message 'SQLSTATE[HY000]: General error: 25 bind or column index out of range' in /home/mos/git/htmlphp/example/pdo-sqlite/select-form.php on line 43*

Om felmeddelandet dyker upp så vet du nu att du måste kontrollräkna antalet parametrar mot antalet frågetecken. Du har skickat in fler parametrar än du har frågetecken.



Vanliga felmeddelanden med PHP PDO och SQLite {#fel}
--------------------------------------

Här följer fler vanliga felmeddelande som kan förekomma när du jobbar med PHP PDO och SQLite. Tillsammans med felmeddelandet finner du tips på hur du kan åtgärda felen.

*Felmeddelande "unable to open database file"*

> *Fatal error: Uncaught exception 'PDOException' with message 'SQLSTATE[HY000] [14] unable to open database file' in /home/mos/git/htmlphp/example/pdo-sqlite/init.php on line 14*

Lösning: Katalogen som databas-filen skall ligga i är skrivskyddad och databasen kan inte skapas. Ändra rättigheterna på katalogen till 777.

*Felmeddelande "write a readonly database"*

> *Fatal error: Uncaught exception 'PDOException' with message 'SQLSTATE[HY000]: General error: 8 attempt to write a readonly database' in /home/mos/git/htmlphp/example/pdo-sqlite/init.php on line 29*

Lösning: Databas-filen är skrivskyddad. Ändra rättigheterna till 666 så det går att skriva till filen.



Skapa ny tabell och lägg in rader {#create}
--------------------------------------

När en webbapplikation installeras så vill man ofta initiera databasen genom att skapa tabeller och lägga in default-värden i tabellerna. Vi kan göra detta genom att skapa ett skript som initierar en tom databasfil genom att skapa en tabell och lägga till ett antal rader.

När vi jobbade med SQLite Manager så såg vi SQL-koden för att skapa en tabell och för att lägga dit rader.

*SQL-kod för att skapa tabell och för att lägga till rader.*

```sql
CREATE TABLE "main"."Jetty" (
    "jettyPosition" INTEGER PRIMARY KEY  NOT NULL  UNIQUE, 
    "boatType" VARCHAR(20) NOT NULL, 
    "boatEngine" VARCHAR(20) NOT NULL, 
    "boatLength" INTEGER, 
    "boatWidth" INTEGER, 
    "ownerName" VARCHAR(20)
)

INSERT INTO "Jetty" VALUES(1,'Buster XXL','Yamaha 115hk',635,240,'Adam');
INSERT INTO "Jetty" VALUES(2,'Buster M','Yamaha 40hk',460,186,'Berit');
INSERT INTO "Jetty" VALUES(3,'Linder 440','Tohatsu 4hk',431,164,'Ceasar');
```

Låt oss skapa ett testskript som har till uppgift att skapa tabellen och lägga till ovan exempelrader. Jag väljer att göra detta i en ny databas-fil, `jetty1.sqlite`. Så här blev det för mig.

[FIGURE src=/image/snapvt15/pdo-init.png?w=w2 caption="Initiera en databas genom att skapa tabellen och lägga till innehåll via SQL."]

Du kan [testköra mitt skript på dbwebb](htmlphp/repo/example/pdo-sqlite/init.php) och du kan [se källkoden på GitHub](https://github.com/mosbth/htmlphp/blob/master/example/pdo-sqlite/init.php).

Om du kikar på källkoden i skriptet så ser du att jag börjar med att göra DROP på tabellen, om den finns. Jag vill alltid starta med en tom tabell i detta fallet.

```php
// Prepare the SQL statement to drop the table
echo "<p>Prepare to drop the table, if it exists.<p>";
$sql = <<<EOD
DROP TABLE IF EXISTS "Jetty";
EOD;
$stmt = $db->prepare($sql);
$stmt->execute();
```

Sedan skapar jag tabellen.

```php
// Prepare the SQL statement to create the table
echo "<p>Prepare to create the table.<p>";
$sql = <<<EOD
CREATE TABLE "main"."Jetty" (
    "jettyPosition" INTEGER PRIMARY KEY  NOT NULL  UNIQUE, 
    "boatType" VARCHAR(20) NOT NULL, 
    "boatEngine" VARCHAR(20) NOT NULL, 
    "boatLength" INTEGER, 
    "boatWidth" INTEGER, 
    "ownerName" VARCHAR(20)
)
EOD;
$stmt = $db->prepare($sql);
$stmt->execute();
```

Därefter skapar jag en SQL-sats för att lägga till rader. Jag gör *prepare* på den och sen återanvänder jag samma SQL-sats för att lägga till tre rader.

Först gör jag *prepare*.

```php
// Prepare SQL statement to INSERT new rows into table
echo "<p>Prepare to insert into the table.<p>";
$sql = <<<EOD
INSERT INTO "Jetty" VALUES(?, ?, ?, ?, ?, ?);
EOD;
$stmt = $db->prepare($sql);
```

Därefter använder jag samma *statement* `$stmt` för att exekvera med olika parametrar.

```php
// Insert each row
echo "<p>Inserting rows into the table.</p>";
$params = [1,'Buster XXL','Yamaha 115hk',635,240,'Adam'];
$stmt->execute($params);

$params = [2,'Buster M','Yamaha 40hk',460,186,'Berit'];
$stmt->execute($params);

$params = [3,'Linder 440','Tohatsu 4hk',431,164,'Ceasar'];
$stmt->execute($params);
```

Klart. Nu har jag en databas, initierad med en tabell med tre rader.



Skapa nya rader i tabellen med INSERT {#insert}
--------------------------------------

I en webbapplikation är det ett vanligt förfarande att användaren skall kunna lägga till nya rader i databasen. Låt oss göra ett exempel där användaren fyller i ett formulär för att lägga till en ny båt.

Innan du går vidare så kan du kort [studera SQL-satsen INSERT på www.sqlite.org](http://www.sqlite.org/lang_insert.html).

Vi gör ett nytt skript med ett POST-formulär som postar till en processingsida. Resultatet blir ungefär som vi gjorde med sök-formuläret, men nu gör vi INSERT istället för SELECT och det blir lite större omfattning av kod.

Så här blev det för mig.

Först formuläret som skall fyllas i.

[FIGURE src=/image/snapvt15/pdo-insert-form.png?w=w2 caption="Ett formulär för att fylla i för att lägga till en båt i databasen."]

Sedan resultatsidan som visar att allt gick bra.

[FIGURE src=/image/snapvt15/pdo-insert-success.png?w=w2 caption="Processingsidan visar att allt gick bra."]

Du kan [testköra mitt skript på dbwebb](htmlphp/repo/example/pdo-sqlite/insert.php) och du kan [se källkoden på GitHub](https://github.com/mosbth/htmlphp/blob/master/example/pdo-sqlite/insert.php).

Låt oss titta på koden som skiljer sig från tidigare exempel.

Först tittar vi på koden för formuläret. Egentligen är det inget speciellt med det, ett vanligt formulär som postas till en processingsida.

```html
<form method="post" action="insert-process.php">
    <fieldset>
        <legend>Add boat</legend>
        <p><label>jettyPosition<br><input type="number" name="jettyPosition"></label></p>
        <p><label>boatType<br><input type="text" name="boatType"></label></p>
        <p><label>boatEngine<br><input type="text" name="boatEngine"></label></p>
        <p><label>boatLength<br><input type="number" name="boatLength"></label></p>
        <p><label>boatWidth<br><input type="number" name="boatWidth"></label></p>
        <p><label>ownerName<br><input type="text" name="ownerName"></label></p>
        <p><input type="submit" name="add" value="Add"></p>
    </fieldset>
</form>
```

När formuläret postas så tar processingsidan över. Först läses innehållet i det postade formuläret över till variabler.

```php
<?php
// Check if form posted and get incoming
if (isset($_POST['add'])) {
    // Store posted form in parameter array
    $jettyPosition  = $_POST['jettyPosition'];
    $boatType       = $_POST['boatType'];
    $boatEngine     = $_POST['boatEngine'];
    $boatLength     = $_POST['boatLength'];
    $boatWidth      = $_POST['boatWidth'];
    $ownerName      = $_POST['ownerName'];
```

Här har man nu möjligheten att dubbelkolla om värdena är i rätt värdemängd och datatyp. Det kan vara viktigt för att undvika problem när man väl gör INSERT-satsen till databasen. Man vill undvika fel i själva databasfrågan så det är bättre att testa innan, och ge bra och tydliga felmeddelanden till användaren.

Men, just nu hoppar vi över det steget.

När vi har alla variablerna på plats så kan vi skapa `$params` och göra prepare på SQL-frågan.

```php
$params = [$jettyPosition, $boatType, $boatEngine, $boatLength, $boatWidth, $ownerName];

// Connect to the database
// ...code to connect...

// Prepare SQL statement to INSERT new rows into table
$sql = "INSERT INTO Jetty VALUES(?, ?, ?, ?, ?, ?)";
$stmt = $db->prepare($sql);
```

Nu är vi redo att köra SQL-satsen för INSERT, med `$params` som parametrar. Jag väljer att köra den inom ramen för en try-catch. Om något går fel i try-blocket så tar catch-blocket över och jag kan skriva ut lite debug- och felmeddelanden. Denna hantering kallas exception och finns i många programmeringsspråk. Läs kort om [exceptions i PHP](http://php.net/manual/en/language.exceptions.php).

```php
// Execute the SQL to INSERT within a try-catch to catch any errors.
try {
    $stmt->execute($params);
} catch (PDOException $e) {
    echo "<p>Failed to insert a new row, dumping details for debug.</p>";
    echo "<p>Incoming \$_POST:<pre>" . print_r($_POST, true) . "</pre>";
    echo "<p>The error code: " . $stmt->errorCode();
    echo "<p>The error message:<pre>" . print_r($stmt->errorInfo(), true) . "</pre>";
    throw $e;
}
```

I nästkommande kapitel visas lite mer information om vad som händer när det går fel, så jag tar inte upp det nu.

En annan sak som är viktig att påpeka är att jag ändrade utskriften i tabellen. Jag har nu ingen kontroll över vad användaren lägger in för innehåll i tabellen, kanske lägger de in både HTML-kod och JavaScript och det vill jag inte ska exekveras av misstag. Därför använder jag funktionen `htmlentities()` när jag skriver ut resultatet till webbsidan. Så här.

```php
// Loop through the array and gather the data into table rows
$rows = null;
foreach ($res as $row) {
    $rows .= "<tr>";
    $rows .= "<td>" . htmlentities($row['jettyPosition']) . "</td>";
    $rows .= "<td>" . htmlentities($row['boatType']) . "</td>";
    $rows .= "<td>" . htmlentities($row['boatEngine']) . "</td>";
    $rows .= "<td>" . htmlentities($row['boatLength']) . "</td>";
    $rows .= "<td>" . htmlentities($row['boatWidth']) . "</td>";
    $rows .= "<td>" . htmlentities($row['ownerName']) . "</td>";
    $rows .= "</tr>\n";
}
```

Det finns ingen enkel guide till det här med säker programmering i webbmiljö. Eller jo, en första guideline kan vi utlysa.

> *"Lita aldrig på det som användaren kan mata in i din webbplats. Oavsett om det är ett formulär eller någon del i HTTP-headern. Lita aldrig på användaren."*

Principen som jag använder i exemplet är att spara allt i databasen som användaren skriver in. Men när jag skriver ut det till webbsidan så använder jag `htmlentities()`. Det är den taktiken jag brukar använda. 

Men man borde också kontrollera att användaren postar rätt typ av information. Till exempel så skall båtens id vara en siffra. Det borde man kontrollera. Men vi hoppar över det nu.

Låt oss istället ta lite mer om fel vid INSERT.



Felhantering vid INSERT {#insert-fail}
--------------------------------------

Om det går fel vid INSERT så visas ett felmeddelande och utskrifter från ett antal funktioner som underlättar att felsöka i vad som gick fel.

Till exempel så här.

> *Fatal error: Uncaught exception 'PDOException' with message 'SQLSTATE[23000]: Integrity constraint violation: 19 UNIQUE constraint failed: Jetty.jettyPosition' in /home/mos/git/htmlphp/example/pdo-sqlite/insert-process.php on line 41*

Så här blir det när man försöker lägga in en båt med ett id som redan finns. Id:et är unikt i databasen. Det sa vi när vi skapade tabellen. 

```sql
"jettyPosition" INTEGER PRIMARY KEY  NOT NULL  UNIQUE, 
```

Felmeddelandet visas tillsammans med ett par extra utskrifter.

[FIGURE src=/image/snapvt15/pdo-insert-fail.png?w=w2 caption="Felmeddelande visas som säger att en båt med id 1 redan finns."]

Tanken är inte att användaren skall se detta. Skriptet bör hantera alla felsituationer och ge enkla och tydliga felmeddelanden till användaren. Det kan alltså bli en hel del kod kring att hantera inmatning från användaren. 



Uppdatera värden och rader i tabellen med UPDATE {#update}
--------------------------------------

En annan vanlig företeelse i en webbapplikation är möjligheten att uppdatera vissa värden i en viss rad. Vi gör ett nytt skript, `update.php`, som ger möjligheten att välja en viss rad och sedan spara dess värden.

Innan du kör igång så kan du kort titta på [SQL-satsen UPDATE på www.sqlite.org](http://www.sqlite.org/lang_update.html).

I mitt exempel så lägger jag till en länk i tabellen, om man klickar på den så visas båtens värden i formuläret. Därefter kan man ändra alla värden och spara dem. Skriptet använder en mix av POST och GET. POST används för att posta formuläret och spara värden om båten. GET används för att visa värden om en speciell båt.

Så här blev det för mig.

[FIGURE src=/image/snapvt15/pdo-update-list.png?w=w2 caption="Formuläret tomt, jag måste klicka på ett id."]

[FIGURE src=/image/snapvt15/pdo-update-edit.png?w=w2 caption="Formuläret ifylld med data."]

[FIGURE src=/image/snapvt15/pdo-update-save.png?w=w2 caption="Det gick bra att spara till databasen."]

Du kan [testköra mitt skript på dbwebb](htmlphp/repo/example/pdo-sqlite/update.php) och du kan [se källkoden på GitHub](https://github.com/mosbth/htmlphp/blob/master/example/pdo-sqlite/update.php).

Så vad skiljer från tidigare skript?

Skriptet `update.php` har ett litet annorlunda flöde. Dels visar det en sida om man anropar med argument och en sida om man anropar utan. Agrumentet i detta fallet är värdet på `jettyPosition`.

Om länken innehåller `update.php?jettyPosition=4` så börjar skriptet med att hämta alla detaljer om båten. Detaljerna används sedan för att fylla i formuläret.

Först hanteringen i PHP som läser från databasen.

```php
//
// Check if script was accessed using specific jettyPosition
// as in update?jettyPosition=2
//
$jettyPosition = isset($_GET['jettyPosition'])
    ? $_GET['jettyPosition']
    : null;

$boatType = null;
$boatEngine = null;
$boatLength = null;
$boatWidth = null;
$ownerName = null;

if ($jettyPosition) {
    // Get details on the boat using specified jettyPosition
    $sql = "SELECT * FROM Jetty WHERE jettyPosition = ?";
    $stmt = $db->prepare($sql);
    $params = [$jettyPosition];
    $stmt->execute($params);

    // Get the results as an array with column names as array keys
    $res = $stmt->fetchAll(PDO::FETCH_BOTH);
    
    if (empty($res)) {
        die("No such jettyPosition.");
    }
    
    // Move content of array to individual variables, for ease of use.
    list($jettyPosition, $boatType, $boatEngine, $boatLength, $boatWidth, $ownerName) = $res[0];
}
```

Därefter så används variablerna för att fylla i formulärets fält.

```php
<form method="post" action="update-process.php">
    <fieldset>
        <legend>Update boat</legend>
        <p><label>jettyPosition<br><input type="number" name="jettyPosition" value="<?=$jettyPosition?>" readonly></label></p>
        <p><label>boatType<br><input type="text" name="boatType" value="<?=$boatType?>"></label></p>
        <p><label>boatEngine<br><input type="text" name="boatEngine" value="<?=$boatEngine?>"></label></p>
        <p><label>boatLength<br><input type="number" name="boatLength" value="<?=$boatLength?>"></label></p>
        <p><label>boatWidth<br><input type="number" name="boatWidth" value="<?=$boatWidth?>"></label></p>
        <p><label>ownerName<br><input type="text" name="ownerName" value="<?=$ownerName?>"></label></p>
        <p><input type="submit" name="save" value="Save"></p>
    </fieldset>
</form>
```

Därefter är det som vanligt. Det finns en `update-process.php` och den är i stort sett likadan som `insert-process.php`. Det som skiljer är SQL utrycket.

```php
// Prepare SQL statement to UPDATE a row in the table
$sql = <<<EOD
UPDATE Jetty 
SET
    boatType = ?,
    boatEngine = ?,
    boatLength = ?,
    boatWidth = ?,
    ownerName = ?
WHERE
    jettyPosition = ?
EOD;
$stmt = $db->prepare($sql);
```

Har du tänkt på en sak? Här finns kodrader att spara, ser du det? Här finns möjligheter för att använda funktioner för att strukturera koden, istället för att göra copy-paste som jag valt att göra i exempelkoden. 



Ta bort rader i tabellen med DELETE {#delete}
--------------------------------------

Slutligen skall vi då skapa en hantering för att ta bort en rad ur tabellen. 

Först kan du kort läsa om [SQL-satsen DELETE på www.sqlite.org](http://www.sqlite.org/lang_delete.html).

Det får bli ett nytt skript, `delete.php` och `delete-process.php`. Vi lägger till en knapp "Delete" och kod för att radera båten. Användaren väljer först en båt och därefter kan båten rades med ett klick på knappen. 

Så här blev det för mig.

[FIGURE src=/image/snapvt15/pdo-delete-list.png?w=w2 caption="Först måste jag välja en båt att radera."]

[FIGURE src=/image/snapvt15/pdo-delete-submit.png?w=w2 caption="En båt är vald, klicka på knappen för att radera båten."]

[FIGURE src=/image/snapvt15/pdo-delete-done.png?w=w2 caption="Det gick bra att radera raden från databasen."]

Du kan [testköra mitt skript på dbwebb](htmlphp/repo/example/pdo-sqlite/delete.php) och du kan [se källkoden på GitHub](https://github.com/mosbth/htmlphp/blob/master/example/pdo-sqlite/delete.php).

Så vad skiljer från tidigare skript?

Till att börja med så är det hanteringen för att välja båt för att radera, detta sker i början av skriptet.

```php
<?php
//
// Check if script was accessed using specific jettyPosition
// as in ?jettyPosition=2
//
$jettyPosition = isset($_GET['jettyPosition'])
    ? $_GET['jettyPosition']
    : null;

if ($jettyPosition) {
    echo <<<EOD
<form method="post" action="delete-process.php">
    <fieldset>
        <legend>Delete boat</legend>
        <p><label>jettyPosition<br><input type="number" name="jettyPosition" value="$jettyPosition" readonly></label></p>
        <p><input type="submit" name="delete" value="Delete"></p>
    </fieldset>
</form>
EOD;
} else {
    echo "<p><strong>Select a boat to delete.</strong></p>";
}
```

Sen är det så klart SQL-koden för att radera raden ur tabellen, men det är mindre ändringar i process-skriptet.

```php
// Prepare SQL statement to DELETE a row in the table
$sql = <<<EOD
DELETE FROM Jetty 
WHERE
    jettyPosition = ?
EOD;
$stmt = $db->prepare($sql);
```

Som du märker så är det inte så mycket som skiljer mellan de olika processingskripten, de är rätt lika i sin kod och struktur.



CRUD {#crud}
--------------------------------------

Vad vi har gjort nu är de vanliga CRUD-operationerna som sker i databasapplikationer såsom i administrativa system och andra platser där man hanterar data. Det handlar om att lägga till, uppdatera och redigera datat. Create, read, update, delete -- populärt kallat för [CRUD](https://en.wikipedia.org/wiki/Create,_read,_update_and_delete).



Strukturera din kod {#strukturera}
--------------------------------------

Exempelprogrammen innehåller mycket upprepad kod. Det är för att du skall se exakt vilken kod som används i varje steg. Men, nu när allt är på plats så ser du kod som är copy-paste och duplicerad kod. Det är inte DRY.

Ett nästa steg vore att ta koden du nu sett, och arrangera den i funktioner så att den blir enklare att återanvända. Lite mer DRY.

Saker som är uppenbara kandidater för kodstrukturering är till exempel namnet på databasen, det borde ligga i en konfigurationsfil. Du borde också ha en funktion som öppnar databasen och hanterar eventuella fel relaterat till öppningen.

Om du hade en funktion som skrev ut tabellens innehål i en HTML-tabell, så hade det helt klart förbättrat kodstrukturen.

Själva processingskriptet kan du förbättra. En tanke är att samla både insert, update och delete i ett processingskript. Det hade fungerat. Men det går även ha de separerade som de är nu.

Man kan också fundera över flödet i skripten, när saker händer och sker. Kanske finns det ett sätt att organisera koden så att skripten ser mer lika ut. Nu är PHP-kod blandad med HTML-kod. Det är okey, men det finns bättre strukturer och vissa av dessa strukturerna är föremål i fördjupade studier så de tar vi inte upp nu.

Som du märker så finns det förbättringspotential och det är bäst att strukturera koden så den blir enklare att återanvända. Annars hamnar man snabbt i en sits där koden växer en över huvudet, det blir för stort och för svårt att uppdatera och vidarutveckla.

När koden växer, se alltid till att prioritera viss ordning och kodstruktur. Det vinner du på i längden.



Avslutningsvis {#avslutning}
--------------------------------------

Det var en introduktion till PDO tillsammans med SQLite och en genomgång i hur man med PHP-kod löser CRUD-operationer. Som du förstår så är detta grunden i många webbapplikationer.

De manualer du har mest nytta av, i längden, är [PHP manualen för PDO](http://php.net/manual/en/book.pdo.php) och [manualen för SQLite](http://www.sqlite.org/docs.html).

Fråga gärna i forumet, det finns en [egen tråd om denna artikel](t/4314).

Tänk på att nästa databas du lär dig, till exempel MySQL, också använder sig av PDO. Det blir då enkelt att komma in i hur det skall fungera, eftersom du nu kan grunderna i PHP PDO och i SQL. Att använda ett gemensamt gränsnitt likt PHP PDO kan ha sina fördelar.




