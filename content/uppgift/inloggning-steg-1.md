---
author: lew
category: php
revision:
  "2017-03-14": (A, lew) First version.
...
Skapa inloggning
==================================

Det finns många inloggningssystem klara att använda. Vi ska skapa en egen variant. Det är bra att se hur saker kan fungera under huven.

<!--more-->


Förkunskaper {#forkunskaper}
-----------------------

Du bör ha gjort, eller ha förkunskaper som motsvarar, guiden ["Kom igång med objektorienterad PHP-programmering på 20 steg"](kunskap/kom-i-gang-med-oophp-pa-20-steg).  
Du har gått igenom artikeln "[Logga in med sessioner och cookies](kunskap/sessioner-cookies-login)".



Krav {#krav}
-----------------------

Spara dina filer i mappen `me/kmom01/login`.

1. Systemet ska använda en SQLite-databas.

1. Sessionen och databaskopplingen ska hanteras i klasser.

1. Man ska kunna skapa användare.

1. Lösenorden ska aldrig hanteras i klartext. Spara enbart en krypterat version.

1. Användaren ska kunna byta sitt lösenord.

1. En välkomstsida ska enbart nås om användaren är inloggad. Man ska inte kunna nå sidan genom att bara skriva in filnamnet i adressfältet, om man inte är inloggad.

1. Spara en cookie. Vad du sparar väljer du själv, så länge det inte är känslig information, tex lösenordet.

1. All hantering ska ske via formulär.

1. Användaren ska kunna logga ut ordentligt.

<!-- 5. Skapa dina klasser som [moduler till Anax](kunskap/anax-en-hallbar-struktur-for-dina-webbapplikationer#modul). -->


Extrauppgift {#extra}
-----------------------

1. Skapa dina klasser som [moduler till Anax](kunskap/anax-en-hallbar-struktur-for-dina-webbapplikationer#modul).



Tips från coachen {#tips}
-----------------------

Lös uppgiften på ditt eget vis. Det är det viktigaste. Se hur bra dina vingar bär.

Om du gjort följt med i artikeln ["Logga in med sessioner och cookies"](kunskap/sessioner-cookies-login) så har du nästan resultatet klart.

**Lycka till och hojta till i forumet om du behöver hjälp!**




