---
author: mos
revision:
    "2016-12-16": (PA1, mos) Utveckling påbörjad.
...
Kmom04: Transaktioner
==================================

[WARNING]
Kursmomentet är under utveckling och blir tillgängligt **senast den 27/2-2017**.
[/WARNING]


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

<small><i>(Detta är instruktionen för kursmomentet och omfattar det som skall göras inom ramen för kursmomentet. Momentet omfattar cirka **20 studietimmar** inklusive läsning, arbete med övningar och uppgifter, felsökning, problemlösning, redovisning och eftertanke. Läs igenom hela kursmomentet innan du börjar jobba. Om möjligt -- planera och prioritera var du vill lägga tiden.)</i></small>



Läsanvisningar  {#lasanvisningar}
---------------------------------

*(ca: 4-10 studietimmar)*


###Kurslitteratur  {#kurslitteratur}

Läs följande:

1. [Databasteknik](kunskap/boken-databasteknik) om MySQL
    * Kap 28: Introduktion till MySQL

Viss information finns i [bokens webbkurs](http://www.databasteknik.se/webbkursen/), del 3.


1. [Databasteknik](kunskap/boken-databasteknik) om Transaktioner
    * Kap 23: Transaktioner

    * Kap 3: Mer om datamodellering
    * Kap 11: Normalformer och normalisering

    * Kap 8: Mer om SQL: Aggregatfunktioner, null-värden, yttre join

Vissa av kapitlen finns i [bokens webbkurs](http://www.databasteknik.se/webbkursen/), del 2.



###Artiklar {#artiklar}

Det finns inga artiklar.



###Video  {#video}

Det finns inga videoförslag.



###Lästips {#lastips}

Kika på följande lästips om du finner dem intressanta.

1. [Databasteknik](kunskap/boken-databasteknik)
    * Kap 24: Hur transaktioner hanteras inuti databashanteraren




Övningar & Uppgifter  {#ovningar_uppgifter}
-------------------------------------------

*(ca: 6-10 studietimmar)*



###Övningar {#ovningar}

Genomför följande övningar.



####MySQL {ovn-mysql}

1. Jobba igenom guiden ["Kom igång med databasen MySQL och dess klienter"](kunskap/kom-igang-med-databasen-mysql-och-dess-klienter). Som webbutvecklare behöver du ha koll på olika varianter av klienter, testa allihop och se till att din lokala utvecklingsmiljö fungerar.

1. Bekanta dig med ["BTH's labbmiljö för databasen MySQL"](kunskap/bth-s-labbmiljo-for-databasen-mysql). Se till att du kan använda BTH's databasserver för MySQL, använd de olika klienterna för att koppla upp dig.



####Node.js {ovn-node}

1. Läs igenom övningen "[Gör en kommandoradsklient i Node.js](kunskap/gor-en-kommandoradsklient-i-node-js)". (05?)



###Uppgifter {#uppgifter}

Dessa uppgifter skall utföras och redovisas.

1. Jobba igenom övningen ["Kom igång med SQL"](uppgift/kom-igang-med-sql). Lär dig grunderna i SQL, och lite till.

1. Gör uppgiften lab med transaktioner.

1. Nodejs klient/server mot transaktioner


<hr>

1. node 2 labb
1. nodejs som (terminal/ 05)webbklient mot MySQL




###Extra {#extra}

Det finns inga extra uppgifter.

<!--
Fortsätt träna på JavaScript i webbläsaren.

1. Gör uppgiften "[Memory - rita flaggor med JavaScript vid DOM](uppgift/memory-rita-flaggor-med-javascript-och-dom)".
-->



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](kurser/dbjs/redovisa).

Se till att följande frågor besvaras i redovisningstexten.

* ...
