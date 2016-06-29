---
author: mos
revision:
    2016-06-08: (PA, mos) Arbetskopia.
...
Resultat och redovisning
====================================

Som ett sista steg i varje kursmoment skall du redovisa. Gör så här.

<!--more-->



Skriv redovisningstext {#text}
---------------------------------------

I din me-sida har du en dedikerad plats för dina redovisningstexter. Där skall du [redovisa dina reflektioner](kurser/faq/att-skriva-en-bra-redovisningstext) från varje kursmoment.

Reflektera över svårigheter, problem, lösningar, erfarenheter, lärdomar, resultatet, etc.

Besvara även de specifika frågor som finns för varje kursmoment.

Skriv minst 15 meningar.



Tagga ny version {#tag}
---------------------------------------

Se till att du har taggat en ny version så att dina senaste ändringar finns med i respektive repo och tag. Versionen ger en historik över dina ändringar enligt följande.

| Version | Kmom   |
|---------|--------|
| 1.0.*, 1.1.*   | kmom01 | 
| 1.2.*   | kmom02 | 
| 1.3.*   | kmom03 | 
| 1.4.*   | kmom04 | 
| 1.5.*   | kmom05 | 
| 1.6.*   | kmom06 | 
| 2.0.*   | kmom10 | 

Det är viktigt att du taggar dina repon med rätt taggar. Annars tappar du historik och du kan få problem med inlämningarna.



Ladda upp och publicera din kurskatalog {#repo}
---------------------------------------

Ladda upp ditt kurskatalog med alla dina övningar genom att göra följande kommandon i terminalen.

```bash
# Ställ dig i kurskatalogen
dbwebb publish me
```

Rätta eventuella fel som dyker upp. Det som du laddar upp måste vara felfritt.

Den länken som dyker upp längst ned är länken till din me-sida. Där kan du se ditt publicerade resultat.



Kopiera redovisningstexten till forumet {#forum}
---------------------------------------

Ta en kopia av redovisningstexten och gör ett inlägg i [kursforumet](forum/utbildning/design). 

Visa upp vad du gjort och berätta att du är klar. Bifoga länken till din me-sida.



Kopiera redovisningstexten till ITs {#its}
---------------------------------------

Kopiera redovisningstexten och lämna in den på redovisningen [ITs](kurser/faq/bth-stodfunktioner#its) tillsammans med en länk till din me-sida. 

Läraren kommer snabbt kolla igenom dem. Betyg är G (godkänd) eller komplettera (komplettera -> gör om -> gör bättre). Betyget baseras på din redovisningstext samt att din me-sida fungerar tillsammans med kursmomentets övningar.



Testa din kurskatalog {#test}
---------------------------------------

Du kan göra ett självtest med [`dbwebb inspect`](http://local.v2.dbwebb.se/dbwebb-cli/inspect) som berättar för dig om du har med alla delar i ett kursmoment. Det är samma test som den som rättar ditt kursmoment kommer att köra.

```bash
# Ställ dig i kursrepot och ange kursmomentet du vill inspektera
dbwebb inspect kmom01

# Eller lägg till kursens namn och stå var du vill
dbwebb inspect design kmom01
```

Gör alltid ett självtest så kanske du slipper en och annan onödig komplettering.



Klart! {#klar}
---------------------------------------

Läs gärna dina med-studenters inlämningar och ställ dina frågor i forumet. Se till att du får dina frågor besvarade. Skapa alltid en tråd i forumet om du funderar på något.

Ta en kort mental paus innan du ger dig på nästa kursmoment.
