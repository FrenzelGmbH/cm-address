<?php

namespace net\frenzel\address\models;

use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use net\frenzel\address\models\scopes\AddressQuery;
use Ivory\HttpAdapter\CurlHttpAdapter;
use Ivory\HttpAdapter\HttpAdapterException;
use Geocoder\Provider\GoogleMaps;

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
 * @property string $entity
 * @property integer $entity_id
 * @property integer $isMain
 * @property integer $type
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
    CONST TYPE_POST = 1;
    CONST TYPE_INVOICE = 2;

    public static $addressTypes = [
        self::TYPE_POST => 'POST',
        self::TYPE_INVOICE => 'INVOICE',
    ];

    public static function getTypeArray()
    {
        return self::$addressTypes;
    }
    
    public function getTypeAsString()
    {
        if(isset(self::$addressTypes[$this->type]))
            return self::$addressTypes[$this->type];
        return 'UNKNOWN! Pls. contact sysadmin ...';
    }

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
    public function scenarios()
    {
        return [
            'create' => ['addresslineOne', 'entity', 'entity_id', 'cityName','zipCode','addresslineTwo','type','isMain'],
            'default' => ['addresslineOne', 'entity', 'entity_id', 'cityName','zipCode','addresslineTwo','type','isMain'],
            'update' => ['addresslineOne' ,'cityName','zipCode','addresslineTwo','type','isMain'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id', 'created_at', 'updated_at', 'country_id','deleted_at','type','isMain'], 'integer'],
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
            'id'             => \Yii::t('app', 'ID'),
            'cityName'       => \Yii::t('app', 'City'),
            'zipCode'        => \Yii::t('app', 'Zip Code'),
            'postBox'        => \Yii::t('app', 'Post Box'),
            'addresslineOne' => \Yii::t('app', 'Addressline One'),
            'addresslineTwo' => \Yii::t('app', 'Addressline Two'),
            'longitude'      => \Yii::t('app', 'Longitude'),
            'latitude'       => \Yii::t('app', 'Latitude'),
            'regionName'     => \Yii::t('app', 'Region'),
            'created_by'     => \Yii::t('app', 'Created by'),
            'updated_by'     => \Yii::t('app', 'Updated by'),
            'created_at'     => \Yii::t('app', 'Created at'),
            'updated_at'     => \Yii::t('app', 'Updated at'),
            'deleted_at'     => \Yii::t('app', 'Deleted at'),
            'country_id'     => \Yii::t('app', 'Country'),
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
        if($this->isMain == 1)
        {
            self::updateAll(['isMain' => 0],['entity' => $this->entity, 'entity_id' => $this->entity_id]);
            $this->isMain = 1;
        }
        try{
            $curl = new CurlHttpAdapter();
            $geolocation = new GoogleMaps($curl);
            $lookupaddress = utf8_encode($this->addresslineOne . ', ' . $this->cityName);
            $address = $geolocation->geocode($lookupaddress);

            if($address->getLatitude()!='')
            {
                $this->latitude = $address->getLatitude();
                $this->longitude = $address->getLongitude();
            }
        }
        catch(HttpAdapterException $e)
        {
            echo $e->getMessage();
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
            if ($model::find()->where(['id' => $this->entity_id]) === false) {
                $this->addError($attribute, \Yii::t('net_frenzel_communication', 'ERROR_MSG_INVALID_MODEL_ID'));
            }
        }
    }

    public function getAddressHTML()
    {
        $html = '';
        if($this->isMain == true)
        {
          $html .= '<p class="text-primary">';
        }
        $html .= '<i class="fa fa-map-marker"></i> ';
        switch($this->type)
        {
          case self::TYPE_POST:
            $html .= '<i class="fa fa-truck"></i> ';
            break;
          default:
            $html .= '<i class="fa fa-credit-card"></i> ';
        }
        $html .= $this->addresslineOne .', '. $this->zipCode . ' ' . $this->cityName;
        if($this->isMain == true)
        {
          $html .= '</p>';
        }
        return $html;
    }

    /**
     * find the use location based upon his current IP address
     * @return mixed [description]
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
