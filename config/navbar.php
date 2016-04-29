<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    "wrapper" => null,
    "class" => "rm-default rm-desktop",
 
    // Here comes the menu strcture
    "items" => [

        "kurser" => [
            "text"  =>"Kurser",
            "url"   => $this->di->get("url")->create("kurser"),
            "title" => "Jobba med kurserna"
        ],

        "community" => [
            "text"  =>"Community",
            "url"   => $this->di->get("url")->create("community"),
            "title" => "Delta i communityn"
        ],

        "material" => [
            "text"  =>"Material",
            "url"   => $this->di->get("url")->create("material"),
            "title" => "Kurs- och utbildningsmaterial"
        ],
/*
        "kunskap" => [
            "text"  =>"Kunskap",
            "url"   => $this->di->get("url")->create("kunskap"),
            "title" => "Läs kunskapsartiklar"
        ],

        "coachen" => [
            "text"  =>"Coachen",
            "url"   => $this->di->get("url")->create("coachen"),
            "title" => "Läs tips från coachen"
        ],

        "uppgifter" => [
            "text"  =>"Uppgifter",
            "url"   => $this->di->get("url")->create("uppgift"),
            "title" => "Jobba med uppgifter och övningar"
        ],

        "blogg" => [
            "text"  =>"Blogg",
            "url"   => $this->di->get("url")->create("blogg"),
            "title" => "Läs om dbwebb, kurserna, webbprogrammering och webbutveckling och utbildning i allmänhet"
        ],
*/
        "utbildning" => [
            "text"  =>"Utbildning",
            "url"   => $this->di->get("url")->create("utbildning"),
            "title" => "Läs om de utbildningar vi erbjuder inom webbprogrammering och webbutveckling"
        ],

        "om" => [
            "text"  =>"Om",
            "url"   => $this->di->get("url")->create("om"),
            "title" => "Läs om webbplatsen, de som står bakom och dess syfte"
        ],

    ],
 


    /**
     * Callback tracing the current selected menu item base on scriptname
     *
     */
    "callback" => function ($url) {
        if ($url == $this->di->get("request")->getCurrentUrl(false)) {
            return true;
        }
    },



    /**
     * Callback to check if current page is a decendant of the menuitem, this check applies for those
     * menuitems that has the setting "mark-if-parent" set to true.
     *
     */
    "is_parent" => function ($parent) {
        $route = $this->di->get("request")->getRoute();
        return !substr_compare($parent, $route, 0, strlen($parent));
    },



   /**
     * Callback to create the url, if needed, else comment out.
     *
     */
   /*
    "create_url" => function ($url) {
        return $this->di->get("url")->create($url);
    },
    */
];
