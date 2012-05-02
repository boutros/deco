<?php head(array('title'=>'Browse Items','bodyid'=>'items','bodyclass'=>'tags')); ?>

<div id="primary">
	
	<h1>Bla i ressurser</h1>
	
	<ul class="navigation item-tags" id="secondary-nav">
	<?php echo nav(array('Bla i bilder' => uri('items/browse'), __('Browse by Tag') => uri('items/tags'))); ?>
	</ul>

	<?php echo tag_cloud($tags,uri('items/browse')); ?>

</div><!-- end primary -->

<?php foot(); ?>