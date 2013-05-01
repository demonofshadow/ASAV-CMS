<?php
/* @var $this ChildController */
/* @var $model Child */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	'Enfants'=>array('index'),
	$model->Id,
);

$this->menu=array(
		array('label'=>'Liste des Enfants', 'url'=>array('index')),
		array('label'=>'Créer Enfant', 'url'=>array('create')),
		array('label'=>'Modifier Enfant', 'url'=>array('update', 'id'=>$model->Id)),
		array('label'=>'Supprimer Enfant', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Êtes-vous sûr vous supprimer ce rapport?')),

);
?>

<h1>Enfant : #<?php echo $model->Id; ?></h1>

<?php 
$authors=CHtml::listData(User::model()->findAll(), 'Id', 'Fullname');

?>


<div class="wideFields">

	<div class="row-fluid">	

		
		<div class="span4">
		<b>
		<?php echo CHtml::encode($model->getAttributeLabel('Firstname')); ?>:
		</b>
		<?php echo CHtml::encode($model->Firstname); ?>		
		</div>
		
		<div class="span4">
		<b>
		<?php echo CHtml::encode($model->getAttributeLabel('Lastname')); ?>:
		</b>
		<?php echo CHtml::encode($model->Lastname); ?>		
		</div>
		
		<div class="span4">
		<b>
		<?php echo CHtml::encode($model->getAttributeLabel('Sponsor')); ?>:
		</b>
		<?php echo CHtml::encode(($model->sponsor ? $model->sponsor->Fullname : "")); ?>		
		</div>
		
		
	</div>
	
	<div class="row-fluid">	
	
		<div class="span4">
		<b>
		<?php echo CHtml::encode($model->getAttributeLabel('Birthday')); ?>:
		</b>
		<?php echo CHtml::encode($model->Birthday); ?>		
		</div>
		
		<div class="span4">
		<b>
		<?php echo CHtml::encode($model->getAttributeLabel('Genre')); ?>:
		</b>
		<?php echo CHtml::encode($model->genre->Name); ?>		
		</div>
		
		<div class="span4">
		<b>
		<?php echo CHtml::encode($model->getAttributeLabel('Media')); ?>:
		</b>
		<?php echo CHtml::image(isset($model->picture) ? CHtml::encode($model->picture->Path) : '../images/noimage.png'); ?>		
		</div>

	
	</div>
</div>
<?php
	//echo CHtml::encode($model->reports);


$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$model->search(),
	'filter'=>null,
    'template'=>"{summary}{items}{pager}",
	'summaryText'=>'Displaying {start}-{end} of {count} results.',
    'columns'=>array(
		
		array('name'=>'Author','header'=>'Autheur', 'value'=>'($data->author ? $data->author->Fullname : "") '),
    
    	array('name'=>'Status', 'header'=>'Status', 'value'=>'$data->status->Status'),
    	array('name'=>'Day', 'header'=>'Date'),
       
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
    ),
));
?>
