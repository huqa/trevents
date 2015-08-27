<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $sf_user->getCulture() ?>" lang="<?php echo $sf_user->getCulture() ?>">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php //include_title() ?>
<title>Tampere Events -tapahtumakalenteri - trevents.fi</title>
<link rel="shortcut icon" href="/favicon.ico" />
<?php include_stylesheets() ?>
<?php include_javascripts() ?>
</head>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46514240-1', 'trevents.fi');
  ga('send', 'pageview');

</script>
<body>
	<?php if($sf_context->getModuleName() === 'organize' || $sf_context->getModuleName() === 'sfGuardAuth'):?>
	<div class="container">
		<div class="navbar">
			<div class="navbar-inner">
				<?php if(!$sf_user->isAuthenticated()):?>
				<a class="brand" href="/">TREVENTS ORGANIZER</a>
				<?php elseif($sf_user->isAuthenticated()):?>
				<a class="brand" href="/organize">TREVENTS ORGANIZER</a>
				<ul class="nav">
					<li><a href="<?php echo url_for('organize/index')?>">OMAT TAPAHTUMAT</a></li>
					<li><a href="<?php echo url_for('organize/new')?>">LUO TAPAHTUMA</a></li>
					<li><a href="<?php echo url_for('organize/about')?>">TIETOJA</a></li>
					<li><a href="<?php echo url_for('events/index')?>">ETUSIVU</a></li>
				</ul>
				<ul class="nav pull-right">
					<li><a href="<?php echo url_for('@sf_guard_signout')?>">KIRJAUDU ULOS</a></li>
				</ul>
				<?php endif; ?>
			</div>
		</div>
		<?php echo $sf_content ?>
	</div>
	<?php else: ?>
	<!-- trevents main leiska -->
		<?php echo $sf_content; ?>
	<?php endif;?>
</body>
</html>
