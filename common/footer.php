</div><!-- end content -->

<div id="footer">
	<!-- if user has installed myOmeka plugin, the user status login/register link will be activated in the footer
	This is not an ideal placement of the function but it should be ok for projects with smaller user base (eg class projects)-->
	<?php if (function_exists('my_omeka_user_status')) { echo '<div id="myomeka-status" style="float: right;">'.my_omeka_user_status().'</div>';}?>

    <p>&copy; <?php echo date(Y);?> <?php echo html_escape(settings('author'));?>
    <br/>Drevet av <a href="http://omeka.org">Omeka</a><?php echo deco_display_theme_credit();?></p>

    <br/><ul class="navigation">
		<!--
		<?php echo public_nav_main(array('Home' => uri(''), 'Browse Items' => uri('items'), 'Browse Collections'=>uri('collections')));?>
		-->
    </ul>
	
</div><!-- end footer -->
</div><!-- end wrap -->
</body>

</html>
