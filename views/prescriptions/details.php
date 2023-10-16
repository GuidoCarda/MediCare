<?php 
  $prescriptionDetail = $data['prescriptionDetail'] ?? [];
  $prescriptionHistory = $data['prescriptionHistory'] ?? [];

  //Descarto el primer registro del historial ya que coincide con el detalle del
  //ultimo registro a mostrarse
  array_shift($prescriptionHistory);
  
?>

<section class="container" id="prescription-details">
  <h1 class="section-title">Prescripcion</h1>
  
  <h2 class="section-subtitle">Mi prescripcion </h1>

  
  <div>
    <h3><?php echo $prescriptionDetail['name'] . ' '. $prescriptionDetail['lastName'] ?></h3>
    <span class="badge "><?php echo $prescriptionDetail['specialty'];?></span>
  </div>
  
  <h2 class="section-subtitle">Detalles</h2>

  <p>Fecha: <?php echo $prescriptionDetail['created_at']?></p>
  <p>Nombre comercial: <?php echo $prescriptionDetail['generic_name']; ?></p>
  <p>Droga: <?php echo $prescriptionDetail['drug'] ?></p>
  <p>Tipo: <?php echo $prescriptionDetail['medicine_type']?></p>
  <p>Cantidad: <?php echo $prescriptionDetail['quantity'] . ' ' . pluralizeIfNeeded($prescriptionDetail['quantity'],$prescriptionDetail['medicine_unit']) ?> </p>
  <p>Frecuencia: <?php echo $prescriptionDetail['frequency']?></p>
  
  <!-- <p>Estado: Activo</p> -->


  <h2 class="section-subtitle">Historial</h2>

  <?php foreach($prescriptionHistory as $record): ?>
    <p>Fecha: <?php echo $record['created_at']; ?></p>
    <p>Cantidad: <?php echo $record['quantity'] . ' ' . pluralizeIfNeeded($record['quantity'], $record['medicine_unit']); ?></p>
    <p>Frecuencia: <?php echo $record['frequency']; ?></p>
  <?php endforeach; ?>


<button class="btn primary">
  Actualizar
</button>
</section>

<script>
  const url = new URL(window.location);
  const currentPath = url.pathname;

  document.querySelector('.btn.primary').addEventListener(
    'click',
    ()=>{
      window.location.href = `${currentPath}/edit`;
    }
  )
</script>
