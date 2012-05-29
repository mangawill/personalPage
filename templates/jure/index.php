<?php
defined('_JEXEC') or die;

$document = &JFactory::getDocument();
$menu = & JSite::getMenu();

$rssDisable = true;
if($rssDisable) unset($document->_links);

if (isset($this->_script['text/javascript']))
{
  $this->_script['text/javascript'] = preg_replace('%window\.addEvent\(\'load\',\s*function\(\)\s*{\s*new\s*JCaption\(\'img.caption\'\);\s*}\);\s*%', '', $this->_script['text/javascript']);
if (empty($this->_script['text/javascript']))
  unset($this->_script['text/javascript']);
}


?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie6" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 7]>    <html class="ie7" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="ie8" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="ie9" lang="<?php echo $this->language; ?>"> <!--<![endif]-->

<head>
	<?php $this->_scripts = array(); ?>
	<jdoc:include type="head" />
	<link href="http://feeds.feedburner.com/JuresStern" onClick="_gaq.push(['_trackEvent', 'subscribe', 'rss', 'left']);" rel="alternate" type="application/rss+xml" title="Jures Blog Feed" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/jure/css/style.css">
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/jure/css/desert.css" />
	
	<link rel="shortcut icon" href="<?php echo $this->baseurl ?>/templates/jure/favicon.ico" />
  <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
  <link rel="apple-touch-icon-precomposed" href="<?php echo $this->baseurl ?>/templates/jure/apple-touch-icon-precomposed.png" />
  <!-- For first- and second-generation iPad: -->
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->baseurl ?>/templates/jure/apple-touch-icon-72x72-precomposed.png" />
  <!-- For iPhone with high-resolution Retina display: -->
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->baseurl ?>/templates/jure/apple-touch-icon-114x114-precomposed.png" />
  <!-- For third-generation iPad with high-resolution Retina display: -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->baseurl ?>/templates/jure/apple-touch-icon-144x144-precomposed.png" />
  
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
	
	<script type="text/javascript">
		(function(doc) {
			var addEvent = 'addEventListener',
		    type = 'gesturestart',
		    qsa = 'querySelectorAll',
		    scales = [1, 1],
		    meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];
		
			function fix() {
				meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
				doc.removeEventListener(type, fix, true);
			}
		
			if ((meta = meta[meta.length - 1]) && addEvent in doc) {
				fix();
				scales = [.25, 1.6];
				doc[addEvent](type, fix, true);
			}
		}(document));
	</script>

</head>
<body onload="prettyPrint()">
  <header id="header">			
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="<?php echo $this->baseurl ?>">
            <span class="jure"><?php  echo JText::_('JS'); ?></span>
            <span class="title"><?php  echo JText::_('JSS'); ?></span>
          </a>
          <?php if($this->countModules('jezik')) : ?>
          <div class="jezik">
          	<jdoc:include type="modules" name="jezik" style="xhtml"/>
          	<a href="https://twitter.com/JureStern" class="twitter-follow-button" data-show-count="false">Follow @JureStern</a>
          	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          </div>
          <?php endif; ?>
          <?php if($this->countModules('nav')) : ?>
          <nav id="menu" class="nav-collapse collapse">
           <jdoc:include type="modules" name="nav" style="jure"/>
          </nav>
          <?php endif; ?>
        </div>
      </div>
    </div>		
  </header><!-- header -->
  
  <div id="mainContainer" class="container"> 
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
      <section id="nogaKontejner" class="container">
        <div class="row">
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
          <div class="row clearfix">
            <jdoc:include type="modules" name="user5" style="noga"/>
          </div>
          <?php endif; ?>
        </div>
      </section><!-- nogaKontejner -->
    </footer><!-- nogaStran -->
    
		<?php if($this->countModules('debug')) : ?>
		<p><jdoc:include type="modules" name="debug" /></p>
		<?php endif; ?>
		<?php if($this->countModules('message')) : ?>
		<p><jdoc:include type="modules" name="message" /></p>
		<?php endif; ?>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script src="<?php echo $this->baseurl ?>/templates/jure/js/mylibs/jquery.easing.1.3.js"></script>
  <script src="<?php echo $this->baseurl ?>/templates/jure/js/bootstrap.min.js"></script>
  <script src="<?php echo $this->baseurl ?>/templates/jure/js/googlePrettify/prettify.js"></script>
  <script src="<?php echo $this->baseurl ?>/templates/jure/js/numberLines.js"></script>
 
  <script defer src="<?php echo $this->baseurl ?>/templates/jure/js/script.js"></script>
  <?php if ($menu->getActive() == $menu->getDefault( 'en-GB' )) {
  	echo "<script defer src='$this->baseurl/templates/jure/js/dribbbleStats.js'></script><script src='$this->baseurl/templates/jure/js/mylibs/jquery.jribbble-1.0.0.ugly.js'></script>";
  }?>
  <?php if ($menu->getActive() == $menu->getDefault( 'sl-SI' )) {
  	echo "<script defer src='$this->baseurl/templates/jure/js/dribbbleStats.js'></script><script src='$this->baseurl/templates/jure/js/mylibs/jquery.jribbble-1.0.0.ugly.js'></script>";
  }?>
	
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-6253698-6']);
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