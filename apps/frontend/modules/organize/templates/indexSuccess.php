<h3>Omat tapahtumat</h3>

<table class="table table-hover">
  <thead>
    <tr>
      <th>Pvm</th>
      <th>Alkaa</th>
      <th>Päättyy</th>
      <th>Nimi</th>
      <th>Kuvaus</th>
      <th>Paikka</th>
      <th>Hinta</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($events as $event): ?>
    <tr>
      <td><?php echo $event->getDateTimeObject('date')->format('d.m.Y') ?></td>
      <td><?php echo date('H:i', strtotime($event->getStartTime())) ?></td>
      <td><?php echo date('H:i', strtotime($event->getEndTime()))  ?></td>
      <td><a href="<?php echo url_for('organize/show?id='.$event->getId()) ?>"><?php echo $event->getName() ?></a></td>
      <td><?php echo $event->getDescription() ?></td>
      <td><?php echo $event->getVenue() ?></td>
      <td><?php echo $event->getPrice() ?> €</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

