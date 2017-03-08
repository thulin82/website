---
author: efo
category: javascript
revision:
  "2017-03-03": (A, efo) Första utgåvan inför kursen webapp v2.
updated: "2017-03-06"
created: "2017-03-03"
...
Kom igång med ramverket Mithril
==================================

[FIGURE src=/image/snapht15/mithril-logo.png class="right"]

En SPA är en *single page application* som är skriven i HTML, CSS och JavaScript och laddas som en sida. Det är ett sätt att skriva webbapplikationer som är fokuserade i webbläsaren. För att skriva den typen av applikationer så är det inte ovanligt att använda ett MVC-liknande ramverk som ger tillgång till ett visst grundstöd till hur man skriver sin kod.

Mithril är ett sådant ramverk och vi skall nu bekanta oss med hur Mithril kan användas för att skapa SPA-applikationer.

<!--more-->



Introduktion {#intro}
--------------------------------------

Du kan läsa mer om [begreppet SPA på Wikipedia](https://en.wikipedia.org/wiki/Single-page_application).

Vi kommer installera och använda [Mithril](http://mithril.js.org/) för att bygga en enkel applikation som hämtar JSON-data från en server, använder sig av en router och renderar vyerna via en template.

Låter det magiskt? Lika bra vi ser hur det fungerar i kod, så faller saker nog på plats.

Det är bra om du är bekant med [MVC-liknande tekniker](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller). Men det är inte nödvändigt, det här kommer att gå bra ändå. Det handlar bara om att strukturera sin kod.

Du kan testa samtliga exemplel i artikeln via  i kursrepot som ligger på dbwebb i katalogen [`example/mithril`](webapp/repo/example/mithril/). Källkoden för exemplet hittar i i ditt kursrepo eller på [GitHub](https://github.com/mosbth/webapp/tree/master/example/mithril).



Förutsättningar {#forutsattningar}
--------------------------------------
Du har installerat labbmiljön för kursen webapp.

Du har installerat cordova och skapat Hello World cordova appen enligt [Kom igång med cordova](). Vi utgår ifrån denna cordova app när vi i denna övning jobbar vidare med cordova och introducerar javascript ramverket mithril.



Installera mithril via npm {#install}
--------------------------------------
Vi har i tidigare kurser använd pakethanteraren npm för att installera javascript och nodejs moduler. Vi kommer i denna kurs använda npm för att installera och administrera vår mithril installation och beroende kod. Detta görs med hjälp av en `package.json` fil, som vi initiellt skapar genom att skriva följande i terminalen:

```bash
$ cd meapp/www
$ npm init --yes
```

Vi har nu skapat vår egna paket fil för just detta projektet som än så länge inte innehåller mycket, men som vi i denna guide kommer bygga på. Vi ska nu installera mithril och webapck via npm och gör det med följande kommandon. Vi använder `--save` för att det ska sparas som en modul vi är beroende av i `package.json`. Webpack installerar vi för att vi kan importera och exportera kod i mithril.

```bash
$ npm install mithril --save
$ npm install webpack --save
```

Det kan hända att du får varningar när du kör ovanstående kommandon, men dessa kan du ignorera för nu.

Låt oss nu titta in i `package.json`, för att se vad vi har fått på plats och lägga till så vi kan köra våra mithril applikationer.

```json
{
  "name": "meapp",
  "version": "1.0.0",
  "description": "A me-app in mithril",
  "main": "index.js",
  "scripts": {
    "test": "echo \"Error: no test specified\" && exit 1"
  },
  "keywords": [],
  "author": "",
  "license": "ISC",
  "dependencies": {
    "mithril": "^1.0.1",
    "webpack": "^2.2.1"
  }
}
```

I scripts attributet ändrar vi så det blir följande för att löpande under utveckling packa ihop koden till en fil `bin/app.js` med hjälp av webpack:

```json
  "scripts": {
      "start": "webpack js/index.js bin/app.js -d --watch"
  }
```



Vår första mithril app {#forsta}
--------------------------------------
Vi skapar först vår ingångspunkt får vår app `index.html` med följande innehåll:

```html
<html>
  <head>
    <title>mithril me-app</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <script src="bin/app.js"></script>
  </body>
</html>
```

Här skapar minsta möjliga ramarna för att visa en hemsida i en webbläsare på både datorn och mobilen. Vi inkluderar `bin/app.js` som är vår mithril skapat och ihoppackat av webpack.

All vår mithril kod placerar vi en egen katalog `js` med hjälp av dessa kommandon:

```bash
$ mkdir js/views
$ touch js/index.js
$ touch js/views/me.js
```

`js/index.js` filen är vårt utgångspunkt för appen och den pekar ut vad som ska visas när en användare kommer till vår app. Vi skapar desutom en katalog för våra vyer, med vårt första mithril vy `me.js`.



Vår första vy {#vy}
--------------------------------------

I vår `js/views/me.js` fil vill vi än så länge bara visa upp vårt egna namn. Vi importerar först mithril och lägger till vårt vy som en modul. Alla vy-moduler har en funktion med namnet view som returnerar de element som ska visas upp i vyen. Här vill vi bara visa vårt egna namn i en `<h1>` tag, så bytt gärna ut mitt namn mot ditt.

```javascript
var m = require("mithril")

module.exports = {
    view: function() {
        return m("h1", "Emil Folino")
    }
}
```

För att appen ska veta om att vi vill visa upp vårt me-vy måste vi in i appens utgångspunkt (`js/index.js`) och peka ut vyn. Vi anger först i vilket html-element vår vy skall renderas och skickar sedan med vår vy till funktionen `m.mount`:

```javascript
var m = require("mithril")

var Me = require("./views/me")

m.mount(document.body, Me)
```

Nu behöver vi bara packa ihop vår mithril app med hjälp av webpack för att se me-appen för första gång. Detta gör vi terminalen med följande kommando, som vi definerade tidigare i `package.json`.

```bash
$ npm start
```

Öppna upp din `index.html` fil i webbläsaren och vi ser än så länge vår lilla me-sida med endast ditt namn.


En router för flera sidor {#router}
--------------------------------------
Med bara en sida i vår har vi inte kommit långt så låt oss titta på hur vi lägger till ytterligare en vy och en router så vi kommer åt vyn. Först skapar vi filen `js/views/hobby.js` och precis som `me.js` definerar våra nya `hobby.js` en vy. I detta vy ser du att vi returnerar en array av objekt som placeras i ordning efter varann i vyn.

```javascript
var m = require("mithril")

module.exports = {
    view: function() {
        return [
            m("h1", "My hobby"),
            m("p", "I run orienteering most of the time.")
        ]
    }
}
```

I vår `index.js` ändrar vi så istället för att använda funktion `m.mount()` använder vi funktionen `m.route()`. Route funktionen tar tre argument:

1. Vilket element som skall fyllas med de virtuella noder.

1. Vår ursprungsroute som är det vy där appen börjar.

1. Ett objekt som definerar alla routes i appen.

Och vår index.js fil ser nu ut så här:

```javascript
var m = require("mithril");

var Me = require("./views/me");
var Hobby = require("./views/hobby");

m.route(document.body, "/", {
    "/": Me,
    "/hobby" : Hobby
});
```

Om du manuellt skriver in `/hobby` efter `index.html#!` i din webbläsares adressfält, ser du innehållet från din hobby-vy. Vi vill dock inte skriva in adresser manuellt, så vi ska nu titta på hur vi kan skapa navigering för vår app. Vi kan skapa länkar precis som vi har skapat andra virtuella noder tidigare, så vi lägger till en länk längst upp i vårt me-vy med följande kod. Vi kan nu gå från vårt Me-vy till hobby-vyn.

```javascript
m("a", {href: "/hobby", oncreate: m.route.link}, "Hobby")
```



Styling {#styling}
--------------------------------------
Vi vill ju alltid att våra hemsidor, applikationer och program är snygga och användarvänliga, så därför vill vi kunna styla våra sidor. Vi inkluderar därför vår egna css-fil i `index.html`.

```html
<html>
  <head>
    <title>mithril me-app</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet" />
  </head>
  ...
```

Jag valde att lägga till några extra element i min me-vy enligt nedan och en enkel responsiv styling, för ett resultat enligt det som syns nedan. Som du ser nedan har jag lagt in html-element i en array efter det första elementet `div.main-container`, som är en div med klassen `main-container`. Elementen blir barn-element till det yttre och man kan ha så många nivåer man vill i det virtuella dom'et.

```javascript
var m = require("mithril")

module.exports = {
    view: function() {
        return [
            m("a", {href: "/hobby", oncreate: m.route.link}, "Hobby"),
            m("div", [
                m("h1", "Emil Folino"),
                m("p", "My name is Emil, I'm originally from Denmark, but now I live in Sweden."),
                m("p", "I run orienteering and drive an old Saab.")
            ])
        ];
    }
}
```

[FIGURE src="/image/snapvt17/mithril-me-screen.png" caption="Screenshot enkel me-sida i mithril"]



Layout {#layout}
--------------------------------------
Om vi vill ha navigering i alla vyer kan vi lägga till länkar längst upp, men som vanligt vill vi hålla vår kod DRY. I mithril kan vi använda oss av layouts för att återanvända kod i alla vyer. Vi skapar först ett nytt vy `js/views/layout.js`, som blir vår mall för andra vyer.

```javascript
var m = require("mithril")

module.exports = {
    view: function(vnode) {
        return m("main", [
            m("navbar", [
                m("h2", "Emil Folino"),
                m("ul", [
                    m("li", [m("a", {href: "/", oncreate: m.route.link}, "Me")]),
                    m("li", [m("a", {href: "/hobby", oncreate: m.route.link}, "Hobby")])
                ])
            ]),
            m("section", vnode.children)
        ])
    }
}
```

I ovanstående kodexempel skapar vi vår navigation som en navbar med en "logga" och två stycken länkar. Efter navbar skapas ett section-element, som innehåller de virtuella noder från vyn som använder sig av layout. Så lått oss titta på hur vi använder oss av layout från `index.js`.

```javascript
var m = require("mithril");

var Layout = require("./views/layout");
var Me = require("./views/me");
var Hobby = require("./views/hobby");

m.route(document.body, "/", {
    "/": {
        render: function() {
            return m(Layout, m(Me))
        }
    },
    "/hobby": {
        render: function() {
            return m(Layout, m(Hobby))
        }
    }
});
```

Vi använder oss utav en [RouteResolver](http://mithril.js.org/route.html#routeresolver) för att rendera layout och skickar med de virtuella noder, som ska renderas via layouten i vårt vy.

Här under kan ni se ett exempel på en mithril me-app med navigation.

[FIGURE src="/image/snapvt17/mithril-me-screen-final.png" caption="Screenshot enkel me-sida i mithril med navigation"]



Avslutningsvis {#avslutning}
--------------------------------------

Det finns många olika varianter på MVC-liknande ramverk för klientbaserad utveckling av JavaScript. På webbplatsen [TodoMVC](http://todomvc.com/) kan du se en översikt av några av dem och jämföra hur deras kod ser ut när man bygger en Todo applikation.

Att använda designmönstret MVC kan ge dig en god uppdelning av din kod i olika delar som har olika syften. Det ger en god grund för en bra arkitektur i din applikation.

Mithril är en spännande lösning på klientbaserad programmering med JavaScript. Det är inte helt enkelt att komma in i det, men koden är liten och överskådlig.

Har du [tips, förslag eller frågor om artikeln](t/4778) så finns det en specifik forumtråd för det.
