<section class="container" id="register">
  <header class="register-header">
    <h1>Registro al sistema</h1>
    <p>Ya tenes cuenta? <a href="login">Inicia sesión</a></p>
  </header>

  <form action="register/start" class="register-form" method="post">
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
        <label for="firstname">Nombre</label>
        <input
          type="text"
          class="text-input"
          name="firstname"
          id="firstname"
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
          <option value="0+">0+</option>
          <option value="0-">0-</option>
          <option value="A+">A+</option>
          <option value="A-">A-</option>
        </select>
      </div>
    </section>
    <footer>
      <button>Registrarse</button>
    </footer>
  </form>
</section>
