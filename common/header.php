<!DOCTYPE html>
<html>
<head>
<title><?php echo settings('site_title'); echo $title ? ' | ' . $title : ''; ?></title>

<!-- Meta -->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo settings('description'); ?>" />

<?php echo auto_discovery_link_tag(); ?>

<!-- Get Core stylesheets -->

<?php echo queue_css('screen');
queue_css('jquery.fancybox-1.3.4');
queue_css('video-js');
queue_css('print'); 
display_css();
?>

<!-- Get the Configurable stylesheet -->

<link rel="stylesheet" media="screen" href="<?php echo html_escape(css(deco_get_stylesheet())); ?>" />

<!-- get fancy fonts via Google Fonts API if the theme is "Wood" -->

<?php if (deco_get_stylesheet()=='wood'){echo'<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster|Cuprum"/>';}
?>


<!-- JavaScripts -->

<?php echo js('default'); ?>

<!-- start Conditional JS -->

<!-- the following scripts only load on the homepage and items pages due to potential plugin conflicts (incl. current version of MyOmeka).  If you would like to use the slideshow or fancybox on another page, add the bodyid for each page below, separated by the or operator (||) -->

	<?php if ($bodyid==("home"||"items")){
	echo js('fancybox/jquery.fancybox-1.3.4');
	echo js('fancybox/jquery.easing-1.3.pack');
	echo js('video-js/video');
	echo js('jquery.aw-showcase');
	}?>


<!-- end Conditional JS -->

<!-- Plugin Stuff -->

<?php echo plugin_header(); ?>

<!-- this hides the slideshow divs from users who do not have javascript enabled so they don't see a big mess -->
<noscript>
<style>#showcase,.showcase, h2.awkward{display:none; visibility:hidden;}</style>
</noscript>

</head>
<body<?php echo $bodyid ? ' id="'.$bodyid.'"' : ''; ?><?php echo $bodyclass ? ' class="'.$bodyclass.'"' : ''; ?>>
	<div id="wrap">
		
		<div id="primary-nav">
			<ul class="navigation">
			<?php echo public_nav_main(array('Bilder' => uri('items'), 'Samlinger'=>uri('collections'), 'Avansert søk'=>'/omeka/items/advanced-search')); ?>
			</ul>
		<!-- search --> 
		<div id="search-container">
			<?php echo simple_search(); ?>
			<?php //echo link_to_advanced_search(); ?>
		</div>
		</div><!-- end primary-nav -->
		<div id="header">
		<div id="site-title">
		<h2><?php echo link_to_home_page(); ?></h2>

		</div>
		</div>

		<div id="content">
