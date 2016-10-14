---
author: mos
revision:
    2016-10-13: (A, mos) Första utgåvan.
category:
    - labbmiljo
    - make
...
Installera Composer för pakethantering med PHP
===================================

[FIGURE src=/image/snapvt16/logo-composer.png?w=c5 class="right"]

Vi skall installera verktyget Composer som är en pakethanterare för PHP.

Composer är ett kommandoradsprogram som låter dig installera paket och moduler som andra utvecklare har gjort och publicerat. Composer håller koll på vilka versioner som är installerade och att paketen installeras effektivt och kan hållas uppgraderade.


<!--more-->



Läs mer {#mer}
-------------------------------

Du kan läsa mer om [Composer på webbplatsen](https://getcomposer.org/).

Du kan se vilka [PHP-paket som finns publicerade på Packagist](https://packagist.org/).



Förutsättning {#pre}
-------------------------------

Du har [PHP i din path](labbmiljo/php-i-pathen).



Installera på Windows XAMPP {#windows}
-------------------------------

Öppna Cygwin. Gå till katalogen där din exekverbara PHP ligger.

```bash
$ cd $( dirname $( which php ))
```

Hämta hem composer enligt de stegen som beskrivs i [Download Composer](https://getcomposer.org/download/).

Provkör composer.

```bash
$ ls -l composer.phar
$ php composer.phar --version
```

Då lägger vi till så att du kan köra composer som ett kommando, utan att behöva ange php framför. Vi gör det via två skript ([`composer`](https://gist.github.com/mosbth/ae5437cfe01d14b9707c) samt [`composer.bat`](https://gist.github.com/mosbth/bba3e71b5f86394a0d44)) som du kan hämta från GitHub.

```bash
$ wget -O composer https://gist.githubusercontent.com/mosbth/ae5437cfe01d14b9707c/raw/
$ wget -O composer.bat https://gist.githubusercontent.com/mosbth/bba3e71b5f86394a0d44/raw/
$ chmod 755 composer
$ ls -l composer*
-rwxr-xr-x+ 1 mikae mikae    1008 Oct 13 14:15 composer
-rwxrw-r--+ 1 mikae mikae     384 Oct 13 14:15 composer.bat
-rwxrwx---+ 1 mikae mikae 1704783 Oct 13 13:49 composer.phar
```

Dessa båda skript gör så att du kan köra kommandot genom att bara ange `composer` i både Cygwin (via `composer`) och `cmd.exe` (via `composer.bat`).

Testa att det fungerar.

```bash
$ composer --version
```



Installera på Mac OS {#macos}
-------------------------------

Följ instruktionen om hur man [laddar ned och installerar composer](https://getcomposer.org/download/).

När filen är nedladdad, gör följande.

```bash
$ ls -l composer.phar 
-rwxr-xr-x 1 mos mos 1.7M Oct 13 14:33 composer.phar*
$ php composer.phar --version
```

Bra, nu vet du att den nedladdade filen fungerar. Placera den nu i en katalog som ligger i din path.

```bash
$ sudo install --mode=0755 composer.phar $HOME/bin/composer
$ ls -l $HOME/bin/composer
$ composer --version
```

Om det sista kommandot gick bra och visade nuvarande version för composer så är allt okey.



Installera på Linux {#linux}
-------------------------------

Följ instruktionen om hur man [laddar ned och installerar composer](https://getcomposer.org/download/).

När filen är nedladdad, gör följande.

```bash
$ ls -l composer.phar 
-rwxr-xr-x 1 mos mos 1.7M Oct 13 14:33 composer.phar*
$ php composer.phar --version
```

Bra, nu vet du att den nedladdade filen fungerar. Placera den nu i en katalog som ligger i din path.

```bash
$ sudo install --mode=0755 composer.phar /usr/local/bin/composer
$ ls -l /usr/local/bin/composer
$ composer --version
```

Om det sista kommandot gick bra och visade nuvarande version för composer så är allt okey.



Verifiera att Composer fungerar {#test}
-------------------------------

Kör följande för att se att composer fungerar.

```bash
$ whereis composer
$ which composer
$ composer --version
$ composer
```



Bra att veta om Composer {#bra}
-------------------------------

När du har kommit igång med pakethantering i PHP och Composer så öppnar sig en ny värld. Här är några saker du kommer att kunna göra. men det förutsätter att du har ett aktivt projekt som använder composer.

Du kan kontrollera vilka moduler som du tagit hem, de som nu ligger i `vendor` mappen.

```bash
$ composer info
```

Du kan kontrollera varför en modul installerats genom att se vilken modul som är beroende av densamma. Så här kan du se vilken modul som krävde att `mos/ctextfilter` installerades.

```bash
$ composer require mos/ctextfilter
```

Om du vill vet mer om paketet så kan du använda composer för att öppna paketets hemsida.

```bash
$ composer home mos/ctextfilter
$ composer home mos/anax
```

Du kan alltid uppdatera de nedladdade paketen för att få hem senaste ändringar.

```bash
$ composer update
```

Ibland får du ett meddelande om att uppdatera `composer`. Du kan hjälpa `composer` att uppdatera sig själv.

```bash
$ composer selfupdate
```

Du kan göra fler saker med `composer`. Använd hjälptexten för att snabbt få en översikt av vad du kan göra.

```bash
$ composer
```



Avslutningsvis {#avslutning}
------------------------------

Det finns en [forumtråd om Composer](t/5795), ställ dina frågor där och tipsa gärna om hur du använder det.
