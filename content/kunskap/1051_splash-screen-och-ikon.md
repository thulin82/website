---
author: aar
category: javascript
revision:
  "2017-03-20": (A, aar) Första utgåvan inför kursen webapp v2.
...
Lägg till en Splash screen och ändra ikon
==================================

Vi ska kolla på hur vi lägger till en splash screen och byter ikon i en app. En splash screen är "laddnings"-bilden som de flesta appar har när den startar.  
För splash screen och ikon ska vi använda "[cordovas plugin](https://cordova.apache.org/docs/en/latest/reference/cordova-plugin-splashscreen/index.html)".

Du kan hitta koden för detta exempel på [Github](https://github.com/dbwebb-se/webapp/tree/master/example/splashScreen/www) och i `example/splashScreen`.

<!--more-->



Introduktion {#introduktion}
--------------------------------------

Vi utgår ifrån att du har ett projekt eller att du skapar ett nytt som har plattformarna Browser och Android.

Vi börjar med att lägga till plugin:et.

```bash
cordova plugin add cordova-plugin-splashscreen
```

Nu behöver vi bilder, många bilder. Om du tittar i mappen `platforms/android/res/` borde det finnas runt 8 mappar som heter "drawable-..." och fyra som heter "mipmap-...". "l-x"-DPI står för olika [skärmstorlekar](https://phonegappro.com/phonegap-tutorial/phonegap-icon-and-splash-screen-sizes/), tanken är att vi ska han en bild i varje mapp med passande storlek. Mapparna som börjar på "drawable" är för _splash screens_ och mapparna som börjar på "mipmap" är för ikoner.

### Bilder {#bilder}

För att skapa ikoner tar jag hjälp av [icons launcher](https://romannurik.github.io/AndroidAssetStudio/icons-launcher.html). Här kan du både ladda upp egna bilder och använda dig av Clipart's. När du bestämt dig för hur den ska se ut kan du ladda ner bilden med rätt storlekar.  
Om du väljer att ladda upp en egen bild bör den minst vara av storlek `1024x1024`. Jag har ingen bra bild i den storleken så jag väljer att använda dbwebb's favicon bild.

[FIGURE src=/image/kunskap/cordova/create_icon_splash.png?w=700&h=500]

När jag laddar ner filerna får jag en mapp-struktur som ser ut som nedan. Jag lägger den i `www/`. 

```bash
res/
├── android
│   ├── mipmap-hdpi
│   │   └── dbwebb_splash_icon.png
│   ├── mipmap-mdpi
│   │   └── dbwebb_splash_icon.png
│   ├── mipmap-xhdpi
│   │   └── dbwebb_splash_icon.png
│   ├── mipmap-xxhdpi
│   │   └── dbwebb_splash_icon.png
│   └── mipmap-xxxhdpi
│       └── dbwebb_splash_icon.png
└── web_hi_res_512.png
```

För att skapa splash bilder finns det också hjälp, googla på "splash screen generator". Då ska bilden du använder dig utav minst vara av storleken `2208x2208`. För att spara tid väljer jag att återanvända ikonerna.



Konfigurera appen {#config}
--------------------------------------

Då är det dags att bestämma när varje bild ska visas. Det gör vi i genom att ändra i `config.xml`. Vi börjar med att fixa det för Android.

Om du inte har en platfform-tag med android lägger du till det.

```xml
<platform name="android">
    <allow-intent href="market:*" />
</platform>
```

Här ska vi länka bilder till vilken mapp de ska flyttas. Bilderna kommer kopieras till mapparna i `platforms/android/res/` när vi bygger appen.



### Ikoner {#ikoner}

Vi börjar med ikonerna.
 
```xml
<platform name="android">
    ...
    <icon density="hdpi" src="www/res/mipmap-hdpi/dbwebb_splash_screen.png" />
</platfor>
```
När vår app installeras på en enhet med "hdpi" skärm kommer vår app få ikonen som ligger i `www/res/mipmap-hdpi/`.

Vi lägger till fler.

```xml
<platform name="android">
    ...
    <icon density="hdpi" src="www/res/mipmap-hdpi/dbwebb_splash_screen.png" />
    <icon density="mdpi" src="www/res/mipmap-mdpi/dbwebb_splash_icon.png.png" />
    <icon density="xhdpi" src="www/res/mipmap-xhdpi/dbwebb_splash_icon.png.png" />
</platfor>
```

Jag väljer att lägga in tre skärmar, om du vill kan du lägga till resterande bilder och storlekar. Du kan använda dig av samma bild till flera storlekar, t.ex. har vi ingen bild för "ldpi" då kan du använda samma som för t.ex. "mdpi".

Då kollar vi hur det ser ut. Kör kommandot `cordova emulate android`. Navigera till dina appar, där borde du se din app med din nya ikon. Dina ikoner borde nu ha flyttats till `platforms/android/res/mipmap-Xdpi`. 

[FIGURE src=/image/kunskap/cordova/icon_on_phone.png?w=600&h=400]

Om du vill kan du testa använda bilder som ser olika ut och köra appen i emulatorer av olika storlekar för att se ikonen ändras. 



### Splash screen {#splash_screen}

Som jag skrev ovanför kommer jag återanvända ikon bilderna som splash screen. 

Vi ska göra likadant för splash screen som vi gjorde för ikoner. I `config.xml` inom android-taggen lägger vi till följande.

```xml
<splash density="port-hdpi" src="www/res/mipmap-hdpi/dbwebb_splash_icon.png.png" />
<splash density="port-mdpi" src="www/res/mipmap-mdpi/dbwebb_splash_icon.png.png" />
<splash density="port-xhdpi" src="www/res/mipmap-xhdpi/dbwebb_splash_icon.png.png" />

<splash density="land-hdpi" src="www/res/mipmap-hdpi/dbwebb_splash_icon.png.png" />
<splash density="land-mdpi" src="www/res/mipmap-mdpi/dbwebb_splash_icon.png.png" />
<splash density="land-xhdpi" src="www/res/mipmap-xhdpi/dbwebb_splash_icon.png.png" />
```

Vi döper taggarna till "splash" iställer för "icon", när vi specificerar vilken skärm varje bild ska kopplas till behöver vi lägga till om skärmen ska vara i "portrait" eller "landscape" läge. Vi testar, starta upp din emulator och kör igång appen så borde din splash screeen visas i någon sekund innan du kommer vidare till appens startsida.

<figure style="overflow: auto">
[FIGURE src=/image/kunskap/cordova/splash_running.png?w=600&h=400 class=left caption="Splash screen portrait"]
[FIGURE src=/image/kunskap/cordova/splash_running_land.png?w=400&h=200 caption="Splash screen landscape"]
</figure>

Vad vackert det blev. Om jag hade använt mig av bilder med korrect storlek hade det blivit mycket bättre så jag hoppas det ser bättre ut hos dig.

Testa att köra din app i webbläsaren, det kan hända att du även har en splash screen där. Det är ovanligt att använda splash screen i webbläsaren, du kan få avgöra själv om du vill göra det. Vi går igenom hur du ändrar bilden och hur du kan stänga av den för webbläsaren. I webbläsaren är det alltid samma bild som visas så där behöver vi bara lägga till en bild.

Om du inte har en `<platform name="browser">` tag lägger du till det.  
För att stänge av splash screen för webbläsaren lägger du till `<preference name="ShowSplashScreen" value="false"/>` innanför browser-taggen. Alternativt ändra `value` till `true` för att aktivera den.  
För att ändra bilden lägger du till `<preference name="SplashScreen" value="www/res/web_hi_res_512.png"/>` innanför browser-taggen.

Det finns [inställningar för splash screen](https://cordova.apache.org/docs/en/latest/reference/cordova-plugin-splashscreen/index.html#preferences) där ni bl.a. kan ställe in hur länge den ska visas och vad den ska ha för bakgrundsfärg.



Avslutningsvis {#avslutning}
--------------------------------------

Nu har vi fixat en ikon och en splash screen. I och med att vi bara använder oss av Android kunde vi ha lagt in bilderna direkt i mapparna i `platforms/android/res/` men nu vet vi hur man gör om vi hade haft flera plattformar.

Om du har frågor eller tips så finns det en särskild tråd i forumet om [denna artikeln](t/40777).