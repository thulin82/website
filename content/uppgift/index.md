---
views:
    main:
        data:
            class: blog

    block-about: false
    article-toc: false

    blog-list:
        region: main
        template: default/blog-list
        sort: 2
        data:
            meta: 
                type: toc
                items: 7

    blog-toc:
        region: sidebar-right
        template: default/blog-toc
        sort: 2
        data:
            meta: 
                type: toc
                items: 7

...
Uppgiftsbanken
===========================

Uppgifter, övningar och laborationer i HTML, CSS, JavaScript, PHP, SQL för att du skall få öva dig i webbprogrammering och webbutveckling.
