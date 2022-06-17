<?php
    $title = "Fitness Essential - Réservations";
    $content = "Réserver une séance de coaching";
    $currentPage = 'reservations';
    require '../../../header.php';
        
    require '../scripts/Calendar/Month.php';
    require '../scripts/Calendar/Events.php';


    $pdo = database();

    $month = new Calendar\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
    $startDay = $month->getStartingDay();
    $startDay = $startDay->format('N') === '1' ? $startDay : $month->getStartingDay()->modify('last monday');
    $weeks = $month->getWeeks();

    $events = new Calendar\Events();
    $end = (clone $startDay)->modify('+' . (6 + 7 * ($weeks - 1)) . 'days');
    $events = $events->getEventsBetweenByDay($startDay, $end);


?>

<h1 class="aligned-title"> Réserver une séance </h1>

<div class="calendar">
    <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
        <h2><?= $month->toString(); ?></h2>

        <div>
            <a href="<?= DOMAIN . 'modules/calendar/vues/reservations.php?month=' . $month->previousMonth()->month . '&year=' . $month->previousMonth()->year ?>" class = "btn btn-primary">&lt</a>
            <a href="<?= DOMAIN . 'modules/calendar/vues/reservations.php?month=' . $month->nextMonth()->month . '&year=' . $month->nextMonth()->year ?>" class = "btn btn-primary">&gt</a>
        </div>
    </div>

    <table class = "__calendarTable __calendarTable--<?= $weeks; ?>weeks">
        <?php for($i = 0; $i < $weeks; $i++){ ?>
        <tr>
            <?php 
            foreach($month->days as $k => $day){ 
                $date = (clone $startDay)->modify("+" . ($k + $i * 7) . "days");
                $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
            ?>
            <td class = "<?= $month->withinMonth($date) ? '' : '__calendarOtherMonth'; ?>">
                <?php if($i == 0){ ?> 
                <div class="__calendarWeekDay"> <?= $day ?> </div>
                <?php } ?>
                <div class="__calendarDay"> <?= $date->format('d'); ?> </div>
                <?php foreach($eventsForDay as $event){ ?>
                <div class="__calendarEvent"> 
                    <?= (new Datetime($event['startDate']))->format('H:i') ?> - <a href=" <?= DOMAIN ?>modules/calendar/vues/eventUser.php?id=<?= $event['id'] ?>"> <?= $event['name'] ?> </a> <!-- Je met le lien vers la modif, ce sera migré vers le BO, il faudra remettre un lien vers eventUser.php -->
                </div>
                <?php } ?>
            </td>
            <?php } ?>
        </tr>
        <?php } ?>
    </table>

</div>

<?php
    include '../../../footer.php';
?>