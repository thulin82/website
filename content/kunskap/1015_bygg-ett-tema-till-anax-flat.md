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

Du kan kompilera LESS-filer vid kommandoraden.



Börja med en fork {#fork}
-------------------------------

På GitHub finns mosbth/ ett embryo till ett tema. Framförallt finns en makefile som hjälper dig att jobba med LESS på kommandoraden. Allt eftersom kommer vi bygga ut vårt tema genom att återanvända befintliga moduler tillsammans med de egna moduler vi skapar. Att samla allt i ett eget Git-repo känns som en god idé.

Grundtemat finns på [`canax/anax-flat-theme`](https://github.com/mosbth/anax-flat-theme). Forka den och klona den sedan till din installation av Anax Flat.

Forka gör du via GitHub, klicka på knappen "Fork".

Nu har du en egen kopia på ditt eget GitHub konto. Ta nu och klona din egna kopia.

```bash
# Flytta till rooten av din Anax Flat
$ git clone git@github.com:mosbth/anax-flat-theme.git theme
$ cd theme
$ ls -l
```

Kika runt bland filerna och öppna dem i din texteditor. Bekanta dig med dem, de innehåller inte så mycket för tillfället, bara ett skal.



Verktyg för att kompilera och linta LESS {#less}
-------------------------------

**Installera som lokal dev miljö istället med packages.json**

Innan vi kan kompilera LESS behöver vi en kompilator. Jag tänker installera en kompilator i form av ett NPM-paket.

Du kan använda makefilen för att installera det som behövs.

```bash
$ make npm-config
$ make npm-install
$ make npm-version
```

Nu har du två verktyg. Du har kommandot `lessc` som lintar, kompilerar och minifierar din styesheet. Du har även kommandot `csslint` som lintar din slutliga CSS-kod.

Du kan testa att köra dem direkt via kommandoraden för att se att de fungerar.

```bash
$ lessc --version
$ csslint --version
```

Vi kommer låta makefilen sköta kompilering och lintning.



En första stylesheet {#steg1}
-------------------------------

Då så, låt oss kompilera en första gång och se vad som händer.

```bash
$ make less
$ ls -l build/css/
total 8.0K
-rw-r--r-- 1 mos mos 551 May 11 18:13 style.css
-rw-r--r-- 1 mos mos  94 May 11 18:13 style.min.css
```

Öppna gärna de båda filerna för att se hur den kompilerade stylen ser ut.

Den resulterande stylesheeten hamnar i katalogen `build/css`. Den minifierade stylesheeten kopieras också till `htdocs/css/style.min.css` så du kan testa den lokalt. Dessutom kopieras en ytterligare kopia till Anax Flat via `../htdocs/css/style.min.css` så att du kan använda den nya stylen direkt i din Anax Flat.

Du kan behöva konfigurera din Anax Flat att använda denna stylesheeten. Det gör du i filen `config/theme.php` genom att ändra följande.

```php
//"stylesheets" => ["css/default.min.css"],
"stylesheets" => ["css/style.min.css"],
```

Du kan nu ladda om din Anax Flat i din webbläsare och använda din nya stil, om än någon knapphändig än så länge.

[FIGURE src=/image/kurs/design/anax-flat-no-theme.png?w=w2 caption="Anax Flat utan style."]

Då kan vi börja att bygga upp stilen från början. Du kan notera att även om det inte finns någon style så går det ändock att läsa innehållet i webbplatsen. Det är viktigt att man kan göra det, ur användbarhetssynpunkt. Ibland kanske stylesheeten inte hinner laddas och då skall användaren ändå kunna använda webbplatsen.

Då börjar vi lägga till LESS moduler.



Normalisera stylen {#normalisera}
-------------------------------

Det första vi gör är att nollställa stylen, eller egentligen vill vi normalisera stylen. Det vi vill uppnå är att vår grundstyle är lika i alla webbläsare, oavsett om vissa webbläsare lägger på sin egen personliga style. Detta kan [normalize.css](http://necolas.github.io/normalize.css/) hjälpa mig med.



###Ladda ned Normalize {#downnorm}

Jag hämtar normalize.css från GitHub och sparar filen i katalogen `modules`. Jag döper filen till `normalize.less` för att LESS kompilatorn skall betrakta filen som en LESS fil.

```bash
$ wget https://necolas.github.io/normalize.css/latest/normalize.css -O modules/normalize.less
```



###Gör Normalize till en modul {#normmod}

Jag uppdaterar `modules.less` så att den importerar modulen.

```css
// Reset, or normalize the browser style
@import url(normalize.less);
```

Jag behöver inte ange katalogen eftersom jag har angivit i makefilen att katalogen `modules` skall vara en del av *include pathen*. Det innebär att kompilatorn först letar i nuvarande katalog och därefter i katalogen `modules`. Det ger mig viss frihet att ersätta vissa moduler. Det kan vara bra för återanvändning i längden.

Nu kan jag kompilera stylen och testa den. Det bör inte bli någon förändring rent utseendemässigt. Så vill du vara säker på att normalize.less är inkluderad så kan du titta i den genererade källkoden `build/css/style.css` som nu bör vara lite större än tidigare.



###Nedladdning av Normalize som del i Makefile {#nednorm}

Vad händer när det kommer uppdateringar till `normalize.css`? Ja, förr eller senare behöver du uppdatera. Tänk nu att vi kommer ha flera moduler så blir det rätt jobbigt att hålla koll på uppdateringar. Men tänk om vi fyllar på i makefilen?

Vad sägs om ett make *target* som gör `make upgrade` genom att hämta hem senaste versionerna av alla moduler? Jag tycker det låter som en bra idè. Så här kan det se ut i makefilen.

```bash
# target: upgrade-normalize - Download latest version of Normalize.
.PHONY: upgrade-normalize
upgrade-normalize:
	@echo "$(ACTION)Upgrade LESS module - Normalize$(NO_COLOR)"

	# Normalizer
	wget --quiet https://necolas.github.io/normalize.css/latest/normalize.css -O $(LESS_MODULES)/normalize.less
```

Så här kan det se ut när du kör det.

```bash
$ make upgrade-normalize
--> Upgrade LESS module - Normalize
wget --quiet https://necolas.github.io/normalize.css/latest/normalize.css -O modules/normalize.less
```

Det var vår första LESS modul, på vår långa resa där vi försöker skapa en god bas av LESS moduler för att bygga egna stylesheets.



Regioner för att placera ut innehållet {#regioner}
-------------------------------

Hur HTML-koden genereras påverkar vilka möjligheter vi har att styla webbplatsen. När an har kontroll över både stylen och skapandet av HTML-koden så kan man anpassa dem för att få ren och snygg HTML-kod och enkel stylning av den.

Men nu har vi redan färdigskapad HTML. Hur löser vi det? Som tur är så har jag koll på strukturen av HTML-koden. Jag tänkte att vi skulle ta ett steg fram och se vilka olika regioner som HTML-koden består av.

Jag tänkte försöka skapa  en `regions.less` för att uppnå så att webbplatsen ser ut ungefär så här.

[FIGURE src=/image/kurs/design/anax-flat-regions.png?w=w2 caption="Anax Flat stylad in i regioner."]

Till min hjälp har jag delvis kunskapen om den template fil som används när HTML-koden genereras. Du kan själv studera den i katalogen `vendor/mos/anax/view/default/index.tpl.php`, eller via GitHub i repot mos/anax där [alla template-filerna  finns](https://github.com/mosbth/anax/blob/master/view/default/index.tpl.php), specifikt är det [`index.tpl.php`](https://github.com/mosbth/anax/blob/master/view/default/index.tpl.php) som skapar grunden för HTML sidan.

Du bör nu kika igenom videoserien där jag visar hur jag bygger LESS modulen för `regions.less`. Men du kan också låna den färdiga `regions.less` som du hittar i kursrepot under `example/anax-flat-theme/regions.less`. Kanske vill du hellre kika på videorna i lugn och ro lite senare.

VIDEO om att lyfta fram regionerna.

Huvudsaken är att du lär dig styla upp nuvarande HTML struktur så att den ser lite vettig ut.



En responsiv navbar {#navbar}
-------------------------------

Navbaren är som du förstår automatgenererad utifrån den information som finns i Anax Flat `config/navbar.php`. Dessutom har den en struktur som är förberedd för att stylas på ett repsonsivt sätt. Att göra det på egen hand från grunden kan ta sin lilla tid så jag tänkte att vi lånar en LESS modul som ger oss grundstylen till den responsiva navbaren.

Den modulen jag tänkte låna finns på GitHub under namnet [mosbth/responsive-menu](https://github.com/mosbth/responsive-menu).

Låt oss testa den.



###Bekanta dig med `responsive-menu` {#downresp}

Börja med att clona ned en kopia.

```bash
$ git clone https://github.com/mosbth/responsive-menu.git
$ cd responsive-menu
```

Det ligger en `index.html` i repot, öppna den i webbläsaren för att testa hur menyn fungerar.

Så här ser det ut när jag testar.

VIDEO



###Använd modulen `responsive-menu` {#useresp}

Då försöker vi integrera den responsiva menyn in i våra LESS moduler. Det handlar om två filer som vi behöver. Jag väljer att hämta hem filerna med `wget` för att senare kunna integrera proceduren i makefilens `make upgrade`.

Först hämtar jag hem LESS filen och sparar som en LESS modul.

```bash
$ wget --quiet https://raw.githubusercontent.com/mosbth/responsive-menu/master/responsive-menu.less -O modules/responsive-menu.less
```

Jag lägger in den så att den importeras i `modules.less`. Jag kan nu testa att kompilera stylen och ladda om webbsidan.

Dock, innan allt fungerar så behöver jag hämta hem JavaScript-filen också. Denna sparar jag i katalogen `js`.

```bash
$ wget --quiet https://raw.githubusercontent.com/mosbth/responsive-menu/master/responsive-menu.js -O js/responsive-menu.less
```

Jag kan nu kompilera om stylen igen. Makefilen har redan inbyggt i sig att den kopierar katalogen `js` till rätt plats i Anax Flat under `htdocs/js`.

Du behöver dubbelkolla att Anax Flat är inställt på att ladda filen. Det är en inställning i `config/theme.php` som skall se ut så här.

```php
//"javascripts" => [],
"javascripts" => ["js/responsive-menu.js"],
```

Nu kan du testa menyn genom att ladda om din webbläsare.



###Förbered för uppdateringar i makefilen {#respupgr}

Jag förbereder för uppgraderingar genom att uppdatera makefilen så att den sköter nedladdningar av responsiv menyn i fortsättningen.

```bash
# target: upgrade-responsive-menu - Download latest version of Responsive menu.
.PHONY: upgrade-responsive-menu
upgrade-responsive-menu:
	@echo "$(ACTION)Upgrade LESS module - Responsive menu$(NO_COLOR)"

	# Responsive-menu
	wget --quiet https://raw.githubusercontent.com/mosbth/responsive-menu/master/responsive-menu.less -O $(LESS_MODULES)/responsive-menu.less
	wget --quiet https://raw.githubusercontent.com/mosbth/responsive-menu/master/responsive-menu.js -O js/responsive-menu.js
```

Så här kan det se ut.

asciinema/youtube



Styla header och menyn {#header}
-------------------------------

Style header och meny (finns i style.less).

VIDEO som visar steg för steg.



Responsivitet {#resp}
-------------------------------

Styla responsivt.

VIDEO steg för steg.



Make upgrade {#resp}
-------------------------------

Förbered makefilen för att uppgradera alla externa LESS moduler.

```bash
# target: upgrade - Download latest version of all external LESS modules.
.PHONY: upgrade
upgrade: upgrade-normalize upgrade-responsive-menu
	@echo "$(ACTION)Upgrade external LESS modules$(NO_COLOR)"
```



Avslutningsvis {#avslutning}
------------------------------

Nu har du kommit igång med Anax Flat och du kan anpassa webbplatsen med ditt eget innehåll.

Förslagsvis går du nu vidare och ser hur du kan skapa din egen style för webbplatsen.
