<?php use_helper('I18N') ?>

<h2><?php echo __('Jahas.... o_o tämä sivusto on suojattu ja tarvitsee kirjautumisen.', null, 'sf_guard') ?></h2>

<p><?php echo sfContext::getInstance()->getRequest()->getUri() ?></p>

<h3><?php echo __('Kirjaudu sisään tästä linkistä', null, 'sf_guard') ?></h3>

<?php echo get_component('sfGuardAuth', 'signin_form') ?>