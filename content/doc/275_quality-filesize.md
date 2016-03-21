Quality and file size
===============================

[FIGURE src=/image/example/kodim07.png&w=w2&save-as=jpg&sharpen&q=40&a=30,0,40,0 caption="A flower."]

The file size for images should be small, as small can be. But file size is related to the quality of the image. Lesser file size means lesser quality. Too low quality means that the user gets to see low-quality images which leaves a bad impression of the website. But having the greatest images means large file size which means that the web page till increase its load time. So, one need to have a balance of good enough images and their file size. This is not always easy to achieve, but lets review some basics for quality and file size aspect, basics that will take you a long way.


Image format basics
----------------------------------

The different image formats JPEG, PNG and GIF have each its pros and cons. To understand image processing one need to know the basics on these file formats.

| File format | Characteristics | Guidelines |
|-------------|-----------------|------------|
| GIF         | 8 bits per pixel, max 256 color. Supports animated images and transparency. | Use for logos or image with solid areas of colors. |
| JPEG        | 16.7 million colors. Lossy compression meaning image looses information when saving it. | Use for photos and paintings or computer screen shots. |
| PNG         | 8-bit, 24-bit and 32-bit per pixel including transparency, semi-transparency and lossless compression. | For computer generated graphics, drawings, images and screen shots. |

As a basic rule of thumb, use JPEG for photo-ish images and PNG for computer generated images and screenshots.

Photo images are easy to resize but computer generated images, vector graphics and screenshots should not be resized.



Change image format
----------------------------------

[FIGURE src=/image/example/kodim23.png?w=c8&save-as=jpg&sharpen&q=75&a=25,20,20,10 caption="Birds." class="right"]

It is possible to change the target file format. Here are some examples when changing file format using [kodim23.png](/image/example/kodim23.png) as base. 

The original image is 768 x 512 pixels with 72 079 colors and a weight of 534KB.

| What                     | Colors | File size | The image |
|--------------------------|-------:|----------:|-----------|
| Original as PNG 24-bit and resized. `?src=kodim23.png&w=300` | 43 272  | 89KB     | <img src=/image/example/kodim23.png&w=300 alt=''> |
| Save as JPEG. `?src=kodim23.png&w=300&save-as=jpg` | 43 272  | 7KB     | <img src=/image/example/kodim23.png&w=300&save-as=jpg alt=''> |
| Save as GIF. `?src=kodim23.png&w=300&save-as=gif` | 256  | 32KB     | <img src=/image/example/kodim23.png&w=300&save-as=gif alt=''> |
| Save as PNG 8-bit. `?src=kodim23.png&w=300&palette` | 157  | 19KB     | <img src=/image/example/kodim23.png&w=300&palette alt=''> |

The parameter `save-as` can be used to save the target image as jpg, png or gif. Using the parameter `palette` reduces the number of colors to max 256 colors. GIF and PNG 8-bit images can have max 256 colors.



Save as JPEG with decent quality {#jpeg}
----------------------------------

Lets take the flower-image belov as an example. Does the image look decent enough?

**`img.php?src=kodim07.png&w=630&save-as=jpg&sharpen&q=40`**

[FIGURE src=/image/example/kodim07.png&w=w2&save-as=jpg&sharpen&q=40 caption="Flowers, kodimg07.png, from The Kodak Colorset. Good image and small filesize (26KB)."]

The original image is saved in PNG-format, 768 x 512 pixels and a file size (weight) of 557KB. Its a pretty heavy image. The above image is rescaled to a width of 630 pixels, saved in JPEG with a quality of 40. It is sharpened to reduce the fuzziness introduced in the resizing process. This all together reduces the file size to 26KB. That is a reduction to 5% of the original file size and a much more pleasant file size to download. Does it look good enough? Well, that will always depend on what you think, if its not good enough then increase the quality setting (and the file size) until you think its "good enough".

Lets see, part by part, how the file size decreases for each step in the way.

| Action   | File size | % |
|----------|----------:|--:|
| `?src=kodim07.png` | 557KB | 100% |
| `?src=kodim07.png&w=630` | 358KB | 64% |
| `?src=kodim07.png&w=630&save-as=jpg` | 29KB | 5% |
| `?src=kodim07.png&w=630&save-as=jpg&q=40` | 22KB | 4% |
| `?src=kodim07.png&w=630&save-as=jpg&q=40&sharpen` | 26KB | 5% |

The largest decrease in file size, is when saving the image as JPEG. Changing the quality does not change the file size that much, the default quality is 60, so decreasing to 40 did some, but it also affects the visible quality of the image. Adding the sharpening filter increases the file size a small bit, but that action enhances the visible quality of the image and makes it sharper. 

You can see why a web developer need to be able to manage the file size and image quality? Good web pages load fast and the file size of the images are an important factor.



Default level of quality is configurable {#default}
---------------------------------------

There are default settings for JPEG quality and PNG compression. Thes can be overridden through configuration.

This is the default configuration.

```php
/**
 * Change the default values for CImage quality and compression used
 * when saving images.
 *
 * Default value:
 *  jpg_quality:     null, integer between 0-100, 
 *                         default is 60
 *  png_compression: null, integer between 0-9,
 *                         default is -1 (PHP GD decides)
 */
 //'jpg_quality'  => 60,
 //'png_compression' => -1,
```
