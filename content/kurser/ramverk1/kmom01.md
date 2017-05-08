---
author:
    - mos
revision:
    "2017-03-24": "(PA1, mos) Jobbet börjar."
...
Kmom01: TBD
==================================

[WARNING]
**Version 1 av ramverk1.**

Utveckling av nytt kursmoment. Kursmomentet släpps hösten 2017.

[/WARNING]

TBD.

<!--stop-->


RAMVERK1:

Röd tråd:
Software engineering, ebok
Software development processes
XP, Agile
software quality assurance
Deployment, Maintenance, Support
Software architecture
Design patterns

Pre:
Ny kodstandard js.
lokal utvecklingsmiljö och testverktyg

01: (kom igång, även ci med enhetstestning)
Använd Anax med moduler till me-sida.
Anax med DI, MVC (inkl flat file)
Service container/locator, Inversion of control, SOLID, lazy instantiation/initialisation (by class or by configuration) (egen artikel om injection?) (Typehinting on method arguments)
Titta på REM-server som flyttar koden till domän-modul.
Samt Flatfilecontent-module (som exempel på mer fristående modul)
Enhetstestning av domänmodul, samt packagist, travis (scrutinizer, circleci)
flat file med frontmatter

0x:
Continous integration, fixa en extern validator/badge per kmom.

0x: (likt phpmvc/kmom04 men splitta upp i delar, viktigt kmom)
MVC (kontroller och modeller)
kontroller versus router, specifika up/down-metoder
dispatching, forward
form/cform (introducera för sig själv)
Databasdrivna modeller (med formulär), olika databaspatterns från phpmvc/kmom04 med SQLQueryBuilder
Kompabilitet databas (sqlite, mysql, postgresql) med SQL Query Builder
scaffolding
HMVC

0x:
middleware
Exempel på middleware, skriv eget och gör som paket på packagist.

0x:
eventlisteners, event in framwork
logger

0x:
ajax bild upload (POST, FILES) (använder olika routes).
visa bilder på olika sätt, bildspel (ajax?)
Ajax
login Ajax
(zend module?)

02:
User login, registrering, aktivering (usability) med ajax. (cookies)
Kan testas BDD eller Selenium?

0x: (likt phpmvc/kmom05)
Egen dummy-modul (valutakonverterare, datum, kalender, namn, rot, etc), till eget webbplats för trafik och reklam?
egna paket packagist (domänmodul till Anax)
Reklam på webben

03:
Cachning, nyhetsplanet, rss-flöde. RSS-modul, Cache-modul (PSR?)
Caching (som modul anax/cache, möjligen PSR)
Kan byggas med BDD?
(domänmoduler)

0x: Testning
TDD/BDD Testning (phpunit och behat)
Testning (docker och selenium)
Testing (travis, circle, scrutinizer, https://codeclimate.com/, https://coveralls.io/)
Olika versioner av PHP i XAMPP/Docker
enhetstest o doc dag 1
Test doubles, db test, BDD
Guide: Writing Testable Code
Behat
Selenium
Enhetstestning databas
PHPUnit (exception, setup, teardown, database, mocking, providers)
travis, scrutinizer, circle
docker (olika versioner av PHP, databas, egen testmiljö)

0x:
debug och profiling med Xdebug
Debugging med Xdebug
prestandatestning
prestandamätningar, analyser

0x: Säkerhet
OWASP
Hur escapa på rätt sätt, RFC, url, mot OWASP, tesfall för säkerhet.
* CValidate (eller bätre med Zendmodul?)


Övrigt:
SEO
Om RFC, exempel där man måste läsa RFC.
phpuml (integrera i resp modul)
(Olika språk, anpassa med int/loc) (internationalisering)


RAMVERK2:
01:
Express.js, routes, någon tjänst?

01:
Ny kodstandard js som exempel på npm-modul.
Bygg egen npm-modul (använd i Express).

02:
Websockets
Realtime web
Chatt (express.js)
Chatt
Pusha notiser till användaren (desktop/mobil) när saker uppdateras.
Nån social media/chatt-grej med visst fokus (telegram etc)

0x:
datavisualisering med JS https://d3js.org/, googles api, http://www.chartjs.org/
maps, html5 api

0x:
JS test (klient/server)


Exempel uppgifter:
- Generera nyhetsbrev (från info-flödet av news)
- Matchning ala rekrytering
- search i databaser, sökmotor (artiklar, information, slå ihop databaser från andra källor)
- Kommentarssystem, forum, SO


Externa kopplingar:
* Koppling faktureringsmotor


Tema:
* Big data
* Cloud (docker containers)
* Redis (key value data store, caching)

Övrigt:
* Desktop GUI (Atom)


<small><i>(Detta är instruktionen för kursmomentet och omfattar det som skall göras inom ramen för kursmomentet. Momentet omfattar cirka **20 studietimmar** inklusive läsning, arbete med övningar och uppgifter, felsökning, problemlösning, redovisning och eftertanke. Läs igenom hela kursmomentet innan du börjar jobba. Om möjligt -- planera och prioritera var du vill lägga tiden.)</i></small>



Läsanvisningar  {#lasanvisningar}
---------------------------------

*(ca: 2-4 studietimmar)*



###Kurslitteratur  {#kurslitteratur}

Det finns inga specifika läsanvisningar i kurslitteraturen.



###Artiklar {#artiklar}

Kika igenom följande artiklar.

1. Kika igenom manualen för MySQL, bara kort och översiktligt, men se till att du kan hitta till den delen som visar hur SQL skall skrivas i MySQL.
    * [Ch14 SQL Statement Syntax](https://dev.mysql.com/doc/refman/5.7/en/sql-syntax.html)

1. Läs om "[The MicroPHP Manifesto](https://funkatron.com/posts/the-microphp-manifesto.html)" som ger en reaktion på ramverk och termen mikroramverk. ([Alternativ länk till artikeln](https://dbwebb.se/t/6379)).

1. Kika översiktligt i [PHP The Right Way](http://www.phptherightway.com/). Bekanta dig kort med dokumentet som presenterar allmänt om verktyg och processer som rekommenderas inom PHP communityn.



###Verktyg {#verktyg}

Läs översiktligt in dig på följande verktyg som används i kursen.

1. Vi använder pakethanteraren [Composer](https://getcomposer.org/) för att installera PHP moduler.

1. De PHP-moduler vi använder är publicerade på [Packagist](https://packagist.org/), ett sökbart repository för PHP-moduler.

1. Bekanta dig kort med [manualen till phpdoc](https://phpdoc.org/) som beskriver hur docblock-kommentarer skrivs till PHP.



###Videor {#videor}

Det finns inga videos.

<!--
Kika på följande videos.

1. Det finns en [YouTube spellista kopplad till kursen](https://www.youtube.com/playlist?list=PLKtP9l5q3ce_jh6fAj1iwiJSj70DXA2Vn), kika på de videos som börjar med 0 och 1.
-->



###Lästips {#lastips}

Följande lästips är att rekommendera.

1. Bekanta dig med PHP manualen och [Klasser och Objekt](http://php.net/manual/en/oop5.intro.php).

1. [Dia](https://wiki.gnome.org/Apps/Dia/) är ett ritverktyg där du kan skapa UML-diagram. Du vill ha ett sådant, eller motsvarande, i din arsenal av verktyg.

1. Vi skriver PHP i enlighet med kodstandarden [PSR-1](http://www.php-fig.org/psr/psr-1/) och [PSR-2](http://www.php-fig.org/psr/psr-2/).

1. Kika gärna på valideringsverktygen vi använder, [phpcs](https://github.com/squizlabs/PHP_CodeSniffer/wiki) och [phpmd](https://phpmd.org/). Du kan installera dem som linters i Atom, men först måste du installera dem i din PATH på ditt lokala system.



Övningar & Uppgifter  {#ovningar_uppgifter}
-------------------------------------------

*(ca: 12-16 studietimmar)*



###Labbmiljö {#labbmiljo}

Installera labbmiljön för kursen.

1. [Installera labbmiljön](kurser/oophp-v3/labbmiljo) som behövs för kursen.

1. Klona kursrepot för kursen.



###Övningar {#ovningar}

Gör följande övningar, de behövs normalt för att klara uppgifterna.

1. Fräscha upp ditt minne av PHP genom att snabbt skumma igenom guiden [20 steg för att komma igång med PHP (php20)](kunskap/kom-i-gang-med-php-pa-20-steg). Du bör sedan tidigare (htmlphp) ha koll på det som nämns i guiden. Om du bygger exempelprogram så kan du lägga dem i `me/kmom01/php20`.

1. Jobba igenom guiden ["Kom igång med objektorienterad PHP-programmering på 20 steg"](kunskap/kom-i-gang-med-oophp-pa-20-steg). Det handlar om grunderna med objektorienterad programmering i PHP. Exempelprogram som du bygger för din egna skull kan du spara i `me/kmom01/oophp20`.

1. Jobba igenom artikeln "[Bygg ett eget PHP-ramverk](kunskap/bygg-ett-eget-php-ramverk)" som ger dig grunden till ett eget litet ramverk. Delvis känner du igen ramverket från kursen design. Du sparar koden i `me/anax-lite`.



###Uppgifter {#uppgifter}

Följande uppgifter skall utföras och resultatet skall redovisas via me-sidan.

1. Gör uppgiften "[Gissa vilket nummer jag tänker på](uppgift/gissa-numret)". Spara din kod i `me/kmom01/guess`. Uppgiften värmer upp din gamla PHP-kunskaper och inför några nya i form av objekt och lite mer.

1. Gör uppgiften "[Bygg en me-sida med Anax Lite](uppgift/me-sida-med-anax-lite)". Det handlar om att skapa ditt eget anax-lite och publicera på Github. Använd sedan ditt anax-lite för att göra grunden till en me-sida för kursen. Spara allt under `me/anax-lite`.

1. Gör uppgiften "[En navbar till Anax Lite (steg 1)](uppgift/en-navbar-till-anax-lite-steg-1)" som ger dig en struktur för att separera HTML och konfiguration av din navbar. Spara din kod i `me/anax-lite`.

1. Jobba igenom första tredjedelen av uppgiften "[Kom igång med SQL](uppgift/kom-igang-med-sql)" genom att utföra den i MySQL Workbench. Spara all SQL-kod i `me/kmom01/skolan/skolan.sql`. Du får göra resten av uppgiften i de två kommande kursmomenten. Jobba gärna i grupp och hjälp varandra, men se alltid till att alltid skriva dina egna SQL-satser.

1. Pusha och tagga ditt Anax Lite, allt eftersom och sätt en avslutande tagg (1.0.\*) när du är klar med alla uppgifter i kursmomentet.



###Extra {#extra}

Det finns inga extra uppgifter.



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](kurser/oophp-v3/redovisa).

Se till att följande frågor besvaras i texten:

* Hur känns det att hoppa rakt in i klasser med PHP, gick det bra?
* Berätta om dina reflektioner kring ramverk, anax-lite och din me-sida.
* Gick det bra att komma igång med MySQL, har du liknande erfarenheter sedan tidigare?
