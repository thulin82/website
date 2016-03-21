Create and use shortcuts
======================================

Like the example before, [creating a sepia effect](gdfilter#combine) using the options `&f=grayscale&f0=brightness,-10&f1=contrast,-20&f2=colorize,120,60,0,0&sharpen` can turn to be a bit large and hard to reuse. To ease using long lists of options you have the ability to create shortcuts by defining them in `img_config.php`.

This is how it looks in the default config file.

```php
/**
 * Create custom shortcuts for more advanced expressions.
 *
 * Default values.
 *  shortcut: [
 *      'sepia' => "&f=grayscale&f0=brightness,-10&f1=contrast,-20&f2=colorize,120,60,0,0&sharpen",
 *  ]
 */
 /*
'shortcut' => [
    'sepia' => "&f=grayscale&f0=brightness,-10&f1=contrast,-20&f2=colorize,120,60,0,0&sharpen",
],*/
```

This gives you one place of changing your favorite combination of options. You the use it like this, using the `shortcut, sc` option.

| Usage                  |   |
|------------------------|--:|
| Use the shortcut for the sepia effect.<br>`&sc=sepia` | <img src=/image/example/kodim24.png&w=300&save-as=jpg&sc=sepia alt=''> | 
