---
author: lew
revision:
    "2016-04-12": (PA, lew) Pre-release.
category:
    - oopython
...
Bokningssystem
===================================

[FIGURE src=/image/oopython/kmom06/booksystem.png?w=c5 class="right"]

Tidigare har vi jobbat med några klasser åt gången. Nu är det dags att använda fler. Vi ska skapa ett bokningsprogram där man bokar in lag att tävla i sporter på specifika datum. Datumet blir då "bokat" och kan inte bokas igen. Det blir fler klasser som interagerar med varandra.

<!--more-->


Förkunskaper {#forkunskaper}
-----------------------

Du har gått introduktionskursen i Python.  
Du har gjort kursmomenten som handlar om att skapa klasser.


Uppgiftens struktur {#uppgiftens-struktur}
-----------------------    

###Filerna {#filerna}

[FIGURE src=/image/oopython/kmom06/packages.png]  

Filen "main.py" ska innehålla menyn. Main-filen använder "handler.py" som sköter all kommunikation med de övriga klasserna/filerna. Studera diagrammet för att se vilka filer som kan nå vilka.  



###Klasserna {#klasserna}

Nedan är ett UML-diagram av klasserna. Det är ett exempel på hur de kan se ut.

[FIGURE src=/image/oopython/kmom06/classes.png]  



###Exempel {#exempel}

Följande är ett exempel på hur det kan se ut i terminalen:  

[ASCIINEMA src=46938]



Krav {#krav}
-----------------------

Skapa dina filer i mappen kmom06/booking.

```bash
# Ställ dig i kurskatalogen
cd me/kmom06/booking
```

1. Dina klasser och filer ska ha samma namn som i exemplena ovan.

2. "main"-filen ska enbart innehålla menyn och importera "Handler".  

3. Om en dag är bokad ska man inte kunna boka den igen.

4. Alla klasser från diagrammet ska vara implementerade.  

5. "Month" ska innehålla rätt antal "Day"-objekt. (Bortse från ev. skottår)  

6. "Calender" ska innehålla ett år, (12 måndader, 365 dagar).  

```bash
# Ställ dig i kurskatalogen
dbwebb validate booking
dbwebb publish booking
```

Rätta eventuella fel som dyker upp och validera igen. När det ser grönt ut så är du klar.



Extrauppgift {#extra}
-----------------------

1. Använd listan du skapade i kursmoment 5 i klasserna. Skriv ett stycke om det i redovisningstexten.



Tips från coachen {#tips}
-----------------------

Validera ofta. Så slipper du en massa valideringsfel i slutet av övningen.

Lycka till och hojta till i forumet om du behöver hjälp!
