<?php head(array('title'=>collection('Name'))); ?>

<div id="primary" class="show">
    <h1><?php echo collection('Name'); ?></h1>

    <div id="description" class="element">
        <h2>Om samlingen</h2>
        <div class="element-text"><?php echo nls2p(collection('Description')); ?></div>
    </div><!-- end description -->

    <div id="collection_search" class="element">
      <h2>Søk i <?php echo collection('Name'); ?></h2>
      <?php
      if ($formActionUri):
        $formAttributes['action'] = $formActionUri;
      else: 
        $formAttributes['action'] = uri(array('controller'=>'items',
                                          'action'=>'browse'));
      endif;
      $formAttributes['method'] = 'GET';
      ?>
    <form <?php echo _tag_attributes($formAttributes); ?>>
        <div id="search-keywords" class="field">
            
            <div class="inputs">
            <?php echo text(array(
                    'name' => 'search',
                    'size' => '40',
                    'id' => 'keyword-search',
                    'class' => 'textinput'), @$_REQUEST['search']);
                    ?>
            <input id="collection-search" value="<?php echo collection('id');?>" name="collection" type="hidden"/>
            <input type="submit" class="submit" name="submit_search" id="submit_search_advanced" value="<?php echo __('Search'); ?>" />
            </div>
        </div>
    </div>


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