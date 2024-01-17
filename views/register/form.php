<section class="container" id="register">
  <?php if (isset($data['message'])) : ?>
    <div class="alert alert-danger">
      <?= $data['message']; ?>
    </div>
  <?php endif; ?>
  <header class="register-header">
    <h1>Registro al sistema</h1>
    <p>Ya tenes cuenta? <a href="/medicare/login">Inicia sesión</a></p>
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
        <input type="email" required class="text-input" name="email" id="email" />
      </div>
      <div class="form-group password">
        <label for="password">Contraseña</label>
        <input type="password" class="text-input" name="password" id="password" minlength="4" required />
        <button type="button" class="toggle-password-btn">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M12 4c4.29 0 7.863 2.429 10.665 7.154l.22 .379l.045 .1l.03 .083l.014 .055l.014 .082l.011 .1v.11l-.014 .111a.992 .992 0 0 1 -.026 .11l-.039 .108l-.036 .075l-.016 .03c-2.764 4.836 -6.3 7.38 -10.555 7.499l-.313 .004c-4.396 0 -8.037 -2.549 -10.868 -7.504a1 1 0 0 1 0 -.992c2.831 -4.955 6.472 -7.504 10.868 -7.504zm0 5a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z" stroke-width="0" fill="currentColor"></path>
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"></path>
            <path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87"></path>
            <path d="M3 3l18 18"></path>
          </svg>

        </button>
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
        <input type="text" class="text-input" name="name" id="name" required />
      </div>
      <div class="form-group lastname">
        <label for="lastname">Apellido</label>
        <input type="text" class="text-input" name="lastname" id="lastname" required />
      </div>
      <div class="form-group dni">
        <label for="dni">Numero de documento</label>
        <input type="text" class="text-input" name="dni" id="dni" required />
      </div>
      <div class="form-group birthdate">
        <label for="birthdate">Fecha de nacimiento</label>
        <input type="date" class="text-input" name="birthdate" id="birthdate" required />
      </div>
      <div class="form-group bloodtype">
        <label for="bloodtype">Grupo sanguineo</label>

        <select class="select" name="bloodtype" id="bloodtype" required>
          <?php foreach ($data['bloodTypes'] as $bloodType) :  ?>
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
  const togglePasswordBtn = document.querySelector('.toggle-password-btn');

  form.addEventListener('submit', handleSubmit)
  togglePasswordBtn.addEventListener('click', togglePasswordVisibility);

  function handleSubmit(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);

    if (!isValidDni(data.dni)) {
      toastNotification('El dni no es valido. Debe contener 8 digitos', 'danger')
      return;
    }

    if (!isValidBirthdate(data.birthdate)) {
      toastNotification('La fecha de nacimiento no es valida, debe ser mayor de edad', 'danger')
      return;
    }

    form.submit();
  }

  function togglePasswordVisibility() {
    const passwordInput = document.querySelector('#password');
    const passwordInputType = passwordInput.getAttribute('type');

    const [showPasswordIcon, hidePasswordIcon] = togglePasswordBtn.querySelectorAll('svg')

    if (passwordInputType === 'password') {
      togglePasswordBtn.classList.add('show');
      hidePasswordIcon.style.display = 'block';
      showPasswordIcon.style.display = 'none';

      passwordInput.setAttribute('type', 'text');
      return;
    }

    hidePasswordIcon.style.display = 'none';
    showPasswordIcon.style.display = 'block';
    passwordInput.setAttribute('type', 'password');
  }
</script>