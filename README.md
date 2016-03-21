dbwebb.se website
================================

[![Join the chat at https://gitter.im/mosbth/dbwebb](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/mosbth/dbwebb?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

This is (to be) the main website for dbwebb.se.

Work to merge content from [dbwebb.se](http://dbwebb.se) is ongoing.

You can check a live version, so far, at [v2.dbwebb.se](http://v2.dbwebb.se).



For developers and maintainers
--------------------------------



###Fresh install

Start by preparing your local development environment.

```
$ cd git && git clone <the original or your forked repo>
$ cd <the original or your forked repo>
$ make create-local-structure
$ make etc-hosts
$ make virtual-host
$ make update
```

Now open your browser at `local.v2.dbwebb.se` and browse the website.



###Keep updated

Update the code base, the external packages and publish locally.

```
$ make update
```



###Develop and test locally

Make changes in your repo, publish using `make local-publish` and reload your browser.

```
# Do changes and then publish them locally.
$ make local-publish

# Clear the cache when publishing
$ make local-publish-clear
```



###Help me

* [Install YAML on Debian/Linux](http://dbwebb.se/t/5244).



```                                                            
 .                                                             
..:  Copyright (c) 2012 - 2016 Mikael Roos, mos@dbwebb.se   
```                                                            
