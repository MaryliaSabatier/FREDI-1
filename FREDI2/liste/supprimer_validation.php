<?php $active=2; $title = "Ajouter"; require('../header.php'); require('../sql.php');
$submit=isset($_POST['submit'])?$_POST['submit']:null;
$id=isset($_POST['id'])?$_POST['id']:null;
if($submit){
    //Va supprimer la ligne associée à l'id dans la faq
    $sql ="DELETE FROM faq WHERE id_faq=:id_faq";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
            ':id_faq' => $id
        ));
    //Gestion des erreurs
    } catch (PDOException $ex){
        die("Erreur lors de la rêquete SQL : ".$ex->getMessage());
    }
    $_SESSION['messages']=array(
        "FAQ" => ["blue", "Le message a été supprimé"]
    );
}
//Redirige vers la FAQ après la suppression
header("Location: liste.php");
?>