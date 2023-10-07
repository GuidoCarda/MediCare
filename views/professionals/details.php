<section class="container" id="professionals-details">
  <h1 class="section-title">Profecionales</h1>
  
  <h2 class="section-subtitle">Mis profecionales </h1>
  
      <article>
        <div>
          <h2>Octavio fernandez</h2>
          <span>neumonologo</span>
        </div>
        <h2>Datos de contacto</h2>
        <p>+31231231</p>
        <p>octaviofernandez@gmail.com</p>
      </article>

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
