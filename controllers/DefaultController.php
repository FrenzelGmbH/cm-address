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
              'create'
            ),
            'roles'=>array('*'),
          ],
          [
            'allow'=>true,
            'actions'=>array(              
              'test'
            ),
            'roles'=>array('?'),
          ]
        ]
      ]
    ];
  }

	public function actionIndex()
	{
    $this->layout = \frenzelgmbh\appcommon\controllers\AppController::adminlayout;
		return $this->render('index');
	}

  public function actionTest()
  {
    $this->layout = \frenzelgmbh\appcommon\controllers\AppController::adminlayout;
    return $this->render('test');
  }


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
}
