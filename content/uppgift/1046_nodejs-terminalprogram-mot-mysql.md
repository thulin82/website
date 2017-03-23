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

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat igenom artikeln "[Gör en kommandoradsklient i Node.js](kunskap/gor-en-kommandoradsklient-i-node-js)" samt artikeln "[MySQL och Node.js](kunskap/mysql-och-nodejs)".

Du har även kunskaper i SQL och MySQL motsvarande artikeln ["Kom igång med SQL"](uppgift/kom-igang-med-sql).

Du har även löst uppgiften "[Node.js terminalprogram mot MySQL](uppgift/nodejs-terminalprogram-mot-mysql)".



Introduktion {#intro}
-----------------------

Det stora internationella företaget "Allans Mopeder" uppskattade ditt tidigare arbete och vill nu ha en webbaserad tjänst av dig. Det handlar fortfarande om en frontend till deras sälj- och distributionsdatabas.

Jobba vidare på databasen du hittade i `example/nodejs/allans-mopeder/allan.sql`.

Så här kan du läsa in SQL-kommandon till terminalen MySQL.

```bash
$ mysql -uuser -ppass mydb < allan.sql
```



Krav {#krav}
-----------------------

1. Skriv ett *main-program* som startar din server, döp det till `index.js`. 

1. Ditt program skall läsa av environment-variabeln `LINUX_PORT` och, om variabeln är definierad, använda dess innehåll för att starta servern på just den porten. Standardport är annars 1337.

1. Ditt program skall skriva sitt PID till en fil som heter `pid`. När man kör kommandot `kill $( cat pid )` (eller motsvarande på Cygwin) så skall din server stängas ned.

1. Du skall kunna skicka med options som säger till vilken databas programmet skall koppla upp sig och med vilken användare och lösenord. Det kan se ut ut så här `node index.js --host localhost --user mos --password XXX --database mos`.

1. I routen `/` visar du en index-sida som innehåller länkar till vad man kan göra. Använd en stylesheet för din CSS-kod.

1. På routen `/view` visar du samtliga produkter samt deras lagerstatus lokalt och centralt. Man skall kunna klicka på en produkt för att se detaljer om enbart den produkten.

1. På routen `/view/:id` visar du informationen om en produkt.

1. På routen `/edit/:id` visar du information om produkten i ett formulär. om du postar formuläret så kan du uppdatera informationen i databasen. Du kan uppdatera namn, lokalt lagerstatus och centralt lagerstatus via detta formulär. 




1. Skapa ett menyval "inventory1" som visar namnet på produkten och hur många som finns i det lokala lagret (inventory). Sortera på den produkt som finns flest av. Om produkten inte finns i lager så skall den inte visas.

1. Skapa ett menyval "inventory2" som gör som "inventory1" men visar alla produkter, även om de inte finns i det lokala lagret.

1. Skapa ett menyval "supplier1" som visar namnet på produkten och hur många som finns i det centrala lagret (supplier). Sortera på den produkt som finns flest av. Om produkten inte finns i lager så skall den inte visas.

1. Skapa ett menyval "supplier2" som gör som "supplier1" men visar alla produkter, även om de inte finns i det centrala lagret.

1. Skapa ett menyval "all" som visar de produkter som antingen finns i det lokala lagret, eller hos leverantörens centrala lagret. Visa hur många som finns i respektive lager. Visa produkten även om den inte finns i något av lagren. Sortera per bokstavsordning.

1. Skapa ett menyval "only" som fungerar som "all" men visar de produkter som finns både i det lokala lagret och i leverantörens centrala lagret.

1. Skapa ett menyval "menu" som visar information om samtliga menyval. Det skall även finnas menyval för "help" och "exit".

1. Använd Promise så att din prompt skrivs ut på rätt ställe.

1. Validera din kod.

```bash
# Flytta till kurskatalogen
dbwebb validate terminal
#dbwebb publish terminal
```

Rätta eventuella fel som dyker upp och publisera igen. När det ser grönt ut så är du klar.



Extrauppgift {#extra}
-----------------------

Det finns ingen extra uppgift.



Tips från coachen {#tips}
-----------------------

Lycka till och hojta till i forumet om du behöver hjälp!
