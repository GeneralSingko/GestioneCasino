<?php
     require_once "php/loader.php";
     session_start();
     if(empty($_SESSION["username"])){
          setcookie("error","Pagina non trovata :(", time() + 1000,"/");
          header("Location: error.html");
          exit();
     }
     
     $queryRepose = $db->executeQueryWithoutFetch("select * from user where email = '".$_SESSION['username']."'")->fetch();
?>
<!DOCTYPE html>
<html lang="it">
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="description" content="Registrazione Cashy Land">
<meta name="keywords" content="Registrazione">
<meta name="author" content="gruppocasin02018">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title>CashyLand - Aggiungi</title>
<!--

Template 2085 Neuron

http://www.tooplate.com/view/2085-neuron

-->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">

<!-- Main css -->
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css?family=Lora|Merriweather:300,400" rel="stylesheet">

</head>
<body>

<!-- PRE LOADER -->

<div class="preloader">
     <div class="sk-spinner sk-spinner-wordpress">
          <span class="sk-inner-circle"></span>
     </div>
</div>

<!-- Navigation section  -->

<div class="navbar navbar-default navbar-static-top" role="navigation">
     <div class="container">
          <div class="navbar-header">
               <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
               </button>
               <a href="index.html" class="navbar-brand">Ca$hy Land</a>
          </div>
          <div class="collapse navbar-collapse">
               <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="game.php">Giochi</a></li>
                    <li><a href="sale.php">Sale</a></li>
                    <li class="active"><a href="login.html">Accedi</a></li>
               </ul>
          </div>
     </div>
</div>

<!-- Home Section -->

<section id="home" class="main-profile parallax-section">
     <div class="overlay"></div>
     <div class="container">
          <div class="row">

               <div class="col-md-12 col-sm-12">
                    <h1>Aggiungi immagine</h1>
               </div>

          </div>
     </div>
</section>

<!-- login Section -->

<section id="login">
     <div class="container">
          <div class="row">
            <div class="col-md-offset-1 col-md-10 col-sm-12">
                <div class="col-md-4 col-sm-4" id="button-profile">
                    <a href="profile.php">
                      <input name="backProfile" type="button" class="form-control" id="backProfile" value="Torna al profilo">
                    </a>
                </div>
                <h2 style="margin-top: 100px;">Inserire immagine</h2>
                <div class="col-md-12 col-sm-12">
                    <span>Immagine:</span>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group files color">
                                <form action="" method="POST" id="file-form" enctype="multipart/form-data">
                                    <input id="fileToUpload" name="fileToUpload" type="file" class="form-control" accept="image/*" onchange="confirmUpload()">
                                    <input type="hidden" name="ok" value="ok">
                                </form>
                                <script>
                                    function confirmUpload(){
                                        if(confirm("Caricare file sul server?")){
                                            document.getElementById("file-form").submit();
                                        }else{
                                            document.getElementById("fileToUpload").value = "";
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->

<footer>
     <div class="container">
          <div class="row">

               <div class="col-md-5 col-md-offset-1 col-sm-6">
                    <h3>Cashy Land</h3>
                    <p> Sito per la gestione del casinò Cashy Land. Qui puoi trovare come è composto il casino ed eventuali promozioni.</p>
                    <div class="footer-copyright">
                         <p>Copyright &copy; 2019 Cashy Land</p>
                    </div>
               </div>

               <div class="col-md-4 col-md-offset-1 col-sm-6">
                    <h3>Contattaci</h3>
                    <p><i class="fa fa-location-arrow"></i> Via Trevano, 6952 Canobbio</p>
                    <p><i class="fa fa-envelope-o"></i> gruppocasin02018@hotmail.com</p>
                    <p><i class="fa fa-github"></i> https://github.com/samtcasino/GestioneCasino</p>
               </div>
               
          </div>
     </div>
</footer>

<!-- Back top -->
<a href="#back-top" class="go-top"><i class="fa fa-angle-up"></i></a>

<!-- SCRIPTS -->

<script src="js/index.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.parallax.js"></script>
<script src="js/custom.js"></script>
<script src="js/notify.js"></script>
<script src="js/modifyDati.js"></script>

</body>
</html>

<?php
    require_once "php/loader.php";
    $target_dir = "mediaFiles/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $message = "";
    if(isset($_POST["ok"])) {    
        if (file_exists($target_file)) {
            $message .= "Sorry, file already exists. ";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            $message .= "Sorry, your file was not uploaded. "; 
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $db->executeQuery("insert into media values('".$target_file ."','immagine')");
                $message.= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. ";
            } else {
                $message.="Sorry, there was an error uploading your file. ";
            }
        }
        echo "<script>alert('$message');</script>";
    }
?>
