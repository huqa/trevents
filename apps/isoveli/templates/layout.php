<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
  <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->getIsSuperAdmin()):?>
	<div class="container">
		<div class="navbar">
			<div class="navbar-inner">
				<a class="brand" href="/isoveli/">ISOVELI</a>
				<ul class="nav">
					<li><a href="<?php echo url_for('event')?>">EVENTS</a></li>
					<li><a href="<?php echo url_for('category')?>">GENRES</a></li>
					<li><a href="<?php echo url_for('organizer')?>">ORGANIZERS</a></li>
					<li><a href="<?php echo url_for('sf_guard_user')?>">GUARD USERS</a></li>
				</ul>
				<ul class="nav pull-right">
					<li><a href="<?php echo url_for('sf_guard_signout')?>">LOGOUT</a></li>
				</ul>
			</div>
		</div>
    	<?php echo $sf_content ?>
	<?php elseif ($sf_context->getModuleName() === 'sfGuardAuth'): ?>
    	<?php echo $sf_content ?>
    <?php else: ?>
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="main_bar">
				<div class="mainbar_inner">
					<div class="trevent_banner">
						<h1>HUPS! SIVUA EI LÖYTYNYT.</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span8">
		</div>
		<div class="span4"></div>
	</div>
</div>
    <?php endif; ?>
  </body>
</html>
