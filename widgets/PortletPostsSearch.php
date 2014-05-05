<?php
namespace frenzelgmbh\cm-address\widgets;

use Yii;
use yii\helpers\Html;

use frenzelgmbh\cm-address\models\Post;
use frenzelgmbh\cm-address\models\PostSearch;

class PortletPostsSearch extends \frenzelgmbh\appcommon\widgets\AdminPortlet
{
	public $title='Post Search';

	public $contentCssClass='noStyler';
	public $htmlOptions=array('class'=>'noStyler');
	
	public $maxResults = 5;

	public $enableAdmin = false;

	public function init() {
		parent::init();
		\frenzelgmbh\cm-address\sblogAsset::register(\Yii::$app->view);
	}

	protected function renderContent()
	{
		$hits = NULL;
		$model = new PostSearch;
		if ($model->load(Yii::$app->request->post()))
		{
			if($model->searchstring!=='')
				$hits = Post::searchByString($model->searchstring)->all();
		}
		echo $this->render('@frenzelgmbh/sblog/widgets/views/_search',array('model'=>$model,'hits'=>$hits));
	}
}