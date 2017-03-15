---
author: mos
category:
    - nodejs
    - javascript
    - express
    - kursen dbjs
revision:
    "2017-03-15": (A, mos) Första utgåvan i kursen dbjs.
...
Node.js webbserver med Express 
==================================

[FIGURE src=/image/snapvt17/npm-mysql.png?w=c5 class="right"]

Vi skall bygga en webbserver med hjälp av Node.js och modulen Express.

Webbservern skall både servera statiska filer som bilder, CSS och JavaScript tillsammans med mer dynamiska routes.

<!--more-->



Förutsättning {#pre}
--------------------------------------

Du kan grunderna i Node.js och JavaScript på serversidan.

Exempelprogram finns i ditt kursrepo (dbjs) under `example/nodejs/express`.



Installera modulen med npm {#npm}
--------------------------------------

Modulen [Express finns på npm](https://www.npmjs.com/package/express). Express är också en del av [MEAN](http://mean.io/) som är en samling moduler för att bygga webbapplikationer med Node.js. Men här kommer vi enbart att använda Express.

Jag går till kursrepot och installerar modulen med npm.

```bash
# Ställ dig i rooten av ditt kursrepo.
$ npm install express
```

Klart. Då testar vi om installationen gick bra.



Verifiera att Express fungerar {#verifiera}
---------------------------------------

Låt oss starta upp en server för att se att installationen gick bra.

Jag börjar med kod som startar upp servern tillsammans med en route och sparar i `index.js`.

```javascript
#!/usr/bin/env node
"use strict";

// Create the app objekt
var express = require("express");
var app = express();

// Add a route
app.get("/", (req, res) => {
    res.send("Hello World");
});

// Start up server
console.log("Express is ready.");
app.listen(1337);
```

Sedan startar jag servern.

```bash
$ node index.js
Express is ready.
```

Nu kan jag skicka requester till servern via curl.

```bash
$ curl localhost:1337
Hello World
```

Om jag använder en route som inte finns så får jag en 404 tillsammans med ett svar som säger att routen inte finns.

```bash
$ curl -i localhost:1337/asd
HTTP/1.1 404 Not Found                        
X-Powered-By: Express                         
Content-Security-Policy: default-src 'self'   
X-Content-Type-Options: nosniff               
Content-Type: text/html; charset=utf-8        
Content-Length: 134                           
Date: Wed, 15 Mar 2017 08:47:43 GMT           
Connection: keep-alive                        
                                              
<!DOCTYPE html>                               
<html lang="en">                              
<head>                                        
<meta charset="utf-8">                        
<title>Error</title>                          
</head>                                       
<body>                                        
<pre>Cannot GET /asd</pre>                    
</body>                                       
```

Pröva nu samma routes via din webbläsare.

Det verkar som allt gick bra och servern är uppe och snurrar.



Läs på om Express {#laspa}
--------------------------------------

Vi vänder oss nu till dokumentationen för Express för att ytterligare se vad man kan göra med Express. Informationen hittar vi på [webbplatsen för Express](http://expressjs.com/). 

Låt oss komma igång med grunderna i Express och hur man sätter upp en applikationsserver som även kan fungera som en vanlig webbserver.



Statiska resurser {#static}
--------------------------------------

En sak som är vanlig i en webbplats är statiska resurser såsom bilder, stylesheets och JavaScript-filer. Kanske även rena HTML-filer som inte kräver någon extra processing.

I Express kan vi montera en (eller flera) kataloger och använda den som en statisk resurs.

```javascript
const path = require("path");

// Serve static files
var staticFiles = path.join(__dirname, "public");
app.use(express.static(staticFiles));
```

Ovan kod lägger jag i min `index.js`.

Säg att katalogen public nu har följande struktur och innehåll.

```bash
$ tree public/
public/
├── css
│   └── style.css
├── img
│   └── mos.jpg
├── index.html
└── js
    └── move.js

3 directories, 4 files
```

Filen `public/index.html` innehållser följande kod som i sin tur inkluderar både bild, stylesheet och javascript.

```html
<!doctype html>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Try out Express</title>

<body>
<h1>Trying out Express</h1>
<p>Hover on the image and it should move around.</p>
<img id="image" src="img/mos.jpg">
<script src="js/move.js"></script>
</body>
```

Om man nu startar om Express-servern och accessar routen `localhost:1337/index.html` med webbläsaren, så bör man se följande.

[FIGURE src=image/snapvt17/express-static.png?w=w2 caption="En webbsida med enbart statiska resurser i Express."]

Klicka på bilden, om den flyttar sig så fungerar även JavaScriptet. Tänk på att du kan titta i devtools för att se vilka resurser som sidan laddar.

[FIGURE src=image/snapvt17/express-loaded-resources.png?w=w2 caption="Networks-fliken visar vilka resurser som sidan laddar."]

Det var de statiska resurserna det. Bra, bra.



Routing mot request metoder {#routemet}
--------------------------------------

En route sätts upp för att svara mot en speciell request metod såsom GET, POST, PUT, DELETE. Det är på det sättet man bygger upp en RESTful tjänst.

Här är fyra routes som har samma url, men skiftar i requestens metod.

```javascript
// Testing routes with method
app.get("/user", (req, res) => {
    res.send("Got a GET request at " + req.originalUrl);
});

app.post("/user", (req, res) => {
    res.send("Got a POST request at " + req.originalUrl);
});

app.put("/user", (req, res) => {
    res.send("Got a PUT request at " + req.originalUrl);
});

app.delete("/user", (req, res) => {
    res.send("Got a DELETE request at " + req.originalUrl);
});
```

Om du testar med din webbläsare så blir det en GET request.

För att testa de andra metoderna så använder jag en plugin till Firefox som heter RESTClient. Med den kan jag välja om jag skall skicka en GET, POST, PUT, DELETE eller någon annan av de metoder som finns. En sådan REST-klient är ett värdefullt utvecklingsverktyg.

Så här ser det ut när jag skickar en request med en annan metod än GET.

[FIGURE src=image/snapvt17/express-rest-client.png?w=w2 caption="En DELETE request skickas tll servern som svarar från rätt route."]

Det var routes och stöd för olika metoder det.



Felhantering med routes {#routefel}
--------------------------------------

När användaren accessar en route som inte finns så blir det statuskod 404.

[FIGURE src=image/snapvt17/express-default-404.png?w=w2 caption="Ett standard felmeddelande när routen saknas."]

Man kan lägga till en egen route som agerar kontrollerad felhanterare.



Vyer {#vyer}
--------------------------------------

och templateengine

samt POST formulär.




Avslutningsvis {#avslutning}
--------------------------------------

Du har nu fått en genomgång i hur MySQL kan fungera tillsammans med Node.js. Du är redo att börja skriva ditt egna program.

Denna artikel har en [egen forumtråd](t/6270) som du kan ställa frågor i, eller ge tips.
