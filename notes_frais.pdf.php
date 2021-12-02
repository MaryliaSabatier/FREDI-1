
<?php 
include "fpdf/fpdf.php";
include "function/pdf_requete.php";


?>
<?php
// Instanciation de l'objet FDPF
$pdf = new FPDF();

// Création d'une page
$pdf->AddPage();

// Création du titre
$pdf->SetFont('Arial','B',16);
$pdf->Cell(80,10,utf8_decode('Notes de frais des bénévoles'),0,0,'L');  // utf8_decode=convertit en ASCII une chaine UTF8
$pdf->Ln(10); // revient à la ligne

//Création de la période
$pdf->Cell(0,10,utf8_decode('Année Civil '.$periode["lib_periode"]),0,0,'R');

$pdf->Ln(10); // saut de ligne

// Création du nom et prénom du user
$pdf->Cell(80,10,utf8_decode('Je soussigné(e)'),0,0,'L');
$pdf->Ln(10);
$pdf->Cell(0,10,utf8_decode($utilisateur["nom"]." ".$utilisateur["prenom"]),0,0,'C');

//Création de l'adresse
$pdf->Ln(10); // saut de ligne
$pdf->Cell(80,10,utf8_decode('Demeurant'),0,0,'L');
$pdf->Ln(10);
$pdf->Cell(0,10,utf8_decode($adherent["adr1"]." - ".$adherent["adr3"]." - ".$adherent["adr2"]),0,0,'C');
$pdf->Ln(10); // saut de ligne
$pdf->Cell(80,10,utf8_decode('En tant que dons.'),0,0,'L');
$pdf->Ln(10); // saut de ligne

    // Boucle des lignes
$pdf->SetFont('Times', '', 12);
$pdf->SetTextColor(0, 0, 0); // Noir
// Entête
$pdf->SetFont('', 'B');
$pdf->SetX(20);
$pdf->SetFillColor(211,211,211);
$pdf->Cell(30, 5, utf8_decode("Frais de déplacement"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Motif"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Trajet"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Kms parcourus"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Total frais Kms"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Coût péages"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Coût repas"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Coût hébergement"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Total"), 1,0,"C",true);
// service
foreach ($services as $service) {
    $pdf->SetFont('', '');
    $pdf->SetX(20);
    $pdf->Cell(30, 5, utf8_decode($service->get_id()),1,0,"C");
    $pdf->Cell(50, 5, utf8_decode($service->get_libelle()),1,1,"C");    
}
// Génération du document PDF dans le dossier outfiles
$pdf->Output('outfiles/notes_frais.pdf','f');  // f=fichier local
header('Location: notes_frais.php');

?>

    </body>
</html>