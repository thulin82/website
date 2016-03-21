Scale before processing
===================================

If you want the target image to be a percentage of its original size, then use `width=50%` or `height=50%`, or both. The parameter `scale` is however a different story.

The parameter `scale` is used to scale the original image as a first step in processing the image. Applying `scale=25%` will reduce the image before processing. This can produce some nice effects, or none, depending on what happens next.

This is how you use the `scale` option.

| What         | Parameters          | The image           |
|--------------|---------------------|---------------------|
| Original     | `&w=300`            | <img src=/image/example/kodim13.png&sa=jpg&w=300 alt=''> |
| Downsize to 10% | `&w=300&scale=10`  | <img src=/image/example/kodim13.png&sa=jpg&w=300&scale=10 alt=''> |
| Downsize to 5% | `&w=300&scale=5`   | <img src=/image/example/kodim13.png&sa=jpg&w=300&scale=5 alt=''> |

In both cases, the scaling is done as the first step in processing. In all cases the final image will have a width of 300px, so the scale parameter only affects the source image used prior resizing.
