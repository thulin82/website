---
...
Babel och Babel-node
==================================

Babel är en transpiler som kan transpilera kod från till exempel ES6 till ES5.

Vi ska använda en variant av Babel som heter `babel-node`. Det är en wrapper som dels transpilerar från ECMA6 och dels kör den transpilerade koden i Node.js. Vi behöver alltså bara ett kommando för att köra ett skript i ES6.

Du kan [läsa mer om babel-cli (babel-node)](https://babeljs.io/docs/usage/cli/) på deras documentationssida.



Förutsättning {#forut}
-----------------------------------

Du har [installerat node och npm](labbmiljo/node-och-npm).



Installera babel-node {#babel}
-----------------------------------


Du installerar  babel-cli som innehåller babel-node, med npm på följande sätt. Vi väljer att göra en global installation för att hålla det enkelt.

```text
npm install -g babel-cli
```

Du kan nu köra babel-node. Du kan behöva sudo på Linux och Mac OS.

```text
npm install -g babel-cli
which babel-node
babel-node --version
```

Så här kan det se ut.

[ASCIINEMA src=101656]

Nu är babel-node installerat. Du kan använda det på samma sätt som node, men med den transpilerande fördelen.
