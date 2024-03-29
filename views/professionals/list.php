<section class="container" id="professionals-list">
  <header class="section-header">
    <h1 class="section-title">Profesionales</h1>
    <button class="btn primary" onclick="window.location.href='professional/new'">
      Nuevo profesional
    </button>
  </header>

  <h2 class="section-subtitle">Mis profesionales</h1>

    <ul>
      <?php if (empty($data)) : ?>
        <li>No hay profesionales cargados</li>
      <?php endif; ?>

      <?php foreach ($data as $professional) : ?>
        <li>
          <a href="professional/<?php echo $professional['id']; ?>">
            <article>
              <div>
                <h2><?php echo $professional['name'] . ' ' . $professional['lastName']; ?></h2>
                <span class="badge sm"><?php echo $professional['specialty']; ?></span>
              </div>
              <span class="phone-number">telefono: <?php echo $professional['phone_number']; ?> </span>
              <span class="email">email: <?php echo $professional['email']; ?></span>
            </article>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
</section>