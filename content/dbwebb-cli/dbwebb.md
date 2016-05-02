---
author: mos
category: labbmiljo
revision:
  "2015-10-18": (G, mos) Lade till run.
  "2015-10-08": (F, mos) Lade till purepublish.
  "2015-10-01": (E, mos) Lade till fastpublish.
  "2015-08-24": (D, mos) Uppdaterade installationssättet så det fungerar på Linux,
    Mac OS och Cygwin.
  "2015-08-06": (C, mos) Ändrade hur init och installationsfasen fungerade samt gick
    igenom dokumentet.
  "2015-07-04": (B, mos) dbwebb init gör nu även upload.
  "2015-03-23": (A, mos) Arbetskopia för dbwebb-cli version 2.
updated: "2015-10-18 12:31:16"
created: "2015-01-14 14:31:23"
...
Kommandot dbwebb
==================================

Kommandot `dbwebb` är en *command line utility* för dbwebb-kurserna. Kommandot används för att jobba med kursmaterialet och hanterar uppladdning till en server där koden valideras, publiceras och inspekteras. 

Kommandot är ett grundläggande administrativt verktyg för hur både studenter och lärare jobbar med kurserna.


<!--more-->

Denna artikel är dokumentationen för kommandot `dbwebb`. Det visar hur du installerar och använder kommandot.



Förutsättningar {#forutsattningar}
-----------------------------------------------

Innan du kan jobba med kursrepot behöver du ha en terminal installerad. Din terminal behöver ha stöd för följande kommandon.

```text
$ bash
$ git
$ ssh
$ rsync
$ wget # alternativt curl
```

*Dollartecknet $ markerar prompten och är inte en del av kommandot.*



Installera {#install}
-----------------------------------------------



###Den snabba vägen {#snabb}

Installera `dbwebb` genom att köra följande kommando i din terminal.

```text
bash -c "$(wget -qO- https://raw.githubusercontent.com/mosbth/dbwebb-cli/master/install.bash)"
```

Kommandosekvensen laddar först ned filen dbwebb som en temporär fil. Därefter kopieras den filen till katalogen `/usr/local/bin`, alternativt `/usr/bin`. Den kopieringen kan kräva att du kör skriptet som root, eller med sudo, så här.

```text
sudo bash -c "$(wget -qO- https://raw.githubusercontent.com/mosbth/dbwebb-cli/master/install.bash)"
```

 Du kommer att se ett felmeddelande om det inte går bra att installera. om du får problem så kan du installera [steg-för-steg](#steg) istället.

om du är intresserad så kan du dubbelkolla vad installationsskriptet gör, genom att [studera det på GitHub](https://raw.githubusercontent.com/mosbth/dbwebb-cli/master/install.bash).

När installationen är klar så kan du pröva om det gick bra genom att kolla vilken version du har.

```text
$ dbwebb --version
```

Så här kan det se ut.

[ASCIINEMA src=24614]



###Steg för steg {#steg}

Du kan också installera `dbwebb` för hand, steg för steg.

Först ladda ned skriptet och spara det som `dbwebb` och sätt rättigheterna så att skriptet blir körbart.

```text
$ wget -O dbwebb https://raw.githubusercontent.com/mosbth/dbwebb-cli/master/dbwebb2
$ chmod 755 dbwebb
```

Nu kan du köra skriptet.

```text
$ ./dbwebb --version
```

Men, för att göra det enklare att köra skriptet så placerar vi det i en katalog som ligger i din sökväg, `/usr/local/bin`. Katalogstrukturen skapas om den inte redan finns. 

```text
$ install -v -d /usr/local/bin
$ install -v dbwebb /usr/local/bin
```

Du kan kontrollera vilket program, och dess sökväg, som körs när du nu skriver `dbwebb`.

```text
$ which dbwebb
```

Nu kan du köra skriptet utan att ange sökvägen.

```text
$ dbwebb --version
```

Så här kan det se ut.

[ASCIINEMA src=24611]



###Kontrollera att installationen gick bra {#bra}

När installationen är klar så kan du pröva om det gick bra genom att kolla vilken version du har.

```text
$ dbwebb --version
```

Vill du ha hjälp så kan du få fram en lista på vad kommandot kan göra.

```text
$ dbwebb --help
```

Om du får problem kan du kontrollera omgivningen för `dbwebb` med följande kommando.

```text
$ dbwebb check
```

Läs vidare för att se vad du kan göra med kommandot `dbwebb`.

Så här kan det se ut.

[ASCIINEMA src=24612]



Konfigurera {#config}
-----------------------------------------------

Låt `dbwebb` skapa en konfigurationsfil, den är nödvändig och behövs.

```text
$ dbwebb config
```

Kommandot skapar en konfigurationsfil och lagrar din studentakronym. Du skall ange den akronymen som du fått av BTH. Det är den användare som du använder för att logga in på studentservern, studentportalen och läroplattformen ITs.

Din akronym kan se ut så här, som exempel:

```text
goli14
mase15
```

Akronymen består av dina initialer följt av året som ditt studentkonto skapades.

Konfigurationsfilen sparas i din lokala hemmakatalog, du kan titta på dess innehåll via följande kommando.

```text
$ cat $HOME/.dbwebb.config
```

Om något blir fel så kan du alltid skapa om din konfigurationsfil. Det är bara att köra samma kommando igen.

Så här kan det se ut.

[ASCIINEMA src=24613]



Uppdatera {#selfupdate}
-----------------------------------------------

Du kan alltid uppdatera till senaste versionen av `dbwebb` genom att köra följande kommando.

```text
$ dbwebb selfupdate
```

Du kan behöva köra kommandot som root genom att använda sudo. Det är för att du behöver rättigheter att skriva till filen `/usr/local/bin/dbwebb` där kommandot installerades.

```text
$ sudo dbwebb selfupdate
```

Så här kan det se ut.

[ASCIINEMA src=24615]



Kontrollera din omgivning {#check}
-----------------------------------------------

Om något inte fungerar som det ska kan du behöva lite hjälp med felsökningen. Kör följande så inspekterar `dbwebb` sin omgivning.

```text
$ dbwebb check
```

Så här kan det se ut.

[ASCIINEMA src=24616]



SSH-nycklar {#sshkey}
-----------------------------------------------

När du loggar in på studentservern behöver du ange ditt lösenord. Det blir jobbigt i längden. Därför är det lika bra att skapa SSH-nycklar som automatiskt sköter din autentisering när du loggar in.

Kommandot `dbwebb` hjälper dig att skapa dessa nycklar och installerar dem också på studentservern genom följande kommando.

```text
$ dbwebb sshkey
```

SSH-nycklarna sparas i din hemmakatalog under `$HOME/.ssh`. 

```text
$ ls -l $HOME/.ssh
```

Är du nyfiken på hur de kan se ut så kikar du på de filer som ligger i den katalogen.

Så här kan det se ut.

[ASCIINEMA src=24617]



Logga in på servern {#login}
-----------------------------------------------

Kommandot `dbwebb` jobbar mot en server. Det är på den servern, studentservern allmänt kallad, som det färdiga kursmaterialet laddas upp, valideras och publiceras.

Med hjälp av `dbwebb` kan du logga in på studentservern.

```text
$ dbwebb login
```

Skriv `exit` när du vill logga ut.

```text
$ exit
```

Så här kan det se ut.

[ASCIINEMA src=24618]



Klona ett kursrepo {#clone}
-----------------------------------------------

Kursmaterial finns samlat i kursrepo, kurskataloger, som laddas ned från Github. Så här kan du ladda ned ett kursrepo för kursen htmlphp, eller *klonar* kursrepot, som vi brukar säga.

Förslagsvis så samlar du alla kursrepon i en och samma katalog och döper den till `dbwebb-kurser`. Du kan lägga katalogen var du vill, men direkt under din hemmakatalog är en bra plats.

```text
# Byt $HOME till $HOMEPATH för hemmakatalog för Windowsanvändaren
$ mkdir $HOME/dbwebb-kurser
$ cd $HOME/dbwebb-kurser
```

Använder du Windows och Cygwin kan du byta ut `$HOME` mot `$HOMEPATH` så får du sökvägen till din hemmakatalog för din Windowsanvändare.

Du kan också lägga dina kursrepon på en delad disk, till exempel Dropbox eller motsvarande. Det gör att dina kursrepon kan vara tillgängliga oavsett vilken dator du sitter vid. Det är bra om du till exempel har flera datorer som du använder när du jobbar med kursmaterialet.

Nu tar vi reda på vilka kursrepon som finns.

```bash
$ dbwebb clone
```

Sen väljer du det kursrepo som matchar din kurs. Till exempel så här för htmlphp-kursen.

```bash
$ dbwebb clone htmlphp
$ cd htmlphp
$ ls
```

Kursmaterialet laddas nu ned och sparas i katalogen `htmlphp`.


Så här kan det se ut.

[ASCIINEMA src=24620]



Initiera kursrepo och server {#init}
-----------------------------------------------

Innan du kan börja jobba med ett kursrepo så behöver du initiera både kursrepot och studentservern.

```text
$ dbwebb init
```

Det som händer är ett antal saker. 

För det första så initieras ditt kurs-repo genom att katalogen `me` skapas tillsammans med ett antal underkataloger. Det är en standardstruktur som du skall följa i kursen.

För det andra så loggar `dbwebb` in på studentservern och skapar en katalogstruktur, dels skapas katalogen `$HOME/dbwebb-kurser` dit ditt kursrepo kommer att laddas upp och dels skapas katalogen `$HOME/www/dbwebb-kurser` där dina filer läggs som blir synliga via webbservern.

För det tredje så laddas din katalogstruktur upp till servern. Först till serverns katalog `$HOME/dbwebb-kurser` och därefter till serverns katalog `$HOME/www/dbwebb-kurser`.

När du kört kommandot kan du pröva att logga in på studentservern och se att katalogerna har skapats.

I båda fallen så skrivs inga filer eller kataloger över, om de redan finns så får de vara var. Det betyder att du kan köra `dbwebb init` flera gånger utan att något förstörs lokalt. Däremot laddas din lokala version upp till servern varje gång.

Kommandot `dbwebb init` är samma som att köra följande kommandon.

```text
$ dbwebb init-me
$ dbwebb init-server
$ dbwebb init-structure-dbwebb-kurser
$ dbwebb init-structure-www-dbwebb-kurser
```

Så här kan det se ut. I exemplet initierar jag kursen htmlphp samt loggar in på servern för att se hur katalogerna skapades.

[ASCIINEMA src=24621]



Kursrepot finns på GitHub {#github}
-----------------------------------------------

Du kan hitta länken till kursrepots källkod på GitHub på följande sätt.

```text
$ dbwebb github htmlphp
```

Om du hittar felaktigheter i kursrepot, eller vill föreslå förbättringar, så öppnar du enklast en *issue* på GitHub. Länken dit fick du av föregående kommando.

Du får gärna skapa *pull-request* om du vill bidra med kod, bara kör på.

Du kan ta reda på vilka kursrepo som finns genom att skriva följande.

```text
$ dbwebb github
```

Då får du även länken till GitHub-repot för kommandot `dbwebb`.



Ladda upp på servern {#upload}
-----------------------------------------------

Du kan ladda upp ditt lokala kursrepo, eller delar av det, till studentservern på följande sätt.

```text
$ dbwebb upload
$ dbwebb upload me
$ dbwebb upload kmom01
$ dbwebb upload lab1
```

Hela kursrepot laddas då upp till studentservern. På studentservern tas det backup varje natt.



Ladda ned från servern {#download}
-----------------------------------------------

Du kan ladda ned ditt kursrepo, eller delar av det, från studentservern till ditt lokala kursrepo. Detta kan vara bra om du sitter på flera maskiner och jobbar med samma filer.


```text
$ dbwebb download
$ dbwebb download me
$ dbwebb download kmom01
$ dbwebb download lab1
```

Hela kursrepot, eller den valda delen, laddas ned från studentservern. om du har filer på i din lokala katalog, som du ändrat i, så skrivs de inte över.

Det kan vara lite svårt att hålla sina filer synkroniserade, så om du jobbar på flera datorer så är det bättre att lägga ditt kursrepo på Dropbox eller motsvarande disk som du kan dela mellan flera datorer.



Uppdatera kursrepot {#update}
-----------------------------------------------

Du kan uppdatera ditt kursrepo så att det hämtar hem de senaste ändringarna. Det kan vara bra att göra det om något kursmaterial har uppdaterats.

```text
$ dbwebb update
```



Skapa labbar {#create}
-----------------------------------------------

Vissa kursmoment innehåller laborationer som du behöver skapa. Det gör du på följande vis.

```text
$ dbwebb create lab1
```

Du anger vilken labb det gäller och sedan skapas alla filer som labben består av.



Validera kursrepot {#validate}
-----------------------------------------------

Du kan validera kursrepots filer. Validering innebär att ett antal tester körs på filerna. Om testerna misslyckas visas ett felmeddelande som berättar vad du behöver göra för att rätta till felet.


```text
$ dbwebb validate
$ dbwebb validate me
$ dbwebb validate kmom01
$ dbwebb validate lab2
```

Du anger vad som skall valideras, om du inte anger något så valideras hela ditt kursrepo.

Om du är intresserad av vad som sker bakom kommandot `dbwebb validate` så kan du läsa mer om det i [artikeln för kommandot `dbwebb-validate`](dbwebb-validate).



Publicera kursrepot {#publish}
-----------------------------------------------

Du kan publicera kursrepots filer. publicering innebär att filerna kopieras över till en katalog där de kan nås via en webbserver. Samtidigt så minifieras filerna. Om det blir felmeddelande i processen så är det något du behöver rätta till.

```text
$ dbwebb publish
$ dbwebb publish me
$ dbwebb publish kmom01
$ dbwebb publish lab2
```

Du anger vad som skall publiceras, om du inte anger något så valideras hela ditt kursrepo.

Om du är intresserad av vad som sker bakom kommandot `dbwebb publish` så kan du läsa mer om det i [artikeln för kommandot `dbwebb-validate`](dbwebb-validate).



###Snabbare publish med `fastpublish` {#fastpublish}

Man kan göra en snabbare publish som hoppar över valideringsfasen.

```text
$ dbwebb fastpublish kmom01
```

Att publicera snabbt kan var bra om man sitter och testar små ändringar och vill se om de fungerar.



###Felsök publiserad kod med `purepublish` {#purepublish}

Man kan göra en snabb publish som även hoppar över minifieringsfasen. Det är bra om du vill felsöka via de radnummer som anges i den publiserade koden. Minifieringsfasen ändrar radnumreringen i din källkod och det kan ibland vara enklare att felsöka på ominifierad kod.

Publicera din kod oförvanskad och icke minifierad.

```text
$ dbwebb purepublish kmom01
```

Bra för felsökning kopplad till radnummer.



Inspektera kursrepot {#inspect}
-----------------------------------------------

Du kan inspektera ett kursmoment och dess delar. Det är tester som körs på ett kursmoment och de uppgifter som kursmomentet innehåller.

När lärarna rättar ditt kursmoment så är det så här de kör testerna. Du kan alltså provrätta din inlämning på egen hand och se samma resultat som lärarna ser.

```text
$ dbwebb inspect kmom01
```

Du anger vilket kmom som skall inspekteras.

Du kan också inspektera godtyckligt kursmoment i godtycklig kurs, oavsett var du står i filsystemet. Det gör den enkelt att köra inspect, utan att behöva stå i rätt kursrepo, eller ens ha tillgång till kursrepot på den lokala maskinen.

```text
$ dbwebb inspect python kmom01
```



Kör kommando på remote server {#run}
-----------------------------------------------

Ibland är det behändigt att köra ett kommando på studentservern. Du kan göra det direkt från din egen terminal via `dbwebb run`.

```text
$ dbwebb run "ls -l"
```

Kör ovanstående så ser du vilka filer som ligger i din hemmakatalog på studentservern.

Om du vill att kommandot skall köras i en annan katalog så lägger du till sökvägen i `--cwd`, vilket står för *current working directory*.

```text
$ dbwebb --cwd "dbwebb-kurser/htmlphp" run "ls -l"
```

Om du vill att kommandot skall köras på en speciell server så kan du ange serverns namn i  `--host`.

```text
$ dbwebb --host nodejs1.student.bth.se run "ls -l"
```



Utveckling och feedback {#issues}
-----------------------------------------------

Om du stöter på problem med kommandot så kan du rapportera fel som en [issue på GitHub](https://github.com/mosbth/dbwebb-cli/issues?q=is%3Aissue+is%3Aopen). 

På samma plats kan du föreslå förbättringar eller förändringar av kommandot.



Avslutningsvis {#avslutning}
-----------------------------------------------

Om du har [frågor kring kommandot `dbwebb`](t/4015) så ställer du dem i forumet.




