<?php
$prescriptions = $data['prescriptions'] ?? [];
?>

<section class="container" id="prescriptions-list">
  <header class="section-header">
    <h1 class="section-title">Prescripciones</h1>
    <button class="btn primary" onclick="window.location.href='prescription/new'">
      Nueva prescripcion
    </button>
  </header>
  <h2 class="section-subtitle">Mi tratamiento actual</h1>
    <?php if (empty($prescriptions)) : ?>
      <p>No hay prescripciones cargadas</p>
    <?php else : ?>
      <div class="prescription-table-container">
        <table class="prescriptions-table">
          <thead>
            <tr>
              <th>Nombre comercial</th>
              <th>Droga</th>
              <th>Tipo</th>
              <th>Cantidad</th>
              <th>Frecuencia</th>
              <th>Ultima act</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($prescriptions as $prescription) : ?>

              <tr>
                <td> <a href="prescription/<?php echo $prescription['id']; ?>"><?php echo $prescription['generic_name'] ?> <a /></td>
                <td><?php echo $prescription['drug'] ?></td>
                <td><?php echo $prescription['medicine_type'] ?></td>
                <td><?php echo $prescription['quantity'] ?></td>
                <td><?php echo $prescription['frequency'] ?></td>
                <td><?php formatDate($prescription['created_at']) ?></td>
                <td>
                  <button class="edit" onclick="window.location.href='/medicare/prescription/<?php echo $prescription['id'] ?>/edit'">Actualizar</button>
                  <button class="delete" type="button" onclick="window.location.href='/medicare/prescription/<?php echo $prescription['id'] ?>/delete'">Suspender</button>
                </td>
              </tr>

            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
</section>