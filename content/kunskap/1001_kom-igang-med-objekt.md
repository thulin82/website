---
author: Kenneth
published: 2016-03-21
category:
    - python
---
Kom igång med objekt i Python
===================================

[FIGURE src=/image/snapvt16/python-list-shopping.png?w=c5&a=0,75,75,0 class="right"]

Allt i Python är på ett eller annat sätt ett objekt. Strängar, integers, listor, moduler - ja, allt. Det vi ska titta på är hur man skapar egna objekt (klasser) och hur man hanterar dem.

<!--more-->



Förutsättning {#pre}
-------------------------------

Du kan grunderna i Python och du vet vad variabler, typer och funktioner innebär.



När kan/ska man använda objekt? {#nar-kan-man-anvanda-objekt}
------------------------------

Objekt kommer väl till pass när ens kod börjar kräva beteenden. Är det ren data man programmerar så kommer man väldigt långt på att hålla dem i exempelvis en lista. Vill man sedan att datan ska hanteras mer än att bara visas, kanske ha egna attribut eller metoder, så skapar man en klass utav det. Låt oss gå igenom hur man skapar ett bil-objekt, "Car". Ett klass-objekt skapas med:  

```python
class Car():
```

En tom "bil" är ganska tråkigt så vi fyller på med lite attribut som en bil har:

```python
class Car():
    wheels = 0
    model = ""
    price = 0
```

Sådär ja, vad fint det blev. Man kan sätta attributen direkt men för att göra klassen mer användningsbar sätter vi dem i konstruktorn; metoden som körs när en ny instans skapas. Den metoden heter `__init__` och det första argumentet är `self` så objektet kan ha egna attribut:

```python
class Car():
    wheels = 0
    model = ""
    price = 0

    def __init__(self, wheels, model, price):
        self.wheels = wheels
        self.model = model
        self.price = price
```

Nu kan vi skapa en ny instans med:

```python
bmw = Car(4, "BMW", 100000)
```

Nu har vi skapat en instans av klassen Car med 4 hjul, märket BMW och med ett pris på 100.000. Vi kan även skapa fler instanser från samma klass:

```python
volvo = Car(4, "Volvo", 150000)
```


###Mindre delrubrik, kan använda `[]` (titta i koden) {#dontForgetId}

mer text

```python
>>> mer kod

```


###Mindre delrubrik {#dontForgetId}



Större rubrik igen {#dontForgetId}
------------------------------

Ascinema länk:

[ASCIINEMA src=37763]



###Överkurs {#overkurs}

Text...



Avslutningsvis {#avslutning}
------------------------------

Bra finish, länka till forumtråd eller liknande?



Revisionshistoria {#revisionshistoria}
--------------------------------------

<span class='revision-history' markdown='1'>
2016-02-29 (A, mos) Första utgåvan.  
</span>
