<?php

    $jsonContent = json_decode(file_get_contents("data.json"),true);

    //page vals
    $lang = $jsonContent["default-lang"]; 
    
    if(isset($_GET['lang'])){
        $lang = $_GET['lang'];
    }

    $headertext = $jsonContent["header"][$lang];
    $footerText = $jsonContent["footer"][$lang];

    function generateTitle($item, $lang){
        if(array_key_exists("title", $item)){
            return "<h1>" . $item["title"][$lang] . "</h1>";
        }
        return "";
    }
    
    function generateQuote($item, $lang){
        if(array_key_exists("quote", $item)){
            return "<h1 class='title'>" . $item["quote"][$lang] . "</h1>";
        }
        return "";
    }  

    function generateText($item, $lang){
        if(array_key_exists("text", $item)){
            return "<p>" . $item["text"][$lang] . "</p>";
        }
        return "";
    }
    
    function generateLinkList($item, $lang){
        if(array_key_exists("link-list", $item)){
	    $list = "";
	    foreach($item["link-list"] as $link) {
		$list .= "<a href='" . $link['url'] . "' target='_blank'>";
		$list .= "<div class='social_icon'>";
		$list .= "<p><img src='icons/" . $link['icon'] . "' align='left'>" . $link['text'][$lang] . "</p>";
		$list .= "</div>";
		$list .= "</a>";
	    }
            return $list;
        }
        return "";
    }
    
    function generateImage($item){
        if(array_key_exists("image", $item)){
            return "<div class='box' style='background: URL(" . $item["image"] . ") no-repeat center; min-height: 40em;'>&nbsp;</div>";
        }
        return "";
    }

    function generateHtmlBlock($item){
        if(array_key_exists("htmlBlock", $item)){
            return $item["htmlBlock"];
        }
        return "";
    }
    
    

    function generateBox($item, $lang){
        $box = "<div class='box container'>";
        
        $box .= generateTitle($item, $lang);
	$box .= generateQuote($item, $lang);
        $box .= generateText($item, $lang);
	$box .= generateLinkList($item, $lang);
	$box .= generateImage($item);
        $box .= generateHtmlBlock($item);
        
        $box .= "</div>";
        
        return $box;
    }

    //END

    //generate columns
    $content1 = "";
    $content2 = "";
    $content3 = "";
    
    $i = 0;
    foreach($jsonContent["items"] as $item) {
	if($i < 6){
	    $content1 .= generateBox($item, $lang);
	} elseif($i < 13){
	    $content2 .= generateBox($item, $lang);
	} else {
	    $content3 .= generateBox($item, $lang);
	}
        $i++;
    }
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
        <p class="bright"><a class='bright' style="text-decoration:none;" href="?lang=en">en</a> | <a class='bright' style="text-decoration:none;" href="?lang=de">de</a></p>
    </div>
    
    <!-- Content //-->
    <div class="box column"><?php echo $content1; ?></div>
    <div class="box column"><?php echo $content2; ?></div>
    <div class="box column"><?php echo $content3; ?></div>
    
    <div class="footer">
        <div class="box bar">
            <p class="bright"><?php echo $footerText; ?></p>
        </div>
    </div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-49218125-1', 'hautzenberger.at');
  ga('send', 'pageview');

</script>
</body>
</html