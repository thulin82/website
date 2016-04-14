---
author: lew
revision:
    "2016-04-12": (PA, lew) Pre-release.
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

Unittester skrivs som sagt av anledningen att minimera risken för "trasig" kod och för att validera funktionaliteten. I många lägen handlar det inte bara om att enbart du ska förstå koden, utan det kan finnas andra utvecklare som tar över ditt projekt eller bara ska hjälpa till. Då är det bra om det är testat ordentligt. Har man bra tester som går igenom så har man bra kod.



###Pythons testramverk {#pythons-testramverk}

Python kommer med ett inbyggt modul, ett ramverk kallat "unittest". Inspirationskällan till det kommer från Javans [JUnit](http://junit.org/junit4/). Vi ska framför allt titta på basklassen "TestCase" som tar hand om enskilda tester på metoder och funktioner.



###Kom igång med ett unittest {#kom-igang-med-ett-unittest}

Vi utgår ifrån klassen _Car_ som vi skapade i artikeln "[Kom igång med objekt](kunskap/kom-igang-med-objekt)". I samma mapp skapar vi en fil som vi döper till **testfile.py**. Det är den filen vi skriver våra unittester i. Testerna kör man med:

 ```python
 >>> python3 testfile.py
 ```

Dåså. Vi tittar på grundstrukturen i _testfile.py_:

```python
#!/usr/bin/env python3

import unittest

class Testcase(unittest.TestCase):
    # skriv testerna här


if __name__ == '__main__':
    unittest.main()
```

Vi importerar modulen och skapar en subklass av _unittest.TestCase_. blocket med _unittest.main()_ kör igång ett interface för testscriptet och producerar en bra utskrift.

Ett enkelt test på den inbyggda funktionen **.upper()** kan se ut så här:

```python
#!/usr/bin/env python3

import unittest

class Testcase(unittest.TestCase):

    def test_upper(self):
        self.assertEqual('programmering'.upper(), 'PROGRAMMERING')

if __name__ == '__main__':
    unittest.main()
```

Vi använder metoden _assertEqual_ för att jämföra om två värden är lika. Följande tabell är hämtad från [docs.python.org](https://docs.python.org/3/library/unittest.html) och visar överskådligt de vanligaste typerna av unittester.


| Method                    |        Checks that   |
|---------------------------|:---------------------|
| assertEqual(a, b)	        | a == b	           |
| assertNotEqual(a, b)	    | a != b	           |
| assertTrue(x)	            | bool(x) is True	   |
| assertFalse(x)	        | bool(x) is False	   |
| assertIs(a, b)	        | a is b               |
| assertIsNot(a, b)	        | a is not b           |
| assertIsNone(x)	        | x is None            |
| assertIsNotNone(x)	    | x is not None        |
| assertIn(a, b)	        | a in b               |
| assertNotIn(a, b)	        | a not in b           |
| assertIsInstance(a, b)	| isinstance(a, b)     |
| assertNotIsInstance(a, b)	| not isinstance(a, b) |

Om vi nu kör test-filen får vi utskriften:

```python
>>> python3 testfile.py
.
----------------------------------------------------
Ran 1 test in 0.000s

OK


>>> python3 testfile.py -v
test_upper (__main__.Testcase) ... ok

----------------------------------------------------------------------
Ran 1 test in 0.000s

OK
```

Med flaggan **-v** ser vi att vi får en tydligare utskrift, där testena skrivs ut med. Det fungerar bara om man döper testmetoderna med "test_" i början. Det är trevligt med fina utskrifter så vi kör vidare på det.



###Unittesta objekt {#unittesta-objekt}

Nu är det dags att titta på hur vi skriver några unittester för vår klass, **Car**. Klassen ligger i filen `car.py`.

Vi öppnar `testfile.py` och fyller på med lite kod. Med hjälp av _doc-strings_ får vi ännu bättre utskrifter:

```python
#!/usr/bin/env python3

import unittest
from car import Car

class Testcase(unittest.TestCase):
    bmw = Car("BMW", 100000)
    volvo = Car("Volvo", 150000)

    def test_if_objects_are_same(self):
        """ Returns True if a and b are not same """
        self.assertIsNot(self.bmw, self.volvo)

if __name__ == '__main__':
    unittest.main()
```



Större rubrik igen {#dontForgetId}
------------------------------

Ascinema länk:

[ASCIINEMA src=37763]



###Överkurs {#overkurs}

Text...



Avslutningsvis {#avslutning}
------------------------------

Bra finish, länka till forumtråd eller liknande?
