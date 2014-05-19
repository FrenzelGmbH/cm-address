<?php

/**
 * The migration script for the addresses
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @copyright Frenzel GmbH
 * @version 1.0
 */

use yii\db\Schema;

class m130530_050429_addresstables extends \yii\db\Migration
{
	public function up()
	{
    
    switch (Yii::$app->db->driverName) {
      case 'mysql':
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        break;
      case 'pgsql':
        $tableOptions = null;
        break;
      default:
        throw new RuntimeException('Your database is not supported!');
    }

		$this->createTable('{{%address}}',[
      'id'                => Schema::TYPE_PK,
      'cityName'          => Schema::TYPE_STRING .'(100)',
      'zipCode'           => Schema::TYPE_STRING .'(20)',
      'postBox'           => Schema::TYPE_STRING .'(20)',
      'addresslineOne'    => Schema::TYPE_STRING .'(100)',
      'addresslineTwo'    => Schema::TYPE_STRING .'(100)',
      'regionName'        => Schema::TYPE_STRING .'(50)',
      //possible reference to user
      'user_id'           => Schema::TYPE_INTEGER.' NULL',
      //module fields
      'mod_table'         => Schema::TYPE_STRING .'(100)',
      'mod_id'            => Schema::TYPE_INTEGER.' NULL',
      //interface fields
      'system_key'        => Schema::TYPE_STRING .'(100)',
      'system_name'       => Schema::TYPE_STRING .'(100)',
      'system_upate'      => Schema::TYPE_INTEGER.' DEFAULT NULL',
      // timestamps
      'created_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'updated_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'deleted_at'        => Schema::TYPE_INTEGER . ' DEFAULT NULL',
      //Foreign Keys
      'country_id'        => Schema::TYPE_INTEGER,      
    ],$tableOptions);

    $this->addColumn('{{%address}}','latitude',Schema::TYPE_FLOAT .' DEFAULT 0.00');
    $this->addColumn('{{%address}}','longitude',Schema::TYPE_FLOAT .' DEFAULT 0.00');

    $this->createTable('{{%country}}',[
      'id'                => Schema::TYPE_PK,
      'iso2'              => Schema::TYPE_STRING .'(2)',
      'iso3'              => Schema::TYPE_STRING .'(3)',
      'name'              => Schema::TYPE_STRING .'(100)',
      //possible reference to user
      'user_id'           => Schema::TYPE_INTEGER.' NULL',
      //interface fields
      'system_key'        => Schema::TYPE_STRING .'(100)',
      'system_name'       => Schema::TYPE_STRING .'(100)',
      'system_upate'      => Schema::TYPE_INTEGER.' DEFAULT NULL',
      // timestamps
      'created_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'updated_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'deleted_at'        => Schema::TYPE_INTEGER . ' DEFAULT NULL'
    ],$tableOptions);

    $this->addForeignKey('fk_address_country', '{{%address}}', 'country_id', '{{%country}}', 'id', 'CASCADE', 'RESTRICT');

	}

	public function down()
	{
		//drop FK's first
    $this->dropForeignKey('fk_address_country', '{{%address}}');

		$this->dropTable('{{%address}}');
    $this->dropTable('{{%country}}');
	}
}
