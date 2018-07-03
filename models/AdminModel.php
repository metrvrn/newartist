<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Element;
use app\models\Section;

/**
 * ContactForm is the model behind the contact form.
 loade element table
 
 after make section table
 after fill idp in section table
 
 
 
 */
class AdminModel extends Model
{
    public $message;
	
    


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
           // [['section', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['message'],
            // verifyCode needs to be entered correctly
           // ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
     public function attributeLabels()
     {
         return [
             'message' => 'Verification Code',
         ];
     }

    
	private function procceccArrayOfStingFromFile($ar){
		
		
		
		$element = Element::find()
    ->where(['xmlcode' =>ltrim($ar[2])])
    ->one();
	
	if(!$element){
		
		$el=new Element();
		   
			 $el->code=ltrim($ar[0]);
			 $el->xmlcode=ltrim($ar[2]);;
			   $el->name= ltrim($ar[4]);
			  $el->artikul=ltrim($ar[6]);;
			    $el->xmlcodep =ltrim($ar[8]);
			  
			 $el->active=true;//ltrim($ar[3]);
			  //$el->idp ='';
			
			 
			 $el->quantity =0;
			 
			 //$isSection=ltrim($ar[10]);
			 //if($isSection=="Нет"){
				 $el->issection =ltrim($ar[10]); 
				// }else{
					// $el->issection=true; 
					 
					// }
					 
			
			
			 
			 //$el->issection =ltrim($ar[3]);
			 //$el->index1 ="";
			 //$el->index2 ="";
			// $el->active ="";
		$el->save();
		
		
	};
		
		
	}
	
	//we process the file from server  file is in csv file format 
	//every string of file must heve next column name  
     //Наименование	   Код  	Артикул	  'Это группа'	'Входит в группу'	'Код'	'Номенклатурная группа'	'Код'
	 
	 
	
	 public function Uploadenom()
     {
					  $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/upload/1c.csv', "r"); // Открываем файл в режиме чтения
					
					
					$count=0;
					$mes="";

					 if ($fp) 
					  {$mes='file is '.'<br>';
						 while (!feof($fp))
						 {      $count=$count+1; //if($count==20){break;};
						 $mytext = fgets($fp, 999);
						 
					
						 
						 
						 $ar=str_getcsv($mytext,";");
						 
						// print_r($ar);
						 
						 if($count==300){break;};
						 
						 $this->procceccArrayOfStingFromFile($ar);
						 
						 	// $mes=$mes.$mytext.$count.'  '.$ar[1].'<br>';       
						  $mes=$mes.'  '.$ar[0].'<br>';    
						 
						  //$inc=0;
						  //$imes='';
						 // foreach(   $ar  as $t=>$r ){  $mes=$mes.'  '.$r.'  '.' = '.$t.' ';     };
						 
						 
						 ///$mes=$mes.$count."<br />";
						 }
					   }
					  else $mes="Ошибка при открытии файла";
					  
					  
					  fclose($fp);
		 
		 
		 //$this->MakeSections();
		 
		 
		 //$this->fillidpInSectionTable();
		 
	
	
		 
		  $this->message=$this->message.$mes;
		 
		 
		 
		 
     }
	
	
	public function procceccElementForSection($el){
			$mes=$el->code ;
		
			$section = Section::find()
    ->where(['code' =>ltrim(  $el->code  )])
    ->one();
	
	if(!$section){
		
		$section=new Section();
		   $section->name= $el->name;
			 $section->code= $el->code;
			 $section->xmlcode=$el->xmlcode;
			 $section->active=$el->active;
			  $section->idp =$el->idp ;
			  $section->codep =$el->codep;
			 
			// $el->quantity ='0';
		     $section->issection = $el->issection;
			 $section->index1 = $el->index1;
			 $section->index2 =$el->index2;
			 
		$section->save();
		
		
	};
		
		  $this->message=$this->message.$mes;
		
	}
	
	
	
	 public function MakeSections()
     {   $mes="MakeSections<br>";
	 
	 
	 
    //     	$elements = Element::find()
	//		//->where( ['issection' =>ltrim('Да')])
   // ->all();
	
	$elements = Element::find()
	->where( ['issection' =>true])
    ->indexBy('id')
    ->all();
	
	
	if(isset($elements)){
		
		$counter=0;
		 foreach($elements  as $k=>$element)
		 {
			 
	   $counter=$counter+1;
		 
		 $this->procceccElementForSection($element);
	 
		
		$mes=$mes.$counter.$element->code.'<br>';//    .$$element->code.'<br>';
		
		
	};
		
		 
		 
		
		 
     }
	  $this->message=$this->message.$mes;
	 }
	 
	
	////fillidpInSectionTable
	
	
	
	
	
	 public function fillidpInSectionTable()
     {   
	 
	 
	     $mes="fillidpInSectionTable<br>"; 
	 
	 
	  
	 
	 
		$sections = Section::find()
        //  ->where(['code' =>ltrim(  $el->code  )])
         ->all();
	
	     //array
		foreach($sections  as  $section ){
			

			$mes=$mes."  we finde <br>".$section->codep;
			
			if(isset($section->codep)){
				
		
				
				$sectionsp = Section::find()
                 ->where(['code' =>$section->codep])
                 ->one();
				 
				 if(isset($sectionsp)){
					 
					 
					 //$mes=$mes."  we finde <br>";
					 
					 $section->idp=$sectionsp->id;
					 
					 $section->save();
					 
				 };
				
				
				
			};
			
			  $this->message=$this->message.$mes;
		
			
		}
			
	 
		$elements = Element::find()
          ->where(['issection' =>false])	  
         ->all();
	
	     //array
		foreach($elements  as  $element ){
			
		//	if(isset($element->codep)){
				
				$sectionsp = Section::find()
                 ->where(['code' =>$element->codep])
                 ->one();
				 
				//if(isset($sectionsp)){
					 
					 
					// $mes=$mes."  we finde <br>";
					 
					 $element->idp=$sectionsp->id;
					 
					 $element->save();
					 
			// };
				
				
				
			};
			
			
			
			
			
			
			
			
			
			
			//$mes=$mes."   idp ".$section->codep.'  <br>';
			//we have the one section class.
			
			
			
			
		//};
		
		
	
		
   
	 
	 
	 
	 
	  $this->message=$this->message.$mes;
	 }
	

	
	
     
}


