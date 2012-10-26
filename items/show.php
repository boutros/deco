<?php head(array('title' => item('Dublin Core', 'Title'), 'bodyid'=>'items','bodyclass' => 'show item')); ?>

<h1><?php echo item('Dublin Core', 'Title'); ?></h1>

<!-- start FancyBox initialization and configuration -->
<? echo js('fancybox/fancybox-init-config');?>		

<!-- Video JS init -->
<script type="text/javascript">VideoJS.setupAllWhenReady();</script>


<div id="sidebar">	

<!-- download links -->
	<!--
	removed PETTER
	-->
<!-- end download links -->
	
<!-- If the item belongs to a collection, the following creates a link to that collection. -->
	<?php if (item_belongs_to_collection()): ?>
        <div id="collection" class="element">
            <h3>Samling</h3>
            <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
        </div>
    <?php endif; ?>

<!-- The following prints a list of all tags associated with the item -->
	<?php if (item_has_tags()): ?>
	<div id="item-tags" class="element">
		<h3>Stikkord</h3>
		<div class="element-text"><?php echo item_tags_as_string(); ?></div> 
	</div>
	<?php endif;?>
	
<!-- The following prints a citation for this item. -->
	<div id="item-citation" class="element">
    	<h3>Kildehenvisning</h3>
    	<div class="element-text"><?php echo item_citation(); ?></div>
	</div>

<!-- list any related exhibits - see theme custom php and configure in theme settings-->
    <?php deco_display_related_exhibits(); ?>


</div>

<div id="primary">
	<div id="item-metadata">
<!-- if user has installed Docs Viewer plugin and turned off auto embed, the viewer will be embedded in the main content area (unless this is turned off in Deco theme config)-->
	<?php deco_docs_viewer_placement();	?>


<!-- display files -->	
	<div id="item-images">

	<?php
	$index = 0; 
	//start the loop of item files
	while(loop_files_for_item()):$file = get_current_file();
	//variables used to check mime types for VideoJS compatibility, etc.
	$mime = item_file('MIME Type');
	$videoJS = array('video/mp4','video/mpeg','video/ogg','video/quicktime','video/webm');
	$videoJS_h264 = array('video/mp4','video/mpeg','video/quicktime');
	$videoJS_webM = array('video/webm');
	$videoJS_ogg = array('video/ogg');
	$wma_video = array('audio/wma','audio/x-ms-wma');
	$wmv_video = array('video/avi','video/msvideo','video/x-msvideo','video/x-ms-wmv');
	$audio = array('application/ogg','audio/aac','audio/aiff','audio/midi','audio/mp3','audio/mp4','audio/mpeg','audio/mpeg3','audio/mpegaudio','audio/mpg','audio/ogg','audio/wav','audio/x-mp3','audio/x-mp4','audio/x-mpeg','audio/x-mpeg3','audio/x-midi','audio/x-mpegaudio','audio/x-mpg','audio/x-ogg','audio/x-wav','audio/x-aac','audio/x-aiff','audio/x-midi','audio/x-mp3','audio/x-mp4','audio/x-mpeg','audio/x-mpeg3','audio/x-mpegaudio','audio/x-mpg');
	//this loops through images for the item and returns a fullsize image for 
	//the first item with square thumbs for the rest.  Images are grouped into galleries with the rel
	//fancy_group and interact with FancyBox via the class fancy_item 	
		if (($file->hasThumbnail()&&($index == 0))) 
		echo display_file($file, array('imageSize'=>'fullsize','linkAttributes'=>array('rel'=>'fancy_group', 'class'=>'fancyitem','title' => item('Dublin Core', 'Title'))),array('class' => 'fullsize', 'id' => 'item-image')); 
		elseif (($file->hasThumbnail()&&($index !== 0))) 
		echo display_file($file, array('imageSize'=>'square_thumbnail', 'linkToFile'=>true,'linkAttributes'=>array('rel'=>'fancy_group', 'class'=>'fancyitem','title' => item('Dublin Core', 'Title'))),array('class' => 'square_thumbnail')); 
	//this is testing for rich media files and deciding what to do with them.	
		//videoJS
		elseif 
		(array_search($mime,$videoJS) !== false) 
		{
  		//<!-- Begin VideoJS -->
  		echo '<div class="video-js-box">';
  		  //<!-- Using the Video for Everybody Embed Code http://camendesign.com/code/video_for_everybody -->
  		  echo '<video id="htmlvideo_'.$index.'" class="video-js" scale="tofit" width="600" height="338" controls="controls" preload="auto" poster="'.img('vid-poster.jpg').'">';
  		    echo '<source src="'.file_download_uri($file).'" ';
  		    if (array_search($mime,$videoJS_h264) !== false) echo 'type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\' />';
  		    elseif (array_search($mime,$videoJS_webM) !== false) echo 'type=\'video/webm; codecs="vp8, vorbis"\' />';
  		    elseif (array_search($mime,$videoJS_ogg) !== false) echo 'type=\'video/ogg; codecs="theora, vorbis"\' />';
  		    //<!-- Flash Fallback. Use any flash video player here (currently using Flowplayer). Make sure to keep the vjs-flash-fallback class. -->
  		    echo '<object id="flashvideo_'.$index.'" class="vjs-flash-fallback" scaling="fit" width="600" height="338" type="application/x-shockwave-flash" data="'.uri('').'themes/deco/common/flowplayer/flowplayer-3.2.7.swf">';
  		      echo '<param name="movie" value="'.uri('').'themes/deco/common/flowplayer/flowplayer-3.2.7.swf" />';
  		      echo '<param name="allowfullscreen" value="true" />';
  		      echo '<param name="flashvars" value=\'config={"playlist":["'.img('vid-poster.jpg').'", {"url": "'.file_download_uri($file).'","autoPlay":false,"autoBuffering":true}]}\' />';
        
  		     // <!-- Image Fallback. Typically the same as the poster image. -->
   		     echo '<img src="'.img('vid-poster.jpg').'" scale="tofit" width="600" height="338" alt="Poster Image"
          title="No video playback capabilities." />';
   		   echo '</object>';
   		 echo '</video>';
    
   		   //<!-- Support VideoJS by adding this link. -->
   		   //echo '<p><a href="http://videojs.com">HTML5 Video Player</a> by VideoJS</p>';
  		  echo '</p>';
 		 echo '</div></br><br/>';
		//<!-- End VideoJS -->
		}
		//wma video
		elseif 
		(array_search($mime,$wma_video) !== false) echo display_file($file, array('scale'=>'tofit', 'width' => 600, 'height' => 338));
		//wmv video
		elseif 
		(array_search($mime,$wmv_video) !== false) echo display_file($file, array('scale'=>'tofit', 'width' => 600, 'height' => 338));
		//audio
		elseif (array_search($mime,$audio) !== false) echo display_file($file, array('width' => 600, 'height' => 20));
	$index++;		
	endwhile;		
	?>	
	<?php

  ?>		

	</div>
<!-- end display files -->
    	<h2>Metadata</h2>
<!--  The following function prints all the the metadata associated with an item: Dublin Core, extra element sets, etc. See http://omeka.org/codex or the examples on items/browse for information on how to print only select metadata fields. -->
    	<?php echo show_item_metadata(); ?>
    	
    	
	
	</div><!-- end item-metadata -->
	

	
	<!-- all other plugins-->
<?php echo plugin_append_to_items_show(); ?>
	

<!-- the edit button for logged in superusers and admins -->
<? $current = Omeka_Context::getInstance()->getCurrentUser();
        if ($current->role == 'super') {
                echo '<p><a class="edit-button" href="'. html_escape(uri('admin/items/edit/')).item('ID').'">Rediger dette bildet...</a></p>';
                }
        elseif($current->role == 'admin'){
                echo '<p><a class="edit-button" href="'. html_escape(uri('admin/items/edit/')).item('ID').'">Rediger dette bildet...</a></p>';
                }
?> 
<!-- end edit button -->

	
</div><!-- end primary -->
	<ul class="item-pagination navigation">
<!--
  <li id="previous-item" class="previous">
		<?php echo link_to_previous_item('Forrige bilde'); ?>
	</li>
	<li id="next-item" class="next">
		<?php echo link_to_next_item('Neste bilde'); ?>
	</li>
	</ul>
-->

<?php foot(); ?>