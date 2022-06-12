<?php
    $title = "Fitness Essential - Réservations";
    $content = "Réserver une séance de coaching";
    $currentPage = 'reservations';
    require '../../../header.php';
    require '../scripts/Date/Month.php';
    $month = new App\Date\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
    $startDay = $month->getStartingDay();
    $startDay = $startDay->format('N') === '1' ? $startDay : $month->getStartingDay()->modify('last monday');
?>

<h1 class="aligned-title"> Réserver une séance </h1>
<div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
    <h2><?= $month->toString(); ?></h2>

    <div>
        <a href="<?= DOMAIN . 'modules/calendar/vues/reservations.php?month=' . $month->previousMonth()->month . '&year=' . $month->previousMonth()->year ?>" class = "btn btn-primary">&lt</a>
        <a href="<?= DOMAIN . 'modules/calendar/vues/reservations.php?month=' . $month->nextMonth()->month . '&year=' . $month->nextMonth()->year ?>" class = "btn btn-primary">&gt</a>
    </div>
</div>

<table class = "__calendarTable __calendarTable--<?= $month->getWeeks(); ?>weeks">
    <?php for($i = 0; $i < $month->getWeeks(); $i++){ ?>
    <tr>
        <?php 
        foreach($month->days as $k => $day){ 
            $date = (clone $startDay)->modify("+" . ($k + $i * 7) . "days");
        ?>
        <td class = "<?= $month->withinMonth($date) ? '' : '__calendarOtherMonth'; ?>">
            <?php if($i == 0){ ?> 
            <div class="__calendarWeekDay"> <?= $day ?> </div>
            <?php } ?>
            <div class="__calendarDay"> <?= $date->format('d'); ?> </div>
        </td>
        <?php } ?>
    </tr>
    <?php } ?>
</table>

<?php
    include '../../../footer.php';
?>