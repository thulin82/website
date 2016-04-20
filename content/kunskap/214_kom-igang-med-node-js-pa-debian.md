---
author: mos
category: javascript
revision:
  "2016-01-26": (C, mos) Återgår till version 5 av Babel.
  "2016-01-21": (B, mos) Babel installeras nu som babel-cli.
  "2015-08-07": (A, mos) Första utgåvan för linux-kursen.
updated: "2016-01-26 08:43:38"
created: "2015-08-07 07:02:11"
...
Kom igång med Node.js på Debian
==================================

[FIGURE src=/image/snapht15/nodejs-green.png?w=c5 class="right" caption="Node.js på Debian"]

Detta handlar om JavaScript på servern. Guiden visar hur du kommer igång med Node.js på en Debian-maskin (Linux). Du får installera Node tillsammans med Babel för att klara av JavaScript enligt ECMA6. Därefter visas ett par exempelprogram ur kursrepot för Linux-kursen.

<!--more-->



Förutsättningar {#forut}
--------------------------------------

Denna artikel ingår i kursen [linux](linux) där vi installerar programmen på en Debian Linux-server. Det förutsätts därför att du genomför allt som står här på en Debian-server.

Eftersom det är JavaScript kan du i princip göra samma sak på godtyckligt OS som Mac OS eller Windows. Men det täcks inte av artikeln.



Om Node.js,npm, Babel och ECMA6 {#om}
--------------------------------------

Så, JavaScript på servern. Det vi behöver är en motor som kan köra JavaScript och den mest populära är [Node.js](https://nodejs.org/).

Node.js har ett system för att distribuera paket och moduler, [`npm`](https://www.npmjs.com/). Via kommandot npm kan vi komma åt mängder at färdiga moduler, och hela program, för JavaScript-programmering.

[Babel, eller babeljs](https://babeljs.io/) är ett kommandoradsprogram som kan kompilera kod skriven i JavaScript ECMA6 till äldre JavaScript som gå att köra i Node.js. 

Det som Babel gör är att kompilera källkod till källkod. Ett annat ord för det är [*transpilers*](https://en.wikipedia.org/wiki/Source-to-source_compiler).

[ECMA6 är den senaste versionen (2015) av JavaScript](https://github.com/lukehoban/es6features/blob/master/README.md) och stödet för de programmingskonstruktioner specen innehåller är ännu inte väl utbyggt. Men inom något år kommer det att vara det. Så för att komma igång med ECMA6 redan nu så använder vi Babel.   

Så. låt oss då installera dessa program och se hur de används. 



Installera Node.js, npm och Babel {#install}
--------------------------------------


###Node.js och npm {#installnode}

Vi börjar med att installera npm och Node.js.

```bash
$ sudo apt-get install nodejs npm
$ nodejs --version
$ npm --version
```

Så här kan det se ut.

[ASCIINEMA src=24689]



###Babel och babel-node {#installbabel}

Därefter använder vi npm för att installera Babel. Vi ska använda en variant av Babel som heter `babel-node`. Det är en wrapper som dels kompilerar från ECMA6 och dels kör den kompilerade koden i Node.js. Vi behöver alltså bara ett kommando för att köra ett skript i ECMA6.

```bash
$ sudo npm install -g babel@5.8.35
$ babel-node --version
```
[INFO]
**Vi använder en äldre version av babel**

Vi använder version 5 av Babel, från och med version 6 har de förändrat installationsprocessen och hur de distribuerar koden. Kursen utvecklades med tanke på hur Babel version 5 fungerade och därför fortsätter vi att använda det tills kursmaterialet uppdateras.

[Läs mer om detta i forumet](t/5012).
[/INFO]

Du kommer högst troligen få ett felmeddelande på Debian som säger följande.

```bash
$ babel-node --version
/usr/bin/env: node: No such file or directory
```

Babel tror att det exekverbara programmet för Node.js heter `node`, men på Debian finns det ett annat program som heter det så Node.js heter istället `nodejs`.

Ett enkelt sätt att åtgärda detta är att skapa en länk från `node` till `nodejs`.

```bash
$ sudo ln -s /usr/bin/nodejs /usr/bin/node
```

Nu bör det gå bättre.

```bash
$ babel-node --version
```

Så här kan det se ut.

[ASCIINEMA src=24690]

Så, då finns alla program installerade.



Exempelprogram med Node.js {#exempelnode}
--------------------------------------

Du kan starta `nodejs` från kommandoprompten och därefter kan du direkt skriva in JavaScript. Programmet `nodejs` visar att den är redo för inmatning med prompten `>`.

```bash
$ nodejs
> console.log("Hej")
Hej
>
```

Så här kan det se ut.

[ASCIINEMA src=24691]

På detta viset fungerar nodejs precis som Firefox utvecklarverktyg i webbläsaren. Där kan man också skriva in sin JavaScript-kod direkt i utvecklarverktyget. 

Du kan också låta nodejs köra JavaScript-program som finns i filer.

```bash
$ echo "console.log('Hello')" > hello.js
$ nodejs hello.js
Hello
```

Så här kan det se ut.

[ASCIINEMA src=24692]



Exempelprogram med babel-node {#exempelbabel}
--------------------------------------

Programmet `babel-node` fungerar på samma sätt som nodejs, med fördelen att det hanterar ECMA6.

Här är ett skript enligt ECMA6 med *arrow* operatorn.

```javascript
var a = [ "mega", "maxi", "multi" ];
var b = a.map( s => s.length )
console.log(b)
```

Det är samma som att skriva följande.

```javascript
var a = [ "mega", "maxi", "multi" ];
var b = a.map( function(s) { return s.length } )
console.log(b)
```

Arrow-operatorn är alltså ett sätt att skriva enklare kod för funktioner.

Det första skriptet fungerar bra i babel-node men inte i nodejs. Det andra skripet fungerar i båda.

Följande exempel visar hur det ser ut när man kör de båda exemplen i nodejs och i babel-node.

[ASCIINEMA src=24693]

Då kan vi grunderna i hur JavaScript kan köras på serversidan och vi har en miljö installerad.



Avslutningsvis {#avslutning}
--------------------------------------

Det var en genomgång av hur du kommer igång med JavaScript på serversidan med Node.js.

Ställ gärna frågor om [Node.js, npm och Babel i forumet](t/4353).




