---
author: mos
category: webbprogrammering
revision:
  "2015-10-26": (A, mos) Första utgåvan inför kursen webapp.
updated: "2015-10-26 23:52:55"
created: "2015-10-26 23:48:59"
...
Installera en emulator för Android
==================================

[FIGURE src=/image/snapht15/android-sdk-manager.png?w=c5&a=0,75,80,0 class="right"]

Denna guide visar dig hur du installerar de nödvändiga komponenterna av Android SDK för att kunna köra en Android emulator.

Jag kommer att installera endast det nödvändigaste för att få tillgång till emulatorn.

<!--more-->




Installera SDK {#sdk}
--------------------------------------

Du kan börja med att läsa översiktligt [om Android SDK och Android Studio](https://developer.android.com/sdk/index.html) som är ett mer komplett utvecklarverktyg.

Ladda nu ned [Android SDK Tools Only och installera](https://developer.android.com/sdk/installing/index.html). Det innehåller det vi behöver.

Installationsprogrammet kan be dig att installera Java JDK. Gör det.



Starta och uppdatera ditt SDK {#uppdatera}
--------------------------------------

På Mac och Linux startar du Android SDK Manager så här.

```bash
$ cd tools
$ ./android
```

På Windows använder du filemanagern och dubbelklickar på `SDK Manager.exe`. Jag testade att instalelra på Windows 10 och installationen hamnade under min användares katalog och "AppData/Local/Android".

[FIGURE src=/image/snapht15/android-sdk-install-path.png?w=w2 caption="Installationen av Android SDK på Windows 10."]

Det kan se ut så här när du startar SDK Managern.

[FIGURE src=/image/snapht15/android-sdk-manager.png?w=w2 caption="Android SDK manager behöver nu uppdateras."]

Du behöver nu [uppdatera ditt SDK](https://developer.android.com/sdk/installing/adding-packages.html) med nödvändiga komponenter. Det är komponenter som måste laddas ned för att emulatorn skall fungera. Klicka på knappen för att installera paketen, i bilden ovan är det knappen som visar, "Install 17 packages".

Det tar en stund att ladda ned och installera paketen.



Emulatorn {#emulator}
--------------------------------------

Androids SDK innehåller en [emulator](http://developer.android.com/tools/devices/emulator.html) där du kan testköra dina applikationer.

För att använda emulatorn behöver du skapa en [virtuell enhet](http://developer.android.com/tools/devices/index.html) som används för att emulera själva hårdvaran.

Starta fönstret som hjälper dig att skapa en virtuell enhet, använd menyn "Tools -> Manage AWDs...". Du får upp ett fönster med de virtuella enheter du har. Välj att klicka på "Create..." för att skapa en ny virtuell enhet.

Så här kan det se ut när du har fyllt i alla värden.

[FIGURE src=/image/snapht15/android-virtual-device.png caption="Här har jag skapat en Nexus 7 som en virtuell enhet."]

Pröva att skapa en liknande enhet som jag gjort i bilden ovan. Pröva gärna även andra varianter. Du har kanske nyare versioner än jag har av Android, då är det bara att använda det senaste. Välj en CPU som matchar din dator. *Glöm inte* att klicka i rutan för "Use Host GPU".

När du är klar kan du starta din emulator.



Starta emulatorn {#start}
--------------------------------------

[FIGURE src=/image/snapht15/android-emulator-launch-options.png class="right" caption="Jag har minskat skalan på mitt emulatorfönster."]

Du kan via GUI:et starta emulatorn med din nyskapade virtuella enhet. 

Det tar en liten stund att starta emulatorn. Om emulatorns fönster blir för stort så kan du skala om det när du startar det. 

På Mac och Linux kan du även starta emulatorn från kommandoraden.

```bash
# Gå till installationskatalogen
$ cd tools
$ ./emulator -avd Mynexus7   
```

Det kan förenkla felsökning och debugging att köra från kommandoraden.

Så här kan det se ut när din emulator har startat.

[FIGURE src=/image/snapht15/android-emulator-mynexus7.png?w=50% caption="Min Nexus 7 körs nu i en emulator."]



Emulatorn är kopplad till nätverket {#net}
--------------------------------------

Du kommer åt Internet från emulatorn utan att behöva göra något speciellt. Om du vill komma åt din lokala maskin, kanske kör du en webbserver lokalt, då använder du adressen 10.0.2.2. Det motsvarar localhost och 127.0.0.1 på din desktopdator.

<figure class="wrap">

[FIGURE src=/image/snapht15/android-emulator-dbwebb.png?w=50% class="left" caption="Webbläsaren kopplad till dbwebb.se."]

[FIGURE src=/image/snapht15/android-emulator-localhost.png?w=50% caption="Webbläsaren kopplad till localhost via 10.0.2.2"]

</figure>

Du kan läsa om vilka [nätverksinställningar som gäller för emulatorn](http://developer.android.com/tools/devices/emulator.html#emulatornetworking).



Felsök via loggen {#log}
--------------------------------------

Du kan se loggutskrifter från emulatorn via kommandot [`logcat`](http://developer.android.com/tools/help/logcat.html). Du kan starta det via kommandoraden så här.

```bash
# Gå till installationskatalogen
$ platform-tools/adb logcat
```

Det kan vara bra om du behöver felsöka.



Avslutningsvis {#avslutning}
--------------------------------------

Nu har du förhoppningsvis kommit igång och har en Android emulator som du kan använda för att testköra och pröva dina mobila webbapplikationer.

Om du har frågor eller tips få finns det en särskild [tråd i forumet](t/4741) för denna artikeln.




