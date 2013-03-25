# Imbo module for Zend Framework 2
This module introduces an [Imbo client](https://github.com/imbo/imboclient-php) service, and a view helper for creating Imbo image URLs in Zend Framework 2 applications.

[![Build Status](https://travis-ci.org/imbo/imbo-zf2-module.png?branch=develop)](https://travis-ci.org/imbo/imbo-zf2-module)

## Installation
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

## Configuration
The module has some configuration options that you will need to set, and all options are under the `imboModule` key in the configuration array.

### Client configuration
To configure the ImboClient instance you need to specify one or more hosts, a public and private key pair, and driver configuration:

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
        // ...
    ),
    // ...
);
```

### View helper transformation presets
The view helper supports presets specified in the configuration array if you want easier access to custom transformation chains:

```php
use ImboClient\Url\Image as ImageUrl;

return array(
    'imboModule' => array(
        'viewHelperPresets' => array(
            'graythumb' => function(ImageUrl $url) {
                return $url->thumbnail()->desaturate();
            },
        ),
        // ...
    ),
    // ...
);
```

See below on how to trigger these presets in your view scripts.

## Usage
### Client service
The service is simply called `ImboClient` and can be fetched from the main service manager. The following code is how the view helper fetches the client:

```php
<?php
namespace Imbo\ServiceFactory;

use Imbo\View\Helper\ImboUrl,
    Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class ImboUrlViewHelperFactory implements FactoryInterface {
    public function createService(ServiceLocatorInterface $serviceLocator) {
        // Fetch the main service manager
        $serviceManager = $serviceLocator->getServiceLocator();

        return new ImboUrl(
            $serviceManager->get('ImboClient'),
            $serviceManager->get('config')['imboModule']['viewHelperPresets']
        );
    }
}
```
### View helper
The view helper can be used in your view scripts like this:

```php
<img src="<?= $this->imboUrl('imageid')->thumbnail() ?>">
```

For a complete list of available transformations, see the [client implementation](https://github.com/imbo/imboclient-php#image-urls).

#### Transformation presets
Transformation presets specified in the configuration can be referred to in the view scripts by specifying a second parameter to the view helper:

```php
<img src="<?= $this->imboUrl('imageid', 'preset') ?>">
```

See how to configure transformation presets in the configuration section above.
