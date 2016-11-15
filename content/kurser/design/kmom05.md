---
author: mos
revision:
    2016-11-15: (A, mos) Första utgåvan.
...
Kmom05: Bild
====================================

[INFO]
**I stort sett klart...**

Det saknas en sammanhållande artikel som ger lite kött på benen om bildhantering. Men, för en early bird så finns förövrigt allt material framme som man kan sätta tänderna i och jobba. Den artikeln som saknas är inte kritisk för att genomföra kursmomentet och kanske kommer den inte förrän till föreläsningen i kmom05.
[/INFO]

[FIGURE src="image/dbwebbisar.jpg?w=200&h=150&a=0,20,20,50&cf" class="right"]

Låt oss ägna ett kursmoment åt att testa runt med bilder och publicera dem på en webbplats.

Vi behöver vara medvetna om att bilder kan vara tunga att ladda och det vill vi hitta sätt att hantera. Hur tunga (stora) behöver bilder vara när de skall visas på en webbplats? Behöver de vara lika tunga på en desktop och på en mobil enhet?

Kan man ha olika bilder som visas på olika enheter? Det låter som en vettig idé men fungerar det i dagsläget?

<!--more-->

[FIGURE src="image/dbwebbisar.jpg?w=200&h=150&a=0,20,20,50&cf" class="left"]

Är det skillnad på foton och skärmdumpar? Ja, det är en fråga man skulle vilja ha svar på.

Om man vill beskära bilder, är det vettigt och hur gör man då? Vi har ju alltid fotoredigeringsprogram likt Gimp, men låt oss kika på alternativ som kan passa en webbprogrammerare.

Låt oss testa runt och placera och beskära dessa bilder för att visa att vi bemästrat området. Inklusive responsivitet med bilder via en LESS modul.

Innan du påbörjar kursmomentet så kan du ta en sväng ut i skogen, eller staden, ta med din kamera och fota loss lite. Så får du lite material att lägga upp på din me-sida.

[FIGURE src="image/dbwebbisar.jpg?w=200&h=150&a=0,20,20,50&cf" class="center"]

Vi har många frågeställningar om bilder, men låt se om vi kan bringa klarhet i några av dem.

[FIGURE src="image/dbwebbisar.jpg?w=700"]
[FIGURE src="image/dbwebbisar.jpg?w=500"]
[FIGURE src="image/dbwebbisar.jpg?w=300"]
[FIGURE src="image/dbwebbisar.jpg?w=100"]



<small>*(Detta är instruktionen för kursmomentet och omfattar det som skall göras inom ramen för kursmomentet. Momentet omfattar cirka 20 studietimmar inklusive läsning, arbete med övningar och uppgifter, felsökning, problemlösning, redovisning och eftertanke. Läs igenom hela kursmomentet innan du börjar jobba. Om möjligt -- planera och prioritera var du vill lägga tiden.)*</small>



Läsanvisningar  {#lasanvisningar}
---------------------------------

*(ca: 8-10 studietimmar)*


###Kurslitteratur  {#kurslitteratur}

Läs följande:

1. Läs i boken "[The principles of Beautiful Web Design](kunskap/boken-the-principles-of-beautiful-web-design)".

    * Kap 5 Imagery



###Tekniker för att skriva för webben {#skriva}

1. Läs följande kapitel i guiden "[Skriva för webben](https://www.iis.se/lar-dig-mer/guider/hur-man-skriver-for-webben/)".

    * 6. Skriva texter för webben



###Webbdesign och användbarhet {#webbdesign}

1. Läs översiktligt igenom artikeln "[Moz om Page Speed](https://moz.com/learn/seo/page-speed)". Den förbereder dig för en av uppgifterna.

1. Kika snabbt på Googles "[PageSpeed Insights Rules](https://developers.google.com/speed/docs/insights/rules)" för att snabba upp sidor.



###Video  {#video}

Kika på följande video.

1. Moderskeppet är duktiga på foto och video, du kan hämta inspiration från deras fria youtube-kanal. Jag hittade att följande spellistor känns delvis relevanta för detta kursmoment.

    * [Guider om Foto](https://www.youtube.com/playlist?list=PL7jFK1saS1_Aexc_tx2wWClpQOShZkD2_)
    * [Inspiration för fotografer](https://www.youtube.com/playlist?list=PL7jFK1saS1_DGvKLYHOBb9HlCd_6id-vS)
    * [Bilder och upphovsrätt för designers](https://www.youtube.com/playlist?list=PL7jFK1saS1_DYHuwI_r5U7vVeY6RhZlIM)

<!--
Titta på följande:

1. Till kursen finns en videoserie, "[Teknisk webbdesign och användbarhet](https://www.youtube.com/playlist?list=PLKtP9l5q3ce93K_FQtlmz2rcaR_BaKIET)", kika på de videor som börjar på 5.
-->



###Lästips {#lastips}

Kika igenom följande tips.

1. [GIMP](https://www.gimp.org/) är en fri variant till bildbehandlingsprogram. Det kan vara ett bra verktyg att ha installerat, även om man är webbprogrammerare.

1. [Inkscape](https://inkscape.org/en/) är ett fritt program för att rita och hantera bilder i vektorgrafik såsom SVG. Ett typiskt bra verktyg att ha i sin verktygslåda som webbprogrammerare.



Övningar & Uppgifter  {#ovningar_uppgifter}
-------------------------------------------

*(ca: 8-10 studietimmar)*



###Övningar {#ovningar}

Genomför följande övning för att förbereda inför uppgifterna.

1. I kursrepot `example/figure` finns två exempel som visar hur man kan jobba med `<figure>` och uppnå responsiva bilder. Studera och undersök exemplet och försök förstå hur det fungerar och hur det är uppbyggt. Där hittar du LESS-kod du kan låna till uppgiften.
    * [Figure and figcaption](repo/design/example/figure/figure.html)
    * [Figure and figcaption med media queries](repo/design/example/figure/figure-responsive.html)
 
<!--
Bildlära.

jpeg (foton) kontra png (skärmdump)
color space
storlek på bilderna
kvalitet

-->


###Uppgifter {#uppgifter}

Dessa uppgifter skall utföras och redovisas.

1. Gör uppgiften "[Utvärdera webbplatsers laddningstid och användbarhet](uppgift/utvardera-webbplatsers-laddningstider-och-anvandbarhet)".

1. Integrera din webbplats så den drar nytta av [CImage](anax/cimage-for-bildskalning) och [snygga länkar](anax/snygga-lankar).

1. Gör uppgiften "[Bygg ut ditt Anax Flat tema med stöd för bilder](uppgift/anax-flat-tema-med-bilder)".



###Extra {#extra}

Följande extrauppgifter finns.

1. Läs om begreppet responsive images i följande två artiklar som visar hur man kan använda `picture`, `srcset` och `sizes` för att jobba responsivt med bilder. Fundera på om det kan vara något för din me-sida.
    * [AlistApart: Responsive Images in Practice (2014)](http://alistapart.com/article/responsive-images-in-practice)
    * [AlistApart: Using Responsive Images (Now) (2015)](http://alistapart.com/article/using-responsive-images-now)



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](design/redovisa).

Se till att följande frågor besvaras i redovisningstexten.

* Berätta kort om erfarenheterna med din undersökning av webbplatsers laddningstid.
* Har du några funderingar kring Cimage och dess nytta och features?
* Lyckades du uppnå ett bra sätt och en LESS-struktur för att jobba med dina bilder i webbplatsen?
* I extrauppgiften om `picture`, `srcset` och `sizes`, fick du någon känsla för för- och nackdelar med konceptet?
