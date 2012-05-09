<?php head(array('title'=>collection('Name'))); ?>

<div id="primary" class="show">
    <h1><?php echo collection('Name'); ?></h1>

    <div id="description" class="element">
        <h2>Om samlingen</h2>
        <div class="element-text"><?php echo nls2p(collection('Description')); ?></div>
    </div><!-- end description -->
    <h2>Utstillinger</h2>
    <?php if(collection('id') == 1): ?>
      <ul>
        <li><a href='/omeka/exhibits/show/abildsoe-gaard'>Abildsø gård</a>
        <li><a href='/omeka/exhibits/show/spillet-om-sarabraaten'>Spillet om Sarabråten</a>
        <li><a href="/omeka/exhibits/show/boeler-bibliotek">Bøler bibliotek</a>
      </ul>
    <?php endif; ?>

                <?php if(collection_has_collectors()): ?>
                      <?php echo '<div id="collectors" class="element">';?>
       				  <?php echo'<h2>Collector(s)</h2>';?> 
       				  <?php echo '<div class="element-text">';?>
          			  <?php echo '<ul><li><p>';?>
              		  <?php echo ''.collection('Collectors', array('delimiter'=>'</li><li>')); ?>
					  <?php echo'</p></li></ul>';?>
        			  <?php echo'</div></div>';?>
                <?php endif; ?>


    <?php echo display_random_items_from_collection($collection, 8); ?>

    <p class="view-items-link"><?php echo link_to_browse_items('Vis alle bildene i ' . collection('Name'), array('collection' => collection('id'))); ?></p>
    
<!-- end collection-items -->
    
    <?php echo plugin_append_to_collections_show(); ?>
</div><!-- end primary -->

<?php foot(); ?>