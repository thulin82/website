---
author: efo
category: javascript
revision:
  "2017-03-13": (A, efo) Första utgåvan inför kursen webapp v2.
...
Ett enkelt grid för alla våra enheter
==================================

För att våra webapplikationer ska kunna visas på enheter av olika storlekar, allt från mobiltelefoner över surfplattor till stora datorskärmar, måste vi designa våra applikationer så de är läsbara och användarvänliga på alla enheter. Vi skall i denna övning skapa ett grid för att visa upp widgets på 4 olika stora skärmar. Övningen görs enbart i HTML och CSS och kan därför enkelt återanvändas i mithril, men även i andra sammanhang där vi vill visa upp element i ett gridbaserat layout.

<!--more-->



Ett skal i HTML {#html}
--------------------------------------
Vi börjar med att skapa en enkel `index.html` där vi skapar ramarna för att utveckla och testa vårt grid.

```bash
// ställ dig i kursrepot
$ cd me/kmom03/grid
$ touch index.html
```

Vi lägger in minsta möjliga skalet för att visa hemsidan på enheter av olika storlek. Vi lägger även in fem (5) stycken html-element. Det är dessa element vi vill placera ut i en grid-layout och som beroende på enhetens storlek skall lägga sig med olika antal på varje rad.

```html
// index.html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
        <title>Grid</title>
    </head>
    <body>
        <div class="widget">Numero uno</div>
        <div class="widget">Numero due</div>
        <div class="widget">Numero tre</div>
        <div class="widget">Numero quattro</div>
        <div class="widget">Numero cinque</div>
    </body>
</html>
```

Än så länge ser det inte mycket ut för världen, så låt os gå vidare och ge vår widget klass lite styling.



Grid {#grid}
--------------------------------------
Vi inkluderar ett stylesheet style.css i `head`-elementet av `index.html` och skapar css-filen.

```html
<head>
    ...
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
```

När vi jobbar med att designa och testa vårt grid kan det vara en bra ide att nollställa browserns ursprungs `margin` och `padding`, så den inte kommer i vägen.

```css
html, body {
    margin:0;
    padding:0;
}
```

Vi kommer att designa vårt grid med tillgången mobile-first, dvs att vi utgår ifrån den minsta enheten och efter det specificerar styling för större enheter. Vi kommer dessutom använda oss av ett flytande grid så vi kommer använda % av skärmens bredd istället för fasta breddar. Vi definerar alltså grundklassen `.widget` för den minsta enheten som vårt innehåll kommer visas och sen med hjälp av [media-queries](https://developer.mozilla.org/en-US/docs/Web/CSS/Media_Queries/Using_media_queries) definerar vi stylingen för större enheter. På den minsta enheten vill vi att vår `.widget` element skall fylla hela skärmen förutom en marginal på 1% på varje sida och dessutom en marginal på 10 pixlar till nästa element. Jag har dessutom lagt till en border så vi ser hur stora elementen är. Jag ger även elementen en fast höjd och en padding för att det skall bli snyggare. Jag använder [box-sizing](https://developer.mozilla.org/en/docs/Web/CSS/box-sizing) attributet med värder `border-box` för att paddingen ingår i den totala bredden av elementet.

```css
.widget {
    border:2px solid #CCC;
    width: 98.0%;
    margin: 0 1.0% 10px;
    height:150px;
    padding:10px;
    box-sizing: border-box;
}
```

Våra element visas nu efter varann i en lång lista precis som vi har förväntat oss.

[FIGURE src=/image/snapvt17/responsive-grid-small.png caption="Vårt grid för minsta enheten."]


Vi fortsätter nu med gridet för större enheter. För enheter större än 500 pixlar vill vi ha element i två kolumner. Detta innebär att vi kommer ha 1% marginal till vänster om elementen, 1% + 1% marginal imellan elementen och 1% längst ut till höger. Vi har alltså 100% - 1% - 1% - 1% - 1% = 96% bredd kvar till våra kolumner och med två stycken kolumner blir varje kolumn 48% bredd. Vi har gjort en bra grund definition av vår `.widget`, men två ytterligare definitioner behövs i grund definitionen av `.widget` för att visa våra kolumner på samma rad.

```css
.widget {
    ...
    display: inline;
    float: left;
}
```

Vi skapar den första media-query för att definera våra två kolumner för enheter större än 500 pixlar.

```css
@media (min-width: 500px) {
    .widget {
        width: 48.0%;
    }
}
```

På samma sätt som ovan definerar vi media-queries för enheter större än 700 pixlar och för enheter större än 980 pixlar.

```css
@media (min-width: 700px) {
    .widget {
        width: 31.3333333333333%;
    }
}

@media (min-width: 980px) {
    .widget {
        width: 23%;
    }
}
```

[FIGURE src=/image/snapvt17/responsive-grid-big.png caption="Vårt grid för största enheten."]



Avslutningsvis {#avslutning}
--------------------------------------

Vi har nu skapat ett grid som vi kan använda för att visa upp element i en grid layout. Detta är ett mycket enkelt grid layout, men som uppfyller de krav vi hade på det med 36 rader CSS kod. Du är välkommen att bygga vidare på gridet och kanske ligga till en 5:e nivå för att visa upp på extra stora skärmar.
