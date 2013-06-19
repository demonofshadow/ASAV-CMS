<?php
$this->breadcrumbs=array(
	'Medias',
);


?>

<h1>Medias</h1>

<?php 
$this->widget ( 'bootstrap.widgets.TbGridView', array (
		'type' => 'striped bordered condensed',
		'dataProvider' => $dp,
		'filter' => null,
		'template' => "{summary}{items}{pager}",
		'summaryText' => 'Displaying {start}-{end} of {count} results.',
		'columns' => array (

				array (
						'name' => 'Author',
						
						'value' => '($data->author ? $data->author->Fullname : "") '
				),
				array (
						'name' => 'Child',
						
						'type' => 'raw',
						'value'=>'$data->child ? CHtml::link($data->child->Fullname, Yii::app()->createUrl("/children/view", array("id"=>$data->child->Id))) : ""'
				),
				array (
						'name' => 'Title',
						
						'value' => '$data->Title'
				),
				array (
						'name' => 'Created',
				
						'value' => '$data->Created'
				),
				

				array (
						'class' => 'bootstrap.widgets.TbButtonColumn',
						'htmlOptions' => array (
								'style' => 'width: 50px'
						)
				)
		)
) );

?>


