<?php
/**
 * Config file for url.
 * The variable $this is here related to $di.
 */

if (!defined("ANAX_PRODUCTION")) {
    return [
        "urlType"       => self::URL_CLEAN,
    ];
}

return [

    // Defaults to use when creating urls.
    //"siteUrl"       => null,
    //"baseUrl"       => null,
    "staticSiteUrl" => "https://sstatic.se",
    "staticBaseUrl" => "https://sstatic.se",
    //"scriptName"    => null,
    "urlType"       => self::URL_CLEAN,

];
