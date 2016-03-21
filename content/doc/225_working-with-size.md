Working with sizes
======================================

[FIGURE src=/image/example/kodim13.png?w=150&h=150&crop-to-fit&save-as=jpg caption="Can we support grid based layout?" class="figure right"]

The basis for resizing the image is the settings for `width` and `height`. But there are many ways of creating these values.

Lets review some examples where we use alternate ways of calculating the dimension of the image. Lets check on predefined sizes, support for grid based layout and create sizes using aspect ratio.



Predefined sizes {#sizes}
-------------------------------------------------

There are a set of [predefined sizes](config-file#size) available in `img_config.php`. These are based on a grid of 24 columns where each column is 30px wide and a gutter of 10px between each column. The predefined sizes are named `c1` to `c24` and corresponds to the width of the columns in the grid. It can be useful to specify the image width based on predefined sizes, if you ever want to change the grid, or the size of the main article column or the sidebar column, then you have only one place to change the image size. This might be time saver when working on websites changing their layout.


| What         | Parameters                | The image           |
|--------------|---------------------------|---------------------|
| One column, `c1`, 30px wide.       | `?w=c1&h=150&crop-to-fit` | <img src=/image/example/kodim04.png&w=c1&h=150&crop-to-fit alt=''> |
| Two columns width, `c2`, 30px * 2 + 10px = 70px wide. | `?w=c2&h=150&crop-to-fit` | <img src=/image/example/kodim04.png&w=c2&h=150&crop-to-fit alt=''> |
| Three columns, `c3`, 30px * 3 + 10px * 2 = 110px wide.     | `?w=c3&h=150&crop-to-fit` | <img src=/image/example/kodim04.png&w=c3&h=150&crop-to-fit alt=''> |

You can specify your own constants and map them to a size. You do this by editing the configuration file.



Calculate dimensions using aspect ratio {#aspectratio}
-------------------------------------------------

You can use aspect ratio to create images that has a well defined relation between width and height. Specify width, or height, together with aspect ratio and the other dimension will be calculated. If you omit both width and height, but specify aspect ratio, the resulting dimensions is based on the original dimensions.

The resulting dimensions specify a box for the image, which any resulting image dimension will not overflow, you need to use `stretch`, `crop-to-fit` or `fill-to-fit` to make the image fit into the box.

Here are some examples on how to use aspect ratio.



###Aspect ratio on landscape image {#aspect-landscape}

| Aspect ratio, parameters          | The image           |
|-----------------------------------|---------------------|
| **16:10**<br>`&w=300&crop-to-fit&aspect-ratio=16:10` | <img src=/image/example/kodim13.png&sa=jpg&w=300&ar=16:10&cf alt=''> |
| **3:1**<br>`&w=300&crop-to-fit&aspect-ratio=3:1` | <img src=/image/example/kodim13.png&sa=jpg&w=300&ar=3:1&cf alt=''> |

The aspect ratio can be a float, for example `&aspect-ratio=1.6` or any of the [predefined aspect ratios](config-file#aspect-ratio) in `img_config.php`, as of this writing it includes 3:1, 3:2, 4:3, 8:5, 16:10, 16:9 and golden (for the golden ratio).

The aspect ratio can be inverted by prepending an exclamation mark `!` to the value. This can be useful when working with portrait images.



###Inverted aspect ratio on portrait image {#aspect-portrait}

| What, parameters          | The image           |
|---------------------------|---------------------|
| **!16:10**<br>`&h=200&crop-to-fit&aspect-ratio=!16:10` | <img src=/image/example/kodim04.png&sa=jpg&h=200&ar=!16:10&cf alt=''> |
| **!3:1**<br>`&h=200&crop-to-fit&aspect-ratio=!3:1` | <img src=/image/example/kodim04.png&sa=jpg&h=200&ar=!3:1&cf alt=''> |

Aspect ratio can be a good way to make all images the same size, or at least, having the same aspect ratio.



Device pixel ratio {#dpr}
-------------------------------------------------

When working with devices having a higher device pixel rate, one could decide to send a larger image to such devices. The option `device-pixel-rate, dpr` is a shortcut to enlarge the image dimensions.

Lets see two examples using the options `&w=200&h=200&`.

| `dpr=1`          | `dpr=2`           |
|---------------------------|---------------------|
| <img src=/image/example/kodim13.png&sa=jpg&w=200&h=200&dpr=1&cf alt=''> | <img src=/image/example/kodim13.png&sa=jpg&w=200&h=200&dpr=2&cf alt=''> |

You see that the option `dpr=2` simply enlarges both width and height with the selected factor.
