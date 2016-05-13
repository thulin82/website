Testa ett kursrepo
==================================

Detta är för de som utvecklar och testar kursrepon.

I varje kursrepo kan finnas en fil `.dbwebb.tests`. Varje rad i filen är ett kommando som exekveras som en del i en testsuite. Kommandot måste returnera exit status 0 för att betraktas om en lyckad assertion.

```text
$ dbwebb testrepo
$ dbwebb --force testrepo
$ dbwebb --force --silent testrepo
```

Optionen `--force` gör att du kan köra om testsuiten utan att först radera `me` katalogen.

Optionen `--silent` ger att bara felutskrifter skrivs ut.



Syntaxen i en testsuite {#syntax}
---------------------------------

Så här kan en fil `.dbwebb.tests` se ut.

```bash
# Init
dbwebb init-me

# Kmom01 lab1
dbwebb recreate lab1
cd me/kmom01/lab1 && ./answer.py; [[ $? = 1 ]]
```

Varje rad innehåller ett kommando som kan exekveras via `eval`. En sådan rad kallas för en *assertion*. En assertion måste leverera ett exitvärde av 0 för att betraktas som lyckad.

En rad kan också vara tom eller börja med en `#` för kommentarsrader.
