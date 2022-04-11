<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Endereço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src=".\function\functionJs.js"></script>
    <?php require_once "./function/system.php"; ?>
</head>
<body>
    <div class="container bg-dark p-5 mt-3">
        <div class="row justify-content-center mb-2">
            <h2 class="text-light col-4">Buscar Endereço</h2>
        </div>
        <div class="row justify-content-center mb-2">
            <h3 class="text-light col-8">Digite o CEP no campo e clique no botão "Buscar"</h3>
        </div>
        <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="row justify-content-center mb-2">
                <label for="cep" class="col-3 text-light">CEP:</label>
                <input name="cep" type="text" id="cep" class="col-3 " value="<?php echo $cep; ?>" onkeydown="cepMask(this)" maxlength="9" pattern="\d{5}-?\d{3}" autofocus/>
                <input type="submit" class="btn btn-secondary col-3" value="Buscar"/>
            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>