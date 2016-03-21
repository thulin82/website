Use case
==============================

Lets review some use cases to see when and how CImage might be useful.



Make a thumbnail {#thumbnail}
-------------------------------

[FIGURE class="right" src="/image/example/kodim04.png&w=80&h=80&cf" caption="A thumbnail of 80x80 pixels." nolink]

You have a larger image and you want to make a smaller thumbnail of it with a size of 80x80 pixels. You simply take the image and add constraints on `width`, `height` and you use the resize strategy `crop-to-fit` to crop out the parts of the image that does not fit.

To produce such a thumbnail, create a link like this:

> `img.php?src=kodim04.png&width=80&height=80&crop-to-fit`



Slightly complexer use case {#usecase-complex}
-------------------------------

Perhaps you got an image from a friend. The image was taken with the iPhone and thus rotated. 

[FIGURE class="right" src="/image/example/issue36/me-270.jpg&w=250" caption="Me from the iPhone." nolink]

The original image is looking like this one, scaled down to a width of 250 pixels. 

So, you need to rotate it and crop off some parts to make it more interesting. 

To show it off, I'll auto-rotate the image based on its EXIF-information, I will crop it to a thumbnail of 100x100 pixels and add a filter to make it greyscale finishing up with a sharpen effect. Just for the show I'll rotate the image 25 degrees - do not ask me why.

This is how the magic looks like. 

> `img.php?src=issue36/me-270.jpg&w=100&h=100&cf&aro`
> `&rb=-25&a=8,30,30,38&f=grayscale&convolve=sharpen-alt`

[FIGURE src="/image/example/issue36/me-270.jpg&w=100&h=100&cf&aro&rb=-25&a=8,30,30,38&f=grayscale&convolve=sharpen-alt" caption="Me as a thumbnail." nolink]

For myself, I use `img.php` to put up all images on my website, it gives me the power of affecting the resulting images - without opening up a photo editing application.



Strategy to use images for web publication
-------------------------------

I have a basic strategy when using images for web publication. I start with an original image which, is decent enough to show on its own. It has a image dimension of, lets say as an example, around 1200 x 1200 pixels. It has a good enough quality and a file size that is not to large to make the user annoyed when downloading and display it. This is my original image and all other images are based on this. They are rescaled and filtered, cropped and reduced in file size, and so on. One original image from which all the other images are descendants. 

This is the basic strategy that I'm using and this strategy is the driving force behind the requirements for CImage.
