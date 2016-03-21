PNG compression levels
=================================

[FIGURE src=/image/example/kodim23.png&w=c8 caption="A PNG-image looks the same, no matter what algorithm is used to compress it." class="right"]

PNG has nine algorithms for compression, namely 0 (no compression) to 9. The default is to let the PHP GD implementation to choose the algorithm.

The levels are a mix of file size and time to compress / uncompress. The PNG format is lossless so the resulting image is always exactly the same. 

Use the option `co, compress` parameter to decide which PNG compression algorithm shall be used. Here is an example how the file size is affected for the different values.

This example is based on `?src=kodim23.png`.

| What     | Algorithm   | File size |
|----------|:-----------:|----------:|
| default  | PHP decides | 820KB     |
| `&co=1`  | 1           | 929KB     |
| `&co=2`  | 2           | 917KB     |
| `&co=3`  | 3           | 891KB     |
| `&co=4`  | 4           | 845KB     |
| `&co=5`  | 5           | 834KB     |
| `&co=6`  | 6           | 820KB     |
| `&co=7`  | 7           | 815KB     |
| `&co=8`  | 8           | 811KB     |
| `&co=9`  | 9           | 809KB     |

It differs 120KB (13%) in file size depending on which algorithm is used. The default setting makes a pretty good job.

Its notable that the original image size is actually 728KB. Processing and saving with PHP GD increases the file size, or, it does not do the best possible effort in compressing the image.

[Post processing](post-processing) of the PNG image, using an external tool, can further decrease the file size.
