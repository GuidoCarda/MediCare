
<section class="container" id="register">
  <?php if(isset($data['message'])) : ?>
    <div class="alert danger">
      <?= $data['message']; ?>
    </div>
  <?php endif; ?>
  <header class="register-header">
    <h1>Registro al sistema</h1>
    <p>Ya tenes cuenta? <a href="login">Inicia sesión</a></p>
  </header>

  <form action="/medicare/register/start" class="register-form" method="post">
    <section class="register-form-grid">
      <div class="register-form-section__header">
        <h2>Credenciales de ingreso</h2>
        <p>
          Estas credenciales seran necesarias para ingresar a tu cuenta
          una vez registrado.
        </p>
      </div>
      <div class="form-group email">
        <label for="email">Email</label>
        <input
          type="email"
          required
          class="text-input"
          name="email"
          id="email"
        />
      </div>
      <div class="form-group password">
        <label for="password">Contraseña</label>
        <input
          type="password"
          class="text-input"
          name="password"
          id="password"
          minlength="4"
          required
        />
      </div>
      <div class="register-form-section__header">
        <h2>Datos paciente</h2>
        <p>
          Estos detalles son esenciales para proporcionar un servicio
          personalizado y efectivo.
        </p>
      </div>
      <div class="form-group firstname">
        <label for="name">Nombre</label>
        <input
          type="text"
          class="text-input"
          name="name"
          id="name"
          required
        />
      </div>
      <div class="form-group lastname">
        <label for="lastname">Apellido</label>
        <input
          type="text"
          class="text-input"
          name="lastname"
          id="lastname"
          required
        />
      </div>
      <div class="form-group dni">
        <label for="dni">Numero de documento</label>
        <input
          type="text"
          class="text-input"
          name="dni"
          id="dni"
          required
        />
      </div>
      <div class="form-group birthdate">
        <label for="birthdate">Fecha de nacimiento</label>
        <input
          type="date"
          class="text-input"
          name="birthdate"
          id="birthdate"
          required
        />
      </div>
      <div class="form-group bloodtype">
        <label for="bloodtype">Grupo sanguineo</label>

        <select class="select" name="bloodtype" id="bloodtype" required>
          <?php foreach($data['bloodTypes'] as $bloodType) :  ?>
          <option value="<?php echo $bloodType['id']; ?>"><?php echo $bloodType['denomination']; ?> </option>
          <?php endforeach; ?>
        </select>
      </div>
    </section>
    <footer>
      <button>Registrarse</button>
    </footer>
  </form>
</section>


<script>
  const form = document.querySelector('.register-form');

  form.addEventListener('submit', handleSubmit)

  function handleSubmit(e){
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);

    if(!isValidDni(data.dni)){
      toastNotification('El dni no es valido. Debe contener 8 digitos', 'danger')
      return;
    }

    if(!isValidBirthdate(data.birthdate)){
      toastNotification('La fecha de nacimiento no es valida, debe ser mayor de edad', 'danger')
      return;
    }

    form.submit();
  }

  

</script>