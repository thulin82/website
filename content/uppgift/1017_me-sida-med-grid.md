---
author: mos
revision:
    2016-10-31: (C, mos) Förtydligade hur man jobber med typografi och det hotrisontella gridet, kopiering kontra modifiering.
    2016-10-26: (B, mos) Omarbetad efter feedback.
    2016-06-22: (A, mos) Första utgåvan.
category:
    - kurs/design
    - tema
    - less
...
Bygg ut ditt tema med stöd för vertikalt och horisontellt grid
===================================

Du skall fortsätta utveckla ditt tema till Anax Flat. Du skall implementera stöd för ett vertikalt grid och för ett horisontellt grid. Du skall bygga ut ditt tema så att det blir responsivt och samtidigt fylla det med ett medvetet val av typografi.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat igenom artiklarna "[Använd ett vertikalt grid med Anax Flat](kunskap/anvand-vertikalt-grid-med-anax-flat)" och "[Skapa ett horisontellt grid för typografi](kunskap/skapa-ett-horisontellt-grid-for-typografi)".



Introduktion {#intro}
-----------------------

Du har en version av Anax Flat som ligger i katalogen `me/anax-flat`. Det är ett eget repo på GitHub som är taggat i minst version 2.\*.

Du har en version av temat som ligger i katalogen `me/anax-flat/theme`. Det är ett eget repo på GitHub som är taggat i minst version 2.\*.



Krav {#krav}
-----------------------



###Del 1 Vertikalt grid {#vertikalt}

1. Kopiera de grid-filer som finns i exemplet under `example/grid/fluid/less/grid*`. Lägg till dem så att de finns med i ditt tema. Lägg till båda i din `modules.less`, men kommentera bort den ena så att du bara har ett grid aktivt.

1. Skapa ett target för `upgrade-grid` i din Makefile som hämtar hem senaste versionen av grid-filerna från [kursrepot på GitHub](https://github.com/dbwebb-se/design/tree/master/example/grid/fluid/less).

1. Skapa en fil `modules/layout.less` där du stylar din Anax Flat enligt ditt valda grid. Förslagsvis använder du mellan 960px till 1200px som största storlek och du använder 12 eller 24 kolumner, eller välj efter eget huvud. Detta är nu basen i ditt aktiva tema. Kommentera bort din tidigare `modules/regions.less` så den inte används från `modules.less`.

1. Skapa en `modules/grid-helpers.less` och lägg en mixin som visualiserar gridet. Mixinen skall heta `.showGrid()` och ta ett argument som är gridets maximala storlek. De bilder du behöver lägger du enklast i `htdocs/img/grid`.

1. Skapa en ny sida `content/grid.md`. Lägg in den sidan i menyn. När man tittar på den sidan skall gridet visas i bakgrunden. Se till att sidan är fylld med innehåll i minst två kolumner så att gridet framgår tydligt.

1. Gör ditt tema responsivt med media queries och förberett för mindre skärmar.



###Del 2 Horisontellt grid {#horisontellt}

1. Kopiera de relevanta LESS-filer som finns i exemplet under `example/typography-grid/less/typography-*`. Lägg till dem så att de finns med i ditt tema. 

1. Skapa ett target för `upgrade-typographic-grid` i din Makefile som hämtar hem senaste versionen av LESS-filerna från [kursrepot på GitHub](https://github.com/dbwebb-se/design/tree/master/example/typography-grid/less).

1. Gör så att båda `upgrade-typographic-grid` och `upgrade-grid` blir en del av target `upgrade` i din Makefile.

1. I din `style.less` så aktiverar du typografin. Verifiera att det fungerar med de exempefiler du kopierat.

1. Skapa en sida `content/typography.md`. Lägg in sidan i menyn. Fyll sidan med text och typografiska element som visar hur du stylat dem. Ungefär liknande textmassan som fanns i [exemplet](/repo/design/example/typography-grid/typography.html). När man tittar på den sidan skall gridet visas i bakgrunden. De typografiska elementen skall matcha gridet.

1. Gör så att alla element på sidan matchar det magiska numret och lutar mot det typografiska gridet. Det gäller till exempel för de margin-bottom du har mellan olika delar av sidan, till exempel flash, main och footer-regionerna. Använd `@magicNumber` där det finns möjlighet och jobba främst med `margin-bottom`.



###Del 3 Typografisk layout {#typografi}

1. Ta exempelkoden och gör den till din egen. Det kan vara en god idè att modifiera grundfilerna för det horisontella grid  som du kopierat i föregående steg. Men, du kan inte modifiera de kopierade filerna eftersom de skrivs över vid en `make update`. Du behöver alltså skapa nya egna filer, där du lägger din egen modifierade variant till det horisontella gridet.

1. Bygg nu ut ditt tema med en egenvald typografisk layout. Gör ett aktivt val för typsnitt och storlekar och eventuella ramar, etc.

1. Försök separera basen för ditt horisontella grid och din specifika anpassning av typografin. Lägg det som går att återanvända på en plats, och den specifika anpassningen på en annan plats, i dina LESS-moduler.



###Klar och taggad {#tag}

1. Se till att ditt tema passerar testerna som körs vid `make test`.

1. Kör `git status`och se till att alla filer, som skall vara en del av dina båda repon `me/anax-flat` och `me/anax-flat/theme`, verkligen är en del av repot.

1. Du committar och taggar de båda repona som version 3.0.0.

1. Pusha upp repona till GitHub, inklusive taggarna.

1. Om du behöver göra fler taggar så gör du enligt 3.0.1, 3.0.2 och så vidare. Om du får komplettering så skall du alltid tagga en ny version när du är klar med kompletteringen samt pusha upp till GitHub.

1. Gör en `dbwebb publish` för att kolla att allt fungerar.

```bash
$ dbwebb publish me
```



Extrauppgift {#extra}
-----------------------

Det finns inga extrauppgifter.



Tips från coachen {#tips}
-----------------------

Ta det lugnt och försök förstå hur LESS-koden fungerar. Lägg också tid på att försöka finna en god struktur i hur du fördelar koden i dina LESS-moduler. Dela upp det som är grunden och återanvändbart kontra det som är specifik anpassning av grunden.

Kom ihåg att om du förändrar innehåll i temat så kan du även behöva committa och tagga om din version av Anax Flat, eftersom temats filer kopieras dit. Tipset är att tagga i slutet, när du känner dig klar.

Lycka till och hojta till i forumet om du behöver hjälp!
