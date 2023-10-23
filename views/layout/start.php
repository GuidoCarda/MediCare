<!-- Contendra el inicio para todas las paginas -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Medicare</title>
  <link rel="stylesheet" href="/medicare/assets/css/styles.css" />
</head>

<body>
  <script src="/medicare/js/utils.js"></script>
  <script>
    window.addEventListener("DOMContentLoaded", () => {
      const navToggle = document.querySelector('.nav-toggle');
      const nav = document.querySelector('.nav');
      navToggle.addEventListener('click', () => {
        nav.classList.toggle('nav--visible')
        document.body.classList.toggle('no-scroll');
      })
      
    })
  </script>
  <header>
    <div class="container row">
      <span class="nav-logo">Medicare</span>
      <?php require(VIEWS . '/layout/nav.php'); ?>
      <button class="nav-toggle" aria-label="open navigation">
        <span class="hamburger"></span>
      </button>
    </div>
  </header>
  <main>
    <div id="toast"></div>