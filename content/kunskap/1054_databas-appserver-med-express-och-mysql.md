---
author: mos
category:
    - nodejs
    - javascript
    - express
    - mysql
    - kursen dbjs
revision:
    "2017-03-22": (A, mos) Första utgåvan i kursen dbjs.
...
Databas appserver med Express och MySQL
==================================

[FIGURE src=image/snapvt17/image/snapvt17/express-mysql-search-u.png?w=c5&a=10,50,50,0&cf class="right"]

Vi har tidigare sett hur vi kan bygga en applikations- och webbserver med hjälp av Node.js och modulen Express. Nu vill vi se hur vi från en sådan appserver kan jobba mot databasen MySQL.

Servern skall både servera statiska filer som bilder, CSS och JavaScript tillsammans med mer dynamiska routes som jobbar mot databasen.

Som template-motor använder vi Pug, den hjälper oss att rendera HTML-sidor med dynamisk information från JavaScript och databasen.

<!--more-->



Förutsättning {#pre}
--------------------------------------

Du har jobbat igenom artiklarna "[Node.js webbserver med Express](kunskap/nodejs-webbserver-med-express)","[MySQL och Node.js](kunskap/mysql-och-nodejs)" och "[Node.js, MySQL och Promise](kunskap/nodejs-mysql-och-promise)".

Exempelprogram finns i ditt kursrepo (dbjs) under `example/nodejs/express-mysql`.



Grunden till appservern {#grunden}
--------------------------------------

Vi har sedan tidigare grunden i hur man bygger upp en appserver med Express som kan hantera både statiska resurser och dynamiska sidor via en templatemotor.

Det ser ut ungefär så här, om man skapar en god grundstruktur för själva applikationen, delvis genom att återanvända det vi lärt oss tidigare.

```bash
dbjs/example/nodejs/express-mysql$ tree .
.
├── app.js
├── database.js
├── index.js
├── public
│   ├── css
│   │   └── style.css
│   ├── img
│   │   └── mos.jpg
│   ├── js
│   │   └── move.js
│   └── page.html
├── routes
│   ├── database.js
│   └── index.js
└── views
    ├── database.pug
    ├── error.pug
    ├── incl
    │   ├── footer.pug
    │   ├── header-database.pug
    │   └── header.pug
    ├── index.pug
    ├── page.pug
    └── search.pug

7 directories, 17 files
```

Filen `app.js` bygger upp själva servern och exporterar den.

```javascript
/**
 * App for trying out database access from MySQL
 */
"use strict";

// Essentials
const express = require("express");
const path = require("path");

// Load the routes
const index = require("./routes/index");
const database = require("./routes/database");

const app = express();

// view engine setup
app.set("views", path.join(__dirname, "views"));
app.set("view engine", "pug");

// Mount static resources
app.use(express.static(path.join(__dirname, "public")));

// Load all routes on their mountpoint
app.use("/", index);
app.use("/db", database);

// catch 404 and forward to error handler
app.use(function(req, res, next) {
    var err = new Error("Not Found");
    err.status = 404;
    next(err);
});

// Export the app object for anyone wanting to use it
module.exports = app;
```

Via `index.js` kan vi nu starta upp appen.

```javascript
#!/usr/bin/env node
"use strict";

// Get the app
const app = require("./app");

// Start up server
console.log("Express is ready.");
app.listen(1337);
```

Det är grunden, låt se om det fungerar.



Verifiera att grunden fungerar {#verifiera}
---------------------------------------

Låt oss starta upp en server för att se att installationen gick bra.

```bash
$ node index.js
Express is ready.
```

Sedan öppnar vi en webbläsare mot servern och accessar `page.html` som bör leda till resursen `public/page.html`.

[FIGURE src=image/snapvt17/express-mysql-index.png caption="Index-sidan visas som vi förväntar oss."]

Vi prövar en felaktig route för att se att felhanteraren och templatemotorn är på plats.

[FIGURE src=image/snapvt17/express-mysql-404.png caption="Felmeddelande visas som tänkt."]

Nu testar vi en korrekt route, defaultrouten från `route/index.js`.

```javascript
/* The default route, home page. */
router.get("/", function(req, res) {
    res.render("index", {
        title: "Index route | Express",
        message: "This is the index route"
    });
});
```

[FIGURE src=image/snapvt17/express-mysql-index-route.png caption="defaultrouten renderar sidan via vyn `views/index.pug`."]

Grunden är på plats och det verkar fungera.



En modul för MySQL Promise {#mysqlpromise}
--------------------------------------

Vi börjar med hanteringen av databasen via en modul `database.js` som samlar databaskoden för kopplingen mot databasen och ett promise för att ställa frågor.

Det ser ut så här.

```javascript
/**
 * An own module for the database.
 */
"use strict";

const mysql = require("mysql");
const connection = mysql.createConnection({
    host     : "localhost",
    user     : "user",
    password : "pass",
    database : "nodedb"
});

const database = {};

connection.connect();



/**
 * Doing a MySQL query within a Promise.
 *
 * @param  string sql   SQL to be queried.
 * @param  Array  param Parameters to match placeholders
 *
 * @return object with result from query.
 */
database.queryPromise = (sql, param) => {
    return new Promise((resolve, reject) => {
        connection.query(sql, param, (err, res) => {
            if (err) {
                reject(err);
            }
            resolve(res);
        });
    });
};



module.exports = database;
```

Modulen kopplar upp sig mot själva databasen samt exporterar en funktion som gör en databasfråga inom ett promise.

Modulen tar vi och importerar i modulen `routes/database.js` där vi bygger de routes som skall använda databasen.

Här ser du hur det fungerar tillsammans med en första route `/test1` som ställer en fråga mot databasen, via `queryPromise()`.

```javascript
/**
 * Database example routes
 */
"use strict";

const express = require("express");
const router = express.Router();

const database = require("../database");



/**
 * Doing a SELECT with 2 + 2-
 */
router.get("/test1", function(req, res) {
    var data = {};

    data.message = "Doing 2 + 2 using SELECT.";
    data.sql = "SELECT 2 + 2 AS solution;";

    database.queryPromise(data.sql)
    .then((result) => {
        data.resultset = result;
        res.render("database", data);
    })
    .catch((err) => {
        throw err;
    });
});
```

Frågan vi ställer mot databasen kräver en koppling men ingen tabell, frågan räknar ut 2 + 2. Vi kan se att metoden `queryPromise()` används och den omsluter databasfrågan i ett promise så vi undviker problem med asynkrona händelser.

De routes som ligger i filen `routes/database.js` är monterade på grundrouten `/db`, så routen till till test1 blir `db/test1`.

Var en route-fil monteras styrs av `app.js`. Så här ser det ut.

```javascript
// Load the routes
const index = require("./routes/index");
const database = require("./routes/database");

// Load all routes on their mountpoint
app.use("/", index);
app.use("/db", database);
```

Låt oss testa routen, så här kan det se ut.

[FIGURE src=image/snapvt17/express-mysql-2-2.png?w=w2 caption="En vy visar upp frågan och resultatet från databasen."]

Själva vyn erhåller de variabler som ligger i `data`, i detta fallet `message`, `sql` och en array/objekt `resultset` som innehåller svaret från databasfrågan.

```javascript
res.render("database", data);
```

Vyn får sedan välja hur informationen skall presenteras och i detta fallet ser vyn `views/database` ut så här.

```html
include incl/header-database.pug

p= message

p The SQL was:
pre= sql

p The resultset was:

each row, rownum in resultset
    p= "Row number: " + rownum 
    ul
        each colvalue, colname in row
            li= colname + ": " + colvalue

- console.log(resultset)

include incl/footer.pug
```

Vyn skriver ut informationen från de variabler den har tillgång till och sedan loopar den runt resultsetet och skriver ut det rad för rad.

Templatemotorn innehåller konstruktioner som låter oss loopa genom arrayer och objekt.

I vyn sker även debugging med konstruktionen `- console.log()` som skriver ut på serversidan, det kan vara ett bra sätt att debugga en vy.



Att visa upp innehållet i en tabell {#select-table}
--------------------------------------

Jag gör en ny vy som visar upp innehållet i en tabell. Nu när jag har grunden på plats så är det bara vyn som behövs.

```javascript
/**
 * Selecting all mopeds.
 */
router.get("/test2", function(req, res) {
    var data = {};

    data.message = "Selecting all mopeds.";
    data.sql = `
SELECT * FROM Moped
ORDER BY id DESC
;`;

    database.queryPromise(data.sql)
    .then((result) => {
        data.resultset = result;
        res.render("database", data);
    })
    .catch((err) => {
        throw err;
    });
});
```

Routen har samma struktur som föregående route vi tittade på, men SELECT-frågan är annorlunda och går mot en tabell.

Testar vi routen `db/test2` så ser vi resultatet.

[FIGURE src=image/snapvt17/express-mysql-select-all.png?w=w2 caption="Visa upp allt innehåll i en tabell."]

Nu ser vi den delen i vyn som loopade genom resultsetet, hur den presenterar resultatet.



Att söka i databasen {#search-route}
--------------------------------------

Vi prövar en annan vy som plockar en söksträng från routen och söker efter matchande innehåll i tabellen.

```javascript
/**
 * Searching all mopeds.
 */
router.get("/search/:searchstr", function(req, res) {
    var data = {};

    data.message = "Searching throw all mopeds.";
    data.sql = `
SELECT * FROM Moped
WHERE
    text LIKE ?
;`;
    data.param = [req.params.searchstr];

    database.queryPromise(data.sql, data.param)
    .then((result) => {
        data.resultset = result;
        res.render("database", data);
    })
    .catch((err) => {
        throw err;
    });
});
```

I routen hämtas `searchstr` från routens del via `req.params`, sedan används den parametern som placeholder i databasfrågan.

Söker vi efter mopeder som heter Husqvarna så ser routen ut så här `db/search/Husqvarna`. 

Resultatet ser ut så här.

[FIGURE src=image/snapvt17/express-mysql-search-husqvarna.png?w=w2 caption="Söker efter en specifik moped via namnet."]

Se det som ett exempel som kopplar routens del mot en fråga mot databasen.



Ett sökformulär {#search-form}
--------------------------------------

Om vi vill göra ett mer flexibelt sökformulär så behöver vi ett HTML-formulär där vi kan posta en söksträng, och en route som visar upp resultatet.

Här kan vi göra ett enklare _self-submitting_ formulär, en route som både visar formuläret och hanterar postningen av formuläret.

Låt oss kika på routen.

```javascript
/**
 * Searchform for searching among mopeds.
 */
router.get("/search", function(req, res) {
    var data = {};

    if (req.query.search) {
        data.search = req.query.search;
    }

    if (req.query.doSearch) {
        data.doSearch = true;
        data.sql = `
SELECT * FROM Moped
WHERE
    text LIKE ?
;`;
        data.param = [data.search];

        database.queryPromise(data.sql, data.param)
        .then((result) => {
            data.resultset = result;
            res.render("search", data);
        })
        .catch((err) => {
            throw err;
        });
    } else {
        res.render("search", data);
    }
});
```

Det är lika bra vi kikar på det matchande formuläret samtidigt.

```html
include incl/header-database.pug

p Searching through mopeds

<form method="get" action="/db/search">
    <input type="search" name="search" value="#{search}">
    <input type="submit" name="doSearch" value="Search">
</form>

- console.log(search)
p= doSearch

if doSearch
    p The resultset was:

    each row, rownum in resultset
        p= "Row number: " + rownum 
        ul
            each colvalue, colname in row
                li= colname + ": " + colvalue

    - console.log(resultset)

include incl/footer.pug
```

Den första delen är själva formuläret. Den andra delen är utskriften av sökresultatet, förutsatt att en sökning gjordes.

Låt oss pröva routen `/db/search` och se hur det ser ut.

[FIGURE src=image/snapvt17/express-mysql-search-form.png?w=w2 caption="Ett sökformulär visas och är redo för att söka efter information."]

Nu kan vi fylla i vår söksträng och klicka på knappen. I MySQL står `%` för ett wildcard i en sådan här strängsökning med `LIKE`.

[FIGURE src=image/snapvt17/express-mysql-search-u.png?w=w2 caption="Resultatet från sökningen visas tillsammans med själva formuläret, redo för ny sökning."]

Detta visar grunden i hur du kan skapa formulär och skicka till en route som sedan kan använda sig av informationen för att välja data som skickas till vyn som väljer hur datat skall sammanfogas med HTML-koden.



Avslutningsvis {#avslutning}
--------------------------------------

Detta var ytterligare ett exempel på hur Express kan fungera, nu tillsammans med databasen MySQL.

Denna artikel har en [egen forumtråd](t/6333) som du kan ställa frågor i, eller ge tips.
