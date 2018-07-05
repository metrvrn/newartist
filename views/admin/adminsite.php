<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Административный раздел';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       'Административный раздел'
    </p>
 <h1>сообщение модели</h1>
 
 <h1 id="message_div" >сообщение модели</h1>
	
	<p id="btn_site_uploadenom"  > <?=$model->message;?></p> 
	
	
 

	
		<p><div class="btn btn-default"  id="btn_site_cleancache"  onclick='btn_admin_cleancache()'        >очистка кэша </div></p>
		
		
		
		
		<p><div class="btn btn-default"  id="btn_site_addadmin"  onclick='btn_admin_addadmin()'        >создать админа пользователя</div></p>

	
		 
			<p><div class="btn btn-default"  id="btn_admin_Uploadenomartist"  onclick='btn_admin_Uploadenomartist()'        >загрузить номенклатуру ходожника </div></p>
		
		
		<p><div class="btn btn-default"  id="btn_admin_Uploadequantityprice"  onclick='btn_admin_Uploadequantityprice()'        >загрузить количество цену </div></p>
		
			<p><div class="btn btn-default"  id="btn_admin_Activedeactivelemensection"  onclick='btn_admin_Activedeactivelemensection()'        >установить активнось элементов каталогов </div></p>
		
	
    <code><//?= __FILE__ ?></code>
</div>
<script>
 
 

function btn_admin_cleancache() {
    

   var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      mes( this.responseText);
    }
  };
  xhttp.open("GET", "<?=Url::to(['admin/cleancache']) ?>", true);
  xhttp.send();

 console.log("секции ")
}


function btn_admin_addadmin() {
    

   var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      mes( this.responseText);
    }
  };
  xhttp.open("GET", "<?=Url::to(['admin/addadmin']) ?>", true);
  xhttp.send();

 console.log("начало ")
}


function btn_admin_Uploadenomartist() {
    

   var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      mes( this.responseText);
    }
  };
  xhttp.open("GET", "<?=Url::to(['admin/uploadenomartist']) ?>", true);
  xhttp.send();

 console.log("начало ")
}


function btn_admin_Uploadequantityprice() {
    

   var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      mes( this.responseText);
    }
  };
  xhttp.open("GET", "<?=Url::to(['admin/uploadequantityprice']) ?>", true);
  xhttp.send();

 console.log("секции ")
}


function btn_admin_Activedeactivelemensection() {
    

   var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      mes( this.responseText);
    }
  };
  xhttp.open("GET", "<?=Url::to(['admin/activedeactivelemensection']) ?>", true);
  xhttp.send();

 console.log("секции ")
}






function mes(mes){
	mes_div= document.getElementById('message_div').innerHTML=mes;
	
	
}

</script>