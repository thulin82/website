---
title: dbjs

author: mos
revision:
    "2016-12-16": (PA1, mos) Arbete påbörjat.
...
Kursen "dbjs"
==================================

Kursen **Webbprogrammering och databaser**, a.k.a. *dbjs*, lär ut traditionell databasteknik med databaser, modellering, SQL tillsammans med databasprogrammering i JavaScript via webbklient och Node.js i Linux-miljö.


<!--more-->

[WARNING]
Kursen är under utveckling som sker kontinuerligt under vårterminen 2017.

[/WARNING]




Syfte {#syfte}
------------------------

Kursens syfte är att ge studenten kunskaper i databasutveckling med relationsdatabaser och hur det kan appliceras inom området webbutveckling.  Webbutvecklingen sker på både klient och serversidan med fokus på programmeringsspråket JavaScript.

En viktig komponent i dessa applikationer är utvecklingen av själva databasen där aspekter såsom modellering och design, prestanda och svarstider, samt strukturerad programmering och utbyggbarhet är viktiga komponenter.

Studenten får här en grundlig genomgång i ämnet, både teoretisk och praktisk, som syftar till att studenten självständigt skall förstå och lära sig använda processen att modellera och implementera en databasapplikation.



Förkunskaper {#forkunskaper}
------------------------

Det formella förkunskapskravet är:

> För tillträde till kursen krävs att den studerande har avklarat 7,5 högskolepoäng i programmering.



Innehåll {#innehall}
------------------------

Kursen omfattar följande områden:

* Databasteknik allmän orientering
* Relationsmodellen och relationsdatabaser
* Databasmodellering
* ER (Entity Relationship) modellering
* Normalisering
* Relationsalgebra
* SQL (Structured Query Language) (skapa,modifiera och använda databastabeller)
* Stored Procedures och Triggers (aktiva databaser)
* Transaktioner
* Prestanda och index.
* Programmering med JavaScript på klient och serversidan
* Att koppla JavaScript till relationsdatabaser
* Verktyg och tekniker för utveckling och test



Mål {#mal}
------------------------



###Kunskap och förståelse {#kunskap}

Efter genomförd kurs skall studenten:

* vara väl bevandrad i relationsdatabaser och ha en övergripande förståelse för dess användning och dess fördelar och nackdelar



###Färdighet och förmåga {#fardighet}

Efter genomförd kurs skall studenten:

* ha en grundlig, både teoretisk och praktisk,förmåga att använda relationsdatabaser
* i detalj förstå och applicera processen att utveckla en databas från en problemställning till färdig klientapplikation
* strukturerat och i detalj modellera och dokumentera en databas i form av en ER modell
* utifrån en befintlig modell, praktiskt skapa och förändra samt använda en databas med SQL
* designa och implementera en väl fungerande databasapplikation med tillhörande (client/server) klientapplikation



###Värderingsförmåga och förhållingssätt {#vardering}

Efter genomförd kurs skall studenten:

* översiktligt förstå, kunna förklara samt argumentera kring databaser och databashanteringssystem i allmänhet.



Kursmoment {#kursmoment}
------------------------

Kursen är uppdelad i kursmoment där varje kursmoment uppskattas till 20h studerande i form av programmering, undersökning, läsande, övningar, uppgifter, redovisning och eftertanke. Alla kursmoment skall redovisas och du samlar alla redovisningar i din me-sida.


###Kmom01: JavaScript klient {#kmom01}


Det blir inledningsvis en del labbmiljö för att komma igång med kursen, så vi börjar med att få saker på plats, samtidigt som vi bekantar oss med de olika teknologier som kursen hanterar.

Det blir en introduktion till programmeringsspråket JavaScript och hur det används i webbläsaren tillsammans med HTML och CSS. Det blir fokus på JavaScript och minimalt med HTML och CSS.

[Instruktion till kursmoment 01](kurser/dbjs/kmom01).



###Kmom02: Databas {#kmom02}

Då dyker vi in i databaser tillsammans med SQL och ER-modellering. Jag har valt att introducera databasen SQLite som är en filbaserad databas. En filbaserad databas förenklar hanteringen eftersom databasen ligger i en enda fil och det finns inga användare eller behörigheter att konfigurera.

[Instruktion till kursmoment 02](kurser/dbjs/kmom02).



###Kmom03: JavaScript server {#kmom03}

[Instruktion till kursmoment 03](kurser/dbjs/kmom03).



###Kmom04: Transaktioner {#kmom04}


[Instruktion till kursmoment 04](kurser/dbjs/kmom04).



###Kmom05: Procedur, trigger, funktioner {#kmom05}


[Instruktion till kursmoment 05](kurser/dbjs/kmom05).



###Kmom06: Index och prestanda {#kmom06}


[Instruktion till kursmoment 06](kurser/dbjs/kmom06).



###Kmom07/10: Projekt och examination {#kmom10}

Avslutningsvis gör du ett projekt enligt en specifikation. Projektet är det sista som du gör och tillsammans med alla redovisningar som finns på din me-sida så används detta som underlag för att examinera dig från kursen.

[Instruktion till kursmoment 10](kurser/dbjs/kmom10).



Kurslitteratur {#litteratur}
----------------------------

[Måste jag skaffa kurslitteraturen](kurser/maste-jag-skaffa-kurslitteraturen)?

Det finns en [översikt av kurslitteratur per kurs](kunskap/oversikt-av-kurslitteratur-per-kurs).



###Kurslitteratur {#kurslitteratur}

Som kurslitteratur har jag valt följande bok, tillsammans med ett antal artiklar som finns tillgängliga på nätet. 

Det finns läsanvisningar i samband med varje kursmoment.


* **[Databasteknik](kunskap/boken-databasteknik)** -- Thomas Radron-McCarthy, Tore Risch  
  En lättläst och trevlig bok om grunderna i klassisk databasteknik.

* **[Speaking JavaScript](kunskap/boken-speaking-javascript)** -- Axel Rauschmayer.  
  En bra strukturerad fri bok om JavaScript ES5, finns även efterföljare om ES6.



###Referenslitteratur {#referenslitteratur}

Följande böcker har jag valt som referenslitteratur. De kan vara bra att ha tillhands och ger lite extra läsmöjligheter. De behövs inte för att klara kursen men vill du bemästra kursens område så är dessa böcker bra startpunkter.

* **Database Systems - A Practical Approach to Design, Implementation and Management** -- Connolly, Begg  
  Alternativ bok till kurslitteraturen Databasteknik.

* **[HTML och CSS-boken](kunskap/boken-html-och-css-boken)** -- Rolf Staflin  
  En stabil bok för att komma igång med HTML och CSS.

* **[JavaScript: The definitive Guide](kunskap/boken-javascript-the-definitive-guide)** -- D. Flanagan  
  En tegelsten, komplett med allt du vill veta om språket JavaScript med dess Core, DOM och eventhantering, inklusive en referens till olika funktioner. Perfekt för dig som verkligen vill JavaScript.



<!--
Läsanvisningar {#lasanvisning}
------------------------------

Här följer en sammanställning av de läsanvisningar till kurslitteraturen som ges i varje kursmoment.

| Kursmoment | Databasteknik          | Javascript                          |
|------------|------------------------|-------------------------------------|
| Kmom01     |                        |                                     |
| Kmom02     |                        |                                     |
| Kmom03     |                        |                                     | 
| Kmom04     |                        |                                     |
| Kmom05     |                        |                                     | 
| Kmom06     |                        |                                     | 
| Kmom10     |                        |                                     |

Dessutom har varje kursmoment läsanvisningar i artiklar och videos. 

-->



Lektionsplan och rekommenderad studieplan {#schema}
---------------------------------------------

<!--
Läser du kursen inom ramen för programmet Webbprogrammering (campus/distans) så finns det en [rekommenderad studieplan inom programmet](program/webbprogrammering/studieplan/termin2).

Läser du kursen som en del i ett kurspaket så finns det en [studieplan som är kopplad till kurspaketet](webutv#studieplan).

För dig som studerar kursen som enskild kurs finns det en [rekommenderad studieplan](linux/studieplan) kopplad till de kurstillfällen som erbjuds.
-->

Det finns en [rekommenderad studieplan](kurser/dbjs/studieplan) kopplad till de kurstillfällen som erbjuds.

Det finns även en lektionsplan som du får i samband med kursstart. Lektionsplanen visar de tillfällena som är schemalagda träffar.

Finns det en lektionsplan så finns ofta bokningar av salar gjorda i bokningsschemat.

Studieplan, eventuell lektionsplan och eventuellt schema finns tillgängligt via kurstillfället på ITs.

Läs mer om den [rekommenderade studieplanen](kurser/faq/rekommenderad-studieplan) och [lektionsplanen](kurser/faq/lektionsplan-och-schema).



Lärarstöd och handledning {#handledning}
----------------------------------------

Schemalagda labbtillfällen, hangouts samt forum och chatt de viktigaste källorna för handledning. Läs om [handledning och hjälp-till-självhjälp](kurser/faq/lararstod-och-handledning).



Ladok {#ladok}
------------------------

Enligt kursplanen finns ett antal ladokmoment och de är kopplade till kursens kursmoment enligt följande.

| Kursens moment  | Ladok moment enligt kursplan  |
|-----------------|-------------------------------|
| Kmom01 + kmom02 | Inlämningsuppgift 1 á 2.5hp   |
| Kmom03 + kmom04 | Inlämningsuppgift 2 á 2.5hp   |
| Kmom05 + kmom06 | Inlämningsuppgift 3 á 2.5hp   |
| Kmom07 - kmom10 | Inlämningsuppgift 4 á 2.5hp   |

Totalt omfattar kursen 10hp.

Läs mer om [rapportering av resultat](kurser/faq/resultatrapportering).



Betygsättning {#betyg}
------------------------

Det finns ett särskilt dokument som beskriver [hur bedömning och betygsättning sker](kurser/bedomning-och-betygsattning). 



Kursutvärdering och kursutveckling {#kursutvardering}
-----------------------------------------------------

Det finns ett särskilt dokument som beskriver hur arbetet med kursutvärderingar och kursutveckling sker. Det är oerhört viktigt för mig att du säger till vad du tycker om kurs och kursmaterial, du kan alltid hojta till i både forum, chatt eller mail.

Läs om hur [vi jobbar med kursutvärdering och kursutveckling](kurser/kursutvardering-och-kursutveckling).



Kursplan {#kursplan}
-----------------------------------------------------

Kursplanen är kursens formella dokument som fastställts av högskolan. När kursen utvärderas görs det mot kursplanen. I kursplanen kan du läsa om kursens klassificering, syfte, innehåll, mål, generella förmågor, lärande och undervisning, bedömning och examination, litteratur, mm.

Du hittar [kursplanen genom att söka på kurskoden PA1444 via BTH's hemsida](http://edu.bth.se/utbildning/utb_kursplaner.asp?KKurskod=PA1444).
