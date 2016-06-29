---
title: Kurser

views:
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

...
<div class="block">
    <h4>Senaste nytt om kurser</h4>
</div>
