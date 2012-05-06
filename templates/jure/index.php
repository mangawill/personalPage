<?php
defined('_JEXEC') or die;

$document = &JFactory::getDocument();
$menu = & JSite::getMenu();

$rssDisable = true;
if($rssDisable) unset($document->_links);

?>
<!doctype html>
<head>
	<?php $this->_scripts = array(); ?><!-- remove mootols -->
	<link href="http://feeds.feedburner.com/JuresStern" onClick="_gaq.push(['_trackEvent', 'subscribe', 'rss', 'left']);" rel="alternate" type="application/rss+xml" title="Jures Blog Feed" />
	<jdoc:include type="head" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/jure/css/style.css">
  <!-- end CSS-->
	<script src="<?php echo $this->baseurl ?>/templates/jure/js/libs/modernizr-2.0.6.min.js"></script>
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/jure/css/jquery.fancybox-1.3.4.css" media="screen"/>
	<!--[if IE]>
			<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/jure/css/ie.css" />	
		<![endif]-->
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<?php
			if($this->countModules('desno') == 0) $contentWidth='span12';
			if($this->countModules('desno') >= 1) $contentWidth='span8';
		?>
		<?php if($this->countModules('user1 + user2 + user3') >= 3) $contentWidthuser=' span4';?>
		<?php if($this->countModules('user1 + user2 + user3') == 2) $contentWidthuser=' span6';?>
		<?php if($this->countModules('user1 + user2 + user3') == 1) $contentWidthuser=' span12';?>
</head>
<body>
  <header id="header">			
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="<?php echo $this->baseurl ?>">
            <span class="jure"><?php  echo JText::_('JS'); ?></span>
            <span class="title"><?php  echo JText::_('JSS'); ?></span>
          </a>
          <?php if($this->countModules('nav')) : ?>
          <nav id="menu">
           <jdoc:include type="modules" name="nav" style="jure"/>
          </nav>
          <?php endif; ?>
          <?php if($this->countModules('jezik')) : ?>
          <div class="jezik">
          	<jdoc:include type="modules" name="jezik" style="xhtml"/>
          	<a href="https://twitter.com/JureStern" class="twitter-follow-button" data-show-count="false">Follow @JureStern</a>
          	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>		
  </header><!-- header -->
  
  <div class="container"> 
		<?php if($this->countModules('reklama')) : ?>
		<section id="reklama" class="row">
		  <div class="span6">
			 <jdoc:include type="modules" name="reklama" style="xhtml"/>
		  </div>
		  <div class="span6">
			 <jdoc:include type="modules" name="achivement" style="xhtml"/>
		  </div>
		</section><!-- Reklama -->
		<?php endif; ?>	
		
    <div class="vsebina">
      <?php //remove breadcrubs from homepage
      if ($menu->getActive() != $menu->getDefault( 'en-GB' ) && $menu->getActive() != $menu->getDefault( 'sl-SI' )) {
      echo '<div id="drobtinice"><jdoc:include type="modules" name="drobtinice" style="navadno"/></div>';
      }?>
      <?php if($this->countModules('slogan')) : ?>
      <aside id="slogan">
        <jdoc:include type="modules" name="slogan" style="xhtml"/>
      </aside>
      <?php endif; ?>
      <div class="row">
        <div class="<?php echo $contentWidth; ?>">
          <jdoc:include type="component" />
        </div>
      <?php if($this->countModules('desno')) : ?>
        <aside id="right" class="span4">
          <jdoc:include type="modules" name="desno" style="desno"/>
        </aside>
      <?php endif; ?>
      </div><!-- row -->
    </div><!-- vsebina -->
  	
		<div class="row bellowContent">
  		<?php if($this->countModules('user6')) : ?>
  		  <jdoc:include type="modules" name="user6" style="reference"/>
  		  
  		<?php endif; ?>
  		<?php if($this->countModules('user7')) : ?>
  		  <jdoc:include type="modules" name="user7" style="reference"/>
  		<?php endif; ?>
  		<?php if($this->countModules('user8')) : ?>
  		  <jdoc:include type="modules" name="user8" style="reference"/>
  		<?php endif; ?>
		</div><!-- row -->
				
		</div><!-- container-->

    <footer id="nogaStran" class="row">
      <div id="nogaZgoraj"></div>
      <section id="nogaKontejner">
        <?php if($this->countModules('user1')) : ?>
        <div class="<?php echo $contentWidthuser; ?>">
          <jdoc:include type="modules" name="user1" style="noga"/>
        </div>
        <?php endif; ?>
        <?php if($this->countModules('user2')) : ?>
        <div class="<?php echo $contentWidthuser; ?>">
          <jdoc:include type="modules" name="user2" style="noga"/>
        </div>
        <?php endif; ?>
        <?php if($this->countModules('user3')) : ?>
        <div class="<?php echo $contentWidthuser; ?>">
          <jdoc:include type="modules" name="user3" style="noga"/>
        </div>
        <?php endif; ?>
        <?php if($this->countModules('user5')) : ?>
        <div class="clearfix">
          <jdoc:include type="modules" name="user5" style="noga"/>
        </div>
        <?php endif; ?>
      </section><!-- nogaKontejner -->
    </footer><!-- nogaStran -->
    
		<?php if($this->countModules('debug')) : ?>
		<p><jdoc:include type="modules" name="debug" /></p>
		<?php endif; ?>
		<?php if($this->countModules('message')) : ?>
		<p><jdoc:include type="modules" name="message" /></p>
		<?php endif; ?>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script src="<?php echo $this->baseurl ?>/templates/jure/js/mylibs/jquery.roundabout.min.js"></script>
  <script src="<?php echo $this->baseurl ?>/templates/jure/js/mylibs/jquery.easing.1.3.js"></script>
  <script src="<?php echo $this->baseurl ?>/templates/jure/js/mylibs/jquery.fancybox-1.3.4.pack.js"></script>
  <script src="<?php echo $this->baseurl ?>/templates/jure/js/mylibs/jquery.jribbble-1.0.0.ugly.js"></script>
  <script src="<?php echo $this->baseurl ?>/templates/jure/js/mylibs/mosaic.1.0.1.min.js"></script>
  <script defer src="<?php echo $this->baseurl ?>/templates/jure/js/plugins.js"></script>
  <script defer src="<?php echo $this->baseurl ?>/templates/jure/js/script.js"></script>
  <script>
    $.jribbble.getShotsByPlayerId('JureStern', function (playerShots) {
    var html = [];

    $.each(playerShots.shots, function (i, shot) {
        html.push('<li><h3>' + shot.title + '</h3>');
        html.push('<h4>by ' + shot.player.name + '</h4><a href="' + shot.url + '">');
        html.push('<img src="' + shot.image_teaser_url + '" ');
        html.push('alt="' + shot.title + '"></a></li>');
    });

    $('#shotsByPlayerId').html(html.join(''));
}, {page: 1, per_page: 1});

$.jribbble.getPlayerById('JureStern', function (player) {
    var html = [];
    
    html.push('<ul class="achivementList clearfix"><li><div class="number">' + player.shots_count  + '</div>' + '<div class="icon"><i class="icon-camera"></i></div>' + 'shots</li>');
    html.push('<li><div class="number">' + player.following_count + '</div>' + '<div class="icon"><i class="icon-heart-empty"></i></div>' + 'following</li>');
    html.push('<li><div class="number">' + player.followers_count + '</div>' + '<div class="icon"><i class="icon-heart"></i></div>' + 'followers</li>');

    $('#playerProfile').html(html.join(''));
});

  </script>
  
  <script type="text/javascript">
$(function(){
$.ajax({
   url: 'http://api.twitter.com/1/users/show.json',
   data: {screen_name: 'JureStern'},
   dataType: 'jsonp',
   success: function(data) {
       $('#followers').html(data.followers_count);
       $('#tweets').html(data.statuses_count);
       $('#following').html(data.friends_count);
   }
});
});
</script>
	
  <!-- Change UA-XXXXX-X to be your site's ID -->
  <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-6253698-6']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);
  _gaq.push(['_trackPageLoadTime']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">
		$(function() {

			var $sidescroll	= (function() {
					
					// the row elements
				var $rows			= $('#ss-container > div.ss-row'),
					// we will cache the inviewport rows and the outside viewport rows
					$rowsViewport, $rowsOutViewport,
					// navigation menu links
					$links			= $('#ss-links > a'),
					// the window element
					$win			= $(window),
					// we will store the window sizes here
					winSize			= {},
					// used in the scroll setTimeout function
					anim			= false,
					// page scroll speed
					scollPageSpeed	= 2000 ,
					// page scroll easing
					scollPageEasing = 'easeInOutExpo',
					// perspective?
					hasPerspective	= false,
					
					perspective		= hasPerspective && Modernizr.csstransforms3d,
					// initialize function
					init			= function() {
						
						// get window sizes
						getWinSize();
						// initialize events
						initEvents();
						// define the inviewport selector
						defineViewport();
						// gets the elements that match the previous selector
						setViewportRows();
						// if perspective add css
						if( perspective ) {
							$rows.css({
								'-webkit-perspective'			: 600,
								'-webkit-perspective-origin'	: '50% 0%'
							});
						}
						// show the pointers for the inviewport rows
						$rowsViewport.find('a.ss-circle').addClass('ss-circle-deco');
						// set positions for each row
						placeRows();
						
					},
					// defines a selector that gathers the row elems that are initially visible.
					// the element is visible if its top is less than the window's height.
					// these elements will not be affected when scrolling the page.
					defineViewport	= function() {
					
						$.extend( $.expr[':'], {
						
							inviewport	: function ( el ) {
								if ( $(el).offset().top < winSize.height ) {
									return true;
								}
								return false;
							}
						
						});
					
					},
					// checks which rows are initially visible 
					setViewportRows	= function() {
						
						$rowsViewport 		= $rows.filter(':inviewport');
						$rowsOutViewport	= $rows.not( $rowsViewport )
						
					},
					// get window sizes
					getWinSize		= function() {
					
						winSize.width	= $win.width();
						winSize.height	= $win.height();
					
					},
					// initialize some events
					initEvents		= function() {
						
						// navigation menu links.
						// scroll to the respective section.
						$links.on( 'click.Scrolling', function( event ) {
							
							// scroll to the element that has id = menu's href
							$('html, body').stop().animate({
								scrollTop: $( $(this).attr('href') ).offset().top
							}, scollPageSpeed, scollPageEasing );
							
							return false;
						
						});
						
						$(window).on({
							// on window resize we need to redefine which rows are initially visible (this ones we will not animate).
							'resize.Scrolling' : function( event ) {
								
								// get the window sizes again
								getWinSize();
								// redefine which rows are initially visible (:inviewport)
								setViewportRows();
								// remove pointers for every row
								$rows.find('a.ss-circle').removeClass('ss-circle-deco');
								// show inviewport rows and respective pointers
								$rowsViewport.each( function() {
								
									$(this).find('div.ss-left')
										   .css({ left   : '0%' })
										   .end()
										   .find('div.ss-right')
										   .css({ right  : '0%' })
										   .end()
										   .find('a.ss-circle')
										   .addClass('ss-circle-deco');
								
								});
							
							},
							// when scrolling the page change the position of each row	
							'scroll.Scrolling' : function( event ) {
								
								// set a timeout to avoid that the 
								// placeRows function gets called on every scroll trigger
								if( anim ) return false;
								anim = true;
								setTimeout( function() {
									
									placeRows();
									anim = false;
									
								}, 10 );
							
							}
						});
					
					},
					// sets the position of the rows (left and right row elements).
					// Both of these elements will start with -50% for the left/right (not visible)
					// and this value should be 0% (final position) when the element is on the
					// center of the window.
					placeRows		= function() {
						
							// how much we scrolled so far
						var winscroll	= $win.scrollTop(),
							// the y value for the center of the screen
							winCenter	= winSize.height / 2 + winscroll;
						
						// for every row that is not inviewport
						$rowsOutViewport.each( function(i) {
							
							var $row	= $(this),
								// the left side element
								$rowL	= $row.find('div.ss-left'),
								// the right side element
								$rowR	= $row.find('div.ss-right'),
								// top value
								rowT	= $row.offset().top;
							
							// hide the row if it is under the viewport
							if( rowT > winSize.height + winscroll ) {
								
								if( perspective ) {
								
									$rowL.css({
										'-webkit-transform'	: 'translate3d(-75%, 0, 0) rotateY(-90deg) translate3d(-75%, 0, 0)',
										'opacity'			: 0
									});
									$rowR.css({
										'-webkit-transform'	: 'translate3d(75%, 0, 0) rotateY(90deg) translate3d(75%, 0, 0)',
										'opacity'			: 0
									});
								
								}
								else {
								
									$rowL.css({ left 		: '-50%' });
									$rowR.css({ right 		: '-50%' });
								
								}
								
							}
							// if not, the row should become visible (0% of left/right) as it gets closer to the center of the screen.
							else {
									
									// row's height
								var rowH	= $row.height(),
									// the value on each scrolling step will be proporcional to the distance from the center of the screen to its height
									factor 	= ( ( ( rowT + rowH / 2 ) - winCenter ) / ( winSize.height / 2 + rowH / 2 ) ),
									// value for the left / right of each side of the row.
									// 0% is the limit
									val		= Math.max( factor * 50, 0 );
									
								if( val <= 0 ) {
								
									// when 0% is reached show the pointer for that row
									if( !$row.data('pointer') ) {
									
										$row.data( 'pointer', true );
										$row.find('.ss-circle').addClass('ss-circle-deco');
									
									}
								
								}
								else {
									
									// the pointer should not be shown
									if( $row.data('pointer') ) {
										
										$row.data( 'pointer', false );
										$row.find('.ss-circle').removeClass('ss-circle-deco');
									
									}
									
								}
								
								// set calculated values
								if( perspective ) {
									
									var	t		= Math.max( factor * 75, 0 ),
										r		= Math.max( factor * 90, 0 ),
										o		= Math.min( Math.abs( factor - 1 ), 1 );
									
									$rowL.css({
										'-webkit-transform'	: 'translate3d(-' + t + '%, 0, 0) rotateY(-' + r + 'deg) translate3d(-' + t + '%, 0, 0)',
										'opacity'			: o
									});
									$rowR.css({
										'-webkit-transform'	: 'translate3d(' + t + '%, 0, 0) rotateY(' + r + 'deg) translate3d(' + t + '%, 0, 0)',
										'opacity'			: o
									});
								
								}
								else {
									
									$rowL.css({ left 	: - val + '%' });
									$rowR.css({ right 	: - val + '%' });
									
								}
								
							}	
						
						});
					
					};
				
				return { init : init };
			
			})();
			
			$sidescroll.init();
			
		});
		</script>
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
</body>
</html>