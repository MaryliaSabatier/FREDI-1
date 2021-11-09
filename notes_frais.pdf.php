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

?><?php
// Instanciation de l'objet FDPF
$pdf = new FPDF();

// Création d'une page
$pdf->AddPage();

// Création d'un texte 
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Bonjour le monde');  // 40=largeur en mm; 10 = hauteur

// Génération du document PDF dans le dossier outfiles
$pdf->Output('outfiles/notes_frais.pdf','f');  // f=fichier local
header('Location: notes_frais.php');
?>

    </body>
</html>