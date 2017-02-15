---
author: efo
revision:
    2016-12-21: (A, efo) Första utgåvan.
category:
    - linux
    - bash
...
Ett bash script med options, command och argument
===================================

Du skall skapa ett bash script som tar emot options.

<!--more-->



Förkunskaper {#forkunskaper}
-----------------------

Du har jobbat igenom artikeln "[Skapa Bash-skript med options, command och arguments](kunskap/skapa-bash-skript-med-options-command-och-arguments)".

Du har läst kurslitteraturen och skaffat dig grundläggande kunskaper om bash. Du har gjort uppgifterna "[Lab2](uppgift/linux-lab-2-sok-i-en-logg-fil)" och "[Mina första Bash-script](uppgift/mina-forsta-bash-script)".



Introduktion {#intro}
-----------------------

Du ska skapa ditt eget `commands` script som tar emot options och arguments. Scriptet kan använda inbyggda bash funktioner.


[INFO]
**TIPS.**

Läs igenom hela artikeln "[Skapa Bash-skript med options, command och arguments](kunskap/skapa-bash-skript-med-options-command-och-arguments)" innan du börjar med uppgiften.

Det finns många inbyggda funktioner i bash, som kan underlätta vid lösning av nedanstående uppgifter, så utforska gärna kommandot `man` för olika kommandon för att få hjälp.
[/INFO]



Krav {#krav}
-----------------------

1. Skapa ett bash-script `commands` som kan ta emot options och argument. Anropas ditt script utan options eller arguments, skall scriptet skriva ut att man kan få hjälp genom att använda `--help, -h`.

1. Ändra rättigheter för scriptet genom kommandot `chmod 755 commands`

1. Ditt script skall avslutas med korrekt exit värde.

1. Ditt script skall ta emot option `--help, -h` och skriva ut alla kommandon som du implementerar.

1. Ditt script skall ta emot option `--version, -v` och skriva ut nuvarande version av ditt script.

1. Ditt script skall ta emot argumentet reverse plus en mening som ska reverseras dvs. returnera strängen i omvänd ordning. Scriptet skall kunna anropas `./commands reverse Obi-Wan Kenobi` och scriptet returnerar: iboneK naW-ibO

1. Ditt script ska ta emot argumentet factors plus ett godtyckligt antal siffror, för varje siffra ska scriptet returnera talet, kolon och talets primtals faktorer, dvs. de primtal som ursprungs siffran kan delas med, på var sin rad. Exempel `./commands factors 5 6 16` returnerar:

```bash
5: 5
6: 2 3
16: 2 2 2 2
```

Validera ditt `commands` script genom att göra följande kommandon i kurskatalogen i terminalen.

```bash
# Flytta till kurskatalogen
dbwebb validate commands
```

Rätta eventuella fel som dyker upp och publicera igen. När det ser grönt ut så är du klar.  



Extrauppgift {#extra}
-----------------------

1. Skapa kommandot `starwars` som i sin tur kör kommandot `telnet towel.blinkenlights.nl`

OBS! Om du har cygwin i Windows kan du behöva installera `telnet` genom att köra kommandot `apt-cyg install inetutils`.



Tips från coachen {#tips}
-----------------------

Lycka till och hojta till i forumet om du behöver hjälp!
