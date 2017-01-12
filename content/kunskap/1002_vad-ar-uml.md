---
author: aar
revision:
    "2016-04-19": (A, aar) Första versionen.
category:
    - oopython
...
Vad är UML?
===================================

[FIGURE src=/image/oopython/kmom02/uml_diagrams.png?w=c5 class="right"]

UML står för Unified Modeling Language, det är ett visuellt modelleringsspråk för att specificera, konstruera och dokumentera artefakter i ett system.  
Det brukar användas på tre sätt:

1. Som en sketch: Informell och ofta inte fullständig, hand sketch eller på whiteboard. Används för att utforska problem.
2. Som en ritning: Används för 1) reverse engineering, för att förstå existerande kod. 2) För att se hur ny kod ska genereras.
3. Som ett programmeringsspråk: Det finns färdiga verktyg som genererar kod baserat på UML.

Vi kommer gå igenom två av diagrammen, Class diagram och Sequence diagram.

<!--more-->



Förutsättning {#pre}
-------------------------------

Du kan grunderna i objektorienterad programmering, arv, komposition och aggregation.



Terminologi {#terminologi}
-------------------------------

* **UML**: Unified modeling language.

* **Struktur diagram**: Structure diagram på engelska. Statisk representation av strukturen i ett system.

* **Beteende diagram**: Behaviour diagram på engelska. Dynamisk bild av systemet som visar vad som händer i systemet.

* **Reverse engineering**: att ta fram detaljerade ritningar och specifikationer på hur en produkt fungerar.

##Struktur diagram {#struktur_diagram}


Struktur diagram representerar strukturen, de statiska aspekterna, i ett system och visar upp artefakter som måste existera i systemet och hur de relaterar till varandra.
De statiska delarna representeras av klasser, gränssnitt, komponenter och noder. Det är ett sätt att dokumentera architekturen.  
Det vanligaste struktur diagrammet är _class diagram_.


###Class diagram {#class}


Class diagram representerar den objektorienterade vyn av ett system. Det visar upp systemets klasser, deras attributer, metoder och relationen mellan klasserna.

En klass i ett class diagram representeras med en ruta som är indelad i tre fack:

* I den översta rutan står klassnamnet, centrerat med stor första bokstav.
* Mittenfacket innehåller klassens attribut.
* Nedersta facket innehåller klassens metoder.

[FIGURE src=/image/oopython/kmom02/diagrams/bankAccount.png caption="En klass som representerar ett bankkonto."]

Attribut måste åtminstone visas med namnet men det kan även stå med vilken datatyp de har, som i bilden ovan. Bilden visar även om de är publika eller privata:

* \+ Betyder publikt attribut.

* \- Betyder privat attribut.

* <u>variabelnamn</u> Betyder att attributet är statiskt. Gäller även för understrukna metodnamn

För metoder måste man skriva med namnet, det är att föredra att även visa parametrar och returtyp som bilden ovan. Det funkar likadant för metoder och attribut med +- för privata/publika.

**Relationer**

Klasser har relationer, t.ex. arv, komposition och aggregation, detta ska visas i diagrammet. För att visa relationer används olika sorters pilar mellan klasserna. Tillsammans med de pilarna använder man positiva tal och
asterisks(**\***), betyder oändligt, för att visa antalet instanser av varje klass som kan vara sammankopplade. Antalet visas som en intervall [minimum..maximum].

[FIGURE src=/image/oopython/kmom02/diagrams/book-chapter_diagram.png caption="Komposition mellan Book och Chapter."]

Ovanför kan vi se en **kompositions** relation mellan klassen Book och Chapter. En kompositions relation visas som en linje med en svart ifylld diamant i ena änden mellan två klasser. Diamanten sitter vid den _ägande_ klassen. Book _äger_ Chapter, en Book kan innehålla noll eller oändligt med Chapters. Ett Chapter kan bara vara kopplat till en Book.

[FIGURE src=/image/oopython/kmom02/diagrams/Pond-Duck.png caption="Aggregation mellan Pond och Duck."]

Bilden ovanför innehåller en **aggregations** relation mellan klassen Pond och Duck. En aggregations relation ser ut som en kompositions relation förutom att det är en tom diamant istället för ifylld.
En Pond kan innehålla noll eller oändligt med Ducks. En Duck kan vara i en Pond eller ingen Pond.

[FIGURE src=/image/oopython/kmom02/diagrams/arv_diagram.png caption="Arvs-hierarki med Species, Animal, dog och Human."]

Bilden ovan visar **arvs-relation** med en arvshierarki. Arv visas med en pil från subklassen till basklassen. Dog ärver av Animal som i sin tur ärver av Species som även Human äver av.

Ett exempel på arv och komposition:

[FIGURE src=/image/oopython/kmom02/diagrams/fullExample_class.png caption="Arv och komposition med Customer och Order"]

En Customer kan ha noll till oändligt många Orders. En Order kan bara tillhöra en Customer. Order är en basklass för specialOrder och NormalOrder.




##Beteende diagram {#beteende_diagram}


Beteende diagram visar det dynamiska beteendet ett system har och beskriver systemets funktionalitet.


###Sequence diagram {#sequence_diagram}


[FIGURE src=/image/oopython/kmom02/diagrams/restaurant.png caption="Simpelt sequence diagram av en restaurang"]

Sequence diagram visar hur olika processer kommunicerar med varandra inom en tidssekvens och i vilken ordning. Med process syftar man oftast på objekt som kommunicerar via metoder.
Det är viktigt med ordningen av kommunikationen mellan objekten och när det händer på tidslinjen.

Med sequence diagram kan vi visa vilka klasser som finns/behövs i ett system och vilka metoder de använder för att kommunicera med varandra för att uppfylla ett scenario.  
Om vi tittar på bilden ovanför, sequence diagrammet med restaurangen. Den visar vilka människor(klasser/objekt) som behövs och hur de kommunicerar för att en kund ska kunna äta mat hos dem.


[FIGURE src=/image/oopython/kmom02/diagrams/lifeLines.png caption="Actor lifeline och Objekt lifeline"]

Här ser vi två stycken **lifelines** en som representerar en Actor och en som representerar ett anonymt objekt av klassen Object.
Objekt lifelines består av en rektangel i toppen som innehåller klassens namn, med ":" framför, och en vertikal linje, linjen representerar objektets livstid.  
För att specificera vilken instans av en klass som ska användas lägger man till instansens namn framför ":", t.ex. "Andreas:Person". Det visar att objektet Andreas, som är en instans av klassen Person, ska användas specifikt.

[FIGURE src=/image/oopython/kmom02/diagrams/syncCall.png caption="Ett funktionsanrop"]

Så här ser ett funktionsanrop ut. Den svarta ifyllda pilen motsvarar ett synkront funktionsanrop, t.ex. en klass X anropar klass Y's funktion doA, som startat exekveringen av funktionen doA hos klass Y.
Tiden det tar för Y att exekvera doA representeras av den vertikala stången. När doA är klar returnerar den ett resultat tillbaka till X, det representeras med den streckade pilen.

[FIGURE src=/image/oopython/kmom02/diagrams/bookRegisterSeq.png]

Ett simpelt sequence diagram för att registrera en bok. Klassen Handler anropar BookRegister's funktion registerBook(), som tar ett ISBN nummer som argument. Funktionen exekveras och returnerar true

[FIGURE src=/image/oopython/kmom02/diagrams/loopImg.png caption="Sequence diagram med loop"]

Bilden ovan visar en kassörska som använder affärens sälj-system för att behandla en ny kund. Hon börjar med att starta en ny transaktion. Hon registrerar alla produkter som kunde ska köpa, detta sker i **loop**.
För varje produkt kunden vill köpa kommer kassörskan slå in produkten och systemet kommer returnera summan av vad kunden har handlat än så länge. När alla produkter är inslagna i systemet slår kassörskan in betalningen och sista avslutar hon transaktionen.  
Det som händer inuti **loop** rutan kommer upprepas X antal gånger. Om man vill specificera att det ska upprepas t.ex. 10 gånger ersätter man "loop" uppe i vänstra hörnet med "loop(10)".

[FIGURE src=/image/oopython/kmom02/diagrams/if_self_img_seq.png caption="Sequence diagram med if-sats"]

Vi har lagt till en if-sats som kollar att kunden har tillräckligt med pengar för att köpa alla produkter. Om det var tillräckligt med pengar avlsutas transaktionen som den ska annars avbryts transaktionen och alla produkter återlämnas.



Avslutningsvis {#avslutning}
------------------------------

Det finns bra verktyg online för att rita uml diagram, kolla in [draw.io](https://www.draw.io) och [websequencediagrams](https://www.websequencediagrams.com/).

För att läsa mer om class diagram kolla här: [class diagrams](http://www.uml-diagrams.org/class-diagrams-overview.html).

För att läsa mer om sequence diagram och vad man mer kan göra med dem kolla här: [sequence diagrams](http://www.uml-diagrams.org/sequence-diagrams.html).
