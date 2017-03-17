---
author: lew
category: 
    - kurs oophp
    - php
revision:
  "2017-03-17": (A, lew) First version.
...
Integrera klassen Session i Anax-lite
==================================

Nu har du gått igenom olika delar som tillsammans gör det möjligt att integrera egna moduler och klasser in i ditt Anax-lite. I den här uppgiften ska du bygga in klassen Session, från övningen [Klasser för $_SESSION och $_COOKIE](kunskap/session-cookie-klasser). Du ska även skapa en rote för en test-sida där du använder sessionen.

<!--more-->

En variant i Anax kan se ut så här.

[FIGURE src=/image/oophp/v3/test-session.png?w=w1&q=70 caption="En testsida för sessionen i Anax."]

Förkunskaper {#forkunskaper}
-----------------------

Du bör ha gjort, eller ha förkunskaper som motsvarar, guiden ["Kom igång med objektorienterad PHP-programmering på 20 steg"](kunskap/kom-i-gang-med-oophp-pa-20-steg).  
Du bör ha gått igenom artikeln [Klasser för $_SESSION och $_COOKIE](kunskap/session-cookie-klasser).  
Du bör ha gått igenom artikeln [TBD - mos artikel om inbyggnad av moduler](tjoho).



Introduktion {#intro}
-----------------------

?


Tips lägg dina routes i config/route/session.php och iunkludera i config/route.php.



Krav {#krav}
-----------------------

1. Integrera klassen Session med Anax. (`src/Session/Session.php`)

1. Skapa en test-sida (test routes). På sidan (`session/increment` och `session/decrement`) ska du ha två länkar, en som kan öka en siffra i sessionen och en som minskar den.

1. `session/status` http://php.net/manual/en/function.session-id.php json-response

1. `session/dump` Använd klassens `dump()`-metod på sidan.

1. `session/destroy` redirect `session/status` .   header(), response->redirect($app-url-create("session/status))

1. `session` visar länkarna toil de testroutes som du har gjort. Intro.

1. Skapa en route för test-sidan. Se till så du når den via navbaren.



Extrauppgift {#extra}
-----------------------

1. Koda ihop fler tester för sessionen. Kanske gå igenom klassens alla metoder?

1. Gör ett formulär där man kan lägga till egna värden i sessionen.


Testa, lek och öva - det kommer man långt med.

**Lycka till och hojta till i forumet om du behöver hjälp!**
