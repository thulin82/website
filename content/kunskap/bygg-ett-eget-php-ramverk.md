---
author: mos
category:
    - anax
    - php
    - kursen oophp
revision:
    "2017-02-27": (A, mos) Första utgåvan.
...
Bygg ett eget PHP-ramverk
==================================

[FIGURE src=/image/snapvt17/promise.png?w=c5&a=0,70,0,0&cf class="right"]

Låt oss bygga ett PHP ramverk från grunden. Inte för avancerat. Inte för simpelt. Det skall vara ett ramverk som erbjuder de vanliga tjänsterna som vi förväntar oss från ett ramverk, samtidigt skall det vara enkelt och inte fullt med features som inte används.

Frågna är vad som är grunden, kärnan, i ett sådant PHP ramverk, minsta möjliga kod som man känner sig att ha full kontroll över, samtidigt som det är utbyggbart vid behov.

Hur svårt kan det vara?

<!--more-->



Förutsättning {#pre}
--------------------------------------

Du har goda kunskaper i HTML, CSS och PHP. Du har använt ramverk så du har en grov känsla av vad du kan förvänta dig för tjänster av ramverket.

Du har tillgång till dbwebb-cli.

Min kod är sparad i repot `[canax/anax-lite](https://github.com/canax/request)`.

Viss extra kod kan finnas tillgänglig i [kursrepo för oophp-kursen]().

När jag jobbar igenom artikeln så utgår jag från kursrepots me-katalog. Min anax-lite ligger alltså i `me/anax-lite`.



Ett repo {#repo}
--------------------------------------

Jag börjar med att skapa ett lokalt repo i Git och laddar upp det på GitHub där jag skapat ett motsvarande repo på `canax/anax-lite`.

Jag gjorde på följande sätt, men huvudsaken är att du skapar ditt eget repo.

```bash
$ mkdir anax-lite
$ cd anax-lite
$ touch README.md LICENSE.txt REVISION.md
$ git init
$ git add .
$ git commit -a -m "First commit"
$ git remote add origin git@github.com:canax/anax-lite.git
$ git push -u origin master
```

Ditt remote add origin är naturligtvis en länk som går till ditt egna GitHub repo.

Bra, ett repo är alltid en bra start.

Det ser ut ungefär så här nu, [första committen](https://github.com/canax/anax-lite/tree/f377e08c1efc95f5cc562adc0d1e981813999e7f), inte mycket, men mer skall det bli.



En frontcontroller {#frontcontroller}
--------------------------------------

Vi behöver en index-sida som vi kan bygga ut till en frontcontroller. Tanken är att denna sidan tar han om samtliga requester som kommer. En sida för att fånga alla requester.

```bash
$ mkdir htdocs
$ echo '<?php echo "I wanna be a frontcontroller!";' > htdocs/index.php
```

Du kan göra en `dbwebb publish` och testa din sida. Testa den även lokalt, via din lokala webbserver. Det känns ju bra att veta att det fungerar så här långt.



Alla frågor till frontcontrollern med htaccess {#htaccess}
--------------------------------------

Nu vill vi att oavsett vilken route som används så skall den hamna i index.php och det löser vi med en rewrite regel i `.htaccess`.

Normalt kan en sådan .htaccess se ut så här.

```text
RewriteEngine on

# Rewrite to Anax frontcontroller
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule (.*) index.php/$1 [NC,L]
```

I kursrepot finns det två exempel på htaccess-filer. En som fungerar lokalt och en som fungerar både lokalt och på studentservern.

Du kan kopiera in dem till anax-lite från kursrepots exempelfiler.

```bash
# Du står i me/anax-lite
$ cp ../../example/anax-lite/htdocs/.htaccess* htdocs
```

Du kan använda den som heter `.htaccess_wwwstudent` men missa inte att gå in i filen och byta ut `mosstud` mot din egen studentanvändare.

```bash
$ cd htdocs
$ ln -s .htaccess_wwwstudent .htaccess
$ ls -l .htaccess*
lrwxrwxrwx 1 mos mos   20 Mar  2 16:33 .htaccess -> .htaccess_wwwstudent
-rw-r--r-- 1 mos mos  383 Mar  2 16:32 .htaccess_anax
-rw-r--r-- 1 mos mos 1.2K Mar  2 16:32 .htaccess_wwwstudent
```

Gör en `dbwebb publish` och kontrollera att oavsett vilken underlänk du skriver in så hamnar du i din frontkontroller.

För min del så testade jag följande länkar och alla ledde mig till samma svar från frontkontrollern.

```text
oophp/me/anax-lite/htdocs/
oophp/me/anax-lite/htdocs/moped
oophp/me/anax-lite/htdocs/mumintrollet/bor/i/muminhuset
```

Då behöver vi skapa lite intelligens i frontkontrollern.



En klass för request {#request}
--------------------------------------

En request som kommer till frontkontrollern innehåller information om vilken resurs som efterfrågas. Det är typ av request (HEAD, POST, GET, PUT, mfl), routen som önskas och detaljer om server och port.

Det behövs kod som extraherar informationen från själva requesten. Det är det allra första som behövs.

Ett ramverk löser ofta detta med en klass `Request` och i vårt fall så rundar vi ett hörn och återanvänder en klass som redan är skriven för detta syfte.

Klassen `[anax/request](https://packagist.org/packages/anax/request)` finns på Packagist och vi installerar den till anax-lite med pakethanteraren composer. 

```bash
$ composer require anax/request
```

Modulen installeras under katalogen `vendor/anax/request`. Du kan kika kort på källkoden i modulen.

Låt mig nu visa hur du använder modulen.



Visa alla felmeddelanden {#visafel}
--------------------------------------

Innan vi använder modulen så sätter vi på så att alla felmeddelanden visas. Det blir enklare att felsöka på det viset.

I kursrepot finns en exempelfil `example/anax-lite/config/error_reportin.php` som visar hur vi sätter på felmeddelanden.

Den ser ut så här.

```php
/**
 * Set the error reporting.
 */
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors

/**
 * Default exception handler.
 */
set_exception_handler(function ($e) {
    echo "Anax: Uncaught exception: <p>"
        . $e->getMessage()
        . "</p><p>Code: "
        . $e->getCode()
        . "</p><pre>"
        . $e->getTraceAsString()
        . "</pre>";
});
```

Du kan ta en kopia av den filen och lägga in i ditt Anax.

```bash
# Du står i me/anax-lite
$ mkdir config
$ cp ../../example/anax-lite/config/error_reporting.php config
```

Bra, då är vi redo att börja använda modulen för request.



Använda modulen anax/request {#request}
--------------------------------------

Vi använder modulen i frontkontrollern. Vi låter den bara skriva ut all information som den tagit hand om, bara för att se hur den fungerar.

Uppdatera din frontkontroller med följande kod.

```php
/**
 * Bootstrap the framework.
 */
// Were are all the files?
define("ANAX_INSTALL_PATH", realpath(__DIR__ . "/.."));

// Include essentials
require ANAX_INSTALL_PATH . "/config/error_reporting.php";

// Get the autoloader by using composers version.
require ANAX_INSTALL_PATH . "/vendor/autoload.php";

// Create and use an object of the request class.
$request = new \Anax\Request\RequestBasic();
$request->init();
var_dump($request);

echo "Done";
```

Den första delen *bootstrappar* ramverket med grunden som behövs för att saker skall fungera. Sedan skapas en instans av request-klassen, den initieras och skrivs ut.

Studera informationen som skrivs ut och se vilka delar av requesten som sparas undan.

Nu har vi all koll på inkommande request.

Men hur skall vi använda den informationen?



Skapa länkar {#url}
--------------------------------------

Jo, en vanlig problemställning i ett ramverk är hur man skapar länkarna. För att det skall fungera smärtfritt så överlåter man åt ramverkets funktioner hur länkar skapas. Då kan ramverket ta hänsyn till var det finns installerat och skapa länkar som matchar installationen.



###Modulen anax/url {#anaxurl}

Att skapa länkar på "rätt sätt", är inte trivialt så jag väljer att låna en klass som redan löst detta, `anax\url`, en ny modul alltså.

```bash
$ composer require anax/url
```

Då ligger modulen i vendor katalogen, redo att användas. Vi fick även med en extra modul `anax/common` som används av `anax/url`. Det är en modul som återanvänds av flera komponenter i anax.



###Konfigurera modulen url {#configurl}

Modulen kan generera länkar på två sätt, antingen `index.php/this/route` eller `this/route`. Det är en konfigurering av klassen som måste till.

Dessutom är klassen beroende av request-klassen, url-klassen behöver initieras med information om själva requesten. Det är för att länkarna skall skapas på rätt sätt.

Vi har redan en katalog `config` så jag väljer att lägga den konfiguration som behövs där.

En konfiguration av url-modulen kan se ut så här.

```php
/**
 * Config file for url.
 */
return [
    // Defaults to use when creating urls.
    //"siteUrl"       => null,
    //"baseUrl"       => null,
    //"staticSiteUrl" => null,
    //"staticBaseUrl" => null,
    //"scriptName"    => null,
    //"urlType"       => self::URL_CLEAN,
    "urlType"       => self::URL_APPEND,
];
```

Det finns en exempelfil `example/anax-lite/config/route.php` i kursrepot som du kan utgå ifrån.

```bash
# Du står i me/anax-lite
$ cp ../../example/anax-lite/config/url.php config
```

Tanken är att man lyfter ut saker som kan konfigureras till egna filer och samlar dem på en plats. 



###Initiera modulen url {#initurl}

Då tar vi och uppdaterar frontkontrollern med kod som dels initierar modulen url och dels använder den för att skapa länkar.

Lägg till följande i slutet av din frontkontroller.

```php
// Create and init an instance of url.
$url = new \Anax\Url\Url();

// Set default values from the request object.
$url->setSiteUrl($request->getSiteUrl());
$url->setBaseUrl($request->getBaseUrl());
$url->setStaticSiteUrl($request->getSiteUrl());
$url->setStaticBaseUrl($request->getBaseUrl());
$url->setScriptName($request->getScriptName());

// Update url configuration with values from config file.
$url->configure("url.php");
$url->setDefaultsFromConfiguration();
```

Koden skapar en instans av url-klassen. Sedan används informationen från request-objektet för att sätta en del nödvändig grundinformation.

I slutet läses konfigurationsfilen in, man kan alltså förändra konfigurationen av hur länkar skapas genom att justera konfigfilen.



###Testa modulen url{#testurl}

Nu kan vi testa modulen genom att skapa länkar och se resultatet.

Lägg till följande i slutet av din frontkontroller.

```php
// Create some urls.
$aUrl = $url->create("");
echo "<p><a href='$aUrl'>The index url, home</a> ($aUrl)";

$aUrl = $url->create("some/route");
echo "<p><a href='$aUrl'>Url to some/route</a> ($aUrl)";

$aUrl = $url->create("some/where/some/route");
echo "<p><a href='$aUrl'>Another url to some/where/some/route</a> ($aUrl)";
```

Koden använder modulen url för att skapa länkar. klicka på länkarna och se att de alla leder in i frontkontrollern.

Pröva nu att gå in i konfigfilen för url, `config/url.php`, och ändra så att snygga länkar skapas via `URL_CLEAN`.

Du bör se skillnaden i länkarna att skriptnamnet försvinner, de blir lite snyggare.

Klicka på de snygga länkarna och se att de alla leder till frontkontrollern.

Du kan se hur request-modulen hanterar inkommande route och finner den del som är själva "routen".

Det verkar som modulerna fungerar ihop.

En request- och en url-modul, en bra start. Men vad är härnäst, om vi vill bygga en webbapplikation med vårt ramverk?



En router {#router}
--------------------------------------

En router är en vanlig komponent i ramverk. Den behövs för att vi skall kunna utföra olika svar på olika inkommande routes.

Det kan se ut så här, när man strukturerar koden med en router.

```php
$router->add("home", function() {
    // Provide a response matching home url
});

$router->add("about/me", function() {
    // Provide a response matching about/me url
});
```

En router är beroende av modulen request för att få information om själva routen.

Tanken är att man lagrar undan callbacks till alla de routes som skall hanteras. Lite som en container av routes. Sedan när man vill behandla requesten så kollar man vilka routes som finns och om någon matchar så används dess callback för att leverera själva svaret, responset.



###Modul för router {#modulrouter}

Att bygga en router låter som ett större projekt så jag tar och lånar en modul `anax/router` som redan finns.

```bash
$ composer require anax/router
```

Bra, då har vi även en router på plats i vendor-katalogen.






Makefile {#makefile}
--------------------------------------




Avslutningsvis {#avslutning}
--------------------------------------

Du har nu fått en snabb introduktion i hur konstruktionen Promise kan användas för att skapa sekventiell exekvering av asynkron kod.

Denna artikel har en [egen forumtråd](t/6276) som du kan ställa frågor i, eller ge tips.
