---
author: mos
category:
    - kurs/design
    - mos/ctextfilter
created: "2016-06-17 11:00"
...
Typografiska element för webben med SmartyPants
==================================

Att skriva typografiskt korrekta element för webben kan vara lurigt utan ett hjälpmedel. Låt oss kika på PHP SmartyPants som kan hjälpa till att formattera till en snyggare typografi.


<!--more-->

Hur kan du till exempel skapa en ellips [^1], sneda citationstecken [^2] *curly braces*, minustecken [^3] *en dash*, eller långt tankestreck [^4] *em dash* på ett enkelt sätt i löpande text?

PHP-modulen [`mos/ctextfilter`](https://packagist.org/packages/mos/ctextfilter), som ligger bakom formatteringen av text på denna webbplatsen, använder sig av PHP-libbet [PHP SmartyPants](https://michelf.ca/projects/php-smartypants/) för att göra det enkelt att automatiskt formattera en del av de klassiska typografiska elementen. [PHP SmartyPants finns även på Packagist](https://packagist.org/packages/michelf/php-smartypants).

Här är ett par exempel som jag själv tycker om att använda.

| Vad                     | Källa     | SmartyPants |
|-------------------------|-----------|-------------|
| Dubbla citationstecken  | \"\"      | ""          |
| Enkla citationstecken   | \'\'      | ''          |
| Em-dash                 | \-\--     | ---         |
| En-dash                 | \--       | --          |
| Ellipsis                | \...      | ...         |

Klassisk typografi är vacker och kan förhöja känslan hos den som besöker din webbplats.



[^1]: [Ellips](https://sv.wikipedia.org/wiki/Uteslutningstecken) och [ellipsis](https://en.wikipedia.org/wiki/Ellipsis).
[^2]: [Citationstecken](https://sv.wikipedia.org/wiki/Uteslutningstecken) och  [quotation marks](https://en.wikipedia.org/wiki/Quotation_mark)
[^3]: [Minustecken](https://sv.wikipedia.org/wiki/Minustecken), [figure dash](https://en.wikipedia.org/wiki/Dash#Figure_dash) och [en dash](https://en.wikipedia.org/wiki/Dash#En_dash).
[^4]: [Långt tankestreck](https://sv.wikipedia.org/wiki/L%C3%A5ngt_tankstreck) och [em dash](https://en.wikipedia.org/wiki/Dash#Em_dash).
