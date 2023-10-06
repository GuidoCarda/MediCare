<section class="container" id="professional-new">
  <h1 class="section-title">Profecionales</h1>
  <h2 class="section-subtitle">Formulario de carga</h2>
  <form class="new-form">
    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" class="text-input" name="name" id="name" />
    </div>
    <div class="form-group">
      <label for="lastname">Apellido</label>
      <input type="text" class="text-input" name="lastname" id="lastname" />
    </div>
    <div class="form-group">
      <label for="license_number">Numero matricula</label>
      <input
        type="text"
        class="text-input"
        name="license_number"
        id="license_number"
      />
    </div>

    <div class="form-group">
      <label for="specialty">Especialidad</label>

      <select class="select" name="specialty" id="specialty" required>
        <option value="1">Traumatologo</option>
        <option value="2">Neumonologo</option>
        <option value="3">Neurologo</option>
        <option value="4">Psicologo</option>
      </select>
    </div>

    <h2>Datos de contacto</h2>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="text-input" name="email" id="email" />
    </div>

    <div class="form-group">
      <label for="phone_number">Numero de contacto</label>
      <input
        type="text"
        class="text-input"
        name="phone_number"
        id="phone_number"
      />
    </div>

    <footer>
      <button
        class="btn secondary"
        type="button"
        onclick="window.location.href='/medicare/professional'"
      >
        cancelar
      </button>
      <button class="btn primary">Cargar</button>
    </footer>
  </form>
</section>
