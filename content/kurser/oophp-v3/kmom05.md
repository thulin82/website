---
author: mos
revision:
    "2016-12-16": (PA1, mos) Utveckling påbörjad.
...
Kmom05: Lagra innehåll i databasen
==================================

[WARNING]
**Version 3 av oophp.**

Utveckling av nytt kursmoment pågår. Kursmomentet släpps senaste den 24/4 2017.

[/WARNING]

Att lagra innehåll i databasen för att sedan kunna visa upp det i webbplatsen är en kärnfunktionalitet i de flesta webbplatser. Nu har vi både en mall för webbplatser och koll på databaser och objektorienterad programmering. låt oss då försöka använda allt detta för att lagra undan innehåll i databasen och sedan visa upp det som webbsidor och bloggposter i webbplatsen.

Utmaningen är att hitta en bra lagringsstruktur i databastabellen, en bra och flexibel struktur som låter oss använda innehållet på ett smidigt sätt i webbplatsen. Tänker man till när man skapar lagringsstrukturen så kan man spara ett antal kodrader när man sedan skall redigera, och visa upp innehållet i webbplatsen.

[FIGURE src=/image/snapshot/Uppdatera_innehall___Innehall_i_databasen.jpg?w=w2 caption="Formulär för att editera innehåll i databasen."]

Kursmomentet avslutas med att du kodar ett par moduler till ditt Anax.

<small><i>(Detta är instruktionen för kursmomentet och omfattar det som skall göras inom ramen för kursmomentet. Momentet omfattar cirka **20 studietimmar** inklusive läsning, arbete med övningar och uppgifter, felsökning, problemlösning, redovisning och eftertanke. Läs igenom hela kursmomentet innan du börjar jobba. Om möjligt -- planera och prioritera var du vill lägga tiden.)</i></small>



Läsanvisningar  {#lasanvisningar}
---------------------------------

*(ca: 0-2 studietimmar, inklusive extra läsning i referenslitteraturen efter eget val)*



###Kurslitteratur  {#kurslitteratur}

Det finns inga läsanvisningar till detta kursmomentet.



###Lektionsmaterial  {#lektionsmaterial}

Följande föreläsningsmaterial användes i samband med campus-kursen höstterminen 2013. Det kan vara av intresse att skumma igen -- även för distanstudenten.

* [Översikt av kursmomentet](https://dl.dropboxusercontent.com/u/24315211/oophp/oophp-kmom05-ht13.pdf).



###Lästips {#lastips}

Få en insikt i komplexiteten att skydda sig från Cross-Site Scripting (XSS) och relaterade sårbarheter. Läs en [PHP RFC som föreslår en SPL-klass Escaper](https://wiki.php.net/rfc/escaper). Det ger en bra genomgång i ämnet.



Övningar & Uppgifter  {#ovningar_uppgifter}
-------------------------------------------

*(ca: 12-18 studietimmar)*


###Övningar {#ovningar}

Gör följande övning, den förbereder dig inför uppgifterna och löser ett par av dem.

1. Jobba igenom guiden ["Lagra innehåll i databas för webbsidor och bloggposter"](kunskap/lagra-innehall-i-databas-for-webbsidor-och-bloggposter).



###Uppgifter {#uppgifter}

Följande uppgifter skall utföras och resultatet skall redovisas via me-sidan.

1. <del>Gör uppgiften ["Samla alla dina textfilter till en klass CTextFilter"](uppgift/samla-alla-dina-textfilter-till-en-klass-ctextfilter).</del>

1. Gör uppgiften ["Övningar med CTextFilter"](uppgift/ovningar-med-ctextfilter).

1. Gör uppgiften ["Skapa en klass för innehåll i databasen, CContent"](uppgift/skapa-en-klass-for-innehall-i-databasen-ccontent). 

1. Gör uppgiften ["Skapa en klass CPage för att visa upp webbsidor från CContent"](uppgift/skapa-en-klass-cpage-for-att-visa-upp-webbsidor-fran-ccontent).

1. Gör uppgiften ["Gör en blogg med CBlog baserad på CContent"](uppgift/gor-en-blogg-med-cblog-baserad-pa-ccontent).



###Extra {#extra}

1. Läs igenom hur du kan skapa en ["En navbar med drop-down meny i ren HTML och CSS"](coachen/en-navbar-med-drop-down-meny-i-ren-html-och-css).

2. Läs tipset ["Skapa en dynamisk navbar / meny, med undermeny, via PHP"](coachen/skapa-en-dynamisk-navbar-meny-med-undermeny-via-php) och uppgradera din PHP funktion som genererar navbaren till att hantera drop-down menyer.



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](oophp/redovisa).

Se till att följande frågor besvaras i texten:

* Det blir en del moduler till ditt Anax nu, hur känns det?
* Berätta hur du tänkte när du löste uppgifterna, hur tänkte du när du strukturerade klasserna och sidkontrollerna?
* Börjar du få en känsla för hur du kan strukturera din kod i klasser och moduler, eller kanske inte?
* Snart har du grunderna klara i ditt Anax, grunderna som kan skapa många webbplatser, är det något du saknar så här långt, kanske några moduler som du känner som viktiga i ditt Anax?
