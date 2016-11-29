---
author: mos
revision:
    2016-11-15: (A, mos) Första utgåvan.
category:
    - kurs/design
...
Skapa fler teman till ditt Anax Flat
===================================

Du skall skapa fler teman till ditt Anax Flat genom att tänka i design principer.

Du lägger till dina teman via tema väljaren.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat med [teman i temaväljaren](uppgift/en-bas-och-en-familj-av-teman) så du vet hur det fungerar.

Du har läst om design principer.



Introduktion {#intro}
-----------------------

Det finns olika design principer som en tränad designer kan använda sig av. Låt oss kika på ett par av dem och försöka att använda dem i några teman.

Design principer som kan vara intressanta är balans, perspektiv, harmoni, unity, rörelse, variation.

Låt oss även använda oss av grafiska element såsom bilder, texturer, streck, former och färger för att skapa en god design.

När du nu skall skapa ett antal teman, välj då ett enkelt tema som du kan utgå ifrån, som är enkelt att styla med olika designprinciper och design element. Försök göra det tydligt i varje tema vilka principer du försöker tydliggöra.

Om temat som sådant är perfekt eller inte spelar mindre roll, du tränar designprinciper så vi har fokus på dem.

Du får gärna återanvända dina tidigare teman, om du finner det vara en god idé. Kanske har du redan löst delar av uppgiften och då kan du istället lägga tiden på att finslipa de teman du har.

Men, gör det tydligt i temaväljaren att samtliga teman finns med som val.



Krav {#krav}
-----------------------

1. Bygg en testsida `content/design.md` där du kort beskriver varje tema som du nu skall skapa. Lägg sidan i menyn. På sidan länkar du till temaväljaren.

1. Gör två olika teman som var och ett åskådliggör minst en design princip som du själv väljer.

1. Gör två tema som som använder en bakgrundsbild. Den ena bilden skall vara en textur och den andra mer fotoliknande. Använd *opacity* för att göra delar av din webbplats genomskinlig så bilden lyser igenom (lagom mycket).

1. Gör ett tema som enbart använder sig av streck (variantioner av *borders*).

1. Gör ett tema som sträcker sig över hela webbläsarens bredd. Använd bakgrundsfärger i temat. för att styla 



###Klar och taggad {#tag}

1. Se till att ditt tema passerar testerna som körs vid `make test`.

1. Kör `git status`och se till att alla filer, som skall vara en del av dina båda repon `me/anax-flat` och `me/anax-flat/theme`, verkligen är en del av repot.

1. Du committar och taggar de båda repona som version 6.0.0.

1. Pusha upp repona till GitHub, inklusive taggarna.

1. Om du behöver göra fler taggar så gör du enligt 6.0.1, 6.0.2 och så vidare. Om du får komplettering så skall du alltid tagga en ny version när du är klar med kompletteringen samt pusha upp till GitHub.

1. Gör en `dbwebb publish` för att kolla att allt fungerar.

```bash
$ dbwebb publish me
```



Extrauppgift {#extra}
-----------------------

Det finns inga extrauppgifter.



Tips från coachen {#tips}
-----------------------

Lycka till och hojta till i forumet om du behöver hjälp!
