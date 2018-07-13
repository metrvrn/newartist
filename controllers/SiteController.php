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


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
		
		//$catalogModel->section=438;		
		//$catalogModel->fillQuantitypageforqurientsection();		   
	    // $catalogModel->fillarrElements();
		//$catalogModel->fillImageForElementArray();
		//$catalogModel->fillPriceForElementArray();		
		//echo 'CatalogModelAdmin';
		$catalogModel->setVisibleForCurienSection();
		
		
		
		
		
		
		
		
		
		
		
        return $this->render('index',['catalogModel' => $catalogModel,]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
		
		$catalogModel=new CatalogModel();
		 
		$catalogModel->elementPerPage=50;
	     $catalogModel->load(Yii::$app->request->get(),'');		
	    $catalogModel->fillarrSectioons(); 
		$catalogModel->fillTopArrCurSection();  
	    $catalogModel->fillBottomArrCurSection();
		
		//$catalogModel->section=438;		
		//$catalogModel->fillQuantitypageforqurientsection();		   
	    // $catalogModel->fillarrElements();
		//$catalogModel->fillImageForElementArray();
		//$catalogModel->fillPriceForElementArray();		
		//echo 'CatalogModelAdmin';
		$catalogModel->setVisibleForCurienSection();
		
		
		
		
		
		
		
		
		
		
		
		
		
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
         
		   
		   
		   $model = new LoginForm();
		   
		   
		                     $session = Yii::$app->session;
							if ($session->isActive){ 

								 	$model->oldsession=$session ->getId();
                                  
							};
		
       
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			//
			$model->addOldSessionForUser();
			$model->addCurientSessionForUser();
			
			
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,'catalogModel' => $catalogModel,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
		
		$catalogModel=new CatalogModel();
		 
		$catalogModel->elementPerPage=50;
	     $catalogModel->load(Yii::$app->request->get(),'');		
	    $catalogModel->fillarrSectioons(); 
		$catalogModel->fillTopArrCurSection();  
	    $catalogModel->fillBottomArrCurSection();
		
		//$catalogModel->section=438;		
		//$catalogModel->fillQuantitypageforqurientsection();		   
	    // $catalogModel->fillarrElements();
		//$catalogModel->fillImageForElementArray();
		//$catalogModel->fillPriceForElementArray();		
		//echo 'CatalogModelAdmin';
		$catalogModel->setVisibleForCurienSection();
		
		
		
		
		
		
		
		
		
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,'catalogModel' => $catalogModel,
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
	
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
		$catalogModel=new CatalogModel();
		 
		$catalogModel->elementPerPage=50;
	     $catalogModel->load(Yii::$app->request->get(),'');		
	    $catalogModel->fillarrSectioons(); 
		$catalogModel->fillTopArrCurSection();  
	    $catalogModel->fillBottomArrCurSection();
		
		//$catalogModel->section=438;		
		//$catalogModel->fillQuantitypageforqurientsection();		   
	    // $catalogModel->fillarrElements();
		//$catalogModel->fillImageForElementArray();
		//$catalogModel->fillPriceForElementArray();		
		//echo 'CatalogModelAdmin';
		$catalogModel->setVisibleForCurienSection();
		
		
		
		
		
		
		
		
		
		
		
		
		
        return $this->render('about',['catalogModel' => $catalogModel,]);
    }
	
	
 
   
 
    public function actionSignup()
    {
		$catalogModel=new CatalogModel();
		 
		$catalogModel->elementPerPage=50;
	     $catalogModel->load(Yii::$app->request->get(),'');		
	    $catalogModel->fillarrSectioons(); 
		$catalogModel->fillTopArrCurSection();  
	    $catalogModel->fillBottomArrCurSection();
		
		//$catalogModel->section=438;		
		//$catalogModel->fillQuantitypageforqurientsection();		   
	    // $catalogModel->fillarrElements();
		//$catalogModel->fillImageForElementArray();
		//$catalogModel->fillPriceForElementArray();		
		//echo 'CatalogModelAdmin';
		$catalogModel->setVisibleForCurienSection();
		
		
		
		
		
		
		
		
		
		
        $model = new SignupForm();
 
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
 
        return $this->render('signup', [
            'model' => $model,'catalogModel' => $catalogModel,
        ]);
    }
 

 

	
	
	
	
	    public function actionRequestpasswordreset()
    {
		$catalogModel=new CatalogModel();
		 
		$catalogModel->elementPerPage=50;
	     $catalogModel->load(Yii::$app->request->get(),'');		
	    $catalogModel->fillarrSectioons(); 
		$catalogModel->fillTopArrCurSection();  
	    $catalogModel->fillBottomArrCurSection();
		
		//$catalogModel->section=438;		
		//$catalogModel->fillQuantitypageforqurientsection();		   
	    // $catalogModel->fillarrElements();
		//$catalogModel->fillImageForElementArray();
		//$catalogModel->fillPriceForElementArray();		
		//echo 'CatalogModelAdmin';
		$catalogModel->setVisibleForCurienSection();
		
		
		
		
        $model = new PasswordResetRequestForm();
 
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
 
        return $this->render('requestPasswordResetToken', [
            'model' => $model,'catalogModel' => $catalogModel,
        ]);
    }
 
    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    { 	$catalogModel=new CatalogModel();
		 
		$catalogModel->elementPerPage=50;
	     $catalogModel->load(Yii::$app->request->get(),'');		
	    $catalogModel->fillarrSectioons(); 
		$catalogModel->fillTopArrCurSection();  
	    $catalogModel->fillBottomArrCurSection();
		
		//$catalogModel->section=438;		
		//$catalogModel->fillQuantitypageforqurientsection();		   
	    // $catalogModel->fillarrElements();
		//$catalogModel->fillImageForElementArray();
		//$catalogModel->fillPriceForElementArray();		
		//echo 'CatalogModelAdmin';
		$catalogModel->setVisibleForCurienSection();
		
		
		
		
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
 
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }
 
        return $this->render('resetPassword', [
            'model' => $model,'catalogModel' => $catalogModel,
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
		
		//$catalogModel->section=438;		
		//$catalogModel->fillQuantitypageforqurientsection();		   
	    // $catalogModel->fillarrElements();
		//$catalogModel->fillImageForElementArray();
		//$catalogModel->fillPriceForElementArray();		
		//echo 'CatalogModelAdmin';
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
	
	 public function actionZakaz()
    {
		
		
		$catalogModel=new CatalogModel();
		 
		$catalogModel->elementPerPage=50;
	     $catalogModel->load(Yii::$app->request->get(),'');		
	    $catalogModel->fillarrSectioons(); 
		$catalogModel->fillTopArrCurSection();  
	    $catalogModel->fillBottomArrCurSection();
		
		//$catalogModel->section=438;		
		//$catalogModel->fillQuantitypageforqurientsection();		   
	    // $catalogModel->fillarrElements();
		//$catalogModel->fillImageForElementArray();
		//$catalogModel->fillPriceForElementArray();		
		//echo 'CatalogModelAdmin';
		$catalogModel->setVisibleForCurienSection();
		
		 $modelBasket= new BasketModel();	 
          $modelZakazForm= new ZakazForm();	
		
		 $model= new ZakazModel();	  
		  
			
		   return $this->render('zakaz', [
         'model' => $model,
		 	 'catalogModel' => $catalogModel,
			]);
			
		
	   
    }
	
	
	 
	/////clear  cach yii\caching\Cache::flush().
	
	
	
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
	
	
	
	
	
	
	
	
	
}
