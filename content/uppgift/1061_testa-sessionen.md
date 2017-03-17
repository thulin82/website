---
author: lew
category: oophp
revision:
  "2017-03-17": (A, lew) First version.
...
Integrera klassen Session i Anax-lite
==================================

Nu har du gått igenom olika delar som tillsams gör det möjligt att integrera egna moduler och klasser in i ditt Anax-lite. I den här uppgiften ska du bygga in klassen Session, från övningen [Klasser för $_SESSION och $_COOKIE](kunskap/session-cookie-klasser). Du ska även skapa en rote för en test-sida där du använder sessionen.

<!--more-->

En variant i Anax kan se ut så här.

[FIGURE src=/image/oophp/v3/test-session.png?w=w1&q=70 caption="En testsida för sessionen i Anax."]

Förkunskaper {#forkunskaper}
-----------------------

Du bör ha gjort, eller ha förkunskaper som motsvarar, guiden ["Kom igång med objektorienterad PHP-programmering på 20 steg"](kunskap/kom-i-gang-med-oophp-pa-20-steg).  
Du bör ha gått igenom artikeln [Klasser för $_SESSION och $_COOKIE](kunskap/session-cookie-klasser).  
Du bör ha gått igenom artikeln [TBD - mos artikel om inbyggnad av moduler](tjoho).



Krav {#krav}
-----------------------

1. Integrera klassen Session med Anax.

1. Skapa en test-sida. På sidan ska du ha två länkar, en som kan öka en siffra i sessionen och en som minskar den.

1. Använd klassens `dump()`-metod på sidan.

1. Skapa en route för test-sidan. Se till så du når den via navbaren.



Extrauppgift {#extra}
-----------------------

1. Koda ihop fler tester för sessionen. Kanske gå igenom klassens alla metoder?

1. Gör ett formulär där man kan lägga till egna värden i sessionen.


Testa, lek och öva - det kommer man långt med.

**Lycka till och hojta till i forumet om du behöver hjälp!**




