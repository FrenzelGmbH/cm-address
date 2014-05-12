<?php

namespace frenzelgmbh\cmaddress\controllers;

use Yii;
use yii\filters\VerbFilter;
use frenzelgmbh\appcommon\controllers\AppController;

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
              'test'
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
}
