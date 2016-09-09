---
views:
    breadcrumb:
        region: breadcrumb
        template: default/breadcrumb
        data:
            meta: 
                type: breadcrumb

    flash:
        region: flash
        template: default/image
        data:
            src: "/image/innebandy/action2.jpg?sc=banner1&a=30,0,40,5"

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
                        template: default/image
                        data:
                            src:        "/image/innebandy/andreas-kenneth.jpg?w=c8&h=200&cf&a=45,50,15,0"

                    column-2:
                        template: default/image
                        data:
                            src:        "/image/innebandy/emil.jpg?w=c8&h=200&cf&a=0,30,40,20"

                    column-3:
                        template: default/image
                        data:
                            src:        "/image/innebandy/andreas-kenneth.jpg?w=c8&h=200&cf&a=14,0,55,60"

...
Innebandy
===========================
