<?php

/**
 * The migration script for the addresses
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @copyright Frenzel GmbH
 * @version 1.0
 */

use yii\db\Schema;

class m150530_060429_addressextension extends \yii\db\Migration
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
            case 'mssql':
              $tableOptions = null;
              break;
            default:
              throw new RuntimeException('Your database is not supported!');
        }

        $this->addColumn('{{%net_frenzel_address}}','isMain',Schema::TYPE_SMALLINT .' DEFAULT 0');
        $this->addColumn('{{%net_frenzel_address}}','type', Schema::TYPE_INTEGER .' DEFAULT 1');
	}

	public function down()
	{
		//drop FK's first
        echo "Migration ". self::className() ." can't be reverted!";
        return false;
	}
}
