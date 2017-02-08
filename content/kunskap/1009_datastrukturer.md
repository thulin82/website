---
author: lew
revision:
    "2017-02-08": (A, lew) First version.
category:
    - oopython
...
Datastrukturer
===================================

[FIGURE src=/image/oopython/kmom05/datastructure_top.png?w=c5 class="right"]

Inom programmering är en 'datastruktur' en struktur för att organisera data. Valet av datastruktur är viktigt då de har olika betydelse för prestanda och presterar olika beroende på vilka algoritmer som har planerats att användas. En datastruktur är en abstrakt beskrivning till skillnad från 'datatyper'. En datatyp kan vara exempelvis _Integer_, _String_ eller _boolean_. Det har en fast betydelse medan en datastruktur beskriver något _odefinierbart_, till exempel en lista eller array.

<!--more-->

Det finns många olika datastrukturer i olika kategorier. Vi har "Linjära datastrukturer" (Lista, Stack, Kö, etc.). En annan struktur-kategori som har en stor plats inom programmering är "Träd". De är lite mer komplexa än till exempel en Stack. Vi ska gå igenom en typ av träd, en så kallad "Max Heap".  

Många datastrukturer finns redan inbyggda i programmeringsspråken (tex lista i Python) och det finns färdiga moduler och bibliotek som har strukturen implementerad och klar. Det är dock viktigt att ha en insikt i hur de fungerar "på insidan".

I artikeln kommer det tas upp tre olika datastrukturer.  
* Stack (Linjär datastruktur)  
* Kö (Linjär datastruktur)  
* Max Heap (Träd)



Förutsättning {#pre}
-------------------------------

Du kan grunderna i Python och du vet vad variabler, typer och funktioner innebär.



Stack {#stack}
------------------------------

[FIGURE src=/image/oopython/kmom05/stack.jpg?w=c5 class="right"]

En **Stack** är en linjär datastruktur som påminner om, precis som det låter, en trave eller stapel. Tänk dig en stapel med tallrikar där en tallrik representerar ett objekt, variabel eller vad det nu är man lagrar. För att hantera "insättning och uttag" arbetar man från toppen. Arbetssättet kallas "LIFO" (Last In First Out). En Stack innehåller samma datatyp.

Man använder sig oftast av en särskild uppsättning metoder:  
1. .push() (Lägger till)  
2. .pop() (Tar bort)  
3. .peek() (Visar vad som ligger överst utan att ändra i stacken)  
4. .is_empty() (Returnerar True/False beroende på om stacken är tom)  
5. .size() (Returnerar antal element i stacken)

[FIGURE src=/image/oopython/kmom05/stack_explained.png caption="En Stack med specifierat antal platser."]

En implementation av en Stack kan se ut som följer:  
```python
class Stack:
    def __init__(self):
        self.items = []

    def is_empty(self):
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
>>> myList.is_empty()
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

En **Queue** (kö) är en linjär datastruktur som påminner om en Stack. Skillnaden är att en Kö är öppen i båda ändar. Den ena änden används för att lägga till element och den andra för att ta bort element. Arbetssättet kallas "FIFO" (First In First Out).

Metoderna som används är vanligtvis:  
1. .enqueue() (Lägger till)  
2. .dequeue() (Tar bort)  
3. .peek() (Visar vad som ligger överst utan att ändra i kön)  
4. .is_empty() (Returnerar True/False beroende på om kön är tom)  
5. .size() (Returnerar antalet element i kön)

[FIGURE src=/image/oopython/kmom05/queue_explained.png caption="En kö utan specifierat antal platser."]

En implementation av en Queue kan se ut som följer:  
```python
class Queue:
    def __init__(self):
        self.items = []

    def is_empty(self):
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
>>> myList.is_empty()
True
>>> myList.enqueue("Tiger")
>>> myList.enqueue("Lion")
>>> myList.enqueue("Moose")
>>> myList.is_empty()
False
>>> myList.dequeue()
'Tiger'
>>> myList.peek()
'Lion'
>>> myList.enqueue("Godzilla")
>>> myList.dequeue()
'Lion'
```



Heap {#heap}
------------------------------

Heap tillhör struktur-kategorin "Träd". Tänk dig en trädliknande struktur:  

[FIGURE src=/image/oopython/kmom05/heap1.png caption="Max heap."]

Varje cirkel representeras av en nod (Node) som har koll på sina föräldrar. Noden "30" vet exempelvis att föräldern "75" är större osv. Lägger man till ett nytt värde hamnar det längst ner i det vänstra benet. Där jämförs det med sin förälder. Är det nya värdet mindre så blir det ett barn till den föräldern. Är det nya värdet större kommer barnet ta förälderns plats och en ny jämförelse sker på nästa förälder. På så sätt kommer alltid det största värdet vara i toppen, i "roten". Man fyller på med nya värden på den första lediga platsen. Man jobbar för att hålla trädet med så få nivåer som möjligt. Det hänger såklart på vilka värden man stoppar in och när.

###Lägga till {#lagga-till}  

Stegen som tas för att lägga till värden är:  
1. Lägg till element i den lägsta nivån.  
2. Jämför värdet med föräldern. Är föräldern större, stanna.  
3. Annars byt plats på dem och upprepa steg 2.

Vi lägger till värdet "80":  

[FIGURE src=/image/oopython/kmom05/heap2.png]

80 är större än sin förälder, 30. De ska då byta plats:  

[FIGURE src=/image/oopython/kmom05/heap3.png]  

Samma gäller för nästa förälder. 80 är större än 75, så de ska byta plats:  

[FIGURE src=/image/oopython/kmom05/heap4.png]  

Såja. Nu ligger det nya värdet på rätt plats. Lägger vi till ett nytt värde nu så hamnar det till vänster under noden "10". Det har skett en så kallad "inplace"-sortering.



###Ta bort värde {#ta-bort-varde}  

När man extraherar ett värde från heapen tar man alltid roten, i detta fallet det största då det är en max-heap.  

Stegen som tas för att ta bort ett värde är:  
1. Byt ut roten mot sista elementet på den sista nivån.  
2. Jämför den nya roten med sina barn. Är barnen mindre, stanna.  
3. Annars byt plats med det största barnet och upprepa steg 2. (Byt med minsta barnet i en min-heap)  

Vi tittar på hur det kan se ut:  

[FIGURE src=/image/oopython/kmom05/heap5.png]  

30 är mindre än båda sina barn så vi byter plats med det största barnet:  

[FIGURE src=/image/oopython/kmom05/heap6.png]  

Ett barn är mindre så vi skiftar plats:  

[FIGURE src=/image/oopython/kmom05/heap7.png]

Nu håller trädet måttet för att kallas en max-heap. Om vi skulle haft en min-heap istället hade det varit det minsta värdet i roten.  



Avslutningsvis {#avslutning}
------------------------------

Det finns som sagt många sorters datastrukturer. För en lista kan du kika på: [List of datastructures](https://en.wikipedia.org/wiki/List_of_data_structures). Här har vi tagit upp tre utav de vanligaste. Hoppas du har fått en liten insikt i hur de fungerar.
