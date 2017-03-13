---
author: efo
category: javascript
revision:
  "2017-03-13": (A, efo) Första utgåvan inför kursen webapp v2.
...
En kalender med mithril components
==================================
Vi har i kursmoment 1 och 2 tittat på modeller och vyer i mithril. Ofta vill man kunna återanvända komponenter för att förenkla
utvecklingen av komplexa vyer. Mithril har ett inbyggd sätt att skapa och återanvända komponenter i `m`-funktionen. Dessa återanvändbara komponenter kallas helt enkelt [Components](http://mithril.js.org/components.html) och i denna övningen skall vi titta närmre på dessa.

<!--more-->



Introduktion {#intro}
--------------------------------------

Vi kommer i denna övning bygga en kalender med hjälp av mithril components och [Svenska Dagar](http://api.dryg.net/) api't.



En vy för vår kalendar {#skapa}
--------------------------------------
Det första vi gör är att skapa en vy där vår kalender kommer synas. I och med vi bara ska ha en vy för vår kalender använder vi funktionen `m.mount` för att läsa in vyn från `js/index.js`.

```javascript
// js/index.js
var m = require("mithril");
var Calendar = require("./views/calendar");

var app = {
    initialize: function() {
        document.addEventListener('deviceready', this.onDeviceReady.bind(this), false);
    },
    onDeviceReady: function() {
        m.mount(document.body, Calendar);
    }
};

app.initialize();
```

Vi skapar sedan vyn `js/views/calendar.js`, här importerar vi vår model, som kommer sköta kommunikationen med `https://api.dryg.net` och hantering av svaret. Vi använder livscykel metoden `oninit` för att hämta data.


```javascript
// js/views/calendar.js
var m = require("mithril");

var Calendar_model = require("../models/calendar");

var Day = {
    view: function (vnode) {
        return m("div.day" + vnode.attrs.red_day, [
            m("p", [m("strong", vnode.attrs.date)]),
            m("i", vnode.attrs.weekday)
        ]);
    }
}

module.exports = {
    oninit: function () {
        Calendar_model.load()
    },
    view: function() {
        return [
            m("h1", "Calendar"),
            m("div", Calendar_model.days.map(function (day) {
                return m(Day, day);
            }))
        ];
    }
}
```

```javascript
// js/models/calendar.js
var m = require("mithril");

var Calendar = {
    days : [],
    load: function () {
        var apiURL = "https://api.dryg.net/dagar/v2.1/2017/04";

        return m.request({
            method: "GET",
            url: apiURL
        }).then(function (result) {
            Calendar.days = result.dagar.map(function (dag) {
                return { date : dag.datum, weekday : dag.veckodag, red_day : dag["röd dag"] === "Ja" ? ".red-day" : "" };
            });
        });
    }
}

module.exports = Calendar;
```

[FIGURE src=/image/snapvt17/calendar-android.png caption="Vår kalendar i android emulatorn."]



Avslutningsvis {#avslutning}
--------------------------------------

Det finns många olika varianter på MVC-liknande ramverk för klientbaserad utveckling av JavaScript. På webbplatsen [TodoMVC](http://todomvc.com/) kan du se en översikt av några av dem och jämföra hur deras kod ser ut när man bygger en Todo applikation.

Att använda designmönstret MVC kan ge dig en god uppdelning av din kod i olika delar som har olika syften. Det ger en god grund för en bra arkitektur i din applikation.

I denna övning har vi tittat på M delen av MVC och hur vi hämtar data med hjälp av mithrils `m.requests`. I detta och kommande kursmoment kommer vi titta på ytterligare api:n och både hur vi hämtar och ändrar med hjälp av `m.requests` och api funktioner.
