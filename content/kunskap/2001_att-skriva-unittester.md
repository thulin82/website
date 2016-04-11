---
author: Kenneth
published: 2016-03-21
category:
    - python
...
Att skriva unittester
===================================

[FIGURE src=/image/snapvt16/python-list-shopping.png?w=c5&a=0,75,75,0 class="right"]

Unittester, eller "enhetstester", används för att testa så enskilda metoder eller funktioner gör det de ska. Till exempel om en metod ska returnera bool-värdet `True`, så ska den aldrig kunna returnera `False`.  

Det var det enklaste fallet av ett unittest, men poängen går nog fram.

Vi ska titta lite närmare på de olika delarna av pythons inbyggda test-ramverk "unittest". Vi hoppar inte i den djupa delen av bassängen, utan vi håller oss vid det grundläggande delarna.  
Vill du läsa mer kan du kika på [docs.python.org](https://docs.python.org/3/library/unittest.html).

<!--more-->



Förutsättning {#pre}
-------------------------------

Du kan grunderna i Python och du vet vad variabler, typer och funktioner innebär.



Varför ska man skriva unittester? {#varfor-ska-man-skriva-unittester}
------------------------------

Unittester skrivs som sagt av anledningen att minimera risken för "trasig" kod. I många lägen handlar det inte bara om att enbart du ska förstå koden, utan det kan finnas andra utvecklare som tar över ditt projekt eller bara ska hjälpa till. Då är det bra om det är testat ordentligt. På ett sätt är det endast då man har ryggen fri vid eventuella fel.



###Pythons testramverk {#pythons-testramverk}

Python kommer med ett inbyggt modul, ett ramverk kallat "unittest". Inspirationskällan till det kommer från Javans [JUnit](http://junit.org/junit4/). Vi ska framför allt titta på basklassen "TestCase" som tar hand om enskilda tester på metoder och funktioner.



###Kom igång med ett unittest {#kom-igang-med-ett-unittest}





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
