---
author: lew
category: php
revision:
  "2017-03-14": (A, lew) First version.
...
Inloggning
==================================

Du ska integrera ett inloggningssystem i ditt Anax-lite. Det styrs med hjälp av klasser för sessionen, användaren och databasuppkopplingen. 

<!--more-->

[FIGURE src=/image/oophp/v3/loginexercise.png?w=w1&q=70 caption="Exempel på hur man kan skapa användare."]


Förkunskaper {#forkunskaper}
-----------------------

Du bör ha gjort, eller ha förkunskaper som motsvarar, guiden ["Kom igång med objektorienterad PHP-programmering på 20 steg"](kunskap/kom-i-gang-med-oophp-pa-20-steg).  
Du har gått igenom artikeln "[Logga in med sessioner och cookies](kunskap/sessioner-cookies-login)".  
Du har gjort uppgiften "[Övningar med CDatabase](uppgift/ovningar-med-cdatabase)".  
Du har gjort uppgiften "[Skapa en klass för användarhantering](uppgift/skapa-en-klass-for-anvandarhantering-cuser)".  




Krav {#krav}
-----------------------

Spara dina filer i mappen `me/anax-lite`.

1. Inloggningen ska använda MySQL.

1. Sessionen, användaren och databaskopplingen ska hanteras av respektive klasser som [moduler till Anax](kunskap/anax-en-hallbar-struktur-for-dina-webbapplikationer#modul).

1. Sessionen ska bara hålla koll på tex namnet på den inloggade användaren. 

1. Man ska kunna skapa användare, registrera sig. Möjlig information kan vara namn, epost och lösenord.

1. Lösenorden ska aldrig hanteras i klartext. Lagra enbart en krypterat version.

1. Användaren ska kunna byta sitt lösenord.

1. En profilsida ska enbart kunna nås om användaren är inloggad. Man ska inte kunna nå sidan genom att bara skriva in filnamnet i adressfältet, om man inte är inloggad. Profilsidan ska skriva ut information från användarklassen. 

1. Det ska synas vem som är inloggad.

1. Spara en cookie. Vad du sparar väljer du själv, så länge det inte är känslig information, tex lösenordet. Den sparade cookien ska synas på profilsidan.

1. All hantering av användaren ska ske via formulär.

1. Användaren ska kunna logga ut ordentligt.

1. Se till så det går att logga in från din me-sida. 

1. Se till så din kod ligger på rätt plats. Städa bort kod från vyerna.


<!-- 5. Skapa dina klasser som [moduler till Anax](kunskap/anax-en-hallbar-struktur-for-dina-webbapplikationer#modul). -->


Extrauppgift {#extra}
-----------------------

<!-- 1. Skapa dina klasser som [moduler till Anax](kunskap/anax-en-hallbar-struktur-for-dina-webbapplikationer#modul). -->

1. Skapa ett admin konto med ensam behörighet att utföra något på din me-sida. Skriv ner informationen för att logga in som admin och vad man kan göra i din redovisningstext.
    
    Till exempel:
    * Välja år i kalendern.
    * Se vilken siffra som gäller i Guess-spelet.
    * Se mer information i session/status

Tips från coachen {#tips}
-----------------------

Lös uppgiften på ditt eget vis. Det är det viktigaste. Se hur bra dina vingar bär.

**Lycka till och hojta till i forumet om du behöver hjälp!**




