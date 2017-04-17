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

Du skall bygga in hantering för innehåll i ditt Anax Lite. Det skall fungera på motsvarande sätt som det gjorde i artikeln.

Se till att din databas innehåller en användare doe med lösenord doe och en admin med lösenord admin. Det är för att rättaren skall kunna komma åt och logga in.



Krav {#krav}
-----------------------

1. Spara din SQL-kod som sätter upp tabell och initialt innehåll i `anax-lite/sql/setup-content.sql`.

1. Det skall finnas en administrativ del som skyddas av inloggning. Där kan den inloggade användaren (eller administratören) uppdatera innehållet enligt CRUD.

1. I din översikt av innehållet, visa minst innehållets id, titeln, published, created, updated, deleted och path samt slug.

1. Det skall finnas felhantering om det finns två likadana slugs.

1. Det skall finnas felhantering så att man kan ha tomma path.

1. Skapa en ytterligare typ av innehåll som `block`. Tanken är att denna typen av innehåll kan finnas som en del i en sida, till exempel i en sidebar.

1. Användaren skall kunna fylla i vilka textfilter som skall användas och du skall filtrera/formattera texten med din klass.

1. Skapa routes för att visa att dina `page`, `post` och `block` fungerar.

1. Validera och publicera din kod.



Extrauppgift {#extra}
-----------------------

1. Skapa en möjlighet att se de sidor som inte är publicerade.

1. Hämta från konfig om antal bloggposter på första sidan och om hela eller bara ingressen skall visas.

1. Använd ett _flash-minne_ för att skriva ut information till användaren när innehåll raderas, skapas, sparas men det sker via redirects. Det är för att göra gränssnittet tydligare för användaren.

1. Lägg till paginering och sortering på ditt admin interface.

1. Lägg till så att ett innehåll är kopplat till en viss användare.



Tips från coachen {#tips}
-----------------------


Men, väg tiden du har till förfogande, mot snabba lösningar kontra återanvändbar kod.

Lycka till och hojta till i forumet om du behöver hjälp!
