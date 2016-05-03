---
author: aar
revision:
    "2016-05-03": (PA, aar) Pre-release.
category:
    - python
...
Introduktion till regex
===================================

[FIGURE src=/image/oopython/kmom04/regex.png class="right"]

Regex är en förkortning av Regular Expression som är ett välkänt språk för att matcha text mönster. Det används oftast till att extrahera information från kod, log filer och andra texter.  
I regex defineras ett mönster av karaktärer som regex sedan försöker hitta/matcha i en sträng eller text.  
I python används modulen [_re_](https://docs.python.org/2/library/re.html) för att använda regex på strängar.

<!--more-->



Förutsättning {#pre}
-------------------------------

Det finns inga förkunskaper.



Använda modulen re {#anvanda_modulen_re}
------------------------------


Vi ska använda oss av re's funktion [_search_](https://docs.python.org/2/library/re.html#re.search) för att matcha mönster. Det går även använda re's [_match_](https://docs.python.org/2/library/re.html#re.match) funktion men den kommer alltid att försöka matcha strängen från position noll och frammåt medans search kan hitta mönstret vart som helst i strängen.  
Nedan är ett exemple på skillnaden mellan search och match.

```python
import re
line = "2bc"
matchMatch = re.match("b", line)
print(matchMatch)
None

matchSearch = re.search("b", line)
print(matchSearch)
<_sre.SRE_Match object; span=(1, 2), match='b'>

print(matchSearch.group())
b
```

När vi skriver ut matchMatch får vi None för att match och search returnerar None ifall den inte hittar mönstret.



###Mindre delrubrik, kan använda `[]` (titta i koden) {#dontForgetId}

mer text

```python
>>> mer kod

```


###Mindre delrubrik {#dontForgetId}



Större rubrik igen {#dontForgetId}
------------------------------

Ascinema länk:

[ASCIINEMA src=37763]



###Överkurs {#overkurs}

Text...



Avslutningsvis {#avslutning}
------------------------------

Dokumentation för re modulen: <https://docs.python.org/2/library/re.html#>.
