

<nav class="nav">
<?php if(isLogged() ) : ?>
    <ul class="nav__list ">
      <!-- <li class="nav__item">
        <a class="nav__link" href="/medicare/home">Inicio</a>
      </li> -->
      <li class="nav__item">
        <a class="nav__link" href="/medicare/prescription">Prescripciones</a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/medicare/professional">Profesionales</a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/medicare/contact">contacto</a>
      </li>
    </ul>
  <?php else : ?>
    <ul class="nav__list ">
      <li class="nav__item">
        <a class="nav__link" href="/medicare/home">Inicio</a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/medicare/contact">contacto</a>
      </li>

      <li class="nav__item">
        <a class="nav__link" href="/medicare/login">Ingresar</a>
      </li>
    </ul>
  <?php endif; ?>
</nav>