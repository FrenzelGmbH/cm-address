<?php

/**
 * The migration script for the addresses
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @copyright Frenzel GmbH
 * @version 1.0
 */

class m130530_050429_addresstables extends \yii\db\Migration
{
	public function up()
	{
		$this->createTable('tbl_address',array(
      'id'                => 'INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
      'party_id'          => 'INTEGER UNSIGNED NOT NULL',
      'postCode'          => 'VARCHAR(100)',
      'streetDescription' => 'VARCHAR(200)',
      'addressLine'       => 'VARCHAR(200)',
      'postBox'           => 'VARCHAR(100)',
      'cityName'          => 'VARCHAR(100)',
      'region'            => 'VARCHAR(100)', //can hold the nuts definition if needed
      'countryCode'       => 'INTEGER',
      'system_key'        => 'VARCHAR(100)',
      'system_name'       => 'VARCHAR(100)',
      'system_upate'      => 'INTEGER DEFAULT NULL',
      'creator_id'        => 'INTEGER NOT NULL',
      'time_deleted'      => 'INTEGER DEFAULT NULL',
      'time_create'       => 'INTEGER',
    ),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');
	}

	public function down()
	{
		//drop FK's first
		return true;
	}
}

/*
public function up()
    {
    	$this->createTable('{{%handycap}}',array(
          'id'                      => Schema::TYPE_PK,
          'user_id'                 => Schema::TYPE_INTEGER.' DEFAULT NULL',
          'hcp'                     => Schema::TYPE_FLOAT.' DEFAULT 36.0',          
          'status'                  => Schema::TYPE_STRING .'(255) NOT NULL DEFAULT "created"',
          'time_deleted'            => Schema::TYPE_INTEGER.' DEFAULT NULL',
          'time_create'             => Schema::TYPE_INTEGER,
      ),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');
    }

    public function down()
    {
        $this->dropTable('{{%handycap}}');
    }
 */
