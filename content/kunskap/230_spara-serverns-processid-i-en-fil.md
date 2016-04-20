---
author: mos
category: webbprogrammering
revision:
  "2015-10-16": (A, mos) Första utgåvan i kursen linux.
updated: "2015-10-16 14:28:36"
created: "2015-10-16 14:28:34"
...
Spara serverns processid i en fil
==================================

[FIGURE src=/image/snapht15/bash-processid.png?w=c5&a=7,80,60,0 class="right"]

När man startar en server så kan det ibland vara behändigt att ha koll på vilket process id som servern får. Låt oss se hur vi kan ta reda på serverns process id i en Node.js server och spara undan detta id i en fil.

Låt oss se hur vi kan skicka signaler till servern för att stänga ned den och låt oss se hur vi kan hitta servrar som vi "tappat bort" i bakgrunden.

<!--more-->



Förutsättning {#pre}
--------------------------------------

Följande artikel förutsätter att du kör på en Unix-maskin, Linux eller Mac OS. Du kan köra vissa delar av artikeln via Cygwin på en Windows-maskin.



Processens id {#id}
--------------------------------------

När man startar igång en process (på Unix/Linux/Mac OS) så får den ett process id som man kan använda för att senare kommunicera med processen. Detta är speciellt bra när man skickar processerna till bakgrunden med `&`-tecknet.

Se när jag lägger en process i bakgrunden från terminalen.

```bash
$ sleep 5 && ls &
[1] 30408 
```

Kommandosekvensen sover i fem sekunder och gör sedan en `ls` på katalogen man står i. Det är alltså hela kommandot `sleep 5 && ls` som körs i bakgrunden. Den siffran som skrivs ut är processens id.

Låt oss göra samma test men vi låter den sova lite längre så vi kan se den i processtabellen.

```bash
$ sleep 50 && ls &
[1] 30547
$ ps
PID TTY          TIME CMD
22338 pts/25   00:00:00 bash
30546 pts/25   00:00:00 bash
30547 pts/25   00:00:00 sleep
30548 pts/25   00:00:00 ps
$ ps -aux | grep 30547                     
mos      30547  0.0  0.0   7488  1404 pts/25   S    16:40   0:00 sleep 50
mos      30564  0.0  0.0  14384  1704 pts/25   S+   16:41   0:00 grep --color=auto 30547
```

Med kommandot `ps` kunde jag nu se processen i processtabellen.



Skicka signaler till en process {#kill}
--------------------------------------

När en process körs i bakgrunden så behövs ett sätt att kommunicera med den, och stänga ned den. Ett sådant sätt är kommandot `kill` som kan skicka en signal till en process via processens id.

Det finns många olika signaler och vi skall inte gå in på dem här. 

```bash
$ kill -l                      
 1) SIGHUP       2) SIGINT       3) SIGQUIT      4) SIGILL       5) SIGTRAP    
 6) SIGABRT      7) SIGBUS       8) SIGFPE       9) SIGKILL     10) SIGUSR1    
11) SIGSEGV     12) SIGUSR2     13) SIGPIPE     14) SIGALRM     15) SIGTERM    
16) SIGSTKFLT   17) SIGCHLD     18) SIGCONT     19) SIGSTOP     20) SIGTSTP    
21) SIGTTIN     22) SIGTTOU     23) SIGURG      24) SIGXCPU     25) SIGXFSZ    
26) SIGVTALRM   27) SIGPROF     28) SIGWINCH    29) SIGIO       30) SIGPWR     
31) SIGSYS      34) SIGRTMIN    35) SIGRTMIN+1  36) SIGRTMIN+2  37) SIGRTMIN+3 
38) SIGRTMIN+4  39) SIGRTMIN+5  40) SIGRTMIN+6  41) SIGRTMIN+7  42) SIGRTMIN+8 
43) SIGRTMIN+9  44) SIGRTMIN+10 45) SIGRTMIN+11 46) SIGRTMIN+12 47) SIGRTMIN+13
48) SIGRTMIN+14 49) SIGRTMIN+15 50) SIGRTMAX-14 51) SIGRTMAX-13 52) SIGRTMAX-12
53) SIGRTMAX-11 54) SIGRTMAX-10 55) SIGRTMAX-9  56) SIGRTMAX-8  57) SIGRTMAX-7 
58) SIGRTMAX-6  59) SIGRTMAX-5  60) SIGRTMAX-4  61) SIGRTMAX-3  62) SIGRTMAX-2 
63) SIGRTMAX-1  64) SIGRTMAX                                                   
```

Ett vanligt sätt för en server att hantera en signal kan vara att läsa om sin konfigurationsfil eller att stänga ned sig själv. En process kan implementera olika hanterare när den mottar en signal.

Men, vi skall hålla det enkelt. Allt vi vill göra är att ha en möjlighet att döda servern. Så här.

```bash
$ sleep 50 &
[1] 31060
$ kill 31060
[1]+  Terminated              sleep 60 
```

Ibland kan processen vara lite svårare att stänga ned, då kan man skicka signalen SIGKILL, nummer 9, för att vara övertydlig att man verkligen vill stänga ned processen oavsett vad.

```bash
$ kill -9 31060
[1]+  Killed                  sleep 60  
```



Processid för en Node.js server {#pid}
--------------------------------------

Jag tar och gör ett litet exempelprogram i Node.js som tar reda på det process id som programmet får. Värdet på processens id finns i variabeln [`process.pid`](https://nodejs.org/api/process.html#process_process_pid).

```bash
$ babel-node index.js
Simple server listen on port 1337 with process id 31410
```

Låt säga att jag nu vill skicka processen till bakgrunden istället, jag vill också samla alla utskrifter från processen till en loggfil. Så här.

```bash
$ babel-node index.js &> log &
[1] 31576
```

Nu kan jag skicka en signal till processen via `kill`.

```bash
$ kill 31576
[1]+  Terminated              babel-node index.js &> log
$ cat log
Simple server listen on port 1337 with process id 31581
```

Bra, nu kan jag kommunicera med processen, även om jag lägger den i bakgrunden.

Ibland får man inte någon utskrift om att processen har avbrutits. Är man osäker så skickar man signalen en gång till. Om id:et inte finns så får man ett felmeddelande.

```bash
$ kill 31576
-bash: kill: (31576) - No such process 
```

Då vet man att processen är borta. Men vad händer om jag startar upp servern igen?



Min port är upptagen? {#port}
--------------------------------------

Jag startar servern igen.

```bash
$ babel-node index.js
Simple server listen on port 1337 with process id 32569
events.js:141                                          
      throw er; // Unhandled 'error' event             
      ^                                                
                                                       
Error: listen EADDRINUSE :::1337                       
```

Det gick ju inte. Krash. Någon lyssnar på porten? Hmm.

Jag kan köra `ps` för att se.

```bash
$ ps
  PID TTY          TIME CMD                         
22338 pts/25   00:00:00 bash                        
32417 pts/25   00:00:00 nodejs                      
32634 pts/25   00:00:00 ps                          
```

Se där, där ligger en process som körs via `nodejs`.

Här är ett annat sätt att hitta vilken process som blockerar en viss port.

```bash
$ netstat -an --tcp --program | grep 1337    
(Not all processes could be identified, non-owned process info
 will not be shown, you would have to be root to see it all.)
 tcp6    0      0 :::1337    :::*  LISTEN   32417/nodejs
```

Om man vet vilken port man vill titta på, och det gör vi, så kan vi se vilken process som lyssnar på den. Där får vi fram samma pid (32417) som vi fick via kommandot ps. Låt oss döda processen och starta om vår server.

```bash
$ babel-node index.js &
[1] 315
Simple server listen on port 1337 with process id 320
```

Vi ser nu tydligt att det är två olika pid. Det som visas när vi kör babel-node och det som visas från själva servern. Vi kan gissa att babel-node körs och i sin tur startar upp nodejs med den transpilerade koden. Det är alltså det andra pid:et som skrivs ut av servern själv som är det pid som allokerat porten.



Spara processid i en fil {#fil}
--------------------------------------

Jag utökar nu mitt exempelprogram i Node.js med att skriva processens id till en fil. Det är bra om man har ett externt skript eller liknande som skall skicka signaler till servern.

För att ta ett jämförande exempel så sparar webbservern Apache sitt pid i en fil i `/run/apache2/apache2.pid` (på Debian, det skiljer mellan system) för att externa tjänster skall kunna kommunicera med processen via dess pid.

```bash
$ cat /run/apache2/apache2.pid 
1442
```

Jag tar mitt exempelprogram som nu ser ut så här. Att skriva till fil görs med [modulen fs](https://nodejs.org/docs/latest/api/fs.html).

```javascript
var fs = require('fs');
import server from './server.js';

// Start the server to listen on a port
server.listen(1337);

fs.writeFile("pid", process.pid, function(err) {
    if(err) {
        return console.log(err);
    }

    console.log("Wrote process id to file 'pid'");
}); 

console.log("Simple server listen on port 1337 with process id " + process.pid);
```

Så här ser det ut om jag startar det i bakgrunden.

```bash
$ babel-node index.js &> log &
[1] 510
$ cat pid
515
$ kill 515
[1]+  Terminated              babel-node index.js &> log
```

Perfekt. Nu sparar vi alltså processens pid till en fil och det gör det enkelt att komma åt den om vi vill skicka en signal till den.



Avslutningsvis {#avslutning}
--------------------------------------

Du hittar mina exempelprogram i kursrepot under [`example/nodejs/saveProcessId`](https://github.com/mosbth/linux/blob/master/example/nodejs/saveProcessId/index.js).

Nu har du lärt dig hur du hittar och kan använda dig av processens pid. Det är bra att ah koll på detta när man jobbar med servrar.

Har du frågor så vänder du dig till [forumet](forum/).




