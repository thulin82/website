---
author: mos
category:
    - kurs oophp
    - php
    - anax-lite
revision:
    "2017-03-14": "(A, mos) Första utgåvan i samband med kursen oophp v3."
...
En navbar till Anax Lite
==================================

Du skall utveckla kod och struktur som hjälper dig att generera HTML-kod för olika typer av navbar och menyer. Tanken är att du konfigurerar dina menyer via en array och du har kod som med hjälp av arrayen kan skapa HTML-kod för navbaren/menyn.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat igenom artiklen "[Bygg ett eget PHP-ramverk](kunskap/bygg-ett-eget-php-ramverk)" och du kan jobba med klasser i PHP.



Introduktion {#intro}
-----------------------

Följande är grundläggande information som du underlättar för att lyckas med uppgiften.



###Principen bakom generera navbar {#principen}

Principen bakom skapandet av navbaren är enkel och handlar om att strukturera och dela upp kod.

Det handlar om att generera en navbar som ser ut ungefär så här i HTML-kod.

```html


```

Vi vill lyfta ut navbarens innehåll till en konfigurationsfil där navbarens innehåll lagras i en array. Det kan se ut så här.


```php


```

Det som nu behövs är kod som tar arrayen och skapar HTML-koden.

Därefter kan man med lite CSS få navbaren att se både snygg ut och fungera i olika variationer av menyer.





###Var lägger jag koden? {#var}

Spara alla filerna under ditt `me/anax-lite`.

Klassfilen lägger du i `src/Navbar/Navbar.php`.

View-filerna lägger du under `view/navbar/`.

Konfigurationsarrayen lägger du direkt i vyn (enklast), eller under `config/navbar.php` (mer utmanande).

Gör en testroute som lägger till en vy för att visa din navbar.



###Namespace {#namespace}

Använd namespace i klassfilen, med ditt eget vendornamn.



###Konfigfilen {#config}

Din konfigarray innehåller information om menyalternativen. Här följer ett exempel, men du kan strukturera den som du vill.

```php


```





Krav {#krav}
-----------------------

1. Din app skall innehålla en listning av dina objekt.



###Klar och taggad {#tag}

1. Kör `git status` och se till att alla filer är en del av repot.

1. Du committar och taggar repot som version 1.0.\* där stjärnan står för nästa nummer i ordningen av dina taggar.

1. Pusha upp repot till GitHub, inklusive taggarna.

1. Gör en `dbwebb publish` för att kolla att allt fungerar.

```bash
$ dbwebb publish anax-lite
```



Extrauppgift {#extra}
-----------------------

Det finns inga extrauppgifter i denna uppgift.



Tips från coachen {#tips}
-----------------------

Lycka till och hojta till i forumet om du behöver hjälp!
