---
author: mos
revision:
    2016-04-11: (PA, mos) Arbetskopia.
...
Kmom10: Projekt och examination
====================================

[WARNING]
**Kursmomentet är under utveckling. Kursen ges första gången i läsperiod 2, hösten 2016, till programstudenter på programmet Webbprogrammering.**
[/WARNING]

Detta kursmoment avslutar och examinerar kursen.

Upplägget är enligt följande:

* Projektet och redovisning (20-80h)

Totalt omfattar kursmomentet (07/10) ca 20+20+20+20 studietimmar.



Bedömning och betygsättning {#bedomning}
--------------------------------------------------------------------

När du lämnat in projektet bedöms det tillsammans med dina tidigare redovisade kursmoment och du får ett slutbetyg på kursen. Läs om [grunderna för bedömning och betygsättning](kurser/bedomning-och-betygsattning).



Projektidé och upplägg {#upplagg}
--------------------------------------------------------------------

Du har blivit känd som en webbprogrammerare med känsla för design och kunderna står nu i kö. Du har ett antal uppdrag som dina kunder vill ha utförda och du har begränsad tid.

TBD.

Fråga i forumet om du känner dig osäker.



Projektspecifikation {#projspec}
--------------------------------------------------------------------

Utveckla och leverera enligt följande specifikationen. Saknas info i specen så kan du själv välja väg, dokumentera dina val i redovisningstexten.

De tre första kraven är obligatoriska och måste lösas för att få godkänt på uppgiften. De tre sista kraven är optionella krav. Lös de optionella kraven för att samla poäng och nå högre betyg.

Varje krav ger max 10 poäng, totalt 60 poäng.



###Förberedelser {#forbered}

Styla upp din me-sida.

Organisera moduler och LESS-kod.

Snygga till analysen.

Se till att ditt tema är responsivt.

?vgrid & ?hgrid




###Krav 1: Tema till konsultföretaget {#k1}

**Styrelseordförande Ludviga Af Solstråle** med kompanjoner, vill ha ett propert tema till deras *executive consulting high-end business company*. Det skall vara propert, gediget, andas slipsar, dyra kostymer, höga klackar och dyra klänningar. Du är inte 100% säker på vad de säljer, men dyrt verkar det vara, annars skulle de inte ha råd med sina dyra kostymer och klänningar.

Du kan själv välja om du vill att företagets verksamhet skall vara advokater/jurister, managementkonsulter, eller annat.

Skapa en testsida (`content/consult.md`) som är tänkt som webbplatsens förstasida. Låt sidan innehålla flertalet bilder (>5 bilder).

Gör enligt [de krav som ställs på ett tema](#tema).



###Krav 2: Tema till artisten {#k2}

**Artisten Art Ist**, som är *new and upcoming* inom sitt gebit, vill ha en webbplats och du löser det. Det skall vara nytt och fräsht, tidsenligt och det skall skapa intresse.

Du kan själv välja om du vill att artisten skall vara ung/gammal, hålla på med trolleri eller musik och om det är fiol, harpa eller techno.

Skapa en testsida (`content/artist.md`) som är tänkt som webbplatsens förstasida. Låt sidan innehålla flertalet bilder (>5 bilder).

Gör enligt [de krav som ställs på ett tema](#tema).



###Krav 3: Analys usability (grupp) {#k3}

**Herr Jakob Nilsson** har bett dig att göra en analys för att kolla hur användarvänliga webbplatser är, baserat på de fem komponenter som anges i [Usability 101: Introduction to Usability](https://www.nngroup.com/articles/usability-101-introduction-to-usability/).

Du gör en sedvanlig analys och väljer ut 4 webbplatser som du själv använder ofta och känner till. Du poängsätter varje webbplats på respektive kritera och summerar totalen och sorterar sedan per totalen och utser en testvinnare.

Lägg resultatet i (`analysis/703_usability.md`).

Du kan lösa detta krav i grupp.



###Krav 4: Analys skrivsätt (grupp) (optionellt) {#k4}

**Språkherren Engan Horas från Dahlen** har kontaktat dig och bett dig göra en språkanalys av webben. Du funderar på kriterier för gott språkbruk och väljer att skapa ditt eget regelverk baserat på "[Skriva för webben](https://www.iis.se/lar-dig-mer/guider/hur-man-skriver-for-webben/)".

Du börjar med att definiera ditt eget regelverk, du väljer 4-5 viktiga regler.

Du väljer ut fyra webbplatser som har mycket artiklar och analyserar dem utifrån dina kriterier.

Du sammanfattar dina egna generella slutsatser från analysen.

Lägg resultatet i (`analysis/707_write.md`).

Du kan lösa detta krav i grupp.



###Krav 5: Tema till dbwebb (optionellt) {#k5}

Grundaren till webbplatsen dbwebb.se har konsulterat dig och bett om ett tema som andas webbprogrammering/programmering, utbildning, öppen källkod och community.

Du chockar honom med din syn på saken i form av ett hyffsat väl genomarbetat och användarvänligt tema.

Gör enligt [de krav som ställs på ett tema](#tema).



###Krav 6: LESS moduler (optionellt) {#k6}

1. Förklara din bakomliggande struktur av LESS-koden. Berätta hur du valt att strukturera koden och förklara varför det är en god uppdelning.

1. Du har också valt att lägga extra kraft på minst två LESS modulerna. Välj två eller tre av dessa moduler och förklara vad du gjort och länka till exempel som tydligt påvisar hur de används. 



###Krav på teman {#teman}

När du gör ett tema, se till att göra och förklara följande.

* Bygg temat i din temaväljare.
* Beskriv färgprofilen, typografin, designprinciper och designelement som du använt och förklara hur det gynnar ditt tema.
* Skapa en testsida som är tänkt som webbplatsens förstasida.
* Skriv text som gynnar företagets profil, kopiera gärna, men inte Lorem Ipsum.

* Grid layout vertikalt som horisontellt
* Responsivt



###Krav 1, 2, 3: Grunden {#k1}

<!--
utöka/förändra urvalet av webbplatser och jobba igenom undersökningarna igen.

egen favicon

tre teman.
företag, artist, webbprogrammerare
?vgrid
?hgrid

direktlänk till tema och landningssida

egen logo

extra tema till dbwebb?
m infodok

thheme selector med cookie

analys skriva för webben

gå igenom analyserna gjorda.

egna stylade LESS moduler

beskriv strukturen på teman och LESS modulerna

analys användbarhet 101
analys color contrast


paper om programmeringserfarenhet
paper om att rätta och inte räTitta
-->

<!-- gå tillbaka till analysis color och fixa till bilderna -->

<!--
Designa webbplats utifrån bild.

(Funktionsanpassad webbplats)
4. Usablity undersökning ala Wellness.

(logo)

-->



###Krav 4:  (optionell) {#k4}




###Krav 5:  (optionell) {#k5}



###Krav 6:  (optionell) {#k6}




Redovisning {#redovisning}
--------------------------------------------------------------------

1\. På din redovisningssida, skriv följande:

1.1. För varje krav du implementerat, dvs 1-6, skriver du ett textstycke om ca 5-10 meningar där du beskriver vad du gjort och hur du tänkt. Poängsättningen tar sin start i din text så se till att skriva väl för att undvika poängavdrag. Missar du att skriva/dokumentera din lösning så blir det 0 poäng. Du kan inte komplettera en inlämning för att få högre betyg.

1.2. Skriv ett allmänt stycke om hur projektet gick att genomföra. Problem/lösningar/strul/enkelt/svårt/snabbt/lång tid, etc. Var projektet lätt eller svårt? Tog det lång tid? Vad var svårt och vad gick lätt? Var det ett bra och rimligt projekt för denna kursen?

1.3. Avsluta med ett sista stycke med dina tankar om kursen och vad du anser om materialet och handledningen (ca 5-10 meningar). Ge feedback till lärarna och förslå eventuella förbättringsförslag till kommande kurstillfällen. Är du nöjd/missnöjd? Kommer du att rekommendera kursen till dina vänner/kollegor? På en skala 1-10, vilket betyg ger du kursen?

2\. Ta en kopia av texten på din redovisningssida och kopiera in den på Its/redovisningen. Glöm inte länka till din me-sida och projektet. 

3\. Ta en kopia av texten från din redovisningssida och gör ett inlägg i [kursforumet](forum/utbildning/design) och berätta att du är klar.

4\. Tagga repona i version 10.0 och se till att det validerar.

```bash
# Ställ dig i kurskatalogen
dbwebb publish me
```
