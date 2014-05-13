<?php

namespace frenzelgmbh\cmaddress\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use frenzelgmbh\appcommon\controllers\AppController;

use frenzelgmbh\cmaddress\models\Address;
use frenzelgmbh\cmaddress\models\Country;

class DefaultController extends AppController
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
      'AccessControl' => [
        'class' => '\yii\filters\AccessControl',
        'rules' => [
          [
            'allow'=>true,
            'actions'=>array(
              'index',
              'test',
              'create',
              'jscountry'
            ),
            'roles'=>array('*'),
          ],
          [
            'allow'=>true,
            'actions'=>array(              
              'test',
              'jscountry',
              'create'
            ),
            'roles'=>array('?'),
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
    $this->layout = \frenzelgmbh\appcommon\controllers\AppController::adminlayout;
		return $this->render('index');
	}

  /**
   * [actionTest description]
   * @return [type] [description]
   */
  public function actionTest()
  {
    $this->layout = \frenzelgmbh\appcommon\controllers\AppController::adminlayout;
    return $this->render('test');
  }

  /**
   * [actionCreate description]
   * @return view         [description]
   */
  public function actionCreate(){
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
