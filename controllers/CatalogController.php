<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\CatalogModel;

use app\models\BasketModel;

use app\models\AjaxModel;


  

class CatalogController extends Controller
{
      
	 public $defaultAction = 'index';
	
	
	
	public function beforeAction($action) {
    $this->enableCsrfValidation = false;
    return parent::beforeAction($action);
}
	
    public function actionIndex()
    {  
	  //echo 'alex';
		$model=new CatalogModel();
		//$model->scenario = 'default';
		 $model->elementPerPage=50;
		 //$model->quantityPageForCurSection;
		 
		$model->load(Yii::$app->request->get(),'');
		
		//main array of sections   
	    $model->fillarrSectioons();
		
		
		//top section for curient sectio
		$model->fillTopArrCurSection(); 
	   
	   ///echo 'alex3';
	   
	   
	   $model->fillBottomArrCurSection();
		$model->fillQuantitypageforqurientsection();
		   
	    $model->fillarrElements();
			
			
			
			
		   return $this->render('catalog', [
         'model' => $model,
			]);
			
    }
 
	 
	    public function actionAddtobasketajax()
    {      
	

	
		   $this->layout = 'ajaxl';
		   $AjaxModel=new AjaxModel();
	        $AjaxModel->message='addtobasketajax';
	
	//echo 'alex';
	 
	 $model=new BasketModel();
	 $postArray= Yii::$app->request->post();
	  if(isset ($postArray)){
	   
                            //element id
							$model->elementForAddToBasket=$postArray['elementid'];        
						  
                             //sessionid
							$session = Yii::$app->session;
							if ($session->isActive){ $AjaxModel->message= $AjaxModel->message.'  isAllaiv';

									$AjaxModel->message= $AjaxModel->message.'<br>'.$session ->getId();

									$model->sessionForBasket=$session ->getId();

							};

							
							//user id;
							if (Yii::$app->user->isGuest){

								$AjaxModel->message= $AjaxModel->message.'<br> user is guest';

							}else{


									$AjaxModel->message= $AjaxModel->message.'<br> user is user  ';
									$model->userId=Yii::$app->user->id;


							}
							
							
							
							
							$model->addElementToBasket();

					}
	  
	  
	  
		   return $this->render('catalogajax', [
           'model' => $AjaxModel,
			]);
			
    }
	
	
	
 
	
 
	
	
}
