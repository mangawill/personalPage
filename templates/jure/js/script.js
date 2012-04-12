/* Author: 
 Jure Štern
*/
		jQuery(document).ready(function() { //Start up our Featured Project Carosuel
			jQuery('ul#myRoundabout').roundabout({
		minScale: 0.2,
		minOpacity: 1,
		duration: 400,
		easing: 'easeOutQuad',
		enableDrag: true,
		dropEasing: 'easeOutBounce'
			});
		});


		jQuery(document).ready(function() {
		
		/* Za samo eno sliko */
		jQuery("a.slika").fancybox({
			});
			
			
		/* Za galerijo slik */
		jQuery("a.slike").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	true
			});
			
		});		
	






















