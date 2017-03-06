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

Vi kommer installera och använda [Mithril](http://lhorie.github.io/mithril/) för att bygga en enkel applikation som hämtar JSON-data från en server, använder sig av en router och renderar vyerna via en template.

Låter det magiskt? Lika bra vi ser hur det fungerar i kod, så faller saker nog på plats.

Det är bra om du är bekant med [MVC-liknande tekniker](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller). Men det är inte nödvändigt, det här kommer att gå bra ändå. Det handlar bara om att strukturera sin kod.

Du kan testa samtliga exemplel i artikeln via  i kursrepot som ligger på dbwebb i katalogen [`example/mithril`](webapp/repo/example/mithril/). Källkoden för exemplet hittar i i ditt kursrepo eller på [GitHub](https://github.com/mosbth/webapp/tree/master/example/mithril).



Installera mithril genom npm {#install}
--------------------------------------
Vi har i tidigare kurser använd pakethanteraren npm för att installera javascript och nodejs moduler. Vi kommer i denna kurs använda npm för att installera och administrera vår mithril installation och beroende kod. Detta görs med hjälp av en `package.json` fil, som vi initiellt skapar genom att skriva följande i terminalen:

```bash
$ cd meapp
$ npm init --yes
```

Vi har nu skapat vår egna paket fil för just detta projektet som än så länge inte innehåller mycket, men som vi i denna guide kommer bygga på. Vi ska nu installera mithril via npm och gör det med följande kommandon. Vi använder `--save` för att det ska sparas som en modul vi är beroende av i `package.json`.

```bash
$ npm install mithril --save
```

Du kommer få två varningar när du kör ovanstående kommandon, men dessa kan du ignorera för nu.

Vi har nu installerat mithril, men för att vi kan skriva snygg moduliserad kod, exportera och importera moduler, installerar vi webpack med kommandot `npm install webpack --save`. Låt oss nu titta in i `package.json`, för att se vad vi har fått på plats och lägga till så vi kan köra våra mithril applikationer.

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
      "start": "webpack src/index.js bin/app.js -d --watch"
  }
```



Vår första app {#forsta}
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

All vår mithril kod placerar vi en egen katalog `src` med hjälp av dessa kommandon:

```bash
$ mkdir src src/views
$ touch src/index.js
$ touch src/views/me.js
```

`index.js` filen är vårt utgångspunkt för appen och den pekar ut vad som ska visas när en användare kommer till vår app. Vi skapar desutom en katalog för våra vyer, med vårt första mithril vy `me.js`.



Vår första vy {#vy}
--------------------------------------

I vår `src/views/me.js` fil vill vi än så länge bara visa upp vårt egna namn. Vi importerar först mithril och lägger till vårt vy som en modul. Alla vy-moduler har en funktion med namnet view som returnerar de element som ska visas upp i vyen. Här vill vi bara visa vårt egna namn i en `<h1>` tag, så bytt gärna ut mitt namn mot ditt.

```javascript
var m = require("mithril")

module.exports = {
    view: function() {
        return m("h1", "Emil Folino")
    }
}
```

För att appen ska veta om att vi vill visa upp vårt me-vy måste vi in i appens utgångspunkt och peka ut vyn. Vi anger först i vilket html-element vår vy skall renderas och skickar sedan med vår vy till funktionen `m.mount`:

```javascript
var m = require("mithril")

var Me = require("./views/me")

m.mount(document.body, Me)
```

Nu behöver vi bara packa ihop vår mithril app med hjälp av webpack för att se me-appen för första gång. Detta gör vi terminalen med följande kommando, som vi definerade tidigare i `package.json`.

```bash
$ npm start
```

Öppna upp din `index.html` fil i webbläsaren och vi ser än så länge vår lilla me-sida med endast ditt egna namn.



Styling och layout {#styling}
--------------------------------------
Vi vill ju alltid att våra hemsidor, applikationer och program är snygga och användarvänliga, så därför vill vi kunna styla våra sidor. Vi inkluderar därför vårt egna css i index.html head.



En router för flera sidor {#router}
--------------------------------------



Avslutningsvis {#avslutning}
--------------------------------------

Det finns många olika varianter på MVC-liknande ramverk för klientbaserad utveckling av JavaScript. På webbplatsen [TodoMVC](http://todomvc.com/) kan du se en översikt av några av dem och jämföra hur deras kod ser ut när man bygger en Todo applikation.

Att använda designmönstret MVC kan ge dig en god uppdelning av din kod i olika delar som har olika syften. Det ger en god grund för en bra arkitektur i din applikation.

Mithril är en spännande lösning på klientbaserad programmering med JavaScript. Det är inte helt enkelt att komma in i det, men koden är liten och överskådlig.

Har du [tips, förslag eller frågor om artikeln](t/4778) så finns det en specifik forumtråd för det.
