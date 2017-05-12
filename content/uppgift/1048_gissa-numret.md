---
author: lew
category:
    - kurs oophp
revision:
    "2017-05-12": (C, mos) Uppdaterade vilka stycken som gälle ri oophp20-guiden.
    "2017-03-14": (B, mos) La till info samt om objekt i sessionen.
    "2017-03-09": (A, lew) Första utgåvan i samband med kursen oophp v3.
...
Gissa numret
==================================

Du skall implementera olika varianter av ett spel, där det gäller att gissa vilket tal som slumpats fram. Spelet ska svara om spelarens gissning är högre eller lägre än det korrekta talet. Spelaren har 6 gissningar på sig. 


<!--more-->

Det skall finnas följande varianter av spelet.  

1. Strukturen hanteras med $\_GET (index-get.php). 

1. Strukturen hanteras med $\_POST (index-post.php). 

1. Strukturen hanteras med $\_SESSION (index-session.php).

1. Strukturen hanteras med objekt i SESSION (index-session-object.php).



Förkunskaper {#forkunskaper}
-----------------------

Du har goda grundläggande kunskaper i PHP som motsvarar artikeln "[20 steg för att komma igång med PHP (php20)](kunskap/kom-i-gang-med-php-pa-20-steg)".

Du har jobbat igenom guiden "[Kom igång med objektorienterad PHP-programmering på 20 steg"](kunskap/kom-i-gang-med-oophp-pa-20-steg)".



Introduktion {#intro}
-----------------------



###Skapa filer {#filer}

Börja med att ställa dig i rätt mapp i kursrepot. Skapa sedan de olika  index-filerna samt filer för spelklass, sessionsklass och en autoloader samt ett eget exception. Dessutom kan du skapa en fil för generella configs. Skapa även en index.php som blir din framsida för allt där du presenterar länkar till de tre olika varianterna av spelet.

```bash
# Ställ dig i roten av kursrepot
cd me/kmom01/guess
touch index-{get,post,session,session-object}.php
touch {index,Guess,GuessException,Session,autoload,config}.php 
```



###Spelregler {#regler}

Spelet "Guess the number" är ett enkelt gissningsspel där någon tänker på ett tal mellan 1-100. I detta fallet är det datorn som tänker på ett tal.

Man har 6 gissningar på sig att gissa rätt tal. Vid varje gissning så får man svaret om talet "för lågt", "för högt" eller "rätt gissat".

När gissningarna är slut kan man inte gissa mer.



###Namespace {#namespace}

I denna uppgiften kan du kan skapa dina klasser utan namespace.



###Generella regler {#gen}

Spelet ska hanteras av klassen `Guess`. Se till att samma klass återanvänds i alla versionerna av spelet.

Klassen Guess skall innehålla metoder för att skapa nytt nummer att gissa på.

Klassen skall innehålla information om antalet gjorda gissningar tillsammans med det slumpade numret.

Klassen skall innehålla en metod som gör en gissning.

Det skall finnas metoder för att hämta information om det slumpade talet och antalet gjorda gissningar.

Man skall kunna initiera ett objekt av klassen, genom att *injecta* information såsom det gissade talet och antalet gissningar gjorda.

Klassen får inte läsa direkt från $\_GET, $\_POST eller $\_SESSION. Om information behövs från dessa globala variabler så skall de bifogas in till klassen Guess, informationen skall injectas in i klassen. 



###index-get.php {#get}

[FIGURE src=image/snapvt17/guess-my-number-get.png?w=w2 caption="Ett exempel på ett spel med GET."]

Gissa numret i ett formulär som postas med GET-metoden.

Minns vilket nummer som är det gissade genom att lagra det i ett hidden fält i formuläret.

Det skall finnas en länk som möjliggör omstart. Talet ska då slumpas om och antalet gissningar ska nollställas.



###index-post.php {#post}

[FIGURE src=image/snapvt17/guess-my-number-post.png?w=w2 caption="Ett exempel på ett spel med POST."]

Gissa numret i ett formulär som postas med POST-metoden.

Minns vilket nummer som är det gissade genom att lagra det i ett hidden fält i formuläret.

Det skall finnas en knapp som möjliggör omstart. Talet ska då slumpas om och antalet gissningar ska nollställas.



###index-session.php {#session}

[FIGURE src=image/snapvt17/guess-my-number-session.png?w=w2 caption="Ett exempel på ett spel med SESSION."]

Gör klassen `Session` som hanterar all kommunikation med `$_SESSION` samt startandet `start()` av sessionen. Använd ett sessionsnamn som gör din session unik och sätt det med `setName()`.

Klassen Session är en wrapper framför $\_SESSION och läser egentligen bara av variabeln och returnerar värden.

Klassen skall kunna läsa `get($key)` och sätta värden `set($key, $values)` i SESSION.

Klassen skall kunna sätta ett sessionsnamn och starta sessionen.

Spara undan värden för antalet gjorda gissningar och det gissade talet i sessionen. Strukturen är alltså som de två tidigare varianterna, det som tidigare sparades via hidden-fält i GET och POST skall nu samma information lagras undan i SESSION.

Din Guess-klass skall inte använda sig av Session-klassen, kopplingen får göras i index-skriptet.

Det skall finnas både en länk och en knapp för att göra reset av spelet.

Använd redirect med `header()` för att undvika problem vid POST och reload.

```php
# Redirect to another page
header("Location: index-session.php");
exit;
```

Tips. Skapa en metod `getOnce()` som läser av ett värde i sessionen och sedan raderar det från sessionen. Det blir en form av flash-minne där du kan skicka ett värde till en sida och när det läses av så försvinner det från sessionen. Det kan vara en användbar metod när du bara vill lagra information mellan två sidor.



###index-session_object.php {#session}

[FIGURE src=image/snapvt17/guess-my-number-session-object.png?w=w2 caption="Nu sparas hela objektet i sessionen."]

Nu skall du lagra hela instansen av ditt Guess-objekt i sessionen. Spara hela objektet i sessionen och återanvänd det vid varje sidladdning.

Ditt objekt skall alltså innehålla all information om spelet.

Om du behöver kan du lagra extra information i sessionen. Det kan vara nödvändigt för att ha koll på om en gissning är gjord eller ej och uppdatera gränssnittet (webbsidan) på rätt sätt.

Det är viktigt att du sätter din autoloader innan du startar sessionen. Annars kan sessionen inte göra unserialize på det objektet som ligger sparat i sessionen.



Krav {#krav}
-----------------------

1. De olika varianterna av spelet skall köras från respektive index-fil.

1. Gör index.php till en framsida, via den kan man nå de olika varianterna av spelet.

1. Skapa en autoloader som automatiskt laddar klassfilerna när de behövs.

1. I filen config.php lägger du eventuell allmän konfiguration som behövs, se minst till att lägga till så att felutskrifter syns.

1. Du skall ha en egen global exception handler som fångar alla exception och skriver ut information om dem.

1. Om man gissar ett tal som är högre än 100 eller lägre än 1 så skall ett exception av typen `GuessException` kastas.

1. Länka till spelen från din me-sida.

1. Validera och publicera din kod enligt följande.

```bash
# Ställ dig i kurskatalogen
dbwebb validate guess
dbwebb publish guess
```

Rätta eventuella fel som dyker upp och publicera igen. När det ser grönt ut så är du klar.



Extrauppgift {#extra}
-----------------------

1. Lägg på style för att göra det snyggare.

1. Integrera det sista spelet med ramverket med allt vad det innebär med namespace, vyer och routes.



Tips från coachen {#tips}
-----------------------

Validera och publicera ofta. Så slipper du en massa validerings- och publiceringsfel i slutet av övningen.

När du gör *publish* så körs även *validate*. Blir det för mycket fel när du kör *publish* så kan det bli enklare att bara göra *validate* till att börja med.

Lycka till och hojta till i forumet om du behöver hjälp!
