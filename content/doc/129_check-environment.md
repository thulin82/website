Check environment
======================================

There are two helpers that aid in checking your environment. One is a script `webroot/check_environment.php` and one requires that you have Cimage installed.

This is mainly used for troubleshooting.



Check using `check_environment.php`
---------------------------------------

There is a script `webroot/check_environment.php` that you can use to check details of your installed system. 

This is a sample output from the script.

```text
Current PHP version: 5.5.11

Running on: Apache/2.4.9 (Unix) PHP/5.5.11 OpenSSL/1.0.1g mod_perl/2.0.8-dev Perl/v5.16.3

Extension gd is loaded.
array(12) {
  ["GD Version"]=>
  string(26) "bundled (2.1.0 compatible)"
  ["FreeType Support"]=>
  bool(true)
  ["FreeType Linkage"]=>
  string(13) "with freetype"
  ["T1Lib Support"]=>
  bool(false)
  ["GIF Read Support"]=>
  bool(true)
  ["GIF Create Support"]=>
  bool(true)
  ["JPEG Support"]=>
  bool(true)
  ["PNG Support"]=>
  bool(true)
  ["WBMP Support"]=>
  bool(true)
  ["XPM Support"]=>
  bool(false)
  ["XBM Support"]=>
  bool(true)
  ["JIS-mapped Japanese Font Support"]=>
  bool(false)
}
Extension exif is loaded.
Extension curl is loaded.
```



Check using `&status`
---------------------------------------

There is a option `&status` to make img.php check its environment. Use it like this.

```
img.php?status
```

The output looks like this.

```
img.php version = v0.7.6* (2015-10-18)
PHP version = 5.6.13-2
Running on: Apache/2.4.16 (Debian)
Allow remote images = 
Cache writable = 1
Cache dummy writable = 1
Alias path writable = 
Extension exif is  loaded.
Extension curl is  loaded.
Extension gd is  loaded.
Array
(
    [GD Version] => 2.1.1
    [FreeType Support] => 1
    [FreeType Linkage] => with freetype
    [T1Lib Support] => 
    [GIF Read Support] => 1
    [GIF Create Support] => 1
    [JPEG Support] => 1
    [PNG Support] => 1
    [WBMP Support] => 1
    [XPM Support] => 1
    [XBM Support] => 1
    [WebP Support] => 1
    [JIS-mapped Japanese Font Support] => 
)
```

This option is only available in [development mode](config-file#mode).
