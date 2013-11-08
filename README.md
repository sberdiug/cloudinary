cloudinary
==========

Yii Extension for Cloudinary CDN Library Wrapper


## Setup & Configuration

Open `config/main.php` and add cloudinary:

```php
    ...
    // application components
    'components'=>array(
        'cloudinary' => array(
            'class' => 'ext.cloudinary.ECloudinary',
            'cloud_name' => '!!! your cloud_name here !!!',
            'api_key' => '!!! your api_key key here !!!',
            'api_secret' => '!!! and api_secret here !!!',
        ),
        ...
    ),
    ...
``

### Uploading to Cloudinary

Here I'm uploading an image to Cloudinary from SiteController/index method:

```php

class SiteController extends Controller {
    ...
    public function actionIndex() {
        $response =  Yii::app()->cloudinary->upload(Yii::getPathOfAlias('webroot').'/images/an-sample-image-to-upload-on-cloudinary.png');

        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index', array(
            'response' => $response,
        ));
    }
    ...
}

```

## Printing File information after successful upload from `index.php` view file

```php
<pre>
<?php
print_r($response);
?>
</pre>
```

**NOTE:** Not ready yet for production or even development application.
