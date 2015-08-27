<table class="well table table-condensed table-hover table-bordered">
  <tbody>
    <tr>
      <th>Tapahtuman nimi:</th>
      <td><?php echo $event->getName() ?></td>
    </tr>
    <tr>
      <th>Kuvaus:</th>
      <td><?php echo $event->getDescription() ?></td>
    </tr>
    <tr>
      <th>Paikka:</th>
      <td><?php echo $event->getVenue() ?></td>
    </tr>
    <tr>
      <th>Url:</th>
      <td><?php echo $event->getEventUrl() ?></td>
    </tr>
    <tr>
      <th>Alkamisaika:</th>
      <td><?php echo $event->getStartTime() ?></td>
    </tr>
    <tr>
      <th>Päättymisaika:</th>
      <td><?php echo $event->getEndTime() ?></td>
    </tr>
    <tr>
      <th>Hinta:</th>
      <td><?php echo $event->getPrice() ?></td>
    </tr>
    <tr>
      <th>Päivämäärä:</th>
      <td><?php echo $event->getDate() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a class="btn btn-info" href="<?php echo url_for('organize/edit?id='.$event->getId()) ?>">Muokkaa tapahtumaa</a>
&nbsp;
<a class="btn btn-info" href="<?php echo url_for('organize/index') ?>">Palaa tapahtumalistaan</a>
