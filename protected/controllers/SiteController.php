<?php

class SiteController extends Controller
{
    protected $_vhost;

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
            return array(
                    array('allow',  // allow all users to access 'login' actions.
                            'actions'=>array('login'),
                            'users'=>array('*'),
                    ),
                    array('allow', // allow authenticated users to access all actions
                            'users'=>array('@'),
                    ),
                    array('deny',  // deny all users
                            'users'=>array('*'),
                    ),
            );
    }


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $criteria=new CDbCriteria(array(
      			'condition'=>'owner_id='.Yii::app()->user->getId(),
      			'order'=>'hostname DESC'
      	));

        $dataProvider=new CActiveDataProvider('Vhost', array(
      			'pagination'=>array(
      		    'pageSize'=>Yii::app()->params['vhostPerPage'],
      			),
      			'criteria'=>$criteria,
      	));

		$this->render('index', array(
					'dataProvider'=>$dataProvider,
				));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Add/Edit domain
	 */
	public function actionEditVhost()
	{
        $model = $this->_loadVhost();
        if(isset($_POST['Vhost'])) {
            $model->attributes=$_POST['Vhost'];
            if($model->save()) {
                Yii::app()->user->setFlash('vhostChanged','Your vhost was successfully updated!');
            }
        }
        $this->render('vhost',array('model'=>$model));
    }

    public function actionAddVhost()
    {
        $model = new Vhost();
        if(isset($_POST['Vhost'])) {
            $_POST['Vhost']['owner_id'] = Yii::app()->user->getId();
            $model->attributes=$_POST['Vhost'];

            if($model->save()) {
                Yii::app()->user->setFlash('vhostChanged','Your vhost was successfully created!');
            }
        }
        $this->render('vhost',array('model'=>$model));
    }

    protected function _loadVhost()
    {
        if($this->_vhost===null)
      	{
            if(isset($_GET['vhostId'])) {
                if(Yii::app()->user->isGuest) {
                    throw new CHttpException(404,'The requested page does not exist.');
                }
                $this->_vhost=Vhost::model()->findByPk($_GET['vhostId'], 'owner_id=' . Yii::app()->user->getId());
            }

            if($this->_vhost===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_vhost;
    }

    public function actionMakeVhostConfig()
    {
        $criteria=new CDbCriteria(array(
      			'condition'=>'owner_id='.Yii::app()->user->getId(),
      			'order'=>'hostname DESC'
      	));

        $dataProvider=new CActiveDataProvider('Vhost', array(
      			'criteria'=>$criteria,
      	));

		$this->render('localConfig', array(
					'dataProvider' => $dataProvider,
                    'baseHostname' => Yii::app()->params['serverBaseHost'],
				));
    }

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}