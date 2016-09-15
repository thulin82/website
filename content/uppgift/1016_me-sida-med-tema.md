---
author: mos
revision:
    2016-06-08: (A, mos) Första utgåvan.
category:
    - kurs/design
...
Bygg en me-sida med Anax Flat och eget LESS tema
===================================

Du skall sätta samman en me-sida med ditt eget Anax Flat, tillsammans med ditt eget tema som bygger på LESS. 

Allt lägger du ut på GitHub i dina egna repon.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat igenom artiklarna "[Bygg en me-sida med Anax Flat](kunskap/bygg-me-sida-med-anax-flat)" och "[Bygg ett tema till Anax Flat](kunskap/bygg-ett-tema-till-anax-flat)".



Introduktion {#intro}
-----------------------

Spara allt du gör i ditt kursrepo under katalogen `me`.

Din version av Anax Flat skall ligga i katalogen `me/anax-flat` och vara ett eget repo på GitHub som är taggat i minst version 1.0.0.

Din version av temat skall ligga i katalogen `me/anax-flat/theme` och vara ett eget repo på GitHub som är taggat i minst version 1.0.0.



Krav {#krav}
-----------------------



###Del 1 Me-sidan {#me}

1. Uppdatera samtliga filer under katalogen `content` så att de speglar att det är din me-sida. Lägg in relevant innehåll för en me-sida i denna kursen.

1. Förstasidan skall innehålla en hälsning/presentation av/om dig tillsammans med minst en bild.

1. Lägg till en byline till förstasidan. Du kan ha samma byline på fler sidor om du vill.

1. På about-sidan lägger du in valfri text om kursen tillsammans med en godtycklig bild som du anser kompletterar sidans innehåll.

1. På din about-sida skall du lägga en länk till GitHub-repot för din me-sida och för ditt tema.

1. Byt ut den bilden som nu finns med som *flash-bild* på alla sidorna. Lägg dit en egen bild som du tycker passar. Du kan ha olika bilder på olika sidor, om du vill.

1. Fyll i *ett utkast* till din redovisningstext för detta kursmomentet på rätt plats i sidan för redovisningar.



###Del 2 Temat {#tema}

1. Skapa ett enklare bastema till din webbplats. Du behöver inte styla jättemycket, det kommer fler möjligheter under kursen. Men, det måste vara ett gott grundtema. Inget slarv.

1. Header-delen skall vara stylad och se bra ut.

1. Menyn skall vara väl fungerande och responsiv.

1. Innehållsdelen och eventuella sido kolumner skall se bra och och fungera responsivt.

1. Footer och footerkolumnerna skall se bra ut och fungera responsivt.

1. Se till att ditt tema passerar testerna som körs vid `make test`.



###Klar och taggad {#tag}

1. När du är klar så committar du allt till GitHub och taggar båda repona som version 1.1.0. Om du behöver göra nya taggar så gör du enligt 1.1.1, 1.1.2 och så vidare. Om du får komplettering så skall du alltid tagga en ny version när du är klar med kompletteringen.


**NOTE NEJ?**

1. Kopiera katalogen `me/anax-flat` till nuvarande kursmoment `me/kmom01` enligt följande.

```bash
# Ställ dig i kursrepot
$ cd me
$ rsync -av --delete --exclude vendor anax-flat/ kmom01/ && ln -sf ../anax-flat/vendor kmom01/
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

Ta det lugnt och försök förstå hur Anax Flat hanterar innehåll.

Kom ihåg att om du förändrar innehåll i temat så kan du även behöva committa och tagga om din version av Anax Flat, eftersom temats filer kopieras dit. Tipset är att tagga i slutet, när du känner dig klar.

Lycka till och hojta till i forumet om du behöver hjälp!
