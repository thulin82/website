---
author: aar
category:
    - cordova
    - kurs webapp
revision:
    "2017-03-08": (A, aar) Första utgåvan inför webapp-v2.
...
Kom igång med Cordova
==================================

[FIGURE src=/image/kunskap/cordova_logo.png?w=500&h=300]

Vi ska använda Apache Cordova för att utveckla och testa webbappar. Cordova är ett [cross-plattform tool](https://en.wikipedia.org/wiki/Cross-platform) som utnyttjar 
<!--more-->



Förutsättning {#pre}
--------------------------------------

Artikeln är en del av kursen webapp och förutsätter att du har motsvarande "[installera Cordova](kunskap/installera-cordova)"


Template koden {#template}
--------------------------------------

```bash
$ cordova create hello se.dbwebb.helloWorld HelloWord
```
dir -> identifier (identifier, [reverse domain name notation](https://en.wikipedia.org/wiki/Reverse_domain_name_notation)) -> title

```bash
$ tree hello
hello/
├── config.xml
├── hooks
│   └── README.md
├── platforms
├── plugins
└── www
    ├── css
    │   └── index.css
    ├── img
    │   └── logo.png
    ├── index.html
    └── js
        └── index.js
```

källkoden ligger i `www`. där vi kommer jobba.

Kolla igenom `index.html` och `index.js`.

Jag rensade kommentarer i `index.html`.
Vi får lite fördig kod, speciellt i headern får vi några `meta` taggar.

```html
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Security-Policy" content="default-src 'self' data: gap: https://ssl.gstatic.com 'unsafe-eval'; style-src 'self' 'unsafe-inline'; media-src *; img-src 'self' data: content:;">
        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <title>Hello World</title>
    </head>
    <body>
        <div class="app">
            <h1>Apache Cordova</h1>
            <div id="deviceready" class="blink">
                <p class="event listening">Connecting to Device</p>
                <p class="event received">Device is Ready</p>
            </div>
        </div>
        <script type="text/javascript" src="cordova.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
    </body>
</html>
```

```html
<meta http-equiv="Content-Security-Policy" content="default-src 'self' data: gap: https://ssl.gstatic.com 'unsafe-eval'; style-src 'self' 'unsafe-inline'; media-src *; img-src 'self' data: content:;">
```
Första meta taggen är [_content security policy_](https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP). Den skyddar vår app mot cross-site scripting (XSS) attacker. Om du vill använda dig av en ex. en CDN kan du behöva editera taggen och tillåta appen att hämta kod från den sida.

```html
<meta name="format-detection" content="telephone=no">
```
`format-detection` taggen konverterar telefonnummer till länkar. Användare kan klicka på länken så startas ett samtal till det numret.

Nästa tag kan vi ta bort då vi inte ska använda vår app på en Windows Phone.

```html
<meta name="msapplication-tap-highlight" content="no">  
```
 Sen har vi den vanliga `viewport` meta taggen.

Längst ner i `body` inkluderar vi två JavaScript filer. `index.js` filen kommer vara vår start punkt. `cordova.js` ger oss tillgång till Cordovas API för att komma åt mobil enheternas native funktionaliteter. Som t.ex. kamera och GPS.

Om du öppnar `index.js` ser du en `eventListener` som lyssnar efter `deviceready`. `deviceready` är ett event från Cordova som meddelar att appen är redo att använda Cordovas plugins. Vi kommer utgå från `deviceready` som startpunkt för vår kod.
Koden som finns där nu döljer `<p>` taggen med innehållet `Connecting to Device` och ersätter det med `<p>` taggen som inehåller `Device is ready`.

Cordova har fler events vi kan utnyttja, här kan du läsa om [de olika eventen](https://cordova.apache.org/docs/en/latest/cordova/events/events.html). Det finns bl.a. `pause` som aktiveras när appen läggs i bakgrunden och `resume` som aktiveras när appen plockas fram från bakgrunden.

Då kan det vara dags att kicka på hur appen ser ut. Vi bärjar med att lägga till vilka plattformar appen ska funka på och sen start en emulator.

[FIGURE src=/image/kunskap/android-emulator-cordova-app.png?w=200&h=400 class=right]
```bash
$ cordova platform add android
$ cordova platform add browser
$ cordova emulate android
```



Utveckla appen {#utveckla}
--------------------------------------

När vi utvecklar appar med Cordova är det viktigt att använda [SPA design](https://en.wikipedia.org/wiki/Single-page_application), Single Page Application, då vi behöver vänta på `deviceready` eventet för att kunna använda plugins. Om vi aldrig byter sida behöver vi bara vänta på `deviceready` när applicationen startar.

Vi sätter igång och ändrar i koden.

```html
<div class="app">
    <p>App is loading. Hold on!</p>
</div>
```
I `index.html` ersätter vi innehållet i `app` med en placeholder text som endast ska visas innan `deviceready` har aktiverats.

I `index.js` rensar vi också. Behåll `initialize` och `onDeviceReady` funktionerna, ta bort `receivedEvent` funktionen och ersätt den med en `homePage` funktion.

```js
    onDeviceReady: function() {
        this.homePage();
    },

    homePage: function() {
    }
```

Då ska vi ändra innehållet i vår app. Med SPA tänket väljer vi att ändra innehållet med hjälp av JavaScript.

```js
homePage: function() {
    var content = document.getElementsByClassName("app")[0];
    
    var html = "<h1 class='title'>Hello World</h1>";
    html += "<div class='main'>Hej och välkommen till min första Cordova app.</div>";
    content.innerHTML = html;
}
```
DOM förändringar har stor inverkan på prestanda, därför väljer vi att skapa en sträng med all html koden och tilldelar `content.innerHTML` sist. Därmed gör vi påverkar vi bara DOM en gång.

Testa appen och kolla hur det ser ut.

```bash
$ cordova emulate android
```

Jag har så klart ändrat i CSS filen. Testa du också att leka med stylen.

[FIGURE src=/image/kunskap/cordova/cordova-intro-v1.png?w=500&h=300]


##Touch event {#touch}

För att ändra innehållet i appen ska vi lägga till en `button` och skapa ett `touchend` event. 

```js
homePage: function() {
    var content = document.getElementsByClassName("app")[0];
    
    var html = "<h1 class='title'>Hello World</h1>";
    html += "<div class='main'>Hej och välkommen till min första Cordova app.";
    html += "<button class='otherPage'>Nästa sida</button></div>";
    content.innerHTML = html;
    
    button = document.getElementsByClassName("otherPage")[0];
    button.addEventListener("touchend", this.otherPage)
},

otherPage: function() {
    title = document.getElementsByClassName("title")[0];
    content = document.getElementsByClassName("main")[0];
    
    title.innerHTML = "Other page";
    
    var html = "Try an alert!<br>";
    html += "<button class='alertButton'>Alert</button>";
    content.innerHTML = html;
    
    button = document.getElementsByClassName("alertButton")[0];
    button.addEventListener("touchend", function() {
        alert("Hej");
    });
}
```
Vi skapar en ny funktion `otherPage` där vi uppdaterar innehållet i appen och lägger till en knapp som skapar ett `alert` när vi klickar på den.
Det är viktigt att använda `touch` istället för `onclick`. `onclick` har en 300 ms delay innan den reagerar på att du har klickat på knappen.

Testa appen appen igen.

```bash
$ cordova emulate android
```
[FIGURE src=/image/kunskap/cordova/cordova-intro-alert.png?w=500&h=300]

Nu har vi gjort vår första app i Cordova.



Felsöka appar {#felsöka}
--------------------------------------

Det finns olika sätt att felsöka en Cordova app.
Om vi börjar med det lättaste, öppna appen i din webbläsare och felsök den som en vanlig webbsida.
När det funkar kan du gå vidare och kolla om det funkar på emulatorn. När vi felsöker i emulatorn är det bra om vi kan se utskrifter vi gör med `console.log()`.
För att se `console.log` kan vi antingen starta `adb logcat` i terminalen medans vi kör appen. För att testa lägger jag in en `console.log()` i eventet för alert, startar emulatorn och kör sen kommandot `adb logcat`.
```js
button.addEventListener("touchend", function() {
    console.log("alert sent");
    alert("Hej");
});
```
[FIGURE src=/image/kunskap/cordova/cordova-intro-logcat.png]


Det är även möjligt att felsöka emulatorn via chrome. Starta emulatorn, öppna en chrome webbläsare och gå till `chrome://inspect/#devices`.
[FIGURE src=/image/kunskap/cordova/cordova-intro-chrome-dbg.png?w=500&h=300]
Klicka på inspect och då får du upp ett nytt fönster där du kan styra din emulator och felsöka appen som om det vore en webbsida.
[FIGURE src=/image/kunskap/cordova/cordova-intro-inspect.png?w=500&h=300]



Avslutningsvis {#avslutning}
--------------------------------------

Nu har vi skapat en mobil webbapp i Cordova och lärt oss felsöka den. 
Tänk på att påverka DOM så lite som möjligt och använd `Touch` event  istället för `onclick`.

Har du [tips, förslag eller frågor om artikeln](t/6293) så finns det en specifik forumtråd för det.
