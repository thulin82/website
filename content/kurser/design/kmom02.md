---
author: mos
revision:
    2016-06-22: (A, mos) Första utgåvan.
...
Kmom02: Grid, layout och typografi
====================================

[INFO]
**Kursmomentet är under utveckling --- men grunden finns på plats. Kursen ges första gången i läsperiod 2, hösten 2016, till programstudenter på programmet Webbprogrammering.**
[/INFO]

Låt oss titta på gridbaserad layout, ett grid som bestämmer var vi placerar ut innehållet på webbplatsens sidor.

Vi skall titta på ett **vertikalt grid** som ger oss rader och kolumner tillsammans med mellanrum¸ *gutter*, som skapar ett vitt utrymme, så kallat *white space*.

Sedan tittar på på ett **horisontellt grid** som vi även kan kalla ett *typografiskt grid*, eller ett *baseline grid* där syftet är att alla typografiska element vilar på en rad i ett tänkt horisontellt rutnät för att skapa en *vertical rythm* i de typografiska elementen. Vårt horisontella grid skall inte bara gälla de typografiska elementen utan samtliga element som placeras ut på webbsidan.

Vi bygger ut vårt tema med LESS-moduler som löser vertikalt och horisontellt grid. Samtidigt förbereder vi temat för att bli enkelt att style med olika typsnitt.



<!--more-->

[FIGURE src=/image/snapvt16/grid-displayed.png?w=w2 caption="Placera ut webbsidans innehåll som regioner i ett rutnät (grid)."]

[FIGURE src=/image/snapvt16/typografiskt-grid.png?w=w2 caption="Skapa en grundtypografi som matchar ett horisontellt grid."]

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

1. Det finns många typografiska element som kan vara vackra, men aningen svåra att få med i sin löpande text på webben. Kika i artikeln "[Typografiska element för webben med SmartyPants](coachen/typografiska-element-med-smartypants)" om vilken teknik om används till webbplatsen dbwebb.



###Vad handlar grid-baserad layout om? {#grid}

1. Läs två artiklar om "[History of the design grid I](https://99designs.com/blog/tips/history-of-the-grid-part-1/)" och "[History of the design grid II](https://blog.99cluster.com/blog/tips/history-of-the-grid-part-2/)" för att få en överblick om vad gridbaserad layou handlar om.

1. Läs artikeln "[Technical Web Typography: Guidelines and Techniques](http://coding.smashingmagazine.com/2011/03/14/technical-web-typography-guidelines-and-techniques/)" och ta reda på vad ett typografiskt horisontellt rutnät i webblayout innebär. Gillar du artikel så kan du läsa mer om typografi på webben i de tips som visas under artikelns "Further reading".

1. [Primer](http://primercss.io/) är GitHub’s interna CSS ramverk. Deras manual finns på webben. Läs artiklarna där de kort beskriver sin [layout](http://primercss.io/layout/) och [typografi](http://primercss.io/type/).



###Styleguides för CSS {#styleguide}

1. Kika snabbt igenom "[Google HTML/CSS Style Guide](https://google.github.io/styleguide/htmlcssguide.xml)".

1. Kika snabbt igenom [kod-guidelines för GitHubs Primer](http://primercss.io/guidelines/).



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

1. Jobba igenom artikeln "[Använd ett vertikalt grid med Anax Flat](kunskap/anvand-vertikalt-grid-med-anax-flat)" som visar dig grunden i att implementera ett grid i CSS och LESS.

1. Jobba igenom artikeln "[Skapa ett horisontellt grid för typografi](kunskap/skapa-ett-horisontellt-grid-for-typografi)" som visar hur du skapar en vertikal rytm i din webbplats.



###Uppgifter {#uppgifter}

Dessa uppgifter skall utföras och redovisas.

1. Utför uppgiften "[Bygg ut ditt tema med stöd för vertikalt och horisontellt grid](uppgift/me-sida-med-grid)".



###Extra {#extra}

Det finns inga extra uppgifter.



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](design/redovisa).

Se till att följande frågor besvaras i redovisningstexten.

* Hur känns det attvara styrd till ett vertikalt grid?
* Hur känns det att jobba med ett typografiskt horisontellt/baseline grid?
* Har du jobbat med liknande layouttekniker sedan tidigare?
* Du börjar se hur man kan jobba med LESS, kommentarer på det?
