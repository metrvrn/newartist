<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\AjaxModel;
 
 
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
	
	
	
	  
}
