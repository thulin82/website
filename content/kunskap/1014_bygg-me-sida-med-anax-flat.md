---
author: mos
revision:
    2016-05-02: (PA, mos) Pre-release.
category:
    - design
    - ramverk
    - anax-flat
...
Bygg en me-sida med Anax Flat
===================================

Vi skall använda ramverket Anax Flat för att bygga en me-sida. Ramverket Anax Flat är en variant av Anax som bygger på en webbplats som skapas med Markdown dokument tillsamman med YAML eller JSON som frontmatter. Frontmattern tillsammans med en väl definierad katalog och filstruktur fungerar som en ersättare till databasen.

När vi byggt vår webbplats börjar vi skapa ett tema till den, genom att använda LESS och ett gridbaserat LESS-ramverk.

<!--more-->



Förutsättning {#pre}
-------------------------------

Du har installerat `composer` och `make`.



Börja med en tom katalog {#tom}
-------------------------------

Låt oss börja från ingenting. En tom katalog. Skapa en ny katalog och döp den till `me`.

```bash
$ mkdir me
$ cd me
```

Anax Flat finns på GitHub och på Packagist. Jag väljer att installera Anax med composer.

```bash
$ composer require mos/anax-flat
```

Nu har du en fil `composer.json` och du har Anax Flat installerat under vendor-mappen. Då kan vi skapa en webbplats med hjälp av filer som ligger i Anax Flat.



Låna en Makefile {#make}
-------------------------------

Anax Flat innehåller en Makefile som vi kan återanvända. Makefilen innehåller vanliga kommandon som vi vill köra när vi bygger en webbplats med Anax Flat.

```bash
$ cp vendor/mos/anax/Makefile .
$ ls -l
$ make help
```

Det sista kommandot ger dig en utskrift av de kommandon som Makefilen stödjer. Det är med hjälp av dessa kommandon som vi nu skall bygga en webbplats.

Öppna gärna filen `Makefile` i din texteditor och studera den. Den innehåller kod som är en blandning av make-specifik syntax och Bash-syntax. För att bli duktig på makefiler behöver du lära dig både ock.



Skapa en katalogstruktur {#kataloger}
-------------------------------









Avslutningsvis {#avslutning}
------------------------------
