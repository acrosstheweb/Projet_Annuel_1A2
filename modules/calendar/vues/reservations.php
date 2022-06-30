<?php
  $title = "Fitness Essential - Réservations";
  $content = "Réserver une séance de coaching";
  $currentPage = 'reservations';
  require '../../../header.php';
      
  require '../scripts/Calendar/Week.php';
  require '../scripts/Calendar/Events.php';


  $pdo = database();

  $month = new Calendar\Week($_GET['day'] ?? null ,$_GET['month'] ?? null, $_GET['year'] ?? null);
  $startDay = $month->getStartingDay();
  $week = 1;
  // $days = $month->daysInMonth($month->month, $month->year);


  $events = new Calendar\Events();
  $end = (clone $startDay)->modify('+' . 7 . 'days');
  $events = $events->getEventsBetweenByDay($startDay, $end);

  $req = $pdo->query("SELECT id, name FROM RkU_GYMS");
  $gyms = $req->fetchAll();
  
  $req = $pdo->query("SELECT id, name FROM RkU_SPORT");
  $sports = $req->fetchAll();

?>

<h1 class="aligned-title"> Réserver une séance </h1>


<div class="container-fluid">

    <div class="row d-flex justify-content-center my-3">
        <div class="col-8">
            <h2><?= $month->toString(); ?></h2>
        </div>
        <div class="col-4 col-md-2 text-center">
            <a href="<?= DOMAIN . 'modules/calendar/vues/reservations.php?day=' . $month->previousWeek()->day . '&month=' . $month->previousWeek()->month . '&year=' . $month->previousWeek()->year ?>" class = "btn btn-primary"><i class="fa-solid fa-angle-left"></i></a>
            <a href="<?= DOMAIN . 'modules/calendar/vues/reservations.php?day=' . $month->nextWeek()->day . '&month=' . $month->nextWeek()->month . '&year=' . $month->nextWeek()->year ?>" class = "btn btn-primary"><i class="fa-solid fa-angle-right"></i></a>
        </div>
    </div>

    <div class="row d-flex justify-content-between mb-3">
        <div class="col-11 col-lg-9">
            <div class="row">
                <div class="col-5 col-md-3 col-lg-2">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButtonGym" data-bs-toggle="dropdown" aria-expanded="false">
                            Filtrer par salle
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonGym">
                            <li><a class="dropdown-item __gym-filter" id="allGyms" data-gym="all" href="#">Toutes les salles</a></li>
                            <?php foreach($gyms as $gym){ ?>
                                <li><a class="dropdown-item __gym-filter" id="__gym-<?= $gym['id'] ?>" data-gym="<?= $gym['id'] ?>" href="#"><?= $gym['name'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="col-5 col-md-3 col-lg-2 ms-3">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButtonSport" data-bs-toggle="dropdown" aria-expanded="false">
                            Filtrer par sport
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonSport">
                            <li><a class="dropdown-item __sport-filter" id="allGyms" data-gym="all" href="#">Toutes les salles</a></li>
                            <?php foreach($sports as $sport){ ?>
                                <li><a class="dropdown-item __sport-filter" id="__sport-<?= $sport['id'] ?>" data-sport="<?= $sport['id'] ?>" href="#"><?= $sport['name'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="row">
        <div class="__calendar">
            <div class="col-11 d-flex justify-content-center">
                <div class="table-responsive mx-auto">
                    <table class = "__calendarTable">
                        <tr>
                            <?php
                            foreach($month->days as $k => $day){
                                $date = (clone $startDay)->modify("+" . $k . "days");
                                $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
                            ?>
                                <td class = "<?= $month->withinMonth($date) ? '' : '__calendarOtherMonth'; ?>">
                                    <div class="__calendarContent">
                                        <div class="__calendarWeekDay"> <?= $month->days[($date->format('w')+6)%7] ?> </div>
                                        <div class="__calendarDay"> <?= $date->format('d'); ?> </div>
                                        <?php foreach($eventsForDay as $event){ ?>
                                            <div class="card __eventCard __event-<?= $event['gym'] ?> __event-<?= $event['sport'] ?>">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="text-end text-muted">
                                                            Places restantes: 
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h5 class="card-title"><?= $event['name'] ?></h5>
                                                        <h6 class="card-subtitle mb-2 text-muted"><?= (new Datetime($event['startDate']))->format('H:i') . ' - ' . (new Datetime($event['endDate']))->format('H:i') . ' ' . $event['gym']?></h6>
                                                    </div>
                                                    <div class="row">
                                                        <p class="card-text d-flex align-items-center"><?= $event['price'] ?><img class="mx-1" src="<?= DOMAIN . 'sources/img/fitcoin.svg' ?>" width="14px" height="14px" alt=""></p>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <a href="#" class="btn btn-primary">Réserver</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </td>
                            <?php } ?>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= DOMAIN . 'js/reservations.js'?>"></script>

<?php
    include '../../../footer.php';
?>