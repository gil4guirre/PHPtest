<?php
$sql = "SELECT *  FROM `table_endereco` WHERE `cep` = ".$typedcep."";
$result = mysqli_query($conn, $sql);