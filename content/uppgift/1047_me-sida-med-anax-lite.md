---
author: mos
category:
    - kurs/oophp
    - anax-lite
revision:
    "2017-03-08": "(A, mos) Första utgåvan."
...
Bygg en me-sida med Anax Lite
===================================

Du skall sätta samman en me-sida med ditt egna och nyskapade ramverk Anax Lite.

När du är klar så publicerar du och taggar ditt repo på GitHub.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat igenom artikeln "[Bygg ett eget PHP-ramverk](kunskap/bygg-ett-eget-php-ramverk)".



Introduktion {#intro}
-----------------------

Spara allt du gör i ditt kursrepo under katalogen `me/anax-lite`.

Skapa ett repo på GitHub som är taggat i minst version 1.0.0.



Krav {#krav}
-----------------------

1. Skapa en första sida där du ger en presentation av dig tillsammans med en bild.

1. Skapa en about-sida där du skriver en rad om denna kursen samt länkar till ditt repo på GitHub som innehåller din version av Anax Lite. Lägg även till en godtycklig bild som du anser kompletterar sidans innehåll.

1. Skapa en report-sida som du förbereder för att innehålla alla dina redovisningstexter för kursen. 

1. Skapa en navbar så att man kan navigera mellan dina sidor.

1. Lägg till en header och footer som syns på alla relevanta sidor.

1. Skapa en route som levererar ett JSON-svar med diverse detaljer om ditt system. Länka till denna route från din about-sida.

1. Styla sidan så som du finner bäst. Använd LESS/SASS/CSS eller något ramverk liknande Bootstrap, välj själv. Se till att sidan är rimligt responsiv.



###Klar och taggad {#tag}

1. Kör `git status` och se till att alla filer, som skall vara en del av repot i `me/anax-lite`, verkligen är en del av repot.

1. Du committar och taggar repot som version 1.0.0.

1. Pusha upp repot till GitHub, inklusive taggarna.

1. Om du behöver göra fler taggar så gör du enligt 1.0.1, 1.0.2 och så vidare. Se till att sista taggen innehåller allt som är ändrat i detta kursmoment. Om du får komplettering så skall du alltid tagga en ny version när du är klar med kompletteringen samt pusha upp till GitHub.

1. Gör en `dbwebb publish` för att kolla att allt fungerar.

```bash
$ dbwebb publish me
```



Extrauppgift {#extra}
-----------------------

Lös följande extrauppgifter om du har tid och lust.

1. Lägg till så att du kan använda Cimage för att hantera dina bilder.

1. Lägg till i Makefilen så att du kan kompilera din LESS-kod och uppdatera htdocs/css (om du nu valde denna tekniken för stylen).

1. Skapa en view som är en byline (bild och text om dig) och bifoga till någon av dina sidor.

1. Skapa en view som innehåller en flash-bild som visas på alla/några av dina sidor.

1. Skapa en testsida för att leka runt med olika konstruktioner. Det kan vara bra att ha. Se till att din navbar innehåller en läk till testsidan.



Tips från coachen {#tips}
-----------------------

Lycka till och hojta till i forumet om du behöver hjälp!
