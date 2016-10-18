---
...
Markdown i Anax med CTextFilter
==================================

När vi skriver Markdown i Anax så använder vi PHP-modulen [`mos/ctextfilter`](https://packagist.org/packages/mos/ctextfilter). Den modulen använder sig i sin tur av andra moduler för att implementer den variant av Markdown och shortcodes som finns tillgängliga.



Länka mellan dokumenten {#links}
-----------------------------------

En länk i Markdown kan skapas med `[länktext](some/route)`. När länken är relativ så läggs webbplatsens basurl automatiskt till. Det gör att oavsett i vilket dokument du är i, inom katalogen `content`, så kan du alltid använda länkar som är relativa rooten.



Länka till bilder {#img}
-----------------------------------

När du jobbar i katalogen `content` så kan du alltid länka till bilder i katalogen `htdocs/img` genom att skriva relativa bildlänkar såsom `![text om bilden](img/dbwebbisar.jpg)`.

Webbplatsens basurl kommer alltid att läggas till en sådan relativ bildlänk. Det gör att du kan använda samma sätt att länka till bilder oavsett i vilken underkatalog till `content` du befinner dig i.
