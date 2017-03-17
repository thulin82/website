---
author: mos
revision:
    "2016-12-16": (PA1, mos) Utveckling påbörjad.
...
Kmom03: PHP PDO och MySQL
==================================

[WARNING]
**Version 3 av oophp.**

Utveckling av nytt kursmoment pågår. Kursmomentet släpps senaste den 10/4 2017.

[/WARNING]

Så här långt har du lärt dig om objektorienterad PHP och databasen MySQL. Nu skall du koppla ihop dessa till en databasdriven webbapplikation genom att använda PHP's gränssnitt för databaser PHP PDO. Du får jobba igenom en guide där du bygger upp en filmdatabas med ett webbgränssnitt där du kan redigera information om filmer och söka ut dem. När du jobbar i guiden så kommer du att stöta på och lösa de vanliga problemen som en sådan applikation innebär. När du är klar så har du ett fungerande exempel som du kan använda som bas för kommande webbapplikationer. Om du tittar noga så kan du se likheten mellan till exempel en webbshop och din filmdatabas, rent tekniskt är det samma grunder i båda.

[FIGURE src=/image/snapshot/Visa_filmer_med_sokalternativ_kombinerade___Min_Filmdatabas.jpg?w=w1&q=60 caption="Din egen sökbara filmdatabas kan bli ett resultat av detta kursmoment."]

Kursmomentet avslutas med att du kodar ett par moduler till ditt Anax.


<small><i>(Detta är instruktionen för kursmomentet och omfattar det som skall göras inom ramen för kursmomentet. Momentet omfattar cirka **20 studietimmar** inklusive läsning, arbete med övningar och uppgifter, felsökning, problemlösning, redovisning och eftertanke. Läs igenom hela kursmomentet innan du börjar jobba. Om möjligt -- planera och prioritera var du vill lägga tiden.)</i></small>



Läsanvisningar  {#lasanvisningar}
---------------------------------

*(ca: 4-6 studietimmar, inklusive extra läsning i referenslitteraturen efter eget val)*



###Kurslitteratur  {#kurslitteratur}

Läs följande:



###Lästips {#lastips}




Övningar & Uppgifter  {#ovningar_uppgifter}
-------------------------------------------

*(ca: 8-14 studietimmar)*


###Övningar {#ovningar}

Gör följande övningar, de förbereder dig inför kommande kursmoment.

1. Jobba igenom guiden ["Kom igång med PHP PDO och MySQL"](kunskap/kom-igang-med-php-pdo-och-mysql).

1. Artikel om enhetstestning (makefile, travis).

1. Artikel om session och inloggning med databas "[Logga in med sessioner och cookies](kunskap/sessioner-cookies-login)".


<!-- 

Unittest (Guess, Dice, Cal) Xdebug install

Use composer require anax/database

(Content som markdown med anax/textfilter)

-->



###Uppgifter {#uppgifter}

Gör följande uppgifter.

1. Börja med att skapa din egna klass `CDatabase` och inkludera den i ditt Anax. Du får tag i koden och lär dig använda klassen genom att göra övningen ["Övningar med CDatabase"](uppgift/ovningar-med-cdatabase).

1. Gör uppgiften ["Generera en HTML-tabell från en databastabell, använd sökning, sortering och paginering"](uppgift/generera-en-html-tabell-fran-en-databastabell-anvand-sokning-sortering-och-paginering). 

1. Gör uppgiften ["Skapa en klass för användarhantering, CUser"](uppgift/skapa-en-klass-for-anvandarhantering-cuser).

1. (Gör uppgiften "[skapa inloggning del 1](uppgift/inloggning-steg-1)". Spara dina filer under `me/kmom03/login`. Ej integrera ramverket?) <!-- SQLite/MySQL -->

1. (Klass Session i ramverket.)

1. Inloggning steg 2, inuti ramverket.

1. Gör sista tredjedelen och avsluta uppgiften "[Kom igång med SQL](uppgift/kom-igang-med-sql)". Fortsätt att spara all SQL-kod i `me/kmom01/skolan/skolan.sql`.

<!--
1. Ramverksmoduler att bygga själv.
* CValidate
* CFlash
* CCache

(Olika språk, anpassa med int/loc) 
-->




###Extra {#extra}

Det finns ingen extra uppgift.



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](oophp/redovisa).

Se till att följande frågor besvaras i texten:

* Hur kändes det att jobba med PHP PDO?
* Gjorde du guiden med filmdatabasen, hur gick det?
* Du har nu byggt ut ditt Anax med ett par moduler i form av klasser, hur tycker du det konceptet fungerar så här långt, fördelar, nackdelar?
