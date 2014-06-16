window.addEvent('domready', function() {
	var x = 0, y = 0, offset = 0, child = 0, horiznav = $('horiznav') || $('horiz-menu2').getElement('.menutop');
	var topnav = horiznav.getChildren(), bottomnav = $$('#bottom-menu2 a');

	if (topnav.length) {
		x += horiznav.getCoordinates().width + $('horiz-menu2').getStyle('margin-left').toInt() + $('horiz-menu2').getStyle('margin-right').toInt() + $('horiz-menu2').getStyle('padding-left').toInt() + $('horiz-menu2').getStyle('padding-right').toInt();

		$$('#horiz-menu ul').setStyle('zoom', 1);
	$('horiz-menu').setStyles({'position': '', 'width': x});
	};
	
	if (bottomnav.length) {
		var z = $('bottom-menu2').getStyle('margin-left').toInt() + $('bottom-menu2').getStyle('margin-right').toInt() + $('bottom-menu2').getStyle('padding-left').toInt() + $('bottom-menu2').getStyle('padding-right').toInt();
		bottomnav.each(function(el) {
			y += el.getCoordinates().width + 2;
		});
		
		$('bottom-menu').setStyle('width', y + z);
	};
});