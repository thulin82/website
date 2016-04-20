---
author: mos
category: unix
revision:
  "2015-07-05": (C, mos) .
  "2015-06-30": (B, mos) Port forwarding kontra bridged network.
  "2015-06-26": (A, mos) Första utgåvan.
updated: "2015-06-30 08:40:27"
created: "2015-06-24 06:26:16"
...
Installera Debian (på VirtualBox)
==================================

[FIGURE src=/image/snapht15/linux-what-now.png?w=c5&a=0,60,50,0 class="right" caption="Linux, och nu då?"]

Jag tänker visa hur jag installerar operativsystemet Debian på VirtualBox. Dels är det för att visa hur man installerar ett godtyckligt operativsystem på VirtualBox och dels är det för att visa hur man installerar Debian på en godtycklig hårdvara.

<!--more-->

Om det inte går bra första gången du prövar så kasta allt och börja om från början. Många gånger är det den snabbaste vägen in i mål.



Ladda ned Debian  {#download}
---------------------------------

Du kan läsa om Debian på [hemsidan för projektet](https://www.debian.org/). Där finns också en [sektion för att ladda ned](https://www.debian.org/distrib/) en ISO-image som du kan använda för att installera Debian på VirtualBox (eller annan hårdvara).

Jag väljer att ladda ned deras image som är [anpassad för installation via nätet](https://www.debian.org/distrib/netinst). Det kräver en koppling till internet men den är liten och snabb att ladda ned.

Eftersom jag tänker installera minsta möjliga version av Debian så behöver jag inte en massa paket eller fönsterhanterare. Så detta blir en snabb och smidig väg att komma igång.

Jag väljer bland nedladdningslänkarna under "Small CDs or USB sticks". Jag väljer *amd64* i de fallen jag har en 64 bitars maskin. Om jag har en 32 bitars maskin så väljer jag paketet *i386*.

VirtualBox kommer att visa vilka möjligheter du har. I värsta fall får du ladda ned båda paketen. Börja med amd64 för 64-bitars. Kan du bara installera 32 bitars så laddar du ned i386 istället.

Så här ser det ut när jag gör dessa stegen.

[YOUTUBE src=apaRhd_7U7k width=630 caption="Mikael laddar ned installationsprogrammet för Debian."]



Sätt upp en virtuell maskin i VirtualBox för Debian {#init}
---------------------------------

Nu skapar vi en virtuell maskin i VirtualBox där vi skall installera Debian.

[YOUTUBE src=DrlCWweCNYY width=630 caption="Mikael skapar en virtuell maskin i VirtualBox där han tänker installera Debian."]

I mitt fall kunde jag bara installera 32-bitars OS så jag valde den image som hette *i386*. Om jag kunde installera 64-bitars OS så hade jag valt imagen för *amd64*.

När man startar den virtuella maskinen så börjar installationsförfarandet för Debian eftersom den bootar från den image som vi lade till.

Var med på att när du klickar i fönstret som kommer upp så låses din mus till det fönstret. För att ta bort låsningen så behöver du klicka på det som kallas *host key* och standard är det den högra `Ctrl`-knappen.

Nu är vi redo att installera Debian.




Installera Debian i en virtuell maskin {#install}
---------------------------------

I följande video så visas proceduren i installationen av Debian.

[YOUTUBE src=DCnIWTidbmE width=630 caption="Mikael installerar Debian i en virtuell maskin i VirtualBox."]

Det som du behöver göra är i princip att:

* Välja ditt land, tangentbordslayout och teckenkodning till UTF-8.
* Välj lösenord för root-användaren och skapa en ny användare.
* Välj att bara installera de nödvändiga programvarorna. 

När du är klar kan du logga in på din nya Debian server med antingen root-användaren eller den användaren som du skapade i installationsprocessen. Normalt vill du inte logga in som root-användaren så välj den användare som du skapade.



Copy & paste mellan din dator och den virtuella maskinen  {#copy}
---------------------------------

Ibland vill man kopiera text mellan sin valiga desktop och den virtuella maskinen man kör i VirtualBox. Det är en inställning och det finns ett foruminlägg som visar "[Virtual Box och copy & paste till hostmaskinen](t/4063)".

Gör den inställningen, det sparar lite tid när du behöver kopiera saker.



Installera SSH-server på Debian med `apt-get`  {#aptget}
---------------------------------

När man installerar program på Debian (Linux) så använder man oftast en pakethanterare. Programmet man installerar finns alltså förpaketerat och man laddar ned och installerar det. På Debian kommer vi att använda pakethanteraren `apt-get`.

För att visa hur det fungerar så installerar vi SSH på servern.



###Installera `sudo` utan lösenord {#sudo}

Men, innan vi gör det så behöver vi installera programmet `sudo` som låter oss köra program som root-användaren.

Du kan se en [forumartikel om hur jag installerar `sudo`](t/4327) och samtidigt lägger in så att jag kan köra `sudo` utan att ange ett lösenord. Du kan göra likadant som jag gjorde.
https://wiki.debian.org/SSH



###Installera SSH {#ssh}

på Debians webbplats hittar du [information om SSH](https://wiki.debian.org/SSH). Kika snabbt igenom den sidan.

Klienten för ssh är redan installerad. Pröva den genom att logga in på en maskin via ssh, till exempel så här. Byt ut *acronym* mot din användare på maskinen du loggar in på.

```bash
ssh acronym@ssh.student.bth.se
```

Skriv `exit` eller `ctrl-d` för att avsluta.

Vi installerar servern för SSH via `apt-get`.

```bash
apt-get install openssh-server
```

SSH-servern startar upp och lyssnar på port 22. Du kan se dess status så här.

```bash
service ssh status
```

[FIGURE src=/image/snapht15/service-ssh-status.png?w=w2 caption="Status på SSH-servern som ligger och lyssnar på port 22."]

Nu har vi en SSH-server uppe och nu kan vi logga in på maskinen utifrån, förutsatt att VirtualBox är konfigurerat så att den virtuella maskinens nätverksinterface har fått en ip-adress. Låt oss testa det.



Logga in på den virtuella maskinen med ssh  {#ssh}
---------------------------------

Tanken är att du skall kunna logga in på din virtuella maskin från din egen desktop-miljö, via en terminal och ssh. Det finns flera sätt att göra det på och jag skall visa dig två av dem.



###Nätverk via port forwarding {#pf}

Detta är det enklaste. Pröva det först. Det handlar om *port forwarding* där du mappar upp en port på din lokala maskin. När den porten får trafik så skickas trafiken vidare till den virtuella maskinen på en viss port. Man *forwardar* trafiken från en port till en annan port (och maskin).

Gör så här. Öppna nätverksinställningarna på din virtuella maskin.

[FIGURE src=/image/snapht15/vb-network-settings.png caption="Nätverksinställningar med möjlighet till port forwarding."]

Klicka på knappen "Port Forwarding". Klicka på "+"-knappen och lägg till två regler enligt följande.

| Namn     | Host Port    | Guest Port    |
|----------|:------------:|:-------------:|
| http     | 8080         | 80            |
| ssh      | 2222         | 22            |

[FIGURE src=/image/snapht15/vb-port-forwarding.png caption="Port forwarding för ssh och http."]

Du har nu två regler för port forwarding som säger följande.

1. Trafik till localhost:2222 skickas vidare till den virtuella maskinen port 22.
2. Trafik till localhost:8080 skickas vidare till den virtuella maskinen post 80.

Så här kan det se ut när du använder ssh för att logga in på den virtuella maskinen.

[ASCIINEMA src=22710]

Glöm inte att lösenordet du anger är för den virtuella maskinen.



###Nätverk via delat nätverkskort {#bridge}

Du kan dela nätverkskortet med *bridged network*, och den virtuella maskinen hämtar sin ip-adress via DHCP. Detta sätt ger den virtuella maskinen en egen ip-adress och den blir åtkomlig i hela ditt nätverk.

Jag har sammanställt ett foruminlägg som visar stegen du behöver göra för att initiera nätverket med bridged network på den virtuella maskinen, och för att logga in med ssh.

* [VirtualBox, nätverk och gäst OS som server](t/4332)

Det är flera steg och det kan säkert krångla. Om det inte fungerar första gången så gör du om. Räkna med att få göra om och testa ett par gånger.

Detta sättet kan krångla om du inte har koll på ditt lokala nätverk. Till exempel så misslyckas jag med denna lösning när jag är på skolans miljö då jag inte har full koll på hur DHCP är uppsatt. Så, om du är osäker så använder du lösningen med port forwarding istället.
 


Roliga kommandon i Unix-terminalen {#rolig}
--------------------------------------

[FIGURE src=/image/snapht15/linux-what-now.png?w=w2 caption="Linux, och nu då?"]

Okey, vi har en terminal och en Linux-server. Vad ska vi göra nu?

Tja, låt oss börja med att [installera ett par roliga program](kunskap/roliga-kommandon-i-unix-terminalen). Bara för att bekanta oss med terminalen.

Glöm inte `apt-get` om du saknar något program. Kom ihåg att alla program har en man-sida. Där står allt du behöver veta.

```bash
man apt-get
```



Avslutningsvis {#avslutning}
--------------------------------------

Nu har du kommit igång och du har den labbmiljö som krävs för att genomföra det första kursmomentet i kursen.

Om du stöter på problem så kan du alltid [fråga i forumet om Utvecklings- Drift- och Servermiljö](forum/viewforum.php?f=23).




