---
author: mos
category: webbprogrammering
revision:
  "2016-02-03": (C, mos) Ändrade länk för att installera apt-cyg, [bakgrund](t/5042).
  "2015-08-24": (B, mos) Om kommandot `chere` går fel första gången.
  "2015-04-10": (A, mos) Första utgåvan.
updated: "2016-02-03 11:37:33"
created: "2015-04-10 07:05:00"
...
Installera Unix-terminalen Cygwin på Windows
==================================

[FIGURE src=/image/cygwin/logo.png?w=100 class="right"]

Cygwin är en Unix-terminal för Windows-användaren. Med Cygwin får du tillgång till en Unix-terminal som fungerar tillsammans med ditt Windowssystem. Du kan köra dina bash-skript och använda de Unix-kommandon du är van vid.

Det finns även en pakethanterare i form av `apt-cyg` som hjälper dig att installera de program du behöver.

Här är en guide till hur du installerar Cygwin och pakethanteraren `apt-cyg` och hur du bäst integrerar terminalen i din Windows-miljö.

<!--more-->



Läs på {#laspa}
--------------------------------------

[Gå till Cygwins hemsida](https://www.cygwin.com/) och bekanta dig med Cygwin.



Installera Cygwin {#install-cygwin}
--------------------------------------

Det finns två varianter att installera, 32 bitars eller 64 bitars. Kolla upp vad din dator har för system och välj motsvarande installationsprogram för Cygwin.

Ladda ned och starta installationsprogrammet. Du kan använda standardinställningar rakt av.

Så här gör jag när jag installerar Cygwin.

[YOUTUBE src=h_eTCIjEPyw width=630 caption=En snabb översikt av stegen för att installera Cygwin.]



Installera pakethanteraren apt-cyg {#install-apt-cyg}
--------------------------------------

Stegen för att installera pakethanteraren [`apt-cyg`](https://github.com/transcode-open/apt-cyg) är så här.

Starta en cygwin-terminal och kör följande kommandon, först det ena och sedan det andra.

```text
lynx -source dbwebb.se/apt-cyg > apt-cyg
install apt-cyg /bin
```

Klart. Nu kan du testa att installera kommandot `wget` med `apt-cyg`.

```text
apt-cyg install wget
```

Du kommer också behöva kommandon för `ssh` och `rsync` så installera dem också. Om de redan är installerade så säger `apt-cyg` det.

```text
apt-cyg install openssh rsync
```

Du kan också skriva in kommandot utan några argument, då får du en översikt av vad kommandot kan göra.

```text
apt-cyg
```

Så här ser det ut när jag installerar `apt-cyg`.

[YOUTUBE src=TMHCO-pau5E width=630 caption=Så här kommer man igång med pakethanteraren apt-cyg.]

[INFO]
**Installationslänken för apt-cyg**

Jag har för tillfället valt att lägga installationslänken till apt-cyg på dbwebb.se. Du kan läsa om [bakgrunden](t/5042) till detta i forumet.

Följande är alltså ändrat.

```bash
# Original installation link
$ lynx -source rawgit.com/transcode-open/apt-cyg/master/apt-cyg > apt-cyg

# Current installation link
$ lynx -source dbwebb.se/apt-cyg > apt-cyg
```
[/INFO]



Lägg till Cygwin i Windows-menyn {#install-menu}
--------------------------------------

Det är bra att kunna starta en Cygwin-terminal i nuvarande katalog, till exempel om man är i filväljaren och vill starta en terminal i just den katalogen. Det kan vi lösa genom att lägga till ett menyval i context-menyn (högerklick-menyn).

Starta Cygwin (som Administratör) och installera programmet `chere`.

```text
apt-cyg install chere
```

Kör programmet för att installera shell-extensions i Windows-registret.

```text
chere -i -c -t mintty
```

Om du glömde starta som Admin och fick felmeddelande, starta då om cygwin som administratör och kör följande kommando istället.

```text
chere -i -f -c -t mintty
```

Klart. Nu kan du högerklicka på desktopen och välja menyvalet "Bash Prompt Here" och en Cygwin-terminal startar i nuvarande katalog.

Om du vill lära dig mer om vad programmet `chere` nyss gjorde så skriver du följande kommandon.

```text
chere
man chere
```

[YOUTUBE src=TMHCO-pau5E width=630 caption=Så här kommer man igång med Cygwin på Windows context meny.]

Det finns en forumtråd för [Cygwin och `chere`](t/4030), kika där om du får bekymmer.



Avslutningsvis {#avslutning}
--------------------------------------

Nu har du kommit igång med Cygwin. Det är ett ypperligt arbetsverktyg, du har nu tillgång till många av de vanliga Unix-kommandon som finns på terminalen. Det är bara att installera och köra på.

Har du tips, förslag eller frågor om Cygwin så finns det ett [subforum om Windows för Webbprogrammerare](forum/viewforum.php?f=55).

Vill du lära dig mer om grunderna i Unix så finns artikeln ["20 steg för att komma i gång med Unix och terminalen"](kunskap/20-steg-for-att-komma-i-gang-med-unix-och-terminalen).




