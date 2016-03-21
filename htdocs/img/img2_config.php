<?php
/**
 * Configuration for img.php, name the config file the same as your img.php and 
 * append _config. If you are testing out some in imgtest.php then label that 
 * config-file imgtest_config.php.
 *
 */
return array(

    /**
     * Paths, where are all the stuff I should use? 
     * Append ending slash on directories.
     */
    'cimage_class' =>  __DIR__.'/../../cimage/latest/CImage.php',
    'image_path'   =>  __DIR__,
    'cache_path'   =>  __DIR__.'/../../cimage/cache/latest/',



    /**
     * Max image dimensions,
     * 
     */
    'max_width'     => 3000,
    'max_height'    => 3000,



    /**
     * Post processing of images using external tools, set to true or false 
     * and set command to be executed. 
     */
    'postprocessing' => array(
        'png_filter'        => true,
        'png_filter_cmd'    => '/usr/local/bin/optipng -q',

        'png_deflate'       => true,
        'png_deflate_cmd'   => '/usr/local/bin/pngout -q',

        'jpeg_optimize'     => true,
        'jpeg_optimize_cmd' => '/usr/local/bin/jpegtran -copy none -optimize',
    ),



    /**
     * Predefined size constants. 
     * 
     */
    'size_constant' => function() {

        // Set sizes to map constant to value, easier to use with width or height
        $sizes = array(
          'w1' => 613,
          'w2' => 630,
        );

        // Add column width to $area, useful for use as predefined size for width (or height).
        $gridColumnWidth = 30;
        $gridGutterWidth = 10;
        $gridColumns     = 24;

        for ($i = 1; $i <= $gridColumns; $i++) {
            $sizes['c' . $i] = ($gridColumnWidth + $gridGutterWidth) * $i - $gridGutterWidth; 
        }

        return $sizes;
    },



    /**
     * Predefined aspect ratios. 
     * 
     */
    'aspect_ratio_constant' => function() {
        return array(
            '3:1'   => 3/1,
            '3:2'   => 3/2,
            '4:3'   => 4/3,
            '8:5'   => 8/5,
            '16:10' => 16/10,
            '16:9'  => 16/9,
            'golden' => 1.618,
        );
    },



    /**
     * Set error reporting to match development or production environment 
     */
    'error_reporting' => function() {
        error_reporting(-1);
        set_time_limit(30);
        ini_set('gd.jpeg_ignore_warning', 1); // Ignore warning of corrupt jpegs
    },
);

