---
author: mos
revision:
    2016-04-11: (PA, mos) Arbetskopia.
...
Kmom02: Grid Layout och Typografi
====================================

Låt oss titta på gridbaserad layout, ett grid som bestämmer var vi placerar ut innehållet på webbplatsens sidor.

Vi skall titta på ett **vertikalt grid** som ger oss rader och kolumner tillsammans med mellanrum¸ *gutter*, som skapar ett vitt utrymme, så kallat *white space*.

Sedan tittar på på ett **horisontellt grid** som vi även kan kalla ett *typografiskt grid*, eller ett *baseline grid* där syftet är att alla typografiska element vilar på en rad i ett tänkt horisontellt rutnät för att skapa en *vertical rythm* i de typografiska elementen. Vårt horisontella grid skall inte bara gälla de typografiska elementen utan samtliga element som placeras ut på webbsidan.

Vi bygger ut vårt tema med LESS-moduler som löser vertikalt och horisontellt grid. Samtidigt förbereder vi temat för att bli enkelt att style med olika typsnitt.



<!--more-->

Använd bifogat exempel som ger en stylechooser?




[FIGURE src=/image/snap/tema-regioner-visa-grid.png?w=w2 caption="Placera ut webbsidans innehåll som regioner i ett rutnät (grid)."]

[FIGURE src=/image/snap/tema-typografi-grid.png?w=w2 caption="Skapa en grundtypografi som matchar ett horisontellt grid."]

<small>*(Detta är instruktionen för kursmomentet och omfattar det som skall göras inom ramen för kursmomentet. Momentet omfattar cirka 20 studietimmar inklusive läsning, arbete med övningar och uppgifter, felsökning, problemlösning, redovisning och eftertanke. Läs igenom hela kursmomentet innan du börjar jobba. Om möjligt -- planera och prioritera var du vill lägga tiden.)*</small>



Läsanvisningar  {#lasanvisningar}
---------------------------------

*(ca: 8-10 studietimmar)*


###Kurslitteratur  {#kurslitteratur}

Läs följande:

1. Läs i boken "[The principles of Beautiful Web Design](kunskap/boken-the-principles-of-beautiful-web-design)".

    * Kap 4: Typography



###Tekniker för att skriva för webben {#skriva}

1. Läs följande kapitel i guiden "[Skriva för webben](https://www.iis.se/lar-dig-mer/guider/hur-man-skriver-for-webben/)".

    * 3. Hur vi läser på webben

1. Läs kort och översiktligt om [PHP Markdown Extra](https://michelf.ca/projects/php-markdown/extra/) som stöds av [klassen `CTextFilter`](https://github.com/mosbth/ctextfilter) som ligger bakom hur markdown-texten i Anax Flat formatteras till HTML.



###Typografisk webb {#type}

Tänk dig en typografisk webbplats där all styling har lagts på de typografiska elementen. Hur kan det se ut? Kika på följande webbplatser och inhämta inspiration.

1. [En praktisk guide till typografi på webben](http://webtypography.net/), en högst läsbar bok och samtidigt ett stilexempel på hur en typografiskt stilad webbplats kan se ut.

1. AListApart är en webbplats som publicerar artiklar inom webb, kika här på [artiklar inom typografi](http://alistapart.com/topic/typography-web-fonts). Välj någon av artiklarna och kika på den samtidigt som du studerar dess typografi. 

    * Om allmän typografi.
    * Om att matcha fonter på en webbplats.

    CtextFilter with Typography

    Om Markdown Extra med typografiska element.




###Vad handlar grid-baserad layout om? {#grid}

1. Läs två artiklar om "[History of the design grid I](https://99designs.com/blog/tips/history-of-the-grid-part-1/)" och "[History of the design grid II](https://blog.99cluster.com/blog/tips/history-of-the-grid-part-2/)" för att få en överblick om vad gridbaserad layou handlar om.

1. Läs artikeln "[Technical Web Typography: Guidelines and Techniques](http://coding.smashingmagazine.com/2011/03/14/technical-web-typography-guidelines-and-techniques/)" och ta reda på vad ett typografiskt horisontellt rutnät i webblayout innebär. Gillar du artikel så kan du läsa mer om typografi på webben i de artikeltips som visas under artikelns "Further reading".

1. [Primer](http://primercss.io/) är GitHub’s interna CSS ramverk. Deras manual finns på webben. Läs artiklarna där de kort beskriver sin [layout](http://primercss.io/layout/) och sin [typografi](http://primercss.io/type/).



###Styleguides för CSS {#styleguide}

1. Kika snabbt igenom "[Google HTML/CSS Style Guide](https://google.github.io/styleguide/htmlcssguide.xml)".

1. Kika snabbt igenom de [kod guidelines](http://primercss.io/guidelines/) som gäller för GitHubs Primer.



###Video  {#video}

Titta på följande:

1. Till kursen finns en videoserie, "[Teknisk webbdesign och användbarhet](https://www.youtube.com/playlist?list=PLKtP9l5q3ce93K_FQtlmz2rcaR_BaKIET)", kika på de videor som börjar på 2.



###Lästips {#lastips}

Det finns inga extra lästips.



Övningar & Uppgifter  {#ovningar_uppgifter}
-------------------------------------------

*(ca: 8-10 studietimmar)*



###Övningar {#ovningar}

Genomför följande övning för att förbereda inför uppgifterna.

1. Studera Markdown och CTextFilter, hur de fungerar och hur de processar filerna.

1. Skriv LESS för att skapa ett horisontellt grid.



###Uppgifter {#uppgifter}

Dessa uppgifter skall utföras och redovisas.

1. Bygg ut me-sidan med sidor som använder "alla" typografiska HTML element och styla dem.

1. Bygg ut me-sidan med sida som inkluderar andra element i sidan med CTextFilter (audio, video, mm).

3. [Mät och jämför laddningstider på olika webbplatser](uppgift/jamfor-laddningstider-for-webbplatser).


###Extra {#extra}

Det finns inga extra uppgifter.



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](design/redovisa).

Se till att följande frågor besvaras i redovisningstexten.

* ...
