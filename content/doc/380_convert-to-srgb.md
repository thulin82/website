Convert to sRGB color space.
==============================

This is how you can deal with images not being saved as pure sRGB images.

PHP GD operates on pure sRGB color space. This makes it troublesome to deal with images that is not saved in sRGB color space. Since PHP GD ignores the extra information on color profile, the images usually end up looking dull and misses the vibrant colors from the original image.

The PHP extension imagick needs to be installed to support this.

Or just save all your originals using the sRGB colorspace and this will not be an issue.



Problem with PHP GD and color profiles {#spot}
--------------------------------

Lets take a hamburger that is saved having the colorspace of Adobe RGB (1998) which has a larger range of colors than the more common (for web usage) sRGB.

<div id="hamburger" class="image-overlay">
    <div>
        [FIGURE src=/img/example/hamburger.jpg caption="Original hamburger with colorspace Adobe RGB (1998), looks real tasty." nolink]

        [FIGURE src=/image/example/hamburger.jpg?so caption="Hamburger processed with PHP GD and lost all vivid colors, giving a dull impression." nolink]

        [FIGURE src=/image/example/hamburger.jpg?so&srgb caption="Hamburger converted to sRGB by CImage, looks tasty again!" nolink]
    </div>

    <ul>
        <li><code>hamburger.jpg</code>
        <li><code>?skip-original</code>
        <li><code>?skip-original&srgb</code>
    </ul>

</div>



Lets review the same issue using a yellow car which has the color profile "Color LCD".

<div id="car" class="image-overlay">
    <div>
        [FIGURE src=/img/example/car.png caption="Original yellow cool car with color profile Color LCD." nolink]

        [FIGURE src=/image/example/car.png?so caption="Car processed with PHP GD and lost the bright yellow color, giving a darker impression." nolink]

        [FIGURE src=/image/example/car.png?so&srgb caption="Car converted to sRGB by CImage and the processed with PHP GD, looks bright again!" nolink]
    </div>

    <ul>
        <li><code>car.png</code>
        <li><code>?skip-original</code>
        <li><code>?skip-original&srgb</code>
    </ul>
</div>


In general this should not be to much problem, just save all your original images as sRGB and your home safe.



<script async src="/js/mos-theme/image-overlay.js"></script>
<script>
window.addEventListener("load", function() {
    imageOverlay("hamburger");
    imageOverlay("car");
});
</script>



Always convert to sRGB by configuration {#configure}
--------------------------------

You can decide to always use the option `srgb`, for all images, by turning this on in the config file.

The default section from the config file looks like this.

```php
  /**
   * Convert the image to sRGB before processing. Saves the converted
   * image in a cache subdir 'srgb'. This option is default false but can
   * be changed to default true to always do conversion for all images.
   * This option requires PHP extension imagick and will silently fail
   * if that is not installed.
   *
   * Default value:
   *  srgb_default:      false
   *  srgb_colorprofile: __DIR__ . '/../icc/sRGB_IEC61966-2-1_black_scaled.icc'
   */
   //'srgb_default' => false,
   //'srgb_colorprofile' => __DIR__ . '/../icc/sRGB_IEC61966-2-1_black_scaled.icc',
```

Note that CImage needs the path to the color profile to work, change this if needed.
