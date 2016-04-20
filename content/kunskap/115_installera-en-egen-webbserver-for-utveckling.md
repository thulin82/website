---
author: mos
category: labbmiljo
revision:
  "2015-08-17": (E, mos) La till info om symboliska länkar.
  "2015-04-10": (D, mos) Tog bort referens till jEdit.
  "2015-01-21": (C, mos) Ändrade hur man byter port på Apache i Windows.
  "2014-09-15": (B, mos) Bytte till XAMPP och lade hit instruktionen från forumtråd.
  "2012-08-29": (A, mos) Första versionen, flyttad från annat dokument och uppdaterad.
updated: "2015-08-17 06:41:56"
created: "2012-08-29 21:02:30"
...
Installera en egen webbserver för utveckling
==================================

[FIGURE src=/img/xampp/xampp-logo.svg class="right w100"]

Se till att du har en egen lokal utvecklingsmiljö för dina webbsidor. I dbwebb-kurserna så använder vi alltid en driftsserver dit vi laddar upp resultatet när vi är klara. Men det underlättar om man har en egen utvecklingsmiljö så att man inte är beroende av studentservern.

<!--more-->



Webbserver Apache httpd med PHP och databas {#webbserver}
--------------------------------------------------------------------

Det finns ett antal sätt att installera Apache och PHP. Välj ett som du känner dig bekväm med. 

Som rekommenderad miljö på Windows och Mac OS används [XAMPP](https://www.apachefriends.org/index.html). 

Jag har valt att använda XAMPP eftersom den är open source och fungerar bra. XAMPP är lätt att installera och komma igång med och den har ett trevligt och har ett enkelt gränssnitt. Dessutom finns den både till Windows, Mac OS och Linux.

[Tidigare användes WAMPServer (Windows) och MAMP (Mac)](#aldre). Alla tre fungerar för kurserna och du kan välja vilken du vill. Får du problem så kommer jag troligen be dig använda XAMPP.



Installera XAMPP {#install}
--------------------------------------------------------------------

Så här installerade jag:

1) Gå till hemsidan för XAMPP och ladda ned det paketet du vill ha (Windows, Mac).


2) Kör en ren installation, se till att du är Administratör på din Windows-maskin (för att undvika problem).


3) Ändra så att Apache kör på 8080 (för att undvika problem när någon annan redan kör på port 80, typ Skype eller befintlig webserver). I Mac klickar du på "Configure" och ändrar port i rutan som poppar upp. I Windows är det lite krångligare, du gör så här. 

3.1) Öppna Apaches konfigfil `httpd.conf` genom att klicka på knappen "Config" och väljer sedan "Apache (httpd.conf)" i den menyn som kommer upp.

[FIGURE src=/image/xampp/xampp-config-port.png&w=w2 caption="Öppna konfigfilen till Apache."[/FIGURE]

3.2) En texteditor öppnar filen `httpd.conf`. Leta reda på raden som säger:

```text
Listen 80
```

Ändra den raden så att Apache lyssnar på port 8080 istället för port 80.

```text
Listen 8080
```

[FIGURE src=/image/xampp/xampp-config-port-httpd.png&w=w2 caption="Byt port som Apache kör på för att undvika krockar med andra program."[/FIGURE]


4) Klar. Starta Apache

[FIGURE src=/image/xampp/start-apache.png?w=w2 caption="Starta Apache webbserver."[/FIGURE]

Apache har startat.

[FIGURE src=/image/xampp/apache-started.png?w=w2 caption="Nu snurrar Apache webbserver på din lokala maskin."[/FIGURE]


5) Peka webbläsaren till `http://localhost:8080/` eller `http://127.0.0.1:8080` (kopiera in länkarna till din webbläsare). Så här kan det se ut när XAMPPs standard hemsida visas.

[FIGURE src=/image/xampp/xampp-home.png?w=w2 caption="XAMPPs hemsida på din lokala maskin visas."[/FIGURE]


6) Xampp installeras i `C:\xampp` och webrooten ligger i `C:\xampp\htdocs` på Windows och i Mac OS gäller `/Applications/XAMPP/htdocs`. Gör följande steg för att testa din installation genom att skapa en HTML-sida och en PHP-sida. 


6.1) Skapa en katalog `test` i din htdocs-katalog (din webroot). 

[FIGURE src=/image/xampp/htdocs-create-test-dir.png?w=w2 caption="Katalogen `test` skapas i filväljaren."[/FIGURE]


6.2) Öppna samma katalog i din webbläsare. Länken dit är `http://localhost:8080/test` eller `http://127.0.0.1:8080/test`. Katalogen är tom för tillfället.

[FIGURE src=/image/xampp/firefox-test-empty.png?w=w2 caption="Katalogen `test` öppnad i webbläsaren via webbservern."[/FIGURE]


6.3) Skapa två filer i katalogen och döp dem till `test.html` (en HTML-sida) och `test.php` (en HTML -sida med PHP-kod).

[FIGURE src=/image/xampp/htdocs-create-test-files.png?w=w2 caption="Två filer skapade i katalogen test via filväljaren."[/FIGURE]

Kontrollera att du även ser filerna i din webbläsare genom att ladda om sidan (ctrl-r eller F5).

[FIGURE src=/image/xampp/firefox-test-files-empty.png?w=w2 caption="De nyskapade filerna är synliga via webbservern."[/FIGURE]


6.4) Öppna de båda filerna i din texteditor och lägg in följande kod i dem.

Kod till HTML-sidan `test.html`.

```html
<!doctype html>
<meta charset="utf-8">
<title>My test page</title>
<h1>My nice test page for PHP</h1>
```

[FIGURE src=/image/xampp/jedit-test-html.png?w=w2 caption="Filen `test.html` skapas i texteditorn."[/FIGURE]

Kod till PHP-sidan `test.php`.

```php
<!doctype html>
<meta charset="utf-8">
<title>My test page</title>
<h1>My nice test page for PHP</h1>
<p>
<?php echo "Hello Wold from PHP!"; ?>
</p>
```

[FIGURE src=/image/xampp/jedit-test-php.png?w=w2 caption="Filen `test.php` skapas i texteditorn."[/FIGURE]


6.5) Öppna de båda filerna i din webbläsare för att se hur de ser ut.

* `http://127.0.0.1:8080/test`

[FIGURE src=/image/xampp/firefox-test.png?w=w2 caption="Filerna ligger i katalogen och är synliga via webbläsaren."[/FIGURE]


* `http://127.0.0.1:8080/test/test.html`

[FIGURE src=/image/xampp/firefox-test-html.png?w=w2 caption="Visa filen `test.html` i webbläsaren."[/FIGURE]

* `http://127.0.0.1:8080/test/test.php`

[FIGURE src=/image/xampp/firefox-test-php.png?w=w2 caption="Visa filen `test.php` i webbläsaren."[/FIGURE]


Nu fungerar din installation av XAMPP tillsammans med HTML- och PHP-sidor.

Det finns en [forumtråd där du kan få hjälp om installationen krånglar](t/2705).



Länka från webbkatalogen till andra kataloger {#link}
--------------------------------------------------------------------

Säg att du har en katalog i din hemmakatalog, som du vill skall synas via webbservern. Lös det med en symbolisk länk från webbkatalogen till den katalog du vill visa.

Som exempel, säg att du har en katalog `dbwebb-kurser` i din hemmakatalog och du vill öppna den via webblänken `http://localhost/dbwebb/`. Du behöver då en länk `dbwebb`, som ligger i webbkatalogen och som pekar på katalogen `dbwebb-kurser` som ligger i din hemmakatalog.

Följ nedan instruktioner för att skapa länken på Windows eller på Mac OS.



###Skapa länk på Windows {#linkwin}

I Windows ligger din webbkatalog ofta under `c:\xampp\htdocs`. Du kan länka till en katalog med kommandot `mklink` i kommandoprompten. Öppna "Command Prompt" *som administratör* och kör följande kommando. 

```text
mklink /D c:\xampp\htdocs\dbwebb %USERPROFILE%\dbwebb-kurser
```

Konstruktionen `%USERPROFILE%` motsvarar din hemmakatalog. Du kan även ange hela sökvägen till din hemmakatalog. I mitt fall hade det varit följande.

```text
mklink /D c:\xampp\htdocs\dbwebb c:\Users\Mikael\dbwebb-kurser
```

Nu är länken skapad.

För att få hjälp med kommandot skriver du följande.

```text
mklink /?
```



###Skapa länk på Mac OS {#linkmac}

I Mac OS heter kommandot `ln` och en vanlig plats för webbkatalogen är `/Applications/XAMPP/htdocs`. Öppna din terminal och skapa länken på följande sätt.

```text
cd /Applications/XAMPP/htdocs
ln -s $HOME/dbwebb-kurser dbwebb
ls -l dbwebb
```

Så kan du skapa länken och testa att den skapades.



Apache på Linux och andra plattformar? {#linux}
--------------------------------------------------------------------

Det finns många andra plattformar att köra webbserver med PHP och databas på. Använder du Linux kan du köra XAMPP eller installera det på egen hand med en pakethanterare.



Äldre installationsbeskrivningar {#aldre}
--------------------------------------------------------------------

Dessa användes tidigare som installationsinstruktioner.

* [Så här installerar du WampServer på Windows 7](http://db-o-webb.blogspot.com/2010/09/installera-wampserver-pa-windows.html).

* [Så här installerar du MAMP på Mac](http://db-o-webb.blogspot.com/2010/09/installera-mamp-pa-os-x.html).


[INFO]
**Felsökning på Windows med WAMPServer.**

Möjliga problem vid installation på Windows:

* Klicka på "Put Online" i menyn (nedre högra hörnet) för WAMPServer. 

* Det finns en konflikt mellan WAMP och Skype. Vid problem vid installation av WAMP; testa att först stänga av Skype.

* Finns det redan en webbserver på din maskin, tex IIS?

* Har du sedan tidigare installerat MySQL?

* Vid problem, kontrollera alltid vad det står i loggfilerna för Apache, MySQL och PHP?
[/INFO]




