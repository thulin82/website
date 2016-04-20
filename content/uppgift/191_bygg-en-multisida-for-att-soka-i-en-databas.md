---
author: mos
category: kursnyheter
revision:
  "2015-06-15": (A, mos) Första utgåvan i samband med kursen htmlphp v2.
updated: "2015-06-15 08:01:57"
created: "2015-06-15 08:01:04"
...
Bygg en multisida för att söka i en databas
==================================

Skriv en multisida i PHP för att visa hur kopplingar till databasen SQLite fungerar.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du vet vad en [multisida i PHP](kunskap/bygg-en-multisida-med-php) är.

Du har jobbat igenom övningen "[Kom igång med databasen SQLite](kunskap/kom-igang-med-databasen-sqlite)". 

Du har gått igenom de första stegen i artikeln "[Kom igång med SQLite och PHP PDO](kunskap/kom-igang-med-sqlite-och-php-pdo)", minst till och med stycket "[Gör ett sökformulär med SELECT](kunskap/kom-igang-med-sqlite-och-php-pdo#select-form)".



Introduktion {#intro}
-----------------------

Du skall skapa en multisida som kopplar upp sig mot databasen SQLite samt utför SELECT-frågor mot databasen och visar resultatet.

I kursrepot finns exempelprogram som du kan utgå ifrån. Dels finns det i [`example/sqlite`](https://github.com/mosbth/htmlphp/tree/master/example/sqlite) och dels i [`pdo-sqlite`](https://github.com/mosbth/htmlphp/tree/master/example/pdo-sqlite).

Spara din multisida i ditt kursrepo under katalogen `me/kmom05/jetty`.

Dina SQLite-filer lägger du i katalogen `me/kmom05/jetty/db`. 

Börja med att kopiera [databasfilen jetty.sqlite](https://github.com/mosbth/htmlphp/tree/master/example/pdo-sqlite/db), så har du en databas som du kan använda i uppgiften.



Krav {#krav}
-----------------------

1. Skapa grunden för en multisida, döp själva multisidan till `jetty.php`.

1. Skapa en undersida som kopplar sig till databasen. Om det gick bra så visas ett meddelande som säger "Ok".

1. Skapa en undersida som försöker koppla sig till databasen, fast med en felaktig sökväg. Ett felmedelande skall visas.

1. Lägg koden som kopplar sig till databasen i en funktion `connectToDatabase()`. Sökvägen till databasen skall skickas som en parameter till funktionen. Funktionen skall returnera databasobjektet `$db`. Funktionen skall ligga i en fil, `database-functions.php`, skapa den filen. Skriv om koden för de två kraven ovan, så de använder funktionen.

Funktionshuvudet kan se ut så här.

```php
/**
 * Open the database file and catch the exception it it fails,
 * add an explanation and re-throw the exception.
 *
 * @param string $dsn the DSN for the database to connect to.
 *
 * @return PDO as the database connection.
 */
function connectToDatabase($dsn)
{
    // the code
}
```

5\. Skapa en undersida som skriver ut innehållet i tabellen `Jetty` i en HTML tabell.

6\. Skapa en undersida där man kan söka efter båtar, [likt exemplet](kunskap/kom-igang-med-sqlite-och-php-pdo#select-form). 

7\. Skapa en funktion `printJettyResultsetToHTMLTable()` i `database-functions.php`. Funktionen skall ta *resultsetet*, `$res`, som en inparameter och skriva ut innehållet i `$res` till en HTML-tabell. Resultatet blir en funktion, som du kan använda för att lösa de två föregående kraven. Strukturera om dem så att de använder funktionen. 

```php
/**
 * Print a HTML table from a resultset doing SELECT * in a table Jetty.
 *
 * @param [] $res the resultset from the query.
 *
 * @return void
 */
function printJettyResultsetToHTMLTable($res)
{
    // the code
}
```

8\. Validera och publicera din kod enligt följande.

```bash
# Ställ dig i kursrepot
#dbwebb validate jetty
dbwebb publish jetty
```

Rätta eventuella fel som dyker upp och publicera igen. När det ser grönt ut så är du klar. 



Extrauppgift {#extra}
-----------------------

Det finns inga extra uppgifter.



Tips från coachen {#tips}
-----------------------

Lycka till och hojta till i forumet om du behöver hjälp!




