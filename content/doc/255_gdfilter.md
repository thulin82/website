Filters and effects from PHP GD
==================================

There are a set of filters that are built in to PHP GD library. You can get an overview of these filters and their arguments by reviewing the documentation for [imagefilter()](http://www.php.net/manual/en/function.imagefilter.php).

[FIGURE src=/image/example/kodim24.png&w=w2&save-as=jpg caption="A house, kodimg24.png, from The Kodak Colorset."]

Lets see some examples on using these filters. The base for all examples are:

> `?src=kodim24.png&w=300&save-as=jpg`



Filter Negate {#negate}
---------------------------------------------

This filter reverses all colors of the image.

| Usage                  |   |
|------------------------|--:|
| `&f=negate` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=negate alt=''> | 



Filter Grayscale {#grayscale}
---------------------------------------------

This filter converts the image into grayscale. 

| Usage                  |   |
|------------------------|--:|
| `&f=grayscale` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=grayscale alt=''> | 



Filter Brightness {#brightness}
---------------------------------------------

This filter changes the brightness of the image. Use *arg1* to set the level of brightness. 0 is current setting, 255 is max light which means white and -255 is max dark meaning black. 

| Usage                  |   |
|------------------------|--:|
| `&f=brightness,50` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=brightness,50 alt=''> | 
| `&f=brightness,-50` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=brightness,-50 alt=''> | 



Filter Contrast {#contrast}
---------------------------------------------

This filter changes the contrast of the image. Use *arg1* to set the level of contrast. 0 is current setting, 100 is lowest contrast which means a completely gray image and -100 is max contrast. 

| Usage                  |   |
|------------------------|--:|
| `&f=contrast,20` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=contrast,20 alt=''> | 
| `&f=contrast,-20` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=contrast,-20 alt=''> | 



Filter Colorize {#colorize}
---------------------------------------------

 This is like the grayscale filter, except you can specify the color. Use *arg1*, *arg2* and *arg3* in the form of red, green, blue and *arg4* for the alpha channel. The range for each color is 0 to 255 where a positive value enhances the color and a negative value decreases the color. For the alpha channel it is a value between 0 and 127. 0 indicates completely opaque while 127 indicates completely transparent. 

| Usage                  |   |
|------------------------|--:|
| Enhance the green color `&f=colorize,0,30,0,0` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=colorize,0,30,0,0 alt=''> | 
| Make it look golden with some brown tone `&f=colorize,100,60,0,0` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=colorize,100,60,0,0 alt=''> | 
| Reduce the color red `&f=colorize,-60,0,0,0` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=colorize,-60,0,0,0 alt=''> | 



Filter Edge Detect {#edgedetect}
---------------------------------------------

This filter uses edge detection to highlight the edges in the image. 

| Usage                  |   |
|------------------------|--:|
| `&f=edgedetect` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=edgedetect alt=''> | 



Filter Emboss {#emboss}
---------------------------------------------

This filter embosses the image and gives it a 3D look. 

| Usage                  |   |
|------------------------|--:|
| `&f=emboss` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=emboss alt=''> | 



Filter Gaussian Blur {#gaussian}
---------------------------------------------

This filter blurs the image using the Gaussian method. 

| Usage                  |   |
|------------------------|--:|
| `&f=gaussian_blur` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=gaussian_blur alt=''> | 



Filter Selective Blur {#selective}
---------------------------------------------

This filter blurs the image.

| Usage                  |   |
|------------------------|--:|
| `&f=selective_blur` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=selective_blur alt=''> | 



Filter Mean Removal {#meanremoval}
---------------------------------------------

This filter uses mean removal to achieve a "sketchy" effect.

| Usage                  |   |
|------------------------|--:|
| `&f=mean_removal` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=mean_removal alt=''> | 



Filter Smooth {#smooth}
---------------------------------------------

This filter makes the image smoother. Use *arg1* to set the level of smoothness. 0 gives a very smooth image

| Usage                  |   |
|------------------------|--:|
| Smooth `&f=smooth,0` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=smooth,0 alt=''> | 
| Some smothness `&f=smooth,10` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=smooth,10 alt=''> | 

This filter applies a 9-cell convolution matrix where center pixel has the weight *arg1* and others weight of 1.0. Using negative values can produce some effects.

| Usage                  |   |
|------------------------|--:|
| Make it unfocused `&f=smooth,-5` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=smooth,-5 alt=''> | 
| Show me the edges `&f=smooth,-7` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=smooth,-7 alt=''> | 
| Make it look sharper `&f=smooth,-10` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=smooth,-10 alt=''> | 



Filter Pixelate {#pixelate}
---------------------------------------------

This filter applies pixelation effect to the image, use *arg1* to set the block size in pixels and *arg2* to set the pixelation effect mode, whether to use advanced pixelation effect or not (defaults to FALSE). 

| Usage                  |   |
|------------------------|--:|
| `&f=pixelate,4,0` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=pixelate,4,0 alt=''> | 
| `&f=pixelate,4,1` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=pixelate,4,1 alt=''> | 



Combine filters {#combine}
---------------------------------------------

You can combine up to eleven filters by naming them f, f0-f9.

| Usage                  |   |
|------------------------|--:|
| Make it grayscale and lighter.<br>`&f=grayscale&f0=brightness,40` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=grayscale&f0=brightness,40 alt=''> | 
| Make it grayscale, lighter and enhance contrast.<br>`&f=grayscale&f0=brightness,40`<br>`&f1=contrast,-20` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=grayscale&f0=brightness,40&f1=contrast,-20 alt=''> | 
| Make it grayscale, lighter, enhance contrast & sharpen it.<br>`&f=grayscale&f0=brightness,40`<br>`&f1=contrast,-20&sharpen` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=grayscale&f0=brightness,40&f1=contrast,-20&sharpen alt=''> | 
| Make it sepia, a bit old.<br>`&f=grayscale&f0=brightness,-10`<br>`&f1=contrast,-20`<br>`&f2=colorize,120,60,0,0&sharpen` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&f=grayscale&f0=brightness,-10&f1=contrast,-20&f2=colorize,120,60,0,0&sharpen alt=''> | 

You can greatly enhance the perceived quality of the image by selecting a good combination of filters.
