---
author:
    - mos
category:
    - kurs oophp-v3
    - kurs oophp
revision:
    "2016-12-16": (PA1, mos) Utveckling påbörjad.
...
Kmom06: Enhetstestning
==================================

[WARNING]
**Version 3 av oophp.**

Utveckling av nytt kursmoment pågår. Kursmomentet släpps senaste den 1/5 2017.

[/WARNING]

TBD.

<small><i>(Detta är instruktionen för kursmomentet och omfattar det som skall göras inom ramen för kursmomentet. Momentet omfattar cirka **20 studietimmar** inklusive läsning, arbete med övningar och uppgifter, felsökning, problemlösning, redovisning och eftertanke. Läs igenom hela kursmomentet innan du börjar jobba. Om möjligt -- planera och prioritera var du vill lägga tiden.)</i></small>



Läsanvisningar  {#lasanvisningar}
---------------------------------

*(ca: 2-4 studietimmar, inklusive extra läsning i referenslitteraturen efter eget val)*



###Kurslitteratur  {#kurslitteratur}

Det finns inga specifika läsanvisningar till detta kursmomentet.



###Artiklar {#artiklar}

Läs följande.

1. Bekanta dig översiktligt med de olika delarna av manualen i [MySQL om optimering](https://dev.mysql.com/doc/refman/5.7/en/optimization.html). Se vilka delar som kan optimeras och på vilket sätt. Skumma igenom de olika delarna.



###Lästips {#lastips}

Kika på följande lästips om du finner dem intressanta.

1. [Databasteknik](kunskap/boken-databasteknik)
    * Kap 22: Fysiska lagringsstrukturer i databaser

1. [Databasteknik](kunskap/boken-databasteknik)
    * Kap 9: Sammanfattning av SQL-kommandon
    * Kap 21: Index och prestanda

Vissa av kapitlen finns i [bokens webbkurs](http://www.databasteknik.se/webbkursen/), del 2.



Övningar & Uppgifter  {#ovningar_uppgifter}
-------------------------------------------

*(ca: 12-16 studietimmar)*


###Övningar {#ovningar}

Gör följande övning, den förbereder dig inför uppgifterna.

1. Jobba igenom övningen "[Index och prestanda i MySQL](kunskap/index-och-prestanda-i-mysql)" som tränar dig i hur du kan optimera dina databasfrågor med index. Spara dina testprogram i `me/kmom06/index`.

<!--
Artikel om hur man skriver bra SQL frågor på ett optimerat sätt.
-->

1. Artikel om enhetstestning (makefile, travis).

<!-- Unittest (Guess, Dice, Cal) Xdebug install -->

<!--
1. Ramverksmoduler att bygga själv.
* CValidate
* CFlash
* CCache

(Olika språk, anpassa med int/loc) 
-->



###Uppgifter {#uppgifter}

Följande uppgifter skall utföras och resultatet skall redovisas via me-sidan.

1. Gör uppgiften "Enhetstestning och kodtäckning". Spara uppdateringarna du gör i ditt `me/anax-lite`.

1. Gör uppgiften "Dokumentation med phpdoc". Spara uppdateringarna du gör i ditt `me/anax-lite`.

1. Gör uppgiften med "Index och prestanda". Spara uppdateringarna du gör i ditt `me/anax-lite`, använd kommentarer för att beskriva vad du gör.
<!-- index mot movie och content -->

1. Gör uppgiften "[Dokumentera din ER-modell med Reverse Engineering](uppgift/dokumentera-din-er-modell-med-reverse-engineering)". Spara resultatet i `me/kmom06/er3`.

1. Pusha och tagga ditt Anax Lite, allt eftersom och sätt en avslutande tagg (6.0.\*) när du är klar med alla uppgifter i kursmomentet.



###Extra {#extra}

Det finns inga extrauppgifter.



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](kurser/oophp-v3/redovisa).

Se till att följande frågor besvaras i texten:

* Hur var din erfarenhet av enhetstester inför detta kursmoment?
* Lärde du dig något ytterligare om enhetstestning under kursmomentet?
