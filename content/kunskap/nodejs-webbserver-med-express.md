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

Modulen [Express finns på npm](https://www.npmjs.com/package/express). Express är också en del av [MEAN](http://mean.io/) som är en samling moduler för att bygga webbapplikationer med Node.js. I denna artikeln kommer vi enbart att använda Express.

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

Man kan lägga till en egen route som agerar kontrollerad felhanterare för routes som inte finns.

```javascript
// Add routes for 404 and error handling
// Catch 404 and forward to error handler
app.use((req, res, next) => {
    var err = new Error("Not Found");
    err.status = 404;
    next(err);
});
```

Ovan så använder min felhanterare den inbyggda felhanteraren för när saker går fel, det sker via anropet `next(err)`. 

[FIGURE src=image/snapvt17/express-default-error-handler.png?w=w2 caption="Den inbyggda felhanteraren ger ett fel och en stacktrace."]

Det finns alltså en inbyggd default felhanterare som visar upp information om felet, tillsammans med en stacktrace. Det är användbart när man utvecklar.

När node startar upp express så är det i utvecklingsläge. Du kan testa att starta upp i produktionsläge, det ger mindre information i felmeddelandena.

```bash
$ NODE_ENV="production" node index.js
```

Nu försvann stacktracen från klienten, men den syns fortfarande där servern körs.

[FIGURE src=image/snapvt17/express-error-handling-production.png?w=w2 caption="I production så visar inte stacktrace för klienten."]

När vi utvecklar så får det bli development läge som också är standard, men när man sätter en server i produktion så får man se till att det också är produktionsläge för felmeddelandena.



Vyer {#vyer}
--------------------------------------

Låt oss kika på hur vi kan rendera svar som är en kombination av HTML och utskrift av JavaScript variabler.



###Template-motor pug {#pug}

Till det behöver vi en template-motor och det finns många att välja på, men vi håller det enkelt och tar [Pug](https://www.npmjs.com/package/pug) som är den som används i manualen för express.

```bash
# Gå till rooten av kursrepot.
$ npm install pug
```

[Manualen till Pug](https://pugjs.org/api/getting-started.html) finner vi på deras hemsida. Den är bra att ha tillhanda nu.



###Pug med Express {#pgexpr}

Nu behöver vi säga till Express att vi vill använda Pug som template-motor samt skapa ett par vy-filer.

```javascript
// Use app as template engine
app.set('view engine', 'pug');
```



###En vy-fil {#viewfile}

Express förutsätter att vy-filerna finns i katalogen `views/*.pug`.

```bash
$ mkdir views
$ touch views/page.pug
```

Spara följande kod som `views/page.pug`.

```text
doctype html
html
head
    title= title
    link(rel="stylesheet", href="/css/style.css")
body
    h1= message
    p This is a plain paragraph with a url. Here comes <a href="/test/page">the actual link</a>.
    p Here is a image <img id="image" src="/img/mos.jpg">.

    script(src="/js/move.js")
```

Med Pug kan man skriva enligt deras egen variant av förenklad HTML och kombinera den med vanlig HTML, samtidigt kan man skriva ut innehållet från de medskickade JavaScript-variablerna inuti HTML-koden.



###En route som renderar en vy {#rendera}

Nu behöver vi en route som kan rendera vyn.

```javascript
app.get("/test/page", (req, res) => {
    res.render("page", {
        title: "Hey",
        message: "Hello there!"
    });
});
```

När allt fungerar ihop så kan vi testa routen och få fram följande sida.

[FIGURE src=image/snapvt17/express-pug-page.png?w=w2 caption="En HTML-sida genererad via en Pug-vy inklusive dynamisk information från JavaScript."]


###Än mer dynamiskt innehåll {#routepara}

Vi kan få innehållet i sidan att ändra sig beroende på hur routen ser ut. Om vi parametriserar routens delar så kan vi skriva så här.

```javascript
app.get("/test/:title/:message", (req, res) => {
    console.log(req.path);
    console.log(req.params);
    res.render("page", {
        title: req.params.title,
        message: req.params.message
    });
});
```

Det är ett sätt att fånga en route som heter `/test/some-title/some-message` eller routen `/test/My Title/No particular message`.

Resultatet kan se ut så här.

[FIGURE src=image/snapvt17/express-route-params.png?w=w2 caption="Innehållet i HTML-sidan kommer från routens innehåll."]

En udda sida måhända, men den får demonstrera hur man kan jobba med dynamisk information och paramtriserade routes.

På serversidan ser du innehållet i request objektet som visar både den route (path) som användes och hur delarna av routen översattes till inkommande parametrar.

```bash
$ node index.js
Express is ready.
/test/My%20Title/No%20particular%20message
{ title: 'My Title', message: 'No particular message' }
```

Webbläsaren converterar, urlencodar, länken där mellanslagen byts ut mot `%20`. När länken tas emot som en route och översätts till parametrar, så gör Express urldecode på innehållet. Det är ett sätt att hantera udda tecken i en webblänk och sker automatiskt av webbläsaren och Express.

Det fungerar så här.

```bash
$ node                       
> a = encodeURIComponent("Jag kan svenska åäö")
'Jag%20kan%20svenska%20%C3%A5%C3%A4%C3%B6'     
> b = decodeURIComponent(a)                    
'Jag kan svenska åäö'                          
>                                              
```

Nåväl, åter till vyerna.



###Inkludera vyer {#inclview}

Du kan bygga upp en vy-struktur med header och footer så att du återanvänder vyer och du förenklar hur du gör webbplatsens utseende likadant på alla sidor.

Låt oss göra en ny testroute `/test/home/:title/:message` som renderar en ny vy som vi kallar `home`.

Först skapar vi routens hanterare.

```javascript
app.get("/test/home/:title/:message", (req, res) => {
    res.render("home", {
        title: req.params.title,
        message: req.params.message
    });
});
```

Sedan skapar vi vy-filen `views/home.pug`.

```text
include header.pug

h1= message
p This is a plain paragraph with a url. Here comes <a href="/test/page">the actual link</a>.
p Here is a image <img id="image" src="/img/mos.jpg">.

include footer.pug
```

Som du ser så inkluderar vy-filen både `header.pug` och `footer.pug`. De filerna kan se ut så här.

```text
doctype html
html
head
    title= title
    link(rel="stylesheet", href="/css/style.css")
body
```

```text
footer
    p Copyright (c) by MegaMic

script(src="/js/move.js")
```

Nu har vi delat upp första vyn i tre delar och två av delarna (header, footer) är nu återanvändbara för andra vyer, bara att inkludera.

Resultatet ser ut som man kan förvänta sig.

[FIGURE src=image/snapvt17/express-pug-include.png?w=w2 caption="Vyer med include ger en sida."]

Du kan med include se möjligheten att strukturera dina vyer för återanvändning.



En egen errorHandler {#errorHandler}
--------------------------------------

Vi kan nu skapa vår egen felhanterare genom att rendera innehållet i en vy.

Mallen för en egen felhanterare i Express ser ut så här.

```javascript
function errorHandler (err, req, res, next) {
    if (res.headersSent) {
        return next(err);
    }
    res.status(500);
    res.render("error", {
        error: err
    });
}
app.use(errorHandler);
```

Nu använder vi egen kod till en felhanterare. Men vi behöver en vy-fil `error.pug` för att rendera svaret i.

```text
include header.pug

h1= error.message
h2= error.status
pre #{error.stack}

include footer.pug
```

Om vi nu tar en route som inte finns så kan svaret se ut så här.

[FIGURE src=image/snapvt17/express-custom-error-handler.png?w=w2 caption="Min egen felhanterare renderar ett anpassat fel."]

Det ser ut som vi lyckas knyta ihop Express, router och vy-filer till skapande av HTML-sidor.



Avslutningsvis {#avslutning}
--------------------------------------

Detta var en introduktion i webb- och applikationsservern Express tillsammans med grundläggande begrepp såsom router, request, response, vyer och template-motor.

Du har nu grunderna för att skriva din egen applikationsserver.

Denna artikel har en [egen forumtråd](t/6270) som du kan ställa frågor i, eller ge tips.
