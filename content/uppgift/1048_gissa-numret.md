---
author: lew
category: oophp
revision:
  "2017-03-09": (A, lew) Första utgåvan i samband med kursen oophp v3.
...
Gissa numret
==================================

Du skall skapa ett spel, där det gäller att gissa vilket tal som slumpats fram. Spelet ska svara om spelarens gissning är högre eller lägre än det korrekta talet. Spelaren har 6 gissningar på sig. Det är en variant av Marvins "[Guess the number](uppgift/din-egen-chattbot-marvin-steg-2)" (krav 3).  

<!--more-->

Det skall finnas 3 varianter av spelet.  

1. Logiken hanteras med $\_GET (index-get.php). 

1. Logiken hanteras med $\_POST (index-post.php). 

1. Logiken hanteras med $\_SESSION (index-session.php).


Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat igenom steg 1-12 i guiden ["Kom igång med objektorienterad PHP-programmering på 20 steg"](kunskap/kom-i-gang-med-oophp-pa-20-steg).



Introduktion {#intro}
-----------------------

Börja med att ställa dig i rätt mapp i kursrepot. Skapa sedan de 3 index-filerna samt spel-klassen och sessions-klassen.

```bash
# Ställ dig i roten av kursrepot
cd me/kmom01/guess
touch index-get.php index-post.php index-session.php 
touch Guess.php Session.php
```



Krav {#krav}
-----------------------

1. Spelen ska köras från respektive index-fil.

1. Spelaren ska ha 6 försök på sig.

1. Spelen ska hanteras av klassen `Guess`. Se till så samma klass återanvänds i alla versionerna.

1. Spelarens gissning ska skickas via formulär.

1. Spelet ska ha en länk som möjliggör omstart. Talet ska då slumpas om och antalet gissningar ska nollställas. I varianten $\_SESSION ska även sessionen förstöras och startas på nytt.

1. I varianten $\_SESSION ska sessionen hanteras från klassen `Session`.

1. Länka till de olika spelen från din me-sida.

1. Validera och publicera din kod enligt följande.

```bash
# Ställ dig i kurskatalogen
dbwebb validate guess
dbwebb publish guess
```

Rätta eventuella fel som dyker upp och publicera igen. När det ser grönt ut så är du klar.



Extrauppgift {#extra}
-----------------------

1. Integrera index-get.php som en del av ramverket.

1. Integrera index-post.php som en del av ramverket.

1. Integrera index-session.php som en del av ramverket.


Tips från coachen {#tips}
-----------------------

Validera och publicera ofta. Så slipper du en massa validerings- och publiceringsfel i slutet av övningen.

När du gör *publish* så körs även *validate*. Blir det för mycket fel när du kör *publish* så kan det bli enklare att bara göra *validate* till att börja med.

Lycka till och hojta till i forumet om du behöver hjälp!
