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

use app\models\ AddLogingModel;

use app\models\Usersessitions; 
use app\models\Image;

class SaleController extends Controller
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
		$catalogModel=new CatalogModel();
		 
		$catalogModel->elementPerPage=50;
	     $catalogModel->load(Yii::$app->request->get(),'');		
	    $catalogModel->fillarrSectioons(); 
		$catalogModel->fillTopArrCurSection();  
	    $catalogModel->fillBottomArrCurSection();
		$catalogModel->setVisibleForCurienSection();
		
	
		
		  
			
		   return $this->render('index', [
		 	 'catalogModel' => $catalogModel,
			]);
			
		
    }

	
	 public function actionBasket()
    {
		$catalogModel=new CatalogModel();
		 
		$catalogModel->elementPerPage=50;
	     $catalogModel->load(Yii::$app->request->get(),'');		
	    $catalogModel->fillarrSectioons(); 
		$catalogModel->fillTopArrCurSection();  
	    $catalogModel->fillBottomArrCurSection();
		

		$catalogModel->setVisibleForCurienSection();
		
		 $modelBasket= new BasketModel();	 
          $modelZakazForm= new ZakazForm();	
		  

            //sessionid
							$session = Yii::$app->session;
							if ($session->isActive){// $AjaxModel->message= $AjaxModel->message.'  isAllaiv';

								//	$AjaxModel->message= $AjaxModel->message.'<br>'.$session ->getId();

									$modelBasket->sessionForBasket=$session ->getId();

							};

							
							//user id;
							if (Yii::$app->user->isGuest){

								//$AjaxModel->message= $AjaxModel->message.'<br> user is guest';

							}else{

                                   
									//$AjaxModel->message= $AjaxModel->message.'<br> user is user  ';
									$modelBasket->userId=Yii::$app->user->id;
	                               $modelZakazForm->name=Yii::$app->user->identity->name;
                                    $modelZakazForm->phone=Yii::$app->user->identity->phone;
									$modelZakazForm->adress=Yii::$app->user->identity->adress;
									
									$modelZakazForm->email=Yii::$app->user->identity->email;
									//email
							}


		 $modelBasket->fillBasketArray();
		  
			
			
			//$modelZakazForm->name='alexandra';
			
			
			
		   return $this->render('basket', [
         'model' => $modelBasket, 
		 'modelForm'=>$modelZakazForm,
		 'catalogModel' => $catalogModel,
			]);
			
		
	   
    }
	   public function actionOrder()
    {
		$catalogModel=new CatalogModel();
		 
		$catalogModel->elementPerPage=50;

	    $catalogModel->fillarrSectioons(); 
		$catalogModel->fillTopArrCurSection();  
	    $catalogModel->fillBottomArrCurSection();
		$catalogModel->setVisibleForCurienSection();
		
		 $modelBasket= new BasketModel();	 
         $modelZakazForm= new ZakazForm();	
     	
		  
			
	  if ($modelZakazForm->load(Yii::$app->request->post()) && $modelZakazForm->validate()) {
		  
		   $model= new OrderModel();
   
		   
		    $model->makeOrder();
		 
		  return $this->render('orderdetail', [
         'model' => $model, 
		
		
			]);
		  
		  
	  }
       
		  

            //sessionid
							$session = Yii::$app->session;
							if ($session->isActive){// $AjaxModel->message= $AjaxModel->message.'  isAllaiv';

								//	$AjaxModel->message= $AjaxModel->message.'<br>'.$session ->getId();

									$modelBasket->sessionForBasket=$session ->getId();

							};

							
							//user id;
							if (Yii::$app->user->isGuest){

								//$AjaxModel->message= $AjaxModel->message.'<br> user is guest';

							}else{


									//$AjaxModel->message= $AjaxModel->message.'<br> user is user  ';
								  //  $modelZakazForm->userId=Yii::$app->user->id;
	                                $modelZakazForm->name=Yii::$app->user->identity->name;
                                    $modelZakazForm->phone=Yii::$app->user->identity->phone;
									$modelZakazForm->adress=Yii::$app->user->identity->adress;
									$modelZakazForm->email=Yii::$app->user->identity->email;
									//email
							}

							
							
							
						 

		 $modelBasket->fillBasketArray();
		  
			
			
			//$modelZakazForm->name='alexandra';
			
			
			
		   return $this->render('order', [
         'model' => $modelBasket, 
		 'modelForm'=>$modelZakazForm,
		 'catalogModel' => $catalogModel,
			]);
    }
	
	
	
}
