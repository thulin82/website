---
author: mos
revision:
    2016-11-15: (A, mos) Första utgåvan.
category:
    - kurs/design
...
Bygg ut ditt Anax Flat tema med stöd för bilder
===================================

Du skall lägga till LESS-moduler som hjälper dig att presentera bilder på olika sätt. För att visa att det fungerar bygger du en blogg "Dagens Bild".

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat igenom exemplen "[Figure and figcaption](repo/design/example/figure/figure.html)" samt "[Figure and figcaption med media queries](repo/design/example/figure/figure-responsive.html)"

Du har koll på hur man gör en [blogg](anax/gor-en-blogg) i Anax och du har koll på [shortcodes](anax/shortcodes).

Du har integrerat [Cimage](anax/cimage-for-bildskalning) och [snygga länkar](anax/snygga-lankar) och du vet var du kan läsa på om möjligheterna med [Cimage](https://cimage.se/doc/features-and-options).

Du har sedan tidigare två repon med Anax Flat och Anax Flat tema som ligger i katalogen `me/anax-flat` respektive `me/anax-flat/theme`. Båda är taggade i minst version 4.0.0.



Introduktion {#intro}
-----------------------

Det handlar om att skapa en struktur i LESS för bilder och sedan visa hur man kan använda den genom att skapa bildtungt innehåll i Anax.

Se till att din design, inklusive bilderna, är responsiv, *inom rimliga gränser*.

Använd Cimage för att beskära, skala om och/eller processa bilderna.



Krav {#krav}
-----------------------

1. Lägg till en LESS modul som ger dig en responsiv grund till elementet `<figure>`. Du kan utgå/kopiera från exemplet om du vill. Se till att de media queries du använder fungerar tillsammans med ditt eget tema.

1. Bygg en testsida `content/images.md` där du visar att din LESS-struktur fungerar genom att visa upp bilder i olika storlekar. Lägg sidan i menyn och använd shortcoden `[FIGURE]` när du visar bilderna.

1. Skapa en blogg under `content/blogg` där bloggens tema är "Dagens Bild". Lägg till länken i din meny.

1. Gå ut och fotografera 4 foton med din kamera och skapa ett blogginlägg för varje bild. I varje blogginlägg visar du bilden ur olika aspekter, minst tre olika, och beskriver kort med text om själva bilden och dess omständigheter (hur den togs, varför, med vilken kamera och inställningar). Använd Cimage för att beskära eller förändra bilden. Håll allt kort och enkelt, det är fokus på att presentera bilderna i olika format.

1. Bilderna i bloggen skall fungera responsivt, med media queries.



###Klar och taggad {#tag}

1. Se till att ditt tema passerar testerna som körs vid `make test`.

1. Kör `git status`och se till att alla filer, som skall vara en del av dina båda repon `me/anax-flat` och `me/anax-flat/theme`, verkligen är en del av repot.

1. Du committar och taggar de båda repona som version 5.0.0.

1. Pusha upp repona till GitHub, inklusive taggarna.

1. Om du behöver göra fler taggar så gör du enligt 5.0.1, 5.0.2 och så vidare. Om du får komplettering så skall du alltid tagga en ny version när du är klar med kompletteringen samt pusha upp till GitHub.

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
