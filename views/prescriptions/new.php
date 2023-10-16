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
        <label for="created_at">Fecha</label>
        <input type="date" class="text-input" name="created_at" id="created_at" required/>
    </div>

    <div class="form-group">
      <label for="generic_name">Nombre comercial</label>
      <input
        type="text"
        class="text-input"
        name="generic_name"
        id="generic_name"
        required
      />
    </div>
    <div class="form-group">
      <label for="drug">Droga</label>
      <input type="text" class="text-input" name="drug" id="drug" required />
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
      <input type="text" class="text-input" name="quantity" id="quantity" required/>
    </div>

    <div class="form-group">
      <label for="professional_id">Frecuencia</label>

      <select class="select" name="frequency_id" id="frequency_id" required>
        <?php foreach($frequencies as $frequency) : ?>
          <option value="<?php echo $frequency['id']; ?>"><?php echo $frequency['denomination']; ?></option>
        <?php endforeach; ?>      
      </select>
    </div>
    <?php if(empty($professionals)): ?>
      <p>No hay profesionales cargados</p>
      <button  type='button' class="btn primary" onclick="window.location.href='/medicare/professional/new'" >Cargar Profesional</button>
    <?php else: ?>
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
    <?php endif; ?>

    <footer>
      <button
        type="button"
        class="btn secondary"
        id="cancel-btn"
      >
        cancelar
      </button>
      <button class="btn primary" <?php if(empty($professionals)){ echo 'disabled';} ?> >Cargar</button>
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

  // function isValidQuantity(quantity){
  //   const quantityRegex = /^[0-9]+$/;
  //   return quantityRegex.test(quantity);
  // }
  
  const cancelBtn = document.querySelector('#cancel-btn');

  cancelBtn.addEventListener('click', ()=>{
    const confirm = window.confirm('¿Estas seguro que deseas cancelar? Los cambios no se guardaran');

    if(confirm){
      window.location.href='/medicare/prescription'
    }
  });
</script>