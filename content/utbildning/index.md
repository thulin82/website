---
views:
    columns1:
        region: columns-above
        template: default/columns
        sort: 1
        data:
            class: col3
            meta:
                type: columns
                columns:
                    column-1:
                        route: ./block-1
                    column-2:
                        route: ./block-2
                    column-3:
                        route: ./block-3

    columns2:
        region: columns-above
        template: default/columns
        sort: 2
        data:
            class: col3
            meta:
                type: columns
                columns:
                    column-1:
                        route: ./block-4
                    column-2:
                        route: ./block-5
                    column-3:
                        route: ./block-6

    columns3:
        region: columns-above
        template: default/columns
        sort: 3
        data:
            class: col3
            meta:
                type: columns
                columns:
                    column-1:
                        route: ./block-7
                    column-2:
                        route: ./block-8
                    column-3:
                        route: ./block-9

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
Utbildning
=============================

Jobbar på det...
