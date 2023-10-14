<?php
  $medicineTypes = $data['medicineTypes'];
  $frequencies = $data['frequencies'];
  $professionals = $data['professionals'];
  if(isset($data['message'])){
    echo "<script>alert('{$data['message']}')</script>";
  }
?>


<section class="container" id="prescriptions-new">
  <h1 class="section-title">Prescripciones</h1>
  <h2 class="section-subtitle">Nueva prescripcion</h2>
  <form class="new-form" method="post">
    <div class="form-group">
      <label for="generic_name">Nombre comercial</label>
      <input
        type="text"
        class="text-input"
        name="generic_name"
        id="generic_name"
      />
    </div>
    <div class="form-group">
      <label for="drug">Droga</label>
      <input type="text" class="text-input" name="drug" id="drug" />
    </div>

    <div class="form-group">
      <label for="medicine_type">Tipo medicina</label>

      <select class="select" name="medicine_type" id="medicine_type" required>
        <?php foreach($medicineTypes as $medicineType) : ?>
          <option value="<?php echo $medicineType['id']; ?>">
            <?php echo $medicineType['denomination']; ?>
          </option>
        <?php endforeach;?>
      </select>
    </div>

    <div class="form-group">
      <label for="quantity">Cantidad</label>
      <input type="text" class="text-input" name="quantity" id="quantity" />
    </div>

    <div class="form-group">
      <label for="professional_id">Frecuencia</label>

      <select class="select" name="frequency_id" id="frequency_id" required>
        <?php foreach($frequencies as $frequency) : ?>
          <option value="<?php echo $frequency['id']; ?>"><?php echo $frequency['denomination']; ?></option>
        <?php endforeach; ?>      
      </select>
    </div>

    <div class="form-group">
      <label for="professional_id">Profecional</label>

      <select
        class="select"
        name="professional_id"
        id="professional_id"
        required
      >
      <?php foreach($professionals as $professional) : ?>
        <option value="<?php echo $professional['id']?>">
          <?php echo $professional['name'] . ' ' . $professional['lastName'] . ' | ' . $professional['specialty'] ?>
        </option>
      <?php endforeach; ?>
      </select>
    </div>

    <footer>
      <button
        type="button"
        class="btn secondary"
        onclick="window.location.href='/medicare/prescription'"
      >
        cancelar
      </button>
      <button class="btn primary">Cargar</button>
    </footer>
  </form>
</section>
