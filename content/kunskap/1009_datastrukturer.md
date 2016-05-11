---
author: lew
revision:
    "2016-04-12": (PA, lew) Pre-release.
category:
    - python
...
Datastrukturer
===================================

[FIGURE src=/image/snapvt16/python-list-shopping.png?w=c5&a=0,75,75,0 class="right"]

Inom programmering pratar man om 'datastrukturer' när det handlar om att organisera data på olika sätt. Det är en abstrakt beskrivning till skillnad från 'datatyper'. En datatyp kan vara exempelvis Integer eller Sträng. Det har en fast betydelse medan en datastruktur beskriver något _odefinierbart_, exempelvis en lista i Python.

<!--more-->

I artikeln kommer det tas upp tre olika datastrukturer.  
* Stack  
* Kö (Queue)  
* Länkad lista  



Förutsättning {#pre}
-------------------------------

Du kan grunderna i Python och du vet vad variabler, typer och funktioner innebär.



Stack {#stack}
------------------------------

[FIGURE src=/image/oopython/kmom05/stack.jpg?w=c5 class="right"]

En **Stack** är en linjär datastruktur som påminner om, precis som det låter, en trave eller stapel. Tänk dig en stapel med tallrikar där en tallrik representerar ett objekt, variabel eller vad det nu är man lagrar. För att hantera "insättning och uttag" arbetar man från toppen. Arbetsättet kallas "LIFO" (Last In First Out). En Stack innehåller samma datatyp.

Man använder sig oftast av en liten uppsättning metoder:  
1. .push() (Lägger till)  
2. .pop() (Tar bort)  
3. .peek() (Visar vad som ligger överst utan att ändra i stacken)  

[FIGURE src=/image/oopython/kmom05/stack_explained.png caption="Förklaring av en Stack."]

En implementation av en Stack kan se ut som följer:  
```python
class Stack:
    def __init__(self):
        self.items = []

    def isEmpty(self):
        return self.items == []

    def push(self, item):
        self.items.append(item)

    def pop(self):
        return self.items.pop()

    def peek(self):
        return self.items[len(self.items)-1]

    def size(self):
        return len(self.items)
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
