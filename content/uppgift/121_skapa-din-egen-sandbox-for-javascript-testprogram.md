---
author: mos
category: javascript
revision:
  "2015-08-27": (C, mos) Uppgraderad till dbwebb-cli version 2.
  "2014-08-11": (B, mos) Genomgången och uppdaterade hur kopieringen görs.
  "2014-06-26": (A, mos) Första utgåvan i samband med javascript1.
updated: "2015-08-27 07:41:46"
created: "2014-06-13 13:47:10"
...
Skapa din egen Sandbox för JavaScript testprogram
==================================

Skapa en mall för dina testprogram med HTML, CSS och JavaScript enligt den standard som finns i kursen javascript1.

<!--more-->


Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat igenom artikeln "[Labbmiljö för JavaScript i webbläsaren](kunskap/labbmiljo-for-javascript-i-webblasaren)" och därmed har du denna uppgiften så gott som löst.



Krav {#krav}
-----------------------

1. I din kurskatalog (repot) för javascript1, skall du ta en kopia av exempelkatalogen `example/sandbox` och lägga i din me-katalog under `me/kmom01/sandbox`.

```bash
# Gå till kurskatalogen
cp -ri example/sandbox me/kmom01
```

2. Modifiera filerna så att de fungerar för dig som din egen personliga miljö för alla dina kommande exempelprogram i kursen.

3. Se till att filerna validerar som HTML, CSS och JavaScript.

4. Använd din sandbox och lägg upp som ett exempel i JSFiddle. Spara undan länken till din fiddle, du skall länka till den från din redovisningssida.



Extrauppgift {#extra}
-----------------------

Det finns ingen extra uppgift.



Publicera din kurskatalog {#publicera}
-----------------------

Ladda upp och publicera exempelprogrammet som en del av din me-sida genom att göra följande kommandon i kurskatalogen i terminalen.

```bash
# Gå till kurskatalogen
dbwebb validate sandbox
dbwebb publish sandbox
```

Rätta eventuella fel som dyker upp och publicera igen. När det ser grönt ut så är du klar. 

Dubbelkolla att din me-sida innehåller ditt sandbox-exempel. Använd länken som visas i slutet av utskriften. Den ser ut ungefär så här.

```bash
http://www.student.bth.se/~stud14/dbwebb-kurser/javascript1
```



Tips från coachen {#tips}
-----------------------

Lycka till och hojta till i forumet om du behöver hjälp!




