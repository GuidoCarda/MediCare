<?php
if (isPost()) {
  // Recupero valores del formulario
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  if (hasEmptyFields(['name', 'email', 'subject', 'message'])) {
    $message = 'Todos los campos son obligatorios';
    return;
  }

  $user_id = $_SESSION['user_id'] ?? null;

  $Inquiry = new EntityModel('inquiry', 'i');
  $newInquiryId = $Inquiry->insert([
    'name' => $name,
    'email' => $email,
    'subject' => $subject,
    'message' => $message,
    'user_id' => $user_id
  ]);

  if ($newInquiryId !== 0) {
    $message = 'Mensaje enviado correctamente';
  }
}

?>

<section class="container" id="contact">
  <form method="post" class="contact-form">
    <?php if (isset($message)) : ?>
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
        <input class="text-input" id="name" required type="text" name="name" />
      </div>
      <div class="form-group email">
        <label for="email">Email</label>
        <input class="text-input" id="email" required type="email" name="email" />
      </div>
      <div class="form-group subject">
        <label for="subject">Asunto</label>
        <input class="text-input" id="subject" maxlength="70" required type="text" name="subject" />
      </div>
      <div class="form-group message">
        <label for="message">Mensaje</label>
        <textarea class="contact-form__message" id="message" maxlength="255" required name="message"></textarea>
      </div>
    </section>
    <footer>
      <button>Enviar mensaje</button>
    </footer>
  </form>
</section>