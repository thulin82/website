---
author: mos
category:
    - kurs oophp
    - php
    - anax-lite
revision:
    "2017-03-17": "(A, mos) Första utgåvan i samband med kursen oophp v3."
...
En navbar till Anax Lite (steg 2)
==================================

Du skall utveckla kod och struktur som hjälper dig att generera HTML-kod för olika typer av navbar och menyer. Tanken är att du konfigurerar dina menyer via en array och du har kod som med hjälp av arrayen kan skapa HTML-kod för navbaren/menyn.

Detta är första steget i övningen och här skriver du din kod i vyn och arrayen konfigurerar du i vyn.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har löst uppgiften "[En navbar till Anax Lite (steg 1)](uppgift/en-navbar-till-anax-lite-steg-1)" och du kan jobba med klasser i PHP motsvarande "[Kom igång med objektorienterad PHP-programmering på 20 steg](kunskap/kom-i-gang-med-oophp-pa-20-steg)".



Introduktion {#intro}
-----------------------

Följande är grundläggande information som du underlättar för att lyckas med uppgiften.



###Principen bakom generera navbar {#principen}

Principen bakom skapandet av navbaren är enkel och handlar om att strukturera och dela upp kod.

Det handlar om att generera en navbar som kan se ut ungefär så här i HTML-kod.

```html


```

Vi vill lyfta ut navbarens innehåll till en konfigurationsfil där navbarens innehåll lagras i en array. Det kan se ut så här.


```php


```

Det som nu behövs är kod som använder arrayen och skapar HTML-koden.

Därefter kan man med CSS få navbaren att se både snygg ut och fungera i olika variationer av menyer.





###Var lägger jag koden? {#var}

Spara alla filerna under ditt `me/anax-lite`.

View-filer lägger du under `view/navbar2/`.

Konfigurationsarrayen lägger du direkt i vyn (enklast), eller under `config/navbar.php` (mer utmanande).

Om du använder en klass så lägger du den i `src/Navbar/Navbar.php` med motsvarande namespace. Det är troligen enklare att lägga all kod direkt i vyn, men det är inte optimalt utifrån återanvändning. Välj en väg som du känner rimlig. Kanske börja skriv koden i vyn och om du får tid så flyttar du koden till en klass.

(Kanske navbar version 1 och sedan navbar version 2 med klasser?)



Krav {#krav}
-----------------------

1. Lägg till en navbar som låter dig navigera på webbplatsen.

1. Lägg till style så att din navbar ser ut som en navbar.



###Klar och taggad {#tag}

1. Kör `make test` för att kolla att du inte har några valideringsfel.

1. Gör en `dbwebb publish anax-lite` för att kolla att allt fungerar.

1. Committa alla filer och lägg till en ny tagg (1.0.\*).

1. Pusha upp repot till GitHub, inklusive taggarna.



Extrauppgift {#extra}
-----------------------

Lös följande extrauppgifter om du har tid och lust.

1. Gör en navbar som har stöd för undermenyer.



Tips från coachen {#tips}
-----------------------

Lycka till och hojta till i forumet om du behöver hjälp!
