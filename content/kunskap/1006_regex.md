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


Vi ska använda oss av re's funktion [_findall_](https://docs.python.org/2/library/re.html#re.findall) för att matcha mönster.  
Det går även använda re's [_match_](https://docs.python.org/2/library/re.html#re.match) och [_search_](https://docs.python.org/2/library/re.html#re.search).  
re.match() kommer alltid att försöka matcha strängen från position noll och frammåt och re.search() letar efter mönstret i hela strängen och returnerar första förekomsten den hittar. re.findall() som vi ska använda oss utav hittar alla förekomster av mönstret och returnerar de som en lista.  
Nedan är ett exemple på skillnaden mellan match, search och findall.

```python
import re
line = "2bcab"
matchMatch = re.match("b", line)
print(matchMatch)
None

matchSearch = re.search("b", line)
print(matchSearch)
<_sre.SRE_Match object; span=(1, 2), match='b'>

print(matchSearch.group())
b

matchFindall = re.findall("b", line)
print(matchFindall)
['b', 'b']
```

match(), search() och findall() returnerar _None_ om de inte hittar mönstret, det är därför None skrivs ut när vi skriver ut matchMatch.
Med re.search() kan vi se att den bara hittar första förekomsten av **b** om vi kollar i _span=(1,2)_, den hittar karaktären **b** som har index 1. Alltså hittar den inte det sista **b:et**.  
re.findall() hittar båda **b**.



### Special karaktärer {#special_karakterer}

I regex är har vissa karaktärer en speciell betydelse, det är detta som gör att vi kan matcha mönster dynamiskt och inte enbart fasta strängar.

* **.**(punkt): Matchar vilken karaktär som helst utom newline(\\n).

* **^**: Matchar början av en sträng.

* **$**: Matchar slutet av en sträng.

* **?**: Matchar noll eller en gång.

* **+**: Matchar en eller flera gångar.

* **\***: Matchar noll eller flera gångar.

* **\{ \}**: Matchar en intervall.

* **[ ]**: Matchar en av karaktärerna som man skriver inom hakparanteserna.

* **[^ ]**: Matchar en karaktär som man inte har skrivit inom hakparanteserna.

* **\w**(litet w): Matchar en alfanumerisk karaktär, alla bokstäver(stora och små), siffror och \_(understräck). Kan även skrivas som [a-zA-z0-9_]

* **\W**(stort W): Matchar en icke alfanumerisk karaktär, alltså en karaktär som inte matchas av **\w**. Kan även skrivas som [^a-zA-Z0-9_].

* **\d**: Matchar en siffra. Kan även skrivas som [0-9].

* **\D**: Matchar en karaktär som inte är en siffra. Kan även skrivas som [^0-9].

* **\s**(litet s): Matchar en blank(whitespace) karaktär. Kan även skrivas som [ \\t\\n\\r\\f\\v].

* **\S**(stort S): Matchar en icke-blank(whitespace) karaktär. Kan även skrivas som [^ \\t\\n\\r\\f\\v].

* **\\**: Används för att matcha en special karaktär som en vanlig karaktär, t.ex. \\. matchar en punkt och \\* matchar en asterisk.

* **( )**: Matchar en grupp som sedan går att återanvända.



###Grundläggande regex {#grundleggande_regex}

För att komma åt namnet _Kim_ i en mening kan vi gå tillväga på ett antal sätt, så vi går igenom några.

```python
line = "Kim gillar chips."
match = re.findall("Kim", line)
print(match)
['Kim']
```

Vi skriver "Kim" för att vi vet att vi letar specifikt efter det namnet.  
Men om vi endast vet att vi letar efter ett namn som börjar på "K" och kommer efterföljas av två bokstäver kan vi skriva:

```python
line = "Kim gillar chips."
match = re.findall("K..", line)
print(match)
['Kim']
```

Vi använder "**.**" för att matcha vilken karaktär som helst efter "K".  
Vi kan även använda oss utav "**\w**" istället för "**.**".

```python
line = "Kim gillar chips."
match = re.findall("K\w\w", line)
print(match)
['Kim']
```


```python
line = "3.14 != 3134 and 3445 != 3.15"
match = re.findall("\d\.\d\d", line)
print(match)
['3.14', '3.15']
```

Ovanför matchar vi decimaltal med två decimaler. Vi använder oss av "**\d**" för att matcha siffror och "**\\.**" för att matcha en punkt. Hade vi skrivit "**.**" istället för "**\\.**" hade vi matchat alla talen och inte bara decimaltalen.

För att bara matcha det första decimaltalet, 3.14, kan vi använda oss utav "**^**" för att markera början av strängen:

```python
line = "3.14 != 3134 and 3445 != 3.15"
match = re.findall("^\d\.\d\d", line)
print(match)
['3.14']
```

vårt mönster försöker matcha en sträng som börjar med en siffra, en punkt och två siffror till.

Om vi däremot bara vill matcha talet som kommer före slutet på strängen använder vi oss utav "**$**" för att markera slutet:

```python
line = "3.14 != 3134 and 3445 != 3.15"
match = re.findall("\d\.\d\d$", line)
print(match)
['3.15']
```

Ovanför använder vi mönstret, matcha en siffra, en punkt, två siffror till och sen är slutar strängen.



```python
line = """a b\tc
d.e"""

match = re.findall("a\sb", line)
print(match)
['a b']

match = re.findall("b\sc", line)
print(match)
['b\tc']

match = re.findall("c\sd", line)
print(match)
['c\nd']

match = re.findall("d\Se", line)
print(match)
['d.e']
```

Ovanför använder vi oss utav "**\s**" för att hitta olika blank(whitespace) karaktärer och "**\S**" för att hitta en icke-blank karaktär. "**\s**" funkar för " " (mellanslag), "\t" tab) och "\n" (ny rad) m.m.



###Repetition {#repetition}



###Hakparanteser {#hakparanteser}



###Gupering {#grupering}



###Finn och ersätt {#finn_och_ersett}



Avslutningsvis {#avslutning}
------------------------------

Dokumentation för re modulen: <https://docs.python.org/2/library/re.html#>.

Finns bra sidor online där man kan öva sig på regex: ....fyll på...
