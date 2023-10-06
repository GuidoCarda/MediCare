

<nav class="nav">
<?php if(isLogged() ) : ?>
    <ul class="nav__list ">
      <li class="nav__item">
        <a class="nav__link" href="/medicare/home">Inicio</a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/medicare/prescription">Medicacion</a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/medicare/professional">Profesionales</a>
      </li>
    </ul>
  <?php else : ?>
    <ul class="nav__list ">
      <li class="nav__item">
        <a class="nav__link" href="/medicare/home">Inicio</a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/medicare/contact">Contact</a>
      </li>
    </ul>
  <?php endif; ?>
</nav>