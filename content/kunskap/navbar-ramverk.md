---
author: lew
revision:
    "2017-03-22": (A, lew) First version.
category:
    - oophp
...
Integrera en klass i ramverket
===================================

<!-- [FIGURE src=/image/oophp/v3/login-top.png?w=c5 class="right"] -->

Detta är en vidareutveckling av [En navbar till Anax Lite (steg 1)](uppgift/en-navbar-till-anax-lite-steg-1).  

Vi ska se hur man kan integrera en klass eller tjänst i ramverket. Vi tittar närmare på en navbar som styrs utifrån en konfigurationsfil och det som kan behövas runtomkring.

<!--more-->



Förutsättning {#pre}
-------------------------------

Du kan grunderna i php och du vet vad variabler, typer och funktioner innebär.  
<!-- Du har kännedom om SQL och databashantering.   -->
<!-- Du har gått igenom sessioner och cookies i artikeln "[Kom i gång med PHP på 20 steg](kunskap/kom-i-gang-med-php-pa-20-steg#sessioner)" -->
TBD!!



Intro {#navbar-intro}
------------------------------

Vi har sett hur övriga tjänster, till exempel `Url` har integrerats i ramverkets struktur. De är en del av `$app` och kan således användas däri. Om vi kikar på hur strukturen runtomkring `Url` ser ut kan vi se vad vi behöver för att skapa egna tjänster, som fungerar som en del av ramverket.  

`Url`-klassen använder sig utav ett `interface` (ConfigureInterface) och ett `trait` (ConfigureTrait) som återfinns i `vendor/anax/common/src/Common`.  

Ett `interface` definierar en uppsättning metoder som en klass _måste_ implementera. Det är möjligt att implementera flera interfaces. I detta fallet handlar det om metoden `configure`. För att inte behöva implementera metoden i alla våra klassser och tjänster använder vi ett `trait` som innehåller själva funktionaliteten som ska användas. I detta fallet är det metoden `configure()` som letar i mappen `config/` efter filnamnet vi skickar in. Tittar vi i `ConfigureTrait` ser vi även att den returnerar en array, `$config`. 

Nu har vi en grundplan. Stegvis ser den ut på följande sätt:  

1. Skapa en klass som använder ConfigureInterface och ConfigureTrait.

1. Skapa en konfigurationsfil som returnerar en array.

1. Integrera klassen som en del av ramverket i frontcontrollern.

Då börjar vi.



En klass för Navbaren {#navbar-navbar-klass}
------------------------------

Efter att ha tittat i filen `Url.php` ser vi att den 

Interface {#navbar-interface}
------------------------------



Trait {#navbar-trait}
------------------------------



Frontcontrollern {#navbar-frontcontroller}
------------------------------



Konfigurationsfil {#navbar-config}
------------------------------



Avslutningsvis {#avslutning}
------------------------------

Nu har vi en klass som kan hantera de grundligaste sakerna i sessions-hantering och en stomme för en klass som hanterar cookies. Vackert, om jag får säga det själv.
