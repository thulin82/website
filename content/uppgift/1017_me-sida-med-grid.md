---
author: mos
revision:
    2016-06-22: (A, mos) Första utgåvan.
category:
    - kurs/design
    - tema
    - less
...
Bygg ut ditt tema med stöd för vertikalt och horisontellt grid
===================================

Du skall fortsätta utveckla ditt tema till Anax Flat. Du skall implementera stöd för ett vertikalt grid och för ett horisontellt grid. Du skall bygga ut ditt tema så att det blir responsivt.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat igenom artiklarna "[Använd ett vertikalt grid med Anax Flat](kunskap/anvand-vertikalt-grid-med-anax-flat)" och "[Skapa ett horisontellt grid för typografi](kunskap/skapa-ett-horisontellt-grid-for-typografi)".



Introduktion {#intro}
-----------------------

Du har en version av Anax Flat som ligger i katalogen `me/anax-flat`. Det är ett eget repo på GitHub som är taggat i minst version 1.\*.

Du har en version av temat som ligger i katalogen `me/anax-flat/theme`. Det är ett eget repo på GitHub som är taggat i minst version 1.\*.



Krav {#krav}
-----------------------


###Del 1 Vertikalt grid {#vertikalt}

1. Kopiera de grid-filer som finns i exemplet under `example/grid/fluid/less/grid*`. Lägg till dem så att de finns med i ditt tema. Lägg till båda i din `modules.less`, men kommentera bort den ena så att du bara har ett grid aktivt.

1. Skapa ett target för `upgrade-grid` i din Makefile som hämtar hem senaste versionen av grid-filerna från [kursrepot på GitHub](https://github.com/dbwebb-se/design/tree/master/example/grid/fluid/less).

1. Skapa en fil `modules/layout.less` där du stylar din Anax Flat enligt ditt valda grid. Förslagsvis använder du 960px som största storlek och gör 12 kolumner. Detta är nu basen i ditt aktiva tema. Kommentera bort din tidigare `regions.less`.

1. Skapa en `modules/grid-helpers.less` och lägg en mixin som visualiserar gridet. Mixinen skall heta `.showGrid()` och ta ett argument som är gridets maximala storlek. De bilder du behöver lägger du enklast i `htdocs/img/grid`.

1. Skapa en ny sida `content/grid.md`. Lägg in den sidan i menyn. När man tittar på den sidan skall gridet visas i bakgrunden.

1. Gör ditt tema responsivt med media queries och förberett för mindre skärmar.



###Del 2 Horisontellt grid {#horisontellt}

1. Kopiera de relevanta LESS-filer som finns i exemplet under `example/typography-grid/less/typography-*`. Lägg till dem så att de finns med i ditt tema. 

1. Skapa ett target för `upgrade-typographic-grid` i din Makefile som hämtar hem senaste versionen av LESS-filerna från [kursrepot på GitHub](https://github.com/dbwebb-se/design/tree/master/example/typography-grid/less).

1. Gör så att båda `upgrade-typographic-grid` och `upgrade-grid` blir en del av target `upgrade` i din Makefile.

1. Skapa en `modules/typography.less` där du aktiverar och eventuellt förändrar  stylen på dina typografiska element.

1. Gör så att alla övriga layoutlement på sidan också matchar det magiska numret. Det gäller till exempel för de margin-bottom du har mellan olika delar av sidan. Det är ingen exakt vetenskap, men använd `@magicNumber` där det finns möjlighet.

1. Skapa ytterligare en sida `content/typography.md`. Lägg in den sidan i menyn. Fyll sidan med text och typografiska element som visar hur du stylat dem. Ungefär liknande textmassan som fanns i [exemplet](/repo/design/example/typography-grid/typography.html). När man tittar på den sidan skall gridet visas i bakgrunden. De typografiska elementen skall matcha gridet.



###Klar och taggad {#tag}

1. Se till att ditt tema passerar testerna som körs vid `make test`.

1. När du är klar så committar du allt till GitHub och taggar båda repona som version 2.0.0. Om du behöver göra nya taggar så gör du enligt 2.0.1, 2.0.2 och så vidare. Om du får komplettering så skall du alltid tagga en ny version när du är klar med kompletteringen.

1. Kopiera katalogen `me/anax-flat` till nuvarande kursmoment `me/kmom02` enligt följande.

```bash
# Ställ dig i kursrepot
$ cd me
$ rsync -av --delete --exclude vendor anax-flat/ kmom02/ && ln -sf ../anax-flat/vendor kmom02/
```

1. Gör en `dbwebb publish` för att kolla att allt fungerar.

```bash
$ dbwebb publish me
```



Extrauppgift {#extra}
-----------------------

Det finns inga extrauppgifter.



Tips från coachen {#tips}
-----------------------

Ta det lugnt och försök förstå hur LESS-koden fungerar.

Kom ihåg att om du förändrar innehåll i temat så kan du även behöva committa och tagga om din version av Anax Flat, eftersom temats filer kopieras dit. Tipset är att tagga i slutet, när du känner dig klar.

Lycka till och hojta till i forumet om du behöver hjälp!
