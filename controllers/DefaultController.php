<?php

namespace frenzelgmbh\cmaddress\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;

use yii\web\Controller;

use frenzelgmbh\cmaddress\models\Address;
use frenzelgmbh\cmaddress\models\Country;

class DefaultController extends Controller
{
  
  /**
   * controlling the different access rights
   * @return [type] [description]
   */
  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'delete' => ['post'],
        ],
      ],
      'access' => [
        'class' => AccessControl::className(),
        'rules' => [
          [
            'allow'=>true,
            'actions'=>[
              'index',
              'test',
              'create',
              'jscountry'
            ],
            'roles'=>['?'],
          ],
          [
            'allow'=>true,
            'actions'=>[              
              'test',
              'jscountry',
              'create'
            ],
            'roles'=>['@'],
          ]
        ]
      ]
    ];
  }

  /**
   * [actionIndex description]
   * @return [type] [description]
   */
  public function actionIndex()
  {
    return $this->render('index');
  }

  /**
   * [actionTest description]
   * @return [type] [description]
   */
  public function actionTest()
  {
    return $this->render('test');
  }

  /**
   * [actionCreate description]
   * @param string module
   * @param integer id
   * @return view         [description]
   */
  public function actionCreate($module=NULL,$id=NULL){
    $model = new Address;

    if ($model->load(Yii::$app->request->post()) && $model->save()) 
    {
      if (\Yii::$app->request->isAjax) 
      {
        header('Content-type: application/json');
        echo Json::encode(['status'=>'DONE','model'=>$model]);
        exit();
      }
      else
      {
        return $this->redirect(['view', 'id' => $model->id]);
      }
    } 
    else 
    {
      if(!is_null($module) && !is_null($id))
      {
        $model->mod_table = $module;
        $model->mod_id = $id;  
      }
      return $this->renderAjax('@frenzelgmbh/cmaddress/widgets/views/iviews/_form', [
          'model' => $model,
      ]);
    }
  }

  /**
   * js(on)country returns an json object for the select2 widget
   * @param  string $search Text for the lookup
   * @param  integer of the set value
   * @return json    [description]
   */
  public function actionJscountry($search = NULL,$id = NULL)
  {
    header('Content-type: application/json');
    $clean['more'] = false;

    $query = new Query;
    if(!is_Null($search))
    {
      $mainQuery = $query->select('id, iso3 AS text')
        ->from('{{%country}}')
        ->where('UPPER(iso3) LIKE "%'.strtoupper($search).'%"');

      $command = $mainQuery->createCommand();
      $rows = $command->queryAll();
      $clean['results'] = array_values($rows);
    }
    else
    {     
      if(!is_null($id))
      {
        $clean['results'] = ['id'=> $id,'text' => Country::findOne($id)->iso3];
      }else
      {
        $clean['results'] = ['id'=> 0,'text' => 'None found'];
      }
    }
    echo Json::encode($clean);
    exit();
  }

}
