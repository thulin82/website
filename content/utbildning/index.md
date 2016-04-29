---
title: Utbildningar i Webbprogrammering vid BTH

views:
    main:
        title: Utbildning
        data:
            title: Utbildning

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
                        data:
                            meta:
                                type: content
                                route: ./block-1
                    column-2:
                        data:
                            meta:
                                type: content
                                route: ./block-2
                    column-3:
                        data:
                            meta:
                                type: content
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
                        data:
                            meta:
                                type: content
                                route: ./block-4
                    column-2:
                        data:
                            meta:
                                type: content
                                route: ./block-5
                    column-3:
                        data:
                            meta:
                                type: content
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
                        data:
                            meta:
                                type: content
                                route: ./block-7
                    column-2:
                        data:
                            meta:
                                type: content
                                route: ./block-8
                    column-3:
                        data:
                            meta:
                                type: content
                                route: ./block-9

    blog-list:
        region: main
        template: default/blog-list
        sort: 2
        data:
            dateFormat: j F Y
            meta: 
                type: toc-route
                route: blogg
                orderby: publishTime
                orderorder: desc


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
            meta:
                type: columns
                columns:
                    column-1:
                        data:
                            meta:
                                type: content
                                route: ./block-bottom-1
                    column-2:
                        data:
                            meta:
                                type: content
                                route: ./block-bottom-2
                    column-3:
                        data:
                            meta:
                                type: content
                                route: block/home/col-below-3

...
<div class="block">
    <h4>Senast om Utbildning i Bloggen</h4>
</div>
