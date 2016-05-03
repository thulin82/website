---
author: aar
revision:
    "2016-05-03": (PA, aar) Pre-release.
category:
    - python
...
Skapa sequence diagram
===================================

Nu ska du skapa ett sequence diagram utifrån kod.

<!--more-->


Förkunskaper {#forkunskaper}
-----------------------

Du har läst artiklarna: "[Vad är UML?](kunskap/vad-ar-uml)" och "[Kom igång med objekt](kunskap/kom-igang-med-objekt)".



Introduktion {#intro}
-----------------------

Du ska skapa ett sequnce diagram med valfritt verktyg, jag föreslår https://www.websequencediagrams.com/ eller https://www.draw.io/.



Krav {#krav}
-----------------------

Starta med att kopiera filerna:

```bash
# Ställ dig i kurskatalogen
cd me/kmom02/uml
cp -ri example/uml/*.py me/kmom02/uml/
# Testa att koden funkar
./Controller.py
```

1. Skapa ett sequnce diagram av vad som händer efter _controller.main()_ anropas i koden.

2. Skapa en jpeg eller png bild av diagrammet och inkludera i mappen.

```bash
# Ställ dig i kurskatalogen
dbwebb validate uml
```

Rätta eventuella fel som dyker upp och validera igen. När det ser grönt ut så är du klar.



Extrauppgift {#extra}
-----------------------

Det finns ingen extrauppgift.



Tips från coachen {#tips}
-----------------------

Validera ofta. Så slipper du en massa valideringsfel i slutet av övningen.

Lycka till och hojta till i forumet om du behöver hjälp!
