<?php 
include "fpdf/fpdf.php";

// Instanciation de l'objet FPDF
$pdf = new FPDF();

// Génération du document PDF
$pdf->Output('f','outfiles/notes_frais.pdf', );
// Redirection vers une autre page
header('Location: index.php');

?><?php
// Instanciation de l'objet FDPF
$pdf = new FPDF();

// Création d'une page
$pdf->AddPage();

// Création d'un texte 
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Bonjour le monde');  // 40=largeur en mm; 10 = hauteur

// Création du texte a gauche
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,utf8_decode('Notes de frais des bénévoles'),1,1,'L');  // utf8_decode=convertit en ASCII une chaine UTF8
// Création du texte a droite
$pdf->Cell(0,10,utf8_decode('Année Civil')($periode->get_id_pays(),1,1,'R');

// Définit l'alias du nombre de pages {nb}
$pdf->AliasNbPages();

// Titre de page
$pdf->SetFont('Times', '', 24);
$pdf->SetTextColor(0, 51, 255); // Bleu  #0033FF
$pdf->Cell(0, 20, utf8_decode("Liste des services"), 0, 1, 'C');
$pdf->Ln(8);

// Boucle des lignes
$pdf->SetFont('Times', '', 12);
$pdf->SetTextColor(0, 0, 0); // Noir
// Entête
$pdf->SetFont('', 'B');
$pdf->SetX(20);
$pdf->SetFillColor(211,211,211);
$pdf->Cell(30, 5, utf8_decode("ID"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Libellé"), 1,1,"C",true);
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