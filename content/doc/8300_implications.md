Implications and considerations
====================================

Here are some general thoughts when applying CImage on a live system.



Select the proper mode {#mode}
-------------------------------------

Select the proper mode by setting it to "strict" or "production" to prevent outsiders from getting information about your system. Use only "development" for internal use since its quite verbose in its nature of error reporting. 



Put the installation directory outside web root {#outside}
-------------------------------------

Edit the config file to put the installation directory -- and the cache directory -- outside of the web root. This is best practice. The only thing needed in the web root is `img.php` and `img_config.php` (if used). These can be placed, for example, in `/img/img.php`, `/img.php` or in a directory `/cimage/img.php`.

Use [friendly urls](friendly-urls) to point out your script.



Monitor cache size {#moncache}
-------------------------------------

There is a utility `bin/cache.bash` included to monitor the size of the cache-directory. It generates an output like this.

```bash
$ ./cache.bash
Usage: ./cache.bash [cache-dir]   

$ ./cache.bash cache                         
Total size:       27M                                            
Number of files:  225                                            
                                                                 
Top-5 largest files:                                             
1032    cache/_._kodim08_768_512_q60convolvesharpen.png          
960     cache/_._kodim08_768_512_q60convolveemboss.png           
932     cache/_._kodim08_768_512_q60_rb45.png                    
932     cache/_._kodim08_768_512_q60_ra45.png                    
856     cache/_._kodim08_768_512_q60_rb90.png                    
                                                                 
Last-5 created files:                                            
2014-11-26 16:51 cache/_._kodim08_768_512_q60convolvelighten.png 
2014-11-26 16:51 cache/_._kodim08_768_512_q60convolveblur.png    
2014-11-26 16:48 cache/_._kodim08_400_267_q60convolvesharpen.png 
2014-11-26 16:48 cache/_._kodim08_400_267_q60convolvelighten.png 
2014-11-26 16:48 cache/_._kodim08_400_267_q60convolveemboss.png  
                                                                 
Last-5 accessed files:                                           
2014-11-27 16:12 _._wider_900_581_q60.jpg                        
2014-11-27 16:12 _._wider_750_484_q60.jpg                        
2014-11-27 16:12 _._wider_640_413_q60.jpg                        
2014-11-27 16:12 _._wider_640_200_c640-200-0-100_q60.jpg         
2014-11-27 16:12 _._wider_600_387_q60.jpg                        
```

Use it as a base if you feel the need to monitor the size of the cache-directory. Perhaps modify the script and execute it regularly using crontab.



Read-only cache {#readonlycache}
-------------------------------------

The cache directory need to be writable for `img.php` to create new files. But its possible to first create all cache-files and then set the directory to be read-only. This will give you a way of preventing `img.php` from creating new cache files. It will continue to work for all images having a cached version, but will fail if someone tries to create a new, not previously cached, version of the image.



Allowing remote download of images {#remote}
-------------------------------------

You can allow `img.php` to download remote images. That can be enabled in the config-file. However, before doing so, consider the implications on allowing anyone to download a file, hopefully an image, to your server and then the possibility to access it through your web server.

That sounds scary. It should.

For my own sake I will use it like this, since I consider it a most useful feature.

* Create a special version of `img.php` that has remote download allowed, hide it from public usage.
* Always use a password.
* Download and process the image and save it as an `alias`.
* Integrate the image into my web page and use the image in the alias directory.

This is an easy way to quickly download a remote image, process and share it.

So, its a scary feature and I might regret I did put it in. Still, its disabled by default and you enable it on your own risk. I have tried to make it as secure as I can, but I might have missed something. I will run it on my own system so I guess I'll find out how secure it is.
