---
author: lew
revision:
    "2016-04-12": (PA, lew) Pre-release.
category:
    - oopython
...
Kmom10: Projekt och examination
====================================

Detta kursmoment avslutar och examinerar kursen.

Upplägget är enligt följande:

* Projektet och redovisning (20-80h)

Totalt omfattar kursmomentet (07/10) ca 20+20+20+20 studietimmar.



Projektidé och upplägg {#upplagg}
--------------------------------------------------------------------

Du ska skapa en admin-sida till ett företag, "BlackOps Supplies", som hanterar material till sin personal.  

Administratören ska kunna hyra ut material till personalen via ett gränssnitt där hanteringen sköts. Företaget har en förkärlek till Python och Flask så det måste användas. De påminner dig även om att klasser är ett bra medel för att uppnå struktur och kontroll.  

De vill inte avslöja vad för material eller personal de hanterar, det får du veta privat (välja själv). De gillar också Bootstrap, men inte "out-of-the-box", utan vill ha ett mer unikt utseende - efter din egna förmåga.



Bedömning och betygsättning {#bedomning}
--------------------------------------------------------------------

När du lämnat in projektet bedöms det tillsammans med dina tidigare redovisade kursmoment och du får ett slutbetyg på kursen. Läs om [grunderna för bedömning och betygsättning](kurser/bedomning-och-betygsattning).



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

4. Personal och material ska hanteras i klasser med arv. Det ska finnas minst 5 personer och minst 5 typer av material inlagda i databasen vid inlämning. Personalen ska delas in i klassificerings-nivåer. Viss personal ska kunna hyra viss typ av material. Har man exempelvis den högsta klassificerings-nivån kan man hyra allt. Minst antal nivåer är 3.



###Krav 2 Admin {#k2}  

1. Admin ska kunna hyra ut materialet till behörig personal.   

2. Admin ska kunna lägga till/ta bort personal.  

3. Admin ska kunna lägga till/ta bort material.  

4. Admin ska kunna ge/ändra personalens klassificerings-nivå.  



###Krav 3 Övrig funktionalitet {#k3}  

1. Materialet finns i ett lager. Tar det slut kan man inte hyra ut det innan något av samma typ återlämnats.  

2. Hanteringen ska enbart ske med hjälp av klasser. En fil = en klass. Inga lösa funktioner ska användas.  

3. När programmet laddas ska en klass användas som läser in data från databasen/JSON-filen och skapar objekten som används.  



Se till att din kod validerar.

```bash
# Ställ dig i kurskatalogen
dbwebb publish kmom10
```

Förklara i redovisningstexten hur du tänkt när du strukturerat ditt program, vilka filer du har och vad de fyller för funktion.



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



Redovisning {#redovisning}
--------------------------------------------------------------------

Skapa din me-sida version 7 i kmom10/flask7 genom att kopiera kmom06/flask6 och därefter göra eventuella uppdateringar som du själv bestämmer.

1\. På din redovisningssida, skriv följande:

1.1. För varje krav du implementerat, dvs 1-6, skriver du ett textstycke om ca 5-10 meningar där du beskriver vad du gjort och hur du tänkt. Poängsättningen tar sin start i din text så se till att skriva väl för att undvika poängavdrag. Missar du att skriva/dokumentera din lösning så blir det 0 poäng. Du kan inte komplettera en inlämning för att få högre betyg.

1.2. Skriv ett allmänt stycke om hur projektet gick att genomföra. Problem/lösningar/strul/enkelt/svårt/snabbt/lång tid, etc. Var projektet lätt eller svårt? Tog det lång tid? Vad var svårt och vad gick lätt? Var det ett bra och rimligt projekt för denna kursen?

1.3. Avsluta med ett sista stycke med dina tankar om kursen och vad du anser om materialet och handledningen (ca 5-10 meningar). Ge feedback till lärarna och förslå eventuella förbättringsförslag till kommande kurstillfällen. Är du nöjd/missnöjd? Kommer du att rekommendera kursen till dina vänner/kollegor? På en skala 1-10, vilket betyg ger du kursen?

2\. Ta en kopia av texten på din redovisningssida och kopiera in den på Its/redovisningen. Glöm inte länka till din me-sida och projektet.

3\. Ta en kopia av texten från din redovisningssida och gör ett inlägg i [kursforumet](forum/utbildning/python) och berätta att du är klar.

4\. Se till att samtliga kursmoment validerar.

```bash
# Ställ dig i kurskatalogen
dbwebb publish me
```
