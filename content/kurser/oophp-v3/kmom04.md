---
author:
    - mos
category:
    - kurs oophp
    - kurs oophp-v3
revision:
    "2017-04-11": (PA1, mos) Utveckling påbörjad.
...
Kmom04: Lagra innehåll i databasen
==================================

[WARNING]
**Version 3 av oophp.**

Utveckling av nytt kursmoment pågår. Kursmomentet släpps senaste den 17/4 2017.

[/WARNING]

Att lagra innehåll i databasen för att sedan kunna visa upp det i webbplatsen är en kärnfunktionalitet i många webbplatser. Så här långt har vi en fungerande webbplats om använder sig av databas och objektorienterad programmering. Vi fortsätter att anväde de teknikerna för att bygga grunden i en databasdriven webbplats där innehåll lagras i databasen och kan redigeras av användaren. Vi skall visa upp vanliga sidor och en blogg.

Utmaningen är att hitta en bra lagringsstruktur i databastabellen, en bra och flexibel struktur som låter oss använda innehållet på ett smidigt sätt i webbplatsen. Tänker man till när man skapar lagringsstrukturen så kan man spara ett antal kodrader när man sedan skall redigera, och visa upp innehållet i webbplatsen.

Utmaningen ligger även i hur man väljer att konstruera sina klasser, kanske går det att skapa en generell struktur dom klarar både det ena och det andra.

[FIGURE src=/image/snapshot/Uppdatera_innehall___Innehall_i_databasen.jpg?w=w2 caption="Formulär för att editera innehåll i databasen."]


<small><i>(Detta är instruktionen för kursmomentet och omfattar det som skall göras inom ramen för kursmomentet. Momentet omfattar cirka **20 studietimmar** inklusive läsning, arbete med övningar och uppgifter, felsökning, problemlösning, redovisning och eftertanke. Läs igenom hela kursmomentet innan du börjar jobba. Om möjligt -- planera och prioritera var du vill lägga tiden.)</i></small>



Läsanvisningar  {#lasanvisningar}
---------------------------------

*(ca: 2-4 studietimmar, inklusive extra läsning i referenslitteraturen efter eget val)*



###Kurslitteratur  {#kurslitteratur}

Läs följande:




###Lästips {#lastips}

<!--
1. [Om databasmodellering](https://dbwebb.se/kunskap/kokbok-for-databasmodellering)
-->



Övningar & Uppgifter  {#ovningar_uppgifter}
-------------------------------------------

*(ca: 12-16 studietimmar)*


###Övningar {#ovningar}

Gör följande övning, den förbereder dig inför uppgifterna och löser ett par av dem.

1. Jobba igenom guiden ["Lagra innehåll i databas för webbsidor och bloggposter"](kunskap/lagra-innehall-i-databas-for-webbsidor-och-bloggposter).

<!-- 
(Content som markdown med anax/textfilter)
-->



###Uppgifter {#uppgifter}

Följande uppgifter skall utföras och resultatet skall redovisas via me-sidan.

1. Gör uppgift "[Bygg webbsidor från innehåll i databasen](uppgift/bygg-webbsidor-fran-innehall-i-databasen)" och spara filerna in `me/anax-lite`.

<!--
1. Gör uppgiften ["Övningar med CTextFilter"](uppgift/ovningar-med-ctextfilter).

1. Anax Flat File.
-->



###Extra {#extra}

Gör följande extrauppgifter om du har tid, lust eller ambition.

1. Känner du behov av att träna ytterligare på grunderna i SQL, vilket alltid är en god idé, så gör du laborationen "[SQL lab, introduktion till SQL](uppgift/sql-lab-introduktion-till-sql-dbjs)". Labben är gjord med SQLite. Filerna ligger i `me/kmom04/sql1`.



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](kurser/oophp-v3/redovisa).

Se till att följande frågor besvaras i texten:

* Berätta hur du tänkte när du strukturerade klasserna och databasen?
* Gjorde du SQL-labben och vad tyckte du om den?
