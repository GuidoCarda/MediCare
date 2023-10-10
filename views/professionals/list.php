<section class="container" id="professionals-list">
  <h1 class="section-title">Profecionales</h1>
  <button class="btn primary" onclick="window.location.href='professional/new'">
    Cargar profecional
  </button>

  <h2 class="section-subtitle">Mis profecionales</h1>
  
  <ul>
    <?php if(empty($data)): ?>
      <li>No hay profecionales cargados</li>
    <?php endif; ?>

    <?php foreach($data as $professional): ?>
      <li>
        <a href="professional/<?php echo $professional['id'];?>">
          <article>
            <div>
              <h2><?php echo $professional['name'] ;?></h2>
              <span><?php echo $professional['specialty'] ;?></span>
            </div>
            <p><?php echo $professional['phone_number']; ?>  </p>
            <p><?php echo $professional['email']; ?></p>
          </article>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</section>
