---
author: mos
category:
    - javascript
    - nodejs
    - mysql
revision:
    "2017-02-27": (A, mos) Första utgåvan.
...
Node.js terminalprogram mot MySQL
==================================

Du skall bygga ett terminalprogram i Node.js som använder sig av MySQL för att utföra databasrelaterade händelser.

Du skall även använda dig av tekniker för att programmera i databasen med transaktioner, lagrade procedurer, triggers och egendefinierade funktioner.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat igenom artikeln "[Gör en kommandoradsklient i Node.js](kunskap/gor-en-kommandoradsklient-i-node-js)" samt artikeln "[MySQL och Node.js](kunskap/mysql-och-nodejs)".

Du har även kunskaper i SQL och MySQL motsvarande artikeln ["Kom igång med SQL"](uppgift/kom-igang-med-sql).

Du har även löst uppgiften "[Node.js terminalprogram mot MySQL](uppgift/nodejs-terminalprogram-mot-mysql)".



Introduktion {#intro}
-----------------------

Det stora internationella företaget "Allans Mopeder" uppskattade ditt tidigare arbete och vill nu ha en webbaserad tjänst av dig. Det handlar fortfarande om en frontend till deras sälj- och distributionsdatabas.

Du har en ny databas att jobba på i `allan1.sql`.
`example/nodejs/allans-mopeder/allan1.sql`. Kopiera den till din uppgiftskatalog. 

Så här kan du läsa in SQL-kommandon till terminalen MySQL.

```bash
$ mysql -uuser -ppass mydb < allan1.sql
```



Krav {#krav}
-----------------------

1. Skriv ett *main-program* som startar din server, döp det till `index.js`. 

1. Ditt program skall läsa av environment-variabeln `LINUX_PORT` och, om variabeln är definierad, använda dess innehåll för att starta servern på just den porten. Standardport är annars 1337.

1. Ditt program skall skriva sitt PID till en fil som heter `pid`. När man kör kommandot `kill $( cat pid )` (eller motsvarande på Cygwin) så skall din server stängas ned.

1. Du skall kunna skicka med options som säger till vilken databas programmet skall koppla upp sig och med vilken användare och lösenord. Det kan se ut ut så här `node index.js --host localhost --user mos --password XXX --database mos`.

1. I routen `/` visar du en index-sida som innehåller länkar till vad man kan göra. Använd en stylesheet för din CSS-kod.

1. På routen `/view` visar du samtliga produkter samt deras lagerstatus lokalt och centralt. Man skall kunna klicka på en produkt för att se detaljer om enbart den produkten.

1. På routen `/view/:id` visar du informationen om en produkt, inklusive dess lagerstatus.

1. När du visar en produkt så skall du också visa en textsträng som säger "hälsosam" när lagerstatus är över 5 produkter, "beställ" när lagerstatus är 1-4 och "slut" när lagerstatus är 0. Textsträngen visas både för lokal och centralt lagerstatus.

1. På routen `/edit/:id` visar du information om produkten i ett formulär. Om du postar formuläret så kan du uppdatera informationen i databasen. Du kan fritt uppdatera namn, lokalt lagerstatus och centralt lagerstatus via detta formulär, utan några restriktioner. 

1. På routen `move/:id1/:id2` (eller liknande route som du själv väljer) skall du kunna flytta från det lokala lagret till det centrala och vise versa. Du kan ange hur många produkter som kan flyttas. Det måste finnas produkter innan de kan flyttas.

1. Skapa en logg-tabell som loggar varje flytt mellan de två lagren. Du kan logga varje förändring i de två lagren, på det viset kan man ha koll på vilka lagerförändringar som gjorts. Skapa en route `log` som visar innehållet i logg-tabellen.

1. Du skall använda dig av minst en transaktion, en lagrad procedur, en trigger och en funktion. Uppdatera filen `allan1.sql` så att den innehåller koden för att skapa dessa. Man skall kunna köra `allan1.sql` om och om igen, för att skapa om databasens tabeller.

1. Validera din kod.

```bash
# Flytta till kurskatalogen
dbwebb validate express-sql
#dbwebb publish terminal
```

Rätta eventuella fel som dyker upp och publisera igen. När det ser grönt ut så är du klar.



Extrauppgift {#extra}
-----------------------

Det finns ingen extra uppgift.



Tips från coachen {#tips}
-----------------------

Lycka till och hojta till i forumet om du behöver hjälp!
