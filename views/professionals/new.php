<?php
?>


<section class="container" id="professional-new">
  <div>
    <a href="/medicare/professional" class="return-link" >
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <path d="M5 12l14 0" />
          <path d="M5 12l4 4" />
          <path d="M5 12l4 -4" />
        </svg>
       <span>Volver</span>
    </a>
    <h1 class="section-title">Profecionales</h1>
  </div>
  <h2 class="section-subtitle">Formulario de carga</h2>
  <form class="new-form" method="post">
    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" class="text-input" name="name" id="name" required />
    </div>
    <div class="form-group">
      <label for="lastname">Apellido</label>
      <input type="text" class="text-input" name="lastname" id="lastname" required />
    </div>
    <div class="form-group">
      <label for="license_number">Numero matricula</label>
      <input type="text" class="text-input" name="license_number" id="license_number" required />
    </div>

    <div class="form-group">
      <label for="specialty">Especialidad</label>

      <select class="select" name="specialty" id="specialty" required>
        <?php foreach ($data['specialties'] as $specialty) : ?>
          <option value="<?= $specialty['id']; ?>">
            <?= $specialty['denomination']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <h2>Datos de contacto</h2>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="text-input" name="email" id="email" required />
    </div>

    <div class="form-group">
      <label for="phone_number">Numero de contacto</label>
      <input type="text" class="text-input" name="phone_number" id="phone_number" required />
    </div>

    <footer>
      <button class="btn secondary" type="button" id="cancel-btn">
        cancelar
      </button>
      <button class="btn primary">Cargar</button>
    </footer>
  </form>
</section>


<script>
  const form = document.querySelector('.new-form');
  const cancelBtn = document.querySelector('#cancel-btn');

  // Si el usuario hace submit, valido los datos del formulario
  form.addEventListener('submit', handleSubmit);
  // Si el usuario hace click en cancelar, le pregunto si esta seguro que desea cancelar la carga.
  cancelBtn.addEventListener('click',() => handleCancelConfirmation('/medicare/professional'));

  function handleSubmit(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);


    // Valido que sea un numero telefonico valido
    if (!isValidPhoneNumber(data.phone_number)) {
      alert('El numero de telefono no es valido, debe contener 9 digitos');
      return;
    }

    // Valido que sea un numero de matricula valido (hasta 6 digitos)
    if (!isValidLicenseNumber(data.license_number)) {
      alert('El numero de matricula no es valido, numero hasta 6 digitos');
      return;
    }

    // realizo el submit del formulario si todo esta correcto
    form.submit();
  }

 
  
</script>