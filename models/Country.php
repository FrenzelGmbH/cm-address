<?php

namespace net\frenzel\address\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $iso2
 * @property string $iso3
 * @property string $name
 * @property integer $is_active
 *
 * @property Address[] $addresses
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%net_frenzel_country}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iso2'], 'string', 'max' => 2],
            [['iso3'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 100],
            [['is_active'],'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'   => Yii::t('cm-address', 'ID'),
            'iso2' => Yii::t('cm-address', 'Iso2'),
            'iso3' => Yii::t('cm-address', 'Iso3'),
            'name' => Yii::t('cm-address', 'Name'),
            'is_active' => Yii::t('cm-address', 'Is Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubdivisions()
    {
        return $this->hasMany(Subdivision::className(), ['iso2' => 'iso2']);
    }
}
