Select the source
==============================

Open an image through `img.php` by using its `src` attribute.

> `img.php?src=kodim13.png`

It looks like this.

[FIGURE src=/image/example/kodim13.png&w=w1&save-as=jpg caption="A river, kodimg13.png, from The Kodak Colorset."]



Images in directory structure {#dir}
-----------------------------

All images are stored in a directory structure and you access them as:

> `?src=dir1/dir2/image.png`

The base directory for your images is configured in the config file.



Download remote image
-----------------------------

You can [enable download of remote images](config-file#remote), and then download and process them as an ordinary local image.

> `img.php?src=http://dbwebb.se/img/vimmel/jul-dbwebb-2013.jpg`



Dummy image as placeholder
-----------------------------

You can use a dummy source image as a placeholder.

> `img.php?src=dummy`

It looks like this.

[FIGURE src=/image/dummy caption="Placeholder."]
