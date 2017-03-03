---
author: mos
revision:
    "2016-12-16": (PA1, mos) Utveckling påbörjad.
...
Kmom01: Kom igång med programmering i PHP
==================================

[WARNING]
**Version 3 av oophp.**

Utveckling av nytt kursmoment pågår. Kursmomentet släpps senaste den 27/3 2017.

[/WARNING]

**Kom igång med PHP** som ett programmeringsspråk och skaffa dig en grund att stå på i form av utvecklingsmiljö, manualer och testmiljö. Du får en genomgång av **de viktigaste icke-objektorienterade konstruktionerna** i PHP. Du behöver den basen innan vi kan gå vidare med de objektorienterade konstruktionerna. Om du redan kan grunderna i PHP och webbprogrammering så blir detta ett ypperligt tillfälle för övning och repetition. Som lärare vill jag försäkra mig om att alla har en gemensam bas inför kursen, så gott det går. Detta kursmoment ger den basen.

Kursmomentet ger också en genomgång i hur du kan bygga en **strukturerad webbplats** med en tanke och en plan bakom katalogstrukturen. Detta är något som är bra att ha med sig. Även om vårt huvudfokus är objektorienterad PHP-programmering och databaser så är vi i en webbmiljö och allt som krävs för att den miljön skall fungera måste ha sin plats. Det handlar om HTML-kod, stylesheets med CSS och det andra som gör en färdig webbplats. En struktur att hålla sig i gör att vi kan fokusera mer på programmeringen, det är bra.

Under övningen så skapar du din **me-sida**, en webbplats där du skall presentera samtliga övningar som du gör under kursen. I slutet av varje kursmoment skriver du en redovisningstext som skall presenteras på din me-sida. Man kan säga att det du lämnar in för betygsättning, när kursen är slut, är din me-sida -- så se till att den blir bra.

[FIGURE src=/image/snapshot/oophp-kmom01-me.png?w=w2 caption="Så här kan din kommande me-sida se ut, eller inte..."]

Det är en hel del att läsa i kurslitteraturen i detta kursmoment. Se till att du gör det, annars är risken att du saknar viktig grundkunskap som du behöver för att kunna ta in kursens mer avancerade delar. Hoppa **inte** över läsandet.

*Detta är instruktionen för kursmomentet och omfattar det som skall göras inom ramen för kursmomentet. Momentet omfattar cirka 20 studietimmar inklusive läsning, arbete med övningar och uppgifter, felsökning, problemlösning, redovisning och eftertanke. Läs igenom hela kursmomentet innan du börjar jobba. Om möjligt -- planera och prioritera var du vill lägga tiden.*



Läsanvisningar  {#lasanvisningar}
---------------------------------

*(ca: 2-8 studietimmar, inklusive extra läsning i referenslitteraturen efter eget val)*



###Kurslitteratur  {#kurslitteratur}

Bekanta dig med kurslitteraturen och läs de inledande kapitlen i varje bok för att komma igång med läsandet.

Läs följande:

1\. [Beginning PHP and MySQL: From Novice to Professional](kunskap/boken-beginning-php-and-mysql-from-novice-to-professional)

* Chapter 1: Introducing PHP (läs översiktligt)
* Chapter 2: Configuring Your Environment (bläddra snabbt igenom)
* Chapter 3: PHP Basics (viktigt)
* Chapter 4: Functions (viktigt)
* Chapter 5: Arrays (läs översiktligt)

2\. [Webbutveckling med PHP och MySQL](kunskap/boken-webbutveckling-med-php-och-mysql) (referenslitteratur)

Om du har köpt boken så kan du läsa igenom alla kapitel utom kapitel 8 Databaser. Boken ger dig en bas om du är osäker på grunderna i PHP.

3\. [Databasteknik](kunskap/boken-databasteknik) (referenslitteratur)

Om du har köpt boken så kan du läsa igenom det första kapitlet för att bekanta dig med boken. En webbprogrammerare som kan sina databaser ser till att läsa denna boken från pärm till pärm. Det är dock inget vi kommer hinna inom ramen för denna kursen så läsanvisningar kommer att vara till ett par utvalda kapitel. Jag räknar med att du kommer att läsa en kurs i databasteknik och då kommer du läsa igenom hela denna boken, eller en liknande.



###Verktyg {#verktyg}

Läs översiktligt in dig på följande verktyg som används i kursen.

1. Vi använder pakethanteraren [composer](https://getcomposer.org/) för att installera PHP moduler.

1. De PHP-moduler vi använder är publicerade på [Packagist](https://packagist.org/), ett sökbart repository för PHP-moduler.

1. Kika översiktligt i [PHP The Right Way](http://www.phptherightway.com/) om vilka verktyg som rekommenderas i PHP communityn.



###Lästips {#lastips}

Det finns inga extra lästips.



Övningar & Uppgifter  {#ovningar_uppgifter}
-------------------------------------------

*(ca: 8-14 studietimmar)*



###Labbmiljö {#labbmiljo}

Installera labbmiljön för kursen.

1. [Installera labbmiljön](kurser/oophp-v3/labbmiljo) som behövs för kursen.

1. Klona kursrepot för kursen.



###Övningar {#ovningar}

Gör följande övningar, de behövs normalt för att klara uppgifterna. 

1. Jobba igenom guiden [20 steg för att komma igång med PHP (php20)](kunskap/kom-i-gang-med-php-pa-20-steg).

2. Jobba igenom artikeln [Anax - en hållbar struktur för dina webbapplikationer](kunskap/anax-en-hallbar-struktur-for-dina-webbapplikationer).

3. Jobba igenom tutorialen ["Create a dynamic menu / navigation bar with PHP"](http://dbwebb.se/kod-exempel/dynamic_php_menu/)

4. [Lär dig använda `source.php` och CSource](kunskap/visa-kallkod-med-source-php-och-csource).


Se till att du har koll på vad som händer i övningarna. De utgör basen för hela kursen.

<!--
(Olika språk, anpassa med int/loc) 
-->



###Uppgifter {#uppgifter}

Följande uppgifter skall utföras och resultatet skall redovisas via me-sidan.

1. **Gör din egen webbmall likt Anax**. Gör precis som i övningen eller gör efter eget huvud. Du kan hoppa över delen med JavaScript. I resten av kursen kommer du att använda och bygga ut din webbmall så se till att göra en bra grund. Övningarna i kursen kommer att bygga på den struktur som används i Anax så håll dig helst till den. Är du erfaren kan du ta lite extra svängar men annars gör du likt Anax. Kravet är dock att du namnger din webbmall med ett eget namn, *byt ut Anax på alla platser det förekommer*.

2. **Gör en me-sida** som baseras på din webbmall. Gör en förstasida som presenterar dig själv och gör en redovisningssida där du samlar alla dina redovisningstexter i kursen. Skapa en dynamisk huvudmeny (likt övningen) och lägg in länkar till sidorna samt en länk till att visa källkoden med `source.php`. Du kan [tjuvkika hur jag gjort](oophp/me/kmom01/me.php).

3. **Lägg till funktionen `dump()` i ditt Anax** (`src/bootstrap.php` är en bra plats). Funktionen är utmärkt för felsökning. Du hittar funktionen i [guiden php20](kunskap/kom-i-gang-med-php-pa-20-steg).

4. **Ladda upp och publicera** ditt resultat på studentservern. 



###Extra {#extra}

1. Lägg upp din webbmall på GitHub. Det finns en guide om du behöver [hjälp att komma igång med Git och GitHub](kunskap/kom-igang-med-git-och-github). Git och Github är bra att kunna. Jag använder det en hel del i kursen men det är ingen del av examinationen. Du kan använda det om du vill.



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](oophp/redovisa).

Se till att följande frågor besvaras i texten:

* Vilken utvecklingsmiljö använder du?
* Berätta hur det gick att jobba igenom guiden "20 steg för att komma igång PHP", var något nytt eller kan du det?
* Vad döpte du din webbmall Anax till?
* Vad anser du om strukturen i Anax, gjorde du några egna förbättringar eller något du hoppade över?
* Gick det bra att inkludera `source.php`? Gjorde du det som en modul i ditt Anax?
* Gjorde du extrauppgiften med GitHub?
