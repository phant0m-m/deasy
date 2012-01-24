<?php
/**
 * Ajax requests controller
 * Responsible for vhost removing
 */
class AjaxController extends Controller
{
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
                array('allow',  // allow all users to access 'error' action.
                    'actions'=>array('index'),
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
     * Default ajax page
     * returns 404, as we don't need default ajax actions
     * @throws CHttpException
     */
    public function actionIndex()
   	{
        throw new CHttpException(404,'The requested page does not exist.');
   	}

    /**
   	 * Remove vhost record
   	 */
    public function actionRemoveVhost()
    {
        $vhost = null;
        if(isset($_GET['vhostId'])) {
            if(Yii::app()->user->isGuest) {
                throw new CHttpException(404,'The requested page does not exist.');
            }
            $vhost = Vhost::model()->findByPk($_GET['vhostId'], 'owner_id=' . Yii::app()->user->getId());
        }
        // Return 404 if the vhost was not found
        if($vhost === null) throw new CHttpException(404,'The requested page does not exist.');

        $vhost->delete();
        echo json_encode(array('status'=>'OK','vhostId'=>$_GET['vhostId']));
        Yii::app()->end();
    }

    /**
   	 * Remove  a list of a vhost records
   	 */
    public function actionRemVhostList()
    {
        if (isset($_POST['vhostToRemove'])) {
            $removedVhosts = array();
            $vhostsToRemove = Vhost::model()->findAllByPk($_POST['vhostToRemove'],'owner_id=' . Yii::app()->user->getId());
            if (is_array($vhostsToRemove) && count($vhostsToRemove) > 0) {
                foreach ($vhostsToRemove as $vhostToRemove) {
                    $removedVhosts[] = $vhostToRemove->id;
                    $vhostToRemove->delete();
                }
                $status = (count($removedVhosts) == count($_POST['vhostToRemove'])) ? 'OK' : 'PARTLY';
                echo json_encode(array('status'=>$status,'vhostIds'=>$removedVhosts));
                Yii::app()->end();
            }
        }
        // Return 404 by default
        throw new CHttpException(404,'The requested page does not exist.');
        Yii::app()->end();
    }
}
