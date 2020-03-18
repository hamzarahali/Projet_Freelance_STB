<!-- HEADER -->
    <?php include 'includes/navbar.php' ?>

<!-- Print -->
    <script>
        function myFunction() {
            window.print();
        }
    </script>

    <style>
        .p1 { padding : 30px 100px }
    </style>

            <div class="container p1 text-center">
                <h2 class="alert alert-success text-center"> Facture </h2>
                <div  style="padding : 0px 100px">
                    <table class="table text-center" >
                        
                    <?php 
                        $id = $_GET ['id'] ; 
                        $email = $_SESSION ['email'] ; 
                        $req = " SELECT * FROM historique WHERE id = $id " ; 
                        $res = mysqli_query ($con,$req) ;
                        while ( $row = mysqli_fetch_array($res) ) {
                    ?>
                        <tr> 
                            <td> <label> Numéro  </label> </td>
                            <td> : </td> 
                            <td> <?= $row ['id'] ?> </td> 
                        </tr>
                        <tr> 
                            <td> <label> E-mail envoye  </label> </td> 
                            <td> : </td>
                            <td> <?= $row ['id_client_envoye'] ?> </td> 
                        </tr>
                        <tr> 
                            <td> <label> E-mail recu  </label> </td>
                            <td> : </td> 
                            <td> <?= $row ['id_client_recu'] ?> </td>
                        </tr>
                        <tr> 
                            <td> <label> Montant ( TND ) </label> </td> 
                            <td> : </td>
                            <td> <?= $row ['montant'] ?> </td>
                        </tr>
                        <tr> 
                            <td> <label> Message </label> </td> 
                            <td> : </td>
                            <td> <?= $row ['msg'] ?> </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            <div class="form-group"> 
                <button onclick="myFunction()" class="btn btn-warning">Imprimer</button>
            </div>
        </div>

<!-- FOOTER -->
    <?php include 'includes/footer.php' ?>