---
author: Kenneth Lewenhagen
published: 2016-04-12
category:
    - python
...
Kom igång med objekt i Python
===================================

[FIGURE src=/image/snapvt16/python-list-shopping.png?w=c5&a=0,75,75,0 class="right"]

Allt i Python är på ett eller annat sätt ett objekt. Strängar, integers, listor, moduler - ja, allt. Det vi ska titta på är hur man skapar egna objekt (klasser) och hur man hanterar dem.

<!--more-->



Förutsättning {#pre}
-------------------------------

Du kan grunderna i Python och du vet vad variabler, typer och funktioner innebär.



Terminologi {#terminologi}
-------------------------------

* **Klass**: En användar-definierad prototyp för ett objekt som definierar en uppsättning attribut som karaktäriserar alla objekt av klassen. Attributen är klass-variabler, instans-variabler och metoder, som nås via "dot-notation".

* **Klass-variabel**: En variabel som delas mellan alla instanser av klassen. Den definieras inuti klassen men utanför klass-metoderna. En klass-variabel kallas även _statisk variabel_.

* **Instans-variabel**: En variabel som är definierad inuti en metod. Den tillhör enbart den instansen av klassen.

* **Instans**: Ett individuellt objekt av en speciell klass.

* **Metod**: En funktion som är definierad inuti en klass.

* **Attribut**:  De specifika egenskaperna (variablerna) för en klass.


När kan/ska man använda objekt? {#nar-kan-man-anvanda-objekt}
------------------------------

Objekt kommer väl till pass när ens kod börjar kräva beteenden. Är det ren data man programmerar så kommer man väldigt långt på att hålla dem i exempelvis en lista. Vill man sedan att datan ska hanteras mer än att bara visas, kanske ha egna attribut eller metoder, så skapar man en klass utav det.



Skapa ett objekt {#skapa-ett-objekt}
------------------------------

Låt oss gå igenom hur man skapar ett bil-objekt, "Car". Ett klass-objekt skapas med:  

```python
class Car():
```

Vi låtsas att en bil alltid har 4 hjul. Det är något som alla instanser kommer ha. Vi lägger också till en räknare som har koll på hur många bilar vi har, två så kallade _statiska variabler_ eller _klass-variabler_:

```python
class Car():
    wheels = 4
    carCount = 0
```

Sådär ja, vad fint det blev. De statiska variablerna som ligger här ägs av bas-klassen Car. Man kan sätta resten av attributen direkt men för att göra klassen mer användningsbar sätter vi dem i konstruktorn; metoden som körs när en ny instans skapas. Alla bilar kommer ha 4 hjul men övriga attribut kan skilja sig. Den metoden heter `__init__` och det första argumentet är `self` så objektet kan nå sina egna attribut. Vi fyller på med modell och pris. I vår `__init__`-metod kan vi också öka på räknaren:

```python
class Car():
    wheels = 4
    carCount = 0

    def __init__(self, model, price):
        self.model = model
        self.price = price

        Car.carCount += 1
```

Som du ser så används argumentet "self" i klassen. Den behöver man inte skicka med som parameter, utan det gör Python åt dig. Alla metoder måste dock börja med "self" i argumentlistan. Det som händer är att med det magiska första argumentet vet metoden vilken instans som äger anropet.

Nu kan vi skapa en ny instans med:

```python
bmw = Car("BMW", 100000)
```

Nu har vi skapat en instans av klassen Car med 4 hjul, märket BMW och med ett pris på 100.000. Vi kan även skapa fler instanser från samma klass:

```python
volvo = Car("Volvo", 150000)
```

Vi testar att skriva ut objekten:

```python
print(bmw)
<__main__.Car object at 0x7f824cc7b4e0>

print(volvo)
<__main__.Car object at 0x7f824cc7b4a8>

print("Antal bilar: {antal}".format(antal=Car.carCount))
Antal bilar: 2
```

Det ser ju bra ut. Två instanser av "Car" som inte refererar till samma minnesplats. Vi ser också att räknaren fungerar.

För att nå medlemsvariablerna använder man så kallad "dot-notation". Vi provar.

```python
print(bmw.wheels)
4

print(bmw.model)
BMW

print(bmw.price)
100000
```

"bmw" är en instans av Car så om vi ändrar attributet `wheels` i efterhand, så ändras den för alla objekt skapade från klassen:

```python
print(bmw.wheels)
4

Car.wheels = 12

print(bmw.wheels)
12
```

För att instanserna ska äga variablerna kan man flytta tex `wheels` till __init__-metoden.

###Metoder {#metoder}

En metod är en funktion som är definierad inuti en klass. Vi har redan skapat en i form av `__init__` men vi tittar närmare på hur en sådan kan se ut. Vi skapar en metod för att skriva ut information om bilen:

```python
class Car():
    wheels = 4
    carCount = 0

    def __init__(self, model, price):
        self.model = model
        self.price = price

        Car.carCount += 1

    def presentCar(self):
        print("Model: {m}, Price: {p}".format(m=self.model, p=self.price))
```

Nu kan vi använda den på följande sätt:

```python
bmw.presentCar()
Model: BMW, Price: 100000

volvo.presentCar()
Volvo, Price: 150000
```



###En lista som medlemsvariabel {#en-lista-som-medlem}

Vi lägger till en lista som medlemsvariabel. Tanken är att den ska innehålla information om övrig utrustning. Vi lägger till en tom lista som medlemsvariabel och en metod som lägger till saker och en utskriftsmetod.

```python
class Car():
    wheels = 4
    carCount = 0
    equipment = [] #Vi lägger till en lista som inte behöver sättas i konstruktorn, __init__

    def __init__(self, model, price):
        self.model = model
        self.price = price

        Car.carCount += 1

    def presentCar(self):
        print("Model: {m}, Price: {p}".format(m=self.model, p=self.price))

    def addEquipment(self, newEquipment):
        self.equipment.append(newEquipment)

    def printEquipment(self):
        for eq in self.equipment:
            print("* " + eq)
```

Nu kan vi lägga till utrustning:

```python
volvo = Car("Volvo", 150000)
volvo.addEquipment("Bluetooth")
volvo.addEquipment("7 inch display")

volvo.printEquipment()
* Bluetooth
* 7 inch display
```



Avslutningsvis {#avslutning}
------------------------------

Det här var en introduktion till hur man skapar egna klasser. Vill du lära dig mer på en gång kan du läsa på lite djupare om objekt och klasser:  

1. [docs.python.org](https://docs.python.org/3.4/tutorial/classes.html#)  
2. [tutorialspoint](http://www.tutorialspoint.com/python/python_classes_objects.htm)



Revisionshistoria {#revisionshistoria}
--------------------------------------

<span class='revision-history' markdown='1'>
2016-04-12 (A, lew) Första utgåvan.  
</span>
