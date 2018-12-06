<?php
require 'vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/* ESSAI DE MONOLOG */
//creer un logger
$log = new Monolog\Logger('name');
//creer un streamhandler
$streamHandler = new Monolog\Handler\StreamHandler('journal.log', Logger::WARNING);
//associer handler et logger
$log->pushHandler($streamHandler);

//on est pret pour utiliser notre loger
$log->warning('une entree de type warning');
$log->error('une entree warning');
?>

<!-- HEADER -->
<?php
    include "template/header.php";
    include "template/menu.php";
?>
<div class="">
    <h1>Acceuil</h1>
    <h2>Rental car project</h2>
</div>
<div class="row">
  <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100 img-responsive" src="assets/img/slide1.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100 img-responsive" src="assets/img/slide2.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100 img-responsive" src="assets/img/slide3.jpg" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <div class="col-md-2">
  </div>
</div>

<?php include "template/footer.php"; ?>
