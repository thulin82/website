---
author: mos
category: labbmiljo
revision:
  "2013-08-20": (D, mos) Länkade till ny artikel om labbmiljö för databasservern MySQL.
  "2013-01-16": (C, mos) Skrev om stycket för MySQL och databasservern.
  "2012-08-29": (B, mos) Flyttad från [blogspot](<a href='http://db-o-webb.blogspot.com/2009/10/bths-labmiljo-for-html-php-och-sql.html'>http://db-o-webb.blogspot.com/2009/10/bths-labmiljo-for-html-php-och-sql.html</a>)
    till Lydia.
  "2009-10-27": (A, mos) Första utgåvan.
updated: "2013-08-20 14:01:30"
created: "2012-08-10 08:21:06"
...
BTH's labmiljö för Webbprogrammering
==================================

Det finns en webbaserad labbmiljö där alla studenter kan skapa egna webbsidor med HTML, PHP och SQL. Detta inlägg beskriver översiktligt hur du som student kommer igång med denna labbmiljö. Inlägget avslutas med lite mer avancerade tips för dig som kommit igång och vet hur det här funkar.

<!--more-->




Webbserver {#webbserver}
--------------------------------------------------------------------

* <a href='http://www.student.bth.se/~mosstud/index.html'>http://www.student.bth.se/~mosstud/index.html</a>

Byt ut `~mosstud` mot ditt eget studentid och testa att öppna länken i en webbläsare. Du bör få upp en sida som säger något i stil med "Ändra mig!".


Filserver {#filserver}
--------------------------------------------------------------------

* ssh.student.bth.se
* sftp.student.bth.se

Via dessa maskiner (linux) kommer du åt ditt studentkonto och alla dina filer. Logga in på någon av maskinerna enligt följande:

* Teminalprogram PuTTy/xterm (via ssh, port 22)
* Texteditor som stödjer ssh/sftp
* sftp-klient för att föra över filer

Alla filer som ligger under din katalog som heter `www` är tillgängliga via webbservern. Pröva att uppdatera innehållet i filen `www/index.html` och gör reload i din webbläsare. Funkar det? 

[INFO]
**Rätt rättigheter**

Se till att filer och bibliotek är läsbara för alla (chmod 644 för filer och chmod 755 för bibliotek). Annars syns de inte i webbläsaren. När du skapar nya filer får de normalt rättigheterna som gör att de inte syns via webbläsaren. 

* Läs mer i forumet om hur du ändrar filrättigheter:  
  <a href='http://dbwebb.se/f/319'>http://dbwebb.se/f/319</a>
[/INFO]


Databasserver MySQL {#databasserver}
--------------------------------------------------------------------

MySQL-servern finns på följande maskin: `blu-ray.student.bth.se`.

Du skapar själv ett konto på servern via [studentportalen](bth#studentportalen). Du får ett automatgenererat lösenord.

* Hur skapar jag ett nytt lösenord till MySQL?  
  forum/viewtopic.php?f=30&t=188

Du loggar sedan in med ditt studentkonto och du har en databas som heter samma sak som ditt studentkonto.

En textbaserad klient finns på `ssh.student.bth.se`. Du startar den på följande sätt:

~~~syntax=html
mos@seekers: mysql -p -h blu-ray.student.bth.se
~~~

* PHPMyAdmin finns på följande länk:  
  <a href='http://www.student.bth.se/phpmyadmin'>http://www.student.bth.se/phpmyadmin</a>

Om du är osäker på databaser och vill veta mer om hur du kommer igång med MySQL och dess olika klienter (och var de finns installerade) så läser du guiden "[BTH's labbmiljö för databasen MySQL](kunskap/bth-s-labbmiljo-for-databasen-mysql)".



HTML, PHP och MySQL {#html}
--------------------------------------------------------------------

Följande inlägg visar exempel på hur du använder HTML, PHP och SQL  i labbmiljön.

* <a href='http://db-o-webb.blogspot.com/2009/10/att-koppla-php-mot-databas.html'>http://db-o-webb.blogspot.com/2009/10/att-koppla-php-mot-databas.html</a>

När du kopplar dig mellan PHP och MySQL använder du en fil `config.php`. Där anger du lösenord och kopplingsdetaljer. Läs hur du skyddar ditt lösenord.

* <a href='http://db-o-webb.blogspot.com/2010/01/php-och-mysql-skydda-din-configphp.html'>http://db-o-webb.blogspot.com/2010/01/php-och-mysql-skydda-din-configphp.html</a>


Installera egen webbserver {#egen-miljo}
--------------------------------------------------------------------

det är alltid en god idé att installera en egen utvecklingsmiljö på din hemmaskin.

* WampServer på Windows (paket med Apache, PHP, MySQL och SQLite).  
  <a href='http://db-o-webb.blogspot.com/2010/09/installera-wampserver-pa-windows.html'>http://db-o-webb.blogspot.com/2010/09/installera-wampserver-pa-windows.html</a>

* MAMP på Mac (paket med Apache, PHP, MySQL och SQLite).  
  <a href='http://db-o-webb.blogspot.com/2010/09/installera-mamp-pa-os-x.html'>http://db-o-webb.blogspot.com/2010/09/installera-mamp-pa-os-x.html</a>

* Apache, PHP och MySQL på Windows Vista och Windows 7.  
  <a href='http://db-o-webb.blogspot.com/2009/09/installera-apache-php-och-mysql-pa.html'>http://db-o-webb.blogspot.com/2009/09/installera-apache-php-och-mysql-pa.html</a>


Avancerat: Bra att ha tips {#avancerat}
--------------------------------------------------------------------

Editera inloggningsfilerna på `ssh.student.bth.se` för att ta bort autologout och strul med umask så du slipper göra chmod hela tiden.

* <a href='http://db-o-webb.blogspot.com/2009/09/sshstudentbthse-editera-initfilen-vid.html'>http://db-o-webb.blogspot.com/2009/09/sshstudentbthse-editera-initfilen-vid.html</a>

Sitt hemma med MySQL Workbench och jobba mot MySQL-servern.

* <a href='http://db-o-webb.blogspot.com/2010/09/kom-at-mysql-servern-med-mysql.html'>http://db-o-webb.blogspot.com/2010/09/kom-at-mysql-servern-med-mysql.html</a>

SSH och port forwarding med xterm (Linux/Unix/Mac) och putty (Windows).

* <a href='http://db-o-webb.blogspot.com/2009/09/ssh-port-forwarding-med-xterm.html'>http://db-o-webb.blogspot.com/2009/09/ssh-port-forwarding-med-xterm.html</a>
* <a href='http://db-o-webb.blogspot.com/2009/09/ssh-port-forwarding-med-putty.html'>http://db-o-webb.blogspot.com/2009/09/ssh-port-forwarding-med-putty.html</a>

Kommandot screen finns installerat på ssh.student.bth.se.

* <a href='http://db-o-webb.blogspot.com/2009/10/kommandot-screen-finns-pa.html'>http://db-o-webb.blogspot.com/2009/10/kommandot-screen-finns-pa.html</a>

Versionshantering med git, github och subversion (svn)

* <a href='http://db-o-webb.blogspot.com/2010/02/versionshantering-med-git-github-och.html'>http://db-o-webb.blogspot.com/2010/02/versionshantering-med-git-github-och.html</a>


MSDNAA {#msdnaa}
--------------------------------------------------------------------

Visste du att du som student kan få tillgång till Microsofts programvaror?

> ”MSDNAA, MSDN Academic Alliance är ett program som Microsoft startat. Programmet innebär att Microsoft ger studenter och forskare fri tillgång till större delen av Microsofts mjukvara gratis för att kunna användas i utbildning, utvärdering och forskning.
Några exempel på mjukvara som medlemmar av MSDNAA får är Windows Server 2003, Windows Vista Business, Windows XP Professional och Visual Studio."

* Läs mer och anmäl dig i forumet:  
  <a href='http://dbwebb.se/f/3046'>http://dbwebb.se/f/3046</a>


Problem {#problem}
--------------------------------------------------------------------

[IT-supportens helpdesk](/bth#ithelpdesk) hjälper dig vid problem.



