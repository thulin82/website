---
author: mos
category: unix
revision:
    "2016-06-04": (C, mos) Lade till krav på servern om LINUX_PORT + LINUX_SERVER
    "2015-10-16": (B, mos) Stycke om att kopiera routern, bytte namn på mazerunner.sh till mazerunner.bash.
    "2015-09-02": (A, mos) Första utgåvan i samband med kursen linux.
updated: "2015-10-16 08:08:13"
created: "2015-09-02 07:05:28"
...
Lös mazen med din mazerunner i bash
==================================

Du kommer få en färdig server, skriven i Node.js, och ett RESTful API till servern. Servern implementerar en *maze*. Servern är färdig och du kan testköra den via kommandot curl.

Din uppgift är att bygga en bash-klient till servern, enligt en kravspecifikation. Din klient skall använda servern för att lösa mazen.

<!--more-->




Förkunskaper {#forkunskaper}
-----------------------

Du har kunskaper motsvarande de som hanteras i uppgiften "[Skapa en RESTful HTTP-server med Node.js och klient i Bash](uppgift/skapa-en-restful-http-server-med-node-js-och-klient-i-bash)".




Introduktion {#intro}
-----------------------

Läs kort på Wikipedia om vad en [*maze*](https://en.wikipedia.org/wiki/Maze) kan vara.

Så här kan det se ut när du löser mazen med ditt skript, skriptet som i detta fallet heter *mazerunner.sh*. Möjligen kan det vara inspirerat av boken/filmen med samma namn, [The Maze Runner](https://sv.wikipedia.org/wiki/The_Maze_Runner).

[ASCIINEMA src=1voz3ecbgsbu5dytp9sz5n2kb]

Så kan det alltså se ut.



###Om servern maze {#om}

Servern [maze finns i kursrepot](https://github.com/mosbth/linux/tree/master/example/nodejs/maze). Där finns all källkod och en specifikation över [serverns API](https://github.com/mosbth/linux/blob/master/example/nodejs/maze/api.md).

Börja med att översiktligt bekanta dig med serverns API.

Så här kan du starta servern.

```bash
# Gå till kursrepot
cd example/nodejs/maze
babel-node index.js
```

Du kan testa maze-servern med curl. Så här.

[ASCIINEMA src=25853]

Studera gärna källkoden till maze-servern. Hade du kunnat skriva den själv?



###Maze använder router {#router}

Maze-servern använder sig av en router som ligger i `../router/router.js`. Titta gärna kort i den filen. 

Om du kopierar maze-servern så behöver du också kopiera router-filen. Det finns inget som hindrar att du väljer att kopiera in `router.js` till samma katalog som maze-filerna ligger i. Det kan vara behändigt.

Isåfall behöver du ändra raden för import.

```javascript
import Router from "./router";
//import Router from "../router/router";
```



###Var startar jag servern? {#var}

Tanken är att du kör din server på din debian-installation, så att du inte kör klienten och servern på samma maskin. Det finns inget som hindrar att du jobbar på en och samma maskin när du utvecklar. Men se till att testköra servern och klienten på olika maskiner, annars tappar du lite poängen med server och klient.



###Att spara spelets id till fil {#fil}

Din klient behöver komma ihåg spelets id och vilket rum du står i. Du sparar den informationen enklast i fil. För att du skall slippa hantera JSON med bash, så har servern en möjlighet att leverera svaren som en komma-separerad sträng. 

Testa att köra följande kommandon mot servern så ser du skillnaden.

```bash
curl localhost:1337/map
curl localhost:1337/map?type=csv
```

Det är alltså `?type=csv` som kan underlätta för din bash-klient.



###En katalog för din mazerunner {#katalog}

Nu kan du börja, spara alla dina filer i katalogen `me/kmom05/maze`. 

Använd funktioner i bash, för att strukturera din kod. Det lönar sig i längden.



Krav {#krav}
-----------------------



###Del 1 {#del1}

1. Skapa ett skript `mazerunner.bash`. Sätt rättigheter på skriptet till 755. Skapa en symbolisk länk `mazerunner` som pekar på filen `mazerunner.bash`.

1. Skriptet skall läsa av environment-variabeln `LINUX_PORT` och, om variabeln är definierad, använda dess innehåll som portnummer att koppla upp sig mot. Standardvärde skall vara 1337.

1. Skriptet skall läsa av environment-variabeln `LINUX_SERVER` och, om variabeln är definierad, använda dess innehåll som adress till servern. Standardvärde skall vara localhost.

1. Använd API:et för att lägga till följande funktioner i skriptet. Skriptet skall alltid skriva ut ett meddelande om det gick bra eller inte.

| Kommando                | Vad skall hända |
|-------------------------|-----------------|
| `./mazerunner init`     | Initiera ett spel och spara ned spelets id i en fil. |
| `./mazerunner maps`     | Visa vilka maps som finns att välja bland. |
| `./mazerunner select <map>` | Välj en viss karta. |
| `./mazerunner enter`    | Gå in i första rummet. |
| `./mazerunner go north` | Gå till ett nytt rum, om riktningen stödjs. |
| `./mazerunner go south` | Gå till ett nytt rum, om riktningen stödjs. |
| `./mazerunner go east`  | Gå till ett nytt rum, om riktningen stödjs. |
| `./mazerunner go west`  | Gå till ett nytt rum, om riktningen stödjs. |

Så här kan det se ut när du är klar.

[ASCIINEMA src=1voz3ecbgsbu5dytp9sz5n2kb]



###Del 2 {#del2}

1. Utöka funktionaliteten i `mazerunner.bash` så att allt sker i en loop när man startar programmet med `./mazerunner loop`. Skriptet skall börja med att initiera ett nytt spel och visa vilka kartor som finns. Spelaren kan då välja en karta varpå spelaren träder in i första rummet. Därefter fortsätter loopen och väntar på att spelaren skriver in riktningen north, south, east, west, eller help för en hjälptext eller quit för att avsluta.

Så här kan det se ut, ungefär.

[ASCIINEMA src=1voz3ecbgsbu5dytp9sz5n2kb]


2\. Validera och publicera din kod enligt följande.

```bash
# Ställ dig i kurskatalogen
dbwebb validate maze
```

Rätta eventuella fel som dyker upp och publicera igen. När det ser grönt ut så är du klar. 



Extrauppgift {#extra}
-----------------------

Det finns ingen extrauppgift.



Tips från coachen {#tips}
-----------------------

Strukturera din kod med funktioner i bash. Då får du en bra struktur i första delen och i andra delen så kan du återanvända funktionerna.

Lycka till och hojta till i forumet om du behöver hjälp!
