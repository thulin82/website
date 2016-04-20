---
author: mos
category: webbprogrammering
revision:
  "2015-03-27": (A, mos) Första utgåvan.
updated: "2015-03-31 08:53:37"
created: "2015-03-31 08:53:35"
...
Installera versionshanteringssystemet Git
==================================

[FIGURE src=/image/git/logo.png class="right"]

Git är ett versionshanteringssystem som utvecklades i samband med arbetet med Linux-kärnan. Git har nu det blivit ett alltmer populärt verktyg för att hantera kod.

Här är en kort guide till hur du *installerar* Git på din egen maskin.

<!--more-->

Git finns till flera operativsystem, går under en fri licens och utvecklas som [öppen källkod på GitHub](https://github.com/git).



Läs på {#laspa}
--------------------------------------

[Gå till Gits hemsida](http://git-scm.com/) och kika på de alternativ som finns för att installera Git.

Följ sedan instruktionerna för respektive miljö nedan.



Installera på Windows {#install-win}
--------------------------------------

Ladda ned och starta installationsprogrammet. Klicka dig fram tills du kommer till denna rutan.

[FIGURE src=/image/git/git-install-to-path.png caption="Se till att mittenvalet är gjort, du måste kunna använda Git från terminalen `cmd.exe`."]

I nästa ruta så skall du välja det sista valet som inte gör någon automatisk påverkan på dina filer. 

[FIGURE src=/image/git/git-install-as-is.png caption="Se till att sista valet är gjort, Git skall inte ändra dina filer per automatik."]



###Testa installationen {#test-win}

Testa installationen genom att köra följande kommando i din `cmd.exe`.

```bash
$ git --version
$ git
```

Det kan se ut så här.

[FIGURE src=/image/git/git-version.png caption="Kommandot Git finns nu i pathen och kan köras från `cmd.exe`."]



Installera på Mac OS {#install-mac}
--------------------------------------

På Mac OS finns Git redan installerat som en del av systemet.



###Testa installationen {#test-mac}

Testa att installationen finns på plats genom att följande kommando i en terminal.

```bash
$ git --version
$ git
```

Det kan se ut så här.

[ASCIINEMA src=18099]



Installera på Linux/Unix {#install-nix}
--------------------------------------

På Debian Linux gör du så här.

```bash
$ apt-get install git
```

Använder du andra Unix/Linux-varianter så ser du [hur du installera dem på Gits hemsida](http://git-scm.com/download/linux).



###Testa installationen {#test-nix}

Testa att installationen gick bra genom att köra kommandot.

```bash
$ git --version
$ git
```

Det kan se ut så här.

[ASCIINEMA src=18097]



Avslutningsvis {#avslutning}
--------------------------------------

Denna artikel visar enbart hur du installerar Git. Att lära sig använda Git är en annan sak.

På webbplatsen för Git finns det en webbaserad övning om 15 minuter som [hjälper dig att komma igång med grunderna för Git](http://try.github.com/).

Här finns en artikel som visar hur du kan [komma igång med Git tillsammans med webbtjänsten GitHub](kunskap/kom-igang-med-git-och-github).

Har du tips, [förslag eller frågor om installationen av Git](t/4053) så finns det en specifik forumtråd för det.
 



