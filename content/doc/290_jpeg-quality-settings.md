JPEG quality settings
==============================

The compression algorithm for JPEG has a quality setting which defines the level of compression to be done. The larger compression results in smaller file size. The quality shall be between 1 (low quality, small file size) to 100 (high quality, large file size). 



Example on using quality settings {#quality}
-------------------------------

Here is an example on how the quality settings affect the file size and the visible image.

The measurements in the example is based on `?src=kodim23.png&save-as=jpg`. The original image is PNG and weights 820KB. The image is resized to `&w=300` to make it fit in the table and to give you a hint of the visible change while using the option for `q`.

| What     | Quality | File size | The image |
|----------|--------:|----------:|----------:|
| `&q=100` | 100     | 354KB     | <img src=/image/example/kodim23.png&w=300&save-as=jpg&q=100 alt=''> |
| `&q=90`  | 90      | 100KB     | <img src=/image/example/kodim23.png&w=300&save-as=jpg&q=90 alt=''> |
| `&q=80`  | 80      | 63KB      | <img src=/image/example/kodim23.png&w=300&save-as=jpg&q=80 alt=''> |
| `&q=70`  | 70      | 49KB      | <img src=/image/example/kodim23.png&w=300&save-as=jpg&q=70 alt=''> |
| `&q=60`  | 60      | 41KB      | <img src=/image/example/kodim23.png&w=300&save-as=jpg&q=60 alt=''> |
| `&q=30`  | 30      | 26BK      | <img src=/image/example/kodim23.png&w=300&save-as=jpg&q=30 alt=''> |
| `&q=10`  | 10      | 15KB      | <img src=/image/example/kodim23.png&w=300&save-as=jpg&q=10 alt=''> |
| `&q=1`   | 1       | 10KB     | <img src=/image/example/kodim23.png&w=300&save-as=jpg&q=1 alt=''> |

The default value for `q` is 60, its perhaps rather low to start with. 

[Post processing](post-processing) of the JPEG image, using an external tool, can further decrease the file size.
