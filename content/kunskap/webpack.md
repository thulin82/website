---
author: ceruza
revision:
    2016-12-13: (A, ceruza) Första utgåvan.
category:
    - labbmiljo
    - javascript
    - webpack
...

Installera Webpack
===================================

[FIGURE src=/image/snapvt16/https://camo.githubusercontent.com/c6ddd9ff94ce584804e95bb55b3f2416dd553843/68747470733a2f2f662e636c6f75642e6769746875622e636f6d2f6173736574732f313336353838312f313931383337372f34383062326664362d376462632d313165332d386261302d3733346661663331353962382e706e67 class="right"]

Vi skall installera ett byggverktyg för JavaScript.

Miljön innebär att du kan transpilera olika dialekter av JavaScript, exempelvis ES2015 som i skrivande stund är den senaste versionen av JavaScript, till ES5 så att det kan köras i din webbläsare. 



Läs mer {#mer}
-------------------------------

Du kan läsa mer om [Webpack på webbplatsen](https://webpack.github.io/).



Förutsättning {#pre}
-------------------------------

Du har installerat de [grundverktyg](labbmiljo) som ligger till grund för samtliga kurser samt labbmiljön [Node och NPM](https://dbwebb.se/kunskap/installera-node-och-npm)



Installera på valfritt Operativsystem {#install}
-------------------------------

Webpack installeras med NPM, och körs på Node, därför ser installationen likadan ut oavsett operativsystem. Flaggan -g innebär att webpack installeras globalt, detta gör att den läggs till i din $PATH och att du kan använda den genom att bara skriva "webpack". Ibland kan du också behöva installera webpack som ett beroende i ditt projekt, men det täcker vi inte här.  
Du måste använda sudo eller liknande för att installera globalt.

```bash
npm install -g webpack
```



Verifiera att Webpack fungerar {#test}
-------------------------------

Fungerar Webpack? Vi kollar:

```bash
webpack --help
```

Om Webpack installerats korrekt kan du se vad du kan göra med Webpack.



Avslutningsvis {#avslutning}
------------------------------

Det finns en [forumtråd om Webpack](t/5801). Ställ frågor där och dela med dig av dina tips och trix.
