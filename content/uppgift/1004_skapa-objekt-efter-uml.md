---
author: lew
revision:
    "2016-04-12": (PA, lew) Pre-release.
category:
    - python
...
Skapa objekt efter UML-diagram
===================================

Nu ska du testa vingarna och skapa några objekt efter ett färdigt UML-diagram.

<!--more-->


Förkunskaper {#forkunskaper}
-----------------------

Du har läst artiklarna: "[Vad är UML?](kunskap/vad-ar-uml)" och "[Kom igång med objekt](kunskap/kom-igang-med-objekt)" samt "[Arv med objekt](kunskap/arv)".



Introduktion {#intro}
-----------------------

Du ska skapa klass-filer för respektive klass i diagrammet. Spara alla filerna i mappen kmom02/minizoo som ligger i kursrepot. Var noga med att döpa filerna, variablerna och metoderna enligt anvisningarna i diagrammet.

För filerna använder du namnen:  
1. mini_zoo.py  
2. animal.py  
3. house.py  
4. bird.py  
5. fish.py  
6. mammal.py  

Använd sedan en fil kallad "main.py" för att skapa objekt och testa koden.  

[FIGURE src=/image/oopython/kmom02/uml1.png?w=w2 caption="Klassiskt UML-diagram."]


Krav {#krav}
-----------------------

Starta med att skapa filerna:

```bash
# Ställ dig i kurskatalogen
cd me/kmom02/minizoo
touch mini_zoo.py animal.py house.py bird.py fish.py mammal.py
```

1. Namngivning ska ske enligt diagrammet

2. Metoderna `get_*` ska returnera en sträng utifrån listan

3. I varje klass ska det finnas en överlagrad `__str__()`-metod som skriver ut allt om objektet på ett godtyckligt sätt. Arv ska användas även här. ex:  
    * `animal` ska skriva ut information om sig själv.  
    * `house` ska skriva ut information om sig själv och använda `__str__()`-metoden på alla djur i listan.  
    * `mini_zoo` ska skriva ut information om sig själv och använda `__str__()`-metoden på alla hus i listan.  

4. I din main.py ska du skapa ett mini-zoo med minst 3 hus med minst 3 djur i varje. Om ditt mini-zoo heter My_zoo avsluta med: `print(My_zoo)`.  

```bash
# Ställ dig i kurskatalogen
dbwebb validate minizoo
dbwebb publish minizoo
```

Rätta eventuella fel som dyker upp och validera igen. När det ser grönt ut så är du klar.



Extrauppgift {#extra}
-----------------------

Det finns ingen extrauppgift.



Tips från coachen {#tips}
-----------------------

Validera ofta. Så slipper du en massa valideringsfel i slutet av övningen.

Lycka till och hojta till i forumet om du behöver hjälp!
