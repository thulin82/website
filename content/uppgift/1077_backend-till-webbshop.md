---
author:
    - lew
category:
    - php
    - kurs oophp
    - anax-lite
revision:
    "2017-04-20": "(PA, lew) Första utgåvan."
...
Skapa grunden och backend till en webbshop
==================================

Nu är det dags att sätta kunskaperna på prov. Du ska skapa grunden till en webbshop, backend-delen. Du ska med andra ord **inte** lägga ner tid på utseendet i detta skedet. Men bara lugn, det kommer i projektet.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

artiklarna...



Introduktion {#intro}
-----------------------

[FIGURE src=/image/oophp/v3/webbshop.png?w=w1&q=70 caption="Ett exempel på en webbshop."]

För att få en förståelse för vad som förväntas kan du kika på [devdungeon's webbshop](https://shop.devdungeon.com/). Tar man bort skalet, utseendet, liknar det kursmomentets mål. Du kommer jobba vidare med webbshoppen i projektet så en bra grund nu ger dig en smidigare väg i mål. Vad som ska säljas i din affär bestämmer du själv. Det kan vara kläder, djur, elektronik m.m. Tänk på upphovsrätten om du lånar material från nätet.



Krav {#krav}
-----------------------

Utöver kraven har du fria valmöjligheter att lägga nivån på den höjd du känner passar dig bäst. Ha en länk i din navbar till webbshoppen och spara filerna under `me/anax-lite`.  

1. Databasen ska vid behov använda triggers, lagrade procedurer, funktioner och transaktioner. Se över din kod i efterhand och försök se om det finns möjligheter till förbättring i form av ovan nämnda funktionalitet.  

2. Produkterna ska finnas i databasen. De ska minst finnas följande information om dem:  
  * Pris  
  * Bild  
  * Lagerstatus  
  * Kategori

3. Admin ska ha ett skyddat gränssnitt där han/hon kan ändra priser, namn och kategorier samt hantera lagret. Admins ska ha användarnamn: admin och lösenord: admin.  

4. Varukorgen ska nås från produktsidan. Man ska kunna lägga till produkter i sin varukorg. I varukorgen ska man se vad man har valt samt en slutsumma och en möjlighet att gå vidare till betalning. Det räcker med att man får ett meddelande, ex "Du har nu betalt och ordern är på väg till dig.".  

5. Gör din webbshop efter bästa förmåga. Får du tid över kan du passa på att snygga till den.


Glöm inte att validera ofta och göra en `dbwebb publish anax-lite` när du är klar.


Extrauppgift {#extra}
-----------------------

1. Gör ett betalningsformulär där användaren fyller i sina uppgifter. Formuläret ska valideras på ett rimligt sätt. Man ska tex inte kunna utelämna något fält eller ange felaktiga uppgifter. I rimlig mån.


Tips från coachen {#tips}
-----------------------


Lycka till och hojta till i forumet om du behöver hjälp!
