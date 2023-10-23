<?php
$prescription = $data['prescription'];
$medicineTypes = $data['medicineTypes'];
$frequencies = $data['frequencies'];
$professionals = $data['professionals'];
if (!$prescription) {
  header('Location: /medicare/prescription');
}
?>

<section class="container" id="prescriptions-edit">
  <div>
    <a href="/medicare/prescription" class="return-link" >
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M5 12l14 0" />
        <path d="M5 12l4 4" />
        <path d="M5 12l4 -4" />
      </svg>
      <span>Volver</span>
    </a>
    <h1 class="section-title">Prescripciones</h1>
  </div>

  <h2 class="section-subtitle">Actualizar prescripción</h2>
  <form class="new-form" method="post">
    <div class="form-group">
      <label for="last_date">Fecha ultima actualización</label>
      <input 
        type="date" 
        class="text-input" 
        name="last_date" 
        id="last_date" 
        value="<?= $prescription['created_at']; ?>" 
        readonly 
      />
    </div>

    <div class="form-group">
      <label for="created_at">Fecha actualizacion</label>
      <input 
        type="date" 
        class="text-input" 
        name="created_at" 
        id="created_at" 
        value="<?= $prescription['created_at']; ?>" 
        min="<?= $prescription['created_at']; ?>" 
        max="<?= date('Y-m-d')?>"
        required 
      />
    </div>

    <div class="form-group">
      <label for="generic_name">Nombre comercial</label>
      <input 
        type="text" 
        class="text-input" 
        name="generic_name" 
        id="generic_name" 
        value="<?= $prescription['generic_name']; ?>"
        readonly 
      />
    </div>
    <div class="form-group">
      <label for="drug">Droga</label>
      <input 
        type="text" 
        class="text-input" 
        name="drug" 
        id="drug" 
        value="<?= $prescription['drug']; ?>" 
        readonly 
      />
    </div>

    <div class="form-group">
      <label for="medicine_type">Tipo medicina</label>
      <input 
        type="text" 
        class="text-input" 
        name="medicine_type" 
        id="medicine_type" 
        value="<?= $prescription['medicine_type']; ?>" 
        readonly 
      />
    </div>

    <div class="form-group">
      <label for="quantity">Dosis a consumir</label>
      <input 
        type="text" 
        class="text-input" 
        name="quantity" 
        id="quantity" 
        value="<?= $prescription['quantity']; ?>" 
        required 
      />
    </div>

    <div class="form-group">
      <label for="professional_id">Frecuencia</label>

      <select class="select" name="frequency_id" id="frequency_id" required>
        <?php foreach ($frequencies as $frequency) : ?>
          <?php if ($frequency['id'] == $prescription['frequency_id']) : ?>
            <option value="<?php echo $frequency['id']; ?>" selected> <?= $frequency['denomination']  ?></option>
          <?php else : ?>
            <option value="<?php echo $frequency['id']; ?>"><?= $frequency['denomination']; ?></option>
          <?php endif; ?>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="professional_id">Profecional</label>

      <select class="select" name="professional_id" id="professional_id" required>
        <?php foreach ($professionals as $professional) : ?>
          <option 
            value="<?= $professional['id'] ?>" 
            <?= $professional['id'] == $prescription['professional_id'] ? 'selected': ''?> 
          >
            <?= $professional['name'] . ' ' . $professional['lastName'] . ' | ' . $professional['specialty'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <footer>
      <button type="button" id="cancel-btn" class="btn secondary">
        cancelar
      </button>
      <button 
        class="btn primary" id="confirm-btn" 
        <?php echo empty($professionals) ? 'disabled' : '' ?> 
      >
      Cargar
    </button>
  </footer>
</form>
</section>

<script>
  const form = document.querySelector('.new-form');
  const cancelBtn = document.querySelector('#cancel-btn');

  // Si el usuario hace submit, valido los datos del formulario
  form.addEventListener('submit', handleSubmit);
  // Si el usuario hace click en cancelar, le pregunto si esta seguro que desea cancelar la carga.
  cancelBtn.addEventListener('click', () => handleCancelConfirmation('/medicare/prescription'));
  
  function handleSubmit(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);


    if (!isValidQuantity(data.quantity)) {
      alert('La cantidad debe ser un numero entero positivo');
      return;
    }

    form.submit();
  }

</script>