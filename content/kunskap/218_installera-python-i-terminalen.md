---
author: mos
category: python
revision:
  "2016-02-22": (B, mos) Modifierad med nya videor och flyttade IDLE och python på
    studservern till egna tips.
  "2015-08-25": (A, mos) Flyttad från [äldre artikel](kunskap/installera-en-labbmiljo-till-python)
    i tidigare utgåva av python.
updated: "2016-02-22 11:38:24"
created: "2015-08-25 11:40:37"
...
Installera Python i terminalen
==================================

[FIGURE src=/image/snapht15/python-logo.png?w=c5 class="right"]

Denna artikel visar hur du kommer igång och installerar python i terminalen.

<!--more-->



Förutsättning {#pre}
-------------------------------

Artikeln är en del av kursen python och förutsätter att du har en motsvarande [labbmiljö](python/labbmiljo) installerad.



Installera Python i terminalen {#terminal}
-------------------------------

Ett vanligt sätt att utveckla med Python är att ha det installerat och tillgängligt via terminalen. Det är det alternativet som vi kommer att jobba med under kursens gång.

Installera nu Python version 3 (python3) i din terminal.

Cygwin på Windows:

```bash
apt-cyg install python3
```

Mac OS:

```bash
brew install python3
```

Linux (debian):

```bash
apt-get install python3
```

Testa att det gick bra genom att skriva kommandot `python3` i terminalen. Du är nu i interpretatorn för Python. Det kan se ut så här:

```python
$ python3                                  
Python 3.3.3 (default, Jan  2 2014, 19:09:02)                            
[GCC 4.8.2] on linux                                                     
Type "help", "copyright", "credits" or "license" for more information.   
>>> print("Hello World")                                                 
Hello World                                                              
>>> 40+2
42
>>>                                                                   
```

*$-tecknet ovan representerar prompten och är inte en del av kommandot.*

Tryck CTRL-D för att avsluta programmet och återgå till terminal-prompten. Eller anropa funktionen [`exit()`](https://docs.python.org/3/library/constants.html?highlight=exit#exit). Allt du skriver i interpretatorn tolkas som Python-kod. Skriver du rätt körs koden annars får du ett felmeddelande.

Nu har du Python på din dator.

Kika kort på Kenneth när han visar hur du använder Python i terminalen och tillsammans med en texteditor.

[YOUTUBE src=dRZF1Crf1wg width=630 caption=Kenneth kör Python i terminalen.]

[YOUTUBE src=LokzBtJ-ssY width=630 caption=Kenneth kör Python via editor, fil och terminal.]



Terminalen eller grafiska utvecklingsverktyg {#gui}
-------------------------------

I kursen använder vi terminalen och Atom som utvecklingsverktyg för Python. Men, det finns andra typer av utvecklarverktyg som kan upplevas mer integrerade. I forumet finns en [tråd som föreslår något alternativ](t/5156).

Mitt förslag är att du vänjer dig vid terminalen och Atom, det är en kraftfull kombination som håller i längden.



Resurser och manualer {#resurser}
-------------------------------

När det gäller dokumentation så försöker vi hålla oss till [dokumentationen via den officiella webbplatsen](https://www.python.org/doc/) och dess resurser så långt det går. Vi använder framförallt dokumentation av Python 3 som bas.

Bekanta dig med [dokumentationen för Python 3](https://docs.python.org/3/) på webbplatsen. Titta speciellt på följande:

* [The Python Tutorial](https://docs.python.org/3/tutorial/index.html)
* [The Python Standard Library](https://docs.python.org/3/library/index.html)

Pröva att använda sökfunktionen.

Detta är källan till din kunskap i Python. Bli vän med manualen och återvänd dit när du har funderingar.



Python 2 eller Python 3 {#py23}
-------------------------------

Python finns i många versioner men det finns en liten större skillnad mellan Python 2 och Python 3. I de flesta operativsystem är det fortfarande version 2 som används när man skriver `python`. Man behöver explicit skriva `python3` för att använda version 3.

Du kan läsa om [skillnaderna mellan Python 2 och Python 3](https://wiki.python.org/moin/Python2orPython3). I denna kursen använder vi Python 3.

I vissa av böckerna, och resten av kursmaterialet, så kan det finnas kod som gäller för Python 2, men oftast finns det kommentarer som säger hur koden ser i ut i Python 3. Det är inte så stora skillnader. Mest märkbart är hur man skriver `print` och `input`. Men det hanteras alltså i kurslitteraturen.

Som Python-programmerare behöver man kunna använda både version 2 och 3, så det är bara att gilla att läget är på detta viset.



Avslutningsvis {#avslutning}
------------------------------

Du har nu grunderna som krävs för att sätta igång och programmera med Python.

Har du fler förslag eller tips så kan vi ta det i [forumet för Python-frågor](forum/viewforum.php?f=44). 

[Python finns installerat på studentservern](coachen/python-finns-pa-studentservern), troligen behöver du inte använda det men det kan vara bra att veta om.




