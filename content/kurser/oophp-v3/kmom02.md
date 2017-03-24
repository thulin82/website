---
author: mos
revision:
    "2016-12-16": (PA1, mos) Utveckling påbörjad.
...
Kmom02: OO-programmering i PHP
==================================

[WARNING]
**Version 3 av oophp.**

Utveckling av nytt kursmoment pågår. Kursmomentet släpps senaste den 3/4 2017.

[/WARNING]

Objektorienterad programmering är en av de mer kända programmeringssätten, det är helt enkelt ett sätt att tänka, modellera och strukturera dina program. I detta kursmoment får du jobba med programmering med klasser och objekt. Du får se hur man skapar klasser, skyddar synlighet på medlemsvariabler och metoder och hur arv går till. Du ser även hur kan kan programmera med objekt in i ett ramverk.

Kursmomentet avslutas med ett par friare programmeringsövningar så att du kan visa vad du kan så här långt.

[FIGURE src=/image/oophp/v3/test-session.png?w=w1&q=70 caption="Sessionstest är en av övningarna som finns med i detta kursmoment."]

[FIGURE src=/image/oophp/v3/dice100.png?w=w1&q=70 caption="Tärningsspelet 100 är en av övningarna som finns med i detta kursmoment."]

[FIGURE src=/image/oophp/v3/calendar1.png?w=w1&q=70 caption="En månadskalender är en av övningarna som finns med i detta kursmoment."]

<small><i>(Detta är instruktionen för kursmomentet och omfattar det som skall göras inom ramen för kursmomentet. Momentet omfattar cirka **20 studietimmar** inklusive läsning, arbete med övningar och uppgifter, felsökning, problemlösning, redovisning och eftertanke. Läs igenom hela kursmomentet innan du börjar jobba. Om möjligt -- planera och prioritera var du vill lägga tiden.)</i></small>



Läsanvisningar  {#lasanvisningar}
---------------------------------

*(ca: 2-6 studietimmar, inklusive extra läsning i referenslitteraturen efter eget val)*



###Kurslitteratur  {#kurslitteratur}

Det finns inga specifika läsanvisningar i kurslitteraturen.

<!--
Läs följande:

1\. [Beginning PHP and MySQL: From Novice to Professional](kunskap/boken-beginning-php-and-mysql-from-novice-to-professional)

* Chapter 6: Object-Oriented PHP
* Chapter 7: Advanced OOP Features
* Chapter 8: Error and Exception Handling
* Chapter 12: Date and Time (Läs så mycket så att du klarar uppgiften längre ned)
-->



###Lästips {#lastips}

Det finns inga lästips.

<!--
När man pratar om objektorienterad programmering så behöver man också ha en viss bas i objektorienterad modellering, det underlättar. Därför kan du läsa lite om UML, "Unified Modelling Language". En bra start plats är [Wikipedia om UML](http://en.wikipedia.org/wiki/Unified_Modeling_Language).
-->


Övningar & Uppgifter  {#ovningar_uppgifter}
-------------------------------------------

*(ca: 8-14 studietimmar)*


###Övningar {#ovningar}

Gör följande övningar, de behövs normalt för att klara uppgifterna.

<!--
1. Jobba igenom den avslutande delen av guiden ["Kom igång med objektorienterad PHP-programmering på 20 steg"](kunskap/kom-i-gang-med-oophp-pa-20-steg).

Del 2 av artikeln, kanske avvakta lite med den?
-->

<!-- 1. Artikel om session och inloggning med databas "[Logga in med sessioner och cookies](kunskap/sessioner-cookies-login)". -->

1. Artikeln "[Sessioner och cookies i PHP](kunskap/session-cookie-klasser)" ger dig en sessions-klass och grunden till en cookie-klass. Fyll gärna på cookie-klassens metoder med kod.

1. Jobba igenom artikeln "[Att integrera en klass i ramverket Anax Lite](kunskap/att-integrera-en-klass-i-ramverket-anax-lite)" som visar hur du kan integrera en klass eller tjänst in i ramverket Anax Lite.

1. View helpers samt view regions. (make less)?



###Uppgifter {#uppgifter}

Gör följande uppgifter.

<!--
Uppgift som tvingar view med regioner?
-->

1. Gör uppgiften [Integrera klassen Session](uppgift/testa-sessionen) in i ramverket och skriv en route som testar och visar innehållet i sessionen. Spara din kod i `me/anax-lite`.

1. Gör uppgiften "[En navbar till Anax Lite (steg 2)](uppgift/en-navbar-till-anax-lite-steg-2)" som låter dig integrera kod in i ramverkets struktur. Spara din kod i `me/anax-lite`.

1. Gör uppgiften [tärningsspelet 100](uppgift/tarningsspel) som modul till ditt Anax och visa upp spelet i din me-sida. Spara din kod under `me/anax-lite`.

1. Gör uppgiften [Månadskalender](uppgift/manadskalender) och inkludera resultatet i ditt Anax. Spara din kod under `me/anax-lite`.

1. Fortsätt att jobba igenom uppgiften "[Kom igång med SQL](uppgift/kom-igang-med-sql)" genom att utföra ytterligare en tredjedel av uppgiften. Fortsätt att spara all SQL-kod i `me/kmom01/skolan/skolan.sql`. Den sista tredjedelen gör du i nästa kursmoment.

1. Pusha och tagga ditt Anax Lite, allt eftersom och sätt en avslutande tagg (2.0.\*) när du är klar med alla uppgifter i kursmomentet.

<!--
Rita klass och sekvensdiagram?
-->



###Extra {#extra}

Det finns ingen extrauppgift.



Resultat & Redovisning  {#resultat_redovisning}
-----------------------------------------------

*(ca: 1-2 studietimmar)*

Läs [instruktionen om hur du skall redovisa](kurser/oophp-v3/redovisa).

Se till att följande frågor besvaras i texten:

* Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar med de olika sätten?
* Berätta om hur du löste integreringen av klassen Session. Har du koll på routes och dess struktur?
* Berätta om hur du löste uppgiften med tärningsspelet 100, hur tänkte du och hur gjorde du, hur organiserade du din kod?
* Berätta om hur du löste uppgiften med Månadskalendern, hur tänkte du och hur gjorde du, hur organiserade du din kod?
* Några tankar kring SQL så här långt?
