---
author: lew
revision:
    "2016-04-12": (A, lew) Första versionen.
category:
    - oopython
...
Kom igång med objekt i Python
===================================

[FIGURE src=/image/oopython/kmom01/kom_igang_top.png?w=c5 class="right"]

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

* **Statisk metod**: En metod i klassen som fungerar oberoende av klassen och _self_.


När kan/ska man använda objekt? {#nar-kan-man-anvanda-objekt}
------------------------------

Objekt kommer väl till pass när ens kod börjar kräva beteenden. Är det ren data man programmerar så kommer man väldigt långt på att hålla dem i exempelvis en lista. Vill man sedan att datan ska hanteras mer än att bara visas, kanske ha egna attribut eller metoder, så skapar man en klass utav det.



Skapa ett objekt {#skapa-ett-objekt}
------------------------------

Låt oss gå igenom hur man skapar ett bil-objekt, "Car". För enkelhetens skull hoppar jag över docstrings i artikeln. Ett klass-objekt skapas med:  

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
>>> bmw = Car("BMW", 100000)
```

Nu har vi skapat en instans av klassen Car med 4 hjul, märket BMW och med ett pris på 100.000. Vi kan även skapa fler instanser från samma klass:

```python
>>> volvo = Car("Volvo", 150000)
```

Vi testar att skriva ut objekten:

```python
>>> print(bmw)
<__main__.Car object at 0x7f824cc7b4e0>

>>> print(volvo)
<__main__.Car object at 0x7f824cc7b4a8>

>>> print("Antal bilar: {antal}".format(antal=Car.carCount))
Antal bilar: 2
```

Det ser ju bra ut. Två instanser av "Car" som inte refererar till samma minnesplats. Vi ser också att räknaren fungerar.

För att nå medlemsvariablerna använder man så kallad "dot-notation". Vi provar.

```python
>>> print(bmw.wheels)
4

>>> print(bmw.model)
BMW

>>> print(bmw.price)
100000
```

"bmw" är en instans av Car så om vi ändrar attributet `wheels` i efterhand, så ändras den för alla objekt skapade från klassen:

```python
>>> print(bmw.wheels)
4

>>> Car.wheels = 12

>>> print(bmw.wheels)
12
```

För att instanserna ska äga variablerna kan man flytta tex `wheels` till __init__-metoden. Då äger instanserna ett eget attribut och påverkas inte om man ändrar i basklassen:

```python
class Car():
    carCount = 0

    def __init__(self, model, price):
        self.model = model
        self.price = price
        self.wheels = 4

        Car.carCount += 1
```

För stunden kan vi ha kvar `wheels` som statisk variabel. Alla våra bilar ska ha 4 hjul.



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
>>> bmw.presentCar()
Model: BMW, Price: 100000

>>> volvo.presentCar()
Volvo, Price: 150000
```



###Statiska metoder {#statiska-metoder}

En metod i ett klassobjekt använder oftast parametern _self_ och tillhör därför varje instans. Vill man ha en mer generell metod som inte behöver vara enskilt beroende utav
instanserna kan man använda _statiska metoder_. Det är metoder som används av klassen men utför inget direkt mot dess egna variabler. Vi lägger till en metod som räknar ut priset när man kört ut från bilfirman, samt en metod som använder den:

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

    @staticmethod
    def calculatePriceReduction(aPrice):
        return int(aPrice * 0.66)

    def reducePrice(self):
        self.price = self.calculatePriceReduction(self.price)
        return "Priset för {c} är nu {p}".format(c=self.model, p=self.price)
```

Som du ser agerar metoden oberoende av resten av klassen. **@staticmethod** gör att python inte behöver instansiera en bunden metod för varje instans av klassen, samt att det är enkelt att se för andra vad som händer. Vi testar att använda den:

```python
>>> bmw = Car("BMW", 100000)

>>> print( bmw.reducePrice() )
Priset för BMW är nu 66000
```



###En lista som medlemsvariabel {#en-lista-som-medlem}

Vi lägger till en lista som ska innehålla information om övrig utrustning. Vi initierar klassen med en tom lista och en metod som lägger till saker och en utskriftsmetod.

```python
class Car():
    wheels = 4
    carCount = 0

    def __init__(self, model, price):
        self.model = model
        self.price = price
        self.equipment = []

        Car.carCount += 1

    def presentCar(self):
        print("Model: {m}, Price: {p}".format(m=self.model, p=self.price))

    @staticmethod
    def calculatePriceReduction(aPrice):
        return int(aPrice * 0.66)

    def reducePrice(self):
        self.price = self.calculatePriceReduction(self.price)
        return "Priset för {c} är nu {p}".format(c=self.model, p=self.price)

    def addEquipment(self, newEquipment):
        self.equipment.append(newEquipment)

    def printEquipment(self):
        for eq in self.equipment:
            print("* " + eq)
```

Nu kan vi lägga till utrustning:

```python
>>> volvo = Car("Volvo", 150000)
>>> volvo.addEquipment("Bluetooth")
>>> volvo.addEquipment("7 inch display")

>>> volvo.printEquipment()
* Bluetooth
* 7 inch display
```



<!-- ###Privata medlemsvariabler {#privata-medlemsvariabler}

För att komma åt ett objekts medlemsvariabler använder vi **dot-notation**. Vill man däremot inte att någon annan än den egna instansen ska kunna komma åt variablerna kan man göra dem _privata_. Det gör man med `_` innan variabeln. Låt oss titta på hur det ser ut och fungerar. Vi skapar en klass med en publik och en privat instans-variabel:

```python
class Test_private():

    def __init__(self):
        self.publicMember = "publik"
        self._privateMember = "privat"

    def printPublic(self):
        print(self.publicMember)

    def printPrivate(self):
        print(self._privateMember)
```

Nu ser du att vi även har två metoder som skriver ut respektive variabel. Det är instansen som äger dem båda, även den privata, och kan således hantera dem:

```python
>>> test = Test_private()

>>> test.printPublic()
publik

>>> test.printPrivate()
privat
```

Om vi testar att nå variablerna utanför...

```python
>>> test = Test_private()

>>> print( test.publicMember )
publik

>>> print( test.__privateMember )
AttributeError: 'Test_private' object has no attribute '__privateMember'
```

...så får vi ett felmeddelande som talar om för oss att objektet inte har det attributet. Bra. Att använda privata variabler och metoder kan lämpa sig bra i till exempel en arvskedja eller för att visa andra utvecklare att de inte ska peta på de variablerna eller metoderna. -->



###Operatoröverlagring {#operatoroverlagring}

Operatorer inom programmering (`+, -, *, /, <, >` med flera), har ett förutbestämt syfte. Om vi skulle vilja använda dem för något eget syfte istället kan vi använda oss av **operatoröverlagring**. Låt säga att vi vill kunna addera våra bil-objekt och få reda på det sammanlagda priset. Först testar vi rakt av:

```python
>>> print( bmw + volvo )
TypeError: unsupported operand type(s) for +: 'Car' and 'Car'
```

Det gick inte så bra. `+`-operatorn vill ju ha siffror och inte objekt. Vi lägger till en metod som överlagrar operatorn i klassen:

```python
class Car():
    wheels = 4
    carCount = 0

    def __init__(self, model, price):
        self.model = model
        self.price = price
        self.equipment = []

        Car.carCount += 1

    def presentCar(self):
        print("Model: {m}, Price: {p}".format(m=self.model, p=self.price))

    @staticmethod
    def calculatePriceReduction(aPrice):
        return int(aPrice * 0.66)

    def reducePrice(self):
        self.price = self.calculatePriceReduction(self.price)
        return "Priset för {c} är nu {p}".format(c=self.model, p=self.price)

    def addEquipment(self, newEquipment):
        self.equipment.append(newEquipment)

    def printEquipment(self):
        for eq in self.equipment:
            print("* " + eq)

    def __add__(self, other):
        return self.price + other.price
```

Vi använder `__` före och efter metoden, `__<method>__`, och skickar in ett annat objekt kallat _other_ som parameter. Vi testar igen:

```python
>>> print( bmw + volvo )
250000
```

Det går även att överlagra `+=`, genom att göra en egen `__iadd__` funktion. Vi kollar på det.

```python
class Car():
    wheels = 4
    carCount = 0

    def __init__(self, model, price):
        self.model = model
        self.price = price
        self.equipment = []

        Car.carCount += 1

    def presentCar(self):
        print("Model: {m}, Price: {p}".format(m=self.model, p=self.price))

    @staticmethod
    def calculatePriceReduction(aPrice):
        return int(aPrice * 0.66)

    def reducePrice(self):
        self.price = self.calculatePriceReduction(self.price)
        return "Priset för {c} är nu {p}".format(c=self.model, p=self.price)

    def addEquipment(self, newEquipment):
        self.equipment.append(newEquipment)

    def printEquipment(self):
        for eq in self.equipment:
            print("* " + eq)

    def __add__(self, other):
        return self.price + other.price

    def __iadd__(self, other):
        self.price += other.price
        return self

bmw += volvo
print(bmw.price)
250000
```

I `__iadd__` ändrar vi värder på `price` och returnerar `self` istället för värdet. `bmw += volvo` kan även visualiseras som `bmw = bmw.__iadd__(volvo)`. Med andra ord tilldelar vi `bmw` variabeln samma objekt som den redan hade.


Nuså. Samma koncept gäller för övriga operatorer och kan vara behändigt vid hantering av objekt av olika slag.



Avslutningsvis {#avslutning}
------------------------------

Det här var en introduktion till hur man skapar egna klasser. Toppen på isberget. Vill du lära dig mer på en gång kan du läsa på lite djupare om objekt och klasser:  

1. [docs.python.org](https://docs.python.org/3.4/tutorial/classes.html#)  
2. [tutorialspoint](http://www.tutorialspoint.com/python/python_classes_objects.htm)
