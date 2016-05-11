---
author: mos
revision:
    2016-05-11: (PA, mos) Pre-release.
category:
    - design
    - less
    - css
    - ramverk
    - anax
    - anax-flat
...
Bygg ett tema till Anax Flat
===================================

Du har kommit igång med ramverket Anax Flat och du kan skapa ditt eget innehåll på webbplatsen. Nu är det dags att börja styla webbplatsen med CSS, eller rättare sagt med LESS.

Vi bygger upp ett tema från grunden, steg för steg. Temat får en grundstruktur som gör det utbyggbart och modulärt.

<!--more-->



Förutsättning {#pre}
-------------------------------

Du har jobbat igenom artikeln "[Bygg en me-sida med Anax Flat](kunskap/bygg-me-sida-med-anax-flat)".



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
| `theme/*`      | Utvecklingsmiljö för att skapa ett nytt tema. |
| `htdocs/*`     | Rooten till den publika delen av webbplatsen. Här lagras alla filer som skall vara tillgängliga via en länk. |

Du kan nu öppna katalogen `htdocs` i din webbläsare, via din lokala webbserver. För min del gäller länken `http://localhost/anax-flat/htdocs` men du får justera den så att den passar just din installation.

BILD på webbsidan.

Nu har vi en webbplats. Låt oss anpassa webbplatsen, först genom att modifiera dess innehåll och därefter genom att modifiera dess style.



Innehåll som en mesida {#innehall}
-------------------------------

Innehållet i denna webbplats ligger i markdown filer under katalogen `content`. Öppna upp din texteditor och studera filerna och katalogstrukturen.

Då skall vi ändra filernas innehåll.



###Byt språk på webbplatsen {#lang}

Filerna som finns är grunden till en mesida. De är på engelska, men du får gärna skriva på svenska. Om du väljer svenska så kan du ändra grundinställningen i temat så att den säger att detta är en webbplats på svenska.

Denna ändring gör du i konfigurationsfilen `config/theme.php`. Leta reda på raden som säger `lang` och byt den till `sv`. Så här.

```php
//"lang"          => "en",
"lang"          => "sv",
```

Webbplatsen är språkanpassad och de delar som stödjer det kommer nu att ge svenska meddelanden istället för engelska.



###Ändra innehåll i enkla sidor {#sidor}

Två av huvudsidorna som ligger i menyn är `index.md` och `about.md`. Öppna upp dem i din texteditor och uppdatera innehållet. Ladda nu om sidorna i din webbläsare så ser du att innehållet har ändrats.



###Ändra innehåll i block {#block}

Innehållet som ligger i footern, är fördelat i tre kolumner och en footer längst ned. Du hittar deras motsvarande innehåll i katalogen `content/block`. Öppna de olika filerna och redigera dem så de blir personliga för din webbplats.

Ladda om sidan i webbläsaren för att se ändringarna.



###Ändra innehållet i sammansatta sidor {#samsidor}

Sidan för `report/` är en sammansatt sida, den består av flera undersidor. Det som ger sidan dess struktur är konfigurerat i filen `report/.meta`. Du kan kika i den filen för att se dess struktur.

Pröva sedan att ändra i filen `110_kmom01.md`, det är i denna filen du skriver redovisningstexten för kmom01.

Ladda om sidan i webbläsaren för att se den uppdaterade texten.



###YAML för att konfigurera sidornas innehåll {#yaml}

Det du ser överst i sidorna, mellan start taggen `---` och slut taggen `...` är YAML data. YAML är ett textformat som kan läsas in till en PHP datastruktur. 

Vi kallar denna del sidornas *frontmatter*. Det är data om själva sidorna, vi kan kalla det *meta data*, eller *data om data*.

Sak samma, det ger oss möjlighet att konfigurera hur sidorna presenteras. 



Anpassa stylen {#style}
-------------------------------

Det följer med en grundstyle som ligger i den minifierade stylesheeten `htdocs/css/default.min.css`. Minifierad betyder att stylesheeten är komprimerad och alla kommentarer och mellanslag är borttagna, den är alltså lite svår att läsa om du öppnar den i din texteditor.

Genom att använda webbläsarens devtools kan du dock se vilka CSS-konstruktioner som finns.

Men hur gör man för att bygga en eget style?

Jo, det kan du läsa om i artikeln "Bygg ett tema till Anax Flat".



###Bygg eget tema {#egettema}

Jo, makefilen och katalogen `theme` är förberedd för att hjälpa dig med detta.

Gör så här för att komma igång.

1. Gå in i katalogen `theme`.
2. Skapa din fil `style.less`.
3. sss



Responsivitet {#resp}
-------------------------------

Responsiv är dess layout, pröva att ändra bredden på webbläsaren så ser du. Du kan även öppna webbplatsen i en mobil eller läsplatta så ser du att den är responsiv.



Bygg webbplatsen i ett Git repo {#git}
-------------------------------

I artikeln kommer vi att bygga basen till en webbplats. Denna webbplats kan vi spara på GitHub i ett Git repo. 

.gitignore


Avslutningsvis {#avslutning}
------------------------------

Nu har du kommit igång med Anax Flat och du kan anpassa webbplatsen med ditt eget innehåll.

Förslagsvis går du nu vidare och ser hur du kan skapa din egen style för webbplatsen.
