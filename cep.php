<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Endereço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
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

?>
<body>
    <div class="container bg-dark p-5 mt-3">
        <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="row justify-content-center mb-2">
            <label for="cep" class="col-3 text-light">CEP:</label>
            <input name="cep" type="text" id="cep" class="col-3" value="<?php echo $cep; ?>" onkeydown="cepMask(this)" maxlength="9" pattern="\d{5}-?\d{3}" autofocus/>
            <input type="submit" class="col-3" value="Enviar"/>
        </form>
        <div class="row justify-content-center mb-2">
            <label for="logradouro" class="col-3 text-light">Logradouro:</label>
            <input name="rua" type="text" id="logradouro" class="col-6" value="<?php echo $logradouro; ?>"  onclick="copyToClipboard(this)" readonly/>
        </div>
        <div class="row justify-content-center mb-2">
            <label for="complemento" class="col-3 text-light">Complemento:</label>
            <input name="complemento" type="text" id="complemento" class="col-6" value="<?php echo $complemento; ?>" onclick="copyToClipboard(this)" readonly/>
        </div>
        <div class="row justify-content-center mb-2">
            <label for="bairro" class="col-3 text-light">Bairro:</label>
            <input name="bairro" type="text" id="bairro" class="col-6" value="<?php echo $bairro; ?>"  onclick="copyToClipboard(this)" readonly/>
        </div>
        <div class="row justify-content-center mb-2">
            <label for="cidade" class="col-3 text-light">Cidade:</label>
            <input name="cidade" type="text" id="cidade" class="col-6" value="<?php echo $cidade; ?>" onclick="copyToClipboard(this)" readonly/>
        </div>
        <div class="row justify-content-center mb-2">
            <label for="uf" class="col-3 text-light">Estado:</label>
            <input name="uf" type="text" id="uf" class="col-6" value="<?php echo $uf; ?>" onclick="copyToClipboard(this)" readonly/>
        </div>
        <div class="row justify-content-center">
            <label for="endereco" class="col-9 text-light">Endereço Completo:</label>
            <input name="endereco" type="text" id="endereco" class="col-9" value="<?php echo $endereco; ?>" onclick="copyToClipboard(this)" readonly/>
        </div>
    </div>
    <script>
        function cepMask(text) {
            if(event.keyCode == 8 || event.keyCode == 13 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) return;
            let key = event.key

            let regex = new RegExp("\\d")
            if(!regex.test(key)){
                event.preventDefault()
                return;
            }

            let value = event.target.value
            let valueOnlyNumber = value.replace(/\D/gi,"")
            let stringSize = valueOnlyNumber.length

            let lastString = value.substr(-1)
            if(lastString == "-") return;

            if(stringSize == 5) event.target.value = event.target.value + "-"
        }

        function copyToClipboard(text){
            text.select();
            document.execCommand('copy');
            text.blur();
        }
    </script>
    <script>
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>
</html>