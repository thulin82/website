How it works
==================================

The script `img.php` uses the class `CImage` which carries out all the image processing, caching and delivery of the resulting image. `img.php` takes the incoming query string and prepares all the parameters and then uses the public API of CImage.



The programmatic flow  {#flow}
--------------------------------------

This is how you can get an understanding on how CImage processes the image.

Review the settings in `webroot/img_config.php` and check out `webroot/img.php` on how it uses `CImage`.

The programmatic flow, just to get you oriented in the environment, is like this.

1. Start in `img.php`.
2. `img.php` reads configuration details from `img_config.php` (if the config-file is available).
3. `img.php` reads and processes incoming `$_GET` arguments to use as options while prepare using `CImage`.
4. `img.php` uses `CImage`.
5. `CImage` processes, caches and outputs the image according to the options used.




How `img.php` uses the class `CImage` {#api}
--------------------------------------

```php
/**
 * Create the class for the image.
 */
require $config['cimage_class'];

$img = new CImage();
$img->setVerbose($verbose);

/**
 * Load, process and output the image
 */
$img->log("Incoming arguments: " . print_r(verbose(), 1))
    ->setSaveFolder($cachePath)
    ->useCache($useCache)
    ->setSource($srcImage, $imagePath)
    ->setOptions(
        array(
            // Options for calculate dimensions
            'newWidth'  => $newWidth,
            'newHeight' => $newHeight,
            'aspectRatio' => $aspectRatio,
            'keepRatio' => $keepRatio,
            'cropToFit' => $cropToFit,
            'fillToFit' => $fillToFit,
            'crop'      => $crop,
            'area'      => $area,
            'upscale'   => $upscale,

            // Pre-processing, before resizing is done
            'scale'        => $scale,
            'rotateBefore' => $rotateBefore,
            'autoRotate'   => $autoRotate,

            // General processing options
            'bgColor'    => $bgColor,

            // Post-processing, after resizing is done
            'palette'   => $palette,
            'filters'   => $filters,
            'sharpen'   => $sharpen,
            'emboss'    => $emboss,
            'blur'      => $blur,
            'convolve'  => $convolve,
            'rotateAfter' => $rotateAfter,

            // Output format
            'outputFormat' => $outputFormat,
            'dpr'          => $dpr,
        )
    )
    ->loadImageDetails()
    ->initDimensions()
    ->calculateNewWidthAndHeight()
    ->setSaveAsExtension($saveAs)
    ->setJpegQuality($quality)
    ->setPngCompression($compress)
    ->useOriginalIfPossible($useOriginal)
    ->generateFilename($cachePath)
    ->useCacheIfPossible($useCache)
    ->load()
    ->preResize()
    ->resize()
    ->postResize()
    ->setPostProcessingOptions($postProcessing)
    ->save()
    ->linkToCacheFile($aliasTarget)
    ->output();
```

`img.php` may also use `CImage` to set the default background color and add convolution expressions, but it depends on if the values are set in the config file `img_config.php`. It can look like this:

```php
$img->setDefaultBackgroundColor($config['background_color']);
$img->addConvolveExpressions($config['convolution_constant']);
```
