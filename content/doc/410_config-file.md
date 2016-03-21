The configuration file
===================================



###Create and name the config file {#config-name}

The file `img.php` looks for the config-file `img_config.php`, and uses it if its found. The three files where everything is included -- `imgd.php`, `imgp.php` and `imgs.php` -- includes an empty `$config`-array which can be overridden by saving a config-file in the same directory. If the script is `imgp.php` then name the config-file `imgp_config.php` and it will find it and use those settings. 


Mode {#mode}
-----------------------------------

| [`imgd.php`](https://github.com/mosbth/cimage/blob/master/webroot/imgd.php)     | Development mode with verbose error reporting. Option `&verbose` and `&status` enabled. | 
| [`imgp.php`](https://github.com/mosbth/cimage/blob/master/webroot/imgp.php)     | Production mode logs all errors to file, giving server error 500 for bad usage. Option `&verbose` and `&status` disabled. | 
| [`imgs.php`](https://github.com/mosbth/cimage/blob/master/webroot/imgs.php)     | Strict mode logs few errors to file, giving server error 500 for bad usage. Stripped from comments and spaces. Option `&verbose` and `&status` disabled. | 



Configure an all-included bundle {#bundle}
-----------------------------------

###Edit the bundle config array {#bundle-array}


###Create a config file for a bundle {#config-bundle}

 like `img{d,p,s}_config.php`. That is, the config file for `imgd.php` should be named `imgd_config.php`




Size constants {#size}
-----------------------------------

```
/**
 * Predefined size constants.
 *
 * These can be used together with &width or &height to create a constant value
 * for a width or height where can be changed in one place.
 * Useful when your site changes its layout or if you have a grid to fit images into.
 *
 * Example:
 *  &width=w1  // results in width=613
 *  &width=c2  // results in spanning two columns with a gutter, 30*2+10=70
 *  &width=c24 // results in spanning whole grid 24*30+((24-1)*10)=950
 *
 * Default values.
 *  size_constant: As specified by the function below.
 */
/*
'size_constant' => function () {
    // Set sizes to map constant to value, easier to use with width or height
    $sizes = array(
      'w1' => 613,
      'w2' => 630,
    );
    // Add grid column width, useful for use as predefined size for width (or height).
    $gridColumnWidth = 30;
    $gridGutterWidth = 10;
    $gridColumns     = 24;
    for ($i = 1; $i <= $gridColumns; $i++) {
        $sizes['c' . $i] = ($gridColumnWidth + $gridGutterWidth) * $i - $gridGutterWidth;
    }
    return $sizes;
},*/
```



Aspect ratio constants {#aspect-ratio}
-----------------------------------

```
/**
 * Predefined aspect ratios.
 *
 * Default values.
 *  aspect_ratio_constant: As the function below.
 */
/*'aspect_ratio_constant' => function () {
    return array(
        '3:1'   => 3/1,
        '3:2'   => 3/2,
        '4:3'   => 4/3,
        '8:5'   => 8/5,
        '16:10' => 16/10,
        '16:9'  => 16/9,
        'golden' => 1.618,
    );
},*/
```


Convolution expressions {#convolution}
-----------------------------------

```php
/**
 * Custom convolution expressions, matrix 3x3, divisor and offset. 
 */
private $convolves = array(
    'lighten'       => '0,0,0, 0,12,0, 0,0,0, 9, 0',
    'darken'        => '0,0,0, 0,6,0, 0,0,0, 9, 0',
    'sharpen'       => '-1,-1,-1, -1,16,-1, -1,-1,-1, 8, 0',
    'sharpen-alt'   => '0,-1,0, -1,5,-1, 0,-1,0, 1, 0',
    'emboss'        => '1,1,-1, 1,3,-1, 1,-1,-1, 3, 0',
    'emboss-alt'    => '-2,-1,0, -1,1,1, 0,1,2, 1, 0',
    'blur'          => '1,1,1, 1,15,1, 1,1,1, 23, 0',
    'gblur'         => '1,2,1, 2,4,2, 1,2,1, 16, 0',
    'edge'          => '-1,-1,-1, -1,8,-1, -1,-1,-1, 9, 0',
    'edge-alt'      => '0,1,0, 1,-4,1, 0,1,0, 1, 0',
    'draw'          => '0,-1,0, -1,5,-1, 0,-1,0, 0, 0',
    'mean'          => '1,1,1, 1,1,1, 1,1,1, 9, 0',
    'motion'        => '1,0,0, 0,1,0, 0,0,1, 3, 0',
);
``` 

Each expression is an eleven float value string, separated by commas. The string is converted like this.

```php
    // As defined
    'sharpen'  => '-1,-1,-1, -1,16,-1, -1,-1,-1, 8, 0',

    // Converted to ([] is short syntax for array())
    $matrix = [
        [-1, -1, -1],
        [-1, 16, -1],
        [-1, -1, -1],
    ];

    $divisor = 8;
    $offset  = 0;

    // Called by this
    $img = imageconvolution($img, $matrix, $divisor, $offset)
```

So, above expressions are defined in `CImage`. But you can define your own in `img_config.php` and the default config-file contains an example like this. They are outcommented by default since they are only there as an example.

```php
/**
 * Create custom convolution expressions, matrix 3x3, divisor and 
 * offset.
 */
'convolution_constant' => array(
    //'sharpen'       => '-1,-1,-1, -1,16,-1, -1,-1,-1, 8, 0',
    //'sharpen-alt'   => '0,-1,0, -1,5,-1, 0,-1,0, 1, 0',
),
```

The convolution expressions defined in `img_config.php` will add to, or overwrite, those defined in `CImage`. Any convolution constant can then be used, no matter where its defined.




The configuration settings in `_config.php` {#config-file}
--------------------------------------

There are several configurations settings that can be used to change the behaviour of `img.php`. Here is an overview, listed as they appear in the default config-file.

| Setting                 | Explained                                    | 
|-------------------------|----------------------------------------------|
| `mode`                  | Set to "development", "production" or "strict" to match the mode of your environment. It mainly affects the error reporting and if option `verbose` is enabled or not. |
| `autoloader`            | Path to the file containing the autoloader. | 
| `image_path`            | Path to the directory-structure containing the images. |  
| `cache_path`            | Path to the directory where all the cache-files are stored. |  
| `alias_path`            | Path to where the alias, or copy, of the images are stored. |  
| `password`              | Set the password to use. |  
| `password_always`       | Always require the use of password and match with `password`. |  
| `remote_allow`          | Allow remote download of images when `src=http://example.com/img.jpg`. |  
| `remote_pattern`        | Pattern (regexp) to detect if a file is remote or not. |  
| `valid_filename`        | A regular expression to test if a `src` filename is valid or not. |  
| `valid_aliasname`       | A regular expression to test if a `alias` filename is valid or not. |  |  
| `img_path_constraint`   | Check that the target image is in a true subdirectory of `img-path` (disables symbolic linking to another part of the filesystem. |  
| `default_timezone`      | Use to set the timezone if its not already set. |  
| `max_width`             | Maximal width of the target image. Fails for larger values. | 
| `max_height`            | Maximal height of the target image. Fails for larger values. | 
| `background_color`      | Specify a default background color and overwrite the one proposed by `CImage`. |  
| `png_filter`            | Use (or not) an external command for filter PNG images. |  
| `png_filter_cmd`        | Path and options to the actual external command. |  
| `png_deflate`           | Use (or not) an external command for deflating PNG images. |  
| `png_deflate_cmd`       | Path and options to the actual external command. |  
| `jpeg_optimize`         | Use (or not) an external command for optimizing JPEG images. |  
| `jpeg_optimize_cmd`     | Path and options to the actual external command. |  
| `convolution_constant`  | Constants for own defined convolution expressions. |  
| `allow_hotlinking`      | Allow or disallow hotlinking7leeching of images. |  
| `hotlinking_whitelist`  | Array of regular expressions that allow hotlinking (if hotlinking is disabled). |  
| `shortcut`              | Define own shortcuts for more advanced combination of options to `img.php`. |  
| `size_constant`         | Create an array with constant values to be used instead of `width` and `height`. |  
| `aspect_ratio_constant` | Create an array for constant values to be used with option 'aspect-ratio`. |  

Consult the source code [`webroot/img_config.php`](https://github.com/mosbth/cimage/blob/master/webroot/img_config.php) for a complete list together with the default values for each configuration setting. There are comments explaining each section together with examples.
