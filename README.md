cm-address
==========

Common Address Module

Design
======

The Address module is use to store address/location informations, that can be linked to any other "module".
So in general all modules are referenced by:

* mod_table (which should hold the table name VARCHAR(100))
* mod_id    (which should hold the primarey key of the referenced record INTEGER(11))
