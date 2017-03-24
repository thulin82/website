---
author:
    - mos
category:
    - php
    - kurs oophp
revision:
    "2017-03-24": "(A, mos) Första versionen."
...
Att jobba med vyer i Anax Lite
===================================

[FIGURE src=/image/snapvt17/navbar.png?w=c5&a=0,50,0,0 class="right"]

Vi skall se hur man kan jobba med vyer i Anax Lite. Du har redan bekantat dig med begreppet tidigare, låt oss nu kika lite mer i detalj på hur man kan strukturera sin vy och vilka metoder som finns att tillgå, om man vill skriva mer avancerade vyer, eller om man vill organisera koden i vyerna.

<!--more-->



Förutsättning {#pre}
-------------------------------

Du har läst artiklarna "[Bygg ett eget PHP-ramverk](kunskap/bygg-ett-eget-php-ramverk)" och "[Att integrera en klass i ramverket Anax Lite](kunskap/att-integrera-en-klass-i-ramverket-anax-lite)".



Vy som exempel {#exempel}
------------------------------

När du introducerades i Anax Lite fick du också se en variant på hur man kan kombinera vyer till en webbsida. Vyerna lades till i routen och det såg ut ungefär så här i routen.

```php
$app->router->add("", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Home"]);
    $app->view->add("take1/navbar");
    $app->view->add("take1/home");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});
```

Innehållet i de tre vyerna såg ut så här.

**`view/take1/header.php`**

```php
<!doctype html>
<meta charset="utf-8">
<title><?= $title ?></title>
```

**`view/take1/navbar.php`**

```php
<?php
$urlHome  = $app->url->create("");
$urlAbout = $app->url->create("about");

?><navbar>
<a href="<?= $urlHome ?>">Home</a> | 
<a href="<?= $urlAbout ?>">About</a>
</navbar>
```

**`view/take1/home.php`**

```php
<h1>Home</h1>
<p>This is the homepage.</p>
```

När man sedan körde mot routen så ser sidan ut så här.

[FIGURE src=image/snapvt17/view-home-route.png?w=w2]

Titta man på sidans källkod så ser man att HTML-koden från vyerna har slagits ihop, precis som man vill.

[FIGURE src=image/snapvt17/view-view-source.png?w=w2]

Bra så långt. Men kan man göra något mer med Anax vyer?



Grunden i vyn {#grunden}
------------------------------

Grunden i vy-hanteringen är en vykontainer där man samlar alla vyer för att rendera dem i slutet, när svaret skall skapas.

Man kan alltså lägga till vyer efter hand som, de "skrivs ut" i samband med att svaret produceras.

Vyerna läggs till efter varandra, i den ordning man vill att de skall skrivas ut.

```php
$app->view->add("take1/header", ["title" => "Home"]);
$app->view->add("take1/navbar");
$app->view->add("take1/home");
```

Om man vill bifoga variabler från routen in i vyn så gör man det i en array.

```php
$app->view->add("take1/header", ["title" => "Home"]);
```

Ovan skickas arrayen `["title" => "Home"]` in till vyn och inuti vyn kan variabeln `$title` användas.

Så här.

```php
<title><?= $title ?></title>
```

Inuti vyfilen kan du skriva PHP-kod precis som vanligt. Koden ovan visar en kortare syntax för att skriva `<?php echo $title; ?>`. Jag brukar tycka att den formen är trevligare att skriva tillsammans med HTML-kod.

Tittar vi i slutet av routen så ser vi att samtliga vyer renderas till Responsets body för att sedan skickas.

```php
$app->response->setBody([$app->view, "render"])
              ->send();
```

Det var grunden i flödet. 



Modulen Anax\View {#modulen}
------------------------------

Låt oss se vilka delar som modulen primärt består av.



###ViewContainer {#viewcontainer}

Den modulen som vi använder, består av kontainern `ViewContainer` som samlar på sig vyerna. Det är den klassen som instansieras i frontkontrollern och blir till en del av ramverket som `$app->view`.

Via `$app->view->add()` så kan man lägga till nya vyer.

Låt oss kika på hur den metoden är definierad i `ViewContainer`.

```php
/**
 * Add (create) a view to be included, pass optional data and put the
 * view in an optional specific region (default region is "main") and
 * pass an optional sort value where the highest value is rendered first.
 * The $template can be a:
 *  filename (string),
 *  callback (array with key callback set to a callable array),
 *  view array (key value array with template, data, region, sort)
 *
 * @param string $template the name of the template file to include.
 * @param []     $data     variables to make available to the view,
 *                         default is empty.
 * @param string $region   which region to attach the view, default is
 *                         "main".
 * @param int    $sort     which order to display the views.
 *
 * @return self for chaining.
 */
public function add($template, $data = [], $region = "main", $sort = 0)
```

Du ser att det verkar finnas flera varianter av hur du kan lägga till en ny vy till kontainern.



###View {#view}

Varje gång en ny vy läggs till kontainern så är det i form av in instans av klassen `View`. Det är den som sedan håller reda på all information om hur den skall renderas. 

Vill du se detaljer om View så kikar du på metoden `set()`.

```php
/**
 * Set values for the view.
 *
 * @param []|string $template the template file, or array
 * @param []        $data     variables to make available to the
 *                            view, default is empty
 * @param integer   $sort     which order to display the views,
 *                            if suitable
 * @param string    $type     which type of view
 *
 * @return self
 */
public function set($template, $data = [], $sort = 0, $type = "file")
```

Det verkar finnas motsvarande information i View som skickas in till ViewContainer. Vi kan nästan anta att informationen bara bifogas från ViewContainer till View och ViewContainer endast innehåller en array av View-objekt. Men vill vi vara säkra får vi studera källkoden. Det spelar egentligen ingen större roll, bara vi har koll på grunderna, och det har vi.

I metoden `render()` så renderas vyn, informationen skrivs ut. Det sker på följande sätt om vyn är en fil.

```php
$viewRender = new ViewRenderFile();
$viewRender->setApp($app);
$viewRender->render($this->template, $this->templateData);
```

Vi ser att renderingen av vyn här överlåts till klassen `ViewRenderFile`.



###ViewRender {#viewrenderfile}

När vi kikar på klassen `ViewRenderFile` så ser vi först av dess klasskonstruktion att den har tillgång till `$app` eftersom den implementerar interfacet `AppInjectableInterface` och vi ser att den använder sig av ett trait som heter `ViewHelperTrait`.

Själva metoden som slutligen renderar vy-filen är enkel och gör i princip följande.

```php
$app = $this->app;
extract($data);
include $file;
```

Koden gör så att `$app` samt de från routen bifogade variablerna, här samlade i `$data`, görs tillgängliga för själva vy-filen som sedan görs include på.

Nu är vi i vy-filen.



Vilka variabler finns i vyn {#variabler}
------------------------------

För att skapa ett testprogram så lägger jag till en route `view/test1`. Jag vill gärna se vad jag kan göra i vyn.

```php
$app->router->add("view/test1", function () use ($app) {
    $app->view->add("view/test1", [
        "title" => "Home",
        "message" => "Hello World",
        "answer" => 42
    ]);

    $app->response->setBody([$app->view, "render"])
                  ->send();
});
```

Jag skapar en vy `view/view/test1.php` och lägger till lite debug-kod.

```php
<?php

// Get all available variables
var_dump(get_defined_vars());
```

Resultatet visar de variabler som jag har tillgång till i vyn, dessa kan jag jobba med när jag skapar resultatet i vyn.

[FIGURE src=image/snapvt17/view-defined-vars.png?w=w2 caption="Visar alla variabler som finns tillgängliga i vyn."]

Jag uppdaterar min vy och skriver ut variablerna i en lista istället.

```php
<?php
// Get all available variables
//var_dump(get_defined_vars());

?><doctype html>
<meta charset="utf-8">
<title><?= $title ?></title>
<p><?= $message ?></p>
<p>These variables are defined.</p>
<ul>
<?php foreach (get_defined_vars() as $key => $val) : ?>
    <li><?= $key ?></li>
<?php endforeach; ?>
</ul>
```

Du ser att min vy inleds med en del PHP-kod och sedan går jag över till HTML-läge och skriver ut. När jag är i HTML-läge använder jag gärna den alternativa syntaxen som finns i PHP, jag tycker den kan lämpa sig bättre i kombination med HTML-koden.

Ett alternativ till ovan kod hade varit följande konstruktion.

```php
<?php
$li = "";
foreach (get_defined_vars() as $key => $val) {
    $li .= "<li>$key</li>\n";
}

?><doctype html>
<meta charset="utf-8">
<title><?= $title ?></title>
<p><?= $message ?></p>
<p>These variables are defined.</p>
<ul>
    <?= $li ?>
</ul>
```

Resultatet blir detsamma, skillnaden är bara hur jag väljer att konstruera HTML-koden. Båda fungerar men jag föredrar ofta den första varianten, jag känner att den ger mig renare kod och hjälper mig att separera HTML till en enda plats.

Så här blir utskriften.

[FIGURE src=image/snapvt17/view-defined-vars-li.png?w=w2 caption="De i vyn definierade variablerna i form av en ul/li-lista."]

Det känns som vi har koll på hur vi kan skicka variabler till vyn och på vilket sätt vi kan skriva koden i vyn. Det är en bra grund.



Inkludera en vy i en vy {#include}
------------------------------

När vi tittade i klassen ViewRenderFile så såg vi ett trait ViewHelperTrait. I det traitet finns ett antal hjälpmetoder som är tillgängliga i själva vyn.

Vi har naturligtvis tillgång till hela `$app` i vy-filen, på gått och ont, men via ViewHelperTrait kan vi skapa metoder som är anpassade för att användas i vyerna och på det sättet minska koden i vy-filerna.

Två av de metoderna som finns definierade är `asset()` och `url()`.

Låt oss kika på dem.

```php
/**
 * Shortcut to create an url for a static asset.
 *
 * @param string $url part of url to use when creating the url.
 *
 * @return string as resulting url.
 */
public function asset($url = null)
{
    return $this->app->url->asset($url);
}

/**
 * Shortcut to create an url for routing in the framework.
 *
 * @param string $route route to use for creating the url where "" or null
 *                      means baseurl to current frontcontroller.
 *
 * @return string as resulting url.
 */
public function url($url = null)
{
    return $this->app->url->create($url);
}
```






Avslutningsvis {#avslutning}
------------------------------

Du har nu fått en genomgång av hur vy-filerna fungerar och hur view modulen är implementerad. Med detta har du nu god kontroll över hur dina websidor kan formas.

Artikeln har en [egen forumtråd](t/6341) där du kan ställa frågor eller bidra med tips och trix.
