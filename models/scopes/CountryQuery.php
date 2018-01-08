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

class CountryQuery extends ActiveQuery
{   
    /**
     * only none delted records should be returned, deleted would mean they are not null anymore within field value
     * @return [type] [description]
     */
    public function active()
    {
        if(!\Yii::$app->user->isGuest && !\Yii::$app->user->identity->isAdmin)
        {
            $this->andWhere(['is_active' => 1]);
        }
        return $this;
    }

    /**
     * find all records which are related to the same entity
     * @param  [type] $entity [description]
     * @param  [type] $enity  [description]
     * @return [type]         [description]
     */
    public function related($entity = NULL, $enity = NULL)
    {
        $this->andWhere(['entity' => $entity, 'entity_id' => $this->entity_id]);
        return $this;
    }

}