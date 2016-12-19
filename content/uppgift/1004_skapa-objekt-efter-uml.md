---
author: lew
revision:
    "2016-12-19": (PA, lew) New assignment.
    "2016-04-12": (PA, lew) Pre-release.
category:
    - oopython
...
Skapa objekt efter UML-diagram
===================================

Nu ska du testa vingarna och skapa några objekt efter ett färdigt UML-diagram.

<!--more-->


Förkunskaper {#forkunskaper}
-----------------------

Du har läst artiklarna: "[Vad är UML?](kunskap/vad-ar-uml)" och "[Kom igång med objekt](kunskap/kom-igang-med-objekt)" samt "[Klass relationer](kunskap/klass-relationer)".



Introduktion {#intro}
-----------------------

Du ska skapa klass-filer för respektive klass i diagrammet. Spara alla filerna i mappen kmom02/deck som ligger i kursrepot. Var noga med att döpa filerna, variablerna och metoderna enligt anvisningarna i diagrammet. Det handlar om att skapa en komplett kortlek.

För filerna använder du namnen:  
1. deck.py  
2. suit.py  
3. card.py    

Använd sedan en fil kallad "main.py" för att skapa objekt och testa koden.  

[FIGURE src=/image/oopython/kmom02/uml1.png?w=w2 caption="Klicka på bilden för större storlek."]


Krav {#krav}
-----------------------

Starta med att skapa filerna:

```bash
# Ställ dig i kurskatalogen
cd me/kmom02/deck
touch deck.py suit.py card.py main.py
```

1. Namngivning ska ske enligt diagrammet

2. Metoderna `get_*` ska returnera en sträng utifrån listan

3. I varje klass ska det finnas en överlagrad `__str__()`-metod som skriver ut allt om objektet på ett godtyckligt sätt. Relationerna ska stämma med diagrammet ovan.  
    * `card` ska skriva ut information om sig själv samt vilken färg (suit) det tillhör.  
    * `suit` ska skriva ut information om sig själv och använda `__str__()`-metoden på alla kort i sin lista.  
    * `deck` ska skriva ut information om sig själv och använda `__str__()`-metoden på alla kort i varje färg, hela kortleken.  

4. I din main.py ska du skapa en kortlek med 4 färger och 52 kort. Döp din kortlek till `DeckOfCards` och avsluta med: `print(DeckOfCards)`.  

```bash
# Ställ dig i kurskatalogen
dbwebb validate deck
```

Rätta eventuella fel som dyker upp och validera igen. När det ser grönt ut så är du klar.



Extrauppgift {#extra}
-----------------------

Det finns ingen extrauppgift.



Tips från coachen {#tips}
-----------------------

Validera ofta. Så slipper du en massa valideringsfel i slutet av övningen.

Lycka till och hojta till i forumet om du behöver hjälp!
