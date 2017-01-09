---
author: mos
revision:
    "2016-12-16": (PA1, mos) Utveckling påbörjad.
...
Kmom03: JavaScript server
==================================

[WARNING]
Kursmomentet är under utveckling och blir tillgängligt **senast den 13/2-2017**.
[/WARNING]

JavaScript med nodejs.

Klienter som kopplar sig till databasen.

Databasen MySQL.

Då går vi vidare till databasen MySQL och dess olika klienter samt en introduktion i frågespråket SQL. Du får jobba igenom en övning i SQL som tar dig från de enklare konstruktionerna till svårare saker som subqueries och `RIGHT/LEFT OUTER JOIN`. Innan den övningen så har du bekantat dig med MySQL, både i din egna utvecklingsmiljö och i BTH's labbmiljö.

Du får pröva att använda tre olika klienter till MySQL, alla tre har sin plats och som webbprogrammerare behöver du kunna använda alla klienterna, vid olika tillfällen.

[FIGURE src=/image/snapshot/mamp-mysql-clu-test.jpg?w=w1&q=60 caption="SQL i en textbaserad klient."]

[FIGURE src=/image/snapshot/wamp-phpmyadmin.png?w=w1&sa=jpg&q=60 caption="SQL i en webbaserad klient."]

[FIGURE src=/image/snapshot/sql-ovning-alter-table.jpg?w=w1&q=60 caption="SQL som det ser ut i desktop-klienten MySQL WorkBench."]

<!--more-->
<!--
[FIGURE src=/image/snapht15/linux-what-now.png?w=w2 caption="Okey, terminalen, och nu då?"]
-->

<small>*(Detta är instruktionen för kursmomentet och omfattar det som skall göras inom ramen för kursmomentet. Momentet omfattar cirka 40 studietimmar inklusive läsning, arbete med övningar och uppgifter, felsökning, problemlösning, redovisning och eftertanke. Läs igenom hela kursmomentet innan du börjar jobba. Om möjligt -- planera och prioritera var du vill lägga tiden.)*</small>



Läsanvisningar  {#lasanvisningar}
---------------------------------

*(ca: 4-10 studietimmar)*


###Kurslitteratur  {#kurslitteratur}

Läs följande:

1. [Databasteknik](kunskap/boken-databasteknik)
    * Kap 28: Introduktion till MySQL

Viss information finns i [bokens webbkurs](http://www.databasteknik.se/webbkursen/), del 3.

1. Läsanvisning Javascript.



###Artiklar {#artiklar}

Det finns inga artiklar.



###Video  {#video}

Det finns inga videoförslag.



###Lästips {#lastips}

Kika på följande lästips om du finner dem intressanta.

1. [Databasteknik](kunskap/boken-databasteknik)
    * Kap 20: SQL inuti ett program



Övningar & Uppgifter  {#ovningar_uppgifter}
-------------------------------------------

*(ca: 6-10 studietimmar)*



###Labbmiljö {#labbmiljo}

Installera mer labbmiljö för kursen.

1. Installera labbmiljön för [Node och npm](labbmiljo/node-och-npm).

1. Installera [lokal utvecklingsmiljö](labbmiljo/lokal-utvecklingsmiljo) i kursrepot.



###Övningar {#ovningar}

Genomför följande övningar.

1. Jobba igenom guiden "[Kom igång med Node.js (på Debian)](https://dbwebb.se/kunskap/kom-igang-med-node-js-pa-debian)".

1. nodejs mot sqlite.

1. Läs igenom övningen ""[Gör en kommandoradsklient i Node.js](kunskap/gor-en-kommandoradsklient-i-node-js)".


<hr>

1. Jobba igenom guiden ["Kom igång med databasen MySQL och dess klienter"](kunskap/kom-igang-med-databasen-mysql-och-dess-klienter). Som webbutvecklare behöver du ha koll på olika varianter av klienter, testa allihop och se till att din lokala utvecklingsmiljö fungerar.

1. Bekanta dig med ["BTH's labbmiljö för databasen MySQL"](kunskap/bth-s-labbmiljo-for-databasen-mysql). Se till att du kan använda BTH's databasserver för MySQL, använd de olika klienterna för att koppla upp dig.

1. Jobba igenom övningen ["Kom igång med SQL"](uppgift/kom-igang-med-sql). Lär dig grunderna i SQL, och lite till.



###Uppgifter {#uppgifter}

Dessa uppgifter skall utföras och redovisas.


1. nodejs labb (linux lab3 variant)?
1. nodejs labb (linux lab4 variant)?

<hr>

1. Gör laborationen "[Lab 2 SQL XXX](uppgift/lab-2-sql-XXX)" som låter dig träna på...

1. Gör laborationen "[Lab 3 SQL XXX](uppgift/lab-3-sql-XXX)" som låter dig träna på ...

<hr>

1. nodejs som kommandoradsklient
1. nodejs som webbklient
1. Gör uppgiften nodejs enkelt program som använder sqlite.
1. _(Klient som bygger vidare på lab 1 jetty)_



###Extra {#extra}

Det finns inga extra uppgifter.



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](kurser/dbjs/redovisa).

Se till att följande frågor besvaras i redovisningstexten.

* ...
