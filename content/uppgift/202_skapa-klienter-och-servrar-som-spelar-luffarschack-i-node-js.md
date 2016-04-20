---
author: mos
category: javascript
revision:
  "2015-09-11": (A, mos) Första utgåvan i samband med kursen linux.
updated: "2015-09-11 16:00:00"
created: "2015-09-09 08:09:24"
...
Skapa klienter och servrar som spelar luffarschack i Node.js
==================================

Du skall jobba med konceptet klient och server genom att skriva ett par olika varianter av klient och server mot en och samma klass för ett luffarschack. Du jobbar i Node.js.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat igenom artiklarna "[Gör en kommandoradsklient i Node.js](kunskap/gor-en-kommandoradsklient-i-node-js)" och "[Spela luffarschack med klient och server i Node.js](kunskap/spela-luffarschack-med-klient-och-server-i-node-js)".



Introduktion {#intro}
-----------------------

I artiklarna ovan så har koncepten gåtts igenom och du har fått tillgång till viss exempelkod som du nu skall använda och bygga vidare på.

Du får själv kopiera in de filerna du anser du behöver. Spara alla filerna i katalogen `me/kmom06/gomoku`.



Krav {#krav}
-----------------------



###Del 1 Spela lokalt {#del1}

1\. Börja med att kopiera in klassfilen för `example/nodejs/gomoku/GomokuBoard.js`. Kopiera sedan in exemplet `example/nodejs/gomoku/index-random.js` och testkör så att det fungerar. Nu har du en bas att utgå ifrån. Testa att det går att köra.

2\. Du skall skapa ett program `index-game1.js` som använder modulen `GomokuBoard.js` för att spela luffarschack. Du kan utgå från koden i `index-random.js`.

3\. Du skall kunna starta programmet och ange storleken på spelet, så här.

| Kommando              | Vad skall hända |
|-----------------------|-----------------|
| `./index-game1.js`    | Kör igång ett spel med 20x20 rutor. |
| `./index-game1.js -v` | Visar versionen av programmet och avslutar med exit code 0. |
| `./index-game1.js -h` | Visar hjälptext om programmet och avslutar med exit code 0. |
| `./index-game1.js 15` | Kör igång ett spel med 15x15 rutor. |

4\. Spelet skall innehålla en [mainloop](kunskap/gor-en-kommandoradsklient-i-node-js#mainloop) där du kan placera ut nästa bricka i spelet. Du skall ange två integer på raden, först värdet på x, följt av värdet på y. Din mainloop tar dessa värden och placerar en bricka (X eller O beroende på vems tur det är) på rätt position. Därefter skrivs spelplanen ut.

Det kan se ut så här när du anger en plats för X/O.

```text
Gomoku$ 9 9
```

4\. Du får gärna uppdatera koden i `GomokuBoard.js`, men det skall inte vara nödvändigt för att klara uppgiften.



###Del 2 Bygg en server {#del2}

1\. Kopiera in koden för servern `example/nodejs/gomoku/GomokuServer.js`, `example/nodejs/gomoku/index-server.js` samt routern som du hittar i `example/nodejs/router/router.js`. Ändra sedan så att sökvägen till routern blir korrekt i importeringen överst i filen `GomokuServer.js`.

```javascript
import Router from "./router";
//import Router from "../router/router";
```
Nu har du en körbar server. Testa den.

2\. Utöka servern `GomokuServer.js` med en metod `placeRandom()` som placerar ut brickan för nästa spelare på en slumpmässig plats på spelplanen.

3\. Utöka API:et och lägg till följande. Verifiera att det fungerar med curl.

| Länk                      | Vad skall hända       |
|---------------------------|-----------------------|
| GET `/place/random`       | Placera draget för spelaren som står på tur, på ett slumpmässigt vis. |



###Del 3 Bygg ut klienten till servern {#del3}

1\. Kopiera in koden för servern `example/nodejs/gomoku/GomokuClient.js` och `example/nodejs/gomoku/index-client.js`. Du har nu en klient som går att köra och som kan koppla upp sig mot servern. Testa det.

2\. Utöka klienten med stöd för kommandot `place random`.

```text
Gomoku$ place random
```

3\. Validera och publicera din kod enligt följande.

```bash
# Ställ dig i kurskatalogen
dbwebb validate gomoku
dbwebb publish gomoku
```

Rätta eventuella fel som dyker upp och publicera igen. När det ser grönt ut så är du klar. 



Extrauppgift {#extra}
-----------------------

1. Lägg till stöd så att `GomokuBoard.js` kan se när någon har vunnit spelet.

2. Skapa lite bättre intelligens i `placeRandom()` så att spelbrickan placeras ut på en rimlig plats. Går så gott du kan. Kanske räcker det med att placera en bricka jämte en annan.

3. Om du hade byggt ut servern så att den styr upp klienterna så att de bara kan lägga om det är deras tur, samt stödja flera spel samtidigt. Hur hade du då gjort? Förklara i redovisningstexten, eller skriv koden för det.



Tips från coachen {#tips}
-----------------------

Lycka till och hojta till i forumet om du behöver hjälp!




