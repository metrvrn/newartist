<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\caching\Cache;


/**
 * ContactForm is the model behind the contact form.
 */
class CatalogModelAdmin extends Model
{   
    
	//add element to bssket
	public $elementForAddToBasket;
    public $sessionForBasket;
	//public $userId;
	
	
	public $sectionNoParentArray;
	
	public $elementPerPage;	 
	public $quantityPageForCurSection;
	public $message;
	
    public  $section;
    public  $element;
    public  $page;
	
 
	
	private $id_tovar;///the main   grup  tovar;
	
	private $elementIdArray;
	//private $tableElements;
	
	
	public   $arrElements; 
	public   $arrElementsImage;
	public   $arrElementsImageDetail;
	public   $arrElementsPrice; 
	public   $arrElementsQuantity; 
	
    public   $arrSectioons;

	
	
	
	public   $TopArrCurSection; // we need for every request fo curient section
	public   $BottomArrCurSection; 
	//public   $BottomArrCurSectionArr;
	
	
    public  $arrPages;

   
    public function rules()
    {
        return [
       
          
		      [['title', 'element', 'page'], 'safe'],
		  
		  
		  
        ];
    }
	
	
	
	
	
			public function scenarios()
	{
			$scenarios['default'] = ['section', 'element', 'page'];
			
			return $scenarios;
	}
	
       
	   
	   
	   
	   
	   
          public   function fillElementIdArray(){
			  
		  $this->elementIdArray=[];
			  	
			  
			  if(isset($this->arrElements)){
				  
				  foreach($this->arrElements as  $element){
					  
					  $this->elementIdArray[]=$element['id'];
					  
					  
				  }
				  
				  
				  
				  
				  
				  
			  };
			  
			  
			  
		  }

		  public   function fillSectionNoParentArray(){
			  
			  $this->sectionNoParentArray=[];
			  
			  
			  $sectionsNoPar = Section::find()
				->where(['xmlcodep' =>'b17cf5b5-b563-11e5-8c42-74d435abdf35' ,'active'=>true])  
				 ->all();
				 
			  if($sectionsNoPar){
				  
				  
				  foreach($sectionsNoPar as $section ){
					  
					// $this->sectionNoParentArray[]=$section;
					
						$idArray=[];
					
						$idArray[ 'id']= $section->id;
						$idArray[ 'xmlcodep']= $section->xmlcodep;
						$idArray[ 'xmlcode']= $section->xmlcode;
						$idArray[ 'name']= $section->name;
						$idArray[ 'index1']= $section->index1;
						$idArray[ 'index2']= $section->index2;
						$idArray[ 'idp']= $section->idp;
						$idArray['visible']= false;		 
						$idArray[ 'childArray']= $this->makeTreeForSection($section);
						
					
					$this->sectionNoParentArray[]=$idArray;
					
					  
					  
					  
					  
				  }
			  }
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
		  }



		  
		  public function fillarrSectioons()
			{ //$mes='<br>fillarrSectioons  <br>';
				 
				 
					$this->arrSectioons = Yii::$app->cache->get("arrSectioons");
			          // $mes=$mes.' array'.$this->arrSectioons.' <br> ';

						if ($this->arrSectioons === false) {
				 
			
						$this->fillSectionNoParentArray();
						   
						     $this->arrSectioons= $this->sectionNoParentArray;
						  
						  
							
						  //Yii::$app->cache->set('arrSectioons', $this->arrSectioons);
				        }
				
				
				//$this->message=$this->message.$mes;
				
			}
			
			
			
			
			
            ///data for view arrElements 
		   public function fillarrElements()
			{ $this->arrElements=[];
				 //we need element only for our group
				 
				 $this->BottomArrCurSection[]=intval((trim($this->section)));
				 
				
				
		         $elements = Element::find()
				  ->where(['idp' =>$this->BottomArrCurSection ,'issection' =>false, 'active'=>1 ]) 
				 ->orderBy("name")				
				 ->offset( intval( $this->page*$this->elementPerPage))
				  ->limit(intval($this->elementPerPage))
				 //->where(['idp' =>ltrim(  $startCode )])
				 ->all();
				
				
				  
				
				foreach($elements as $element){
					$idArray=Array();
							//echo $element->id;
						
                         //we do not make the tree in this function
						// echo 'ffff <br>';
						$idArray[ 'id']= $element->id;
						$idArray[ 'name']= $element->name;
						$idArray[ 'index1']= $element->index1;
						$idArray[ 'index2']= $element->index2;
						$idArray[ 'idp']= $element->idp;
						
						
						$this->arrElements[]=$idArray;
				};
				
			
			
				
			}
 
         
		  
		  
		  
		  
		  
        public  function  makeTreeForSection ($sectionLocal)
		 {      
						
				 	
		           if(!isset($sectionLocal->xmlcode)){return;};
		  
		         $sections = Section::find()
				 ->where(['xmlcodep' =>$sectionLocal->xmlcode,'active'=>true])
				 ->all();
		  
		        
				 
				
				$mainArray=[];
				
				 
				   foreach($sections  as  $section ){
							 
						$idArray=[];
							
						//echo  $section->xmlcode.'<br>';

						$idArray[ 'id']= $section->id;
						$idArray[ 'xmlcodep']= $section->xmlcodep;
						$idArray[ 'xmlcode']= $section->xmlcode;
						$idArray[ 'name']= $section->name;
						$idArray[ 'index1']= $section->index1;
						$idArray[ 'index2']= $section->index2;
						$idArray[ 'idp']= $section->idp;
						$idArray['visible']= false;		 
						$idArray[ 'childArray']= $this->makeTreeForSection($section);
						
						$mainArray[]=$idArray;
                             
						//$this->message=$this->message.$section->id.'<br>';
								 
						  
					    };
				 
		   
			        
			
			
			
			
			
			return   $mainArray;
			
			
			
		 }
 
 
 
			public function findeSectionByCode($code){
				
				$mes="<br>findeSectionByCode    code =".$code.'  <br>   ';
				
				$rez=false;
				
				
				$section = Section::find()
                  ->where(['code' =>$code ])
                  ->one();
				
				
				if(isset($section)){
					$mes=$mes.'    finde id  <br>';
					$rez=$section->id;
					
					
					
					
				}else { $mes=$mes.'    on finde  id  <br>';    };
				
				 $mes=$mes.' rez='.$rez.'  <br>';
				
				$this->message=$this->message.$mes;
				
				return $rez;
			}
 
 
 
 
 
 
 
			public function fillTopArrCurSection(){
				
				///make  key for the section
				if (!isset($this->section)){
					$this->TopArrCurSection=[];
					return;								
					
				};
				
				
				
				$key="top_cur_section_array_".$this->section;
				
				
				$this->TopArrCurSection = Yii::$app->cache->get($key);
			          
             
						if ($this->TopArrCurSection === false) {
						
									 
									
									$this->getParentsForSection($this->section);
									
								
								
									   
									//$this->TopArrCurSection=$inArray;

									//Yii::$app->cache->set($key, $treeArray);
				        }
				
				
				
				
			}
 
             public function getParentsForSection($sectionId){
				 
				 
				 
				//$inArray=Array();
				 //it is curient section if we have the id we have the section
				// if(isset($sectionId)){  };
				 
				 //$this->TopArrCurSection[]=intval($sectionId) ;
				//echo($sectionId );
				 // return;
				 
				  $section = Section::find()
                  ->where(['id' =>$sectionId ])
                  ->one();
				  
				 if(!$section){return;};
				  
				  $this->TopArrCurSection[]=$sectionId ;
				  
			       $this->getParentsForSection($section->idp);
				 
				 
				// return $inArray; 
				 
				 
				 
			 }


		   public function fillBottomArrCurSection()
		   
		   {	///make  key for the section
				
				$key="botton_cur_section_array_".$this->section;
				
				 
				$this->BottomArrCurSection = Yii::$app->cache->get($key);
			      

						if ($this->BottomArrCurSection === false) {
						
									
									
									
									

									
                                       $this->getChildrenForSection($this->section);
									   
									   
									  // print_r($this->BottomArrCurSection);
									   
									//$this->BottomArrCurSection=$inArray;

									//Yii::$app->cache->set($key, $treeArray);
				        }
				
				
			   
			   
			   
			   
			   
			   
		   }
		   
  public function  getChildrenForSection($sectionId){
               
			   
				$this->BottomArrCurSection[]=intval($sectionId);
				
				
				 
				  $sections = Section::find()
                  ->where(['idp' =>$sectionId ])
                  ->all();
				  
				 if(!$sections){return;};
				  
				foreach($sections as $section ){
			
			
					
					$this->BottomArrCurSection[]=intval($section->id);
					$this->getChildrenForSection($section->id);
					
				};
				  
				  
				 
				 
				 return $childArray;
				 
				 
				 
			 }
   
   
  
  
 
     
	 

	  
	  
	  
	 
 public function fillQuantitypageforqurientsection(){
	

               $count = Element::find()//->where(['idp' =>$this->BottomArrCurSection  ])->count();
               ->where(['idp' =>$this->BottomArrCurSection ,'issection' =>false]) 
				// ->orderBy("name")				
				 //->offset(100)
				 // ->limit($this->elementPerPage)
				 //->where(['idp' =>ltrim(  $startCode )])
			
         ->count();
		 
		 
		 //echo $count.'alex';
		 //print_r ($this->BottomArrCurSection);
		 
		 
		   $this->message='quantitq = '.$count.'quantitq = ';
		   if(!$count){
			   
			   $this->quantityPageForCurSection=0;
		   }else{  $this->quantityPageForCurSection = ceil( $count/$this->elementPerPage);};
			   
	
	 //$this->quantityPageForCurSection= ceil(  $count/$this->elementPerPage);

	 //$this->quantityPageForCurSection= ceil(  $count/intval($this->elementPerPage));
	 
	 
 }
  


  
  	 
 public function getSectionNameById($id){
	

               $element = Section::find()
               ->where(['id' =>$id]) 
			   ->one();
		    if($element){
			return $element->name;};
 
	 
	 
 }
  
  
  
  public function addElementToBasket(){
	  
	  
	  
	  
	  
	  
	  
  }
  
  
  
  
  
  
  public function fillImageForElementArray(){
	  
	    $this->arrElementsImage=[];
		
		$this->arrElementsImageDetail=[];
	  
	  $elementid=[];
	  
	  foreach($this->arrElements as $element){
		   $elementid[]=$element['id'];
		  	  
	  }
	  // $elementid=$this->elementIdArray;
	  
	  
		if( count($elementid)>0 ){
				 
				  
				  
				 // $imageAr=[];
				  
				  
				  $images=Image::find()
				  ->where(['elementid'=>$elementid])
				  ->all();
				  
				  
					  if($images){
					           foreach($images as $image  ){
								  
								  $this->arrElementsImageDetail[$image['elementid']]=$image['filed'];
								  $this->arrElementsImage[$image['elementid']]=$image['filep'];
								   
								   
							   }
						 
					  
					  
					  
					  }
					  
				  
				   
				   
				   foreach($this->arrElements  as $key => $element){
					   
					   
					   if( isset(  $this->arrElementsImage[$element['id']])   ){  // $element['image']=
					   
					   $this->arrElements[$key]['image']=$this->arrElementsImage[$element['id']];
					   
					   $this->arrElements[$key]['imaged']=$this->arrElementsImageDetail[$element['id']];
					   
					   
					 //  echo $element['image'];
						   
					   }else{ //echo 'not';
						      $this->arrElements[$key]['image']='not';
						     $this->arrElements[$key]['imaged']='not';
						   
					   }
					   
					   
					   
				   }
			 
					  
					   
				  
					
			  }
			  
		
  
  }
  
  
  
  
  
   public function fillPriceForElementArray(){
	  
	    $this->arrElementsPrice=[];
	  
	  $elementid=[];
	  
	  foreach($this->arrElements as $element){
		   $elementid[]=$element['id'];
		  	  
	  }
	  
	  
	  
		if( count($elementid)>0 ){
				 
				  
				  
			
				  
				  
				  $prices=Price::find()
				  ->where(['elementid'=>$elementid])
				  ->all();
				  
				  
					  if($prices){

					 // print_r($elementid);
					  
					           foreach($prices as $price  ){
								  
								  $this->arrElementsPrice[$price['elementid']]=$price['price'];
								   
								   
							   }
						 
					  
					  
					  
					  }
					  
				  
				   
				   
				   foreach($this->arrElements  as $key => $element){
					   
					   
					   if( isset(  $this->arrElementsPrice[$element['id']])   ){  // $element['image']=
					   
					   $this->arrElements[$key]['price']=$this->arrElementsPrice[$element['id']];
					   
					   
					 //  echo $element['image'];
						   
					   }else{ //echo 'not';
						      $this->arrElements[$key]['price']='not';
						   
						   
					   }
					   
					   
					   
				   }
			 
					  
					   
				  
					
			  }
			  
		
  
  }
  
  

		  private function setVisibleHard(&$elementforHard){
		  
		  
		  $elementforHard['visible']=true;
		  
		  
	  }											 
	  private function setVisibleSectionAndChildren(&$elementArraySection){
	 	  
		//  echo 'аргумент id = '.$elementArraySection['id'].'  вход в функцию<br>';
		  
/* 	   if(array_search($elementArraySection['id'],$this->TopArrCurSection)){
			
			 		 	  echo 'установка визибле иф аргумент id = '.$elementArraySection['id'].'перед установкой <br>';  
			   $elementArraySection['visible']=true;
	    
	   
	   } */
	   
	   
	   $visible=false;
	   foreach($this->TopArrCurSection as $tarEl){
		   if($tarEl==$elementArraySection['id']){ //echo ' найден элемент в топарай '.$tarEl.' = '.$elementArraySection['id'].' <br>';
			     $visible=true;
				 break;
			   
			   
		   }
		   
	   }
	   
	   if($visible){  $elementArraySection['visible']=true;
	   
	   
	     if( count($elementArraySection['childArray'])>0){
				  
				  
			   foreach($elementArraySection['childArray'] as $keyHard=>$recArryaHard){
				   
				   $this->setVisibleHard($elementArraySection['childArray'][$keyHard]);
				   
			   }
		   }
	   
	   
	   
	   
	   
	   };
	   
	  
	  
	  if( count($elementArraySection['childArray'])>0){
		      
			  
			  foreach($elementArraySection['childArray'] as $key=>$recArrya){
			 
					 
			 $this->setVisibleSectionAndChildren($elementArraySection['childArray'][$key]);
			  
		  }
		  
		  
		  
	  }
	  
	  
	  
  }
  
  
  
  
  public function setVisibleForCurienSection(){
	   
			
			
		 
 
			if(isset($this->section)){ 
			
				foreach($this->arrSectioons  as $key=>  $section){							
							
					    $this->arrSectioons[$key]['visible']=true;
			
						
					}
				
			
			
			
			
				foreach($this->arrSectioons  as $key2=>$section){ 

				 		 
						$this->setVisibleSectionAndChildren($this->arrSectioons[$key2]);
				   
					  
			 
				}
			
			
			
			
			
			}else{
				
					foreach($this->arrSectioons  as $key=>  $section){							
							
					    $this->arrSectioons[$key]['visible']=true;
			
						
					}
				
			}
			
				//echo'<br>';echo'<br>';echo'<br>';
			//print_r($this->TopArrCurSection);
			//echo'<br>';echo'<br>';echo'<br>';
			
			//print_r($this->arrSectioons);
			
			
			
			}
		public function fillQuantityForElementArray(){
	  
	  
	  //echo'alex';
	  
	  
	    $this->arrElementsQuantity=[];
	  
	  $elementid=[];
	  
	  foreach($this->arrElements as $element){
		   $elementid[]=$element['id'];
		  	  
	  }
	  
	  
	  
		if( count($elementid)>0 ){
				 
				  
				  
			
				  
				  
				  $quantitys=Quantity::find()
				  ->where(['elementid'=>$elementid])
				  ->all();
				  
				  
					  if($quantitys){

					 // print_r($elementid);
					  
					           foreach($quantitys as $quantity  ){
								 // echo 'alex';
								  
								  
								  $this->arrElementsQuantity[$quantity['elementid']]=$quantity['quantity'];
								   
								   
							   }
						 
					  
					  
					  
					  }
					  
				  
				   
				   
				   foreach($this->arrElements  as $key => $element){
					   
					   
					   if( isset(  $this->arrElementsQuantity[$element['id']])   ){   
					   
					   $this->arrElements[$key]['quantity']=$this->arrElementsQuantity[$element['id']];
					   
					   
					 
						   
					   }else{ //echo 'not';
						      $this->arrElements[$key]['quantity']='not';
						   
						   
					   }
					   
					   
					   
				   }
			 
					  
					   
				  
					
			  }
			  
		
  
  }
  
}
