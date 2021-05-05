<?php include "settings/".strtolower($_GET["b"]).".php";
if($custom_css!=False){if(file_exists($custom_css)){$custom_css="<link rel='stylesheet' href='$custom_css'>";}else{$custom_css="";}}else{$custom_css="";}
$style="body{text-align:center;font-family:monospace;}p{font-size:large;}a#logo{color:black;text-decoration:none;}.notlogo{margin:25px 0px;}#article{text-align:left;margin:1px 30%;font-size:large;}@media screen and (max-width: 600px){#article{margin:1px 10%;}}footer{margin:1em 0 0 0;}";
$footer="</div><footer>pwd by <a href='https://tildegit.org/lucas/tildeweblogs'>~weblogs</a></footer></body></html>";
if(isset($_GET["p"])){
    function notfound($errno, $errstr){die("Error!\nPost not found");}
    set_error_handler("notfound");
    header("Content-type: text/html");
    $post=$_GET["p"]-1;
    echo "<!DOCTYPE html><html><head><!--~weblogs v1.1.1--><meta name='viewport' content='width=device-width,initial-scale=1'><title>".$posts[$post][1]." | $title</title><style>$style</style>$custom_css</head><body><a id='logo' href='?'><h1>$title</h1></a><div class='notlogo'>";
    if(strpos($posts[$post][2],"\n")){$html_log=str_replace("\n","<br>",$posts[$post][2]);}else{$html_log=$posts[$post][2];}
    echo "<h1>".$posts[$post][1]."</h1>".$posts[$post][0]."<br><br><div id='article'>$html_log</div>";
    if($utterances!=False){echo "<br>$utterances";}
    echo $footer;
}elseif(isset($_GET["rss"])){
    header("Content-type: application/rss+xml");
    $aaa = str_replace("?b=".$_GET["b"]."&rss", "", $_SERVER["REQUEST_URI"]);
    $eee = "http://$_SERVER[HTTP_HOST]$aaa"; ?>
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
<channel>
<title><?php echo $title ?></title>
<?php if($description!=False){echo"<description>$description</description>\n";} ?>
<link><?php echo $eee."?b=".$_GET["b"] ?></link>
<?php $a = count($posts) -1; $ao = 0; $next = $a + 1;
while($ao < count($posts)){
  if(strpos($posts[$a][2],"\n")){$html_log=str_replace("\n","<br>",$posts[$a][2]);}else{$html_log=$posts[$a][2];}
  echo "<item>\n<title>".$posts[$a][1]."</title>\n<link>$eee?b=".$_GET["b"]."&p=$next</link>\n<guid>$eee?b=".$_GET["b"]."&p=$next</guid>\n<description><![CDATA[".$html_log."]]></description>\n</item>\n";
  $a--; $ao++; $next--;
} ?>
</channel>
</rss>
<?php }else{
    header("Content-type: text/html");
    if($website!=False){$website="<a href='$website'>Website</a> - ";}else{$website="";}
    if($description!=False){$description="<p>$description</p>";}
    echo "<!DOCTYPE html><html><head><meta name='viewport' content='width=device-width,initial-scale=1'><title>$title</title><style>$style</style>$custom_css</head><body><a id='logo' href='?'><h1>$title</h1></a>$description$website<a href='?b=".$_GET["b"]."&rss'>RSS Feed</a><br><div class='notlogo'>";
    $a=count($posts)-1;$ao=0;$next=$a+1;
    while($ao < count($posts)){
        echo "<p><b><a href='?b=".$_GET["b"]."&p=$next'>".$posts[$a][1]."</a></b> ".$posts[$a][0]."</p>";
        $a--; $ao++; $next--;
    }
    echo $footer;
} ?>
