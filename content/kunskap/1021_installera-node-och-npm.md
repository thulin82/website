---
author: mos
category:
    - labbmiljo
    - javascript
    - nodejs
    - npm
revision:
    2016-11-01: (B, mos) Bytte ut nodejs mode node i verifiering.
    2016-10-14: (A, mos) Första utgåvan.
...
Installera Node.js och npm
===================================

[FIGURE src=/image/snapvt16/nodejs-logo.png class="right"]

Vi skall installera en miljö för JavaScript. Det handlar om Node.js och pakethanteraren npm.

Miljön innebär att du kan köra JavaScript på din dator och du kan ta del av alla de program och paket som erbjuds via pakethanteraren npm.



<!--more-->



Läs mer {#mer}
-------------------------------

Du kan läsa mer om [Node.js på webbplatsen](https://nodejs.org/).

Du kan läsa mer om [npm på webbplatsen](https://www.npmjs.com/). Där kan du också söka efter de paket som finns publicerade.



Förutsättning {#pre}
-------------------------------

Du har installerat de [grundverktyg](labbmiljo) som ligger till grund för samtliga kurser.



Installera på Windows {#windows}
-------------------------------

Gå till [nedladdningssidan för Node](https://nodejs.org/en/download/). Ladda ned installationsprogrammet och installera.

Programmen node och npm läggs till i din PATH automatiskt.

Du kan nu starta programmen från Cygwin (och från `cmd.exe`). Men starta om din terminal så att den får del av den uppdaterade pathen.

```bash
$ which node
$ node --version
$ which npm
$ npm --version
```



Installera på Mac OS {#macos}
-------------------------------

Gå till [nedladdningssidan för Node](https://nodejs.org/en/download/). Ladda ned installationsprogrammet och installera.

Du kan nu starta programmen från din terminal.

```bash
$ which node
$ node --version
$ which npm
$ npm --version
```



Installera på Linux {#linux}
-------------------------------

Olika linux-varianter har olika sätt att installera node och npm. Följ instruktionerna på nedladdningssidan. Det kan finnas vissa förberedelser som behövs för att du skall kunna installera den senaste versionen, det handlar om vilket repo som apt-get använder för att hämta installationsfilern från. Kolla nedladndingssidan för att vara säker.

På min debian gör jag så här.

```bash
$ sudo apt-get update
$ sudo apt-get install nodejs npm
```

Du kan nu starta programmen från din terminal.

```bash
$ which node
$ node --version
$ which npm
$ npm --version
```

<!--
I debian fanns det tidigare ett kommando som hette node, därför installeras vår "node" som nodejs. Men jag vill använda det som node och lägger därför en symbolisk länk till nodejs som jag döper till node.

```bash
$ sudo ln -s $( which nodejs ) /usr/bin/node
```
-->



Verifiera att Node.js fungerar {#test}
-------------------------------

Du kan nu köra JavaScript med node. Pröva följande.

```bash
$ node --help
$ node --eval "console.log('Hello World');"
Hello World
```

Du kan också köra node interaktivt och evaluera JavaScript rad för rad. Programmet visar att den är redo för inmatning med prompten `>`.

```bash
$ node
> console.log("Hej")
Hej
>
```

För att få upp prompten i cygwin skall node köras i _interactive mode_. Detta gör du genom att använda kommandot `node -i`.

Så här kan det se ut.

[ASCIINEMA src=91267]

Du kan också låta nodejs köra JavaScript-program som finns i filer.

```bash
$ echo "console.log('Hello')" > hello.js
$ node hello.js
Hello
```

Så här kan det se ut.

[ASCIINEMA src=91268]



Verifiera att npm fungerar {#test1}
-------------------------------

Se vad du kan göra med npm.

```bash
$ npm --help
```



Avslutningsvis {#avslutning}
------------------------------

Det finns en [forumtråd om node och npm](t/5801). Ställ frågor där och dela med dig av dina tips och trix.

Det finns också en artikel som visar hur man [installerar node, npm och babel på debian](kunskap/kom-igang-med-node-js-pa-debian).
