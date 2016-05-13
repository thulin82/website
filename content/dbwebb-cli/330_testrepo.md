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
