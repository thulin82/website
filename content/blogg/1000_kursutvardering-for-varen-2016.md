---
author: mos
published: "2016-06-21 13:00"
category:
    - kursnyheter
    - kursutvärdering
...
Kursutvärdering för våren 2016
==================================

Då var det dax att sammanställa vårens kursutvärderingar. Som alltid ger de oss i lärarteamet en fingervisning om hur vi sköter oss och hur våra kurser mår.

Låt se om kursutvärderingarna ger oss något att jobba med.

<!--more-->

BTH har ändrat formen för sitt utvärderingssystem och det är inte kompatibelt med tidigare år.

Tidigare i år så gjorde jag en uppföljning av de kursutvärderingar som kom efter lp3. Jag såg att vi ofta fick lågt betyg på frågor om feedback, samarbete och delvis vid bemötandet. Du kan se min sammanställning i forumtråden "[Kommentarer kursutvärderingar 2016 lp3](/t/5298)". 

Låt se om vi ser samma mönster nu.


<script type="text/javascript" src="https://www.google.com/jsapi"></script>



Översikt {#oversikt}
------------------------------------------------

Ett snitt över 3 är okey enligt min egen riktlinje. Ett snitt under 3 är inte önskvärt och kräver någon form av hantering. 

BTH har en nivå där de önskar att kurser skall ha över 3.3. Snittet för alla BTH kurser är nu 3.25.

Jag måste vara nöjd om snittet på kursen är över BTHs snitt. Men egentligen siktar jag högre än så. Nåväl.

Om vi sammanställer studenternas nöjdhet för samtliga kurser som gått under VT16  så får vi följande översikt.

<script type="text/javascript">
    google.load("visualization", "1.1", {packages:["bar"]});
    google.setOnLoadCallback(drawChart);
  
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Kurs', 'Poäng'],
            ['htmlphp',         3.05],
            ['oophp',           3.21],
            ['phpmvc (campus)', 3.64],
            ['phpmvc (distans)', 3.46],
            ['javascript',      2.76],
            ['python (lp3)',    3.14],
            ['python (lp4)',    3.82],
            ['javascript1',     2.82],
            ['linux',           3.57],
            ['webapp',          3.38],
        ]);
        
        var options = {
            title: 'Snitt på standardfrågor',
            bars: 'horizontal',
            chart: { 
                title: 'Snitt på standardfrågor',
                subtitle: 'Jämförelse mellan kurserna'
            },
            legend: { position: 'none' }
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
<div id="chart_div" style="width: 630px; height: 500px; margin-bottom: 44px;"></div>

Två kurser under 3.0, javascript och javascript1. Resten över 3.



Snitt på kursens upplägg, innehåll och examination {#upplagg}
------------------------------------------------

Tre av frågorna i kursutvärderingen rör kursens upplägg, mål och examination. Låt oss se snittet på dessa tre frågor för vårens kurser.

<script type="text/javascript">
    google.load("visualization", "1.1", {packages:["bar"]});
    google.setOnLoadCallback(drawChart);
  
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Kurs', 'Poäng'],
            ['htmlphp',         3.62],
            ['oophp',           3.73],
            ['phpmvc (campus)', 3.80],
            ['phpmvc (distans)', 3.75],
            ['javascript',      3.08],
            ['python (lp3)',    3.92],
            ['python (lp4)',    3.62],
            ['javascript1',     3.48],
            ['linux',           3.89],
            ['webapp',          3.67],
        ]);
        
        var options = {
            title: 'Snitt på upplägg, innehåll och examination',
            bars: 'horizontal',
            chart: { 
                title: 'Snitt på upplägg, innehåll och examination',
                subtitle: 'Jämförelse mellan kurserna'
            },
            legend: { position: 'none' }
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div1'));
        chart.draw(data, options);
    }
</script>
<div id="chart_div1" style="width: 630px; height: 500px; margin-bottom: 44px;"></div>

Generellt är det bra betyg på kursernas upplägg, innehåll och examination. De kurser som sticker ut lite är javascript1 där det fanns en del fritextkommentarer om förbättringsförslag på kursinnehåll. Den kurs som sticker ut lite mer är kursen javascript där det fanns en del kommentarer på det fira upplägget på projektet.

Kursen javascript1 har vi under översyn och där är vi medvetna om en del förbättringar vi vill göra. Delvis handlar det också om att förändra den kursen till att hantera objektorienterad JavaScript enligt ECMA 2015 / JavaScript version 6.

Kursen javascript är som den är och vi planerar inga förändringar inför hösten. Feedbacken på kursen kommer denna gången från studenter på kurspaketet och en del av kommentarerna är avsedda att hanteras i det uppdaterade kurspaketet som kommer att ges igen från och med HT17. Nu till HT16 är det sista gången som kursen kommer att ges i sin nuvarande form.

Oavsett vad så känns det som vi totalt sett har en god struktur på våra kurser. Det är en bra bas att stå på.



Snitt på feedback, bemötande och samarbete {#feedback}
------------------------------------------------

Tre av frågorna i kursutvärderingen rör feedback, bemötande och samarbete. Låt oss se snittet på dessa tre frågor för vårens kurser.

<script type="text/javascript">
    google.load("visualization", "1.1", {packages:["bar"]});
    google.setOnLoadCallback(drawChart);
  
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Kurs', 'Poäng'],
            ['htmlphp',         2.48],
            ['oophp',           2.70],
            ['phpmvc (campus)', 3.49],
            ['phpmvc (distans)', 3.17],
            ['javascript',      2.44],
            ['python (lp3)',    2.65],
            ['python (lp4)',    3.72],
            ['javascript1',     2.16],
            ['linux',           3.24],
            ['webapp',          3.08],
        ]);
        
        var options = {
            title: 'Snitt på feedback, bemötande och samarbete',
            bars: 'horizontal',
            chart: { 
                title: 'Snitt på feedback, bemötande och samarbete',
                subtitle: 'Jämförelse mellan kurserna'
            },
            legend: { position: 'none' }
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div2'));
        chart.draw(data, options);
    }
</script>
<div id="chart_div2" style="width: 630px; height: 500px; margin-bottom: 44px;"></div>

Här ser man hur samma kurser kan ge helt olika upplevelse vid olika tillfällen. Delvis beror det på vilken studentgrupp som tar kursen, vilka förkunskaper de har och vilka förväntningar som finns.

Det som vi brottas med är inte egentligen snittet på dessa frågor utan mer värdet på frågan om feedback och på frågan om samarbete. Båda sticker ut negativt jämfört med resten av svaren om hur kurserna upplevs.

Kan vi jobba för att ge en bättre upplevelse för feedbacken?

Bör vi hantera frågan om samarbete eller är frågan helt enkelt felställd för målgruppen distans och kurspaket?

Vi har under våren diskuterat båda dessa frågor och vi har en del planer på hur vi skall försöka förbättra vår hantering kring hur feedbacken upplevs. Vi får se vad vi lyckas sjösätta till kommande läsår.

När det gäller samarbete så har ju kurserna inget direkt som kräver samarbete, men som flera kommenterar så finns möjligheterna till samarbete både i forum, chatt och hangout.

Vi får se vad som kan göras.



Översikt av respektive kurs {#overview}
------------------------------------------------

Här följer en översikt av sammanställningen för respektive kurs.



htmlphp {#htmlphp}
------------------------------------------------

Kursen gick i lp3 för kurspaketet.

[FIGURE src=/image/snapvt16/vt16-htmlphp.png caption="Genomsnitt för de olika frågorna."]



oophp {#oophp}
------------------------------------------------

Kursen gick i lp4 för kurspaketet.

[FIGURE src=/image/snapvt16/vt16-oophp.png caption="Genomsnitt för de olika frågorna."]



phpmvc {#phpmvc}
------------------------------------------------

Kursen gick i lp4 för campusstudenter på programmet Webbprogrammering.

[FIGURE src=/image/snapvt16/vt16-phpmvc-campus.png caption="Genomsnitt för de olika frågorna."]

Kursen gick i lp34 samt lp3 för kurspaketet.

[FIGURE src=/image/snapvt16/vt16-phpmvc-fri.png caption="Genomsnitt för de olika frågorna."]



javascript {#javascript}
------------------------------------------------

Kursen gick i lp4 för kurspaketet.

[FIGURE src=/image/snapvt16/vt16-javascript.png caption="Genomsnitt för de olika frågorna."]



python {#python}
------------------------------------------------

Kursen gick i lp3 för kurspaketet.

[FIGURE src=/image/snapvt16/vt16-python-lp3.png caption="Genomsnitt för de olika frågorna."]

Kursen gick i lp4 för programstudenter civilingenjörsprogrammen.

[FIGURE src=/image/snapvt16/vt16-python-lp4.png caption="Genomsnitt för de olika frågorna."]



javascript1 {#javascript1}
------------------------------------------------

Kursen gick i lp4 för kurspaketet.

[FIGURE src=/image/snapvt16/vt16-javascript1.png caption="Genomsnitt för de olika frågorna."]



linux {#linux}
------------------------------------------------

Kursen gick i lp3 och lp34 för kurspaketet.

[FIGURE src=/image/snapvt16/vt16-linux.png caption="Genomsnitt för de olika frågorna."]



webapp {#webapp}
------------------------------------------------

Kursen gick i lp4 för kurspaketet.

[FIGURE src=/image/snapvt16/vt16-webapp.png caption="Genomsnitt för de olika frågorna."]



Kurspaket webutv {#webprog}
------------------------------------------------

Från och med hösten 16 kommer kurspaketet [webutv](webutv) att ha samma kurstillfällen som campus och distansprogrammet. Det kan finnas fler tillfällen till lärarhjälp och kursmaterialet kan få en *boost* eftersom det krävs för distansprogrammet.

Vi får se om det ger någon effekt framöver.



Kurspaket webprog {#webutv}
------------------------------------------------

Kurspaketet [webprog](webprog) tar en pasu under läsåret 16/17 och återkommer till hösten 17 i aningen ny utformning som är avsedd att ta hänsyn till den feedback som finns nu, och funnits sedan tidigare, rörande svårighetsgraden.

Första antagningen till den nya kurspaketet blir alltså HT17.



Program Webbprogrammering (distans) {#distans}
------------------------------------------------

Till hösten startar distansprogrammet och det skall bli spännande att se hur det fungerar. Det kommer ställa en del nya krav på undervisningen så det skall bli intressant att följa upp de närmaste åren.



Program Webbprogrammering (campus) {#campus}
------------------------------------------------

Campusprogrammet delar nu sitt upplägg med distansprogrammet under de två första åren. Det skall bli intressant att se om det kan ge några speciella effekter när man integrerar campus och distansundervisningen. Även detta skall bli spännande att följa upp de närmaste åren.



Avslutningsvis {#avslut}
------------------------------------------------

Det var det. Vi har en hel del kursutveckling på vår agenda och en del nya undervisningsformer som vi skall sjösätta till hösten. Det finns alltid saker som kan bli bättre så det är mycket att göra.

Diskutera och kommentera i forumet, det finns en särskild tråd för [Kursutvärdering och kursutveckling](t/594).

Det skrevs en motsvarande [sammanfattning för kursutvärderingar för våren 2015](blogg/kursutvardering-for-varen-2015).
