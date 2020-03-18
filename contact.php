<!-- HEADER --> 
    <?php include 'includes/navbar.php' ?> 
          
    <style>
.mySlides {display:none;}
</style>

<div class="container" style="padding: 50px 100px 0px">
<!-- MESSAGE -->
    <?php
        if ( isset ( $_POST ['envoyer'] ) ) {
            $nom = $_POST ['nom'] ; 
            $email = $_POST ['email'] ; 
            $msg = $_POST ['msg'] ; 
            
            $req = " INSERT INTO contact ( nom , email_client , message ) " ; 
            $req .= " VALUES ( '$nom' , '$email' , '$msg' ) " ; 
            $res = mysqli_query ($con,$req) ; 
            if ($res) 
                echo "<h5 class='alert alert-success text-center'> Message envoyeé avec success </h5>" ;
            else 
                echo "QueryField".mysqli_error() ;  
        }
    ?>
</div>
    <div class="row" style="">
        <div class="col-md-6" style="padding : 40px 150px">
        <h2 class="alert alert-warning text-center">STB Bank</h2>
            <div class="w3-content w3-section">
                <img class="mySlides" src="images/demo/c3.jpg" >
                <img class="mySlides" src="images/demo/c2.jpg">
                <img class="mySlides" src="images/demo/c1.jpg">
            </div>
            
        </div>
        <div class="col-md-6" style="padding : 100px 150px">
        <?php if ( isset ( $_SESSION ['email'] ) ) { ?> 
            <form action="" method="POST">
                <?php 
                        $email = $_SESSION ['email'] ; 

                        $req = " SELECT * FROM client WHERE email LIKE '$email' " ; 
                        $res = mysqli_query ( $con , $req ) ; 
                        while ( $row = mysqli_fetch_assoc ($res) ) {
                ?>
                <div class="form-group">
                <label for="nom">Nom et Prénom : </label>
                <input type="text" name="nom" id="nom" class="form-control" value="<?=$row['nom'].'  '.$row['prenom'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">E-mail : </label>
                    <input type="text" name="email" id="email" class="form-control" value="<?=$row['email'] ?>">
                </div>
                        <?php }?>
                <div class="form-group">
                    <label for="msg">Message : </label>
                    <textarea id="msg" name="msg" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <br>
                            <input type="submit" name="envoyer" class="form-control btn btn-warning" value="Envoyer">
                        </div>
                    </div>
                </div>
            </form>
                        <?php } else { ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nom">Nom et Prénom : </label>
                    <input type="text" name="nom" id="nom" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">E-mail : </label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                        
                <div class="form-group">
                    <label for="msg">Message : </label>
                    <textarea id="msg" name="msg" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <br>
                            <input type="submit" name="envoyer" class="form-control btn btn-warning" value="Envoyer">
                        </div>
                    </div>
                </div>
            </form>
         <?php } ?>
        </div>
    </div>
</div>
    <script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>




<!-- FOOTER  -->
    <?php include 'includes/footer.php' ?>