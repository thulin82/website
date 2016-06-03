---
author: mos
revision:
    2016-06-03: (PA, mos) Pre-release.
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

**NOT**

Uppdatera artikeln på http://dbwebb.se/kunskap/installera-composer-for-pakethantering-med-php så att den pekar hit istället.



Läs mer {#mer}
-------------------------------

Du kan läsa mer om [Composer på webbplatsen](https://getcomposer.org/).

Du kan se vilka [PHP-paket som finns publicerade på Packagist](https://packagist.org/).




Förutsättning {#pre}
-------------------------------




Installera på Windows {#windows}
-------------------------------



Installera på Mac OS {#macos}
-------------------------------




Installera på Linux {#linux}
-------------------------------



Verifiera att Composer fungerar {#test}
-------------------------------



<!--

Flytta till ett eget dokument om hur man installera och använder composer.

Du kan alltid kontrollera vilka moduler som du tagit hem, de som nu ligger i `vendor` mappen.

```bash
$ composer info
```

Du kan också kontrollera varför en modul installerats genom att se vilken modul som är beroende av densamma. Så här kan du se vilken modul som krävde att `mos/ctextfilter` installerades.

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
-->



Avslutningsvis {#avslutning}
------------------------------

Frågor i forumtråd.
