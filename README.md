cm-address
==========

Common Address Module (Frenzel GmbH 2014) v.0.1

Installation
============

Add the following line to your composer.json require section:

```
"frenzelgmbh/cm-address":"*"
```

```
php yii migrate --migrationPath=@vendor/frenzelgmbh/cm-address/migrations
```

Design
======

The Address module is use to store address/location informations, that can be linked to any other "module".
So in general all modules are referenced by:

* mod_table (which should hold the table name VARCHAR(100))
* mod_id    (which should hold the primarey key of the referenced record INTEGER(11))

Geolocation
===========

The module tries to enrich each passed over address with the latitude and longitude, which will be looked
up by combining street, address and state information.
