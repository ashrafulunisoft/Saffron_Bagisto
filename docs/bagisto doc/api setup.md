┌──(ashraful㉿kali)-[~/UniSoft Ltd/Backend/saffron-backend-3]
└─$ composer require bagisto/rest-api
./composer.json has been updated
Running composer update bagisto/rest-api
Loading composer repositories with package information
Updating dependencies
Lock file operations: 6 installs, 0 updates, 0 removals
  - Locking bagisto/rest-api (v2.3.1)
  - Locking darkaonline/l5-swagger (8.6.5)
  - Locking doctrine/annotations (2.0.2)
  - Locking swagger-api/swagger-ui (v5.31.0)
  - Locking symfony/yaml (v7.4.1)
  - Locking zircote/swagger-php (4.11.1)
Writing lock file
Installing dependencies from lock file (including require-dev)
Package operations: 6 installs, 0 updates, 0 removals
  - Downloading zircote/swagger-php (4.11.1)
  - Downloading swagger-api/swagger-ui (v5.31.0)
  - Downloading doctrine/annotations (2.0.2)
  - Downloading darkaonline/l5-swagger (8.6.5)
  - Downloading bagisto/rest-api (v2.3.1)
  - Installing symfony/yaml (v7.4.1): Extracting archive
  - Installing zircote/swagger-php (4.11.1): Extracting archive
  - Installing swagger-api/swagger-ui (v5.31.0): Extracting archive
  - Installing doctrine/annotations (2.0.2): Extracting archive
  - Installing darkaonline/l5-swagger (8.6.5): Extracting archive
  - Installing bagisto/rest-api (v2.3.1): Extracting archive
Package doctrine/annotations is abandoned, you should avoid using it. No replacement was suggested.
Package paypal/paypal-checkout-sdk is abandoned, you should avoid using it. Use paypal/paypal-server-sdk instead.
Generating optimized autoload files
> Illuminate\Foundation\ComposerScripts::postAutoloadDump
Deprecation Notice: Opis\Closure\unserialize(): Implicitly marking parameter $options as nullable is deprecated, the explicit nullable type must be used instead in /home/ashraful/UniSoft Ltd/Backend/saffron-backend-3/vendor/opis/closure/functions.php:32
> @php artisan package:discover --ansi

   INFO  Discovering packages.  

  astrotomic/laravel-translatable ............................................................................................................. DONE
  bagisto/laravel-datafaker ................................................................................................................... DONE
  bagisto/rest-api ............................................................................................................................ DONE
  barryvdh/laravel-debugbar ................................................................................................................... DONE
  barryvdh/laravel-dompdf ..................................................................................................................... DONE
  darkaonline/l5-swagger ...................................................................................................................... DONE
  diglactic/laravel-breadcrumbs ............................................................................................................... DONE
  kalnoy/nestedset ............................................................................................................................ DONE
  konekt/concord .............................................................................................................................. DONE
  konekt/enum-eloquent ........................................................................................................................ DONE
  laravel/octane .............................................................................................................................. DONE
  laravel/sanctum ............................................................................................................................. DONE
  laravel/tinker .............................................................................................................................. DONE
  laravel/ui .................................................................................................................................. DONE
  maatwebsite/excel ........................................................................................................................... DONE
  nesbot/carbon ............................................................................................................................... DONE
  nunomaduro/collision ........................................................................................................................ DONE
  nunomaduro/termwind ......................................................................................................................... DONE
  openai-php/laravel .......................................................................................................................... DONE
  pestphp/pest-plugin-laravel ................................................................................................................. DONE
  prettus/l5-repository ....................................................................................................................... DONE
  spatie/laravel-responsecache ................................................................................................................ DONE
  spatie/laravel-sitemap ...................................................................................................................... DONE
  stevebauman/purify .......................................................................................................................... DONE

115 packages you are using are looking for funding.
Use the `composer fund` command to find out more!
No security vulnerability advisories found.
Using version ^2.3 for bagisto/rest-api
                                                                                                                                                                                                              
┌──(ashraful㉿kali)-[~/UniSoft Ltd/Backend/saffron-backend-3]
└─$ php artisan bagisto-rest-api:install
Step: Publishing L5Swagger Provider File...

   INFO  Publishing [bagisto-rest-api-swagger] assets.  

  Copying file [vendor/bagisto/rest-api/src/Config/l5-swagger.php] to [config/l5-swagger.php] ................................................. DONE


Step: Generate l5-swagger docs (Admin & Shop)...
Regenerating docs default
Regenerating docs admin

-----------------------------
Success: Bagisto REST API has been configured successfully.
