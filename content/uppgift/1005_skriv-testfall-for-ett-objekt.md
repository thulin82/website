---
author: lew
revision:
    "2016-04-12": (PA, lew) Pre-release.
category:
    - python
...
Skriv testfall för ditt mini-zoo
===================================

Vi ska skapa en fil som går igenom klasserna och unittestar dem.

<!--more-->


Förkunskaper {#forkunskaper}
-----------------------

Du har gjort uppgiften "[Skapa objekt efter UML](uppgift/skapa-objekt-efter-uml)" och läst igenom artikeln "[Att skriva unittester](kunskap/att-skriva-unittester)".



Introduktion {#intro}
-----------------------

För att färdigställa produkten behöver den testas. Vi skriver unittester för klasserna med Pythons egna testramverk.



Krav {#krav}
-----------------------

Kopiera din kod från föregående uppgift och utgå från den koden.

```bash
# Ställ dig i kurskatalogen
cd me
cp -ri kmom02/minizoo/*.py kmom02/test/
cd kmom02/test
touch test_zoo.py
```

1. Kopiera in koden från `main.py` där du skapat objekt.

2. Skriv ett testfall för varje typ av attribut och för varje metod i klasserna. Du behöver med andra ord inte skriva ett test för varje sträng-attribut utan ta en av dem.  

3. Exekvera alla testfall och se till att alla går igenom.

```bash
# Ställ dig i kurskatalogen
dbwebb validate test
```

Rätta eventuella fel som dyker upp och validera igen. När det ser grönt ut så är du klar.



Extrauppgift {#extra}
-----------------------

Det finns inga extrauppgifter


Tips från coachen {#tips}
-----------------------

Validera ofta. Så slipper du en massa valideringsfel i slutet av övningen.

Lycka till och hojta till i forumet om du behöver hjälp!
