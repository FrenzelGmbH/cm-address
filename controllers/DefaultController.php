<?php

namespace frenzelgmbh\cmaddress\controllers;

use Yii;
use yii\filters\VerbFilter;
use frenzelgmbh\appcommon\controllers\AppController;

use frenzelgmbh\cmaddress\models\Address;

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
   * @param  string $module [description]
   * @param  integer $id     [description]
   * @return view         [description]
   */
  public function actionCreate($module,$id){
    $model = new Address;

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    } 
    else 
    {    
      $model->mod_table = $module;
      $model->mod_id = $id;
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
      $mainQuery = $query->select('id, country_name AS text')
        ->from('tbl_country')
        ->where('UPPER(country_name) LIKE "%'.strtoupper($search).'%"');

      $command = $mainQuery->createCommand();
      $rows = $command->queryAll();
      $clean['results'] = array_values($rows);
    }
    else
    {     
      if(!is_null($id))
      {
        $clean['results'] = ['id'=> $id,'text' => Country::findOne($id)->country_name];
      }else
      {
        $clean['results'] = ['id'=> 0,'text' => 'None found'];
      }
    }
    echo Json::encode($clean);
    exit();
  }

}
