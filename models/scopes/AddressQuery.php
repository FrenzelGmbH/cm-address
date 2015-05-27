<?php

namespace net\frenzel\address\models\scopes;

use Yii;
use yii\db\ActiveQuery;

/**
 * The scopes for the address table
 * @copyright Frenzel GmbH
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @version 0.1.0
 */

class AddressQuery extends ActiveQuery
{   
    /**
     * only none delted records should be returned, deleted would mean they are not null anymore within field value
     * @return [type] [description]
     */
    public function active()
    {
        if(!\Yii::$app->user->isGuest && !\Yii::$app->user->identity->isAdmin)
        {
            $this->andWhere(['deleted_at' => NULL]);
        }
        return $this;
    }

    /**
     * will return the main address record
     * @return boolean [description]
     */
    public function isMain()
    {
        $this->andWhere(['isMain' => 1]);
        return $this;
    }

}