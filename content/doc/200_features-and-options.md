Features and Options
=============================================

This is an overview of all features/options of CImage by using img.php. 

`img.php` supports a lot of options through url parameters. Combine the parameters to get the desired behavior and resulting image.

[FIGURE src=/image/example/kodim13.png?w=600&aspect-ratio=4&crop-to-fit&sharpen&save-as=jpg&q=30 caption="Example of combining options"]

For example, take the original image, resize it using width, aspect-ratio and crop-to-fit, apply a sharpen effect, save the image as JPEG using quality 30.

> `img.php?src=kodim13.png&w=600&aspect-ratio=4&crop-to-fit&sharpen&save-as=jpg&q=30`

Here is a list of all parameters that you can use together with `img.php`, grouped by its basic intent of usage. 


Source image {#option-src}
--------------------------------------------

Option `src` is the only mandatory option and it selects the source image.

| Parameter      | Explained                                    | 
|----------------|----------------------------------------------|
| `src`          | Source image to use, mandatory. `src=img.png` or with subdirectory `src=dir/img.png`. |
| `src=dummy`    | A dummy source useful as a image placeholder. |

If you [allow download of remote images](config-file#remote), then you can set the source to be `src=http://somewhere/someimage.png`.

There are examples on how to use these options in "[Select the source](select-the-source)".



Width and height {#option-size}
--------------------------------------------

These options are all affecting the final dimensions, width and height, of the resulting image.

| Parameter      | Explained                                    | 
|----------------|----------------------------------------------|
| `height, h`    | `h=200` sets the width to be to max 200px. `h=25%` sets the height to max 25% of its original height. |
| `width, w`     | `w=200` sets the height to be max 200px. `w=100%` sets the width to max 100% of its original width. |
| `aspect-ratio, ar` | Control target aspect ratio. Use together with either height or width or alone to base calculations on original image dimensions. This setting is used to calculate the resulting dimension for the image. `w=160&aspect-ratio=1.6` results in a height of 100px. Use `ar=!1.6` to inverse the ratio, useful for portrait images, compared to landscape images. |
| `device-pixel-ratio, dpr` | Default value is 1, set to 2 when you are delivering the image to a high density screen, `dpr=2` or `dpr=1.4`. Its a easy way to say the image should have larger dimensions. The resulting image will be twice as large (or 1.4 times), keeping its aspect ratio. |

There are examples on how to use these options in "[Resize strategies](resize)" and "[Working with sizes](working-with-size)".



Resize strategy {#option-resize}
--------------------------------------------

These options affect the strategy used when resizing an source image into a target image. One needs to set both width and height for the resize strategies to be used. Without both width and height set they will simply be no operations and silently ignored.

| Parameter      | Explained                                    | 
|----------------|----------------------------------------------|
| `no-ratio, nr, stretch` | Do *not* keep aspect ratio when resizing and using both width & height constraints. Results in stretching the image, if needed, to fit in the resulting box. |
| `crop-to-fit, cf`  | Set together with both `h` and `w` to make the image fit into dimensions, and crop out the rest of the image. |
| `fill-to-fit, ff` | Set together with both `h` and `w` to make the image fit into dimensions, and fill the rest using a background color. You can optionally supply a background color as this `ff=00ff00`, or `ff=00ff007f` when using the alpha channel. |
| `no-upscale, nu` | Avoid smaller images from being upscaled to larger ones. Combine with `stretch`, `crop-to-fit` or `fill-to-fit` to get the smaller image centered on a larger canvas. The requested dimension for the target image are thereby met. |

There are examples on how to use these options in "[Resize strategies](resize)".



Cropping part of image {#option-crop}
--------------------------------------------

These options enable to decide what part of image to use by cropping out the rest.

| Parameter      | Explained                                    | 
|----------------|----------------------------------------------|
| `crop, c`      | Crops an area from the original image, set `width`, `height`, `start_x` and `start_y` to define the area to crop, for example `crop=100,100,10,10` (`crop=width,height,start_x,start_y`). Left top corner is 0, 0. You can use `left`, `right` or `center` when setting `start_x`. You may use `top`, `bottom` or `center` when setting `start_y`. |
| `area, a`      | Define the area of the image to work with. Set `area=10,10,10,10` (`top`, `right`, `bottom`, `left`) to crop out the 10% of the outermost area. It works like an offset to define the part of the image you want to process. Its an alternative of using `crop`. |

There are examples on how to use these options in "[Crop parts of image](crop-part-of-image)".



Set background color {#option-bgc}
--------------------------------------------

Set the default background color to use when suitable.

| Parameter      | Explained                                    | 
|----------------|----------------------------------------------|
| `bg-color, bgc` | Set the background color to use (if its needed). Use six hex digits as `bgc=00ff00` and 8 digits when using the alpha channel, as this `bgc=00ff007f`. The alpha value can be between 00 and 7f. |

There are examples on how to use this option in "[Rotate images](rotate#perpendicular)".



Scale image BEFORE resizing {#option-scale}
--------------------------------------------

These options are executed *before* the image is resized.

| Parameter      | Explained                                    | 
|----------------|----------------------------------------------|
| `scale, s`     | Scale the image to a size proportional to a percentage of its original size, `scale=25` makes an image 25% of its original size and `size=200` doubles up the image size. Scale is applied before resizing and has no impact of the target width and height. |

There are examples on how to use this option in "[Scale before processing](scale-before-processing)".



Rotate {#option-rotate}
--------------------------------------------

These options are executed *before* the image is resized.

| Parameter      | Explained                                    | 
|----------------|----------------------------------------------|
| `rotate-before, rb` | Rotate the image before its processed, send the angle as parameter `rb=45`. |
| `auto-rotate, aro`  | Auto rotate the image based on JPEG EXIF information (useful when using images from smartphones). |

These options are executed *after* the image is resized.

| Parameter      | Explained                                    |
|----------------|----------------------------------------------|
| `rotate-after, ra`<br>`rotate, r` | Rotate the image after its processed, send the angle as parameter `ra=45`. |

You need the [EXIF extension](http://php.net/manual/en/book.exif.php) to support [auto-rotation of JPEG-images](auto-rotate). 

There are examples on how to use these options in "[Rotate images](rotate)".



Filters and convolve expressions  {#option-filter}
--------------------------------------------

These options are executed *after* the image is resized and applies filter and effects to the resized image.

| Parameter      | Explained                                    |
|----------------|----------------------------------------------|
| `sharpen`            | Appy a convolution filter that sharpens the image.       |
| `emboss`             | Appy a convolution filter with an emboss effect.         |
| `blur`               | Appy a convolution filter with a blur effect.            |
| `convolve`           | Appy custom convolution filter as a 3x3 matrix, a divisor and offset, `convolve=0,-1,0,-1,5,-1,0,-1,0,1,0` sharpens the image. |
| `convolve`           | Use predefined convolution expression as `convolve=sharpen-alt` or a serie of convolutions as `convolve=draw,mean,motion`. These are supported out of the box: `lighten`, `darken`, `sharpen`, `sharpen-alt`, `emboss`, `emboss-alt`, `blur`, `gblur`, `edge`, `edge-alt`, `draw`, `mean`, `motion`. Add your own, or overwrite existing, in `img_config.php`. |
| `f, filter`          | Apply filter to image, `f=colorize,0,255,0,0` makes image more green. Supports all filters as defined in [PHP GD `imagefilter()`](http://php.net/manual/en/function.imagefilter.php). |
| `f0, f1-f9`    | Same as `filter`, just add more filters. Applied in order `f`, `f0-f9`.  |
| `sc, shortcut` | Save longer expressions in `img_config.php`. One place to change your favorite processing options, use as `sc=sepia` which is a shortcut for `&f=grayscale&f0=brightness,-10&f1=contrast,-20`<br>`&f2=colorize,120,60,0,0&sharpen`. |

There are examples on how to use these options in "[Filters and convolution](filters)", "[Filters and effects from PHP GD](gdfilter)" and "[Create shortcuts](shortcut)".



Saving image, affecting quality and file size {#option-save}
--------------------------------------------

Options for saving the target image.

| Parameter      | Explained                                    | 
|----------------|----------------------------------------------|
| `quality, q`   | Quality affects lossy compression and file size for JPEG images by setting the quality between 1-100, default is 60.  Quality only affects JPEG. |
| `compress, co` | For PNG images it defines the compression algorithm, values can be 0-9, default is defined by PHP GD. Compress only affects PNG. |
| `palette, p`   | Create a palette version of the image with up to 256 colors. |
| `save-as, sa`  | Save resulting image as JPEG, PNG or GIF, for example `?src=river.png&save-as=gif`. |
| `alias`        | Save resulting image as a copy in the alias-directory. |

There are examples on how to use these options in "[Quality and file size](quality-filesize)", "[JPEG quality settings](jpeg-quality-settings)" and "[PNG compression levels](png-compression-settings)".



Caching {#option-cache}
--------------------------------------------

You can control which version of the image you are using, the cached version or the original version. This is useful for development and testing of CImage.

| Parameter      | Explained                                    | 
|----------------|----------------------------------------------|
| `no-cache, nc` | Do not use the cached version, do all image processing and save a new image to cache. |
| `skip-original, so`| Skip using the original image, always process image, create and use a cached version of the original image, even if the original is the best match. |

There are examples on how to use these options in "[Troubleshoot image processing](troubleshoot)".



Verbose output {#option-verbose}
--------------------------------------------

There are a couple of options that provides verbose output which is useful when one want to understand what happens behind the scene, or when doing testing.

| Parameter      | Explained                                    | 
|----------------|----------------------------------------------|
| `verbose, v`   | Do verbose output and print out a log what happens. Good for debugging, analyzing the process and inspecting how the image is being processed. |
| `json`         | Output a JSON-representation of the image, useful for testing or optimizing when one wants to know the image dimensions, before using it. |
| `status`       | Output details on the system and current configuration. |

The options `verbose` and `status` is only available in [development mode](config-file#mode).



Password protection {#option-pwd}
--------------------------------------------

Passwords are used to protect potential harmful options such as remote download of images and storing images with a new name through an alias. The [password is configured in the config file](config-file#password) and is disabled by default.

| Parameter       | Explained                                    | 
|-----------------|----------------------------------------------|
| `pwd, password` | Use password to protect unauthorized usage.  |
