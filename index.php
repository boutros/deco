<?php head(array('bodyid'=>'home')); ?> 
    <div id="primary">
            <!--About-->
        <div id="site-description">
            <h2>Om bildebasen</h2> <h3><?php echo settings('site_title'); ?></h3>    
            <?php echo deco_get_about(); ?>
            
      <div id="hovedside_search" class="element">
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
            <input type="submit" class="submit" name="submit_search" id="submit_search_advanced" value="<?php echo __('Search'); ?>" />
            </div>
        </div>
    </div>
            
            <!--uncomment below to add an RSS feed to homepage or wait until next release
            <h2>External Feed</h2>
            <? //deco_display_rss('http://jeffersonsnewspaper.org/feed/',1);?>
            -->
            
        </div><!--end About-->
	<!-- Featured Item -->

<!-- Start Awkward Gallery load/config -->
<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function()
{
	jQuery("#showcase").awShowcase(
	{
		width:					625,
		height:					500,
		auto:					true,
		interval:				6500,
		continuous:				false,
		loading:				true,
		tooltip_width:			200,
		tooltip_icon_width:		32,
		tooltip_icon_height:	32,
		tooltip_offsetx:		18,
		tooltip_offsety:		0,
		arrows:					false, 
		buttons:				true,
		btn_numbers:			false,
		keybord_keys:			true,
		mousetrace:				false,
		pauseonover:			true,
		transition:				'vslide', /* vslide/hslide/fade */
		transition_speed:		500,
		show_caption:			'onload', /* onload/onhover/show */
		thumbnails:				false,
		thumbnails_position:	'outside-last', /* outside-last/outside-first/inside-last/inside-first */
		thumbnails_direction:	'horizontal', /* vertical/horizontal */
		thumbnails_slidex:		0 /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
	});
});
</script>
<!-- end Awkward Gallery load/config -->
	
        <!-- Featured Items aka Awkward Showcase image gallery/slideshow-->
        <h2 class="awkward">Utvalgte bilder fra basen</h2>
 		<div id="showcase" class="showcase">
 		<?php deco_awkward_gallery();?>
 		</div><!-- end featured items -->
	
        <!-- Featured Exhibit -->
        <!-- FIX Petter-->
        <h2>Utvalgte bilder</h2>
        <?php
            $itemsf = deco_get_random_featured_items(9);
            set_items_for_loop($itemsf);
            while(loop_items()): 
                if (item_has_thumbnail($item)) {
                    $t = item('Dublin Core', 'Title');
                    $html .= link_to_item(item_square_thumbnail(array('class' =>'imagecoll', 'title'=>$t), 0, $item), array('class'=>'image'), 'show', $item);
                }
            endwhile;
            echo $html; ?>
        

        <!-- end featured collection -->
        
    	<!-- Featured Collection -->
    	<div id="featured-collection">    
    		<?php echo deco_display_random_featured_collection();?>
       	</div><!-- end featured collection -->
        

            
    </div><!-- end primary -->
    
    <div id="secondary">

    <!-- Recent Items --> 
        <div style="margin-bottom:30px">
            <h2>Lokalhistoriske bildesamlinger</h2>
            <h3><a href="/omeka/collections/show/2">Groruddalen</a></h3>
            <h3><a href="/omeka/collections/show/3">Grefsen Kjelsås Nydalen</a></h3>
            <h3><a href="/omeka/collections/show/7">Hellerud</a></h3>
            <h3><a href="/omeka/collections/show/5">Sogn</a></h3>
            <h3><a href="/omeka/collections/show/4">Søndre Aker</a></h3>
            <h3><a href="/omeka/collections/show/6">Vindern</a></h3>
            <h3><a href="/omeka/collections/show/1">Østensjø</a></h3>
        </div>

        <div id="recent-items">   
        
        
            <h2>Nye bilder</h2>
            <?php 
            $deco_get_recent_number=deco_get_recent_number();
            $items = get_items(array('recent'=>true, 'withImage'=>true), $deco_get_recent_number);?>
            <?php set_items_for_loop($items); ?>
            <?php if (has_items_for_loop()): ?>

            <div class="items-list">
                <?php while (loop_items()): ?>

                <div class="item">

                    <h3><?php echo link_to_item(); ?></h3>

                    <?php if(item_has_thumbnail()): ?>
                        <div class="item-img">
                        <?php echo link_to_item(item_square_thumbnail()); ?>                        
                        </div>
                    <?php endif; ?>

                </div>
                <?php endwhile; ?>  
            </div>

            <?php else: ?>
                <p>No recent items available.</p>

            <?php endif; ?>
	
            <p class="view-items-link"><a href="<?php echo html_escape(uri('items')); ?>">Bla i alle bilder</a></p>
            
        </div><!--end recent-items -->
        
    </div><!-- end secondary -->
    
<?php foot(); ?>
