Crop parts of image
======================================

[FIGURE src=/image/example/kodim04.png?w=300&h=150&crop-to-fit&save-as=jpg caption="A face cropped to fit a certain width and height." class="figure right"]

You can control the resulting image dimension using `width` and `height` together with the resizing strategies. The strategy `crop-to-fit` seems to be most useful when creating images of specified dimensions.

Lets review some examples where we use `crop-to-fit` together with various options to control the size and active part of the image.



Choose the area of the image to work on {#area}
-------------------------------------------------

When you crop to fit an image, the base will be the center of the image. You can change this by setting an `area` as a base for calculating which part to use of the source image. This is actually an easy way of cropping the part of the image that you want to use. You can see this as defining an offset for the active part of the image. You set the area using values for ` top,right,bottom,left`, each value being a percentage of the original image width/height.

Lets take an example where we want to create a thumbnail of the lady, we want to focus on her eyes and mouth.

| What                | The image           |
|---------------------|---------------------|
| Crop to fit without defining the area.<br>`?w=150&h=150&crop-to-fit` | <img src=/image/example/kodim04.png&w=150&h=150&crop-to-fit alt=''> |
| Ignore the top 25% of the image.<br>`?w=150&h=150&crop-to-fit&area=25,0,0,0` | <img src=/image/example/kodim04.png&w=150&h=150&crop-to-fit&area=25,0,0,0 alt=''> |
| Ignore the right 20% of the image.<br>`?w=150&h=150&crop-to-fit&area=0,20,0,0` | <img src=/image/example/kodim04.png&w=150&h=150&crop-to-fit&area=0,20,0,0 alt=''> |
| Ignore the bottom 20% of the image.<br>`?w=150&h=150&crop-to-fit&area=0,0,20,0` | <img src=/image/example/kodim04.png&w=150&h=150&crop-to-fit&area=0,0,20,0 alt=''> |
| Ignore the left 35% of the image.<br>`?w=150&h=150&crop-to-fit&area=0,0,0,35` | <img src=/image/example/kodim04.png&w=150&h=150&crop-to-fit&area=0,0,0,35 alt=''> |
| Make it altogether to fit only the eyes and the mouth. It may take some tries to get it right.<br>`?w=150&h=150&crop-to-fit&area=25,20,20,35` | <img src=/image/example/kodim04.png&w=150&h=150&crop-to-fit&area=30,20,25,35 alt=''> |



Crop a portion of the image {#crop}
-------------------------------------------------

You can crop parts of an image by setting the *width*, *height*, *start_x* and *start_y* to define the area to crop from the original image. Doing this, we can achieve the same results as when using `area`. It is just another mean to the same end, which is -- cropping out a certain area of the image. Lets see how this way of cropping works. Lets crop the eyes and the mouth of the lady, once more.

| What                | Parameters          | The image           |
|---------------------|---------------------|---------------------|
| Crop a portion of 300x300 pixels, start at the left, top corner, that is position 0, 0. | `?w=150&crop=300,300,0,0` | <img src=/image/example/kodim04.png&w=150&crop=300,300,0,0 alt=''> |
| Crop portion, start at the right, top corner. | `?w=150&crop=300,300,right,top` | <img src=/image/example/kodim04.png&w=150&crop=300,300,right,top alt=''> |
| Crop portion, start at the right, bottom corner. | `?w=150&crop=300,300,right,bottom` | <img src=/image/example/kodim04.png&w=150&crop=300,300,right,bottom alt=''> |
| Crop portion, start at the left, bottom corner. | `?w=150&crop=300,300,left,bottom` | <img src=/image/example/kodim04.png&w=150&crop=300,300,left,bottom alt=''> |
| Crop portion, start at the center, center. | `?w=150&crop=300,300,center,center` | <img src=/image/example/kodim04.png&w=150&crop=300,300,center,center alt=''> |
| Crop only the eyes and the mouth. | `?w=150&crop=200,220,190,300` | <img src=/image/example/kodim04.png&w=150&crop=200,220,190,300 alt=''> |

Cropping is essential when trying to only get the most interesting part of the image.

Learn to crop your images, creative cropping can make wonderful images from appearingly useless originals.
