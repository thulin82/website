---
author: mos
revision:
    2016-04-11: (PA, mos) Arbetskopia.
...
Kmom01: Grid layout
====================================

Låt oss kika på några av de mjukare aspekterna inom webbprogrammering. Det handlar om webbdesign och användbarhet. Men det handlar också om snabba sidladdningar, sökmotoroptimering, att skriva för webben och hur vi väljer att organisera webbplatsens material.

Hur bygger vi våra webbplatser för att underlätta för design och användbarhet?

Vi skall använda ett PHP-baserat ramverk och bygga en me-sida med hjälp av det och sedan fylla me-sidan med innehåll och style. Stylen skapar vi med LESS vi skall skapa en struktur av LESS-filer som blir enkla att återanvända. Stylen vi skapar gör vi *responsiv* så att den anpassar sig för skärmens storlek. Våra webbplatser måste fungera lika bra på desktop som läsplatta som mobil.

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

1. Bekanta dig med [LESS](http://lesscss.org/) och se vad det kan göra. 


1. Läs artikeln "[The Semantic Grid System: Page Layout For Tomorrow](http://coding.smashingmagazine.com/2011/08/23/the-semantic-grid-system-page-layout-for-tomorrow/)". Skaffa dig en överblick av LESS och The Semantic Grid.

1. Läs artikeln "[Fixed vs. Fluid vs. Elastic Layout: What’s The Right One For You?](http://coding.smashingmagazine.com/2009/06/02/fixed-vs-fluid-vs-elastic-layout-whats-the-right-one-for-you/)". Vad handlar det om med alla varianter på layout av en webbsida? Skaffa dig en översikt. *(OBS GAMMAL ARTIKEL SÖK ERSÄTTARE)*



1. Studera det gridbaserade ramverket [Semantic.gs](http://tylertate.github.io/semantic.gs/).

1. Kika på hur du kan nollställa style med [Normalize.css](http://necolas.github.com/normalize.css/)


####Att mäta hur optimerad en webbplats är {#optimerad}

1. Kika snabbt på verktygen är [YSlow](http://yslow.org/) och [Google Pagespeed](https://developers.google.com/speed/pagespeed/) som mäter hur optimerad en webbplats är. Du kommer andvända dess verktygen i en av uppgifterna.



###Video  {#video}

Titta på följande:




###Lästips {#lastips}

Om du känner att du har tid och kraft.

1. Läs Kalles artikel om CSS preprocessors, "[CSS Preprocessors are cool](http://dbwebb.se/article/Kalle_CSS_LESS_SASS.pdf)" som fokuserar på skillnader och likheter mellan LESS och SASS.




Övningar & Uppgifter  {#ovningar_uppgifter}
-------------------------------------------

*(ca: 8-10 studietimmar)*



###Labbmiljö {#labbmiljo}

Installera labbmiljön för kursen.

1. [Installera labbmiljön](design/labbmiljo) som behövs för kursen.

1. [Installera kursrepot för kursen](dbwebb-cli/clone).



###Övningar {#ovningar}

Genomför följande övning för att förbereda inför uppgifterna.

1. Bygg webbplats med anax. Använd composer. Bifoga mall för standardsidor.

1. Övning för att komma igång med make och kompilera less (använd normalize + semantic.gr, media queries).

1. Övning med navbar som är responsiv.

1. Använd bifogat exempel som ger en stylechooser.




1.  Kom igång med LESS, bygg en struktur av LESS-filer.

Likställ stylen på alla webbläsare.
Använd ett gridbaserat ramverk för ett vertikalt grid.

Om att skriva bra CSS-kod (klasser).

Less-lint
CSS-lint
Make

Bilder med ![]()



2. Responsive kontra mobile first.

* Mobile first
* Responsive design
* Egna webbplatser olika enheter
* Progressive enhancement
* Graceful degradation

Använd media queries för att göra en responsiv webbplats.


3. Mäta 

Använd google pagespeed/yslow för att kolla sidans värdering.



4. Mer

Introduktion till Markdown
Introduktion till webbdesign
Introduktion till användbarhet

Skriva för webben https://www.iis.se/lar-dig-mer/guider/hur-man-skriver-for-webben/









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
