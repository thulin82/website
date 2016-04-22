---
views:
    flash:
        region: flash
        template: default/image
        data:
            src: "/image/vimmel/varbild-dbwebb2.jpg"

    blog-list:
        region: main
        template: default/blog-list
        sort: 2
        data:
            dateFormat: j F Y
            meta: 
                type: toc

    sidebar-1:
        region: sidebar-right
        template: default/block
        data:
            meta:
                type: content
                route: block/home/sidebar-1

    columns-above:
        region: columns-above
        template: default/columns
        sort: 1
        data:
            class: col3
            classes: no-bullet
            meta:
                type: columns
                columns:
                    column-1:
                        route: block/home/col-1
                    column-2:
                        route: block/home/col-2
                    column-3:
                        route: block/home/col-3

    columns-below:
        region: columns-below
        template: default/columns
        sort: 1
        data:
            class: col3
            classes: no-bullet
            meta:
                type: columns
                columns:
                    column-1:
                        route: block/home/col-below-1
                    column-2:
                        route: block/home/col-below-2
                    column-3:
                        route: block/home/col-below-3

...
Version 2-ish av dbwebb.se
=============================

Jobbar på det...

För tillfället drivs arbetet av kursutvecklingen av följande kurser.

* [webdesign](webdesign)
* [oopython](oopython)

Jag har kopierat lite saker från [python-kursen](python) för att ha mallar att utgå ifrån.

En hel del av länkarna i texterna fungerar inte, måste fixa det. 

Senaste status finns i [bloggen](blogg).

Gör [issues](https://github.com/dbwebb-se/website/issues) av fel och förslag. [Källkoden finns på GitHub](https://github.com/dbwebb-se/website).
