---
author: mos
revision:
    2016-06-03: (A, mos) Första versionen.
category:
    - design
    - ramverk
    - anax
    - anax-flat
...
Bygg en me-sida med Anax Flat
===================================

[FIGURE src=/image/snapvt16/favicon_128x128.png class="right"]

Vi skall använda ramverket Anax för att bygga en me-sida. Eller, närmare bestämt en variant av Anax som heter *Anax Flat*.

Vi börjar med en tom katalog och hämtar hem alla komponenter vi behöver, till slut har vi en webbplats skapad med ramverket Anax Flat.

<!--more-->

Syftet är att bygga en webbplats som skapas med Markdown dokument tillsamman med YAML som *frontmatter*. Frontmattern, tillsammans med en väl definierad katalog och filstruktur fungerar som en ersättare till databasen.

När vi byggt grunden till vår webbplats kan vi spara allt som ett eget repo på GitHub.



Förutsättning {#pre}
-------------------------------

Du har installerat [`composer`](labbmiljo/composer) och [`make`](labbmiljo/make).

Du har konfigurerat din [PHP installation att hantera YAML](labbmiljo/php-yaml).



Videoserie {#video}
-------------------------------

Det finns en videoserie som visar hur jag jobbar igenom denna artikeln. Kika gärna på den samtidigt som du själv jobbar genom denna artikeln.

De videor som är relaterade till denna artikel börjar på "[110 Anax Flat me-sida*](https://www.youtube.com/playlist?list=PLKtP9l5q3ce93K_FQtlmz2rcaR_BaKIET)".



Börja med en tom katalog {#tom}
-------------------------------

Låt oss börja från ingenting. En tom katalog. Skapa en ny katalog och döp den till `anax-flat`. Se till att katalogen ligger på en plats där du kan öppna den via din lokala webbserver.

Om du jobbar i kursrepot så kan du skapa katalogen som `me/anax-flat`.

```text
$ mkdir anax-flat
$ cd anax-flat
```

Anax Flat finns på GitHub och på Packagist. Jag väljer att installera Anax Flat med composer.

```text
$ composer require mos/anax-flat geshi/geshi:dev-master
```

[INFO]
**Not om `geshi/geshi`**

Egentligen behöver du bara paketet `mos/anax-flat` men eftersom paketet `geshi/geshi` inte använder [sematisk versionshantering](http://semver.org/) så får vi även hämta hem det paketet genom att specificera senaste versionen som `dev-master`.
[/INFO]

Nu har du en fil `composer.json` och du har Anax Flat installerat under vendor-mappen. Då kan vi skapa en webbplats med hjälp av filer som ligger i Anax Flat.



Låna en Makefile {#make}
-------------------------------

Anax Flat innehåller en Makefile som vi kan återanvända. Makefilen innehåller vanliga kommandon som vi vill köra när vi bygger en webbplats med Anax Flat.

```text
$ cp vendor/mos/anax-flat/Makefile .
$ ls -l
$ make help
```

Det sista kommandot `make help` ger dig en utskrift av de kommandon som Makefilen stödjer. Det är med hjälp av dessa kommandon som vi nu skall bygga en webbplats.

Öppna gärna filen `Makefile` i din texteditor och studera den. Den innehåller kod som är en blandning av make-specifik syntax och Bash-syntax. För att bli duktig på makefiler behöver du lära dig både make och bash, men det är ett sidospår.

Nu kan vi använda makefilen för att skapa grunden till en webbplats.



Skapa en katalogstruktur {#kataloger}
-------------------------------

Makefilen innehåller ett kommando för att skapa en grundstruktur till din webbplats.

```text
$ make site-build
```

Det som sker, när du kör kommandot, är att instruktioner i makefilen dels skapar ett antal kataloger och dels kopierar filer och katalogstrukturer från de paketen som ligger i `vendor` mappen.

Du kan själv studera [källkoden för makefilen](https://github.com/canax/anax-flat/blob/master/Makefile) och se vad som händer. Leta reda på den action som heter *site-build* så kan du se vilka kommandon som utförs.

Här följer en förteckning av några av de kataloger som skapas.

| Katalog        | Beskrivning                            |
|----------------|----------------------------------------|
| `cache/*`      | Temporär lagring av cachade filer.     |
| `content/*`    | Filer som motsvarar innehållet i webbplatsen. Här redigerar vi innehållet i webbplatsen. |
| `theme/*`      | Utvecklingsmiljö för att skapa ett nytt tema. |
| `htdocs/*`     | Rooten till den publika delen av webbplatsen. Här lagras alla filer som skall vara tillgängliga via en länk. |

Du kan nu öppna katalogen `htdocs` i din webbläsare, via din lokala webbserver. För min del gäller länken `http://localhost/anax-flat/htdocs` men du får justera den så att den passar just din installation.

[FIGURE src=/image/snapvt16/anax-flat-start.png?w=w2 caption="En webbsida redan klar att modifiera."]

Nu har vi en webbplats.

Låt oss nu anpassa webbplatsen, först genom att modifiera dess innehåll och därefter genom att modifiera dess style.



Byt språk på webbplatsen {#lang}
-------------------------------

Filerna som nu finns är grunden till en mesida. De är på engelska, men du får gärna skriva på svenska. Om du väljer svenska så kan du ändra grundinställningen i temat så att den säger att detta är en webbplats på svenska.

Denna ändring gör du i konfigurationsfilen `config/theme.php`. Leta reda på raden som säger `lang` och byt den till `sv`. Så här.

```php
//"lang"          => "en",
"lang"          => "sv",
```

Webbplatsen är språkanpassad och de delar som stödjer det kommer nu att ge svenska meddelanden istället för engelska.



Innehåll som en mesida {#innehall}
-------------------------------

Innehållet i denna webbplats ligger i markdown-filer under katalogen `content`. Öppna upp din texteditor och studera filerna och katalogstrukturen.

Då skall vi ändra filernas innehåll.



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

Sak samma, det ger oss möjlighet att konfigurera hur sidorna presenteras. Ett exempel på detta såg du nyss i `report/.meta` och i `report/000_index.md`.



Anpassa stylen {#style}
-------------------------------

Det följer med en grundstyle som ligger i den minifierade stylesheeten `htdocs/css/default.min.css`. Minifierad betyder att stylesheeten är komprimerad och alla kommentarer och mellanslag är borttagna, den är alltså lite svår att läsa om du öppnar den i din texteditor.

Genom att använda webbläsarens devtools kan du dock se vilka CSS-konstruktioner som finns.

Men hur gör man för att bygga en eget style?

Jo, det kan du läsa om i artikeln "[Bygg ett tema till Anax Flat](kunskap/bygg-ett-tema-till-anax-flat)". Men det tar vi strax. Låt oss avsluta denna artikel först.



Bygg webbplatsen i ett Git repo {#git}
-------------------------------

Det vi har gjort nu är att skapa basen till en webbplats. Denna webbplats kan vi spara på GitHub i ett eget Git repo. 

Det vi behöver göra, för att skapa ett Git repo av vår katalogstruktur, är följande.

```text
$ git init      # Initiera katalogen som ett git repo
$ git status    # Visa vilka filer som är (inte) del av repot
```

Vi skall inte committa alla filer, några vill vi inte committa och därför skapar vi en fil `.gitignore` som innehåller följande.

```text
cache/
composer.lock
vendor/
```

Nu kan vi köra `git status` följt av `git add` för att lägga till de filerna vi vill ha.

```text
$ git status    # Visa vilka filer som är (inte) del av repot
$ git add .     # Lägger till samtliga filer som visas av git status
$ git status
```

Nu kan vi committa de filerna.

```text
$ git commit -m "First commit"  # Verkställer ändringarna
$ git status
```

Nu kan du förbereda ett repo på GitHub. Skapa ett konto om du inte redan har det. Skapa sedan ett repo, du kan döpa det till vad du vill, eller bara till "Anax Flat".

Utför sedan de instruktioner du  ser på GitHub, under rubriken som säger något i stil med:

> *"…or push an existing repository from the command line"*

Ladda om sidan på GitHub så ser du nu ditt repo.

[FIGURE src=/image/snapvt16/anax-flat-me-github.png?w=w2 caption="Anax Flat med me-sida på GitHub."]

Innan du är klar så bör du lägga till en `README.md` samt en `LICENSE`. Själv använder jag MIT som licens. Vill du göra samma så kan du kopiera licensfilen från `vendor/mos/anax-flat/LICENSE` (glöm inte byta namnet i filen).

Du kan se mitt halvfärdiga repo på [`mosbth/Anax-Flat-Me`](https://github.com/mosbth/Anax-Flat-Me), bara för att se hur det kan se ut.



Avslutningsvis {#avslutning}
------------------------------

Nu har du kommit igång med Anax Flat och du kan anpassa webbplatsen med ditt eget innehåll.

Förslagsvis går du nu vidare och ser hur du kan skapa din egen style för webbplatsen genom att jobba igenom artikeln "[Bygg ett tema till Anax Flat](kunskap/bygg-ett-tema-till-anax-flat)".
