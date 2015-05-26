<?php

namespace net\frenzel\address\controllers;

/**
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\db\Query;

use \net\frenzel\address\models\Address;

/**
 * Default Controller
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'create' => ['post'],
                'update' => ['put', 'post'],
                'fetch' =>  ['put', 'post', 'get'],
                'jscountry' =>  ['put', 'post', 'get'],
                'delete' => ['post', 'delete']
            ]
        ];
        return $behaviors;
    }

    /**
     * Create Address.
     */
    public function actionCreate()
    {
        $model = new Address(['scenario' => 'create']);        
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save(false)) {
                    return $this->tree($model);
                } else {
                    Yii::$app->response->setStatusCode(500);
                    return \Yii::t('net_frenzel_address', 'FRONTEND_FLASH_FAIL_CREATE');
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->setStatusCode(400);
                return ActiveForm::validate($model);
            }
        }
    }

    /**
     * Update Communication.
     *
     * @param integer $id Communication ID
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save(false)) {
                    return $this->renderAjax('@vendor/frenzelgmbh/cm-address/views/widgets/views/_index_single_item', ['model' => $model]);
                } else {
                    Yii::$app->response->setStatusCode(500);
                    return \Yii::t('net_frenzel_address', 'FRONTEND_FLASH_FAIL_UPDATE');
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->setStatusCode(400);
                return ActiveForm::validate($model);
            }
        }
    }

    /**
     * fetch Communication.
     *
     * @param integer $id Communication ID
     * @return mixed
     */
    public function actionFetch($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');
        Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->renderAjax('@vendor/frenzelgmbh/cm-address/views/widgets/views/_form_update', ['model' => $model]);
    }

    /**
     * Delete comment page.
     *
     * @param integer $id Comment ID
     * @return string Comment text
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($this->findModel($id)->deleteCommunication()) {
            return \Yii::t('net_frenzel_address', 'FRONTEND_WIDGET_COMMENTS_DELETED_COMMENT_TEXT');
        } else {
            Yii::$app->response->setStatusCode(500);
            return \Yii::t('net_frenzel_address', 'FRONTEND_FLASH_FAIL_DELETE');
        }
    }

    /**
     * Find model by ID.
     *
     * @param integer|array $id Comment ID
     * @return Comment Model
     * @throws HttpException 404 error if comment not found
     */
    protected function findModel($id)
    {
        /** @var Comment $model */
        $model = Address::findOne($id);
        if ($model !== null) {
            return $model;
        } else {
            throw new HttpException(404, \Yii::t('net_frenzel_address', 'FRONTEND_FLASH_RECORD_NOT_FOUND'));
        }
    }

    /**
     * @param Comment $model Comment
     *
     * @return string Comments list
     */
    protected function tree($model)
    {
        $models = Address::getAddresses($model->entity_id, $model->entity);
        return $this->renderPartial('@net/frenzel/address/views/widgets/views/_index_item', ['models' => $models]);
    }

  /**
   * js(on)country returns an json object for the select2 widget
   * @param  string $search Text for the lookup
   * @param  integer of the set value
   * @return json    [description]
   */
  public function actionJscountry($search = NULL,$id = NULL)
  {
    Yii::$app->response->format = Response::FORMAT_JSON;
    $clean['more'] = false;

    $query = new Query;
    if(!is_Null($search))
    {
      $mainQuery = $query->select('id, iso3 AS text')
        ->from('{{%net_frenzel_country}}')
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
    return $clean;
  }

}
