<?php 
  if(isset($data['professional'])){
    $professional = $data['professional'];
  }
?>

<section class="container" id="professionals-details">
  <h1 class="section-title">Profecionales</h1>
  
  <h2 class="section-subtitle">Mis profecionales </h1>

    <?php if(!isset($professional)): ?>
      <p>El profecional buscado no existe</p>
    <?php else: ?> 
      <article>
        <div>
          <h2><?php echo $professional['name'] . ' ' . $professional['lastName'] ?></h2>
          <span><?php echo $professional['specialty']?></span>
        </div>
        <h2>Datos de contacto</h2>
        <p><?php echo $professional['phone_number']; ?></p>
        <p> <?php echo $professional['email']; ?></p>
      </article>

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
