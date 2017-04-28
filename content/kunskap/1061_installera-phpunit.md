---
author:
    - mos
category: 
    - labbmiljo
    - php
    - phpunit
revision:
    "2017-04-27": (A, mos) Första revisionen.
...
Installera PHPUnit
==================================

[FIGURE src=/image/snapvt17/phpunit.png?w=c5&a=0,50,70,0 class="right"]

Så här gör du för att installera PHPUnit i din sökväg.

<!--more-->



Förutsättning {#pre}
-------------------------------

Du har "[PHP i din PATH](kunskap/lagg-php-i-pathen)".




Dubbelkolla om phpunit är installerat {#test}
-------------------------------

Du kan börja med att dubbelkolla om phpunit redan finns i din PATH.

```bash
$ whereis phpunit
$ which phpunit
$ phpunit --version
$ php --version
```

Även om du har en viss version installerad, så kan det tänkas att du vill installera en annan version. Din version av PHP behöver matcha din version av PHPUnit.

[Hemsidan för PHPUnit](https://phpunit.de/) brukar vara tydliga med vilken version av PHPUnit som stödjer vilken version av PHP.



Installera phpunit {#install}
-------------------------------

Programmet phpunit är en PHAR-fil (PHP-arkiv) som du kan ladda ned och spara någonstans i din sökväg.

Säg jag vill ladda hem en godtycklig version av phpunit. Så här gör jag.

```bash
# Ladda ned från hemsidan, via webbläsare eller via curl/wget
$ wget https://phar.phpunit.de/phpunit-5.7.phar -Ophpunit && chmod 755 phpunit
$ ./phpunit --version
PHPUnit 5.7.19 by Sebastian Bergmann and contributors.
$ cp phpunit /usr/local/bin 
$ which phpunit
/usr/local/bin/phpunit
$ phpunit --version
```

Du kan lägga den exekverabara filen i godtycklig katalog som du har i din PATH.

Du kan nu dubbelkolla att du verkligen använder den versionen du nyss installerat, använd `whereis` och `which` samt kolla vilken version det är på den phpunit du använder.



Dubbelkolla att phpunit fungerar {#funkar}
-------------------------------

I kursrepot för oophp-kursen finns ett [exempelprogram](https://github.com/dbwebb-se/oophp/tree/master/example/phpunit) som kan användas för att testa att phpunit fungerar.

Läs README-filen för instruktioner om hur du kommer igång och testa att phpunit fungerar som det ska.

Notera att du behöver även [PHP Xdebug](labbmiljo/xdebug) för att kodtäckningen skall fungera.



Avslutningsvis {#avslutning}
------------------------------

Det finns en [forumtråd](t/6465) där du kan ställa frågor, eller ge tips och trix, om denna artikel. Kika där om du får problem.
