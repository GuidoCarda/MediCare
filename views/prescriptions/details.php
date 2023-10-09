<section class="container" id="prescription-details">
  <h1 class="section-title">Prescripcion</h1>
  
  <h2 class="section-subtitle">Mi prescripcion </h1>

  
  <div>
    <h3>Octavio fernandez</h3>
    <span>neumonologo</span>
  </div>
  
  <h2 class="section-subtitle">Detalles</h2>

  <p>Fecha: 25/10/2023</p>
  <p>Nombre comercial: Neumocort</p>
  <p>Droga: Fruticasona fosfato</p>
  <p>Tipo: puff</p>
  <p>Cantidad: 2</p>
  <p>Frecuencia: 12 horas</p>
  <p>Estado: Activo</p>
  <p>Observaciones: </p>
  <p>Esta prescripcion fue realizada por el profesional Octavio fernandez el dia 25/10/2023</p>



<button class="btn primary">
  Modificar
</button>
</section>

<script>
  const url = new URL(window.location);
  const currentPath = url.pathname;

  document.querySelector('.btn.primary').addEventListener(
    'click',
    ()=>{
      window.location.href = `${currentPath}/edit`;
    }
  )
</script>
