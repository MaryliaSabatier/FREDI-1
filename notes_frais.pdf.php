
<?php 
include "fpdf/fpdf.php";
include "function/pdf_requete.php";


?>
<?php
// Instanciation de l'objet FDPF
$pdf = new FPDF();

// Création d'une page
$pdf->AddPage();

// Définit l'alias du nombre de pages {nb}
$pdf->AliasNbPages();

$pdf->SetMargins(20,10,20); // Nouvelles marges en mm
$pdf->SetDrawColor(0,0,0); // Tracé Noir
// Marge du bas et saut automatique
$pdf->SetAutoPageBreak(true,10);

// Affichage d'une image
$pdf->Image('img/test.png',10,6,0,10);
$pdf->Ln(10); // revient à la ligne

// Création du titre
$pdf->SetFont('Times', '', 12);
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
$pdf->SetFont('Times', '', 10);
$pdf->SetTextColor(0, 0, 0); // Noir
$pdf->Ln(10); // saut de ligne
// Entête
$pdf->SetFont('', 'B');
$pdf->SetX(2.5);
$pdf->SetFillColor(211,211,211);
$pdf->Cell(31, 8, utf8_decode("Date jj/mm/aaaa"), 1,0,"C",true);
$pdf->Cell(18, 8, utf8_decode("Motif"), 1,0,"C",true);
$pdf->Cell(30, 8, utf8_decode("Kms parcourus"), 1,0,"C",true);
$pdf->Cell(30, 8, utf8_decode("Total frais Kms"), 1,0,"C",true);
$pdf->Cell(25, 8, utf8_decode("Coût péages"), 1,0,"C",true);
$pdf->Cell(25, 8, utf8_decode("Coût repas"), 1,0,"C",true);
$pdf->Cell(30, 8, utf8_decode("Coût hébergement"), 1,0,"C",true);
$pdf->Cell(16, 8, utf8_decode("Total"), 1,1,"C",true);
// Contenu
foreach ($lignes as $ligne) {
    $pdf->SetFont('', '');
    $pdf->SetX(2.5);
    $pdf->Cell(31,10, utf8_decode($ligne["dat_ligne"]),1,0,"C");   
    $pdf->Cell(18,10, utf8_decode($ligne["lib_trajet"]),1,0,"C");
    $pdf->Cell(30,10, utf8_decode($ligne["nb_km"]),1,0,"C"); 
    $pdf->Cell(30,10, utf8_decode($ligne["mt_km"]),1,0,"C");
    $pdf->Cell(25,10, utf8_decode($ligne["mt_peage"]),1,0,"C");
    $pdf->Cell(25,10, utf8_decode($ligne["mt_repas"]),1,0,"C");
    $pdf->Cell(30,10, utf8_decode($ligne["mt_hebergement"]),1,0,"C");
    $pdf->Cell(16,10, utf8_decode($ligne["mt_total"]),1,1,"C");
}
$pdf->SetFont('Times', '', 12);

// Licence
$pdf->Ln(10); // saut de ligne
$pdf->Cell(80,10,utf8_decode('Je suis licencié sous le n°'),0,0,'L');
$pdf->Ln(10);
$pdf->Cell(0,10,utf8_decode($adherent["adr1"]." - ".$adherent["adr3"]." - ".$adherent["adr2"]),0,0,'C');

//Montant dons
$pdf->Ln(10); // saut de ligne
$pdf->Cell(80,10,utf8_decode('Montant total des dons'),0,0,'L');
$pdf->Ln(10);
$pdf->Cell(0,10,utf8_decode($adherent["mt_total"]),0,0,'C');

//Signature 
$pdf->Ln(10); // saut de ligne
$pdf->Cell(80,10,utf8_decode('Pour bénéficer du reçu de dons. Cette note de frais doit être acompagnée de toutes les justificatifs correpondants'),0,0,'L');
// Génération du document PDF dans le dossier outfiles
$pdf->Output('outfiles/notes_frais.pdf','f');  // f=fichier local
header('Location: notes_frais.php');

$this->Cell(50, 8, 'Page ' . $this->PageNo() . '/{nb}', 'T', 0, 'R');

?>

    </body>
</html>