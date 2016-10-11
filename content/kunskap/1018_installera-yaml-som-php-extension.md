---
author: mos
revision:
    2016-06-03: (PA, mos) Pre-release.
category:
    - labbmiljo
    - php
...
Installera YAML som PHP extension
===================================

[FIGURE src=/image/snapvt16/yaml.png?w=c5&a=0,70,0,0 class="right"]

Vi skall installera YAML som en PHP extension.

YAML Ain't Markup Language, är ett läsbart format på att skriva till exempel konfigurationsfiler till programmeringsspråk och applikationer.



<!--more-->

Det vi behöver är `libyaml`, som implementerar en parser för YAML, samt `php-yaml` som är en PHP-wrapper till biblioteket. Dessa skall installeras och kopplas ihop med vår PHP-installation.



Läs mer {#mer}
-------------------------------

Läs mer om [YAML på deras officiella webbplats](http://yaml.org/).

Läs om [libyaml](http://pyyaml.org/wiki/LibYAML), biblioteket som parsar YAML.

Läs mer på hemsidan om [PHPs YAML extension](http://bd808.com/pecl-file_formats-yaml/).

Läs mer i PHP-manualen om [PHPs YAML extension och vilka funktioner som stöds](http://php.net/manual/en/book.yaml.php).



Förutsättning {#pre}
-------------------------------

Du behöver ha [PHP i din path](labbmiljo/XXX), det krävs för att kontrollera att PHP YAML fungerar i PHP CLI.



Verifiera att YAML fungerar {#test}
-------------------------------

I kursrepot för design-kursen finns ett PHP-skript som hjälper dig att [verifiera att PHP YAML är installerat](https://github.com/dbwebb-se/design/tree/master/example/php-yaml/) och fungerar.

Börja med att köra det skriptet på din lokala maskin för att se om du redan har modulen installerad.

Du kan [provköra skriptet på dbwebb.se](repo/design/example/php-yaml/) för att se hur det kan se ut när allt är installerat och klart.




Installera på Windows och XAMPP {#windows}
-------------------------------




Installera på Mac OS och XAMPP {#macos}
-------------------------------




Installera på Linux {#linux}
-------------------------------




Verifiera att YAML fungerar {#test}
-------------------------------



Avslutningsvis {#avslutning}
------------------------------

Det finns en forumtråd som ger tips och ledtrådar till hur man [installerar PHP YAML på olika miljöer](t/5244). Kika där om du får problem.
