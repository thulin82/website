Post processing
==================================

You can use post processing tools to further reduce the file size. Post processing are default off by configuration.

You need to install the external tools and then you can enable post processing through the configuration file.

These are the default settings.

```php
/**
 * Post processing of images using external tools, set to true or false
 * and set command to be executed.
 *
 * Default values.
 *
 *  png_filter:        false
 *  png_filter_cmd:    '/usr/local/bin/optipng -q'
 *
 *  png_deflate:       false
 *  png_deflate_cmd:   '/usr/local/bin/pngout -q'
 *
 *  jpeg_optimize:     false
 *  jpeg_optimize_cmd: '/usr/local/bin/jpegtran -copy none -optimize'
 */
/*
'postprocessing' => [
    'png_filter'        => false,
    'png_filter_cmd'    => '/usr/local/bin/optipng -q',

    'png_deflate'       => false,
    'png_deflate_cmd'   => '/usr/local/bin/pngout -q',

    'jpeg_optimize'     => false,
    'jpeg_optimize_cmd' => '/usr/local/bin/jpegtran -copy none -optimize',
],
*/
```

The post processing tools are really efficient in creating a proper file size. It however can take one or two seconds to process the image. But this is only done once, then the created image is stored in the cache.



Post-processing with external tools {#post-ext}
-------------------------------------

You can use external tools to post-process the images to optimize the file size. This option is available for JPEG and for PNG images. Post-processing is disabled by default, edit `img_config.php` to enable it.

It takes additional time to do post processing, it can take up to a couple of seconds. This is processing to create the cached image, thereafter the cached version will be used and no more post processing needs to be done.

These tools for post processing is not a part of `CImage` and `img.php`, you need to download and install them separately. I use them myself on my system to get an optimal file size.
