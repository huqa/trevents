<?php use_helper('I18N') ?>
<h3><?php echo __('Kirjaudu sisään', null, 'sf_guard') ?></h3>

<?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>