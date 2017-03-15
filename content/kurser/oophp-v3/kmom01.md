---
author: mos
revision:
    "2016-12-16": (PA1, mos) Utveckling påbörjad.
...
Kmom01: Objektorientering i PHP
==================================

[WARNING]
**Version 3 av oophp.**

Utveckling av nytt kursmoment pågår. Kursmomentet släpps senaste den 27/3 2017.

[/WARNING]

Kom igång med klasser i PHP och lär dig samtidigt hur strukturen i ett PHP-ramverk ser ut. Du bygger en me-sida i ditt egenskapade ramverk och du tränar på att bygga klasser utanför strukturen av ramverket.

Som ett sidoprojekt kommer vi igång med MySQL som databas.

<!--
[FIGURE src=/image/snapshot/oophp-kmom01-me.png?w=w2 caption="Så här kan din kommande me-sida se ut, eller inte..."]
-->

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

1. Läs om "[The MicroPHP Manifesto](https://funkatron.com/posts/the-microphp-manifesto.html)" som ger en reaktion på ramverk och termen mikroramverk.

1. Kika översiktligt i [PHP The Right Way](http://www.phptherightway.com/) om vilka verktyg som rekommenderas av PHP communityn.



###Verktyg {#verktyg}

Läs översiktligt in dig på följande verktyg som används i kursen.

1. Vi använder pakethanteraren [Composer](https://getcomposer.org/) för att installera PHP moduler.

1. De PHP-moduler vi använder är publicerade på [Packagist](https://packagist.org/), ett sökbart repository för PHP-moduler.



###Videor {#videor}

Kika på följande videos.

1. Det finns en [YouTube spellista kopplad till kursen](https://www.youtube.com/playlist?list=PLKtP9l5q3ce_jh6fAj1iwiJSj70DXA2Vn), kika på de videos som börjar med 0 och 1.



###Lästips {#lastips}

Det finns inga extra lästips.



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

1. Jobba igenom steg 1-12 i guiden ["Kom igång med objektorienterad PHP-programmering på 20 steg"](kunskap/kom-i-gang-med-oophp-pa-20-steg). Det handlar om grunderna med objektorienterad programmering i PHP. Exempelprogram som du bygger för din egna skull kan du spara i `me/kmom01/oophp20`.

1. Jobba igenom artikeln "[Bygg ett eget PHP-ramverk](kunskap/bygg-ett-eget-php-ramverk)" som ger dig grunden till ett eget litet ramverk. Delvis känner du igen ramverket från kursen design. Du sparar koden i `me/anax-lite`.



###Uppgifter {#uppgifter}

Följande uppgifter skall utföras och resultatet skall redovisas via me-sidan.

1. Gör uppgiften "[Gissa vilket nummer jag tänker på](uppgift/gissa-numret)". Spara din kod i `me/kmom01/guess`.

1. Gör uppgiften "Skapa en dynamisk navbar". In i ramverket. Funktion/class tillsamman med vy. Kanske göra standalone först.

<!--
skapa navbar som klasser (eller direkt i vyn? kanske två varianter?)
-->

1. Gör uppgiften "[Bygg en me-sida med Anax Lite](uppgift/me-sida-med-anax-lite)". Det handlar om att skapa ditt eget anax-lite och publicera på Github. Använd sedan ditt anax-lite för att göra grunden till en me-sida för kursen. Spara allt under `me/anax-lite`.

1. Jobba igenom uppgiften "[Kom igång med SQL](uppgift/kom-igang-med-sql)" genom att utföra den i MySQL Workbench. Spara all SQL-kod i `me/kmom01/skolan/skolan.sql` och utför minst 2/3 av uppgifterna. Dokumentera/kommentera vilka uppgifter du hoppar över. Jobba gärna i grupp och hjälp varandra, men se alltid till att alltid skriva dina egna SQL-satser.





###Extra {#extra}

Det finns inga extra uppgifter.



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](kurser/oophp-v2/redovisa).

Se till att följande frågor besvaras i texten:

* Berätta lite om dina reflektioner kring anax-lite och din me-sida.
* Hur känns det att hoppa rakt in i klasser med PHP, gick det bra eller kändes det tufft?
* Gick det bra att komma igång med MySQL, kanske har du jobbat med det tidigare eller var det kämpigt?
