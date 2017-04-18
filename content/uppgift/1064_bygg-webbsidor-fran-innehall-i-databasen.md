---
author:
    - mos
category:
    - php
    - kurs oophp
    - anax-lite
    - sql
revision:
    "2017-04-18": "(A, mos) Första utgåvan."
...
Bygg webbsidor från innehåll i databasen
==================================

Du skall bygga tabell(er) i en databas tillsammans med klasser i Anax Lite för att implementera stöd för sidor och bloggposter som sparas i databasen och kan redigeras av en användare.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat igenom artikeln "[Lagra innehåll i databas för webbsidor och bloggposter (v2)](kunskap/kom-igang-med-php-pdo-och-mysql-v2)".

Du har löst uppgiften "[Skapa en klass för textfiltrering och formattering](uppgift/skapa-en-klass-for-textfiltrering-och-formattering)".



Introduktion {#intro}
-----------------------

Du skall bygga in hantering för innehåll i ditt Anax Lite. Det skall fungera (ungefär) på motsvarande sätt som det gjorde i artikeln. Men du har full frihet hur du väljer att integrera det i ditt Anax Lite.

Se till att din databas innehåller en användare doe med lösenord doe och en admin med lösenord admin. Det är för att rättaren skall kunna komma åt och logga in.

Tips. Förslagsvis bygger du en generell Content-klass och specifika klasser för Page och Blog, men du väljer strukturen helt själv.



Krav {#krav}
-----------------------

1. Spara din SQL-kod som sätter upp tabell och initialt innehåll i `anax-lite/sql/setup-content.sql`.

1. Det skall finnas en administrativ del som skyddas av inloggning. Där kan den inloggade användaren (eller administratören) skapa, uppdatera och radera innehåll (CRUD).

1. Se till att din databas innehåller en användare doe med lösenord doe och en användare admin med lösenord admin. 

1. I din översikt av innehållet visar du minst innehållets id, titeln, published, created, updated, deleted, path och slug.

1. Det skall finnas (någon enkel form av) felhantering om det finns två likadana slugs.

1. Det skall finnas felhantering så att man kan ha tomma path.

1. Skapa en ytterligare typ av innehåll som `block`. Tanken är att denna typen av innehåll kan finnas som en del i en sida, till exempel i en sidebar, en flash, en triptych eller en footer.

1. Användaren skall kunna fylla i vilka textfilter som skall användas och du skall filtrera/formattera texten med din klass motsvarande `Textfilter`.

1. Skapa routes för att visa att dina `page`, `post` och `block` fungerar.

1. Validera och publicera din kod.



Extrauppgift {#extra}
-----------------------

1. Skapa en möjlighet att se de sidor som ännu inte är publicerade samt de som är raderade. Denna möjlighet kan kräva inloggning (eller inte).

1. Skapa funktioner så att endast ingressen (första delen av bloggposten) visas i översikten samt lägg till en länk för "Läs mer »".

1. Hämta från en konfigfil om antal bloggposter som visas på första sidan och om hela eller bara ingressen skall visas.

1. Använd ett _flash-minne_ i sessionen för att skriva ut information till användaren när innehåll raderas, skapas, sparas. Det är för att göra gränssnittet tydligare för användaren.

1. Lägg till paginering och sortering på ditt admin interface av innehållet.

1. Lägg till så att ett innehåll är kopplat till en viss användare som blir dess författare.



Tips från coachen {#tips}
-----------------------

Väg tiden du har till förfogande, mot snabba lösningar kontra återanvändbar kod.

Lycka till och hojta till i forumet om du behöver hjälp!
