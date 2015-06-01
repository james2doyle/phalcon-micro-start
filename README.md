# phalcon-micro-start

A more practical example of the start of a Phalcon micro application.

## Installation

You may need to [set the directory index](https://github.com/james2doyle/phalcon-micro-start/blob/master/.htaccess#L2) for the app before you begin. If you are using a database, make sure [the settings](https://github.com/james2doyle/phalcon-micro-start/blob/master/app/config/config.php#L6-L10) are correct, also be sure you update the [baseUri](https://github.com/james2doyle/phalcon-micro-start/blob/master/app/config/config.php#L18) for the app.

#### Permissions

Make sure the cache folder is writable with `chmod -R 755 app/cache`, run from the root directory.

## What's Included?

* Basic page example
* Partial views (`Simple` view engine)
* URL with params
* JSON return
* Cached view
* Redirect URL

### Other Niceness

* Grunt with `watch` task
