---
author: thulin
category: artikel
revision:
  "2016-09-01": (A, thulin) Första utgåvan.
updated: "2016-09-01 17:32:19"
created: "2016-09-01 17:32:18"
...
Kom igång med GitHub part2
==================================

[FIGURE src=/image/git/git-github-logo.png?w=c3 class="right"]

I [Kom igång med Git och GitHub](https://dbwebb.se/kunskap/kom-igang-med-git-och-github) fick du en kort introduktion till hur man kan jobba med Git. Kanske har du eget projekt du vill versionshantera, kanske vill du bidra med dina kunskaper till ett kul Open Source-projekt, eller vill du helt enkelt bara ändra en grej på dbwebb.se eller IRC-boten Marvin som du tycker fungerar dåligt? Efter sommarens uppdatering av dbwebb så ligger numera hela webbplatsen på GitHub, i denna artikel går vi lite kort igenom hur man kan ta del av koden, göra egna uppdateringar, synkronisera de ändringar som sker medan man jobbar lokalt på sin kopia, och till sist hur man lägger ett förslag på en ändring i kodbasen till dbwebb (pull request)

<!--more-->



Git - ett versionshanteringsverktyg {#git}
--------------------------------------------------------------------


###Förkrav {#forkrav}

I denna artikel utgår jag ifrån att du satt upp git enligt de beskrivningar som finns i [Kom igång med Git och GitHub](https://dbwebb.se/kunskap/kom-igang-med-git-och-github), att du känner till hur man jobbar i terminalen, och att du har skaffat ett konto på [GitHub.com](http://github.com/). Vi kommer använda denna artikel som exempel på hur man gör en ändring på dbwebb.se, men tillvägagångssättet fungerar på alla publika repos på GitHub.com. Efter denna artikel hoppas jag att du lärt dig följande:

* Skapa en fork på GitHub.com
* Klona ner din fork
* Jobba med repot lokalt
* Synkronisera din fork med huvudrepot
* Pusha upp dina ändringar till GitHub
* Skapa en Pull Request


###Skapa en fork {#github-create-fork}

Det första vi gör är att vi letar upp ett repo som vi är intresserade av, t.ex. chatt-boten [Marvin](https://github.com/mosbth/irc2phpbb), eller som i det här exemplet koden för webbplatsen [dbwebb.se](https://github.com/dbwebb-se/website). För att få lov att skicka ett förslag till ändring (en pull request) så måste vi skapa en fork. Man kan se det som en avgrening, ett vägsjäl i koden, där du gör en kopia av originalkoden och placerar det på din egen GitHub-sida. Forkar används i regel till två saker. Dels om man ämnar att göra en pull request, dvs förändra/förbättra originalkoden, eller om du vill göra ett eget projekt med originalkoden som bas. Om/hur du får lov att göra detta brukar vara angivit i licensfilen.

[INFO]
**LICENCE**

I de flesta projekt på GitHub hittar du en fil vid namn LICENCE/LICENCE.md, i den står vad du får och inte får lov att göra med koden. Kod är som många andra saker skyddat, och filen berättar vad du får lov att göra med just det här repot. På GitHub är de allra flesta repos open source och du får lov att använda koden till dina egna projekt, så länge de inte räknas som komersiella. För att veta säkert, kolla in ett par licenser och försök förstå hur de fungerar.
[/INFO]

Vi kollar upp vad Licence-filen säger i dbwebb-fallet och i skrivande stund (2016-09-10) verkar inte mos ha någon åsikt om vad vi använder koden till, så länge det inte är för komersiella syften.

Skapa en fork gör vi enklast i webgränssnittet. Surfa till vald sida, i mitt fall [dbwebb](https://github.com/dbwebb-se/website), hitta fork-knappen uppe till höger, klicka på den, och nu har du fått en kopia av repot. 

[FIGURE src=/image/git/git-fork-button-github.png?w=w2 caption="Forka ett repo."]

Lägg märke till att det nu finns en kopia av dbwebb, fast under ditt eget GitHub-alias. Om originalet heter https://github.com/dbwebb-se/website, så har du efter forkandet skapat ett repo som heter https://github.com/DITT-GITHUB-ALIAS/website

###Klona din fork och börja jobba lokalt {#github-clone-fork}

Nu går vi till terminalen. Navigera dig fram till var du vill lägga ditt repo och skriv in följande: 

```bash
git clone https://github.com/DITT-GITHUB-ALIAS/website.git
```

Adressen hittar du om du klickar på den stora gröna knappen där det står "Clone or download" i din fork på GitHub.

Vi fortsätter med att skapa en branch, och byter till den branchen

```bash
git branch pull_request
git checkout pull_request
```

Nu jobbar vi vidare med våra filer, i mitt fall lägger jag till en ny artikel och infogar två stycken bildfiler. När jag är nöjd med mitt arbete så hoppar jag till terminalen och skriver:

```bash
git add sökväg/till/fil1.md
git add sökväg/till/bild1.png
git add sökväg/till/bild2.png
```

Med "git status" kan jag kontrollera mitt arbete:
[FIGURE src=/image/git/git-terminal-git-status.png?w=w2 caption="Git status"]


När vi är nöjda skapar vi en commit med "git commit -m "COMMIT_MEDDELANDE""

```bash
git commit -m "Added article about forks, pull requests and github"
```














Sammanfattningsvis {#sammanfatta}
--------------------------------------------------------------------

Nu har du kommit igång med både Git och GitHub. Som du säkert förstår så är detta bara grunderna och det finns mycket att lära sig om både Git och GitHub. Men, nu har du iallafall en bas att jobbar vidare ifrån. 

Lycka till och kämpa på!

Dagens lästips är [manualen för Git](http://git-scm.com/book).

När du blir varm i kläderna så kommer du att vilja sätta upp ssh-nycklar så att du slipper skriva lösenordet varje gång. Läs om hur du [sätter upp ssh-nycklarna på GitHub](https://help.github.com/articles/generating-ssh-keys). Men det kan upplevas lite pilligt, när du gör det första gången.



Diskutera i forumet {#forum}
--------------------------------------------------------------------

Du kan diskutera denna artikel i forumet, eller ställa frågor kring Git och GitHub, [artikeln har en egen tråd](f/5514).



Referenser {#referenser}
------------------------

Följande är referenser som använts som fotnötter i texten.

[^1]: [Wikipedia: Hur Git kom till](http://en.wikipedia.org/wiki/Git_%28software%29#History).
[^2]: [Stack Overflow: Push default ändras i Git 2.0](http://stackoverflow.com/questions/13148066/warning-push-default-is-unset-its-implicit-value-is-changing-in-git-2-0).
[^3]: [Git error Windows 1.8.5, "could not read Username for https:"](https://github.com/swcarpentry/bc/issues/234).
