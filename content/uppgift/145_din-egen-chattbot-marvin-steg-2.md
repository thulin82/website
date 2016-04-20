---
author: mos
category: python
revision:
  "2015-08-25": (F, mos) Uppgraderade till dbwebb v2.
  "2015-01-29": (E, mos) Sökväg för cd-kommandot.
  "2014-10-24": (D, mos/sylvanas) Mindre omformulering krav 2 och krav 3.
  "2014-08-27": (C, mos) Genomgången och testad.
  "2014-08-03": (B, sylvanas) Uppdaterad med fler övningar.
  "2014-07-03": (A, mos) Första utgåvan i samband med kursen python.
updated: "2015-08-25 12:50:03"
created: "2014-07-03 07:52:26"
...
Din egen chattbot - Marvin - steg 2
==================================

Programmering och problemlösning i Python. Strukturera koden i en egen fil och lär Marvin ett spel samt att förstå flytande text.

<!--more-->


Förkunskaper {#forkunskaper}
-----------------------

Du kan grunderna i Python och stränghantering och du har byggt [första delen](uppgift/din-egen-chattbot-marvin-steg-1) av Marvin.



Introduktion {#intro}
-----------------------

Spelet "Guess the number" är ett enkelt gissningsspel där någon tänker på ett tal mellan 1-100. Man har 6 gissningar på sig att gissa rätt tal. Vid varje gissning så får man svaret om talet "för lågt", "för högt" eller "rätt gissat".

Kapitel 4 i boken [Invent your games with Python](kunskap/boken-invent-your-own-computer-games-with-python) beskriver hur spelet "Guess the number" kan implementeras.

Kursrepot innehåller ett [exempel på strängformattering med fil](https://github.com/reechani/python/blob/master/example/marvin/format.py) som du kan använda som grund för formatteringsuppgiften.



Krav {#krav}
-----------------------

Kopiera din Marvin från föregående kursmoment och utgå från den koden.

```bash
# Flytta till kurskatalogen
cd me
cp -ri kmom02/marvin1/marvin.py kmom03/marvin2/
cd kmom03/marvin2
```

2. Skriv om koden så att kod för själva Marvin samlas i en egen fil `marvin.py`. Main-funktionen, den som använder Marvin-funktionerna, ska finnas kvar i den andra filen som ska döpas om till `main.py`.

3. Gör ett menyval som löser spelet "Guess the number" där Marvin tänker på ett tal mellan 1-100 och spelare ska gissa vilket det är. För varje gissning ska Marvin berätta om gissningen var högre eller lägre än det han tänkte på. Spelaren ska ha 6 gissningar på sig.

4. Gör ett menyval där Marvin i samma sträng skriver ut: dagens datum och nuvarande tid, hur han mår (slumpmässigt humör), ett heltal, samt ett floattal med 3 decimaler. Ge talen ett sammanhang i texten.
Strängen ska hämtas från en textfil som du själv skapar och formateras med ovanstående variabler. Notera att du i programmet inte ska ändra i filen.

5. Menyval: Kasta om bokstäver. Marvin ska be dig skriva in ett ord som sedan slumpmässigt kastas om. Det omkastade ordet ska sedan skrivas ut.

6. Validera Marvin genom att göra följande kommandon i kurskatalogen i terminalen.

```bash
# Flytta till kurskatalogen
dbwebb validate marvin2
```

Rätta eventuella fel som dyker upp och publicera igen. När det ser grönt ut så är du klar. 



Extrauppgift {#extra}
-----------------------

* Kasta om bokstäver: Ha en fil med ett ord per rad och plocka fram ett av orden. Kasta om det och låt användaren gissa vilket det faktiska ordet är.



Tips från coachen {#tips}
-----------------------

Lär dig felsöka med debuggern, använd den när du får problem. komplettera med utskrifter av `print()`.

Validera ofta. Så slipper du en massa valideringsfel i slutet av övningen.

Lycka till och hojta till i forumet om du behöver hjälp!




