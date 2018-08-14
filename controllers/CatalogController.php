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

use app\models\LokalFileModel;
  

class CatalogController extends Controller
{
      
	 public $defaultAction = 'index';
	
	
	
	public function beforeAction($action) {
    $this->enableCsrfValidation = false;
    return parent::beforeAction($action);
}
	
    public function actionIndex()
    {  

		$model=new CatalogModel();

		$model->elementPerPage=50;		 
		
		$model->load(Yii::$app->request->get(),'');
		
		
		if(!isset($model->view)){
		$viewForControler=LokalFileModel::getDataByKeyFromLocalfile('local_data_default_table');
			
			
		$model->view=$viewForControler;	
			
		}
		
		
		
		
		///it is detail page
		if(isset($model->element)&&($model->element!=='non')){
			
			 
			
	    $model->setSectionIdForCurientElement();
			
        $model->fillarrSectioons();		
		$model->fillTopArrCurSection(); 	     
		$model->fillBottomArrCurSection();	   
		$model->fillQuantitypageforqurientsection();	
		$model->setVisibleForCurienSection();
		$model->fillarrElements();
		$model->fillImageForElementArray();		
		$model->fillPriceForElementArray();		
		$model->fillQuantityForElementArray();
		 
		$model->fillArrProperyMetr();
		
		  
		$model->fillArrayDataForCurientElement();
		$model->viewType='cart';
		
		
		
		
		return $this->render('detail', [
         	'model' => $model,
			]);
		
		
		
			
			
		}
		
		
		
		
	    $model->fillarrSectioons();		
		$model->fillTopArrCurSection();      
		$model->fillBottomArrCurSection();   
		$model->fillQuantitypageforqurientsection();			   
	    $model->fillarrElements();
			
			
			
		$model->fillImageForElementArray();		
		$model->fillPriceForElementArray();		
		$model->fillQuantityForElementArray();	

		
			
		
		$model->setVisibleForCurienSection();
		  // echo '<br>prrrrrrrrrrrrrrrrrrge '.$model->quantityPageForCurSection.'<br>';
			//echo 'alex controlersd '.$count.'<br>';
			
		 //  return;  
		
		
			
			if($model->view==='table'){
				
				return $this->render('catalog_table', [
				'model' => $model,
				]);	
				
			}else{
				
				
				return $this->render('catalog_cart', [
				'model' => $model,
				]);		
				
			}
			
			
		   
			
    }
 
	 
	    public function actionAddtobasketajax()
    {      
	

	
		   $this->layout = 'ajaxl';
		   $AjaxModel=new AjaxModel();
	       $AjaxModel->message='addtobasketajax';
	
	 
	 $model=new BasketModel();
	 $postArray= Yii::$app->request->post();
	  if(isset ($postArray)){
	   
                           
						   if (Yii::$app->user->isGuest){

							}else{
 
									$model->userId=Yii::$app->user->id;
 
							}
							  
							
						   
						   
							$model->elementForAddToBasket=$postArray['elementid']; 
                            $model->quantityForAddToBasket=$postArray['quanty']; 						
						  
                           
						   
							$session = Yii::$app->session;
									$model->sessionForBasket=$session ->getId();
									//$model->message=$session ->getId();
							if ($session->isActive){
								
							

							};

							$model->addElementToBasket();
							

					}
	  
	       $AjaxModel->message=$model->message;
	  
	  
		   return $this->render('catalogajax', [
           'model' => $AjaxModel,
			]);
			
    }
	
	
	
 
	
 
	
	
}
