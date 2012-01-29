<?php
/**
 * REST requests controller
 * @author Phant0m_m
 */
class RestController extends CController
{
    /**
     * No layouts should be used
     * @var bool
     */
    public $layout=false;

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'authenticate', // provide the client authentication
        );
    }

    /**
     * Default rest page
     * returns 404, as we don't need default actions
     * @throws CHttpException
     */
    public function actionIndex()
   	{
        throw new CHttpException(404,'The requested page does not exist.');
   	}

    /**
     * Provide the virtual hosts to be added to customer /etc/hosts
     */
    public function actionVhosts()
    {
        $criteria=new CDbCriteria(array('condition'=>'owner_id='.Yii::app()->user->getId()));

        $dataProvider=new CActiveDataProvider('Vhost', array('criteria'=>$criteria,));

		$this->render('vhosts', array('dataProvider'=>$dataProvider));
    }

    /**
     * Provide a client authentication
     * @param $filterChain
     */
    public function filterAuthenticate ($filterChain)
    {
        $identity=new UserIdentity($_GET['username'],$_GET['password']);
        if(!$identity->authenticate()) {
            throw new CHttpException(404,'The requested page does not exist.');
        }

        Yii::app()->user->login($identity,0);
        $filterChain->run();
    }

}