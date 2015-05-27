<?php

namespace net\frenzel\address\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frenzelgmbh\cmaddress\models\Address;

/**
 * AddressSearch represents the model behind the search form about `app\models\Address`.
 */
class AddressSearch extends Address
{
    public function rules()
    {
        return [
            [['id', 'user_id', 'mod_id', 'system_upate', 'created_at', 'updated_at', 'country_id'], 'integer'],
            [['cityName', 'zipCode', 'postBox', 'addresslineOne', 'addresslineTwo', 'regionName', 'mod_table', 'system_key', 'system_name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * [search description]
     * @param  array $params [description]
     * @param  string $module [description]
     * @param  integer $id     [description]
     * @return [type]         [description]
     */
    public function search($params,$entity=NULL,$entity_id=NULL)
    {
        $query = Address::find()->active()->related($entity, $entity_id);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'country_id' => $this->country_id,
        ]);

        $query->andFilterWhere(['like', 'cityName', $this->cityName])
            ->andFilterWhere(['like', 'zipCode', $this->zipCode])
            ->andFilterWhere(['like', 'postBox', $this->postBox])
            ->andFilterWhere(['like', 'addresslineOne', $this->addresslineOne])
            ->andFilterWhere(['like', 'addresslineTwo', $this->addresslineTwo])
            ->andFilterWhere(['like', 'regionName', $this->regionName]);

        return $dataProvider;
    }
}
