<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('organize/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form['_csrf_token'] ?>
          &nbsp;<a href="<?php echo url_for('organize/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'organize/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['organizer_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['organizer_id']->renderError() ?>
          <?php echo $form['organizer_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['category_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['category_id']->renderError() ?>
          <?php echo $form['category_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['description']->renderLabel() ?></th>
        <td>
          <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['venue']->renderLabel() ?></th>
        <td>
          <?php echo $form['venue']->renderError() ?>
          <?php echo $form['venue'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['event_url']->renderLabel() ?></th>
        <td>
          <?php echo $form['event_url']->renderError() ?>
          <?php echo $form['event_url'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['start_time']->renderLabel() ?></th>
        <td>
          <?php echo $form['start_time']->renderError() ?>
          <?php echo $form['start_time'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['end_time']->renderLabel() ?></th>
        <td>
          <?php echo $form['end_time']->renderError() ?>
          <?php echo $form['end_time'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['price']->renderLabel() ?></th>
        <td>
          <?php echo $form['price']->renderError() ?>
          <?php echo $form['price'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['date']->renderLabel() ?></th>
        <td>
          <?php echo $form['date']->renderError() ?>
          <?php echo $form['date'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
