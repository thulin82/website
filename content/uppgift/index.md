---
views:
    main:
        data:
            class: blog

    byline: false
    share-this: false
    block-about: false
    article-toc: false

    blog-list:
        region: main
        template: default/blog-list
        sort: 2
        data:
            dateFormat: Y-m-d
            meta: 
                type: toc
                items: 7
                orderby: publishTime
                orderorder: desc

    blog-toc:
        region: sidebar-right
        template: default/blog-toc
        sort: 2
        data:
            meta: 
                type: toc
                items: 7
                orderby: publishTime
                orderorder: desc

...
Uppgiftsbanken
===========================

Uppgifter, övningar och laborationer i HTML, CSS, JavaScript, PHP, SQL för att du skall få öva dig i webbprogrammering och webbutveckling.
