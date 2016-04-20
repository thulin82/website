---
author: mos
category: php
revision:
  "2015-03-24": (A, mos) Första utgåvan i samband med kursen htmlphp version 2.
updated: "2015-05-20 14:25:44"
created: "2015-01-28 14:25:23"
...
PHP lab 1, grundkonstruktioner
==================================

Jobba igenom grunderna i PHP med typer, variabler, villkor, inbyggda funktioner och loopar.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har installerat en labbmiljö där du kan köra PHP, motsvarande [labbmiljön för kursen htmlphp](htmlphp/labbmiljo)".

Du har tillgång till kommandot `dbwebb` och du har clonat kursrepot för htmlphp-kursen.



Hämta labben {#hamta}
-----------------------

Labben automatgenereras för dig. Gör så här för att checka ut din personliga labb.

Gå till din kurskatalog i terminalen och kör följande kommando.

```bash
# Flytta till kurskatalogen
dbwebb create lab1
```

Materialet till labben skapas nu och sparas i din kurskatalog `me/kmom02/lab1` enligt följande.

| Fil                | Innehåll                                                              |
|--------------------|-----------------------------------------------------------------------|
| `instruction.html` | Beskrivning av labben och de uppgifter som skall göras.               |
| `answer.php`       | Här skall du skriva din kod för att lösa respektive uppgift i labben. |
| `CDbwebb.php`      | Används av `answer.php` för att testa din labb.                        |
| `answer.json`      | Används av `CDbwebb.php` för att testa din labb.                        |

Öppna filen `instruction.html` i en webbläsare och läs igenom de uppgifter som labben omfattar.

Öppna filen `answer.php` i din texteditor och koda ihop svaren på uppgifterna.

Du kan testa dina lösningar genom att köra programmet `answer.php` i din webbläsare, via din lokala webbserver.



Krav {#krav}
-----------------------

1. Gör de uppgifter som finns i labben `instruction.html`.

2. Skriv dina lösningar, på rätt plats, i filen `answer.php`.

3. Testkör din labb genom att köra filen `answer.php`.

4. Ladda upp, validera och publicera labben genom att göra följande kommando i kurskatalogen i terminalen.

```bash
# Flytta till kurskatalogen
dbwebb publish lab1
```

Rätta eventuella fel som dyker upp och publisera igen. När det ser grönt ut så är du klar. 



Extrauppgift {#extra}
-----------------------

Det finns ingen extra uppgift.



Tips från coachen {#tips}
-----------------------

Debugga och felsök genom att skriva ut variablernas olika innehåll med `echo`, `print_r()` eller `var_dump()`.

Validera ofta. Så slipper du en massa valideringsfel i slutet av övningen.

När du gör *publish* så körs även *validate*. Blir det för mycket fel när du kör *publish* så kan det bli enklare att bara göra *validate* till att börja med.

Lycka till och hojta till i forumet om du behöver hjälp!




