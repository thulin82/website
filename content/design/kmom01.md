---
author: mos
revision:
    2016-06-08: (PA, mos) Arbetskopia.
...
Kmom01: LESS och Responsiv Design
====================================

Låt oss kika på några av de mjukare aspekterna inom webbprogrammering. Det handlar om webbdesign och användbarhet. Men det handlar också om snabba sidladdningar, sökmotoroptimering, att skriva för webben och hur vi väljer att organisera webbplatsens material.

Hur bygger vi våra webbplatser för att underlätta för design och användbarhet? Det handlar främst om hur vi, som programmerare, rent tekniskt kan förbereda webbplatserna för design och användbarhet. Allt för att vi skall vara förberedda när det kommer en webbdesigner, eller användbarhets-designer, och berättar hur webbplatsen skall se ut.

<!--more-->

För att komma igång snabbt så använder vi ett PHP-baserat ramverk för att bygga en me-sida som vi fyller med innehåll och style. Stylen skapar vi med LESS. Vi skall sedan skapa en struktur av LESS-filer som blir enkla att återanvända. Stylen vi skapar gör vi *responsiv* så att den anpassar sig för skärmens storlek. Våra webbplatser måste fungera lika bra på desktop som på läsplatta och mobil.

Vi behöver alltså lära oss LESS och responsiv design till att börja med. Vi behöver också bekanta oss med begreppen webbdesign och användbarhet på webben.

Öppna ditt sinne och låt oss börja.

[FIGURE src=/image/snapvt16/anax-flat-start.png?w=w2 caption="En me-sida med PHP-ramverket Anax Flat."]



<!-- Flytta nedan text till eget dokumet/vy/block -->

<small>*(Detta är instruktionen för kursmomentet och omfattar det som skall göras inom ramen för kursmomentet. Momentet omfattar cirka 20 studietimmar inklusive läsning, arbete med övningar och uppgifter, felsökning, problemlösning, redovisning och eftertanke. Läs igenom hela kursmomentet innan du börjar jobba. Om möjligt -- planera och prioritera var du vill lägga tiden.)*</small>



Läsanvisningar  {#lasanvisningar}
---------------------------------

*(ca: 8-10 studietimmar)*


###Kurslitteratur  {#kurslitteratur}

Läs följande:

1. Läs i boken "[The principles of Beautiful Web Design](kunskap/boken-the-principles-of-beautiful-web-design)".

    * Kap 1: Layout and Composition



###Tekniker för att skriva för webben {#skriva}

1. Kika på vad Markdown innebär genom att läsa [John Grubers introduktion till Markdown](https://daringfireball.net/projects/markdown/basics). För att testa själv så öppnar du en [Gist](https://gist.github.com/) och skriver i Markdown, det gör att du kan testa olika konstruktioner under tiden som du läser om dem.

1. Det är viktigt att ha koll på hur vi skall tänka när vi skriver för webben. Under kursen skall vi läsa igenom guiden "[Skriva för webben](https://www.iis.se/lar-dig-mer/guider/hur-man-skriver-for-webben/)". Du kan börja kort med följande kapitel, bara för att bekanta dig med materialet.

    * 1. Innehållsförteckning
    * 2. Förord



###Kom igång med LESS {#less}

1. Bekanta dig med [LESS](http://lesscss.org/) och se vad det kan göra. 

1. Läs översiktligt Kalles artikel om CSS preprocessors, "[CSS Preprocessors are cool](http://dbwebb.se/article/Kalle_CSS_LESS_SASS.pdf)". Artikeln behandlar skillnader och likheter mellan LESS och SASS. Artikeln är också en god introduktion till vad en CSS pre-processor är och gör.

1. Kika på hur du kan nollställa style med [Normalize.css](http://necolas.github.com/normalize.css/) samt läs snabbt om hur [Normalize fungerar](http://nicolasgallagher.com/about-normalize-css/) och vem som använder det.



###Responsiv webbdesign {#responsiv}

1. Läs översiktligt artikeln som definierade begreppet "[Responsive Web Design](http://alistapart.com/article/responsive-web-design/)".

1. Bläddra snabbt igenom artikeln "[Multi-Device Layout Patterns](http://www.lukew.com/ff/entry.asp?1514)" som definierade ett antal design mönster inom responsiv design.

1. Kika snabbt på materialet då Google Developers visar hur man kommer igång med [grunderna i responsiv layout](https://developers.google.com/web/fundamentals/design-and-ui/responsive/). 



###Video  {#video}

Titta på följande:

1. Till kursen finns en videoserie, "[Teknisk webbdesign och användbarhet](https://www.youtube.com/playlist?list=PLKtP9l5q3ce93K_FQtlmz2rcaR_BaKIET)", kika på de videor som börjar på 0 och 1.



###Lästips {#lastips}

Det finns inga extra lästips.



Övningar & Uppgifter  {#ovningar_uppgifter}
-------------------------------------------

*(ca: 8-10 studietimmar)*



###Labbmiljö {#labbmiljo}

Installera labbmiljön för kursen.

1. [Installera labbmiljön](design/labbmiljo) som behövs för kursen.

1. [Installera kursrepot för kursen](dbwebb-cli/clone).



###Övningar {#ovningar}

Genomför följande övning för att förbereda inför uppgifterna.

1. Lär känna ramverket Anax Flat genom att bygga webbplats. Jobba igenom artikeln "[Bygg en me-sida med Anax Flat](kunskap/bygg-me-sida-med-anax-flat)".

1. Kom igång med LESS och skapa en struktur av LESS-filer, eller LESS-moduler. Det blir ett modulärt sätt att bygga upp sitt *tema* till webbplatsen. Gör detta genom att jobba igenom artikeln "[Bygg ett tema till Anax Flat](kunskap/bygg-ett-tema-till-anax-flat)".



###Uppgifter {#uppgifter}

Dessa uppgifter skall utföras och redovisas.

1. Lös uppgiften "[Bygg en me-sida med Anax Flat och eget LESS tema](design/kmom01)".



###Extra {#extra}

Det finns inga extra uppgifter.



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](design/redovisa).

Se till att följande frågor besvaras i redovisningstexten.

* Är du sedan tidigare van att jobba i ramverk för att bygga webbplatser? Om ja, vilka ramverk/språk har du jobbat med?
* Det blev en del nya verktyg i labbmiljön, var de nya för dig eller kände du igen dem?
* Hur kändes det att jobba med Anax Flat och bygga din me-sida?
* Vad tycker du om LESS så här långt, och det sättet vi jobbar med LESS-moduler i vårt tema?
