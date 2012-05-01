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
				
		<div class="row">
  		<div class="span12">
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
  		</div><!-- span12 -->
		</div><!-- row -->
		
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
    
    html.push('<ul class="achivementList clearfix"><li><div class="number">' + player.shots_count  + '</div>' + '<div class="icon"><i class="icon-camera"></i></div>' + '<br />shots</li>');
    html.push('<li><div class="number">' + player.following_count + '</div>' + '<div class="icon"><i class="icon-heart-empty"></i></div>' + '<br />following</li>');
    html.push('<li><div class="number">' + player.followers_count + '</div>' + '<div class="icon"><i class="icon-heart"></i></div>' + '<br />followers</li>');

    $('#playerProfile').html(html.join(''));
});

  </script>
<script>  
$(document).ready(function() {

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
</body>
</html>