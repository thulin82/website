---
author:
    - lew
category:
    - javascript
    - kurs webapp
revision:
    "2017-04-05": "(B, mos) Ändrade krav 13 från felaktiga 3 till 7 som facit visar."
    "2015-11-23": "(A, mos) Första utgåvan i samband med kursen webapp."
...
Sökverktyg för JSON filer
==================================

Använd applikationen jq för att söka och visualisera data i en JSON fil. Svara på ett antal frågor genom att kombinera sökfrågor som du kör i verktyget jq och på det viset skapar du en egen förståelse för hur innehållet i en mer komplex JSON fil är uppbyggt.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat igenom artikeln "[Installera verktyget jq för att söka i JSON-filer](kunskap/installera-verktyget-jq-for-att-soka-i-json-filer)" och du har tillgång till verktyget jq via terminalen.



Introduktion {#intro}
-----------------------

Du skall spara alla dina filer i katalogen `me/kmom03/jq` eller `me/kmom02/jq` för webapp-v2.

JSON-filen som du jobbar med heter `tag-dbwebb.json` och kommer från Instagram och du kan kopiera den från exempelmappen.

```bash
# Gå till kursrepot
# kmom03 för webapp, kmom02 för webapp-v2
$ cp example/instagram/tag-dbwebb.json me/kmom03/jq
```

Skapa en körbar bash-fil som heter `solution.bash` och skriv alla dina svar i den filen. Så här kan inledningen på filen se ut inklusive lösningen på första kravet.

```bash
#!/usr/bin/env bash

# 1. Hitta de 'keys' som finns i filen. Lägg svaret i filen 'a.txt'.
jq 'keys' tag-dbwebb.json | tee a.txt

```

Kommandot `tee` skriver dels till en fil och dels till terminalen. Du kan nu testköra alla dina lösningar så här.

```bash
$ ./solution.bash
[                                                            
  "data",                                                    
  "meta",                                                    
  "pagination"                                               
]                                                            
$ cat a.txt       
[                                                            
  "data",                                                    
  "meta",                                                    
  "pagination"                                               
]                                                            
```

Fråga i forumet om du behöver ledtrådar till lösningarna. Du kan också tjuvkika i filen `example/solution/jq.txt`.



Krav {#krav}
-----------------------

Du skall samla ihop minst 15 poäng. Fråga 1-10 är värd en poäng var. Fråga 11-15 är värd 3 poäng var.

1. Hitta de 'keys' som finns i filen. Lägg svaret i filen 'a.txt'.

2. Vilket värde har `meta.code` som är statuskoden för HTTP requesten (b.txt)?

3. Filen innehåller en länk till nästa resultat i flödet, en så kallad pagination. Visa länken till nästa länk (next_url) (c.txt).

4. Hur många 'likes' har den tionde bilden (d.txt).

5. Vilka taggar (tags) har den första bilden (e.txt).

6. Visa detaljer om den användare (user) som lagt upp den första bilden (f.txt).

7. Den första bilden är tagen på en viss plats (location) som har ett visst namn (name), vilket (g.txt)?

8. Den första bilden har en kommentar (comments), visa texten (text) för kommentaren (h.txt).

9. Den första bilden har flera likes. Visa namnet på den andra personen som gjorde like på bilden (i.txt).

10. Visa länken till den första bilden som är av standard_resolution (j.txt).

11. (*Denna och resterande frågor är värda 3 poäng*) Användaren alkifaey har gjort en kommentar. Använd användarnamnet och visa själva kommentare (text) (k.txt).

12. Lista länkarna (link) till bilderna som användaren 'tobhed' har kommenterat (l.txt).

13. Lista länkarna till de bilder med fler 'likes' än 7 (m.txt).

14. Lista länkarna till de bilder som har fler än 5 'likes' och minst 1 'comment' (n.txt).

15. Hitta användarnamnet (username) på användare som likeat bilden som är tagen på 'Studentviken' (location "Studentviken") (o.txt).

11. Validera din kod enligt följande.

```bash
# Ställ dig i kurskatalogen
dbwebb validate jq
```

Rätta eventuella fel som dyker upp och validera igen. När det ser grönt ut så är du klar.



Extrauppgift {#extra}
-----------------------

Lägg lite extra tid på att göra följande extrauppgifter.

* Skapa de frågor som hjälper dig bygga en enkel Instagram-app, dels en lista över bilderna med comment och like-count samt en "undersida" där detaljer visas om en bild.



Tips från coachen {#tips}
-----------------------

Lycka till och hojta till i forumet om du behöver hjälp!
