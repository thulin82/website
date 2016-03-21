Download & Install
======================================

[FIGURE class="right" src="/image/example/kodim04.png?w=200&h=100&cf&a=32,20,40,35" caption="A cropped image."]

There are mainly two ways of using CImage. You either install the whole project which uses the autoloader to include the various files, or you install the all-included bundle that -- for convenience and ease of use -- contains all code in one script.

You can download CImage from GitHub or by using composer.

If this is your first time then I would recommend downloading the whole repo from GitHub. That is the fastest and easiest way of getting up and running for the first time.



GitHub {#github}
--------------------------------------

[FIGURE class="right" src="/image/example/kodim04.png?w=200" caption="A small version of the original image."]

The [source code is available on GitHub](https://github.com/mosbth/cimage). Clone, fork or [download as zip](https://github.com/mosbth/cimage/archive/master.zip). 

You can clone it like this.

```bash
git clone git://github.com/mosbth/cimage.git
cd cimage
```

Ensure that the cache-directory is writable by the webserver.

```bash
chmod 777 cache
```

Point your web browser to `webroot/test/test.php` to see some examples.

Then try on your own by using the script `img.php`. Try the url `webroot/img.php?src=kodim04.png&w=200` which should display the same image as to the right.



Composer {#composer}
--------------------------------------

The package [`mos/cimage` is available on Packagist](https://packagist.org/packages/mos/cimage) and you can install it using composer.

```bash
composer require mos/cimage
```

You can now copy the all-included bundles from the `webroot` directory and put them in your own web root directory, or you copy `img.php` together with its config file `img_config.php` and you put it in your own web root. 



All-included bundle {#install-one}
--------------------------------------

There exists pre-configured variants of the all-included bundles of `img.php`. These can be downloaded as a single PHP script and used without dependency to the rest of the source code.

| Bundled script | Description | 
|----------------|-------------|
| [`imgd.php`](https://github.com/mosbth/cimage/blob/master/webroot/imgd.php)     | Development mode | 
| [`imgp.php`](https://github.com/mosbth/cimage/blob/master/webroot/imgp.php)     | Production mode | 
| [`imgs.php`](https://github.com/mosbth/cimage/blob/master/webroot/imgs.php)     | Strict mode | 

Read about the [different modes](doc/config-file#mode) in the section about the config file.

Download the bundle of your choice from the links above or by using wget or curl like this.

```bash
wget https://raw.githubusercontent.com/mosbth/cimage/master/webroot/imgd.php
curl -O https://raw.githubusercontent.com/mosbth/cimage/master/webroot/imgd.php
```
