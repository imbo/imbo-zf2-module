# Imbo module for Zend Framework 2
This module introduces an [Imbo client](https://github.com/imbo/imboclient-php) service, and a view helper for creating Imbo image URLs in Zend Framework 2 applications.

[![Build Status](https://travis-ci.org/imbo/imbo-zf2-module.png)](https://travis-ci.org/imbo/imbo-zf2-module)

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
To configure the ImboClient instance you need to specify one or more hosts, a user and a public/private key pair:

```php
return array(
    'imboModule' => array(
        'imboClient' => array(
            'host' => 'http://imboserver',
            // or 'host' => array('http://imboserver1', 'http://imboserver2'),
            'user' => 'some-user',
            'publicKey' => 'somepublickey',
            'privateKey' => 'someprivatekey',
        ),
        // ...
    ),
    // ...
);
```

### View helper transformation presets
The view helper supports presets specified in the configuration array if you want easier access to custom transformation chains:

```php
return array(
    'imboModule' => array(
        'viewHelperPresets' => array(
            'graythumb' => function(ImboClient\Http\ImageUrl $url) {
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
### Injection via the initializer
The module ships with a controller initializer that looks for controllers that implement the ``Imbo\Service\ImboClientAwareInterface`` interface. Whenever such a controller is found, the ``setImboClient()`` method will be called with an instance of ``ImboClient\ImboClient``, fetched from the service manager. The interface also defines a ``getImboClient()`` method that whould return the client instance.

The module also includes a trait that implements both these methods, so if you have a controller that needs access to an Imbo client, you will only need to add a couple of lines:

```php
<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Imbo\Service\ImboClientAwareInterface,
    Imbo\Service\ImboClientAware;

class IndexController extends AbstractActionController implements ImboClientAwareInterface {
    use ImboClientAware;

    public function indexAction() {
        $client = $this->getImboClient();

        // ...
    }
}
```

All you need to do is have your controller implement the interface and ``use`` the [trait](http://php.net/traits), and Zend Framework will automatically inject the Imbo client for you.

### Client service
The service is simply called `ImboClient` and can be fetched from the main service manager.

### View helper
The view helper can be used in your view scripts like this:

```php
<img src="<?= $this->imboUrl('imageid')->thumbnail() ?>">
```

For a complete list of available transformations, see the [client documentation](http://imboclient-php.readthedocs.org/).

#### Transformation presets
Transformation presets specified in the configuration can be referred to in the view scripts by specifying a second parameter to the view helper:

```php
<img src="<?= $this->imboUrl('imageid', 'preset') ?>">
```

See how to configure transformation presets in the configuration section above.
