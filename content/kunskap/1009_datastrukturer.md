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

Man använder sig oftast av en särskild uppsättning metoder:  
1. .push() (Lägger till)  
2. .pop() (Tar bort)  
3. .peek() (Visar vad som ligger överst utan att ändra i stacken)  
4. .isEmpty() (Returnerar True/False beroende på om stacken är tom)  
5. .size() (Returnerar antal element i stacken)

[FIGURE src=/image/oopython/kmom05/stack_explained.png caption="En Stack med specifierat antal platser."]

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
        try:
            return self.items.pop()
        except IndexError:
            return "Empty list."

    def peek(self):
        return self.items[len(self.items)-1]

    def size(self):
        return len(self.items)
```

Att arbeta med stacken kan gå till så här:
```python
>>> from stack import Stack
>>> myList = Stack()
>>> myList.push(3)
>>> myList.push(19)
>>> myList.push(5)
>>> myList.peek()
5
>>> myList.pop()
5
>>> myList.peek()
19
>>> myList.size()
2
>>> myList.isEmpty()
False
>>> myList.pop()
19
>>> myList.pop()
3
>>> myList.pop()
'Empty list.'
>>> myList.size()
0
```



Queue {#queue}
------------------------------

[FIGURE src=/image/oopython/kmom05/queue.png?w=c5 class="right"]

En **Queue** (kö) är en abstrakt datastruktur som påminner om en Stack. Skillnaden är att en Kö är öppen i båda ändar. Den ena änden används för att lägga till element och den andra för att ta bort element. Arbetsättet kallas "FIFO" (First In First Out).


Metoderna som används är vanligtvis:  
1. .enqueue() (Lägger till)  
2. .dequeue() (Tar bort)  
3. .peek() (Visar vad som ligger överst utan att ändra i kön)  
4. .isEmpty() (Returnerar True/False beroende på om kön är tom)  
5. .size() (Returnerar antalet element i kön)

[FIGURE src=/image/oopython/kmom05/queue_explained.png caption="En Queue med specifierat antal platser."]

En implementation av en Queue kan se ut som följer:  
```python
class Queue:
    def __init__(self):
        self.items = []

    def isEmpty(self):
        return self.items == []

    def enqueue(self, item):
        self.items.insert(0,item)

    def dequeue(self):
        try:
            return self.items.pop()

        except IndexError:
            return "Empty list."

    def peek(self):
        return self.items[len(self.items)-1]

    def size(self):
        return len(self.items)

```

Att arbeta med en Queue:
```python
>>> from queue import Queue
>>> myList = Queue()
>>> myList.isEmpty()
True
>>> myList.enqueue("Tiger")
>>> myList.enqueue("Lion")
>>> myList.enqueue("Moose")
>>> myList.isEmpty()
False
>>> myList.dequeue()
'Tiger'
>>> myList.peek()
'Lion'
>>> myList.enqueue("Godzilla")
>>> myList.dequeue()
'Lion'

```



Avslutningsvis {#avslutning}
------------------------------

Bra finish, länka till forumtråd eller liknande?
