<?php
$xml = "";
$cep = "";
$logradouro = "";
$complemento = "";
$bairro = "";
$cidade = "";
$uf = "";
$endereco = "";

if(isset($_GET["cep"])){
    $typedcep = preg_replace('/\D/',"",$_GET["cep"]);

    require_once "./function/dbconnection.php";

    require "./function/cepdbsearch.php";
    
    if (mysqli_num_rows($result) > 0) {
        require "./function/cepdbshow.php";
    }else{
        $xml = simplexml_load_file('https://viacep.com.br/ws/' . $typedcep . '/xml/');
        
        if ($xml->erro){
            $cep=$_GET["cep"];
            $endereco = "Erro: CEP Inexistente! Digite o CEP novamente.";
        }else{
            $cepnumbers = preg_replace('/\D/',"",$xml->cep);
            $xmlLogradouro = $xml->logradouro;
            $xmlComplemento = $xml->complemento;
            $xmlBairro = $xml->bairro;
            $xmlCidade = $xml->localidade;
            $xmlUf = $xml->uf;
            
            $sql = "INSERT INTO `table_endereco` VALUES ('".$cepnumbers."', '".$xmlLogradouro."', '".$xmlComplemento."', '".$xmlBairro."', '".$xmlCidade."', '".$xmlUf."')";
            $result = mysqli_query($conn, $sql);

            require "./function/cepdbsearch.php";

            if (mysqli_num_rows($result) > 0) {
                require "./function/cepdbshow.php";
            }
        }
    }

    mysqli_close($conn);
}else{
    $typedcep = "";
}
