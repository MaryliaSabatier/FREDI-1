
<?php 
include "fpdf/fpdf.php";
include "function/pdf_requete.php";

// Instanciation de l'objet FPDF
$pdf = new FPDF();

?><?php
// Instanciation de l'objet FDPF
$pdf = new FPDF();

// Création d'une page
$pdf->AddPage();

// Création d'un texte 
$pdf->SetFont('Arial','B',16);
$pdf->Cell(80,10,utf8_decode('Notes de frais des bénévoles'),0,0,'L');  // utf8_decode=convertit en ASCII une chaine UTF8
$pdf->Ln(10); // revient à la ligne

//Création du texte a droite
$pdf->Cell(80,10,utf8_decode('Année Civil '.$periode["lib_periode"]),0,0,'C');

$pdf->Ln(10);
$pdf->Cell(80,10,utf8_decode('Année Civil '.$periode["lib_periode"]),0,0,'C');



// Génération du document PDF dans le dossier outfiles
$pdf->Output('outfiles/notes_frais.pdf','f');  // f=fichier local
header('Location: notes_frais.php');

?>

    </body>
</html>