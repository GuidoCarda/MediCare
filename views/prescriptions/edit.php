<?php
  $prescription = $data['prescription'];
  $medicineTypes = $data['medicineTypes'];
  $frequencies = $data['frequencies'];
  $professionals = $data['professionals'];
  if(isset($data['message'])){
    echo "<script>alert('{$data['message']}')</script>";
  }
?>


<section class="container" id="prescriptions-edit">
  <h1 class="section-title">Prescripciones</h1>
  <h2 class="section-subtitle">Actualizar prescripcion</h2>
  <form class="new-form" method="post">
    <div class="form-group">
        <label for="last_date">Fecha ultima actualización</label>
        <input 
          type="date" 
          class="text-input" 
          name="last_date" 
          id="last_date" 
          value="<?php echo $prescription['created_at']; ?>"
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
          value="<?php echo $prescription['created_at']; ?>"
          min="<?php echo $prescription['created_at']; ?>"
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
        value="<?php echo $prescription['generic_name']; ?>"
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
        value="<?php echo $prescription['drug']; ?>"
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
        value="<?php echo $prescription['medicine_type']; ?>"
        readonly
      />
    </div>

    <div class="form-group">
      <label for="quantity">Cantidad</label>
      <input 
        type="text" 
        class="text-input" 
        name="quantity" 
        id="quantity"
        value="<?php echo $prescription['quantity']; ?>"
        required
        />
    </div>

    <div class="form-group">
      <label for="professional_id">Frecuencia</label>

      <select class="select" name="frequency_id" id="frequency_id" required>
        <?php foreach($frequencies as $frequency) : ?>
          <?php if($frequency['id'] == $prescription['frequency_id']): ?>
              <option value="<?php echo $frequency['id']; ?>" selected> <?php echo $frequency['denomination']  ?></option>
          <?php else: ?>
              <option value="<?php echo $frequency['id']; ?>"><?php echo $frequency['denomination']; ?></option>
          <?php endif; ?>
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
          <option 
            value="<?php echo $professional['id']?>" 
            <?php if($professional['id'] == $prescription['professional_id']){ echo 'selected';} ?>
          >
            <?php echo $professional['name'] . ' ' . $professional['lastName'] . ' | ' . $professional['specialty'] ?>
          </option>
        <?php endforeach; ?>
        </select>
    </div>

    <footer>
      <button
        type="button"
        id="cancel-btn"
        class="btn secondary"
      >
        cancelar
      </button>
      <button class="btn primary" id="confirm-btn" <?php if(empty($professionals)){ echo 'disabled';} ?> >Cargar</button>
    </footer>
  </form>
</section>

<script> 

  const form = document.querySelector('.new-form');

  form.addEventListener('submit', handleSubmit);

  function handleSubmit(e){
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);


    if(!isValidQuantity(data.quantity)){
      alert('La cantidad debe ser un numero entero positivo');
      return;
    }

    form.submit();
  }

  const cancelBtn = document.querySelector('#cancel-btn');

  cancelBtn.addEventListener('click', ()=>{
    const confirm = window.confirm('¿Estas seguro que deseas cancelar? Los cambios no se guardaran');

    if(confirm){
      window.location.href = '/medicare/prescription';
    }
  });
</script>
