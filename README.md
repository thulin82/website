dbwebb.se website
================================

[![Join the chat at https://gitter.im/mosbth/dbwebb](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/mosbth/dbwebb?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

This is the main website for dbwebb.se, live at [https://dbwebb.se](https://dbwebb.se/).



Short story
--------------------------------

Works for me on Debian.

```
$ sudo apt-get install apache2 php5 libapache2-mod-php5 php5-dev php-pear php5-gd
```

```
$ git clone <the original or your forked repo>
$ cd <the original or your forked repo>
$ make etc-hosts
$ make virtual-host
$ make update
```

Now open your browser at `local.dbwebb.se` and browse the website.

If you need to upgrade your existing installation you can just redo it all.

```
$ make etc-hosts virtual-host update
```



For developers and maintainers
--------------------------------

This is guidelines on how to setup your own local development environment for this website.



### Apache and PHP

On Windows and Mac OS you may use XAMPP.

On Debian this will make it happen, it is Apache2 and PHP5 (with pecl and GD).

```
$ sudo apt-get install apache2 php5 libapache2-mod-php5 php5-dev php-pear php5-gd
```

Install Composer and YAML.



### Apache virtual host

You need a a Apache virtual host as local.dbwebb.se.

1) Clone the website to `~/git/dbwebb.se`.

```
$ git clone <the original or your forked repo>
$ cd <the original or your forked repo>
```

2) Create an entry in the `/etc/hosts` for local.dbwebb.se.

```
$ make etc-hosts
```

3) Create the virtual host, the basis can be found here.

```
$ make virtual-host-echo
$ make virtual-host       # On Debian to just do it
```

4) Make and publish to the local structure at ~/htdocs/dbwebb.se.

```
$ make update
```

5) Restart the webserver and open your browser at `local.dbwebb.se` and browse the website.



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



###Install all submodules

Some content is available in external submodules. To install them, where you have the properties to do so, do like this.

```
$ make submodule-init local-publish
```

To keep updated, including all submodules.

```
$ make update-all
```



```                                                            
 .                                                             
..:  Copyright (c) 2012 - 2017 Mikael Roos, mos@dbwebb.se   
```                                                            
