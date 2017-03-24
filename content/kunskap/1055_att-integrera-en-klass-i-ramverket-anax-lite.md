---
author:
    - mos
    - lew
category:
    - php
    - kurs oophp
revision:
    "2017-03-24": "(A, mos, lew) Första versionen."
...
Att integrera en klass i ramverket Anax Lite
===================================

<!-- [FIGURE src=/image/oophp/v3/login-top.png?w=c5 class="right"] -->

Vi ska se hur man kan integrera en klass eller tjänst i ramverket. Vi tittar närmare på en navbar som styrs utifrån en konfigurationsfil och hur den samverkar med det omgivande ramverkets klasser, tjänster och struktur.

<!--more-->



Förutsättning {#pre}
-------------------------------

Du har läst artiklarna artikeln "[Bygg ett eget PHP-ramverk](kunskap/bygg-ett-eget-php-ramverk)" och du har kunskaper motsvarande "[Kom igång med objektorienterad PHP-programmering på 20 steg](kunskap/kom-i-gang-med-oophp-pa-20-steg)".

Du har löst uppgiften "[En navbar till Anax Lite (steg 1)](uppgift/en-navbar-till-anax-lite-steg-1)".



Url som exempel {#intro}
------------------------------

Vi har sett hur övriga tjänster, till exempel `Url` har integrerats i ramverkets struktur. De är en del av `$app` och kan således användas därigenom.


Om vi kikar på hur strukturen runtomkring `Url` ser ut, så kan vi se ett exempel på vilka möjligheter som erbjuds för att skapa egna tjänster, som fungerar som en del av ramverket.

Låt oss ta en titt på den delen av koden igen.


###Url i frontkontroller {#url-front}

Så här ser Url ut i frontkontrollern.

```php
// Make Url part of $app
$app->url      = new \Anax\Url\Url();

// Init the url-object with default values from the request object.
$app->url->setSiteUrl($app->request->getSiteUrl());
$app->url->setBaseUrl($app->request->getBaseUrl());
$app->url->setStaticSiteUrl($app->request->getSiteUrl());
$app->url->setStaticBaseUrl($app->request->getBaseUrl());
$app->url->setScriptName($app->request->getScriptName());

// Update url configuration with values from config file.
$app->url->configure("url.php");
$app->url->setDefaultsFromConfiguration();
```

Det första som sker är bara att Url blir en del av $app. 

Url är beroende av hur requesten ser ut, därför ser vi en hel del initiering i andra stycket, där vi populerar Url med information från Request.

Urls ansvar är att skapa länkar som är anpassade till ramverkets konfiguration och den läses upp i tredje stycket och sätter grundbeteendet i Url.

Url är alltså en klass beroende av annan information i ramverket och den läser upp en konfigurationsfil som finns sparad någonstans i ramverket.



Integrera Navbar i ramverket {#intnavbar}
-----------------------------------------

Låt oss nu på ett liknande sätt integrera koden för Navbar in i ramverkets struktur.

Vi vill integrera Navbar på följande sätt.

1. En klass i `src/Navbar/Navbar.php` med matchande namespace.
1. Klassen läser en konfigurationsfil `config/navbar.php` som innehåller arrayen med navbarens innehåll.
1. Navbaren populeras med de av ramverkets tjänster den använder.



Klassen Navbar {#klassen}
-----------------------------------------

Klassen Navbar sparar vi i `src/Navbar/Navbar.php` och den kan grovt se ut så här.

```php
<?php

namespace Mos\Navbar;

/**
 * Navbar to generate HTML för a navbar from a configuration array.
 */
class Navbar
{
    /**
     * Get HTML for the navbar.
     *
     * @return string as HTML with the navbar.
     */
    public function getHTML()
    {
        ;
    }
}
```

Du använder naturligtvis ditt eget vendor namn. Tanken är att logiken för att generera HTML-koden för navbaren ligger i metoden `getHTML()`. Men det är ju fritt att strukturera och namnge som man vill. Även klassen kan du döpa som du vill.



Konfiguration i config/navbar.php {#php}
-----------------------------------------

Tanken är att navbaren finns representerad i en array, det är grundstrukturen, det som behövs, för att generera navbaren. Vi vill samla all denna typen av konfiguration i katalogen `config`. Det är enklare att göra all konfiguration på en plats.

Om vi kikar på filen `config/url.php` som exempel så kan vi se dess innehåll.

```php
<?php
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
    "urlType"       => \Anax\Url\Url::URL_CLEAN,
    //"urlType"       => \Anax\Url\Url::URL_APPEND,
];
```

Om vi återanvänder arrayen från navbar-uppgiften så skulle vår konfigurationsfil `config/navbar.php` få följande utseende.

```php
<?php
/**
 * Config file for the navbar.
 */
return [
    "config" => [
        "navbar-class" => "navbar"
    ],
    "items" => [
        "hem" => [
            "text" => "Hem",
            "route" => "",
        ],
        "kurser" => [
            "text" => "Kurser",
            "route" => "kurser",
        ],
        "oophp" => [
            "text" => "Kurs oophp",
            "route" => "kurser/oophp",
        ],
    ]
];
```

Principen är att en konfigurationsfil returnerar en array som innehåller det nödvändiga.



Att läsa in konfigurationsfilen {#readconfig}
-----------------------------------------

När Url läser in sin konfigurationsfil så gjordes det med följade kod i frontkontrollern, i själa initieringsfasen av klassen.

```php
// Update url configuration with values from config file.
$app->url->configure("url.php");
$app->url->setDefaultsFromConfiguration();
```

Det är det första anropet till `configure("url.php")` som vi nu vill uppnå att vår Navbar-klass skall klara av. Det andra anropet är specifikt för att sätta upp klassen Url, så det steget behöver vi (troligen) inte.

Men tittar vi på koden för klassen Url så finns det inte en metod `configure()`? Hur fungerar detta?



Implementera interface, använd trait {#implements}
-----------------------------------------

Url-klassen använder sig utav ett _interface_ `Anax\Common\ConfigureInterface` och ett _trait_ `Anax\Common\ConfigureTrait` som återfinns i modulen `anax/common`. Du hittar källkoden för dessa filer i `vendor/anax/common/src/Common`.

I klassfilen för Url ser man detta på hur klassen skapas.

```php
class Url implements \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait;
``` 

Låt oss börja med att titta på interfacet.



###Interfacet ConfigureInterface {#configureinterface}

Ett interface definierar en uppsättning metoder som en klass måste implementera. Det är möjligt att implementera flera interfaces. I detta fallet handlar det om metoden `configure()`, det ser vi om vi tittar på källkoden för interfacet.

```php
namespace Anax\Common;

/**
 * Interface for classes needing injection of the $app object
 * containingframework resources.
 *
 */
interface ConfigureInterface
{
    /**
     * Read configuration from file or array, if a file, first check in
     * ANAX_APP_PATH/config and then in ANAX_INSTALL_PATH/config.
     *
     * @param []|string $what is an array with key/value config options
     *                        or a file to be included which returns such
     *                        an array.
     *
     * @throws Exception when argument if not a filer nor an array.
     *
     * @return self for chaining.
     */
    public function configure($what);
}
```

Ett interface definierar ett kontrakt, eller ett löfte. När en klass väljer att implementera ett interface så säger klassen att man lovar att stödja detta interfacet och erbjuda de tjänster som interfacet specificerar. I detta fallet handlar det alltså om att implementera metoden `configure()` enligt ovan.

När man tittar på klasser kan man alltså genom att läsa klassens definition, till viss del se vilka tjänster klassen erbjuder.



###Navbar implements ConfigurationInterface {#navbarimplements}

Låt då klassen Navbar implementera interfacet.

```php
class Navbar implements \Anax\Common\ConfigureInterface
{
```

Nu säger klassen att den lovar att implementera interfacet.

Då skall vi verkligen implementera interfacet också, via ett trait.



###Traitet ConfigureTrait {#configuretrait}

Ett trait är en återanvändbar del av en klass. I detta fallet låter vi traitet skapa den koddel som behövs för att uppfylla interfacet. Samma koddel är användbar alla klasser som vill använda konfigurationsfiler.

Låt oss kika på hur traitet `ConfigureTrait` ser ut.

Först tittar vi på den inledande delen.

```php
namespace Anax\Common;

/**
 * Trait implementing reading from config-file and storing options in
 * $this->config.
 *
 */
trait ConfigureTrait
{
    /** @var [] $config store the configuration in this array.   */
    private $config = [];
```

Här ser vi att traitet skapar en privat variabel där den avser spara undan konfigurationen.

Sedan tittar vi på själva implementationen av den metod som interfacet anger.

```php
    /**
     * Read configuration from file or array, if a file, first check in
     * ANAX_APP_PATH/config and then in ANAX_INSTALL_PATH/config.
     *
     * @param []|string $what is an array with key/value config options
     *                        or a file to be included which returns such
     *                        an array.
     *
     * @throws Exception when argument if not a filer nor an array.
     *
     * @return self for chaining.
     */
    public function configure($what)
    {
        $anaxInstallPath = ANAX_INSTALL_PATH . "/config/$what";
        $anaxAppPath = ANAX_APP_PATH . "/config/$what";
        
        if (is_array($what)) {
            $options = $what;
        } elseif (is_readable($anaxAppPath)) {
            $options = require $anaxAppPath;
        } elseif (is_readable($anaxInstallPath)) {
            $options = require $anaxInstallPath;
        } else {
            throw new ConfigurationException("Configure item '$what' is not an array nor a readable file.");
        }

        $this->config = array_merge($this->config, $options);
        return self;
    }
}
```

Metoden i traitet implementerar det kontraktet som interfacet anger. 



###Navbar use ConfigurationTrait {#navbaruses}

Låt då klassen Navbar använda traitet för att implementera interfacet.

```php
class Navbar implements \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait;
```

Nu är det klart. Man kan se det som att use-konstruktionen kopierar in koden från traitet in i denna klassen.

På det viset återanvänds kod, skrivet i ett trait, och kan låta många klasser dela koden som implementerar interfacet.



###Sätt navbar som en del av $app {#appnavbar}

Nu kan vi sätta upp klassen Navbar som en del av objektet `$app` i frontkontrollern. Det kan se ut så här.

```php
$app->navbar = new \Mos\Navbar\Navbar();
$app->navbar->configure("navbar.php");
```

Det blir ett smidigt sätt att använda klassen och kraftfullt med tanke på att vi kan återanvända ramverkets struktur för konfigurering.




Avslutningsvis {#avslutning}
------------------------------

Nu har vi en klass som kan hantera de grundligaste sakerna i sessions-hantering och en stomme för en klass som hanterar cookies. Vackert, om jag får säga det själv.
