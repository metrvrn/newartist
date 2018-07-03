<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
   
		<div class="row"> 
					<h1><?= Html::encode($this->title) ?></h1>		

		</div>
        <div class="row"> 

					<div class="col-sm-12"  >









					     <table id="basket"   style="width:100%" >
								<thead>
									<tr>
										<td>Наименование      </td>
										<td>Ед                 </td>
										<td>Цена, руб.        </td>
										<td>Количество        </td> 
										<td>Сумма              </td>
										<td>  Дополнительно   </td>
									</tr>
								   
								   
								</thead>
								<tbody> 





								<?
								echo '<tr>';
									echo' <td>           </td>';
									echo'<td>            </td>';
									echo'<td>            </td>';
									echo'<td>             </td>';  
									echo' <td>            </td>';
									echo' <td>            </td>';
								 
								echo '</tr>'; 
								foreach($model->basketArray as $baske){

								echo '<tr  id ="element_row_'.$baske['elementid'].'">';
								                              echo' <td> '.$baske['sessionid'].'</td>';
								                               echo'<td>'.$baske['elementid'].' </td>';
								                              echo'<td> </td>';
								                            echo'<td>  </td>';  
								                            echo' <td>  </td>';
															 echo' <td>  </td>';
								
 
								echo '</tr>'; 

								}


								?>
								</tbody>
								
								</table>
					</div>  
	
			</div>
		   
		<div class="row"> 
				
				
				<?php if ( count($model->basketArray)>0   ): ?>
					<?php $form = ActiveForm::begin(['id' => 'zakaz-form']); ?>

                    <?= $form->field($modelForm, 'name')->label('Имя')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($modelForm, 'email')->label('электронный адрес') ?>

                    <?= $form->field($modelForm, 'phone')->label('телефон') ?>

                    <?= $form->field($modelForm, 'adress')->textarea(['rows' => 6])->label('Адрес')  ?>

                    

                    <div class="form-group">
                        <?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                  <?php ActiveForm::end(); ?>
				
				
				<?php endif; ?>
				
				
				

		</div>
			
			
	</div>
	 