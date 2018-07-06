<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Element;
use app\models\Section;
use app\models\Quantity;
use app\models\Price;
use app\models\Image;

/**
 * ContactForm is the model behind the contact form.
 loade element table
 
 after make section table
 after fill idp in section table
 
 
 
 */
class AdminModel extends Model
{
    public $message;
	
	public $mainParentsArray;
	
    


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

				 $el->issection =ltrim($ar[10]); 				

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
						 
						 //if($count==300){break;};
						 
						   
						   if(ltrim($ar[10])==1){  

	                         $this->procceccArrayOfStingFromFile($ar);

						   };
						 
					
						 
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
		 
		 
		 $this->MakeSections();
		 
		 
		 $this->fillidpInSectionTable();
		 
		 
		  //$this->message=$this->message.$mes;
		 
		 
		 
		 
     }
	
	
	public function procceccElementForSection($el){
			$mes=$el->code ;
		
			$section = Section::find()
			->where(['code' =>ltrim(  $el->code  )])
			->one();
	
	if(!$section){
		
		$section=new Section();
		     
			 $section->id= $el->id;
			 $section->name= $el->name;
			 $section->code= $el->code;
			 $section->xmlcode=$el->xmlcode;
			  $section->xmlcodep=$el->xmlcodep;
			 $section->active=$el->active;
			 $section->idp =$el->idp ;
			 $section->codep =$el->codep;
			 
			// $el->quantity ='0';
		     $section->issection = $el->issection;
			 $section->index1 = $el->index1;
			 $section->index2 =$el->index2;
			 
		    $section->save();
		
		
	};
		
		//  $this->message=$this->message.$mes;
		
	}
	
	
	
	 public function MakeSections()
     {   $mes="MakeSections<br>";
	 
	 
	 
    //     	$elements = Element::find()
	//		//->where( ['issection' =>ltrim('Да')])
   // ->all();
	
	$elements = Element::find()
	->where( ['issection' =>'1'])
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
	 
	
	 
	
	
	 public function fillidpInSectionTable()
     {   
	 
	 
	     $mes="fillidpInSectionTable<br>"; 
	 
	 
	  
	 
	 
		$sections = Section::find()
        //  ->where(['code' =>ltrim(  $el->code  )])
         ->all();
	
	     //array
		foreach($sections  as  $section ){
			

			//$mes=$mes."  we finde <br>".$section->codep;
			
			if(isset($section->xmlcodep)){
				
		
				
				$sectionsp = Section::find()
                 ->where(['xmlcode' =>$section->xmlcodep])
                 ->one();
				 
				 if(isset($sectionsp)){
					 
					 
					 //$mes=$mes."  we finde <br>";
					 
					 $section->idp=$sectionsp->id;
					 
					 $section->save();
					 
				 };
				
				
				
			};
			
			 // $this->message=$this->message.$mes;
		
			
		}
			
	 
		$elements = Element::find()
        //  ->where(['issection' =>1, 'idp'=>null])	  
         ->all();
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	  $mes=$mes."fillidpInSectionTable    elements<br>"; 
	     //array
		foreach($elements  as  $element ){
			
		 	//if(!isset($element->xmlcodep)){continue;};
				 

				 $mes=$mes.$element->xmlcodep."  element <br>";
 
				 $sectionsp = Section::find()
                 ->where(['xmlcode' =>$element->xmlcodep])
                 ->one();
				 
				 
				
				  if(isset($sectionsp)){
					  
					   $mes=$mes.$sectionsp->id."  section <br>";
				 
					 
					
					 
					 $element->idp=$sectionsp->id;
					 
					 $element->save();
					  /*	
		             */	

					 };
				
				
			
			};
			
			
			 
			
	 
	 
	 
	 
	 
	  $this->message=$this->message.$mes;
	 }
	

	
	
	private function procceccArrayOfStingFromFileArtist($ar){
		
		
		
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

				 $el->issection =ltrim($ar[10]); 				

				$el->save();
		
		
	};
		
		
	}
	
	 public function Uploadenomartist()
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
									 
										 $this->procceccArrayOfStingFromFileArtist($ar); 

									  $mes=$mes.'  '.$ar[0].'<br>';    
									 
									
									 }
								   }
								  else $mes="Ошибка при открытии файла";
								  
								  
								  fclose($fp);
					 
					 
					 $this->MakeSections();
					 
					 
					 $this->fillidpInSectionTable();
					 
					 
					  $this->message=$this->message.$mes;
					 
		 
		 
		 
     }
	
	  
	
	 public function Uploadequantityprice()
     {
									  $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/upload/1cquantity.csv', "r"); // Открываем файл в режиме чтения
									
									
									$count=0;
									$mes="";

									 if ($fp) 
									  {$mes='Uploadequantityprice'.'<br>';
										 while (!feof($fp))
										 {      $count=$count+1; //if($count==20){break;};
										 $mytext = fgets($fp, 999);
										 
									
										 $ar=str_getcsv($mytext,";");
										 
											 $this->procceccArrayOfStingFromFileQuantityPrice($ar);

											$mes=$mes.'  '.$ar[2].'<br>'; 
											$mes=$mes.'  '.$ar[9].'<br>'; 
											$mes=$mes.'  '.$ar[10].'<br>'; 
											$mes=$mes.'  '.$ar[11].'11<br>'; 						  
											 $mes=$mes.'  '.$ar[12].'12<br>'; 		
										
										 }
									   }
									  else $mes=$mes."Ошибка при открытии файла";
									  
									  
									  fclose($fp);
						 
						 
						
						
						 
						 
						  $this->message=$this->message.$mes;
		 
		 
		 
		 
     }
	
	
		 public function procceccArrayOfStingFromFileQuantityPrice($ar)
		 {
								 $mes='procceccArrayOfStingFromFileQuantityPrice<br>'.$ar[12].'<br>';
								 
								 
									$element = Element::find()
									->where(['xmlcode' =>ltrim($ar[2])]) 
									->one();
									
									if($element){
									 $mes=$mes.'finde element<br>';
									 
									$quantity=Quantity::find()
									->where(['elementid' =>$element->id])
									 ->one();
										 // quantity 
										 if($quantity){
											  // $mes=$mes.'finde quantity<br>';
											 $quantity->quantity=floatval( str_replace(',','.',$ar[14]));
											  $quantity->save();
											 
										 }else{
											  // $mes=$mes.'make quantity<br>';
											 $quantity=new Quantity();
											 $quantity->elementid=$element->id;						 
											 $quantity->type=1;
											  $quantity->quantity=floatval(str_replace(',','.',$ar[14]));
											   $quantity->save();
											 
										 }
										 
												//   price
											$price=Price::find()
											->where(['elementid' =>$element->id])
											->one();
											 if($price){
														//$mes=$mes.'finde price'.$ar[10].'<br>';
														$price->price=floatval(str_replace(',','.',$ar[12]));
														$price->type=2;
														$price->save();

														//$mes=$mes.' 10 '.$ar[11].' 11 '.$ar[12];

														}else{
																//$mes=$mes.'make price'.$ar[12].'<br>';
																$price=new Price();
																$price->elementid=$element->id;						 
																$price->type=2;
																$price->price=floatval(str_replace(',','.',$ar[12]));
																$price->save();
																//  $mes=$mes.' 10 '.$ar[11].' 11 '.$ar[12].;

																}
										 
										 
										 
														 
							
									};
								 
								 
								 
								 
								 $this->message=$this->message.$mes;
			 
		 }
	 
	 
	 
				  private function addEmtyChildren($section){
					  
					  $childrens=Section::find()
				     ->where(['xmlcodep' =>$section->xmlcode, ])
				     ->all();
					 
					 
						foreach($childrens as $children){
							
							
							$quantityChildren=Element::find()
							->where(['xmlcodep' =>$children-xmlcode, ])
							->count();
							
							if($quantityChildren>0){}else{$this->mainParentsArray[]=$children->xmlcode;}
							
						}
						
						foreach($childrens as $children){
							
							
						//this->addEmtyChildren($children);
							
						}
						
						
						
							
					  
					  
					  
					  
				  }
				  
				  
	           public function FillmainParentsArray(){
				   $this->mainParentsArray=[];
				   
				   $sectionsTop=Section::find()
				   ->where(['xmlcodep' =>null,'issection' =>1])
				   ->all();
				   if($sectionsTop){
					   
					   foreach($sectionsTop as $section){
						   
						   
						   $this->addEmtyChildren($section);
						   
						   
					   }
					   
					   
					   
				   }
				   
				   
				   
				   
			   }
	 
			   public function ActiveDeactivElemenSection(){
				   
							   $mes='ActiveDeactivElemenSection';
							   
							   $this->FillmainParentsArray();
							   
							   
								 Yii::$app->db->createCommand('UPDATE element SET indexp=1')
								->execute();			   
							   
							   
							   
							   
							   
							 $quantity=Quantity::find()
							 ->where(['quantity' =>0])
							 ->all();
							   
							   
							   if($quantity){
									
								   foreach($quantity as $quan){  // $mes=$mes.$quan['id'].'  <br>';
										
										$element = Element::find()
										->where(['id' =>$quan->elementid])
										->one();
										
										if($element){   $mes=$mes.$element['id'].'  <br>';
											
											$element->indexp=0;
											$element->save();
											
											
										}
																 
								   }
								  
							   }
							 
							   
							   ///finde first parent to zero!!!
							   
							   $arrayMainParent=[];
									$elements_indexp = Element::find()
										->where(['issection' =>0,])
										->all();
										
										
										if($elements_indexp){ 
										
										 foreach( $elements_indexp as $element_){  $mes=$mes.$element_->xmlcodep.'make array arrayMainParent <br>';
											 
											 $arrayMainParent[]= $element_->xmlcodep;
																									 
											};
																 
											
										}
							   
							   
							   
							   
							   
							   
							   
									$elements = Element::find()
										->where(['xmlcode' =>$arrayMainParent,])
										->all();
							 
			 
									  if($elements){ 
												
												 foreach( $elements as $element){  $mes=$mes.$element['id'].'in to recursion <br>';
													 
													
													$this->deactiveParetnsElement($element);
													
																											 
													}
																		 
													
												}
										
								
								
										
										
										
										
							   
								 $this->message=$this->message.$mes;
				   
			   }
	   
	   
	   
			private function deactiveParetnsElement($element){   ///recursion
	                      
						  	   $this->message=$this->message.$element->id.'deactiveParetnsElement<br>';
						  
						  //all elemen have the 1 or 0 in indexp 
						  
						  $childrens=Element::find()
						  ->where(['xmlcodep' =>$element->xmlcode, 'indexp' =>1 ])
						  ->all();
						  
						  if($childrens){ $this->message=$this->message.'have children<br>'; return;}
						  
						                else{  $this->message=$this->message.' do not have children<br>';
								  
											$element=Element::find()
											->where(['xmlcode' =>$element->xmlcode])
											->one();

											if($element){

												$element->indexp=0;
												$element->save();

											} else{		return;			}
										}
						   
						   //if paren have active children then not to deactive
						   
						   if(isset($element->xmlcodep)){
							   
							$parent=Element::find()
						    ->where(['xmlcode' =>$element->xmlcodep,'indexp'=>1])						  
						   ->one(); 
						   if($parent){

								$this->deactiveParetnsElement($parent);
						   }
							   
						   }
						   
						    
	 
						
   
	   
				}
	  
	 //SetImageForElement
	 
		public  function SetImageForElementsFromFile(){   
	               $mes='SetImageForElementsFromFile';       
						 
	  
	  
	  
					  $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/upload/filecsv.csv', "r"); // Открываем файл в режиме чтения
					
					
					$count=0;
					$mes="";

					 if ($fp) 
					  {   //$mes='Uploadequantityprice'.'<br>';
						 while (!feof($fp))
						 {      $count=$count+1; //if($count==20){break;};
						 $mytext = fgets($fp, 999);
						 
					
						 $ar=str_getcsv($mytext,";");
						 
	                         $this->procceccArrayOfStingFromFileImageFile($ar);

						   //   $mes=$mes.'  '.$ar[12].'12<br>'; 		
						
						 }
					   }
					  else $mes=$mes."Ошибка при открытии файла";
					  
					  
					  fclose($fp);
		 
		 
		
		
		 
		 
					$this->message=$this->message.$mes;
	  
	   
	   
	   
				}
	
	
				private function  procceccArrayOfStingFromFileImageFile($ar){
					
					$mes= 'procceccArrayOfStingFromFileImageFile<br>';
					
					
					$element=Element::find()
						 ->where(['xmlcode' =>trim($ar[1]),])
						 ->one();
					
					
					if($element){//$mes=$mes.'find element<br>';
						
						 ///finde image for element by type
						 
						 $image=Image::find()
					     ->where(['elementid' =>$element->id,])
						 ->one();
						 
						 if($image){$mes=$mes.'finde image<br>';
							 
							 $image->filed=trim($ar[2]);
							  $image->filep=trim($ar[3]);
							    $image->save();
							 
						 }else{$mes=$mes.'make image<br>';
							
							$image=new Image();
								 $image->elementid=$element->id;
							 $image->filed=trim($ar[2]);
							  $image->filep=trim($ar[3]);
							 
							  $image->save();
							 
						 }
					 
						
					}
					
					
					
					
					 $this->message=$this->message.$mes;	
					
				}
	
	
	
	
	
	
	
	
     
}


