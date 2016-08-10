---
author: mos
category: webbprogrammering
revision:
  "2015-09-17": (C, mos) Stängde article element.
  "2015-09-15": (B, mos) La till semikolon som saknades i exempelkod.
  "2015-05-20": (A, mos) Första utgåvan inför htmlphp version 2.
updated: "2015-09-17 10:20:42"
created: "2015-05-06 13:05:00"
...
Skapa en webbsida med HTML, CSS och PHP, steg 2
==================================

[FIGURE src=/image/snapvt15/me2-res.png?w=c5&a=0,0,30,0 class="right" caption="En me-sida i version 2."]

Att bygga en webbplats innebär att man behöver någorlunda kunskaper i HTML, CSS och PHP. Det blir flera tekniker att ha koll på och det kan vara lite svårt i början. Vi tar därför små steg framåt för att uppgradera vår me-sida till version 2. 

Vi blandar lite HTML, lite CSS och lite PHP. Via små enkla trix så får vi vår me-sida att se lite bättre ut. I slutet så prövar vi till och med att göra sidan responsiv för mobila enheter, bara för skojs skull.

<!--more-->



Förutsättningar {#pre}
---------------------------------

Du har en me-sida liknande den från artikeln [Skapa en webbsida med HTML, CSS och PHP](kunskap/skapa-en-webbsida-med-html-css-och-php).



Resultatet {#resultat}
---------------------------------

Jag är redan klar. Så här blev det för mig.

[FIGURE src=/image/snapvt15/me2-res.png?w=w2 caption="Mikaels me-sida version 2."]

Så, frågan är vad jag gjort och hur. Låt oss kika på det och gå igenom det, steg för steg.



HTML-element för `<main>` och `<article>` {#artikel}
--------------------------------------

Det handlar om att strukturera sidans innehåll i *rätt* HTML-element. Vad som är rätt och inte är inte alltid tydligt, men det finns grundstrukturer som är tydliga. HTML-elementen har en *semantisk* mening, de berättar vilken typ av innehåll de har. Det underlättar när man läser sidans källkod, man ser tydligare vilken betydelse de olika elementen har. 

Så här gjorde jag. Jag tillförde ett element som heter `<main>` som wrappar sidans huvudsakliga innehåll. Jag samlade webbsidans huvudsakliga innehåll inom ett element `<article>`. 

Artikeln fick en egen `<header>` och en `<footer>` där bylinen ligger. Strukturen ser ut så här.

```html
<main>
    <article>
        <header>
            <h1>Artiklens rubrik</h1>
            <p class="author">Uppdaterad <time datetime="2015-05-06 11:17:43">6:e maj 2015</time> av Mikael Roos</p>    
        </header>
        
        <p>Artikelns innehåll, bilder och så vidare.</p>
        
        <footer class="byline">
            <p>Innehåll för min byline, eventuellt en bild.</p>
        </footer>
    </article>
</main>
```

Jag brukar lägga till CSS-klasser där jag tycker det behövs, det gör det enklare att styla elementen. Det är inget man behöver göra från början, man kan fylla på med CSS-klasser efter hand, när man känner att det behövs. Som du kan se av koden ovan har jag valt klasserna `author` och `byline`, mest för jag tycker det är enklare att styla de HTML-block som avses.

Som du ser så handlar HTML mycket om att märka upp orden, det är viktigt att man använder en god struktur för uppmärkningen. Iallafall om man vill bli proffs på detta. Men, det finns inget exakt facit för hur man ska göra. Men genom att läsa specifikationerna och se hur andra gör, så lär man sig vad som fungerar och inte. Dessutom, om det ser bra ut i webbläsaren, då kan det ju inte vara fel, eller hur?



Cheatsheet och specifikationer {#cheat}
--------------------------------------



###Specifikationer {#specar}

Det finns specifikationer för HTML och CSS. Det finns flera. Det finns olika versioner av teknikerna, de senaste omtalas som HTML5 och CSS3, varje version har sin egen specifikation. Det är inte alltid lätt att ha full koll på vilket HTML-element som hör till vilken specifikation, samma för CSS-konstruktionerna. Det är heller inte nödvändigt att veta det, iallafall inte i början. 

De vanligaste specifikationerna är följande.

* [HTML5](http://www.w3.org/TR/html5/) 
* [HTML4](http://www.w3.org/TR/html4/) 
* [CSS3](http://www.w3.org/Style/CSS/current-work) 
* [CSS2.2](http://dev.w3.org/csswg/css2/) 
* [CSS2.1](http://www.w3.org/TR/CSS21/) 

Så här i början är det inte jätteviktigt vilken spec som innehåller vad, men allt eftersom så kommer du troligen vilja ha bättre och bättre koll på det. 



###Cheatsheet {#cheatsheet}

Ett enkelt sätt att komma igång med specifikationer över HTML-element och CSS-konstruktioner, är att använda verktyget [Cheatsheet](http://www.w3.org/2009/cheatsheet/). Där kan du söka efter element och konstruktioner och snabbt få fram information.

Öppna upp Cheatsheet och sök till exempel på HTML-elementet `pre`, eller `main`. Sök därefter på CSS-konstruktionen `color` och `background-color` så ser du lite hur det fungerar.

Du får här en snabbare väg att hitta, slå upp, ett element. Lär dig använda det.



Float och clear {#float}
--------------------------------------

Om du tittar på min webbsida så ser du att bilden på mig flyter till höger av texten. Det är en CSS-konstruktion som löser det genom att berätta att HTML-elementet skall flyttas ur sitt normala flöde och *flyta* till höger, eller vänster.

Så här kan man göra, först i CSS.

```css
.right {
    float: right;
}
```

Och sen i HTML.

```html
<figure class="right">
```

Du kan kanske se hur du skulle göra för att skapa förutsättningar för att flyta en bild till vänster?

Om man börjar att flyta element så kan man ibland behöva stänga av flytandet. Det gör man med CSS-konstruktionen `clear`.

```css
clear: left;
clear: right;
clear: both;
```

Att flyta element är ett enkelt sätt att delvis påverka layouten på de element som ritas ut, *renderas*, i webbläsaren.

I ditt kursrepo har du ett exempelprogram som visar [hur float ser ut](/repo/htmlphp/example/float/float.html) och du kan se den [defekten som kan lösas med en `clear`](/repo/htmlphp/example/float/float-clear.html).

Se när jag testar exemplet.

[YOUTUBE src=tOjFaCwtSJU width=630 caption="Mikal kör igenom exempelprogrammet för float och clear."]

[YOUTUBE src=_j1XRxKtgEs width=630 caption="Mikal förtydligare när clear behövs."]



Clear fix med `overflow:auto` {#clearfix}
--------------------------------------

Den "defekt" som du såg i *clear float*, det finns en liknande som kan se ungefär likadan ut, men löses på ett annat sätt. Det är något som kallas för en [clearfix](http://stackoverflow.com/questions/8554043/what-is-clearfix).

Behovet av en sådan clearfix är för att flytande element inte påverkar den omslutande kontainerns höjd. Den omslutande kontainern/elementet, som innehåller det flytande elementet, har alltså ingen koll på hur högt det det är. 

För att visa vad jag menar så finns det ett exempelprogram i ditt kursrepo, `example/clearfix`, du kan [testköra det här utan fixen](/repo/htmlphp/example/clearfix/clear-no.html) och [här med fixen](/repo/htmlphp/example/clearfix/clear.html).

Min fix är att använda CSS-konstruktionen `overflow: auto` för att tvinga en omritning av elementet så att det lär känna sin rätta höjd.

Se när jag testar exemplet.

[YOUTUBE src=BhPxWRkvc74 width=630 caption="Mikael visar hur clearfix med overflow auto fungerar."]

Alltså, clear float och cleafix, två vanliga lösningar på problem som uppträder med layouten när float används.



Alltid visa scrollbar {#alltid}
--------------------------------------

När man har sidor som är olika långa, kan man ibland få en effekt av att webbsidan hoppar till på grund av att den högra scrollbaren omväxlande visas och döljs. Det blir så när en sida är längre än webbläsarens totala höjd och nästa sida är kortare än sidans höjd.

Det är alltid en irriterande sak som är enkle att åtgärde genom att säga till webbläsaren, via CSS, att alltid visa scrollbaren, oavsett sidans höjd.

```css
html {
    overflow-y: scroll;
}
```

Det kan se ut så här.

[YOUTUBE src=SFhSsvuP4Gg width=630 caption="Mikael visar effekten av att alltid visa scrollbaren."]



Minsta höjd på en sida {#hojd}
--------------------------------------

När man har sidor av olika höjd, beroende på att vissa sidor har mer eller mindre innehåll, så är det en god idé att alltid sätta en minsta höjd på en sida. Det ser helt enkelt bättre ut om alla sidor, oavsett innehåll, har en någorlunda höjd.

Det är enkelt gjort med CSS och ett sätt att göra det är att sätta `min-height` på det element som innehåller sidans själva huvudinnehåll. Jag har numer valt att lägga allt innehåll i det element som heter `<main>` och därmed så väljer jag en minsta höjd på mitt `<main>` element.

```css
main {
    min-height: 30em;
}
```

Måttet `em` motsvarar storleken av ett tecken och i utgångsläget är det 16 pixlar stort, men man kan också se på `20em` som 20 rader av text.

Det kan se ut så här.

[YOUTUBE src=rFSVZlGNqbU width=630 caption="Mikael visar hur man sätter minsta höjd på en sida."]



CSS box model {#boxmodel}
--------------------------------------

CSS har en layoutmodell, *boxmodel*, som hittills varit rådande. I och med CSS3 kommer vi att se en annan modell, *flexible boxes*, eller bara [*flexbox*](https://developer.mozilla.org/en-US/docs/Web/Guide/CSS/Flexible_boxes). Men, vi kör väljer att använde den traditionella boxmodellen.

Så här kan boxmodel visualiseras.

[FIGURE src=/image/htmlphp/kmom04/image10.png caption="CSS box modell."]

Det handlar alltså om vilka delar en tänkt låda, en box, består av och hur bred den blir när alla dess delar läggs till.

För att ta ett exempel.

Först HTML-kod för en enkel `div`.

```html
<div>This is the content.</div>
```

Sen applicerar vi CSS-kod för att visa hur margin, border, och padding påverkar innehållet i divven.

```css
div {
    width: 400px;
    height: 200px;
    margin: 10px;
    border: 10px solid green;
    padding: 20px; 
    outline: 10px dotted blue;
}
```

En `outline` är en ram som inte påverkar layouten hos omgivande dokument, den tar inte upp någon plats, men syns likväl.

Du kan själv [testköra exemplet](/repo/htmlphp/example/css-layout/boxmodel.html) som finns i ditt kursrepo. 

Så här ser det ut när jag testkör exemplet.

[YOUTUBE src=EIdh6jXpWtI width=630 caption="Mikael visar hur CSS boxmodell fungerar med dess olika konstruktioner."]

Boxmodellen gäller främst block-element såsom `div`, `header`, `main`, `footer`, `h1`, `p`. Det är element som normalt renderas som en fyrkantig "låda". När det gäller textelement, som `span`, `em`, `strong` så renderas de *inline*, de är främst inline-element. De har samma attribut som boxmodellen visar, men beteer sig aningen annorlunda i hur padding och margin påverkar layouten. Så boxmodellen är enklast att se i block-element och inte i element som är tänkta i flödande text.

Vi kan fördjupa oss i detta vid ett senare tillfälle, just nu räcker det att du är medveten om konceptet boxmodellen och att det är en modell som används när elementen renderas i förhållande till varandra.



Färger {#farg}
--------------------------------------

Som du märker så använder jag olika sätt att ange färger. Mestadels är det hexadecimalt värde om tre siffror, men det kan också anges som 6 siffror och det finns vissa färger som har ett namn. Detta är beskrivet i specifikationen och en av de numer aktuella specifikationerna för detta är modulen för [CSS3 och färger](http://www.w3.org/TR/css3-color/).

[FIGURE src=/image/snapvt15/me2-colornames.png caption="Grundläggande färger enligt modulen för CSS3 och färger."]

Du kan också ange färger enligt andra färgmodeller såsom HSL och RGB. Vill du ha hjälp att välja färger så kan du använda en färgväljare som hjälper dig komponera färger och visar dess färgkoder.

Här är ett [exempel på en färgväljare](/repo/htmlphp/example/colors/colorpicker.html). 

[FIGURE src=/image/snapvt15/colorpicker.png?w=w2 caption="En färgväljare hjälper dig att välja och jämföra färger."]

Färgerna kan även ha inslag av alpha-kanalen, så att de uppfattas som delvis genomskinliga.



CSS3 för fler möjligheter till formgivning {#css3}
--------------------------------------

Utvecklingen med CSS3 har givit oss fler möjligheter att styla våra webbsidor. För att ta ett par enkla exempel så rör det sig om [runda hörn](/repo/htmlphp/example/css3/border-radius.html), [skuggade element](/repo/htmlphp/example/css3/box-shadow.html), [gradient](/repo/htmlphp/example/css3/linear-gradient.html) och [genomskinliga färger](/repo/htmlphp/example/css3/opacity.html).

Webbläsarna har allt bättre stöd för CSS3, men vill man vara riktigt säker så bör man alltid kolla upp konstruktionen. Webbplatsen Can I Use hjälper dig att kolla om en viss konstruktion stöds i en viss webbläsare. Sök på [gradient på Can i Use](http://caniuse.com/#search=gradients) för att se hur bra stödet är i de olika webbläsarna.



Styla länkar {#link}
--------------------------------------

Länkar är kärnan i HTML och de kan vi styla på olika sätt. En länk har olika lägen, som den normalt visas, *link*, när man håller muspekaren över länken, *hover*, när man klickar på länken, *active* och för länkar som man redan besökt, *visited*.

En plats där det kan vara bra att styla länkarna är navbaren. Där vill man inte att länken ändrar färg beroende av att man besökt den sidan eller inte. En navbar är inte tänkt att fungera så.

Ett sätt att styla länkarna i navbaren kan alltså vara att alltid visa samma färg, så här.

```css
a {
    color: #000;
}
```

Nu blir färgen samma på alla länkar, oavsett vilket läge länken har. I navbaren är det bra, men troligen inte i resten av dokumentet där vi är vara att länkar beteer sig på ett visst sätt. 

Om du vill styla de olika varianterna individuellt så anger du CSS-koden så här.

```css
/* for all values */
a {
    text-decoration: none;
}

/* unvisited link */
a:link {
    color: #f00;
}

/* visited link */
a:visited {
    color: #0f0;
}

/* mouse over link */
a:hover {
    color: #f0f;
    text-decoration: underline;
}

/* selected link */
a:active {
    color: #00f;
}
```

Det är viktigt att du stylar länkarna i denna ordningen, *active* måste komma efter *hover* som måste komma efter *link* och *visited*.



Styla navbar för nuvarande sida {#current}
--------------------------------------

Det är vanligt att navbaren visar, markerar, valet för nuvarande sida. När man klickat på valet för sidan "Redovsining" så skall det menyvalet vara aktivt, eller valt, och detta visas med en annorlunda style av menyvalet.

Här finns olika tekniker att jobba med, men låt oss använda PHP för att hålla koll på vilken nuvarande sida är. Om det är nuvarande sida så sätter vi en CSS-klass på HTML-elementet och kan därmed styra dess utseende.

Vi har följande navbar att utgå ifrån.

```html
<nav class="navbar">
    <a href="me.php">Hem</a>
    <a href="report.php">Redovisning</a>
    <a href="about.php">Om</a>
</nav>
```

Tanken är att skapa en struktur som lägger till en klass i menyvalet, om man besöker just denna sidan. Vi vill att det skall se ut så här i HTML-koden, när man till exempel besöker sidan "Redovisning".

```html
<nav class="navbar">
    <a href="me.php">Hem</a>
    <a class="selected" href="report.php">Redovisning</a>
    <a href="about.php">Om</a>
</nav>
```

Lägger vi nu till CSS-kod så kan vi styla klassen för att ge just detta menyval ett speciellt utseende.

```css
.navbar .selected {
    background-color: #ccc;
}
```

Vi har precis börjat lära oss PHP, men att styla nuvarande sidas menyval vill vi ändå göra. Principen är att använda PHP för att hitta länken till nuvarande sida, ta ut den delen som visar vilken sida det är, det vill säga filens namn. Namnet på filen vill vi jämföra mot tänkt menyval och om det matchar så skriver vi ut klassen för *selected*.

För att göra en lång historia kortare, så finns det ett [exempelprogram som visar på delarna i lösningen](/repo/htmlphp/example/navbar/me.php). Med stöd av det exempelprogrammet så kan du uppdatera din egen meny för att visa nuvarande sida.

Resultatet blir att följande kod används, för varje menyval.

```php
<a class="<?= basename($_SERVER['REQUEST_URI']) == "me.php" ? "selected" : ""; ?>" href="me.php">Hem</a>
```

Ser PHP-koden, i exemplet, lite krånglig ut? Ja, men vi reder ut det efterhand. Låt det bara vara som det är för tillfället. Det blir bättre efter hand. Jag ville bara visa hur man kan markera nuvarande sida och då blev det direkt aningen komplext, eller iallafall komprimerat.



Välj namn på sidans titel {#titel}
--------------------------------------

Varje webbsida har en titel i form av HTML-elementet `<title>`. Det är viktigt att varje sida har sin egen titel eftersom det är en viktig komponent i hur sökmotorer indexerar en webbplats.

Men, i vårt fall ligger `<title>` i filen `incl/header.php` och är samma för alla sidor. Det vill vi nu ändra så att varje sida kan ha sin egen titel. Vi löser det med en PHP-variabel.

Först uppdaterar jag sidan `incl/header.php` att skriva ut en PHP-variabel, istället för sidans titel.

Så här ser det ut nu.

```php
<title>Me-sidan</title>
```

Det ändras till följande.

```php
<title><?= $title ?></title>
```

Det är alltså PHP-variabeln `$title` som skrivs ut. Om du är ovan vid konstruktionen `<?= ... ?>` så är det bara en kortare konstruktion för att skriva `<?php echo ... ?>`. 

Tanken är alltså att variabeln `$title` skall innehålla värdet på sidans titel. Det ordnar vi i respektive sida.

Så här ser det ut nu, i `me.php`.

```php
<?php include("incl/header.php"); ?>
```

Det ändras till följande.
```php
<?php
$title = "Min me-sida | htmlphp";
include("incl/header.php");
?>
```

Om du gör rätt så kommer du att se sidans titel överst i webbläsaren.

[FIGURE src=/image/snapvt15/me2-title.png?w=w2 caption="Sidans titel visas nu i webbläsaren."]

Glöm nu inte att göra ändringen i alla sidor. Annars finns risken att du får ett felmeddelande som säger att variabeln `$title` inte är definierad. Det kan då se ut så här.

[FIGURE src=/image/snapvt15/me2-title-error.png?w=w2 caption="Variabeln för sidans title är inte definierad, istället visas ett felmeddelande."]

För att se hela felmeddelandet så kan du högerklicka i webbläsarens fönster och visa källkoden för sidan. 

[FIGURE src=/image/snapvt15/me2-title-error-source.png?w=w2 caption="Högerklicka och visa källkod för att se hela felmeddelandet."]

Detta är ett bra exempel på hur man ibland måste gå tillväga för att felsöka PHP-koden i sina webbsidor. PHP skriver ut ett felmeddelande, men eftersom det skrivs ut inom ramen för HTML-elementet `<title>` så visas det inte på ett speciellt bra sätt. Men det finns där, och nu vet du hur du hittar det.



Mät sidans laddningstid, minnesbehov och antal filer som inkluderas {#mat}
--------------------------------------

Ibland kan det vara kul att se hur lång tid det tar för servern att skapa sidan och hur mycket resurser som krävs. Låt oss använda PHP-funktioner för att mäta tiden det tar att skapa sidan, hur mycket minne som används och hur många filer som inkluderas från disk.

För att lösa detta behöver vi ett par funktioner och en variabel från PHP.

| Funktion / variabel   | Vad gör den    | 
|-----------------------|----------------|
| [`microtime(true)`](http://php.net/manual/en/function.microtime.php) | Hämta nuvarande tid som ett tal med precisionen microsekunder. |
| [`$_SERVER['REQUEST_TIME_FLOAT']`](http://php.net/manual/en/reserved.variables.server.php) | Tidsstämpel med microsekunder då webbservern startade PHP-processen. |
| [`get_included_files()`](http://php.net/manual/en/function.get-included-files.php) | Hämta en array med namnen på alla filer som har inkluderats. |
| [`count()`](http://php.net/manual/en/function.count.php) | Räkna antalet fält i en array. |
|  [`memory_get_peak_usage()`](http://php.net/manual/en/function.memory-get-peak-usage.php) | Hämta totalt minne, i bytes, som allokerats av PHP processen. | 
| [`round()`](http://php.net/manual/en/function.round.php) | Avrunda ett flyttal till ett heltal, eller ett tal med ett visst antal decimaler. |

Tanken är att skriva ut informationen i slutet av webbsidan, i footern. Så här kan det se ut om man lägger PHP-kod för att hämta värdena från funktionerna och lagra dem i variabler.

```php
<?php
$numFiles   = count(get_included_files());
$memoryUsed = memory_get_peak_usage(true);
$loadTime   = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
?>
```

Sedan kan man skriva ut dem, så här.

```php
<p>Time to load page: <?=$loadTime?>. Files included: <?=$numFiles?>. Memory used: <?=$memoryUsed?>.</p>
```

Kan du använda funktionen `round()` för att avrunda värdena och ge dem lite mer användarvänliga siffror?

Så här kan det se ut.

[FIGURE src=/image/snapvt15/me2-footer-details.png caption="En footer med siffror på hur snabbt sidan laddas och vilka resurser som används."]



Responsiv webbplats {#responsiv}
--------------------------------------

Det pratas mycket om responsiva webbplatser, responsiv webbdesign och *mobile first*. Den typen av tänkande blir allt mer viktigt då webbplatserna används av både desktop-datorer, läsplattor och mindre mobila enheter.

Ni ska vi inte fördjupa oss i detta, men låt oss ändå använda en enkel princip för att uppnå att webbplatsen kan fungera bra även på mindre enheter.

Först berättar vi för enheten som besöker vår webbplats att den skall använda sin egen bredd för att visa sidan, den skall inte låtsas att den är större än den verkligen är.

```html
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=2.0;">
</head>
```

I annat fall kan en mobil låtsas att ha en mycket större skärm än den egentligen har, för att simulera att den är en desktop-skärm.

[FIGURE src=/image/snapvt15/me2-iphone-portrait.png?w=c6 class="right" caption="Min me-sida i en iPhone porträtt-läge."]

Nästa steg är att lägga till en media-fråga, en *media-query*, för att ändra sidans utseende på små skärmar.

```css
/**
 * responsive
 */
@media (max-width: 980px) {
    body {
        width: auto;
        background-color: yellow;
    }
}
```

Media-frågan säger att om bredden på webbläsaren är mindre än 980 pixlar så skall CSS-konstruktionen som följer gälla. Du kan testa om det fungerar, på din egen webbplats, genom att ändra storleken på webbläsaren. När bredden blir mindre än 980 pixlar så kommer den att få samma bredd som webbläsaren, det är det som `auto` innebär.

Att färgen blir gul är bara för att göra det enklare att se att stylen verkligen ändras.

Så här ser det ut när jag visar min egen webbplats i en iPhone i landskapsläge (och porträttläge).

[FIGURE src=/image/snapvt15/me2-iphone-landscape.png?h=c6 caption="Min me-sida i en iPhone landskaps-läge."]

När jag testade webbplatsen på en läsplatta iPad mini så visades webbplatsen utan gul bakgrund i landskapsläge och med gul bakgrund i portättläge.

Att göra bra responsiv design är ett eget kapitel för en kurs, eller kursmoment, så vi nöjer oss med att se hur grundtekniken fungerar.

I kursrepot finns ett [exempelprogram som visar hur den resonsiva layouten fungerar](/repo/htmlphp/example/responsive/responsive.html). Pröva det exempelprogrammet och gör webbläsaren mindre eller större för att ändra utseendet (bakgrundsfärgen blir gul).



Felmeddelanden och felsökning {#felsok}
--------------------------------------

Det blir alltid fel, hur man än gör. Mycket av webutveckling, och programmering rent generellt, handlar om att felsöka och rätta felen.

Så här långt har du ett antal tekniker för att felsöka. 

1. Validera enligt HTML och CSS
1. Högerklicka och visa källkod, ser sidan ut som jag tänkte? Har PHP genererat den HTML-kod som jag ville?
1. Firebug, visa HTML-koden och dess tillhörande CSS-konstruktioner. Det som visas i Firebug är inte exakt samma som finns i källkoden. Webbläsaren har tolkat källkoden och lagt till element som den anser saknas.
1. PHP felmeddelande, lös alltid det översta först, resten kan vara följdfel.
1. Googla felet, eller konstruktionen. I din googlingsfråga, lägg alltid tekniken först "html main", "css color" eller "php strlen", så får du bättre träffar.

Ett faktum som du aldrig skall ifrågasätta är.

> *Felmeddelandet har alltid rätt.*

Glöm aldrig det.

När du får felmeddelanden, lös dem alltid uppifrån och ned, ta det första först, ladda om sidan. Kanske har följdfelen försvunnit, annars tar du bara nästa fel i listan.

Det finns alltid en felaktig rad. Hitta den. Det kallas att avgränsa problemområdet och man slipper gissa. Att avgränsa och fokusera på att hitta den raden som är felets upphov, är en viktig förmåga för alla programmerare, webb eller annat. Felmeddelandet ger dig viktiga ledtrådar när du försöker avgränsa problemområdet.



Avslutningsvis {#avslutning}
--------------------------------------

Nu är du redo att själv uppgradera din me-sida till en version 2, med samma features som jag använt.

Exempelkoden finns i [kursrepot för htmlphp-kursen](https://github.com/mosbth/htmlphp/tree/master/example) och kan provköras på [dbwebb.se/repo/htmlphp/example/me](/repo/htmlphp/example).

Om du stöter på problem så kan du alltid [fråga i forumet](forum).
