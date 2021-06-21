<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="argo.css" rel="stylesheet">
    <title>Argonautes</title>
  </head>
  <body>
    <!-- Header section -->
<header class="sticky-top">
  <h1>
    <img src="https://www.wildcodeschool.com/assets/logo_main-e4f3f744c8e717f1b7df3858dce55a86c63d4766d5d9a7f454250145f097c2fe.png" alt="Wild Code School logo" />
    Les Argonautes
  </h1>
</header>

<?php
$host_name = '';
$database = '';
$user_name = '';
$password = '';
$db = null;

try {
    $db = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
} catch (PDOException $e) {
    echo "Erreur!: " . $e->getMessage() . "<br/>";
    die();
}

if(!empty($_POST['name_argo'])){
    $name_argo = htmlspecialchars($_POST['name_argo']);

    $insertName = $db->prepare('INSERT INTO argonautes (name_argo) VALUES (:name_argo)');
    $insertName->bindValue(':name_argo', $name_argo, PDO::PARAM_STR);
    $insertName->execute();
    
    echo'
    <div class="text-center mt-5">
        <p class="text-green bold">L\'enregistrement de '.$name_argo.' a été réalisé avec succès !</p>
        <div class="spinner-grow text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="text-center">Redirection dans 3 secondes :p</p>
    </div>
    <meta http-equiv="refresh" content="3;url=index.php">';
}
else{
    ?>
    <!-- Main section -->
    <main>
    <!-- New member form -->
    <div class="card shadow">
        <h2 class="pt-5">Ajouter un(e) Argonaute</h2>
        <form class="new-member-form" action="index.php" method="post">
            <label for="name_argo">Nom de l&apos;Argonaute</label>
            <input id="name_argo" name="name_argo" type="text" placeholder="Charalampos" required/>
            <button type="submit" class="btn btn-success">Envoyer</button>
            <br/>
        </form>
    </div>
    
    <!-- Member list -->
    <section class="member-list">
    <h2 class="mt-5">Membres de l'équipage</h2>
        <?php
            $readName = $db->prepare('SELECT * FROM argonautes');
            $readName->execute();
            $dataName = $readName ->fetchAll();
            $readDataName = $dataName['name_argo'];
            //var_dump($dataName);
        ?>
        <div class="papyrus w-75 ml-auto mr-auto mt-5">
            <table class="table">
                <tbody>
                    <?php
                    $count = 0;
                    foreach($dataName as $name){
                        $count ++;
                        if($count === 4){$count = 1;}

                        if($count % 4 === 0 || $count === 1)
                        {
                            echo'<tr>';
                        }
                        echo'<td class="pt-3 pl-3">'.$name['name_argo'].'</td>';
                        if($count % 3 === 0)
                        {
                            echo'</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    </main>
<?php
}
?>
<footer class="fixed-bottom">
  <p>Réalisé par Jason en Anthestérion de l'an 515 avant JC</p>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  </body>
</html>