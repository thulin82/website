---
author: mos
revision:
  "2015-10-15": (A, mos) Första utgåvan för kursen.
updated: "2015-11-29 15:34:00"
created: "2015-10-06 19:40:23"
...
Kmom01: JavaScript och WebGL
==================================

Du kommer igång med en labb- och utvecklingsmiljö som stödjer utveckling av HTML, CSS och JavaScript tillsammans med WebGL. Du testar på programmering i JavaScript, bygger en sandbox för dina tester och du skapar dina första WebGL-ritningar i webbläsaren.

<!--more-->


Så här långt kommer du när du läst boken och testat dess exempel.

[FIGURE src=/image/snapht15/webgl-sandbox2-point-random-color.png?w=w2 caption="Placera ut punkter på canvasen i olika färger."]



<small>*(Detta är instruktionen för kursmomentet och omfattar det som skall göras inom ramen för kursmomentet. Momentet omfattar cirka 20 studietimmar inklusive läsning, arbete med övningar och uppgifter, felsökning, problemlösning, redovisning och eftertanke. Läs igenom hela kursmomentet innan du börjar jobba. Om möjligt -- planera och prioritera var du vill lägga tiden.)*</small>



Läsanvisningar  {#lasanvisningar}
---------------------------------

*(ca: 4-8 studietimmar)*


###Kurslitteratur  {#kurslitteratur}

Läs följande:

1. [WebGL Programming Guide](kunskap/boken-webgl-programming-guide).
    * Ch 1: Overview of WebGL
    * Ch 2: Your first step with WebGL

I kapitel 2 finns en del exempelprogram som du kan testa direkt i ditt kursrepo `example/webgl/theBook/Chapter2/`, eller via [dbwebb's kopia av kursrepot](webgl/repo/example/webgl/theBook/Chapter2/).



###Artiklar {#artiklar}

Läs följande artiklar för att få bakgrunden till övningarna.

1. Bekanta dig med Mozilla Developers Network (MDN) och börja på [MDN: Web technology for developers](https://developer.mozilla.org/en-US/docs/Web). Där ser du artiklar om de tekniker som kursen hanterar. Här kan du finna hjälp och stöd, du behöver bara lära dig att navigera på webbplatsen. Använd 15 minuter så att du känner dig hemma på webbplatsen och får en känsla för vad den innehåller. Titta främst på delarna för HTML, CSS, JavaScript, DOM och WebGL. 

2. När du är klar med ovanstående så tittar du bland de (MDN) mest [populära demo-programmen i JavaScript](https://developer.mozilla.org/en-US/demos/tag/tech:javascript?sort=likes) för att få en känsla för vad man kan göra med JavaScript i en webbläsare. Kika runt och se om du hittar något extra kul, kanske hittar du något som du vill lära dig hur man gör?



###Video  {#video}

Kika på följande videor.

1. Videon "[The Future of WebGL and Gaming](https://www.youtube.com/watch?v=6lnEmAYVziA)" ger dig en inblick i en möjlig framtid för 3D-spel på webben.



###Föreläsningsmaterial {#slide}

Eventuellt föreläsningsmaterial finner du i kursrepot under [`slide/01.*`](webgl/repo/slide).



###Lästips {#lastips}

Följande källor är relevanta och ger dig en orientering i WebGL och det som krävs för att jobba med WebGL.

1. Webbplatsen [WebGL Fundamentals](http://webglfundamentals.org/) innehåller en samling artiklar som riktar sig till den som precis börjat koda WebGL. Det kan vara bra att använda sig av de artiklarna som komplement till boken. 

1. Webbplatsen [Learning WebGL](http://learningwebgl.com/blog/?page_id=1217) innehåller ett antal lektioner om hur man kommer igång med WebGL. De kan komplettera boken.

1. [Khronos Group](https://www.khronos.org/) driver standardisering och utveckling inom OpenGL och WebGL. Vänd dig till deras webbplats för referensmaterial.

1. Du bör redan vara mycket väl insatt i vektorer, matriser och hur de relaterar till 3D-grafik. Vill du fräscha upp minnet så finns det bra resurser i artikelserien om "[Vector Math for 3D Computer Graphics](http://www.dickbaldwin.com/KjellTutorial/KjellVectorTutorialIndex.htm)".



Övningar & Uppgifter  {#ovningar_uppgifter}
-------------------------------------------

*(ca: 10-12 studietimmar)*



###Labbmiljö {#labbmiljo}

Installera labbmiljön för kursen.

1. [Installera labbmiljön](webgl/labbmiljo) som behövs för kursen.

1. [Installera kommandot `dbwebb`  samt kursrepot för kursen `webgl`](dbwebb-cli/clone).

Om detta är din första dbwebb-kurs så läser du också igenom hela [manual-sidan för kommandot `dbwebb`](dbwebb-cli).



###Övningar {#ovningar}

Börja med att kika på följande introduktionsartiklar om HTML, CSS och JavaScript. Beroende på dina förkunskaper så får du välja hur mycket tid du spenderar på dem. De innehåller grunder och ger dig en introduktion i de olika teknikerna.

* HTML - [Gör din första sida med HTML5](coachen/gor-din-forsta-sida-med-html5)
* CSS - [Styla din sida med CSS och en extern stylesheet](coachen/styla-din-sida-med-css-och-en-extern-stylesheet)
* JavaScript - [Kom igång med JavaScript och skriv din första kod](coachen/kom-igang-med-javascript-och-skriv-din-forsta-kod)



När du är klar med ovanstående introduktionsartiklar så genomför du följande övning.

1. Kom igång och gör ditt första program i JavaScript tillsammans med artikeln "[Kom i gång med HTML, CSS, JavaScript och Canvas](kunskap/kom-i-gang-med-html-css-javascript-och-canvas)".

2. Uppgradera din sandbox till att rita med 3D-kontext och WebGL tillsammans med artikeln "[Kom igång och rita med WebGL på en Canvas](kunskap/kom-igang-och-rita-med-webgl-pa-en-canvas)".



###Uppgifter {#uppgifter}

Dessa uppgifter skall utföras och redovisas.

1. Gör uppgiften "[Rita punkter med WebGL](uppgift/rita-punkter-med-webgl)".

1. Gör uppgiften "[Skapa en me-sida till webgl-kursen](uppgift/skapa-en-me-sida-till-webgl-kursen)".



###Extra {#extra}

Det finns ingen extrauppgift.



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](webgl/redovisa).

Se till att följande frågor besvaras i redovisningstexten.

* Vilken utvecklingsmiljö sitter du på?
* Hur väl känner du dig hemma i webbtekniker som JavaScript, HTML och CSS?
* Hur väl känner du dig hemma i 3D programmering med OpenGL, WebGL eller motsvarande?
* Gick det bra att skapa me-sidan? Var det någon som var svårt att hantera i me-sidan?
* Vad tycker du om kursboken så här långt?
* Berätta lite om hur du löste uppgiften med punkterna. Var det något som var svårt, lurigt eller utmanande?




