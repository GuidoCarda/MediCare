<?php
  if(isPost()){
    // Recupero valores del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if(hasEmptyFields(['name', 'email', 'subject', 'message'])){
      $message = 'Todos los campos son obligatorios';
      return;
    }

    echo 'paso la validacion';
    var_dump($name, $email, $subject, $message);
    die();

    $Message = new EntityModel('message','msg');
    $newMessageId = $Message->insert([
      'name' => $name,
      'email' => $email,
      'subject' => $subject,
      'message' => $message
    ]);

    if($newMessageId !== 0){
      $message = 'Mensaje enviado correctamente';
    }
  }

?>

<section class="container" id="contact">
  <form method="post" class="contact-form">
    <?php if(isset($message)): ?>
      <div class="alert alert-success">
        <?php echo $message; ?>
      </div>
    <?php endif; ?>
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
          type="email"
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
