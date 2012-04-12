<?php
defined('_JEXEC') or die;
$document = &JFactory::getDocument();
$menu = & JSite::getMenu();
$rssDisable = true;
if($rssDisable) unset($document->_links);
?>
<!doctype html>
<head>
<?php if (JRequest::getVar('option')!=='com_chronoforms' && JRequest::getVar('option')!=='com_content') { ?>
	<?php $this->_scripts = array(); ?>
<?php } ?>
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
			<div class="container">
				<header id="header" class="row">
					<a class="jure span2" href="<?php echo $this->baseurl ?>">
					<span><?php  echo JText::_('JS'); ?></span>
					<p><?php  echo JText::_('JSS'); ?></p>
					</a>
					<?php if($this->countModules('nav')) : ?>
					<nav id="nav" class="span10">
					<jdoc:include type="modules" name="nav" style="jure"/>
					</nav>
				<?php endif; ?>
				</header><!-- header -->	
				
				<?php if($this->countModules('reklama')) : ?>
				<div id="reklama" class="row">
				  <div class="span12">
					 <jdoc:include type="modules" name="reklama" style="reference"/>
				  </div>
				</div><!-- Reklama -->
				<?php endif; ?>	
				
				<div class="row vsebina">
				<?php //remove breadcrubs from homepage
					if ($menu->getActive() != $menu->getDefault( 'en-GB' ) && $menu->getActive() != $menu->getDefault( 'sl-SI' )) {
						echo '<div id="drobtinice" class="span12"><jdoc:include type="modules" name="drobtinice" style="navadno"/></div>';
					}?>
					<?php if($this->countModules('slogan')) : ?>
  						<aside id="slogan" class="span12">
  						  <jdoc:include type="modules" name="slogan" style="slogan"/>
  						</aside>
					<?php endif; ?>

    					<div class="<?php echo $contentWidth; ?>">
    					 <jdoc:include type="component" />
      		    </div>
    					<?php if($this->countModules('desno')) : ?>
    					<aside class="span4">
    						<jdoc:include type="modules" name="desno" style="desno"/>
    					</aside>
    					<?php endif; ?>
				</div><!-- row -->
				<div class="row">
				  
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
					<section id="nogaKontejner" class="row">
					<h4 class="skrij">Še več informacij</h4>
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
					<div class="span12">
						<h5 class="skrij">Hitra navigacija</h5>
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
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script src="<?php echo $this->baseurl ?>/templates/jure/js/mylibs/jquery.roundabout.min.js"></script>
  <script src="<?php echo $this->baseurl ?>/templates/jure/js/mylibs/jquery.easing.1.3.js"></script>
  <script src="<?php echo $this->baseurl ?>/templates/jure/js/mylibs/jquery.fancybox-1.3.4.pack.js"></script>
  <script src="<?php echo $this->baseurl ?>/templates/jure/js/mylibs/mosaic.1.0.1.min.js"></script>
  <script defer src="<?php echo $this->baseurl ?>/templates/jure/js/plugins.js"></script>
  <script defer src="<?php echo $this->baseurl ?>/templates/jure/js/script.js"></script>
  <!--[if IE]>
  <script src="http://jure-stern.si/templates/jure/js/mylibs/jquery.easyListSplitter.js"></script>
  <script src="<?php echo $this->baseurl ?>/templates/jure/js/excanvas.compiled.js"></script>
  <script>
  jQuery.noConflict();
  jQuery(document).ready(function ($) {
		$('.potovanje').easyListSplitter({ 
			colNumber: 5
		});
});
  </script>
	<![endif]-->
<script>  
jQuery.noConflict();
  jQuery(document).ready(function($) {

$('.fade').mosaic();

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
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
  
  
  
  
  
  <!--
<div class="panel">
<div class="zvezd"></div>
<?php if($this->countModules('iskanje')) : ?>
	<div class="iskanje">
		<jdoc:include type="modules" name="iskanje" style="xhtml"/>
	</div>
<?php endif; ?>
<?php if($this->countModules('jezik')) : ?>
	<div class="jezik">
		<jdoc:include type="modules" name="jezik" style="xhtml"/>
	</div>
<?php endif; ?>
<?php if($this->countModules('follow')) : ?>
	<div class="follow">
		<jdoc:include type="modules" name="follow" style="xhtml"/>
	</div>
<?php endif; ?>
<div class="zvezd1"></div>
</div><!-- panel -->
</body>
</html>