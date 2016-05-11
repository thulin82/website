---
author: mos
revision:
    2016-05-02: (PA, mos) Pre-release.
category:
    - design
    - ramverk
    - anax
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

Du kan kompilera LESS-filer vid kommandoraden.



Börja med en tom katalog {#tom}
-------------------------------

Låt oss börja från ingenting. En tom katalog. Skapa en ny katalog och döp den till `anax-flat`. Se till att katalogen ligger på en plats där du kan öppna den via din lokala webbserver.

```bash
$ mkdir anax-flat
$ cd anax-flat
```

Anax Flat finns på GitHub och på Packagist. Jag väljer att installera Anax Flat med composer.

```bash
$ composer require mos/anax-flat geshi/geshi:dev-master
```

*Egentligen behöver du bara paketet `mos/anax-flat` men eftersom paketet `geshi/geshi` inte använder [sematisk versionshantering](http://semver.org/) så får vi även hämta hem det paketet genom att specificera senaste versionen som `dev-master`.*

Nu har du en fil `composer.json` och du har Anax Flat installerat under vendor-mappen. Då kan vi skapa en webbplats med hjälp av filer som ligger i Anax Flat.

<!--

Flytta till ett eget dokument om hur man installera och använder composer.

Du kan alltid kontrollera vilka moduler som du tagit hem, de som nu ligger i `vendor` mappen.

```bash
$ composer info
```

Du kan också kontrollera varför en modul installerats genom att se vilken modul som är beroende av densamma. Så här kan du se vilken modul som krävde att `mos/ctextfilter` installerades.

```bash
$ composer require mos/ctextfilter
```

Om du vill vet mer om paketet så kan du använda composer för att öppna paketets hemsida.

```bash
$ composer home mos/ctextfilter
$ composer home mos/anax
```

Du kan alltid uppdatera de nedladdade paketen för att få hem senaste ändringar.

```bash
$ composer update
```

Ibland får du ett meddelande om att uppdatera `composer`. Du kan hjälpa `composer` att uppdatera sig själv.

```bash
$ composer selfupdate
```

Du kan göra fler saker med `composer`. Använd hjälptexten för att snabbt få en översikt av vad du kan göra.

```bash
$ composer
```
-->

Så här kan det se ut.

ASCIINEMA



Låna en Makefile {#make}
-------------------------------

Anax Flat innehåller en Makefile som vi kan återanvända. Makefilen innehåller vanliga kommandon som vi vill köra när vi bygger en webbplats med Anax Flat.

```bash
$ cp vendor/mos/anax-flat/Makefile .
$ ls -l
$ make help
```

Det sista kommandot `make help` ger dig en utskrift av de kommandon som Makefilen stödjer. Det är med hjälp av dessa kommandon som vi nu skall bygga en webbplats.

Öppna gärna filen `Makefile` i din texteditor och studera den. Den innehåller kod som är en blandning av make-specifik syntax och Bash-syntax. För att bli duktig på makefiler behöver du lära dig både make och bash, men det är ett sidospår.

Så här kan det se ut.

ASCIINEMA

Nu kan vi använda makefilen för att skapa grunden till en webbplats.



Skapa en katalogstruktur {#kataloger}
-------------------------------

Makefilen innehåller ett kommando för att skapa en grundstruktur till din webbplats.

```bash
$ make site-build
```

Det som sker är att kommandon i makefilen dels skapar ett antal kataloger och dels kopierar filer och katalogstrukturer från de paketen som ligger i `vendor` mappen.

Du kan själv studera [källkoden för makefilen](https://github.com/canax/anax-flat/blob/master/Makefile) och se vad som händer. Leta reda på den action som heter *site-build* så kan du se vilka kommandon som utförs.

Så här kan det se ut.

ASCIINEMA

Här följer en förteckning av några av de kataloger som skapas.

| Katalog        | Beskrivning                            |
|----------------|----------------------------------------|
| `cache/*`      | Temporär lagring av cachade filer.     |
| `content/*`    | Filer som motsvarar innehållet i webbplatsen. Här redigerar vi innehållet i webbplatsen. |
| `htdocs/*`     | Rooten till den publika delen av webbplatsen. Här lagras alla filer som skall vara tillgängliga via en länk. |

Du kan nu öppna katalogen `htdocs` i din webbläsare, via din lokala webbserver. För min del gäller länken `http://localhost/anax-flat/htdocs` men du får justera den så att den passar just din installation.

BILD på webbsidan.

Nu har vi en webbplats. Låt oss anpassa webbplatsen, först med en grundstyle och sedan med innehåll.



Grundstyle {#style}
-------------------------------

Det följer med en grundstyle som vi ännu inte använder. 




Innehåll som en mesida {#innehall}
-------------------------------








Responsivitet {#resp}
-------------------------------

Responsiv är dess layout, pröva att ändra bredden på webbläsaren så ser du. Du kan även öppna webbplatsen i en mobil eller läsplatta så ser du att den är responsiv.



Bygg webbplatsen i ett Git repo {#git}
-------------------------------

I artikeln kommer vi att bygga basen till en webbplats. Denna webbplats kan vi spara på GitHub i ett Git repo. 

.gitignore


Avslutningsvis {#avslutning}
------------------------------
