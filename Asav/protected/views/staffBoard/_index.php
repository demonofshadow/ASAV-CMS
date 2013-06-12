<?php
/* @var $this StaffBoardController */
/* @var $data StaffBoard */
?>

<div class="view StaffboardElement">

	<!--  Actions -->
	<p class="right">
		<a data-original-title="Voir" class="view" rel="tooltip" href="<?php echo Yii::app()->createUrl("/staffboard/view", array('id' => $data->Id)); ?>"><i class="icon-eye-open"></i></a> 
		<a data-original-title="Mettre à jour" class="update" rel="tooltip" href="<?php echo Yii::app()->createUrl("/staffboard/update", array('id' => $data->Id)); ?>"><i class="icon-pencil"></i></a> 
		<a data-original-title="Supprimer" class="delete" rel="tooltip" href="<?php echo Yii::app()->createUrl("/staffboard/delete", array('id' => $data->Id)); ?>"><i class="icon-trash"></i></a>
	</p>
	<!-- Title -->
	<p class="title">
		<span>
			<?php 
			echo $data->Title;
			?>
		</span>
		<br />
		<!-- Author & Date -->
		<?php 
		echo $data->author->getFullname() .' - '. substr($data->DateCreated, 0, 10);
		?>
	</p>
	<p class="justify">
	<!-- Message -->
	<?php 
	echo $data->Content;
	?>
	</p>
	<!-- Attached media -->
	<p>
		<b>Fichiers attachés</b><br />
		<blockquote>
			<?php 
			if($data->medias)
			{
				foreach ($data->medias as $media)
				{
					echo '<a href="'. Yii::app()->params['custom']['uploadPath'] . $media->Path .'">'. $media->Title .' ('. pathinfo($media->Path, PATHINFO_FILENAME) .'.'. pathinfo($media->Path, PATHINFO_EXTENSION) .')</a><br />';
				}
			}
			?>
		</blockquote>
	</p>
</div>