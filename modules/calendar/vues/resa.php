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


?>

<h1 class="aligned-title"> Réserver une séance </h1>

<div class="calendar">
    <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
        <h2><?= $month->toString(); ?></h2>

        <div>
            <a href="<?= DOMAIN . 'modules/calendar/vues/resa.php?day=' . $month->previousWeek()->day . '&month=' . $month->previousWeek()->month . '&year=' . $month->previousWeek()->year ?>" class = "btn btn-primary">&lt</a>
            <a href="<?= DOMAIN . 'modules/calendar/vues/resa.php?day=' . $month->nextWeek()->day . '&month=' . $month->nextWeek()->month . '&year=' . $month->nextWeek()->year ?>" class = "btn btn-primary">&gt</a>
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
                <div class="__calendarEvent __event-<?= $event['gym'] ?>"> 
                    <?= (new Datetime($event['startDate']))->format('H:i') ?> - <a href=" <?= DOMAIN ?>modules/calendar/vues/eventUser.php?id=<?= $event['id'] ?>"> <?= $event['name'] ?> </a> <!-- Je met le lien vers la modif, ce sera migré vers le BO, il faudra remettre un lien vers eventUser.php -->
                </div>
                <?php } ?>
            </td>

        <?php } ?>
        </tr>

    </table>

</div>

<?php
    include '../../../footer.php';
?>