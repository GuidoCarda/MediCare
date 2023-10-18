<?php
$prescriptionDetail = $data['prescriptionDetail'] ?? [];
$prescriptionHistory = $data['prescriptionHistory'] ?? [];

//Descarto el primer registro del historial ya que coincide con el detalle del
//ultimo registro a mostrarse
array_shift($prescriptionHistory);

function getProfessionalAction($status, $prescriptionIndex)
{
  global $prescriptionHistory;

  if ($status === 0) {
    return 'suspendió';
  }

  if ($status === 1 && $prescriptionIndex === 0) {
    return 'Recetó';
  }

  return 'actualizó';
}

?>

<section class="container" id="prescription-details">

  <header class="section-header">
    <h1 class="section-title">Prescripciones</h1>
    <?php if ($prescriptionDetail) : ?>
      <button class="btn primary">
        Actualizar
      </button>
    <?php endif; ?>
  </header>
  <h2 class="section-subtitle">Detalles prescripcion </h1>
    <?php if (!$prescriptionDetail) : ?>
      <h2 class="section-subtitle">La prescripcion buscada no existe</h2>
    <?php else : ?>
      <div class="professional">
        <h2><?php echo $prescriptionDetail['name'] . ' ' . $prescriptionDetail['lastName'] ?></h2>
        <span class="badge"><?php echo $prescriptionDetail['specialty'] ?></span>
      </div>

      <div class="prescription-data">
        <dl>
          <div class="data-row">
            <dt>Ultima actualizacion</dt>
            <dd><?php echo $prescriptionDetail['created_at'] ?></dd>
          </div>

          <div class="data-row">
            <dt>Nombre comercial</dt>
            <dd><?php echo $prescriptionDetail['generic_name'] ?></dd>
          </div>
          <div class="data-row">
            <dt>Droga</dt>
            <dd><?php echo $prescriptionDetail['drug'] ?></dd>
          </div>
          <div class="data-row">
            <dt>Tipo medicina</dt>
            <dd><?php echo $prescriptionDetail['medicine_type'] ?></dd>
          </div>
          <div class="data-row">
            <dt>Cantidad</dt>
            <dd><?php echo $prescriptionDetail['quantity'] . ' ' . pluralizeIfNeeded($prescriptionDetail['quantity'], $prescriptionDetail['medicine_unit']) ?></dd>
          </div>
          <div class="data-row">
            <dt>Frecuencia</dt>
            <dd><?php echo $prescriptionDetail['frequency'] ?></dd>
          </div>
        </dl>
      </div>

      <h2 class="section-subtitle">Historial</h2>
      <?php if (count($prescriptionHistory) === 0) : ?>
        <div class="no-history">
          No hay prescripciones previas para este medicamento
        </div>
      <?php else : ?>

        <ul class="prescription-history">
          <?php foreach ($prescriptionHistory as $key => $record) : ?>
            <li class="record <?php echo $record['is_active'] === 0 ? 'suspended' : '' ?>">
              <div class="record-header">
                <a href="/medicare/professional/<?php echo $record['professional_id'] ?>" class="professional">
                  <?php echo $record['name'] . ' ' . $record['lastname']; ?>
                </a>
                <span class="badge">
                  <?php echo getProfessionalAction($record['is_active'], $key);  ?>
                </span>
                <span class="date"><?php echo $record['created_at']; ?></span>
              </div>
              <?php if ($record['is_active'] === 1) : ?>
                <div class="record-footer">
                  <span class="quantity"><?php echo $record['quantity'] . ' ' . pluralizeIfNeeded($record['quantity'], $record['medicine_unit']); ?></span>
                  <span class="frecuency">Frecuencia: <?php echo $record['frequency']; ?></span>
                </div>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    <?php endif; ?>
</section>

<script>
  const url = new URL(window.location);
  const currentPath = url.pathname;

  document.querySelector('.btn.primary').addEventListener(
    'click',
    () => {
      window.location.href = `${currentPath}/edit`;
    }
  )
</script>