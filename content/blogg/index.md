---
views:
    main:
        data:
            class: blog

    byline: false
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
Nytt och Noterat
===========================

Kortare blogginlägg om vad som händer på dbwebb.se, kurserna samt webbprogrammering och webbutveckling med HTML, CSS, JavaScript, PHP och SQL i allmänhet.
