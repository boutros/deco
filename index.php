<?php head(array('bodyid'=>'home')); ?> 
    <div id="primary">
            <!--About-->
        <div id="site-description">
            <h2>Om bildebasen</h2> <h3><?php echo settings('site_title'); ?></h3>    
            <?php echo deco_get_about(); ?>
            <div id="search2">
                <?php echo simple_search(); ?>
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
        <h2 class="awkward">Utstilte bilder</h2>
 		<div id="showcase" class="showcase">
 		<?php deco_awkward_gallery();?>
 		</div><!-- end featured items -->
	
        <!-- Featured Exhibit -->
        <div id="featured-exhibits" style="margin-top:1.5em;">
            <?php echo deco_exhibit_builder_display_random_featured_exhibit(); ?>
        </div><!-- end featured collection -->
        
    	<!-- Featured Collection -->
    	<div id="featured-collection">    
    		<?php echo deco_display_random_featured_collection();?>
       	</div><!-- end featured collection -->
        

            
    </div><!-- end primary -->
    
    <div id="secondary">

    <!-- Recent Items --> 
        <div id="recent-items">   
        
        
            <h2>Nye ressurser</h2>
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

                    <?php if($desc = item('Dublin Core', 'Description', array('snippet'=>190))): ?>

                        <div class="item-description"><?php echo $desc; ?><?php echo link_to_item(' ...more',(array('class'=>'show'))) ?></div>

                    <?php endif; ?> 

                </div>
                <?php endwhile; ?>  
            </div>

            <?php else: ?>
                <p>No recent items available.</p>

            <?php endif; ?>
	
            <p class="view-items-link"><a href="<?php echo html_escape(uri('items')); ?>">Se alle ressurser</a></p>
            
        </div><!--end recent-items -->
        
    </div><!-- end secondary -->
    
<?php foot(); ?>
