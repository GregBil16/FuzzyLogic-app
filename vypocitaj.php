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
                <a class="navbar-brand" href="index.php">Gregor Bilčík - Projekt Fuzzy množiny v rozhodovacích procesoch</a>
                
            </div>
        </nav>
        <!-- Page content-->
        <div class="container">
        <div class="block">
                        		
		</div>
        <div>
            <p> <a href="index.php" class="btn btn-secondary">Naspäť na zadávanie údajov</a> </p>
        </div>
        <div>
            <?php
                include("config.php"); //aby sme sa vedeli pripojiť na databázu
                
                //prebratie premenných zadaných používateľom:
                $a_minuty=$_POST["a_minuty"]; //a pre fuzzy mnozinu nizky pocet trestnych minut
                $b_minuty=$_POST["b_minuty"]; //b pre fuzzy mnozinu nizky pocet trestnych minut
                $a_goly=$_POST["a_goly"]; //a pre fuzzy mnozinu vysoky pocet strelenych golov
                $b_goly=$_POST["b_goly"]; //b pre fuzzy mnozinu vysoky pocet strelenych golov
                $t_norm=$_POST["t_norm"]; //pouzivatelom ziadana t-norma  
                echo "<p>Pouzivateľom žiadananá t-norma: <b style='color:red'>".$t_norm."</b></p>";
                echo "<p>Zoradení hráčí od najviac vyhovujúcich po najmenej (hráčov, pri ktorých vyšla hodnota t-normy = 0 - nevyhovujúci, aplikácia nezobrazí):</p>";

                //pripojenie na DB
                $var= mysqli_connect("$localhost","$user","$password","$db") or die ("connect error");
                $sql="select * from zakladna_tabulka";
				$res=mysqli_query($var,$sql) or die ("registration error");

                while($row=mysqli_fetch_assoc($res))
                {
                        $id = $row['id'];
                        $trestne_minuty = $row['trestne_minuty'];
                        $goly = $row['goly'];
              
                        //tuna zacina vypocet intenzity pre nizky pocet trestnych minut:          
                        if ($trestne_minuty<=$a_minuty){
                            $fuzzy_minuty=1;

                        }else if($trestne_minuty>=$b_minuty){
                            $fuzzy_minuty=0;
                        }else {
                            $fuzzy_minuty=($b_minuty-$trestne_minuty)/($b_minuty-$a_minuty);
                        }

                        //aktualizacia stlpca pre intenzitu k fuzzy nizky pocet trestnych minut k konkretnemu hracovi:
                        $sql ="UPDATE zakladna_tabulka set intenzita_nizky_pocet_trestnych_minut = '$fuzzy_minuty' WHERE id = ' $id'";
                        $vysledok=mysqli_query($var,$sql) or die ("registration error");

                        //tuna zacina vypocet intezity pre vysoky pocet golov:
                        if ($goly>=$b_goly){
                            $fuzzy_goly=1;

                        }else if($goly<=$a_goly){
                            $fuzzy_goly=0;
                        }else {
                            $fuzzy_goly=($goly-$a_goly)/($b_goly-$a_goly);
                        }
                    
                        //aktualizacia stlpca pre intenzitu k fuzzy vysoky pocet strelenych golov k konkretnemu hracovi:
                        $sql ="UPDATE zakladna_tabulka set intenzita_vysoky_pocet_golov = '$fuzzy_goly' WHERE id = ' $id'";
                        $vysledok=mysqli_query($var,$sql) or die ("registration error");
          
                            //aktualizacia stlpca v DB pre vypocitane t-normy:
                            $nahravanie_minimova=min($fuzzy_goly,$fuzzy_minuty); //vypocet hodnoty minimovej t-normy pre 1 riadok v db
                            $sql ="UPDATE zakladna_tabulka set minimova = '$nahravanie_minimova' WHERE id = ' $id'";
                            $vysledok=mysqli_query($var,$sql) or die ("registration error");

                            $nahravanie_sucinova=$fuzzy_goly * $fuzzy_minuty; //vypocet hodnoty sucinovej t-normy pre 1 riadok v DB
                            $sql ="UPDATE zakladna_tabulka set sucinova = '$nahravanie_sucinova' WHERE id = ' $id'";
                            $vysledok=mysqli_query($var,$sql) or die ("registration error");
                }
            ?>
        </div>
        <div>
            
            <table class="table table-striped">

                <thead class="thead-dark">
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">Meno</th>
                    <th scope="col">Priezvisko</th>
                    <th scope="col">Trestné minúty</th>
                    <th scope="col">Počet strelených gólov</th>
                    <th scope="col">intenzita prislusnosti do Nízky počet trestných minút</th>
                    <th scope="col">intenzita prislusnosti do Vysoký počet strelených gólov</th>
                    <th scope="col">Výsledná hodnota použitej t-normy</th>
                   
                    </tr>
                </thead>
                <tbody>
                <?php
                    //vypisanie tabulky
                    //cez IF sa rozhoduje ktora t-norma bola pouzita a podla ktorej ma spravit SELECT so zoradenim ORDER BY a od najvyssej po najnizsiu pomocou DESC
                
                    if($t_norm=="minimova"){
                        $sql = "SELECT * FROM zakladna_tabulka WHERE minimova!=0 ORDER BY minimova DESC;";
                        $konecny=mysqli_query($var,$sql) or die ("registration error");
                    }else{
                        $sql = "SELECT  * FROM zakladna_tabulka WHERE sucinova!=0 ORDER BY sucinova DESC;";
                        $konecny=mysqli_query($var,$sql) or die ("registration error");
                    }
                

                    while($row=mysqli_fetch_assoc($konecny))
                    {
                    $id = $row['id'];
                    $meno_hraca = $row['meno_hraca'];
                    $priezvisko_hraca = $row['priezvisko_hraca'];
                    $trestne_minuty = $row['trestne_minuty'];
                    $goly = $row['goly'];
                    $intenzita_nizky_pocet_trestnych_minut = $row['intenzita_nizky_pocet_trestnych_minut'];
                    $intenzita_vysoky_pocet_golov = $row['intenzita_vysoky_pocet_golov'];
                    $minimova = $row['minimova'];
                    $sucinova = $row['sucinova'];
                
            
                    if($t_norm=="minimova"){
                        echo "<tr>
                        <td>".$id."</td> 
                        <td>".$meno_hraca."</td> 
                        <td>".$priezvisko_hraca."</td> 
                        <td>".$trestne_minuty."</td> 
                        <td>".$goly."</td> 
                        <td>".$intenzita_nizky_pocet_trestnych_minut."</td> 
                        <td>".$intenzita_vysoky_pocet_golov."</td>
                        <td>".$minimova."</td>";

                    }else {
                        echo "<tr>
                        <td>".$id."</td> 
                        <td>".$meno_hraca."</td> 
                        <td>".$priezvisko_hraca."</td> 
                        <td>".$trestne_minuty."</td> 
                        <td>".$goly."</td> 
                        <td>".$intenzita_nizky_pocet_trestnych_minut."</td> 
                        <td>".$intenzita_vysoky_pocet_golov."</td>
                        <td>".$sucinova."</td>";
                    }
                        
                
                
                    }
                ?>
                </tbody>
            </table>


        </div>
        <?php
            //vyresetovanie hodnôt pred dalsim zadanim parametrov, avsak toto nie je az tak nutne lebo tak ci tak sa dava v hlavnom kode UPDATE takze sa hodnoty prepisu
            // v prípade, že chceme v phpmyadmin nahliadnut ako to vypocitalo tak rieto prikazy treba ,,zakomentova" alebo vymazať
            $sql ="UPDATE zakladna_tabulka set sucinova = 0, minimova = 0, intenzita_nizky_pocet_trestnych_minut = 0, intenzita_vysoky_pocet_golov = 0";
            $vysledok=mysqli_query($var,$sql) or die ("registration error");

        ?>
     
    </body>
</html>
