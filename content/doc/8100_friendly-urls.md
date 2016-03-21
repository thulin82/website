Friendly urls through `.htaccess`
======================================

Use `.htaccess` and rewrite rules (Apache) to get friendly image urls.

Instead of doing this...

> `img.php?src=all-cars/car.jpg&w=300&sharpen`

You can do this...

> `/image/all-cars/car.jpg?w=300&sharpen`

This is how a `.htaccess` can look like.

```bash
#
# Rewrite to have friendly urls to img.php, edit it to suite your environment.
#
# The example is set up as following.
#
#  img                 A directory where all images are stored
#  img/me.jpg          Access a image as usual.
#  image/me.jpg        Access a image though img.php using htaccess rewrite.
#  image/me.jpg?w=300  Using options to img.php.
# 
# Subdirectories also work.
#  img/me/me.jpg          Direct access to the image.
#  image/me/me.jpg        Accessed through img.php.
#  image/me/me.jpg?w=300  Using options to img.php.
#
RewriteEngine on
RewriteRule ^image/(.*)$   img.php?src=$1 [QSA,NC,L]
```

You can now access all images through either `/image/car.jpg` (which uses `img.php`) or as usual through `/img/car.jpg` without passing through `img.php`. You send the options as before.

> `/image/car.jpg?w=300&sharpen`
> `/image/all-cars/car.jpg?w=300&sharpen`

The result is good readable urls to your images. Its easy for the search engine to track and you can use the directory structure already existing in `/img`. Just like one wants to have it.
