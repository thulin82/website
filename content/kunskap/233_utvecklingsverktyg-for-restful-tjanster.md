---
author: mos
category: webbprogrammering
revision:
  "2015-10-28": (A, mos) Första utgåvan inför kursen webapp.
updated: "2015-10-28 08:19:23"
created: "2015-10-27 16:36:50"
...
Utvecklingsverktyg för RESTful tjänster
==================================

[FIGURE src=/image/snapht15/postman.png?w=c5&a=5,60,75,25 class="right"]

När du utvecklar mot servrar som har ett RESTful API så underlättar det att ha ett par bra utvecklingsverktyg som hjälper dig att skicka requestarna till server och kanske även hjälper dig att visa och hantera svaren.

<!--more-->

Låt oss titta på tre varianter som hjälper dig att komma igång och undersöka en server som publicerat ett RESTful API. En variant till Chrome, En till Firefox och så en variant för kommandoraden med curl.



En RESTful tjänst att testa mot {#rest}
-----------------------

Först behöver vi en RESTful tjänst som vi kan använda för att testa mot. jag väljer Arbetsförmedlingens API som finns beskrivet på deras sida om "[Arbetsförmedlingens öppna data](http://www.arbetsformedlingen.se/psidata)".

Där finns bland annat ett API för att hitta lediga jobb och det använder jag för att testa. informationen om hur jag använder API:et hittar jag i dokumentet "Teknisk beskrivning" som visar precis hur jag skall göra för att prata med API:et.

Det jag använder är en länk som ger mig alla lediga jobb per län. Desutom behöver jag skicka med en del information i headern, men det hjälper mig verktygen med.

Informationen som behövs för att testa verktygen är en basurl till API:et en metod att använda samt följande värde i HTTP-headern.

| Vad             | Värde                                   |
|-----------------|-----------------------------------------|
| API             | http://api.arbetsformedlingen.se/af/v0/ |
| Metod           | platsannonser/soklista/lan              |
| Accept          | application/json                        |
| Accept-language | sv                                      |
| From            | Min emailadress                         |

Detaljer om API:et finns som sagt att läsa om i dokumentet "Teknisk beskrivning", men detta hjälper dig att komma igång.



Postman för Chrome {#postman}
-----------------------

Till Chrome finns en applikation som heter [Postman](https://www.getpostman.com/). Jag laddar ned den och installera som en del av Chrome.

Så här ser det ut när den är installerade.

[FIGURE src=/image/snapht15/google-chrome-postman.png?w=w2 caption="Nu kan jag starta postman som en Chrome app."]

Så här kan det se ut när jag gör en request med Postman.

[FIGURE src=/image/snapht15/postman.png?w=w2 caption="En request mot AFs API med Postman."]

Postman känns som ett potent verktyg med möjligheter att spara undan och synka arbetsytan.



REST Easy för Firefox {#resteasy}
-----------------------

Till Firefox finns en Addn-on som heter [REST Easy](https://github.com/nathan-osman/REST-Easy). Jag söker efter den bland Firefox Add-ons och installerar den.

[FIGURE src=/image/snapht15/firefox-resteasy.png?w=w2 caption="Installera REST Easy som en Firefox Add-on."]

Så här kan det se ut när jag gör en request med REST Easy.

[FIGURE src=/image/snapht15/resteasy.png?w=w2 caption="En request mot AFs API med Postman."]

REST Easy känns som en enklare lillebror till Postman, men ändock lika användbart och enkelt utan att krångla till saker.



Curl på kommandoraden {#curl}
-----------------------

Verktyg är trevliga men ibland vill man ha tillgång till en enkel och snabb variant på kommandoraden. Låt oss se hur kommandot curl kan hantera det som Postman och REST Easy nu gjort.

Först prövar vi bara att koppla upp oss mot tjänsten via länken.

```bash
$ curl http://api.arbetsformedlingen.se/af/v0/platsannonser/soklista/lan
{"Error":{"statuskod":400,"titel":"Bad Request","beskrivning":"Felaktig headerparameter: [Accept-Language]"}}
```

Nej, det gick inte så bra. Jag behöver även skicka data i headern. Men det löser vi.

```bash
$ curl --header "Accept-Language: sv"  http://api.arbetsformedlingen.se/af/v0/platsannonser/soklista/lan
{"soklista":{"listnamn":"lan","totalt_antal_platsannonser":35565,"totalt_antal_ledigajobb":64845,"sokdata":[{"id"
...
```

Nu gick det bättre. Jag behövde inte sätta alla värden i headern, uppenbarligen. 



###Curl i Bash-script {#bash}

Om man gör detta många gånger så underlättar det att göra ett litet Bash-script. Här är en variant som jag döper till `af.bash`.

```bash
#!/bin/bash
curl \
    --silent   \
    --header "Accept: application/json" \
    --header "Accept-Language: sv" \
    --header "From: mos@dbebb.se" \
    http://api.arbetsformedlingen.se/af/v0/$* \
    | python3 -mjson.tool
```

I skriptet ovan använder jag en modul i Python, `python3 -mjson.tool`, för att formattera JSON så det blir enklare att läsa.

Så här ser det ut när jag kör skriptet.

```bash
$ ./af.bash platsannonser/soklista/lan
{                                        
  "soklista": {                          
    "listnamn": "lan",                   
    "totalt_antal_platsannonser": 35250, 
    "totalt_antal_ledigajobb": 64362,    
    "sokdata": [                         
      {                                  
        "id": 10,                        
        "namn": "Blekinge län",          
        "antal_platsannonser": 400,      
        "antal_ledigajobb": 715          
      },                                 
```

Nu blir det enklare att se resultatet.



###Sök i JSON data med jq {#jq}

En annan variant att formattera snyggt är programmet [jq](https://stedolan.github.io/jq/) som är en utility för att jobba med JSON data. Där kan jag få färgkodad utskrift vilket gör det än enklare att läsa innehållet i svaret. Med hjälp av `jq` kan man söka i JSON-svaret och enbart visa delar av svaret. Det kan vara behändigt när man söker efter viss information i större filer.

Här är ett exempel där jag sparat undan svaret i en fil `a.json` och använder `jq` för att ställa frågor mot filens innehåll.

```bash
$ jq '.soklista.totalt_antal_platsannonser' a.json 
35602                                                          
```

```bash
Eller att plocka ut första svaret i svaret.

$ jq '.soklista.sokdata[0]' a.json 
{                                           
  "id": 10,                                 
  "namn": "Blekinge län",                   
  "antal_platsannonser": 405,               
  "antal_ledigajobb": 723                   
}                                           
```

Som du ser så kan curl och jq vara alternativa verktyg att jobba mot RESTful tjänster. Att använda kommandoraden kan vara ett kraftfullt alternativ till de verktyg vi såg inledningvis.



Avslutningsvis {#avslutning}
--------------------------------------

Detta var en genomgång av ett par användbara verktyg när man jobbar mot en RESTful server.

Du kan ställa frågor eller ge tips och förslag i den [forumtråd som är kopplad till artikeln](t/4750).




