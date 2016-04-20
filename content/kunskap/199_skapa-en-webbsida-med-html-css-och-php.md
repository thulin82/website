---
author: mos
category: webbprogrammering
revision:
  "2016-02-03": (B, mos) Blå ruta om status för Unicorn.
  "2015-04-29": (A, mos) Första utgåvan inför htmlphp version 2.
updated: "2016-02-03 11:17:37"
created: "2015-04-20 13:15:25"
...
Skapa en webbsida med HTML, CSS och PHP
==================================

[FIGURE src=/image/snapvt15/me-navbar.png?w=c5 class="right" caption="En enkel webbplats, en me-sida."]

Vill man bli webbprogrammerare så behöver man starta med grunderna. Låt oss därför, steg för steg, skapa en liten webbplats med HTML, CSS och PHP.

Webbplats får innehålla ett par sidor med header och footer, lite bilder, länkar och en meny för att navigera mellan sidorna. Det blir en bra start. Dessutom lär vi oss att validera sidorna så att de stämmer med de standarder vi använder.

<!--more-->



Förutsättningar {#pre}
---------------------------------

Du har installerat en labbmiljö likt den som beskrivs i dokumentet om [labbmiljö för kursen htmlphp](htmlphp/labbmiljo).

Webbplatsen, katalogen och dess filer, som du skapar i artikeln, behöver ligga så att du kan köra dem via din egen webbserver.

Det förutsätts att du har kommandot `dbwebb` samt kursrepot `htmlphp` på plats enligt guiden [dbwebb clone](dbwebb-cli/clone). 



Webbplatsens innehåll {#innehall}
---------------------------------

Jag tänkte att vi skapar en liten webbplats med tre sidor eller så. Vi tar enklaste möjliga struktur men försöker ändå täcka in både HTML, CSS och PHP.

De tre sidorna får innehålla en presentation av mig (dig), en sida för redovisningar (bra att ha i kursen) och så en om-sida som berättar om själva webbplatsen.



Katalogstruktur {#struktur}
---------------------------------

Vi börjar med en ny katalog, en katalogstruktur, några tomma filer och några bilder som jag hämtar från webben.

Jag skapar strukturen via terminalen och terminalkommandon. Förslagsvis gör du på samma sätt, terminalen är ett bra och i längden oumbärligt verktyg för en webbprogrammerare.

```bash
# Gå till rätt kursrep och kursmoment
cd dbwebb-kurser/htmlphp/me/kmom01

# Skapa kataloger och filer
mkdir me/img me/css me/incl
touch me/me.php me/about.php me/report.php me/css/style.css
touch me/incl/header.php me/incl/footer.php me/incl/byline.php
wget -O me/img/me-small.jpg http://dbwebb.se/img/mikael-roos/me-happy.jpg
wget -O me/img/me.jpg http://dbwebb.se/img/mikael-roos/me-2.jpg
wget -O me/img/favicon.ico http://dbwebb.se/favicon.ico
```

Sådär. Du får gärna ta några andra bilder, så klart.

Så här ser strukturen ut på katalogen.

```bash
me
├── about.php
├── css
│   └── style.css
├── img
│   ├── favicon.ico
│   ├── me.jpg
│   └── me-small.jpg
├── incl           
│   ├── byline.php 
│   ├── footer.php 
│   └── header.php 
├── me.php
└── report.php

3 directories, 10 files
```

Vi har alltså en bra grundstruktur med bilder, stylesheet och php-sidor att fylla med innehåll.

Öppna katalogen `me` med din texteditor. Jag använder Atom som jag kan starta direkt från terminalen.

```bash
atom me
```

Så här ser det ut för mig.

[FIGURE src=/image/snapvt15/me-atom.png?w=w2 caption="Strukturen för min *me* webbplats uppladdat i texteditorn Atom."]

Vi lämnar detaljerna för tillfället, vad varje del kommer att göra blir tydligt senare i artikeln.



En första ansats till en webbsida {#ansats1}
--------------------------------------

För att få en smakstart så tar vi filen `me.php` och lägger in en standardstruktur för en webbsida.

```html
<!doctype html>
<html lang="sv">
<head>
  <meta charset="utf-8">
  <title>Me-sidan</title>
</head>
<body>
  <h1>Om Mig Själv</h1>
  <p>Här kommer snart min egen fina me-sida.</p>
  <img src="img/me.jpg" class="me" alt="Bild på Mikael Roos">
</body>        
</html>
```

Så här ser det ut när jag öppnar sidan i min webbläsare via min lokala webbserver.

[FIGURE src=/image/snapvt15/me-large.png?w=w2 caption="Första ansatsen med en stor bild."]

Min bild är lite väl stor men det får vi fixa senare.



Validera enligt HTML5 {#validera}
--------------------------------------

För att kontrollera att det verkligen är HTML5 så kör vi den genom [W3C’s HTML validator](http://validator.w3.org/). Välj fliken "Validate by direct input" 
 och kopiera in koden för din webbsida.
 
Så här ska det se ut, grönt är bra och säger att webbsidan klarar valideringen.

[FIGURE src=/image/snapvt15/me-validate-html5.png?w=w2 caption="Min me-sida validerar, en bra start."]

Om du fick fel så försöker du rätta till felen. Läs även vad varningarna betyder. Det är bra att ha lite koll.



Länka till valideringsverktyget {#linkval}
--------------------------------------

För att förenkla framtida kontroller så lägger vi till en länk till validatorn, direkt i me-sidan. Det gör att vi hela tiden kan validera dokumentet med ett litet klick.

Skapa en footer till me-sidan och lägg där in länken till validatorn. Följande kod löser det i slutet på sidan.

```html
    <footer id="site-footer">
        <hr>
        <a href="http://validator.w3.org/check/referer">HTML5</a>
    </footer>

</body>
```

Så här blev det för mig.

[FIGURE src=/image/snapvt15/me-validate-link.png?w=w2 caption="Enkel åtkomst till validatorn via en länk."]

Klickar man nu på länken så kommer man till validatorn som direkt validerar den sidan som du klickade på.

För att det skall fungera måste din sida ligga på en webbserver som är publikt tillgänglig. Annars kommer validatorn inte åt din sida. Testa genom att ladda upp din me-sida till driftsmiljön.

Gör så här för att ladda upp det du nyss gjort till studentservern.

```text
dbwebb publish kmom01
```



Styla sidan med CSS {#css}
--------------------------------------

Med CSS kan vi ge sidan färg och form. Vi kan styla HTML-elementen och bestämma var de skall visas på sidan och hur de skall se ut. CSS-koden lägger vi i en separat fil och länkar till den från HTML-koden.

Börja med att öppna filen `css/style.css` och lägg in följande kod för att ge din sidan en bakgrund och en lagom storlek på bilden.

```css
html {
    background-color: #9c9;
}

.me {
    width: 400px;
}
```

Därefter går du till filen `me.php` och lägger in följande rad så att stylesheeten refereras från webbsidan.

```html
    <link rel="stylesheet" href="css/style.css">
</head>
```
När det är klart så kan du ladda om sidan. Så här blev det för mig.

[FIGURE src=/image/snapvt15/me-style.png?w=w2 caption="En lätt grön bakgrund och en mer anpassad storlek på bilden."]

Om du nu vill att sidan skall vara centrerad och ha en viss storlek, säg 980px bred, så kan du åstakomma det med kod i stylesheeten. Gör så här.

```css
body {
    margin: 8px auto;
    padding: 8px;
    width: 980px;
    background-color: #eee;
    border-radius: 10px;
}
```

Så här blev det för mig.

[FIGURE src=/image/snapvt15/me-style-center.png?w=w2 caption="Sidan centreras med en fast bredd."]

Nu börjar det likna något.



Validera CSS-kod {#validatecss}
--------------------------------------

W3C har en [validator för CSS](https://jigsaw.w3.org/css-validator/). Pröva att kopiera in din kod från stylesheeten och validera den via "Direct input"-metoden.

Det bör se ut ungefär så här.

[FIGURE src=/image/snapvt15/me-validate-css-direct.png?w=w2 caption="CSS-koden går igenom valideringen."]

Ladda upp din sida på driftsserver och validera den genom att ge validatorn länken till din me-sida. Du tar alltså länken till din egen sida och kopiera in den i validatorn. 

Så här kan det se ut.

[FIGURE src=/image/snapvt15/me-validate-css-link.png?w=w2 caption="Validera sidan via en direktlänk."]

Valideras din stylesheet? 



Validera CSS-kod {#validatecss}
--------------------------------------

För att underlätta validering av sidorna så lägger vi till en direktlänk till CSS-validatorn. På samma sätt som vi gjorde med HTML-validatorn. Lägg till följande länk i din footer.

```html
<a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>
```

Ladda upp sidorna på driftsservern för att testa att länken till CSS-validatorn fungerar. Klicka på den och se om din sida validerar.



Unicorn, ett valideringsverktyg för flera tekniker {#unicorn}
--------------------------------------

Det finns ett valideringsverktyg Unicorn som kör både HTML och CSS testerna i en körning. Dessutom kan det köra ytterligare kompletterande tester. Länka även till detta verktyget från din me-sida. 

Länken till Unicorn som passar i din footer ser ut så här.

```html
<a href="http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance">Unicorn</a>
```

Kom nu ihåg att alltid dubbelkolla att din sida validerar. Hamnar du i trubbel så kollar du alltid först om sidan validerar.

[INFO]
**Tips.**

Varför används `&amp;` istället för tecknet `&` när vi länkar till Unicorn? Testa att ändra din kod och enbart skriva `&`. Validera den sedan i Unicorn. Du får ett felmeddelande som säger:

> **`&` did not start a character reference. (`&` probably should have been escaped as `&amp;`.)**

`&` är ett tecken som har en speciell betydelse i HTML, därför ersätts den ofta med `&amp;` i HTML-koden. Annars validerar inte koden. Läs mer genom att googla på ["html entities"](https://www.google.com/?q=html+entities) eller kika på en översikt av [olika tecken som kan skrivas som HTML entities](http://dev.w3.org/html5/html-author/charref).
[/INFO]

[INFO]
**Not om status på Unicorn.**

Det sägs att validatorn Unicorn är på väg bort och ersätts av de andra validatorerna. Men jag låter Unicorn vara kvar här eftersom den finns med i mina kodexempel i footern.

Det finns en [översikt av relevanta W3C validator](http://w3c.github.io/developers/tools/), som du förr eller senare kan komma i kontakt med.
[/INFO]



Skapa en header med logo och slogan {#header}
--------------------------------------

En webbplats innehåller ofta en header med en logo, titel på webbplatsen och kanske även en slogan. Låt oss lägga till det.

Först hämtar jag hem en bild som jag tänker använda som logo, jag sparar bilden i `img`-katalogen.

```text
$ wget -O img/logo.jpg http://dbwebb.se/image/tema/trad/4.jpg?w=200
```

Så här kan det se ut i HTML-koden.

```html
<body>
    <header class="site-header">
        <img src="img/logo.jpg" alt="logo" />
        <span class="site-title">Me-Sida för Mikael</span>
        <span class="site-slogan">Min första fina me-sida är på gång</span>
    </header>
```

Pröva att lägga till HTML-koden innan du lägger till någon style. Titta hur det ser ut i webbläsaren utan style. Lägg sedan till style och gör reload.

Följande style fungerar att utgå ifrån.

```css
.site-header {
    background-color: #fff;
    overflow: auto; /* clear fix to make div span all elements */
}

.site-header img {
    float: left;
}

.site-title {
    display: block;
    padding-top: 1em;
    padding-left: 50px;
    font-size: 32px;
    overflow: auto;
}

.site-slogan {
    display: block;
    padding-left: 50px;
    font-style: italic;
    overflow: auto;
}
```

Det finns ingen direkt regel för hur man komponerar en header som denna, det finns flera tekniker. Huvudsaken är ju att det ser ut som man vill. 

Så här blir min sida när jag lagt till en header.

[FIGURE src=/image/snapvt15/me-header.png?w=w2 caption="Me-sida, nu med header i form av logo, titel och slogan."]

Glöm inte bort att validera din kod, nu räcker det ju att du laddar upp på driftsservern samt klickar på länkarna till validatorn.



En favicon till webbplatsen {#favicon}
--------------------------------------

En webbplats kan ha en *favicon*, en liten bild som visas tillsammans med webbplatsen uppe i webbläsarens flik.

Det är något vi kan lägga till i sidas `<head>`-del med följande konstruktion.

```html
    <link rel='shortcut icon' href='img/favicon.ico'/>
</head>
```

Sedan laddar du om och kan se ikonen, *faviconen*, i webbläsarens flik.

[FIGURE src=/image/snapvt15/me-favicon.png?w=w2 caption="Me-sida nu med en favicon."]

[Formatet för bilden är ICO](https://sv.wikipedia.org/wiki/ICO_(filformat)), men de flesta webbläsare klarar numer även vanliga PNG-bilder.



Skapa en meny - en navbar {#navbar}
--------------------------------------

Tanken är att webbplatsen skall bestå av tre sidor. Ta nu en kopia av webbsidan `me.php` och spara den i `report.php` och `about.php`. Redigera texten i respektive sida så man vet vilken sida det är. Så här ser det ut för mig.

[FIGURE src=/image/snapvt15/me-report.png?w=c7  class="right" caption="Redovisnings-delen av me-sidan."]

[FIGURE src=/image/snapvt15/me-about.png?w=c7 caption="En om-sida på me-sidan."]

Vi har *inte* en bra lösning nu, eftersom vi har kopierat kod och har liknande kod i tre olika filer. Det skall vi snart fixa, men först en meny, men navbar, så att vi kan navigera mellan de olika sidorna.

Låt oss nu skapa grunden till menyn, navbaren.

```html
    <nav class="navbar">
        <a href="me.php">Hem</a>
        <a href="report.php">Redovisning</a>
        <a href="about.php">Om</a>
    </nav>
```

Vi lägger på en enkel stil, så att det liknar en navbar.

```css
.navbar {
    padding: 1em;
    background-color: #fff;
    border-top: 1px solid #9c9;
}

.navbar a {
    display: inline-block;
    padding: 0.5em 1em;
    border: 1px solid #999;
    text-decoration: none;
}

.navbar a:hover {
    background-color: #eee;
    text-decoration: underline;
}
```

Så här ser det ut för mig.

[FIGURE src=/image/snapvt15/me-navbar.png?w=w2 caption="Me-sida, nu med en navbar för navigering mellan de olika sidorna."]

Så ja, kopiera nu koden till de andra sidorna och pröva att navigera på din webbplats. Du bör kunna klicka runt och se de olika sidorna.

Nästa steg blir att hitta en bättre organisation av koden.



Organisera kod i header.php och footer.php {#organisera}
--------------------------------------

Om du lutar dig tillbaka och tittar på din kod så ser du att du har samma kod i tre filer. Det är inte optimalt. Låt oss samla koden för header-delen i filen `incl/header.php` och footer-delen i filen `incl/footer.php`. 

Det handlar om att strukturera sin kod och återanvända den. En sak skall definieras på en plats. Då blir det mindre kod att titta på, det blirn enklare att vidareutveckla och underhålla koden.

I vårt fall handlar det om att lägga följande kod i `incl/header.php`.

```html
<!doctype html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <title>Me-sidan</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="site-header">
        <img src="img/logo.jpg" alt="logo" />
        <span class="site-title">Me-Sida för Mikael</span>
        <span class="site-slogan">Min första fina me-sida är på gång</span>
    </header>

    <nav class="navbar">
        <a href="me.php">Hem</a>
        <a href="report.php">Redovisning</a>
        <a href="about.php">Om</a>
    </nav>
```

Det är ju samma kod för alla sidor, bättre att samla den koden i en fil. 

På samma sätt hamnar följande kod i `incl/footer.php`.

```html
    <footer id="site-footer">
        <hr>
        <a href="http://validator.w3.org/check/referer">HTML5</a>
        <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>
        <a href="http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance">Unicorn</a>
    </footer>

</body>
</html>
```

Det som till slut knyter samman delarna i webbsidan blir PHP-kod som inkluderar filerna `incl/header.php` och `incl/footer.php`.

```html
<?php include("incl/header.php"); ?>

    <h1>Om Mig Själv</h1>
    <p>Här kommer snart min egen fina me-sida.</p>
    <img src="img/me.jpg" class="me" alt="Bild på Mikael Roos">

<?php include("incl/footer.php"); ?>
```

Resultatet som visas i webbläsaren blir samma sak som tidigare. PHP-koden körs på serversidan och levererar till webbläsaren exakt samma HTML-sida som tidigare.

`<?php` är start-tagg för PHP-kod, `?>` är slut-tagg. Allt mellan taggarna betraktas och hanteras som PHP-kod. Det är webbservern som parsar PHP-koden innan den lämnar ifrån sig den resulterande HTML-sidan.

[INFO]
**Tips**

Bekanta dig med PHP-manualen. Det kan bli en av dina bästa vänner. Allt du behöver veta om PHP finns att läsa i manualen. Det gäller bara att bli kompis med manualen.

[Läs lite kort om språket PHP](http://php.net/manual/en/intro-whatis.php) och slå upp [funktionen include()](http://php.net/manual/en/function.include.php) och läs lite om den. Det kan se lite kryptiskt ut vid första anblicken, men lär dig läsa manualen så är mycket vunnet.
[/INFO]

Gör nu samma sak på de andra sidorna. Nu börjar det likna något.



Gör din egen byline {#byline}
--------------------------------------

Om du nu har lite koll på vad vi gått igenom så kan du säkert skapa en innehållet i `incl/byline.php` så att du på varje sida får en byline, en signatur från författaren till sidan.

Så här ser min byline ut, som jag ofta använder.

[FIGURE src=/image/snapvt15/me-byline.png caption="En byline för att presentera dig själv under varje artikel du skriver."]

Kan du lägga in din motsvarighet i din me-sida?



Styla din me-sida {#styla}
--------------------------------------

Pröva gärna att testa olika sätt att styla din sida, lek runt med CSS-koden och testa hur du kan förändra sidans utseende. Med små enkla medel kan du få din egen sida att se helt annorlunda ut.



Avslutningsvis {#avslutning}
--------------------------------------

Nu har du kommit igång och du har grunden till en me-sida. En bra start!

Exempelkoden finns i [kursrepot för htmlphp-kursen](https://github.com/mosbth/htmlphp/tree/master/example/me) och kan provköras på [dbwebb.se/htmlphp/repo/example/me](htmlphp/repo/example/me).

Om du stöter på problem så kan du alltid [fråga direkt i kursens forum](forum/utbildning/htmlphp).




