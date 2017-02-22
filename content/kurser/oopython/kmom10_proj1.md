---
author: lew
revision:
    "2016-04-12": (A, lew) Första versionen.
category:
    - oopython
...
Kmom10: Projekt och examination
====================================

[WARNING]
Kursmomentet är under utveckling och blir tillgängligt **senast den 27/2-2017**.
[/WARNING]



Projektidé och upplägg {#upplagg}
--------------------------------------------------------------------

[FIGURE src=/image/oopython/kmom10/classified.jpg?w=c5 class="right"]

Du ska skapa en admin-sida till ett företag, "BlackOps Supplies", som hanterar material till sin personal.  

Administratören ska kunna hyra ut material till personalen via ett gränssnitt där hanteringen sköts. Företaget har en förkärlek till Python och Flask så det måste användas. De påminner dig även om att klasser är ett bra medel för att uppnå struktur och kontroll.  

De vill inte avslöja vad för material eller personal de hanterar, det får du veta privat (välja själv). De gillar också Bootstrap, men inte "out-of-the-box", utan vill ha ett mer unikt utseende - efter din egna förmåga.



Projektspecifikation {#projspec}
--------------------------------------------------------------------

Utveckla och leverera projektet enligt följande specifikationen. Saknas info i specen så kan du själv välja väg, dokumentera dina val i redovisningstexten.

De tre första kraven är obligatoriska och måste lösas för att få godkänt på uppgiften. De tre sista kraven är optionella krav. Lös de optionella kraven för att samla poäng och därmed nå högre betyg.

Varje krav ger max 10 poäng, totalt är det 60 poäng.

Placera din kod i katalogen `me/kmom10/blackops`. Programmet som startar spelet skall heta `blackops.py`.

###Krav 1 Presentation och hantering {#k1}

1. Använd Bootstrap men kör på ett annat tema än tidigare. Utgå ifrån det och ändra utseendet efter egen förmåga.  

2. Använd Flask och Jinja2 som gränssnitt för hantering och kontroll.  

3. Spara informationen i JSON eller SQLite. Man ska kunna visa upp all information i Flask på ett överskådligt sätt.  

4. Personal och material ska hanteras i klasser med arv. Det ska finnas minst 5 personer och minst 5 typer av material inlagda i databasen vid inlämning. Personalen ska delas in i klassificeringsnivåer. Viss personal ska kunna hyra viss typ av material. Har man exempelvis den högsta klassificerings-nivån kan man hyra allt. Minst antal nivåer är 3.



###Krav 2 Admin {#k2}  

1. Admin ska kunna hyra ut materialet till behörig personal.   

2. Admin ska kunna lägga till/ta bort personal.  

3. Admin ska kunna lägga till/ta bort material.  

4. Admin ska kunna ge/ändra personalens klassificeringsnivå.



###Krav 3 Övrig funktionalitet {#k3}  

1. Materialet finns i ett lager. Tar det slut kan man inte hyra ut det innan något av samma typ återlämnats.  

2. Hanteringen ska enbart ske med hjälp av klasser. En fil = en klass. Inga lösa funktioner ska användas.  

3. När programmet laddas ska en klass användas som läser in data från databasen/JSON-filen och skapar objekten som används.  



###Krav 4: SQLAlchemy (optionell) {#k4}

Använd SQLAlchemy för att hantera dina klasser och objekt. Det krävs lite mer för att arbeta med arv i det sammanhanget.  
[Info om arv](http://docs.sqlalchemy.org/en/latest/orm/inheritance.html)


###Krav 5: Lista (optionell) {#k5}

Använd din egna lista från kmom05 för att hantera objekten i projektet.



###Krav 6: Produktifiera (optionell) {#k6}

Visa beställaren bevis på att din kod är bra:  

1. Skapa ett eget UML-diagram över strukturen (ej genererat). Döp filen till "uml.png".  

2. Generera dokumentation för den färdiga koden. Döp filen till "doc.html".  

3. Skriv unittester för dina klasser. Minst 50% [code coverage](https://en.wikipedia.org/wiki/Code_coverage). Döp testfilerna till "_klassens namn_-test.py".


