<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>gestion des stagiaires</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div id="id_logo" >
    </div>
<div id="root_div">
    <?php
        include "header_conection.php";
    ?>
    <div class="contener nosenter">
    <form action="index.php" class="id_serch" method="POST" id="searchForm">
                <input name="cne" type="text" class="serchid" value="" placeholder="recherche par CNE">
                <button type="submit"  class="btn_srchid">
                    <img src="img/search.png" alt="">
                </button>
            </form>
        <table class="tbl_style">
            <thead>
                <tr>
                    <th>CNE</th>
                    <th>NOM</th>
                    <th>PRENOM</th>
                    <th>DATE DE NAISSANCE</th>
                    <th>SEXE</th>
                    <th>GROUPE</th>
                    <th>FILIERE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        $conn = conection();
                        $sql = $conn->prepare("SELECT * FROM stagiaires");
                        $sql->execute();
                        $info = $sql->fetchAll();
                        foreach($info as $value){
                        echo "<tr>";
                        echo "<td>".$value['cne']."</td>";
                        echo "<td>".$value['nom']."</td>";
                        echo "<td>".$value['prenom']."</td>";
                        echo "<td>".$value['daten']."</td>";
                        echo "<td>".$value['sexe']."</td>";
                        echo "<td>".$value['filiere']."</td>";
                        echo "<td>".$value['groupe']."</td>";
                        echo "</tr>";
                        }
                        // $conn = conection();
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $code = $_POST["cne"];
                            $sql = $conn->prepare("SELECT * FROM stagiaires WHERE cne = ?");
                            $sql->execute([$code]);
                            $info = $sql->fetchAll();
                            if (!empty($info)) {
                                foreach ($info as $value) {
                                    echo "<tr>";
                                    echo "<td>" . $value['cne'] . "</td>";
                                    echo "<td>" . $value['nom'] . "</td>";
                                    echo "<td>" . $value['prenom'] . "</td>";
                                    echo "<td>" . $value['daten'] . "</td>";
                                    echo "<td>" . $value['sexe'] . "</td>";
                                    echo "<td>" . $value['filiere'] . "</td>";
                                    echo "<td>" . $value['groupe'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7' style='text-align:center;'>Aucun stagiaire trouvé avec le CNE '$code'</td></tr>";
                            }
                        }
                        
                        
                        ?>
            </tbody>
        </table>
    </div>
</div>
</body>
<script>
    let text = "GESTION DES STAGIAIRES";
    let index = 0;
    let div_f = document.getElementById('id_logo');
    function ecrer(){
        
        if (index < text.length){
            div_f.textContent += text.charAt(index)
            index+=1
            setTimeout(ecrer, 100); 
        }else{
            div_f.classList.add("id_logo")
            setTimeout(()=>{
                div_f.style.display = 'none';
                document.getElementById('root_div').style.display='block'
            },1100)
        }
        }
    window.addEventListener('load',ecrer)
    setTimeout(()=>{
        window.removeEventListener('load',ecrer)

            },1200)
</script>


</html>