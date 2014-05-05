<?php

namespace frenzelgmbh\cm-address\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $cityName
 * @property string $zipCode
 * @property string $postBox
 * @property string $addresslineOne
 * @property string $addresslineTwo
 * @property string $regionName
 * @property integer $user_id
 * @property string $mod_table
 * @property integer $mod_id
 * @property string $system_key
 * @property string $system_name
 * @property integer $system_upate
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $country_id
 *
 * @property Country $country
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'mod_id', 'system_upate', 'created_at', 'updated_at', 'country_id'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['cityName', 'addresslineOne', 'addresslineTwo', 'mod_table', 'system_key', 'system_name'], 'string', 'max' => 100],
            [['zipCode', 'postBox'], 'string', 'max' => 20],
            [['regionName'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cm-address', 'ID'),
            'cityName' => Yii::t('cm-address', 'City'),
            'zipCode' => Yii::t('cm-address', 'Zip Code'),
            'postBox' => Yii::t('cm-address', 'Post Box'),
            'addresslineOne' => Yii::t('cm-address', 'Addressline One'),
            'addresslineTwo' => Yii::t('cm-address', 'Addressline Two'),
            'regionName' => Yii::t('cm-address', 'Region'),
            'user_id' => Yii::t('cm-address', 'User'),
            'mod_table' => Yii::t('cm-address', 'Mod Table'),
            'mod_id' => Yii::t('cm-address', 'Mod ID'),
            'system_key' => Yii::t('cm-address', 'System Key'),
            'system_name' => Yii::t('cm-address', 'System Name'),
            'system_upate' => Yii::t('cm-address', 'System Upate'),
            'created_at' => Yii::t('cm-address', 'Created At'),
            'updated_at' => Yii::t('cm-address', 'Updated At'),
            'country_id' => Yii::t('cm-address', 'Country ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }
}
