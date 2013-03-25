Imbo module for Zend Framework 2
================================
This module introduces an [Imbo client](https://github.com/imbo/imboclient-php) service, and a view helper for creating Imbo image URLs.

[![Build Status](https://travis-ci.org/imbo/imbo-zf2-module.png?branch=develop)](https://travis-ci.org/imbo/imbo-zf2-module)

Installation
------------
Add `imbo/imbo-zf2-module` to your `composer.json` file, and enable the module in your `application.config.php` file:

```php
<?php
return array(
    'modules' => array(
        'Imbo',
        // ...
    ),
    // ...
);
```

Usage
-----
The service is simply called `ImboClient` and can be fetched from the main service manager. The following code is how the view helper fetches the client:

```php
<?php
namespace Imbo\ServiceFactory;

use Imbo\View\Helper\ImboUrl,
    Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class ImboUrlViewHelperFactory implements FactoryInterface {
    public function createService(ServiceLocatorInterface $serviceLocator) {
        return new ImboUrl($serviceLocator->getServiceLocator()->get('ImboClient'));
    }
}
```

The view helper can be used in your view scripts like this:

```php
<img src="<?= $this->imboUrl('imageid')->thumbnail() ?>">
```

For a complete list of available transformations, see the [client implementation](https://github.com/imbo/imboclient-php#image-urls).

Configuration
-------------
The module has some configuration options that you will need to set, and all options are under the `imboModule` key in the configuration array.

```php
return array(
    'imboModule' => array(
        'imboClient' => array(
            'host' => '',
            'publicKey' => '',
            'privateKey' => '',
            'driver' => array(
                'timeout' => 2,
                'connectTimeout' => 2,
            ),
        ),
    ),
);
```

`host` can be a string or an array of strings containing host names for your Imbo server(s). `publicKey` and `privateKey` is the public and private key pair you want to use. The options under the `driver` key (`timeout` and `connectTimeout`) can be used to specify custom timeouts.

Example:

```php
return array(
    'imboModule' => array(
        'imboClient' => array(
            'host' => 'http://imboserver',
            // or 'host' => array('http://imboserver1', 'http://imboserver2'),
            'publicKey' => 'somepublickey',
            'privateKey' => 'someprivatekey',
            'driver' => array(
                'timeout' => 13,
                'connectTimeout' => 49,
            ),
        ),
    ),
);
```
