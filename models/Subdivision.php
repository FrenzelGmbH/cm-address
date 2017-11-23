<?php

namespace net\frenzel\address\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "subdivision".
 *
 * @property integer $id
 * @property string $iso2
 * @property string $subdivision
 * @property string $regionName
 * @property string $regionType
 *
 * @property Address[] $addresses
 */
class Subdivision extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%net_frenzel_subdivision}}';
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
            [['subdivision'], 'string', 'max' => 20],
            [['regionName'], 'string', 'max' => 100],
            [['regionType'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'   => Yii::t('cm-address', 'ID'),
            'iso2' => Yii::t('cm-address', 'Iso2 Country'),
            'subdivision' => Yii::t('cm-address', 'Region Code'),
            'regionName' => Yii::t('cm-address', 'Name'),
            'regionType' => Yii::t('cm-address', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['iso2' => 'iso2']);
    }
}
