---
author: lew
revision:
    "2016-12-16": (PB, lew) Updated flask structure.
    "2016-04-12": (PA, lew) Pre-release.
category:
    - oopython
...
Skapa ett data-objekt till me-sidan
===================================

Bygg ut din me-sida med information om applikationen.

<!--more-->


Förkunskaper {#forkunskaper}
-----------------------

Du kan grunderna i Python och stränghantering och du har gått igenom övningen "[Flask och jinja2](kunskap/flask-och-jinja2)".



Introduktion {#intro}
-----------------------

Vi lägger till ett data-objekt till me-sidan som innehåller sid-relaterad information.



Krav {#krav}
-----------------------

**(Om du inte gjort föregående övning först, börja med att [göra den övningen](uppgift/skapa-personobjekt-till-me-sida))**  



<!-- Kopiera din me-sida från föregående kursmoment och utgå från den koden.

```bash
# Ställ dig i kurskatalogen
cd me
cp -ri kmom02/flask2/ kmom03/flask3/
cd kmom03/flask3
``` -->  

Färdig? Bra. Då kan vi fortsätta i mappen me/flask:  

1. Skapa filen "my_data.py", vilken ska innehålla din dataklass.

2. Fyll på med lite relevant information så som:  
    * Länkar i navbar
    * Sidans titel
    * Bildlänk(ar)
    * Överlagra `__str__()`-metoden och se till så den skriver ut alla medlemsvariabler, en variabel per rad.

3. Använd ditt objekt i din me-sida  

6. Använd `pyreverse` för att skapa ett klass diagram. Döp filen till data.png. Spara diagrammet i mappen flask/  

7. Använd `pydoc` för att skapa en html-sida. Döp filen till data.html i formatet .png. Lägg filen i mappen flask/


```bash
# Ställ dig i kurskatalogen
dbwebb validate flask
dbwebb publish flask
```

Rätta eventuella fel som dyker upp och validera igen. När det ser grönt ut så är du klar.



Extrauppgift {#extra}
-----------------------

Det finns inga extrauppgifter.



Tips från coachen {#tips}
-----------------------

Validera ofta. Så slipper du en massa valideringsfel i slutet av övningen.

Lycka till och hojta till i forumet om du behöver hjälp!
