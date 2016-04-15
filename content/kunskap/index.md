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
Kunskapsbanken
===========================

Artiklar, guider, tips och trix tillsammans med exempelprogram inom webbprogrammering och webbutveckling. Inläggen är listade i den ordning som de senast uppdaterats.
