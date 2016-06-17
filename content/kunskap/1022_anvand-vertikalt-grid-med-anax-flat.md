---
author: mos
revision:
    2016-06-08: (PA, mos) Pre-release.
category:
    - kurs-design
    - labbmiljo
    - nodejs
    - npm
...
Använd ett vertikalt grid med Anax Flat
===================================

[FIGURE src=/image/dummy class="right"]

Vi har sedan tidigare byggt ett responsivt tema till Anax Flat och nu är det dags att bygga ut det med ett vertikalt grid.

Vi skall använda LESS-moduler för att bygga ut vårt tema, delvis med *mixins* som hjälper oss att implementera ett grid, ett rutmönster där vi placerar ut webbsidans olika element.

<!--more-->

Vi är beroende av hur HTML-koden genereras av Anax Flat och det får vi ta hänsyn till när vi bygger vårt tema. Vi har ett mer eller mindre beroende mellan CSS- och HTML-koden. Låt oss hålla det beroendet till ett minimum.

Låt se hur det kan gå.



Förutsättning {#pre}
-------------------------------

Du har jobbat igenom materialet i artiklarna "[Bygg en me-sida med Anax Flat](kunskap/bygg-me-sida-med-anax-flat)" och "[Bygg ett tema till Anax Flat](kunskap/bygg-ett-tema-till-anax-flat)".



Tekniker för grid {#tekniker}
-------------------------------

Grundern för ett grid kan skapas på olika sätt. I denna artikeln skall vi använda ett klassiskt sätt som bygger på tekniken med *float*. I en senare artikel skall vi testa en nyare teknik som bygger på *flex*.



###Grid med klasser {#class}

I de teknikerna vi väljer så vill vi undvika hårda kopplingar mellan CSS- och HTML-koden. Vissa grid-system har grid-klasser som man behöver lägga in i HTML-koden. Så här.

```html
<div class="row">
    <div class="column-3">
    <div class="column-3">
    <div class="column-3">
    <div class="column-3">
</div>
```

Säg sedan att vi har följande CSS-kod.

```css
.row {
    display: block;
    width: 100%
    
    /* Just to visualize using colors */
    background-color: #ccc;
}

.column-3 {
    width: 
}

```



*exempel från bootstrap.*



https://material.google.com/layout/responsive-ui.html#

http://less2css.org/ för att testa hur less blir css.

http://www.cssfontstack.com/


Installera på Mac OS {#macos}
-------------------------------




Installera på Linux {#linux}
-------------------------------



Verifiera att Node.js fungerar {#test}
-------------------------------

Verifiera att npm fungerar {#test1}
-------------------------------


Avslutningsvis {#avslutning}
------------------------------

Frågor i forumtråd.
