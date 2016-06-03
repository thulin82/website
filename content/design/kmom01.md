---
author: mos
revision:
    2016-04-11: (PA, mos) Arbetskopia.
...
Kmom01: Grid layout
====================================

Låt oss kika på några av de mjukare aspekterna inom webbprogrammering. Det handlar om webbdesign och användbarhet. Men det handlar också om snabba sidladdningar, sökmotoroptimering, att skriva för webben och hur vi väljer att organisera webbplatsens material.

Hur bygger vi våra webbplatser för att underlätta för design och användbarhet?

Vi skall använda ett PHP-baserat ramverk och bygga en me-sida som vi fyller med innehåll och style. Stylen skapar vi med LESS. Vi skall också skapa en struktur av LESS-filer som blir enkla att återanvända. Stylen vi skapar gör vi *responsiv* så att den anpassar sig för skärmens storlek. Våra webbplatser måste fungera lika bra på desktop som på läsplatta och mobil.

Vi behöver alltså lära oss LESS och responsiv design till att börja med. Vi behöver också bekanta oss med begreppen webbdesign och användbarhet på webben.

Öppna ditt sinne och låt oss börja.

<!--more-->

[FIGURE src=/image/snap/tema-regioner-visa-grid.png?w=w2 caption="Placera ut webbsidans innehåll som regioner i ett rutnät (grid)."]



<!-- Flytta nedan text till eget dokumet/vy/block -->

<small>*(Detta är instruktionen för kursmomentet och omfattar det som skall göras inom ramen för kursmomentet. Momentet omfattar cirka 20 studietimmar inklusive läsning, arbete med övningar och uppgifter, felsökning, problemlösning, redovisning och eftertanke. Läs igenom hela kursmomentet innan du börjar jobba. Om möjligt -- planera och prioritera var du vill lägga tiden.)*</small>



Läsanvisningar  {#lasanvisningar}
---------------------------------

*(ca: 8-10 studietimmar)*


###Kurslitteratur  {#kurslitteratur}

Läs följande:



###Artiklar {#artiklar}

Läs följande:



###Video  {#video}

Titta på följande:



###Lästips {#lastips}

Om du känner att du har tid och kraft.



###Tekniker för att skriva för webben {#skriva}

1. Kika på vad Markdown innebär genom att läsa [John Grubers introduktion till Markdown](https://daringfireball.net/projects/markdown/basics). För att testa själv så öppnar du en [Gist](https://gist.github.com/) och skriver i Markdown, det gör att du kan testa olika konstruktioner under tiden som du läser om dem.




###Kom igång med LESS {#less}

1. Bekanta dig med [LESS](http://lesscss.org/) och se vad det kan göra. 

1. Läs översiktligt Kalles artikel om CSS preprocessors, "[CSS Preprocessors are cool](http://dbwebb.se/article/Kalle_CSS_LESS_SASS.pdf)". Artikeln behandlar skillnader och likheter mellan LESS och SASS. Artikeln är också en god introduktion till vad en CSS pre-processor är och gör.

1. Kika på hur du kan nollställa style med [Normalize.css](http://necolas.github.com/normalize.css/) samt läs snabbt om hur [Normalize fungerar](http://nicolasgallagher.com/about-normalize-css/) och vem som använder det.

1. Videoserie.



###Vad handlar grid-baserad layout om? {#grid}

1. Studera det gridbaserade ramverket [Semantic.gs](http://tylertate.github.io/semantic.gs/).

1. Läs artikeln "[The Semantic Grid System: Page Layout For Tomorrow](http://coding.smashingmagazine.com/2011/08/23/the-semantic-grid-system-page-layout-for-tomorrow/)". Skaffa dig en överblick av LESS och The Semantic Grid.

1. Läs artikeln "[Fixed vs. Fluid vs. Elastic Layout: What’s The Right One For You?](http://coding.smashingmagazine.com/2009/06/02/fixed-vs-fluid-vs-elastic-layout-whats-the-right-one-for-you/)". Vad handlar det om med alla varianter på layout av en webbsida? Skaffa dig en översikt. *(OBS GAMMAL ARTIKEL SÖK ERSÄTTARE)*



###Responsive webbdesign {#responsiv}

* Mobile first
* Responsive design
* Olika webbplatser olika enheter
* Progressive enhancement
* Graceful degradation
* Om media queries för att göra en responsiv webbplats



###Att mäta hur optimerad en webbplats är {#optimerad}

1. Kika snabbt på verktygen är [YSlow](http://yslow.org/) och [Google Pagespeed](https://developers.google.com/speed/pagespeed/) som mäter hur optimerad en webbplats är. Du kommer använda dess verktygen i en av uppgifterna.







Övningar & Uppgifter  {#ovningar_uppgifter}
-------------------------------------------

*(ca: 8-10 studietimmar)*



###Labbmiljö {#labbmiljo}

Installera labbmiljön för kursen.

1. [Installera labbmiljön](design/labbmiljo) som behövs för kursen.

1. [Installera kursrepot för kursen](dbwebb-cli/clone).



###Övningar {#ovningar}

Genomför följande övning för att förbereda inför uppgifterna.

1. *Övning composer, make. yaml.*

1. *Övning för att komma igång med make och kompilera less (använd normalize + semantic.gr, media queries). Less-lint CSS-lint*

1. Lär känna ramverket Anax Flat genom att bygga webbplats. JOaa igenom artikeln "[Bygg en me-sida med Anax Flat](kunskap/bygg-me-sida-med-anax-flat)".

1. Kom igång med LESS och skapa en struktur av LESS-filer, eller LESS-moduler. Det blir ett modulärt sätt att bygga upp sitt *tema* till webbplatsen. Gör detta genom att jobba igenom artikeln "[Bygg ett tema till Anax Flat](kunskap/bygg-ett-tema-till-anax-flat)".

*Bilder med ![]()*



###Uppgifter {#uppgifter}

Dessa uppgifter skall utföras och redovisas.

1. Gör en me-sida.

2. Skapa ett tema till din me-sida som är gridbaserat och använder en responsive design.

3. [Mät och jämför laddningstider på olika webbplatser](uppgift/jamfor-laddningstider-for-webbplatser).




###Extra {#extra}

Det finns inga extra uppgifter.



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](design/redovisa).

Se till att följande frågor besvaras i redovisningstexten.

* Vilken utvecklingsmiljö använder du?
* ...
