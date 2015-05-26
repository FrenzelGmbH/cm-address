<?php

namespace net\frenzel\address\models;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use net\frenzel\address\models\scopes\AddressQuery;
use AnthonyMartin\GeoLocation\GeoLocation;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $cityName
 * @property string $zipCode
 * @property string $postBox
 * @property string $addresslineOne
 * @property string $addresslineTwo
 * @property float $longitude
 * @property float $latitude
 * @property string $regionName
 * @property integer $user_id
 * @property string $mod_table
 * @property integer $mod_id
 * @property string $system_key
 * @property string $system_name
 * @property integer $system_upate
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property integer $country_id
 *
 * @property Country $country
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     * @return MandantenQuery
     */
    public static function find()
    {
        return new AddressQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%net_frenzel_address}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            \yii\behaviors\BlameableBehavior::className(),
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id', 'created_at', 'updated_at', 'country_id','deleted_at'], 'integer'],
            [['cityName', 'addresslineOne', 'addresslineTwo', 'entity','updated_by', 'created_by'], 'string', 'max' => 100],
            [['zipCode', 'postBox'], 'string', 'max' => 20],
            [['regionName'], 'string', 'max' => 50],
            [['latitude', 'longitude'],'string','max'=>20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'             => \Yii::t('cm-address', 'ID'),
            'cityName'       => \Yii::t('cm-address', 'City'),
            'zipCode'        => \Yii::t('cm-address', 'Zip Code'),
            'postBox'        => \Yii::t('cm-address', 'Post Box'),
            'addresslineOne' => \Yii::t('cm-address', 'Addressline One'),
            'addresslineTwo' => \Yii::t('cm-address', 'Addressline Two'),
            'longitude'      => \Yii::t('cm-address', 'Longitude'),
            'latitude'       => \Yii::t('cm-address', 'Latitude'),
            'regionName'     => \Yii::t('cm-address', 'Region'),
            'created_by' => \Yii::t('app', 'Created by'),
            'updated_by' => \Yii::t('app', 'Updated by'),
            'created_at' => \Yii::t('app', 'Created at'),
            'updated_at' => \Yii::t('app', 'Updated at'),
            'deleted_at' => \Yii::t('app', 'Updated at'),
            'country_id'     => Yii::t('cm-address', 'Country'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        $Module = \Yii::$app->getModule('address');
        return $this->hasOne($Module->userIdentityClass, ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            //get the geo location information
        }
        //geolocating
        $location = $this->addresslineOne . ' ,' . $this->cityName;
        $response = GeoLocation::getGeocodeFromGoogle($location);
        if(array_key_exists(0, $response->results))
        {
            $this->latitude = $response->results[0]->geometry->location->lat;
            $this->longitude = $response->results[0]->geometry->location->lng;
        }
        
        return parent::beforeSave($insert);
    }

    /**
     * [getCommunications description]
     * @param  [type] $model [description]
     * @param  [type] $class [description]
     * @return [type]        [description]
     */
    public static function getAddresses($model, $class)
    {
        $models = self::find()->where([
            'entity_id' => $model,
            'entity' => $class
        ])->orderBy('{{%net_frenzel_address}}.created_at DESC')->active()->with(['author'])->all();
        
        return $models;
    }

    /**
     * Model ID validation.
     *
     * @param string $attribute Attribute name
     * @param array $params Attribute params
     *
     * @return mixed
     */
    public function validateModelId($attribute, $params)
    {
        /** @var ActiveRecord $class */
        $class = Model::findIdentity($this->model_class);
        if ($class === null) {
            $this->addError($attribute, \Yii::t('net_frenzel_communication', 'ERROR_MSG_INVALID_MODEL_ID'));
        } else {
            $model = $class->name;
            if ($model::find()->where(['id' => $this->model_id]) === false) {
                $this->addError($attribute, \Yii::t('net_frenzel_communication', 'ERROR_MSG_INVALID_MODEL_ID'));
            }
        }
    }

    /**
     * find the use location based upon his current IP address
     * @return [type] [description]
     */
    public static function getIPLocation(){
        //initialize the browser
        $adapter = new GuzzleHttpAdapter();
        
        //create geocoder
        $geocoder = new \Geocoder\Provider\FreeGeoIp($adapter);

        if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $client_ip = $_SERVER['REMOTE_ADDR'];
        }
        else {
          $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $geocoder->geocode($client_ip);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(Model::className(), ['id' => 'entity']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        /** @var ActiveRecord $class */
        $class = Model::find()->where(['id' => $this->entity])->asArray()->one();
        $model = $class->name;
        return $this->hasOne($model::className(), ['id' => 'entity_id']);
    }
}
