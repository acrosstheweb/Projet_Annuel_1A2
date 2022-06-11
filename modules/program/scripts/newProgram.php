<?php
require '../../../functions.php';

$db = database();

$programTitle = ucwords(trim($_POST["programTitle"]));
$programFile = $_POST["programFile"];

$programExercice = $_POST["programExerciceDropdown"]; // "BC", "DC", "RB", "SQ"

$programExerciceSeries = $_POST["programSeries"];
$programExerciceReps = $_POST["programReps"];

echo "<pre>";
var_dump([
    $programTitle,
    $programFile,
    $programExercice,
    $programExerciceSeries,
    $programExerciceReps
]);
echo "</pre>";

$db->prepare("");