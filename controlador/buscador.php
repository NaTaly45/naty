<?php
include '../db/DB_CONNEXION.php';
$conn = conn();



?>


<?php
if (!isset($_POST['buscar'])) {$_POST['buscar']= '';}
if (!empty($_POST)) {
    function resaltar_frase($string,$frace,$taga = '<b>',$tagb='</b>'){
        return ($string !== '' && $frace !=='')?
        preg_replace('/('.preg_quote($frace,'/').')/i'.('true'?'u':''),$taga.'\\1'.$tagb,$string)
        :$string;
    }
    $akeyword = explode(" ",$_POST['buscar']);
    //$filtro =
    $query = "SELECT * from guia_ambiente where nombre_ambiente like lower('%".$akeyword[0]."%')";
    for($i = 1; $i < count($akeyword);$i++){
        if (!empty($akeyword[$i])) {
            $query.=" or nombre_ambiente like '%". $akeyword[$i]."%'";
        }
    }
    $resul = $conn->query($query);
    
    if ($resul === false) {
        echo "Error en la consulta SQL: " . $conn->error;
    }else{$numero = mysqli_num_rows($resul);
    if (mysqli_num_rows($resul)>0 and $_POST['buscar'] !='') {
        $row_cont = 0;
        echo "Resultados encontrados: ".$numero."";
        while ($datos= $resul -> fetch_assoc()) {
            echo "<a class='dropdown-item' href='ambientes.php?id=".$datos['id_ambiente']."'>".resaltar_frase($datos['nombre_ambiente'],$_POST['buscar'])."</a>";
        }
    }}
}
?>