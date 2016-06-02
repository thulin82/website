---
author: lew
revision:
    "2016-04-12": (PA, lew) Pre-release.
category:
    - oopython
...
Skapa ett person-objekt till me-sidan
===================================

Bygg ut din me-sida med information om dig själv.

<!--more-->


Förkunskaper {#forkunskaper}
-----------------------

Du kan grunderna i Python och stränghantering och du har gått igenom övningen "[Flask och jinja2](kunskap/flask-och-jinja2)".



Introduktion {#intro}
-----------------------

För att kunna styra innehållet i me-sidan på ett smidigt sätt, bygger vi ut den med ett person-objekt som innehåller lite information om dig själv.



Krav {#krav}
-----------------------

Kopiera din me-sida från föregående kursmoment och utgå från den koden.

```bash
# Ställ dig i kurskatalogen
cd me
cp -ri kmom02/flask2/* kmom03/flask3/
cd kmom03/flask3
```

1. Skapa filen "person.py", vilken ska innehålla din personklass.

2. Fyll på med lite relevant information så som:  
    * Förnamn
    * Efternamn
    * Ålder
    * m.m.
    * Godtyckliga metoder för att underlätta utskrift

3. Använd ditt objekt i about.html

4. Bygg om din sida så du använder Jinja2 och återanvänder din header och footer.  

5. Använd `pyreverse` för att skapa ett klass diagram. Döp filen till person.png Bifoga diagrammet i mappen Flask3/  

6. Använd `pydoc` för att skapa en html-sida. Döp filen till person.html i formatet .png. Bifoga filen i mappen Flask3/



```bash
# Ställ dig i kurskatalogen
dbwebb validate flask3
dbwebb publish flask3
```

Rätta eventuella fel som dyker upp och validera igen. När det ser grönt ut så är du klar.



Extrauppgift {#extra}
-----------------------

Det finns inga extrauppgifter.



Tips från coachen {#tips}
-----------------------

Validera ofta. Så slipper du en massa valideringsfel i slutet av övningen.

Lycka till och hojta till i forumet om du behöver hjälp!
