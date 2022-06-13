<?php
require '../../../functions.php';
require(ABSOLUTE_PATH . 'sources/pdf/fpdf.php');
if(!isConnected()){
    header('Location: ../../../error404.php');
    die();
}
$userId = $_SESSION['userId'];
$db = database();

$getUserInfoQuery = $db->query("SELECT * FROM RkU_USER WHERE id=$userId");
$getUserInfo = $getUserInfoQuery->fetch();
$lastname = $getUserInfo['lastName']; $firstname = $getUserInfo['firstName']; $email = $getUserInfo['email'];
$address = $getUserInfo['address']; $city = $getUserInfo['city']; $zipcode = $getUserInfo['zipCode'];
$registrationDate = date('d/m/Y à H:i', strtotime($getUserInfo['registrationDate'])); $fitcoins = $getUserInfo['fitcoin'];

// Meta Informations du PDF
$pdf = new FPDF('P','mm','A4'); // A4 = 210 × 297 mm
$pdf->AddPage();
$pdf->SetFont('Arial','',16);

// Header
$pdf->Image(ABSOLUTE_PATH . 'sources/img/logo.png',105-10,6,20); // 105(A4.width/2) - 10(taille du logo/2) => Placement du logo au milieu horizontal
$pdf->Cell(15,10,"$lastname $firstname");
$pdf->SetX(-35);
$pdf->Cell(0,10,"RGPD");
$pdf->SetY(35);
$pdf->Cell(0,10,utf8_decode("Compte crée le $registrationDate"), 0, 0 ,'C'); // utf8_decode permet d'écrire de caractères utf8
$pdf->SetY(70);

// Body
$pdf->SetX(45);
$pdf->Cell(50,12,'Champ', 1,0, 'C');
$pdf->Cell(85,12,'Valeur en BDD', 1,1, 'C');

$pdf->SetX(45);
$pdf->Cell(50,8,'Adresse mail', 1,0, 'C');
$pdf->Cell(85,8,"$email", 1,1, 'C');

$pdf->SetX(45);
$pdf->Cell(50,8,'Adresse', 1,0, 'C');
$pdf->Cell(85,8,"$address", 1,1, 'C');

$pdf->SetX(45);
$pdf->Cell(50,8,'Ville', 1,0, 'C');
$pdf->Cell(85,8,"$city", 1,1, 'C');

$pdf->SetX(45);
$pdf->Cell(50,8,'Code postal', 1,0, 'C');
$pdf->Cell(85,8,"$zipcode", 1,1, 'C');

$pdf->SetX(45);
$pdf->Cell(50,8,'Solde fitcoins', 1,0, 'C');
$pdf->Cell(85,8,"$fitcoins FC", 1,1, 'C');

/*$pdf->SetDrawColor(183); // Couleur du fond RVB
$pdf->SetFillColor(221); // Couleur des filets RVB
$pdf->SetTextColor(0); // Couleur du texte noir
$pdf->SetY(50);
// position de colonne 1 (10mm à gauche)
$pdf->SetX(55);
$pdf->Cell(35,8,'Connexions',1,0,'C',1);  // 60 >largeur colonne, 8 >hauteur colonne
// position de la colonne 2 (70 = 10+60)
$pdf->SetX(90);
$pdf->Cell(40,8,'Date',1,0,'C',1);
// position de la colonne 3 (130 = 70+60)
$pdf->SetX(130);
$pdf->Cell(30,8,'Duree',1,0,'C',1);

$pdf->Ln(); // Retour à la ligne*/


$pdf->Output();
