---
author:
    - mos
category: 
    - labbmiljo
    - php
revision:
    "2017-04-28": (A, mos) Första revisionen.
...
Installera PHP Xdebug
==================================

[FIGURE src=/image/snapvt17/xdebug.png?w=c5&a=0,50,60,0 class="right"]

Så här gör du för att installera och aktivera PHP Xdebug.

<!--more-->



Förutsättning {#pre}
-------------------------------

Du har "[PHP i din PATH](kunskap/lagg-php-i-pathen)".




Dubbelkolla om Xdebug är aktiverat {#test}
-------------------------------

Du kan börja med att dubbelkolla om Xdebug redan är aktiverat i din PHP-installation.

```bash
$ php -i | grep Xdebug
    with Xdebug v2.2.5, Copyright (c) 2002-2014, by Derick Rethans
```

Om du får ett resultat liknande ovan, även om versionen skiljer sig, så är det troligt att det redan fungerar. Då är du klar.

Får du ett tomt resultat, ingen utskrift, så har du troligen inte aktiverat Xdebug.



Installera Xdebug med XAMPP {#install}
-------------------------------

på [hemsidan för Xdebug](https://xdebug.org/) finns olika alternativ för att installera libbet. Vi utgår från att du använder XAMPP och då gör vi så här.

Börja med att leta reda på din konfigurationsfil för PHP.

Så här kan det se ut på en Mac.

```bash
$ php -i | grep php.ini
Configuration File (php.ini) Path => /Applications/XAMPP/xamppfiles/etc
Loaded Configuration File => /Applications/XAMPP/xamppfiles/etc/php.ini
```

På motsvarande sätt kan det se ut på Windows.

```bash
$ php -i | grep php.ini
Configuration File (php.ini) Path => C:\Windows
Loaded Configuration File => C:\xampp\php\php.ini
```

Redigera din fil `php.ini` så att raden som inkluderar modulen för Xdebug finns me, inte är bortkommenterad och sökvägen är korrekt angiven. Dubbelkolla att filen verkligen ligger där du anger.

Så här kan det se ut på Mac.

```text
[XDebug]
zend_extension = xdebug.so
```

Motsvarande ser ut så här på Windows.

```text
[XDebug]
zend_extension = "C:/xampp/php/ext/php_xdebug.dll"
```

Starta om Apache och testa om PHP nu känner igen att Xdebug finns aktiverat.

```bash
$ php -i | grep Xdebug
    with Xdebug v2.2.5, Copyright (c) 2002-2014, by Derick Rethans
```

Får du nu en utskrift så ser det bra ut, du har aktiverat Xdebug i din installation.

Om du hamnar i trubbel så har XAMPP en egen installationsguide "Activate and Use Xdebug" som finns bland HOW-TO guides om du öppnar XAMPP dokumentationen i din lokala installation.



Installera Linux {#linux}
------------------------------

Du kan installera paketet via `apt-get php5-xdebug`.

Notera att Linux kan ha två olika konfigurationsfiler för PHP, en för CLI `/etc/php5/cli/php.ini` och en för Apache `/etc/php5/apache2/php.ini`. Du vill aktivera Xdebug i båda ini-filerna.



Avslutningsvis {#avslutning}
------------------------------

För fler varianter att installera Xdebug, se deras hemsida där alternativen omfattar bla PECL och Brew.

Det finns en [forumtråd](t/6464) där du kan ställa frågor, eller ge tips och trix, om denna artikel. Kika där om du får problem.
