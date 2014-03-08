<?php
    /*$string = file_get_contents("data.json");
    $json_a=json_decode($string,true);

    $jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($string, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);

    foreach ($jsonIterator as $key => $val) {
        if(is_array($val)) {
            echo "<br />$key:";
        } else {
            echo "$key => $val\n";
        }
    }*/

    $jsonContent = json_decode(file_get_contents("data.json"),true);

    //page vals
    $lang = $jsonContent["default-lang"]; 
    $headertext = $jsonContent["header"][$lang];
    $footerText = $jsonContent["footer"][$lang];

    //generate columns

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta charset=utf-8 />
	<title></title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" media="screen" href="master.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
</head>
<body>
    <div class="box bar">
        <h1 class="light"><?php echo $headertext; ?></h1>
        <p class="bright">en | de</p>
    </div>
    
    <!-- Content //-->
    <div class="box column"></div>
    <div class="box column"></div>
    <div class="box column"></div>
    
    <div class="footer">
        <div class="box bar">
            <p class="bright"><?php echo $footerText; ?></p>
        </div>
    </div>


</body>
</html>