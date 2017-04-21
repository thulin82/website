---
author:
    - mos
category:
    - php
    - kurs oophp
    - anax-lite
revision:
    "2017-04-21": "(A, mos) Första utgåvan."
...
Dokumentera PHP med phpdoc och phpDocumentor
==================================

Du ska dokumentera ditt ramverk med phpdoc och phpDocumenter. Det handlar om att dra nytta av dina docblock kommenterar och av fördelen med att följa rekommendationer av phpmd och phpcs. Tillsammans underlättar det när du nu skall automatgenerera din dokumentationen.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du är väl bekant med Anax Lite.



Introduktion {#intro}
-----------------------

Låt oss göra det enkelt. Det handlar om att använda [phpDocumenter, aka phpdoc](https://www.phpdoc.org/) för att automatgenerera dokumentation av dina klasser i Anax Lite.

Förbered dig så här.

```bash
# Gå till ditt anax-lite
$ make help
...
install            - Install all tools
doc                - Generate documentation.
...
$ make install
$ mkdir doc
$ cp vendor/anax/request/.phpdoc.xml .
$ make doc
$ firefox doc
```

Det som händer är att du använder en av funktionerna som redan finns implementerad i Makefilen. Den installerar verktyget phpdoc i `.bin/phpdoc` och kör det och det genereras dokumentation förutsatt att du har en konfigurationsfil samt en katalog `doc` där dokumentationen kan sparas.

Var nyfiken och kika i konfigurationsfilen `.phpdoc.xml`.



Krav {#krav}
-----------------------

1. Använd phpdoc för att skapa dokumentation till ditt Anax Lite.

1. Checka in och committa dokumentationen som en del av ditt repo.

1. Validera och publisera.



Extrauppgift {#extra}
-----------------------

Det finns ingen extrauppgift.



Tips från coachen {#tips}
-----------------------

Lycka till och hojta till i forumet om du behöver hjälp!
