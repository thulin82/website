Basic configuration
======================================

The script img.php reads its configuration from the config file `img_config.php` found in the same directory.

If you are using a bundle like `img{d,p,s}.php`, then the [configuration is done directly in the bundle file](config-file#bundle-array), or by [creating a separate configuration file](config-file#config-bundle).

Most settings have working default values and a complete walk through of all settings can be seen in the section "[The configuration file](config-file)".

For now, lets stay with the most basic settings that will let you get going with CImage. Lets look at `img_config.php` and see the most important settings.



Autoloading {#autoloading}
--------------------------------------

The bundles does not need the autoloader since they are all code in one script. But when using img.php you need to point out the file containing the autoloader.

The default setting looks like this.

```php
/**
 * Where are the sources for the classfiles.
 *
 * Default values:
 *  autoloader:  null
 */
'autoloader'   =>  __DIR__ . '/../autoload.php',
```

Update it if needed.



Cache and image directory {#dirs}
--------------------------------------

You need a cache directory where all the images are stored. This directory needs to be writable for the web server.

You also need to point out the directory holding your images.

These are the default settings.

```php
/**
 * Paths, where are the images stored and where is the cache.
 * End all paths with a slash.
 *
 * Default values:
 *  image_path: __DIR__ . '/img/'
 *  cache_path: __DIR__ . '/../cache/'
 */
'image_path'   =>  __DIR__ . '/img/',
'cache_path'   =>  __DIR__ . '/../cache/',
```

Update them to match your paths on your system and ensure that the cache-dir is writable by the web server.



Development mode {#mode}
--------------------------------------

The development mode is more verbose of its error situations. This is good for first time users.

Update your configuration file to use development mode.

```php
/**
 * Set mode as 'strict', 'production' or 'development'.
 *
 * Default values:
 *  mode: 'production'
 */
 //'mode' => 'production',
 'mode' => 'development',
 //'mode' => 'strict',
```

Do not forget to change this back when you go into production.
