<?php
while($row = mysqli_fetch_assoc($result)) {
    $cep = substr_replace($row["cep"],"-",5,0);
    $logradouro = $row["logradouro"];
    $complemento = $row["complemento"];
    if($complemento != ""){
        $noNumber = " ".$complemento.",";
    }else{
        $noNumber = $complemento;
    };
    $bairro = $row["bairro"];
    $cidade = $row["cidade"];
    $uf = $row["uf"];
    $endereco = $logradouro . "," . $noNumber . " " . $bairro . ", " . $cidade . " - " . $uf . ", " . $cep;
}