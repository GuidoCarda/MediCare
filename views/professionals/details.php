<?php
if (isset($data['professional'])) {
  $professional = $data['professional'];
}
?>

<section class="container" id="professional-details">
  <h1 class="section-title">Profesionales</h1>
  <h2 class="section-subtitle">Mis profesionales </h1>

    <?php if (!isset($professional)) : ?>
      <h2 class="section-subtitle">El profesional buscado no existe</h2>
    <?php else : ?>
      <div class="professional">
        <h2><?php echo $professional['name'] . ' ' . $professional['lastName'] ?></h2>
        <span class="badge"><?php echo $professional['specialty'] ?></span>
      </div>

      <div class="contact-data">
        <dl>
          <div class="data-row">
            <dt>Numero de matricula</dt>
            <dd><?php echo $professional['license_number']; ?></dd>
          </div>

          <div class="data-row">
            <dt>Email</dt>
            <dd><?php echo $professional['email']; ?></dd>
          </div>

          <div class="data-row">
            <dt>Numero de telefono</dt>
            <dd><?php echo $professional['phone_number']; ?></dd>
          </div>
        </dl>
      </div>

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
    () => {
      window.location.href = `${currentPath}/edit`;
    }
  )
</script>