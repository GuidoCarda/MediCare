<section class="container" id="professionals-list">
  <h1 class="section-title">Profesionales</h1>
  <button class="btn primary" onclick="window.location.href='professional/new'">
    Nuevo profesional
  </button>

  <h2 class="section-subtitle">Mis profesionales</h1>
  
  <ul>
    <?php if(empty($data)): ?>
      <li>No hay profesionales cargados</li>
    <?php endif; ?>

    <?php foreach($data as $professional): ?>
      <li>
        <a href="professional/<?php echo $professional['id'];?>">
          <article>
            <div>
              <h2><?php echo $professional['name'] . ' ' . $professional['lastName'];?></h2>
              <span class="badge sm"><?php echo $professional['specialty'] ;?></span>
            </div>
            <p><?php echo $professional['phone_number']; ?>  </p>
            <p><?php echo $professional['email']; ?></p>
          </article>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</section>
