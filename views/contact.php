<section class="container" id="contact">
  <form action="#" class="contact-form">
    <header class="contact-form-header">
      <h2 class="contact-form__title">Dejanos tu mensaje</h2>
      <p class="contact-form__subtitle">
        Para poder brindarte el mejor asesoramiento
      </p>
    </header>
    <section class="contact-form-grid">
      <div class="form-group name">
        <label for="name">Nombre</label>
        <input
          class="text-input"
          id="name"
          required
          type="text"
          name="name"
        />
      </div>
      <div class="form-group email">
        <label for="email">Email</label>
        <input
          class="text-input"
          id="email"
          required
          type="text"
          name="email"
        />
      </div>
      <div class="form-group subject">
        <label for="subject">Asunto</label>
        <input
          class="text-input"
          id="subject"
          required
          type="text"
          name="subject"
        />
      </div>
      <div class="form-group message">
        <label for="message">Mensage</label>
        <textarea
          class="contact-form__message"
          id="message"
          required
          name="message"
        ></textarea>
      </div>
    </section>
    <footer>
      <button>Enviar mensaje</button>
    </footer>
  </form>
</section>
