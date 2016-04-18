---
author: mos
revision:
  "2015-10-26": (A, mos) Första utgåvan.
category: webbprogrammering
...
Introduktion till labbmiljö i webapp
==================================

Här får du en snabb översikt för att se vilka verktyg och applikationer du behöver installera för att erhålla den labbmiljö som krävs för kursen webapp.

<!--more-->

Du kan se detta som en referensinstallation av labbmiljön. Det är inget absolut krav att din miljö ser ut så här. Du kan välja alternativa vägar. Men, om du hamnar i bekymmer så får du komma tillbaka hit och göra som det står här.



Operativsystem  {#os}
---------------------------------

Till din primära utvecklingsmiljö kan du använda Windows, Mac OS eller någon variant av Linux/Unix. Du undviker enklast eventuella problem genom att hålla dig till de senaste versionerna av operativsystemen.

Om du kör Windows, se då till att göra det som en användare som har Administratörsrättigheter.

Behöver du hjälp med frågor om operativsystem så finns följande subforum.

* [Windows för Webbprogrammerare](forum/viewforum.php?f=55)
* [Unix och Linux](forum/viewforum.php?f=49)



Texteditor {#editor}
---------------------------------

I kurserna används texteditorn Atom som standard. Men du kan i princip välja en annan editor, eller utvecklingsmiljö, om du vill. Så länge editorn klarar av *soft tabs*, *tab-size 4 spaces*, *UTF-8 NOBOM*, samt *Unix-style line endings*.

Du [installerar Atom från dess webbplats](https://atom.io/).

Här är en guide till hur du [installerar och kommer igång med Atom](kunskap/installera-texteditorn-atom).



Terminal {#terminal}
---------------------------------

Du behöver ha tillgång till en terminal där du kan köra Unix-kommandon. På Unix/Linux och Mac har du alltid en terminal, men på Windows behöver du installera en Unix-terminal i form av [Cygwin](https://www.cygwin.com/).

På ett Unix-system använder man ofta en pakethanterare för att installera, uppdatera och avinstallera de program som finns. Det är ett enkelt sätt att hålla sitt system uppdaterat. Olika operativsystem har olika pakethanterare.

Här är guider för hur du kommer igång med terminalen, för respektive operativsystem.

* [Installera Unix-terminalen Cygwin på Windows](kunskap/installera-unix-terminalen-cygwin-pa-windows)
* [Terminalen och pakethantering med Brew på Mac OS](kunskap/terminalen-och-pakethantering-med-brew-pa-mac-os)
* [Terminalen och pakethantering i Unix/Linux](kunskap/terminalen-och-pakethantering-i-unix-linux)

Om du är osäker på grunderna i en Unix-terminal så finns det en [guide som hjälper dig att komma igång med Unix på kommandoraden](kunskap/20-steg-for-att-komma-i-gang-med-unix-och-terminalen).



Git {#git}
---------------------------------

Versionshanteringverktyget Git används till och från i kurserna. Du behöver ha det installerat på din dator. På Mac finns Git redan för-installerat, så använder du en senare utgåva av Mac OS så behöver du inte göra något.

Du kan [installera det från Gits hemsida](http://git-scm.com/download).

Här är en [guide till hur du installerar Git](kunskap/installera-versionshanteringssystemet-git).



Webbläsare  {#webblasare}
---------------------------------

Se till att du har minst [Firefox](https://www.mozilla.org/download) och [Google Chrome](https://www.google.com/chrome/) installerade på din dator. 

Både Firefox och Chrome har ett utvecklarläge för mobila plattformar och det är bra att du bekantar dig med båda.

Här finns en guide till hur du kommer åt [utvecklarläge för mobila enheter](coachen/developer-tools-i-webblasaren-for-mobila-enheter) i Firefox och Chrome.



Simulator för Firefox OS  {#firefoxos}
---------------------------------

Firefox OS är ett operativsystem för mobila enheter och telefoner. Det finns ett utvecklingsverktyg WebIDE som innehåller en simulator för Firefox OS. Det är ett bra verktyg för att testa hur ens webbpalts kan se ut i en telefon.

Här är en [guide om hur du installerar Firefox Developer, en speciell utgåva av Firefox, tillsammans med WebIDE och simulatorn för Firefox OS](coachen/firefox-developer-med-firefox-os-simulator-utvecklingsverktyg-for-en-webbprogrammerare).



Webbserver {#server}
--------------------------------------

[Installera XAMPP](https://www.apachefriends.org) som innehåller webbservern Apache.

På Windows och Mac OS är det rekommenderat att du kör XAMPP, men sitter du på Linux så kan du göra som du vill. Kanske är det enklare att installera med pakethanteraren. Fråga i forumet om du behöver råd.

Här finns en [utförlig beskrivning av hur du installerar XAMPP](kunskap/installera-en-egen-webbserver-for-utveckling) på olika plattformar.



Avslutningsvis {#avslutning}
--------------------------------------

Nu har du kommit igång och du har den labbmiljö som krävs för att genomföra det första kursmomentet i kursen.

Om du stöter på problem så kan du alltid [fråga direkt i forumet om kursens forum](forum/utbildning/webapp).




