<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja-JP">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="Content-Style-Type" content="text/css">
        <meta http-equiv="content-script-type" content="text/javascript">
        <link rel="stylesheet" href="css/index.css" type="text/css">
        <script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
        <title>適当な掲示板</title>
    </head>

    <body>
        <div id="header">
            <h1><a href="<?php echo $base_url; ?>/">たぶん掲示板</a></h1>
        </div>

        <div id="main">
            <?php echo $_content; ?>
        </div>
    </body>
</html>