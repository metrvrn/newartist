<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\caching\Cache;
use app\models\LokalFileModel;



/**
* ContactForm is the model behind the contact form.
*/
class CatalogModel extends Model
{   
	
	//add element to bssket
	public $elementForAddToBasket;
	public $sessionForBasket;
	public $userId;

	public $viewType;//table   cart
	
	
	
	public $sectionNoParentArray;
	
	public $elementPerPage;	 
	public $quantityPageForCurSection;
	public $message;
	
	public  $section;
	public  $element;
	public  $page;
	public  $view;
	
	
	public  $sectionXmlCode;
	public  $elementXmlCode;
	

	
	private $id_tovar;///the main   grup  tovar;
	
    public $arrPropery;

	
	
	public   $arrElements; 
	public   $arrElementsImage;
	public   $arrElementsImageDetail;
	public   $arrElementsPrice; 
	public   $arrElementsQuantity; 
	
	
	public $arrayDataForCurientElement;
	
	public   $arrSectioons;
	public   $TopArrCurSection;  
	public   $BottomArrCurSection; 

	public   $TopArrCurSectionXmlCode;  
	public   $BottomArrCurSectionXmlCode; 
	
	
	public  $arrPages;


	public function rules()
	{
		return [
		
		
		[['section', 'element', 'page','view'], 'safe'],
		
		
		
		];
	}
	
	
	
	
	
	public function scenarios()
	{
		$scenarios['default'] = ['section', 'element', 'page', 'view'];
		
		return $scenarios;
	}
	



	public   function fillSectionNoParentArray(){
		
		$this->sectionNoParentArray=[];
		
		
		$sectionsNoPar = Section::find()
		->where(['xmlcodep' =>LokalFileModel::getDataByKeyFromLocalfile('local_data_section_xmlcode') ,'active'=>true])  
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

	
	public function fillarrSectioons()
	{ //$mes='<br>fillarrSectioons  <br>';
		
		
		$this->arrSectioons = Yii::$app->cache->get("arrSectioons");
		// $mes=$mes.' array'.$this->arrSectioons.' <br> ';

		if ($this->arrSectioons === false) {
			
			
			$this->fillSectionNoParentArray();
			
			$this->arrSectioons= $this->sectionNoParentArray;
			
			
			
			//Yii::$app->cache->set('arrSectioons', $treeArray);
		}
		
		
		//$this->message=$this->message.$mes;
		
	}
	
	
	
	
	
	///data for view arrElements 
	public function fillarrElements()
	{ $this->arrElements=[];
		//we need element only for our group
		
		// $this->BottomArrCurSection[]=intval((trim($this->section)));
		$this->BottomArrCurSectionXmlCode=[];
		
		$sections=Section::find()
		->where(['id'=>$this->BottomArrCurSection])
		->all();
		
		
		
		if($sections){
			
			foreach($sections as $section){
				$this->BottomArrCurSectionXmlCode[]= $section->xmlcode; 
				
				
			}
			
		}
		
		
		////differnt way for one and no one
		
		if(isset($this->element)&&($this->element!=='non')){
			
		$elements = Element::find()
		->where(['xmlcode' =>$this->elementXmlCode,'issection' =>false, 'active'=>1 ]) 
		->orderBy("name")				
		->offset( intval( $this->page*$this->elementPerPage))
		->limit(intval($this->elementPerPage))
		//->where(['idp' =>ltrim(  $startCode )])
		->all();
			
			
		}else{
			
		
		
		$elements = Element::find()
		->where(['xmlcodep' =>$this->BottomArrCurSectionXmlCode ,'issection' =>false, 'active'=>1 ]) 
		->orderBy("name")				
		->offset( intval( $this->page*$this->elementPerPage))
		->limit(intval($this->elementPerPage))
		//->where(['idp' =>ltrim(  $startCode )])
		->all();
		
		
		}
		
		foreach($elements as $element){
			$idArray=Array();
			//echo $element->id;
			
			//we do not make the tree in this function
			// echo 'ffff <br>';
			$idArray[ 'id']= $element->id;
			$idArray[ 'name']= $element->name;
			$idArray[ 'code']= $element->code;
			$idArray[ 'index1']= $element->index1;
			$idArray[ 'index2']= $element->index2;
			$idArray[ 'idp']= $element->idp;
			
			
			$this->arrElements[]=$idArray;
		};
		
		
		
		
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
		
		$this->TopArrCurSection=[];	
		
		
		if (!isset($this->section)){
			
			return;								
			
		};
		if ($this->section=='non'){
			
			return;								
			
		};
		
		
		
		///make  key for the section
		$key="top_cur_section_array_".$this->section;
		
		
		$this->TopArrCurSection = Yii::$app->cache->get($key);
		
		
		if ($this->TopArrCurSection === false) {
			
			
			
			$this->getParentsForSection($this->section);
			
			
			
			
			//$this->TopArrCurSection=$inArray;

			//Yii::$app->cache->set($key, $treeArray);
		}
		
		
		
		
	}

	private function getParentsForSection($sectionId){
		
		
		
		$section = Section::find()
		->where(['id' =>$sectionId ])
		->one();
		
		if(!$section){return;};
		
		$this->TopArrCurSection[]=$sectionId ;
		
		$this->getParentsForSection($section->idp);
		
		
		
		
		
		
	}


	public function fillBottomArrCurSection()
	
	{	
		$this->BottomArrCurSection=[];	
		
		
		if (!isset($this->section)){
			
			$this->section='non';								
			
		};
		
		
		///make  key for the section
		
		
		
		
		$key="botton_cur_section_array_".$this->section;
		
		
		$this->BottomArrCurSection = Yii::$app->cache->get($key);
		

		if ($this->BottomArrCurSection === false) {
			
			
			
			
			if ($this->section=='non'){
				
				
				//echo 'non';
				$sections=Section::find()
				->where(['active'=>1])
				->all();
				
				if($sections){
					
					
					foreach($sections as $section){
						
						$this->BottomArrCurSection[]=$section['id'];
						
					}
					
					
					
				}

				
				//$this->BottomArrCurSection=$inArray;

				//Yii::$app->cache->set($key, $treeArray);		
				
				
				return;
			};
			

			
			$this->getChildrenForSection($this->section);
			
			
			
			
			
			
			
			//$this->BottomArrCurSection=$inArray;

			//Yii::$app->cache->set($key, $this->BottomArrCurSection);
		}
		
		
		
		
		
		
		
		
	}
	
	private function  getChildrenForSection($sectionId){
		
		
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
		

		//we need  ather array. TopArrCurSectionXmlCode


		$this->BottomArrCurSection[]=intval((trim($this->section)));

		$this->BottomArrCurSectionXmlCode=[];
		
		$sections=Section::find()
		->where(['id'=>$this->BottomArrCurSection])
		->all();
		
		
		
		if($sections){
			
			foreach($sections as $section){
				$this->BottomArrCurSectionXmlCode[]= $section->xmlcode; 
				
				
			}
			
		}
		
		$count = Element::find()
		->where(['xmlcodep' =>$this->BottomArrCurSectionXmlCode ,'issection' =>false, 'active'=>1 ,]) 
		->count();
		
		
		
		
		if(!$count){  
			
			
			$this->quantityPageForCurSection=0;
		}else{  $this->quantityPageForCurSection = ceil( $count/$this->elementPerPage);};
		
		
		
		
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
		
		
		//echo 'setVisibleForCurienSection<br>';
		//return;
		

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

	public function getSectionNameById($id){
		
		$element = Section::find()
		->where(['id' =>$id]) 
		->one();
		if($element){
			return $element->name;};

		
		
	}

	
	
	
	public function setSectionIdForCurientElement(){
		
	$element=Element::find()
	->where(['id'=>$this->element])
	->one();
	if($element){
		
		  $this->elementXmlCode=$element->xmlcode;
			 
		
		
		
		$section=Section::find()
	    ->where(['xmlcode'=>$element->xmlcodep])
		->one();
		
		
		if($section){
			
			$this->sectionXmlCode=$section->xmlcode;
			$this->section=$section->id;
			
		}
		
		
		
	}
	
	
		
	}
	

	
	
	
     public function fillArrProperyMetr(){
		 $key='arrProperyMetr';
		 
		 	$this->arrPropery = Yii::$app->cache->get($key);
 

		if ($this->arrPropery === false) {
			
			
            $this->arrPropery=[];
			  
				//
					//$url = 'https://metropt.ru/test/metr/newartist/newartistprop.php'; 
					
					$url=LokalFileModel::getDataByKeyFromLocalfile('local_data_property_array_site');
					if($curl = curl_init()) { 
					curl_setopt($curl,CURLOPT_URL, $url); 
					curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
					curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
					curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,30); 
					curl_setopt($curl,CURLOPT_USERAGENT,'Bot 5555.0');
					$html = curl_exec($curl);
					curl_close($curl);
					}
					
					 
					
					$arrProp=json_decode($html); 
					 
				//print_r($arrProp);
				//echo '<br>';
				if(count($arrProp)>0){
					
					 foreach($arrProp as $prop){
					   $intArray=[];
					   $intArray['NAME']=$prop->NAME;
					   $intArray['CODE']=$prop->CODE;
					   $intArray['ID']=$prop->ID;
					 
					 
					  $this->arrPropery[$prop->ID]= $intArray;
					 
					
				     }
				}
				     
				

				
		 
			     Yii::$app->cache->set($key, $this->arrPropery);
		}
		 
		
		  // print_r($this->arrPropery);
		  		   
	 }
		 
		 
		 
			
	
	 public function fillArrayDataForCurientElement(){
		 
		$this->arrayDataForCurientElement=[];
		 
		 
		
		 
		 
		 $url = LokalFileModel::getDataByKeyFromLocalfile('local_data_default_detail_data_url').$this->elementXmlCode;; 
		 
		 
		// echo $url ;
					if($curl = curl_init()) { 
					curl_setopt($curl,CURLOPT_URL, $url); 
					curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
					curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
					curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,30); 
					curl_setopt($curl,CURLOPT_USERAGENT,'Bot 5555.0');
					$html = curl_exec($curl);
					curl_close($curl);
					}
					
					 
					//echo 	$html;
					
					$arrPropData=json_decode($html); 
					 
				//print_r($arrPropData);
				
				if(count($arrPropData)>0){
					
						foreach($arrPropData as $PropData){
					 
					 $intArray=[];
					 $intArray['PROPERTY_ID']=$PropData->PROPERTY_ID;
					 $intArray['NAME']=$PropData->NAME;
				     $intArray['CODE']=$PropData->CODE;
					 $intArray['VALUE']=$PropData->VALUE;
					 
					 
					 $intArray['NAME_PROPERTY']=$this->arrPropery[$PropData->PROPERTY_ID]['NAME'];
					 ;
					 
					 
					$this->arrayDataForCurientElement[]=$intArray;
					 
					
				}
				}
				
			
		 
		 
		 
		 
		 
	 } 
       	
		
		 
	


	
	
}
