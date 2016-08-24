---
author: mos
category: webbprogrammering
revision:
    "2016-08-24": (D, mos) Bort blå ruta om LF.
    "2015-10-05": (C, mos) Not om externa beroenden för paket.
    "2015-08-24": (B, mos) Not om Windows och Unix-stil på radslut.
    "2015-03-31": (A, mos) Första utgåvan.
updated: "2015-08-24 08:36:21"
created: "2015-03-31 09:10:29"
...
Installera texteditorn Atom
==================================

[FIGURE src=/image/atom/atom-icon.png?w=c3 class="right"]

Texteditorn Atom är en editor som du kan använda som utvecklingsverktyg när du programmerar och redigerar textfiler. Här är en kort guide till hur du installerar Atom och hur du konfigurerar de vanligaste inställningarna.

<!--more-->

Atom finns till flera operativsystem, går under en fri licens och utvecklas som [öppen källkod på GitHub](https://github.com/atom).



Installera {#installera}
--------------------------------------

[Gå till Atom.io](https://atom.io), ladda hem och installera den varianten som passar för din miljö.

[Kika snabbt på manualen](https://atom.io/docs) för att orientera dig.

Starta Atom.

[FIGURE src=/image/atom/atom-welcome.png?w=w2 caption="Atom hälsar dig välkommen."]



Testa din editor {#testa}
--------------------------------------

För att testa hur din editor fungerar, så kan du göra följande exempel.

Ta koden nedan och kopiera in till din editor.

```text
<!doctype html>
<meta charset="UTF-8"/>
<title>Hello World</title>

<h1>Hello World</h1>
<p>Just trying out Atom.</p>

</html>
```

Så här kan det se ut.

[FIGURE src=/image/atom/atom-filetype.png?w=w2 caption="Editerar filen hello.html på Windows."]

Titta nere i högra hörnet av Atom, så ser du att editorn håller koll på vilken typ av fil som du editerar och färgkodar din kod enligt det språk du använder.

Spara filen som `hello.html` i din hemmakatalog.

Öppna din filebrowser och leta reda på vad du sparade filen, dubbelklicka på filen och öppna den i en webbläsare. Det kan se ut så här.

[FIGURE src=/image/atom/atom-ie.png?w=w2 caption="öppnar filen och visar i en webbläsare på Windows."]

Nu har du koll på grunderna.



Grundinställningar {#grund}
--------------------------------------

Atom har inställningar som kan ändras, öppna dem via `ctrl ,` eller `cmd ,` (Mac). Du kan också öppna fönstret för inställningar via menyvalet `File -> Settings`.

[FIGURE src=/image/atom/atom-settings.png?w=w2 caption="Fönstret för inställningar för Atom."]



###Använd UTF-8 NOBOM {#utf8}

Standardinställningen är att filerna sparas i UTF-8 utan byte order mark (NOBOM). Låt det vara på det viset.

[FIGURE src=/image/atom/atom-settings-fileencoding.png caption="Encoding skall vara UTF-8 NOBOM"]



###Använd soft tabs, tab-längd 4 {#softtabs}

Standardinställningen är att *soft tabs* används. Låt det vara på det viset.

[FIGURE src=/image/atom/atom-soft-tabs.png caption="Använd soft tabs."]

Soft tabs betyder att en tab ersätts med ett motsvarande antal mellanslag. Det gör att det blir enklare att flytta filer mellan olika editorer och användare som kan ha olika inställningar.

Ställ in *tab length* till 4 mellanslag.
  
[FIGURE src=/image/atom/atom-tab-length.png caption="Använd 4 mellanslag för att ersätta en tab."]

Olika kodstandarder kan ha olika rekommendationer om storleken på en tab. De vanliga inställningarna är 2 eller 4 mellanslag. I kurserna använder vi 4.



###Radslut enligt Unix-style {#lineending}

Vi vill använda radslut enligt Unix-style `\n`, också kallad LF. Det blir enklast så, för en webbprogrammerare.

Andra typer av radslut som du kan komma i kontakt med är Windows-style LF + CR `\n\r` och äldre Mac style CR `\r`.

<!--
[INFO]
**Windows och Unix-stil på radslut**

Om du sitter på Windows så behöver du installera en plugin för att få Unix-stil på dina radslut. Läs följande inlägg i forumet om hur du gör det, "[Unix line-endings i Atom för Windows](t/4438)".
[/INFO]
-->



Installera addons som paket {#paket}
--------------------------------------

Atom har en hel del addons, eller paket som det kallas. Det är små program som gör bygger ut editorn och gör den till ett mer kraftfullt verktyg. 

Du kan söka efter paketen under *packages*.

[FIGURE src=/image/atom/atom-packages.png?w=w2 caption="Sök och installera paket för att utöka editorns funktioner."]

Atom har också ett kommandorads-interface till pakethanteringen. Det är trevligt om du är en lite mer avancerad användare som jobbar på många datorer där du vill ha ett enkelt sätt att installera dina paket.

[FIGURE src=/image/atom/atom-apm.png?w=w2 caption="Använd kommandoraden för att hantera dina paket för Atom."]

Så här installerar jag mina paket från kommandoraden. 

*Notera att varje paket kan vara beroende av att ditt system har relaterade programvaror installerade. Du bör därför installera varje paket för sig så att du har koll på eventuella externa beroenden.*

```bash
$ apm install linter linter-less linter-pylint linter-jscs linter-phpcs block-travel linter-jshint linter-phpmd linter-csslint linter-pep8 linter-shellcheck linter-htmlhint linter-php linter-xmllint
```



Konfigurationsfiler {#config}
--------------------------------------

Atom sparar sina konfigurationsfiler i din hemmakatalog under katalogen `.atom`, kika där om du vill lära dig mer om konfiguration av Atom.

[FIGURE src=/image/atom/atom-config.png?w=w2 caption="Alla konfigurationsfiler sparas i din hemmakatalog, under `.atom`."]

Så här har jag uppdaterat min `.atom/keymap.cson` för att den skall passa hur jag vill navigera bland flikar och i texteditorn.

```text
'atom-text-editor':
    'alt-right': 'editor:move-to-end-of-line'
    'shift-alt-right': 'editor:select-to-end-of-line'
    'alt-left': 'editor:move-to-beginning-of-line'
    'shift-alt-left': 'editor:select-to-beginning-of-line'

'body':
  'ctrl-tab': 'pane:show-next-item'
  'ctrl-shift-tab': 'pane:show-previous-item'
```



Alternativ till Atom {#alternativ}
--------------------------------------

Här är ett par alternativ till texteditorn Atom.

* [TextWrangler](http://www.barebones.com/products/textwrangler/download.html) (Mac OS)
* [Notepad++](http://notepad-plus-plus.org/download/) (Windows)
* [jEdit](kunskap/installera-en-texteditor-jedit) (flera plattformar)

Självklart kan du använda din egen favoriteditor, men det är inte säkert att vi har en liknande och kan hjälpa dig om du får problem. Bortsett från det så är det fritt fram att pröva vilka editorer du vill. Se bara till att du har samma [grundinställningar som vi har i Atom](#grund).



Avslutningsvis {#avslutning}
--------------------------------------

En editor är ett oerhört viktigt arbetsverktyg för en webbprogrammerare. Oavsett vilken du väljer så finns det alltid olika sätt att anpassa editorn till ditt behov. Om du investerar tid i att lära dig din editor så kan du spara en hel del tid i ditt utvecklingsarbete.

Har du tips, [förslag eller frågor om Atom](t/4054) så finns det en specifik forumtråd för det.
 
