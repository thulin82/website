---
views:
    sidebar-1:
        region: sidebar-right
        template: default/block
        data:
            meta:
                type: content
                route: ./block-sidebar-1

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
Jobba med kurserna
=============================

Ska ha liknande upplägg som nuvarande dbwebb.se/kurser.
