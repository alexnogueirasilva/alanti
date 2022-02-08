<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo TITLE; ?> 500</title>
    <link href="http://<?php echo APP_HOST; ?>/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://<?php echo APP_HOST; ?>/public/css/error.css" rel="stylesheet">
</head>
<body>
    <center>
    <div class="container">
         <a href="javascript: history.go(-1)" title="Clique aqui pra retornar" > 
            <img src="http://<?php echo APP_HOST; ?>/public/assets/media/logos/alanti_logo.png" alt="Coisa Virtual" >
        </a>
        <h1 class="error"><?php echo $varMessage; ?></h1>
        <a href="javascript: history.go(-1)" title='Clique aqui pra retornar' > Click aqui para retornar </a>
    </div>
</body>
</html>
