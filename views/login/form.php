<section class="container" id="login">
  <header class="login-header">
    <h1>Ingreso al sistema</h1>
    <p>Aun no tenes cuenta? <a href="register">registrate</a></p>
  </header>
  <form action="/medicare/login/start" method="post" class="login-form">
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="text-input" name="email" id="email" />
    </div>
    <div class="form-group">
      <label for="password">Contraseña</label>
      <input type="password" class="text-input" name="password" id="password" />
    </div>
    <button>Iniciar sesion</button>
  </form>
</section>
