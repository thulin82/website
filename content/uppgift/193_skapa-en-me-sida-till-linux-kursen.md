---
author: mos
category: webbprogrammering
revision:
  "2015-06-24": (A, mos) Första utgåvan i samband med kursen linux.
updated: "2015-06-24 09:55:28"
created: "2015-06-24 06:36:06"
...
Skapa en me-sida till linux-kursen
==================================

Bygg en enkel webbplats för kursen linux, den ska innehålla två saker, en me-sida som berättar lite om dig själv och en redovisningssida som sammanställer  dina redovisningar i kursen.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har installerat kursens labbmiljö samt installerat kommandot `dbwebb` och du har clonat kursrepot.



Introduktion {#intro}
-----------------------

Du skall spara alla filer i ditt kursrepo i katalogen `me/redovisa`. Det finns exempelfiler som du kan utgå ifrån. Börja med att kopiera in dem till ditt kursrepo.

```bash
# Ställ dig i rooten av kursrepot
cp -i example/me/* me/redovisa/
```

Nu har du din bas du kan utgå ifrån.



Krav {#krav}
-----------------------

1. Skriv en kort presentation av dig själv, vem du är, vad du gör och vad dina förväntningar är på kursen. Välj själv. Det räcker med 10-15 rader, det behöver inte vara så avancerat. Skriv i filen `me/redovisa/me.html`.

2. Titta i file `me/redovisa/report.html`. Skriv in vilken utvecklingsmiljö du sitter på, bara för att testa så allt fungerar.

3. Förbered din redovisningssida så att den innehåller rubriker för samtliga kursmoment. Ha alla redovisningarna på en sida.

4. Validera och publicera din kod enligt följande.

```bash
# Ställ dig i kurskatalogen
#dbwebb validate redovisa
dbwebb publish redovisa
```

Rätta eventuella fel som dyker upp och publicera igen. När det ser grönt ut så är du klar. 



Extrauppgift {#extra}
-----------------------

Det finns ingen extrauppgift.



Tips från coachen {#tips}
-----------------------

Lycka till och hojta till i forumet om du behöver hjälp!




