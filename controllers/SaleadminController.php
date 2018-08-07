<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\SignupForm; 

use app\models\CatalogModel;
use app\models\AdminModel;
use app\models\AjaxModel;
 
use app\models\CatalogModelAdmin;

//use app\models\SignupForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\BasketModel;
use app\models\OrderModel;
use app\models\ZakazForm;
use app\models\SaleModel;

use app\models\ AddLogingModel;

use app\models\Usersessitions; 
use app\models\Image;
use app\models\SaleAdminModel;
 
 
 
class SaleadminController extends Controller
{
     

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		
		$model=new SaleAdminModel();
			
		   return $this->render('index', [
         'model' => $model]);
    }

	
	 public function actionOrders()
    {
		
		$model=new SaleAdminModel();
		$model->fillArrayOrders();
		
			
		   return $this->render('orders', [
         'model' => $model]);
    }
	
		 public function actionPrice()
    {
		
		$model=new SaleAdminModel();
			
		   return $this->render('price', [
         'model' => $model]);
    }
	
	
	 public function actionOrderdetail()
    {
		$catalogModel=new CatalogModel();
		$catalogModel->elementPerPage=50;
	    $catalogModel->load(Yii::$app->request->get(),'');		
	    $catalogModel->fillarrSectioons(); 
		$catalogModel->fillTopArrCurSection();  
	    $catalogModel->fillBottomArrCurSection();
		$catalogModel->setVisibleForCurienSection();

		   $get=Yii::$app->request->get();
		   
		  
		    if( isset($get['md5'])){
				
				
				$model= new OrderModel();
					
				$model->orderMd5=$get['md5'];

//echo $get['md5'];
				
				$model->fillArrOrderElements();
				  return $this->render('orderdetail', [
				 'model' => $model,
				 'catalogModel' => $catalogModel
				 ]); 
				
				
				
			}else{
				 
				
				
			}
	 
		
		
		
		
		
	}
	  
}
