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

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonGym" data-bs-toggle="dropdown" aria-expanded="false">
    Choisir la salle
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonGym">
    <li><a class="dropdown-item __gym-filter" id="allGyms" data-gym="all" href="#">Toutes les salles</a></li>
    <?php foreach($gyms as $gym){ ?>
    <li><a class="dropdown-item __gym-filter" id="__gym-<?= $gym['id'] ?>" data-gym="<?= $gym['id'] ?>" href="#"><?= $gym['name'] ?></a></li>
    <?php } ?>
  </ul>
</div>

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonSport" data-bs-toggle="dropdown" aria-expanded="false">
    Choisir le sport
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonSport">
    <li><a class="dropdown-item __sport-filter" id="allSports" data-sport="all" href="#">Tous les sports</a></li>
    <?php foreach($sports as $sport){ ?>
    <li><a class="dropdown-item __sport-filter" id="__sport-<?= $sport['id'] ?>" data-sport="<?= $sport['id'] ?>" href="#"><?= $sport['name'] ?></a></li>
    <?php } ?>
  </ul>
</div>

<div class="calendar">
    <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
        <h2><?= $month->toString(); ?></h2>

        <div>
            <a href="<?= DOMAIN . 'modules/calendar/vues/reservations.php?day=' . $month->previousWeek()->day . '&month=' . $month->previousWeek()->month . '&year=' . $month->previousWeek()->year ?>" class = "btn btn-primary">&lt</a>
            <a href="<?= DOMAIN . 'modules/calendar/vues/reservations.php?day=' . $month->nextWeek()->day . '&month=' . $month->nextWeek()->month . '&year=' . $month->nextWeek()->year ?>" class = "btn btn-primary">&gt</a>
        </div>
    </div>

    <table class = "__calendarTable">
        <tr>


        <?php
        foreach($month->days as $k => $day){
            $date = (clone $startDay)->modify("+" . $k . "days");
            $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
        ?>

            <td class = "<?= $month->withinMonth($date) ? '' : '__calendarOtherMonth'; ?>">
                <div class="__calendarWeekDay"> <?= $month->days[($date->format('w')+6)%7] ?> </div>
                <div class="__calendarDay"> <?= $date->format('d'); ?> </div>
                <?php foreach($eventsForDay as $event){ ?>
                <div class="__calendarEvent __event-<?= $event['gym'] ?> __event-<?= $event['sport'] ?>"> 
                    <?= (new Datetime($event['startDate']))->format('H:i') ?> - <a href=" <?= DOMAIN ?>modules/calendar/vues/eventUser.php?id=<?= $event['id'] ?>"> <?= $event['name'] ?></a> <!-- Je met le lien vers la modif, ce sera migré vers le BO, il faudra remettre un lien vers eventUser.php -->
                </div>
                <?php } ?>
            </td>

        <?php } ?>
        </tr>

    </table>

</div>

<script src="<?= DOMAIN . 'js/reservations.js'?>"></script>

<?php
    include '../../../footer.php';
?>