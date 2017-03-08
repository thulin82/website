---
author: efo
category: webbprogrammering
revision:
  "2017-03-07": (A, efo) Första utgåvan i samband med kursen webapp v2.
...
Bygg vidare på din me-app
==================================

Du skall vidareutveckla din me-app, så den innehåller två nya vyer. En vy med information om dina github repos och en vy där vi detekterar storlek och orientering på vår enhet.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har en mithril me-app från föregående kursmoment, som fungerar i cordova på android.

Du har jobbat igenom artikeln "[Modeller och request i mithril](kunskap/mithril-modeller-och-request)".

Du har jobbat igenom artikeln "[Att göra en mobilapp av en mobil-anpassad webbplats](kunskap/kunskap/att-gora-en-mobilapp-av-en-mobil-anpassad-webbplats)".



Introduktion {#intro}
-----------------------

Börja med att ta en kopia av koden från föregående kursmoments me-app.

```bash
# Ställ dig i rooten av kursrepot
cd me
cp -ri kmom01/me1/* kmom02/me2/
```

Nu har du din bas du kan utgå ifrån, spara alla dina filer i katalogen `me/kmom02/me2`.

[Dokumentation](https://developer.github.com/v3/) och exempel  för Githubs API underlättar vid utveckling av vår Github vy.



Krav {#krav}
-----------------------

1. Skapa en vy där du presenterar information om dina Github repos. Som minimum namn och när det senast var uppdaterat.

1. Skapa en vy där du detekterar och skriver ut information om användarens enhets orientering och storlek.

1. Din me-app skall kunna köras med cordova både i browsern och i en android emulator.

1. Validera och publicera din kod enligt följande.

```bash
# Ställ dig i kurskatalogen
dbwebb validate me1
dbwebb publish me1
```

Rätta eventuella fel som dyker upp och publicera igen. När det ser grönt ut så är du klar.



Extrauppgift {#extra}
-----------------------

Inga extrauppgifter detta kursmomentet.



Tips från coachen {#tips}
-----------------------

Validera och publicera ofta. Så slipper du en massa validerings- och publiceringsfel i slutet av övningen.

När du gör *publish* så körs även *validate*. Blir det för mycket fel när du kör *publish* så kan det bli enklare att bara göra *validate* till att börja med.

Lycka till och hojta till i forumet om du behöver hjälp!
