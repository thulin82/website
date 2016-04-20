---
author: mos
category: webbprogrammering
revision:
  "2015-08-27": (A, mos) Första utgåvan i samband med kursen htmlphp v2.
updated: "2015-08-27 13:58:27"
created: "2015-08-27 13:56:41"
...
Bygg ut din htmlphp me-sida till version 6
==================================

Bygg in en databasdriven multisida, in din me-sida, som löser CRUD så att man kan lägga till, uppdatera, radera och visa innehåll i databasen.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har utfört uppgiften "[Bygg ut din htmlphp me-sida till version 5](htmlphp/proj5)".

Du har jobbat igenom artikeln "[Kom igång med SQLite och PHP PDO](kunskap/kom-igang-med-sqlite-och-php-pdo)". Artikeln innehåller kodbasen du behöver.



Introduktion {#intro}
-----------------------

Du skall lägga till en del, en multisida, till din mesida, där du kan jobba mot innehållet i en databas. Du skall kunna skapa nya rader i databasen, uppdatera informationen i befintliga, ta bort rader och visa samtliga rader.



###Börja med att kopiera me-sidan {#copyme}

Börja med att ta en kopia från föregående uppgift `me5`, och bygg vidare på den.

```bash
# Ställ dig i kursrepot
cd me
cp -ri kmom05/me5/* kmom06/me6/
```

Nu har du din bas du kan utgå ifrån. Din resulterande sida skall finnas i katalogen `me/kmom06/me6`.

Du kan jobba vidare på den databasen du använde i föregående kursmoment tillsammans med `search.php`. Databasen innehöll dinosaurier, eller om du hittade på något eget.



Krav {#krav}
-----------------------

1. Se till att skriva DRY kod. Strukturera i funktioner och filer, så som du lärt dig under kursens gång.

1. Skapa en ny multisida och döp den till `admin.php`. Lägg till ett menyval i navbaren för sidan.

1. Skapa en undersida till `admin.php`, vi kallar den för "create". Sidan skall innehålla ett formulär där du kan fylla i detaljer om en dinosaurie (eller vad du nu valt) och en knapp för att lägga till en ny dinosaurie till din databas.

1. Skapa en ny sida "update". Via denna sidan skall man kunna uppdatera detaljer om en dinosarie och välja att spara dem.

1. Skapa en undersida "delete" med vilken man kan radera en dinosaurie.

1. Skapa en undersida "read" som visar samtliga dinosaurier i databasen.

1. Försäkra dig om att din befintliga sida `search.php` nu hittar alla dinosaurier i din databas.

1. Dubbelkolla att alla tidigare länkar och funktioner fungerar i din me-sida.

1. Validera och publicera din kod enligt följande.

```bash
# Ställ dig i kursrepot
#dbwebb validate me6
dbwebb publish me6
```

Rätta eventuella fel som dyker upp och publicera igen. När det ser grönt ut så är du klar. 



Extrauppgift {#extra}
-----------------------

1. Länka mellan dina olika undersidor. Till exempel, när du visar innehållet i databasen så visar du även länkar till att göra "update" och "delete" för respektive rad.

1. Lägg extra kraft på stylen, nu är din mesida i stort sett klar och lite extra kraft på CSS kan göra underverk.



Tips från coachen {#tips}
-----------------------



Lycka till och hojta till i forumet om du behöver hjälp!




