<?php 

 
  if(isset($data['professional'])){
    $professional = $data['professional'];
    // var_dump($professional);
  }
?>

<section class="container" id="professionals-details">
  <h1 class="section-title">Profesionales</h1>
  <h2 class="section-subtitle">Mis profesionales </h1>

  <?php if(!isset($professional)): ?>
    <h2 class="section-subtitle">El profesional buscado no existe</h2>
  <?php else: ?> 
    <div class="professional">
      <h2><?php echo $professional['name'] . ' ' . $professional['lastName'] ?></h2>
      <span class="badge"><?php echo $professional['specialty']?></span>
    </div>
    <h2 class="section-subtitle">Datos de contacto</h2>
    <p>Telefono<?php echo $professional['phone_number']; ?></p>
    <p>Numero de matricula<?php echo $professional['license_number']; ?></p>
    <p>Email<?php echo $professional['email']; ?></p>

    <button class="btn primary">
      Modificar
    </button>
  
  
  <?php endif; ?>
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
