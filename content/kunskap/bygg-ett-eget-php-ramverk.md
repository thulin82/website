make ---
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

Bra, då har vi även en router på plats i vendor-katalogen. Kika gärna på dess källkod. Du kan se att det finns en klass för routern och en klass för routes.



###Testa routern {#testrouter}

Vi kan nu testa routern. Först skapar vi en fil där vi samlar alla de routes vi vill ha. Filen får ligga i `config/routes.php`.

```php
<?php
/**
 * Routes.
 */
$router->add("", function () {
    echo <<<EOD
<!doctype html>
<meta charset="utf-8">
<title>Home</title>
<h1>Home</h1>
<p>This is the homepage.</p>
EOD;
});

$router->add("about", function () {
    echo <<<EOD
<!doctype html>
<meta charset="utf-8">
<title>About</title>
<h1>About</h1>
<p>This is the page about me.</p>
EOD;
});

$router->addInternal("404", function () {
    echo <<<EOD
<!doctype html>
<meta charset="utf-8">
<title>404</title>
<h1>404 Not Found</h1>
<p>The route could not be found!</p>
EOD;
});
```

Det är två routes som returnerar varsin HTML-sida. Den sista routen är en intern route som används för felhantering när en route inte kan hittas. Den interna routen kan inte nås från webbläsaren, den är intern för routern.

För att detta nu skall fungera så behöver vi skapa `$router` i vår frontkontroller och därefter inkludera filen med alla routes.

Det sista vi gör är att överlåta till routern att hanterera och matcha inkommande route (request) mot de routes som finns.

```php
// Create the router
$router = new \Anax\Route\RouterInjectable();

// Load the routes
require ANAX_INSTALL_PATH . "/config/route.php";

// Leave to router to match incoming request to routes
$router->handle($request->getRoute());
```

Nu kan du pröva olika routes mot din frontkontroller och se olika svar. Du har två routes som fungerar "" och "about", alla andra resulterar i att den interna routen för 404 visas.

Det närmar sig.



Ett app-objekt {#app}
--------------------------------------

Det börjar bli en del kod och det är lika bra att städa lite.

Jag tar bort alla utskrifter från frontkontrollern så att den utskrift som kommer blir från routens hanterare.

Sen ser jag ett behov av att samla alla resurser i ramverket inom ett objekt som kan skickas runt. Till exempel så vill jag skapa länkar i routens hanterare som då behöver känna igen `$url`.

Det få bli ett `$app` som samlar alla ramverkets resurser.



###En egen src-katalog {#src}

Jag tar och skapar en katalog `src/App` och lägger där klassfilen `App.php` med följande innehåll.

```php
<?php 
/**
 * An App class to wrap the resources of the framework.
 */

namespace Anax\App;

class App
{
    
}
```

Den innehåller inte så mycket. Men det gör inget, vi skall snart fylla den.

Noter att det står namespace `Anax\App`, jag tänker byta det till `Mos\App` för att visa att jag (Mos) är den vendor som skapat källkoden under src. Du hittar på ditt eget vendor-namn, det får bli ditt eget varumärke.



###Autoloader för egen kod {#autoegen}

All kod som ligger i vendor-katalogen sköts av composers autolaoder. Mycket smidigt och nu vill vi använda composers autoloader till att även göra autoloading av vår egen källkod som vi nu lägger i katalogen `src`.

För tillfället ser den av composer automatgenererade filen `composer.json` ut ungefär så här.

```json
{                                
    "require": {                 
        "anax/request": "^1.0",  
        "anax/url": "^1.0",      
        "anax/router": "^1.0"    
    }                            
}                                
```

Uppdatera nu `composer.json` med information om ditt egen namespace och koppla det till all källkod som ligger under src-katalogen.

Så här.

```json
{
    "name": "mos/anax-lite",
    "description": "A small PHP framework.",
    "license": "MIT",
    "authors": [
            {
                "name": "Mikael Roos",
                "email": "mos@dbwebb.se"
            }
    ],
    "require": {
        "anax/request": "^1.0",
        "anax/url": "^1.0",
        "anax/router": "^1.0"
    },
    "autoload": {
        "psr-4": {"Mos\\": "src/"}
    }
}
```

Som sagt så är Mos mitt namespace och du byter ut det mot ditt egna. Byt även ut allt annat som är kopplat till mos, så att det blir din egna kod. 

När det är klart så låter du composer validera konfig-filen och sen dumpar vi ut den uppdaterade autoloadern.

```bash
$ composer validate
$ composer update
```

Nu kan vi använda composers autoloader för vår egen kod.



###Skapa $app {#createapp}

Källkoden för klassen App ligger nu i `src/App/App.php`, den har ett namespace som är `Mos\App` och du har bytt ut Mos mot din egen valfria vendor-akronym. Via `composer.json` så kopplas composers autoloader mitt namespace till min källkodsfil.
 
I slutet av frontkontrollern kan vi skapa `$app` och fylla den med de resurser som ramverket har tillgång till.

```php
// Add all resources to $app
$app = new \Mos\App\App();
$app->request = $request;
$app->url     = $url;
$app->router  = $router;
```

Bra, lite ordning och reda bland klasserna.



###Städa frontkontrollern {#stada}

Nu har jag en salig blandning av hur jag använder klasserna i frontkontrollern. Jag tänker nu städa upp och enbart använda klasserna utifrån mitt objekt `$app`. 

Efter städningen ser nu min frontkontroller ut så här.

```php
<?php
/**
 * Bootstrap the framework.
 */
// Were are all the files?
define("ANAX_INSTALL_PATH", realpath(__DIR__ . "/.."));
define("ANAX_APP_PATH", ANAX_INSTALL_PATH);

// Include essentials
require ANAX_INSTALL_PATH . "/config/error_reporting.php";

// Get the autoloader by using composers version.
require ANAX_INSTALL_PATH . "/vendor/autoload.php";

// Add all resources to $app
$app = new \Mos\App\App();
$app->request = new \Anax\Request\RequestBasic();
$app->url     = new \Anax\Url\Url();
$app->router  = new \Anax\Route\RouterInjectable();

// Init the object of the request class.
$app->request->init();

// Init the url-object with default values from the request object.
$app->url->setSiteUrl($app->request->getSiteUrl());
$app->url->setBaseUrl($app->request->getBaseUrl());
$app->url->setStaticSiteUrl($app->request->getSiteUrl());
$app->url->setStaticBaseUrl($app->request->getBaseUrl());
$app->url->setScriptName($app->request->getScriptName());

// Update url configuration with values from config file.
$app->url->configure("url.php");
$app->url->setDefaultsFromConfiguration();

// Load the routes
require ANAX_INSTALL_PATH . "/config/route.php";

// Leave to router to match incoming request to routes
$app->router->handle($app->request->getRoute());
```

Du känner igen all kod sedan tidigare, den är bara omstrukturerad.

Jag behöver även gå in i `config/routes.php` för att ändra `$router` till `$app->router`.

Nu kan jag testa och mina routes bör fungera. 



Använda Url i Routes {#appurl}
--------------------------------------

Det vore trevligt om jag kunde länka mellan olika sidor, en enklare navbar kanske. Jag har tillgång till allt jag behöver, jag måste bara placera koden på rätt plats.



###Skapa navbaren med länkar {#navbar1}

Sedan tidigare vet jag att länkar skall skapas av ramverket via `$app->url->create("")`. En navbar för min webbplats kan alltså se ut så här.

```php
    $urlHome  = $app->url->create("");
    $urlAbout = $app->url->create("about");
    $navbar = <<<EOD
<navbar>
    <a href="$urlHome">Home</a> | 
    <a href="$urlAbout">About</a>
</navbar>
EOD;
```

Koden för navbaren behöver komma in i varje routehandler där den skall visas.



###Navbar in i route handler {#navbar2}

Om jag modifierar mina routes i `config/route.php`, så kan det se ut så här, för att implementera en navbar.

```php
$app->router->add("", function () use($app) {
    $urlHome  = $app->url->create("");
    $urlAbout = $app->url->create("about");
    $navbar = <<<EOD
<navbar>
    <a href="$urlHome">Home</a> | 
    <a href="$urlAbout">About</a>
</navbar>
EOD;

    $body = <<<EOD
<!doctype html>
<meta charset="utf-8">
<title>Home</title>
$navbar
<h1>Home</h1>
<p>This is the homepage.</p>
EOD;

    echo $body;
});
```

Notera att callbacken för routen nu använder `function () use($app)` vilket gör att callbacken får tillgång till variabeln `$app` som innehåller alla ramverkets resurser.

Om jag gör motsvarande uppdatering i de andra routsen, så får jag en navbar som hjälper mig att hoppa mellan sidorna.



Extra debugging i 404 {#debugg}
--------------------------------------

Nu när vi har tillgång till hela ramverket i routens hanterare så kan jag uppdatera min interna route 404 för att skriva ut extra debugging. Det kan vara bra när man sitter och utvecklar i ramverket.

Min uppdaterade 404-route ser ut så här.

```php
$app->router->addInternal("404", function () use($app) {
    $currentRoute = $app->request->getRoute();
    $routes = "<ul>";
    foreach($app->router->getAll() as $route) {
        $routes .= "<li>'" . $route->getRule() . "'</li>";
    }
    $routes .= "</ul>";

    $intRoutes = "<ul>";
    foreach($app->router->getInternal() as $route) {
        $intRoutes .= "<li>'" . $route->getRule() . "'</li>";
    }
    $intRoutes .= "</ul>";

    $body = <<<EOD
<!doctype html>
<meta charset="utf-8">
<title>404</title>
<h1>404 Not Found</h1>
<p>The route '$currentRoute' could not be found!</p>
<h2>Routes loaded</h2>
<p>The following routes are loaded:</p>
$routes
<p>The following internal routes are loaded:</p>
$intRoutes
EOD;

    echo $body;
});
```

Routen skriver ut information om requesten som användes, dess upplevda route, samt de routes som är laddade i ramverket.

Se det som en bra möjlighet att skriva ut diverse information om vad ramverket innehåller, en möjlighet till debugging. Ännu bättre är kanske att göra en helt egen route som bara visar dig den debugginginfo som du vill ha.



Response {#response}
--------------------------------------

Om vi kikar extra noga på svaret från den interna routen 404, så ger den statuskoden 200 tillbaka. Du kan se vilken statuskod som sidan ger i devtools network-fliken.

Statuskoden borde varit 404.

Nåväl, låt oss hämta hem en response-modul som kan hjälpa oss att hantera svaret som vi ger i routens callback.



###Modul för response {#modulresponse}

Som tidigare finns det en modul som är gjord för att leverera HTTP-svaret, ett response som matchar inkommande request. Vi använder composer för att hämta det.

```bash
$ composer require anax/response
```

Kika gärna på källkoden för response. Den ligger nu i din vendor-mapp.



###Använd response {#anvandresp}

Vi kan nu gå över till att använda response-klassen i routens handler. Men först måste vi lägga till den som en del i ramverket och i `$app`.

I frontkontrollern lägger jag till klassen som en del av `$app`.

```php
// Add all resources to $app
$app = new \Mos\App\App();
$app->request  = new \Anax\Request\RequestBasic();
$app->response = new \Anax\Response\Response();
```

Nu är även klassen response en del av $app-objeket.

Sedan uppdaterar jag min routes och ändrar sista delen där saker skrivs ut.

```php
//echo $body;
$app->response->setBody($body)
              ->send();
```

Det är ingen stor ändring, jag överlåter bara till klassen response att sköta utskriften av resultatet, svaret. Klassen response är förberedd för att hantera HTTP headers och det vill jag möjligen använda lite längre fram.

Eller kanske redan nu, i min route för 404 vill jag skicka med statuskoden för 404, istället för som nu då det blir 200.

Det kan jag göra på följande vis.

```php
$app->response->setBody($body)
              ->send(404);
```

Argumentet som skickas med till `send()` är statuskoden som klassen response omvandlar till ett korrekt anrop med `header("HTTP/1.1 404 Not Found")`. Den typen av hantering skall nu response lösa åt mig.



###Skicka JSON som response {#jsonresp}

En annan sak som request-klassen kan lösa är att förenkla hanteringen av svar som skall levereras som JSON. Låt oss göra en ny route som skickar med detaljer om servern.

```php
$app->router->add("status", function () use($app) {
    $data = [
        "Server" => php_uname(),
        "PHP version" => phpversion(),
        "Included files" => count(get_included_files()),
        "Memory used" => memory_get_peak_usage(true),
        "Execution time" => microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],
    ];

    $app->response->sendJson($data);
});
```

Nu ser man lite mer av styrkan. Klassen response löser encoding av JSON-datan samt lägger till den `header("Content-Type: application/json; charset=utf8")` som är nödvändig.

Nu har vi även ett fungerande response-objekt. Vi närmar oss grunden i ett ramverk.



Vyer {#vyer}
--------------------------------------

En del mikro-ramverk väljer att inte inkludera vyer i sitt grundpaket. De ser det som en utökning, en addon.

Men vi kommer att behöva skapa innehåll till webbplatsen och utan en struktur av vyer så kladdar vi ned vår övriga kod med en blandning av HTML, PHP och innehåll, sidornas content.

Så, visst hade det varit skönt att lägga ut det som är vyer till egna filer. Routerna ser lite stökiga ut nu.





Makefile {#makefile}
--------------------------------------



Git och GitHub {#git}
--------------------------------------

Git & GitHub



Avslutningsvis {#avslutning}
--------------------------------------

Du har nu fått en snabb introduktion i hur konstruktionen Promise kan användas för att skapa sekventiell exekvering av asynkron kod.

Denna artikel har en [egen forumtråd](t/6276) som du kan ställa frågor i, eller ge tips.
