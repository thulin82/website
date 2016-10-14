---
author: mos
category: python
revision:
    "2016-09-29": (I, mos) Länkade till exempel för asciibild.
    "2015-08-25": (H, mos) Uppgraderade till dbwebb v2 samt la till extrauppgift om ascii-bild.
    "2015-04-22": (G, mos) Förtydligade att marvin4 inte skall stödjas.
    "2015-03-09": (F, mos) Ändrade länken till inspect.
    "2015-02-03": (E, mos) Gjorde SQLite som valbar.
    "2015-01-07": (D, mos) Förtydligade att seo i kombination med `--input` inte behöver url.
    "2014-12-16": (C, mos) Tog bort extrauppgiften eftersom den ofta löstes med extern modul som gjorde uppgiften svår att rättad.
    "2014-12-01": (B, mos) Förtydligade att title i kombination med `--input` inte behöver url.
    "2014-10-15": (A, mos) Första utgåvan i samband med kursen python.
updated: "2015-08-25 14:16:01"
created: "2014-07-03 08:14:49"
...
Din egen chattbot - Marvin - steg 5
==================================

Programmering och problemlösning i Python. Utveckla din chattbot Marvin så att den får ett kommandorads interface där du kan skicka olika argument till Marvin via kommandoraden.

<!--more-->


Förkunskaper {#forkunskaper}
-----------------------

Du har gjort de steg 1 till 3 med Marvin, kanske även steg 4.

Du har jobbat igenom artikeln "[Använd externa moduler i Python för att hämta information på webben](kunskap/anvand-externa-moduler-i-python-for-att-hamta-information-pa-webben)".



Introduktion {#introduktion}
-----------------------

Du skall du göra en kommandorads-version av Marvin. Du skall skicka in argument, eller options, på kommandoraden och därmed styra vad Marvin gör.

Så här kan det se ut.

```bash
# Generell användning av Marvin
./marvin-cli.py [options] command [arguments-to-the-command]

# Visa en hjälptext till vad din Marvin kan göra
./marvin-cli.py --help

# Pinga en webbsida med din Marvin
./marvin-cli.py ping http://dbwebb.se/humans.txt

# Hämta och skriv ut innehållet i en webbsida
./marvin-cli.py get http://dbwebb.se/humans.txt

# Hämta och spara webbsidan på en fil
./marvin-cli.py --output=humans.txt get http://dbwebb.se/humans.txt

# Visa upp dagens citat genom att hämta det från en webbtjänst
./marvin-cli.py quote

# Hämta och visa titeln för en webbsida
./marvin-cli.py title http://dbwebb.se
```

Ett argument in om `<>` skall finnas med, ett argument inom `[]` kan finnas med.

I denna uppgiften börjar du på ett nytt vitt blad, du ska inte stödja den gamla funktionaliteten som redan finns i ditt Marvin. Du ska bara koda in de nya kraven i din `marvin-cli`.



Krav {#krav}
-----------------------

1. <strike>Kopiera din Marvin från föregående kursmoment samla den i katalogen `me/kmom06/marvin5`. Utgå från den koden.</strike>



2. I katalogen `me/kmom06/marvin5`, skapa filen `marvin-cli.py` och låt det bli din kommandoradsklient för Marvin.



3. Följande options skall fungera.

* `-h, --help` skall visa en hjälptext som beskriver ditt program och hur det används.
* `-v, --version` skall visa versionen av programmet.
* `--verbose` skall innebära att mer text skrivs ut, kanske bra för debugging?
* `-s, --silent` skall innebära att minimalt med utskrift sker, bra om man bara vill se svaret.



4\. Om programmet exekverar på ett lyckat sätt så skall du använda exit-status 0. Blir det fel i parsningen av av options/argument så skall du använda exit-status 1. Blir det fel i exekveringen av ett kommando, till exempel att webbsidan inte svarar, då skall du ge exit-status 2.

Du kan dubbelkolla din exit-status genom att skriva:

```bash
./marvin-cli.py --help; echo $?   # Borde ge 0
./marvin-cli.py --moped; echo $?  # Borde ge 1
```



5\. Pinga en webbsida med följande kommando.

```bash
./marvin-cli.py ping <url>
```

Programmet skall ange status-koden för HTTP-anropet tillsammans med länken som besöktes. Ange `--silent` för att enbart visa statuskoden. Lagra undan resultatet i en fil eller i en SQLite-databas. Visa innehållet i filen (databasen) genom att ange kommandot.

```bash
./marvin-cli.py ping-history
```



6\. Ladda hem en webbsida med följande kommando.

```bash
./marvin-cli.py get <url>
./marvin-cli.py --output=<file> get <url>
```

Resultatet skall bli att webbsidans innehåll skrivs ut på skärmen. Om man anger ett option `--output=<file>` så skall utskriften ske till en fil, istället för skärmen.



7\. Visa dagens citat genom att hämta det från en webbtjänst.

```bash
./marvin-cli.py quote
./marvin-cli.py --input=<file> quote
```

Resultatet skall bli att citatet från webbtjänsten http://dbwebb.se/javascript/lekplats/get-marvin-quotes-using-ajax/quote.php skrivs ut.

Ange option `--input=<file>` för att hämta ett JSON-objekt från vald fil, istället för att hämta det från webbtjänsten. Du kan hämta ett JSON-objekt med flera quotes [här](javascript/lekplats/get-marvin-quotes-using-ajax/quote.php?all). Var uppmärksam på att formatet är lite annorlunda. Läs upp JSON-objektet och skriv ut det för att se dess struktur.



8\. Hämta och visa titeln från en vald webbsida. Titeln är det innehåll som ligger i elementet `<title></<title>`.

```bash
./marvin-cli.py title <url>
./marvin-cli.py --input=<file> title
```

Ange option `--input=<file>` för att hämta webbsidan från vald fil, istället för att hämta webbsidan från en webbplats.



9\. Hämta en webbsida och analysera den ur perspektivet sökmotoroptimering.

```bash
./marvin-cli.py seo <url> 
./marvin-cli.py --json seo <url>
./marvin-cli.py --input=<file> seo
./marvin-cli.py --json --input=<file> seo
```

Ange option `--input=<file>` för att hämta webbsidan från vald fil, istället för att hämta webbsidan från en webbplats.

Ange option `--json` för att generera rapporten i ett JSON-format och skriv ut den på ett snyggt sätt.

När du analyserar sidan ur SEO-perspektiv så skall du ta reda på följande om sidan.

* Sidan har (endast) ett element `<title>`, räkna antalet tecken i elementet.
* Räkna antalet element som är `<h1>` respektive `<h2>`.
* Räkna antalet länkar, element av typen `<a>`.



10\. Validera Marvin genom att göra följande kommando i kurskatalogen i terminalen.

```bash
# Ställ dig i kurskatalogen
dbwebb validate marvin5
```

Rätta eventuella fel som dyker upp och validera igen. När det ser grönt ut så är du klar. 

Du kan också testköra ditt program och se om det går igenom rättningen.

```bash
# Ställ dig i kurskatalogen
dbwebb inspect kmom06
```



Extrauppgift {#extra}
-----------------------

1\. I uppgift 5 så kan du använda databasen SQLite, istället för att lagra på fil.

2\. Hämta hem en bild från webben och skriv ut den som en ASCII-bild enligt följande. Använd biblioteket [Pillow](http://pillow.readthedocs.org/) för att lösa bildhanteringen. Du kan se hur man kan göra i exemplet [`example/image`](https://github.com/dbwebb-se/python/tree/master/example/image).

```bash
./marvin-cli.py ascii <url-to-image> 
```



Tips från coachen {#tips}
-----------------------

Validera ofta. Så slipper du en massa valideringsfel i slutet av övningen.

Använd `--verbose` för att skriva ut massa debugg-utskrifter när du utvecklar och testar.

Lycka till och hojta till i forumet om du behöver hjälp!
