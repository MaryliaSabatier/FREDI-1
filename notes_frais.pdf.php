<?php 

// Instanciation de l'objet FPDF
$pdf = new FPDF();

// Génération du document PDF
$pdf->Output('f','outfiles/notes_frais.pdf', );
// Redirection vers une autre page
header('Location: notes_frais.php');

// Instanciation de l'objet FPDF
$pdf = new FPDF();
// Génération du document PDF
$pdf->Output('f','outfiles/notes_frais.pdf', );
// Redirection vers une autre page
header('Location: index.php');

?>