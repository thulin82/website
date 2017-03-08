---
author: aar
category: webbprogrammering
revision:
  "2017-03-07": (A, aar) Första utgåvan inför uppdatering av kursen webapp.
created: "2017-03-07 14:48:59"
...
Installera Apache Cordova
==================================

[FIGURE src=/image/kunskap/cordova_logo.png?w=500&h=300]

Denna guide visar dig hur du installerar Apache Cordova. 

Apache Cordova är ett open source [cross-plattform tool](https://en.wikipedia.org/wiki/Cross-platform) som används för att utveckla [hybrida mobilappar](https://ymedialabs.com/hybrid-vs-native-mobile-apps-the-answer-is-clear/) till flera operativsystem, bl.a. Android och iOS.
Apparna utvecklas i HTML, CSS och JavaScript, Cordova kan sen paketerar om dem till mobilappar som funkar på alla operativsystem Cordova stödjer.

<!--more-->



Läs mer {#mer}
-------------------------------

Du kan läsa mer om [Cordova på webbplatsen](https://cordova.apache.org).



Förutsättning {#pre}
-------------------------------

För att installera Cordova behöver du [npm](kunskap/installera-node-och-npm) installerat.

Vi kommer använda Cordova för att skapa Android appar och därför behöver du ha [Android SDK och emulator](kunskap/installera-en-emulator-for-android) installerat. Det innefattar även att du har systemvariabeln `ANDROID_HOME` och underliggande mappar `tools` och `platform-tools` i din `PATH`.  
Du behöver även [Java JDK version 7 eller senare](http://www.oracle.com/technetwork/java/javase/downloads/index.html).


Installera Cordova {#cordova}
--------------------------------------

Kör följande kommando.

```bash
$ npm install -g cordova
$ cordova --version
```



Kolla förutsättningarna är på plats {#check}
--------------------------------------

Först behöver du skapa ett nytt Cordova projekt.

```bash
$ cordova create hello com.example.hello HelloWorld
```

Nu har du skapat ett hello world exempel. Du kan gå in i `www` mappen och kolla på koden.  
För att testa appen måste vi lägga till plattformar.

```bash
$ cd hello
$ cordova platform add android --save
```

För att kolla att Cordova har allt den behöver kör kommandot.

```bash
$ cordova requirements
Requirements check results for android:
Java JDK: installed 1.8.0
Android SDK: installed true
Android target: installed android-25
Gradle: installed 
```

Om allt är installerat kan du testa starta upp emulatorn.

[FIGURE src=/image/kunskap/android-emulator-cordova-app.png?w=200&h=400 class=right]
```bash
$ cordova emulate android
```


Nu bör android emulatorn starta och Cordova appen visas.

I och med att appen är skriven i HTML, CSS och JavaScript kan du även öppna `index.html` filen, som ligger i `www` mappen, i webbläsaren och även testa koden där. 

Det går även att lägga till webbläsaren som en plattform till appen.

```bash
$ cordova platform add browser --save
$ cordova emulate browser
```



Kända fel {#fel}
--------------------------------------

**Gradles sync failed create process error=216...**: kan förekomma om man inte har Java JDK installerat eller den inte finns i PATH.

**Failed to find target with hash string ‘android-25’...**: kan beroe på fel path till SDK:n.

**Android SDK not found**: kan förekomma om du inte har installerat SDK:n, du har inte lagt den i din PATH eller om du har installerat Android studio istället för bara SDK:n. Om du har installerat Android studio behöver du ladda ner SDK:n, endast SDK:n, och ersätta din nuvarande med den nya.

**Could not find gradle wrapper within Android SDK**: om du har installerat Android studio istället för enbart SDK:n behöver du ladda ner SDK:n och ersätta din gamla.

**Error: No emulator images (avds) found**: du behöver skapa en emulator. Kör kommandot `android avd` och skapa en emulator.



Avslutningsvis {#avslutning}
--------------------------------------

Nu har du förhoppningsvis kommit igång med Cordova och kan starta en Cordova app i en Android emulator.

Om du har frågor eller tips så finns det en särskild tråd i forumet [för Mac](t/4903) och [för windows](t/4899) om denna artikeln.

Du kan även hittar med info på [Cordovas egna hemsida](https://cordova.apache.org/docs/en/latest/guide/cli/index.html).
