<section class="container" id="prescriptions-edit">
  <h1 class="section-title">Prescripciones</h1>
  <h2 class="section-subtitle">Editar prescripcion</h2>
  <form class="new-form">
    <div class="form-group">
      <label for="generic_name">Nombre comercial</label>
      <input
        type="text"
        class="text-input"
        name="generic_name"
        id="generic_name"
      />
    </div>
    <div class="form-group">
      <label for="drug">Droga</label>
      <input type="text" class="text-input" name="drug" id="drug" />
    </div>
    <div class="form-group">
      <label for="quantity">Cantidad</label>
      <input type="text" class="text-input" name="quantity" id="quantity" />
    </div>

    <div class="form-group">
      <label for="medicine_type">Tipo medicina</label>

      <select class="select" name="medicine_type" id="medicine_type" required>
        <option value="1">Crema</option>
        <option value="2">Pastillas</option>
        <option value="3">Inyectable</option>
        <option value="4">Jarabe</option>
      </select>
    </div>

    <div class="form-group">
      <label for="professional_id">Frecuencia</label>

      <select class="select" name="frecuency_id" id="frecuency_id" required>
        <option value="1">cada 8 horas</option>
        <option value="2">cada 12 horas</option>
        <option value="3">diario</option>
        <option value="4">dia por medio</option>
        <option value="5">una vez por semana</option>
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
        <option value="1">Octavio fernandez</option>
        <option value="2">Carlos Ramirez</option>
        <option value="3">Juan Zosa</option>
        <option value="4">Lucia Mainer</option>
      </select>
    </div>

    <footer>
      <button
        type="button"
        class="btn secondary"
        onclick="window.location.href='/medicare/prescription'"
      >
        cancelar
      </button>
      <button class="btn primary">Cargar</button>
    </footer>
  </form>
</section>
