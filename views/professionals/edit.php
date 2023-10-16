<?php
  $professional = $data['professional'];
  $specialties = $data['specialties'];
  // var_dump($professional);
?>

<section class="container" id="professional-new">
  <h1 class="section-title">Profesionales</h1>
  <h2 class="section-subtitle">Formulario de carga</h2>
<form class="new-form" method="post">
    <div class="form-group">
      <label for="name">Nombre</label>
      <input 
        type="text" 
        class="text-input" 
        value="<?php echo $professional['name']?>" 
        name="name" 
        id="name"
        readonly 
      />
    </div>
    <div class="form-group">
      <label for="lastname">Apellido</label>
      <input 
        type="text" 
        class="text-input" 
        value="<?php echo $professional['lastName']?>" 
        name="lastname" 
        id="lastname" 
        readonly
      />
    </div>
    <div class="form-group">
      <label for="license_number">Numero matricula</label>
      <input
        type="text"
        class="text-input"
        name="license_number"
        id="license_number"
        readonly
        value="<?php echo $professional['license_number']?>"
      />
    </div>

    <div class="form-group">
      <label for="specialty">Especialidad</label>
      <input
        type="text"
        class="text-input"
        name="specialty"
        id="specialty"
        readonly
        value="<?php echo $professional['specialty']?>"
      />
    </div>

    <h2>Datos de contacto</h2>
    <div class="form-group">
      <label for="email">Email</label>
      <input 
        type="email" 
        class="text-input" 
        name="email" 
        id="email"
        value="<?php echo $professional['email']?>" 
      />
    </div>

    <div class="form-group">
      <label for="phone_number">Numero de contacto</label>
      <input
        type="text"
        class="text-input"
        name="phone_number"
        id="phone_number"
        value="<?php echo $professional['phone_number']?>" 
      />
    </div>

    <footer>
      <button
        class="btn secondary"
        type="button"
        id='cancel-btn'
        >
        cancelar
      </button>
      <button class="btn primary">Modificar</button>
    </footer>
  </form>
</section>

<script> 
  const cancelBtn = document.querySelector('#cancel-btn');

  cancelBtn.addEventListener('click', ()=>{
    const confirm = window.confirm('¿Estas seguro que deseas cancelar? Los cambios no se guardaran');

    if(confirm){
      window.location.href='/medicare/professional'
    }
  });
</script>
