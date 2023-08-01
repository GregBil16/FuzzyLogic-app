<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Gregor Bilčík - Projekt Fuzzy množiny v rozhodovacích procesoch</title>
        <!-- Favicon-->
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Gregor Bilčík - Projekt Fuzzy množiny v rozhodovacích procesoch</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container">
        <div class="block">
                        <?php
                        //formulár na zadávanie parametrov - využíva metódu POST
							echo '<h1>Zadajte požadované parametre</h1>';

                            echo '<form action="vypocitaj.php" method="POST">'; //nacitane hodnoty posunie suboru vypocitaj.php
                                echo '<b>a</b> pre Nizky pocet trestnych minut: <br> <p><input type ="text" name="a_minuty"></p>';
                                echo '<b>b</b> pre Nizky pocet trestnych minut: <br> <p><input type="text" name="b_minuty"></p>';
								echo '<b>a</b> pre Vysoky pocet strelenych golov: <br> <p><input type ="text" name="a_goly"></p>';
								echo '<b>b</b> pre Vysoky pocet strelenych golov: <br> <p><input type ="text" name="b_goly"></p>';
								echo '<select name = "t_norm">
                                <option type ="text" value = "minimova" selected>Minimová t-norma</option>
                                <option type ="text" value = "sucinova">Súčinová t-norma</option>
                             </select></p>';
								echo '<button type="submit" class="btn btn-primary" a href="spracuj.php">Vypočítaj</button>';
								echo '<button type="reset" class="btn btn-primary mx-3">Reset</button>';
                            echo '</form>';
                         ?>					
		</div>
        <div>
        </div>
        <div>
            <?php
                //pripojenie na DB aby sme vypisali vsetkých hráčov
                include("config.php");
                $var= mysqli_connect("$localhost","$user","$password","$db") or die ("connect error");
				$sql="select meno_hraca, priezvisko_hraca, trestne_minuty, goly from zakladna_tabulka";
				$res=mysqli_query($var,$sql) or die ("registration error");
         
            ?>
        <div>
            <table class="table table-striped">

                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Meno</th>
                    <th scope="col">Priezvisko</th>
                    <th scope="col">Trestné minúty</th>
                    <th scope="col">Počet strelených gólov</th>
                   
                    </tr>
                </thead>


                <tbody>
                <?php
                //vypísanie všetkých hráčov z databázy
                while($row=mysqli_fetch_assoc($res))
                {
                $meno_hraca = $row['meno_hraca'];
                $priezvisko_hraca = $row['priezvisko_hraca'];
                $trestne_minuty = $row['trestne_minuty'];
                $goly = $row['goly'];
    
                echo "<tr>
                <td>".$meno_hraca."</td> 
                <td>".$priezvisko_hraca."</td> 
                <td>".$trestne_minuty."</td>
                <td>".$goly."</td>";
                }
                ?>
                </tbody>
            </table>


        </div>

       <div>
        <br>
        <br>
        <br>
        </div>
    </body>
</html>
