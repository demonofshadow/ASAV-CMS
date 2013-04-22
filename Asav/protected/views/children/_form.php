<?php
/* @var $this ChildController */
/* @var $model Child */
/* @var $form CActiveForm */
?>



<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'report-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>"wideFields"),
));

$sponsors=CHtml::listData(User::model()->findAll(), 'Id', 'Fullname');
$genres=CHtml::listData(Genre::model()->findAll(), 'Id', 'Name');
?>

	<p class="note">Les champs avec <span class="required">*</span> sont requis.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="form">	
<div class="row-fluid">	


	<div class="span4">
		<?php echo $form->labelEx($model,'Firstname'); ?>
		<?php echo $form->textField($model,'Firstname'); ?>
		<?php echo $form->error($model,'Firstname'); ?>
	</div>

	<div class="span4">
		<?php echo $form->labelEx($model,'Lastname'); ?>
		<?php echo $form->textField($model,'Lastname'); ?>
		<?php echo $form->error($model,'Lastname'); ?>
	</div>
	
	<div class="span4">
		<?php echo $form->dropDownListRow($model,'Sponsor',$sponsors); ?>
		<?php echo $form->error($model,'Sponsor'); ?>
	</div>
</div>
<div class="row-fluid">	

	<div class="span3">
	<?php echo $form->labelEx($model,'Birthday'); ?>
	<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
		'name'=>'tmp-Day',
		// additional javascript options for the date picker plugin
		'options'=>array(
				'showAnim'=>'fold',
				'dateFormat' => 'dd mm yy',
				'altFormat' => 'yy-mm-dd',
				'altField' => "#Child_Birthday",
		),
		'model'=>$model,
		'value'=>$model->Birthday,
	)); ?>
	<?php echo $form->textField($model,'Birthday', array('style'=>"display:none")); ?>
	</div>

	<div class="span2">
		
		<?php echo $form->dropDownListRow($model,'Genre',$genres); ?>
		<?php echo $form->error($model,'Genre'); ?>
	</div>
	
			<span class="span6">
			<?php echo $form->labelEx($model,'Photo'); ?>
			<span class="fileUploadContainer">
				<?php echo $form->fileField($model,'UploadedFile', 
						array('class'=>'fileUploadComponent',
							  'style'=>'font-size: 28px',
							  'onchange'=>'javascript:document.getElementById(\'file\').value = this.value')); ?>
				<input id="file" type="text" class="fileUploadCustom" placeholder="Joindre un fichier..." />
			</span>
		</span>
	
</div> <!-- END form -->
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Enregistrer'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->