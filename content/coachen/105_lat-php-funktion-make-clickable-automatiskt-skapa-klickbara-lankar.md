---
author: mos
category: php
updated: "2013-04-29 14:26:08"
created: "2013-04-29 14:11:12"
...
Låt PHP-funktion make_clickable() automatiskt skapa klickbara länkar
==================================

Har du texter som innehåller länkar till webbplatser och du vill automatiskt göra dessa till klickbara HTML-länkar? Då kan en funktion som `make_clickable()` hjälpa dig.

<!--more-->

PHP-funktionen `make_clickable()` är en funktion som tar en text som inparameter, `$text`. I funktionen körs texten genom ett reguljärt utryck som letar reda på alla delar i texten som ser ut som en länk, det vill säga att den börjar på *http:* eller *https:*. Dessa delar görs klickbara genom att de omringas med ett anchor-element, HTML-elementet `<a></a>`.

**Orginaltext:**

> Detta är en länk som kan vara klickbar http://dbwebb.se/coachen.

När ovanstående text körs genom funktionen `make_clickable()` så kommer resultatet att bli enligt nedan.

**Modifierad text:**

> Detta är en länk som kan vara klickbar <a href='http://dbwebb.se/coachen'>http://dbwebb.se/coachen</a>.

Så här ser källkoden ut för funktionen. 

```php
/**
 * Make clickable links from URLs in text.
 *
 * @param string $text the text that should be formatted.
 * @return string with formatted anchors.
 */
function make_clickable($text) {
  return preg_replace_callback(
    '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
    create_function(
      '$matches',
      'return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";'
    ),
    $text
  );
}
```

Du kan [testa funktionen via ett exempelprogram](kod-exempel/function_to_make_links_clickable/) och du kan ställa frågor om funktionen i  [forumtråden där flera bidrog till funktionen `make_clickable()`](t/254) genom att modifiera det reguljära uttrycket som från början hämtades från källkoden i Wordpress.

Funktionen `make_clickable()` använder sig av [anonyma funktioner](http://php.net/manual/en/functions.anonymous.php) för callbacken, så du behöver minst version 5.3 av PHP.

