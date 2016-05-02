SSH-nycklar
==================================

När du loggar in på studentservern behöver du ange ditt lösenord. Det blir jobbigt i längden. Därför är det lika bra att skapa SSH-nycklar som automatiskt sköter din autentisering när du loggar in.

Kommandot `dbwebb` hjälper dig att skapa dessa nycklar och installerar dem också på studentservern genom följande kommando.

```text
$ dbwebb sshkey
```

SSH-nycklarna sparas i din hemmakatalog under `$HOME/.ssh`. 

```text
$ ls -l $HOME/.ssh
```

Är du nyfiken på hur de kan se ut så kikar du på de filer som ligger i den katalogen.

Så här kan det se ut.

[ASCIINEMA src=24617]
