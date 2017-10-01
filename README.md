cm-address
==========

common module :: Address Management Module (Frenzel GmbH 2017) v.1.0.4

Allows you to add addresses to a model by your choice. You can define wheater it's a main address or not.

@author <philipp@frenzel.net> Philipp Frenzel

Installation
============

Add the following line to your composer.json require section:

```
"frenzelgmbh/cm-address":"*",
```

```
php yii migrate --migrationPath=@vendor/frenzelgmbh/cm-address/migrations
```

Inside your yii-config, pls. add the following lines to your modules section. As you
might see, the gridview needs to be implemented too.
```
'address'=>[
  'class' => 'net\frenzel\address\Module',
  'userIdentityClass' => 'app\models\User', //points to your user identity class
],
```

Design
======

The Address module is use to store address/location informations, that can be linked to any other "module".
So in general all modules are referenced by:

* entity (which should hold the table name VARCHAR(100))
* entity_id (which should hold the primarey key of the referenced record INTEGER(11))

Works by passing over the model to the widget!

Geolocation
===========

The module tries to enrich each passed over address with the latitude and longitude, which will be looked
up by combining street, address and state information.

Widgets
=======

Address Management Widget:

```php
<?= \net\frenzel\address\views\widgets\Addresses::widget(['model'=> $model]) ?>
```

Renders a Map with all related address points related to the model:

```php
<?= \net\frenzel\address\views\widgets\MapWidget::widget(['model'=> $model]) ?>
```
