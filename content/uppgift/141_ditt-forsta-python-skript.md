---
author: mos
category: python
revision:
  "2016-03-17": (D, mos) hur man kopierar plane.py.
  "2015-08-25": (C, mos) Uppdaterade till dbwebb v2.
  "2014-08-25": (B, mos) Rättade fleaktig filnamn vid kopiering.
  "2014-08-21": (A, mos) Första utgåvan i samband med kursen python.
updated: "2016-03-17 12:22:45"
created: "2014-07-03 07:30:36"
...
Ditt första Python-skript
==================================

Skriv ett av dina första enklare program i Python genom att konvertera mellan olika typer av värden.

<!--more-->


Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat igenom artikeln "[Installera en labbmiljö till Python](kunskap/installera-en-labbmiljo-till-python)".

Du har även skapat en me-sida enligt ["En me-sida i python som cgi-skript"](uppgift/en-me-sida-i-python-som-cgi-skript).



Introduktion {#intro}
-----------------------

Du har säkert suttit på ett flygplan och sett på skärmen hur högt planet flyger, vilken hastighet det har, temperaturen utanför och hur långt det är till destinationen och vad klockan är för tillfället.

Det är siffror som omväxlande visas i meter, km/h och Celsius och sedan växlar det till feet, mph och Farenheit.

Du skall nu göra ett program som ber användaren mata in följande värden:

* Höjd över havet (meter)
* Hastighet (km/h)
* Temperatur utanför flygplanet (Celsius)

Sedan skall programmet skriva ut motsvarande värden enligt:

* Höjd över havet (feet)
* Hastighet (mph)
* Temperatur utanför flygplanet (Farenheit)

1 meter är 3.28084 [feet](http://en.wikipedia.org/wiki/Foot_(unit)).

1 kilometer är 0.62137 [miles](http://en.wikipedia.org/wiki/Miles).

För att konvertera från Celcius till [Farenheit](http://en.wikipedia.org/wiki/Farenheit) används följande formel:

```text
[°F] = [°C] * 9 / 5 + 32
```



Krav {#krav}
-----------------------

1. Kopiera ditt program `hello.py` och utgå från det. Spara ditt resultat i filen `me/kmom01/plane/plane.py`.

```bash
# Ställ dig i roten av kurskatalogen python
cd me/kmom01/
cp -i hello/hello.py plane/plane.py
cd plane
ls
```

2\. Skriv programmet så att det fungerar enligt introduktionen ovan.

3\. Ta en kopia av `plane.py` och spara som `plane1.py`.

Gör så att `plane1.py` fungerar utan att användaren skriver in något. Använd följande hårdkodade värden.

* Höjd över havet 1100 meter
* Hastighet 1000 km/h
* Temperatur utanför flygplanet -50 grader Celsius

4\. Kopiera filen `plane1.py` till `plane1.cgi` och modifiera den så att den det kan köras över webben.

5\. Ladda upp och publicera labben, som en del av din me-sida, genom att göra följande kommandon i kurskatalogen i terminalen.

```bash
# Ställ dig i roten av kurskatalogen python
dbwebb validate plane
dbwebb publish plane
```

Rätta eventuella fel som dyker upp och publicera igen. När det ser grönt ut så är du klar. 



Extrauppgift {#extra}
-----------------------

Det finns ingen extra uppgift.



Tips från coachen {#tips}
-----------------------

Lycka till och hojta till i forumet om du behöver hjälp!




