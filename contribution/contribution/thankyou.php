<?php head(); ?>
<div id="primary">
	<h1>Takk for ditt bidrag!</h1>
	<p>Bildet ditt vil vises i basen så snart en administrator har godkjent det. I mellomtiden er du <?php echo contribution_link_to_contribute('velkommen til å bidra med flere bilder'); ?> eller <a href="<?php echo uri('items/browse'); ?>">bla i basen</a>.</p>
</div>
<?php foot(); ?>