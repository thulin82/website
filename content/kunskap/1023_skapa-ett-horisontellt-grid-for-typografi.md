---
author: mos
revision:
    2016-06-17: (PA, mos) Pre-release.
category:
    - kurs/design
    - anax flat
    - theme
...
Skapa ett horisontellt grid för typografi till Anax Flat
===================================

[FIGURE src=/image/dummy class="right"]

Vi skall skapa ett typografiskt grid. Jag kallar det ett horisontellt grid för att skilja det från det vertikala gridet vi tidigare pratat om. Horisontellt eftersom gridet baseras på rader och egentligen fonternas *baseline*. Ett sådant här grid kan även kallas för baseline grid, men dess syfte är att skapa en rytm i sidan, en rytm som innebär att alla typografiska element delar en och samma multipel av en höjd. En sådan rytm kallas även för vertikal rytm.

<!--more-->

När vi har skapat vårat horisontella grid så är vi redo att integrera det med det vertikala grid vi tidigare skapat. De båda griden skall samverka.

Dessa båda grid blir basen i vår tekniska webbdesign.

http://www.cssfontstack.com/



Förutsättning {#pre}
-------------------------------

Du har jobbat igenom materialet i artiklarna "[Använd ett vertikalt grid med Anax Flat](kunskap/anvand-vertikalt-grid-med-anax-flat)".



Det magiska numret {#magic}
-------------------------------

I ett horisontellt grid så finns det ett magiskt nummer som styr allt. 

Det magiska numret ger radernas höjd i gridet. Ett vanligt magiskt tal är 22. Eller 24. Jag väljer 24 idag.

I bilden nedan finns gröna streck som visualiserar det horisontella gridet. Det är 24 pixlar mellan varje streck. Det är ett magiskt tal --- `@magicNumber: 24px;` --- mellan varje streck.

[FIGURE src=/image/snapvt16/horisontellt-grid.png?w=w2 caption="All typografi lutar mot en rad i det horisontella gridet."]

Det magiska talet är delvis framräknat utifrån basfontens storlek. Normalt är basfonten 16px i en webbläsare.

Den andra delen är basfontens *line-height*, radhöjd. En line-height motsvarande 1 ger 16 pixlar och inget mellanrum mellan raderna. Radernas mellanrum är viktigt för texters läsbarhet. Fontens utseende kan kräva olika radhöjder. Två vanliga radhöjder är 1,375 och 1,5.

Det ger oss två olika magiska tal, 22 eller 24, enligt följande.

```less
/**
 * Magic number for vertical rythm
 * @magicNumber = @fontSizeBody * @lineHeight
 */
@magicNumber:   24px;   /* 16px - 100%/1.5 */
//@magicNumber:   22px; /* 16px - 100%/1.375 */
@fontSizeBody:  16px;
@fontSizeBody:  16px;
@lineHeight:    (unit(@magicNumber) / unit(@fontSizeBody));
```

Som jag sa, jag väljer 24 för mitt exempel idag.



Att matcha de typografiska elementens storlek och radhöjd {#magic}
-------------------------------

Så, jag har valt ett magiskt nummer och nu måste jag skapa alla typografiska element så att deras storlek och radhöjd blir en multipel av mitt `@magicNumber`.

Begrunda följande tabell med uträkningar.

```less
/**
 * Size and lineheight calculation for magicNumber 24
 *
 * 3em     * 16px   = 48 => line-height: 48    = 1
 * 2.875em * 16px   = 46 => line-height: 48/44 = 1.0435
 * 2.75em  * 16px   = 44 => line-height: 48/44 = 1.0909
 * 2.625em * 16px   = 42 => line-height: 48/42 = 1.1429
 * 2.5em   * 16px   = 40 => line-height: 48/40 = 1.2
 * 2.375em * 16px   = 38 => line-height: 48/38 = 1.2632
 * 2.25em  * 16px   = 36 => line-height: 48/36 = 1.3333
 * 2.125em * 16px   = 34 => line-height: 48/34 = 1.4118
 * 2em     * 16px   = 32 => line-height: 48/32 = 1.5
 * 1.875em * 16px   = 30 => line-height: 48/30 = 1.6
 * 1.75em  * 16px   = 28 => line-height: 48/28 = 1.7143
 * 1.625em * 16px   = 26 => line-height: 48/26 = 1.8462
 * 1.5em   * 16px   = 24 => line-height: 24    = 1
 * 1.375em * 16px   = 22 => line-height: 24/22 = 1.0909
 * 1.25em  * 16px   = 20 => line-height: 24/20 = 1.2
 * 1.125em * 16px   = 18 => line-height: 24/18 = 1.3333
 * 1em     * 16px   = 16 => line-height: 24/16 = 1.5
 * 0.875em * 16px   = 14 => line-height: 24/14 = 1.7143
 * 0.75em  * 16px   = 12 => line-height: 24/12 = 2
 */
```

Vänstra delen av tabellen rör elementets fontstorlek. Därefter kommer en beräkning med en multipel av `@magicNumber` som ger en radhöjd. Sista siffran är alltså den line-height som tillsammans med vald fontstorlek ger att det typgrafiska eleements höjd kommer att matcha det tänkta gridet.

Mycket beräkningar och det finns naturligtvis en liknande tabell för det magisak talet 22.

Till vår räddning är mixins. Med lite tur och lite baskunskaper i matematik så kan vi översätta ovan tabell till en formel som passar in i en mixin. Syftet med mixinen är att hjälpa oss beräkna radhöjden utifrån en godtycklig fontstorlek.

```less
.fontSize(@fontSize) {
    font-size: @fontSize;
    line-height: @lineHeight / unit(@fontSize) * ceil(unit(@fontSize) / @lineHeight);
}
```

Kan du se att formeln för lineheight matchar uträkningarna i tabellen ovan?

Du kan nu använda mixinen när du bestämmer fontstorleken på till exempel en `H1`, så här.

```less
h1 {
    .fontSize(2.375em);
}
```

Ta din kod ovan och testkör den i [LESS2CSS](http://less2css.org) för att se vad som genereras.

Om du gjort rätt bör du få en konstruktion som ser ut så här.

```less
h1 {
  font-size: 2.375em;
  line-height: 1.26315789;
}
```

Konstruktioner ser ut att stämma bra med tabellen ovan. För att testa kan vi sedan multiplicera fontens storlek med radhöjden och det bör bli vårt magiska tal, eller iallafall en multipel av vårt magiska tal.

Detta var den svåra biten. Nu gäller det bara att använda mixinen och säkerställa att samtliga typografiska element håller sig till vårt `@magicNumber`.





Att sätta basfonten {#font}
-------------------------------











































Avslutningsvis {#avslutning}
------------------------------

Frågor i forumtråd.
