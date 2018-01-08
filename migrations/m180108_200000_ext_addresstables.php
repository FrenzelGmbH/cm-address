<?php

/**
 * The migration script for the addresses subdivision
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @copyright Frenzel GmbH
 * @version 1.1
 */

use yii\db\Schema;

class m180108_200000_ext_addresstables extends \yii\db\Migration
{
	public function up()
	{ 
    	$this->addColumn('{{%net_frenzel_country}}', 'is_active', Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1');
    }
  
    public function down()
    {
      $this->dropColumn('{{%net_frenzel_country}}', 'is_active');
      return true;
    }
}