Rotate images
==============================

This is how you can rotate the image.



Auto rotate based on EXIF {#exif}
------------------------------

Some smartphones uses EXIF-information to let applications know how the image is rotated. This is in general handled by image processing tools. But if you, for example, take a image with your iPhone and email the image to yourself and then adds it to your website, then it will not adhere to the EXIF-information. Let us see how it works.

You need the [EXIF extension](http://php.net/manual/en/book.exif.php) to support [auto-rotation of JPEG-images](doc/auto-rotate). 

| Usage                  |   |
|------------------------|--:|
| Image taken with iPhone.<br>`&w=300` | <img src=/image/example/issue36/me-270.jpg&w=300 alt=''> | 
| Same image but auto rotated using EXIF.<br>`&w=300&aro` | <img src=/image/example/issue36/me-270.jpg&w=300&aro alt=''> | 



Rotate based on angle {#angle}
------------------------------

If you need to rotate the image, you do so by adding the angle to rotate. This is how you use the same source image as above, and rotate it "by hand" to make it look okey.

| Usage                  |   |
|------------------------|--:|
| Image from iPhoto, rotated -90°.<br>`&w=200&r=-90` | <img src=/image/example/issue36/me-270.jpg&w=200&r=-90 alt=''> | 
| Image from iPhoto, rotated 0°.<br>`&w=200&r=0` | <img src=/image/example/issue36/me-270.jpg&w=200&r=0 alt=''> | 
| Image from iPhoto, rotated 90°.<br>`&w=200&r=90` | <img src=/image/example/issue36/me-270.jpg&w=200&r=90 alt=''> | 
| Image from iPhoto, rotated 180°.<br>`&w=200&r=180` | <img src=/image/example/issue36/me-270.jpg&w=200&r=180 alt=''> | 
| Image from iPhoto, rotated 270°.<br>`&w=200&r=270` | <img src=/image/example/issue36/me-270.jpg&w=200&r=270 alt=''> | 



Rotate before or after processing? {#beforeafter}
------------------------------

Hmmm, in the example above, you got two different results on the resulting image dimension. Why? Well, `aro, auto-rotate` rotates the source image before its resized and `r, rotate` rotates the image after its resized.

The difference can be spelled out as this.

1. *Before*. Take the image, rotate it, then give it its final dimensions which makes some sense with respect to the width and height you are expecting.
2. *After*. Take the image, resize it and then rotate the image. The target size you expect is there, but inverted - you get a portrait image and turn it to a landscape image and width and height are swapped.

| Rotate before or after resizing  |   |
|----------------------------------|---|
| Rotate before, final dimension as expected (same as `auto-rotate`).<br>`&w=100&h=200&rb=-90` | Rotate after, *expected* dimensions are inverted, width becomes height and height becomes width.<br>`&w=100&h=200&ra=-90` |
| <img src=/image/example/issue36/me-270.jpg&w=100&h=200&cf&rb=-90 alt=''> | <img src=/image/example/issue36/me-270.jpg&w=100&h=200&cf&ra=-90 alt=''> | 

So, normally this makes sense, but if you get in trouble, remember that rotate before, or after, processing and resizing, gives different results.



Rotate non perpendicular angle {#perpendicular}
------------------------------

If you rotate the image in a non perpendicular angle you need to fill the background with a color. You control what color to use with `bgc, bg-color`.

| Rotate and fill remaining space  |   |
|----------------------------------|---|
| Use auto rotation to get it right in the first place.<br>`&w=100&aro` | <img src=/image/example/issue36/me-270.jpg&w=100&aro alt=''> | 
| Rotate 15 degrees, before processing. Resulting image keeps its dimensions,<br>`&w=100&aro&rb=15` | <img src=/image/example/issue36/me-270.jpg&w=100&aro&rb=15 alt=''> | 
| Rotate 15 degrees, after processing. Resulting image gets unknown dimensions.<br>`&w=100&aro&ra=15` | <img src=/image/example/issue36/me-270.jpg&w=100&aro&ra=15 alt=''> | 
| Rotate 15 degrees, after processing. Use `bgc, bg-color` to select the background color.<br>`&w=100&aro&ra=15&bgc=cccccc` | <img src=/image/example/issue36/me-270.jpg&w=100&aro&ra=15&bgc=cccccc alt=''> | 
| Rotate 15 degrees, after processing. Combine with `a, area` to get only a part of the image and `height` together with `crop-to-fit` to make it all fit in a box of 100x100px.<br>`&w=100&aro&ra=15&a=20,30,40,20` | <img src=/image/example/issue36/me-270.jpg&w=100&h=100&cf&aro&rb=15&a=20,30,40,20 alt=''> | 
