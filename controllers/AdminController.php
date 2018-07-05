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


//use app\models\SignupForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\BasketModel;
use app\models\ZakazModel;
use app\models\ZakazForm;

use app\models\ AddLogingModel;

use app\models\Usersessitions; 


class AdminController extends Controller
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
         $model=new AdminModel();
			
		   return $this->render('adminsite', [
         'model' => $model,]);
    }

	
	
	
	 public function actionUploadenomartist()
    {
			$this->layout = 'ajaxl';	
		
		 $model_admin=new AdminModel();
		 $model_admin->Uploadenomartist();
		 
		  $model=new AjaxModel();
		  
		  $model->message=$model_admin->message;
		  
			
		   return $this->render('ajaxv', [
         'model' => $model,
			]);
			
		
	   
    }
	
	
	 public function actionCleancache() 
    {
			$this->layout = 'ajaxl';	
		
		      Yii::$app->cache->flush();
		 
		      $model=new AjaxModel();
		  
		     $model->message="cach is clean";
		  
			
		   return $this->render('ajaxv', [
         'model' => $model,
			]);
			 
		
	   
    }
	
		public function actionAddadmin() {
		$model = User::find()->where(['username' => 'admin'])->one();
		if (empty($model)) {
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@кодер.укр';
        $user->setPassword('admin');
		$user->phone="";
		$user->adress="";
        $user->generateAuthKey();
        if ($user->save()) {
            ///echo 'good';
				
				
			$this->layout = 'ajaxl';
             $modelajax= new AjaxModel;
			 $modelajax->message='good add admin';
				return $this->render('ajaxv', [
                'model' => $modelajax,
			]);
			
        }
		
		
		$this->layout = 'ajaxl';
             $modelajax= new AjaxModel;
			 $modelajax->message='admin is already added';
				return $this->render('ajaxv', [
                'model' => $modelajax,
			]);
			
		
		};
		
		
		
		return  'alex';
		}
	
	
	
	
	
	
		 public function actionUploadequantityprice() 
    {      
	
	
	       $model_admin=new AdminModel();
		   $model_admin->Uploadequantityprice();
		   
		   
		   
			$this->layout = 'ajaxl';	
		
		      Yii::$app->cache->flush();
		 
		      $model=new AjaxModel();
		  
		     $model->message="cach is clean  function Uploadequantityprice".$model_admin->message;
		  
			
		   return $this->render('ajaxv', [
         'model' => $model,
			]);
			 
		
		
	   
    }
	
	
	
	
	public function actionActivedeactivelemensection(){
		
	
           $model_admin=new AdminModel();
		   $model_admin->ActiveDeactivElemenSection();
		   
		   
		   
			$this->layout = 'ajaxl';	
		
		      Yii::$app->cache->flush();
		 
		      $model=new AjaxModel();
		  
		     $model->message="cach is clean  function Uploadequantityprice".$model_admin->message;
		  
			
		   return $this->render('ajaxv', [
         'model' => $model,
			]);
			 
		

	
	}
	
	
	
	
	
	
	
	
	
	
}
