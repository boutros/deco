jQuery.noConflict();
jQuery(document).ready(function() {
jQuery("a.fancyitem").fancybox({
type:'image', 
autoScale:'true',
overlayOpacity:0.75,
overlayColor:'#000',
titlePosition: 'over',
speedIn:500, 
speedOut:300,
'titleFormat': function(title, currentArray, currentIndex, currentOpts) {
	return '<span id="fancybox-title-over">Bilde ' + (currentIndex + 1) 
	+ ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
}
	});
});