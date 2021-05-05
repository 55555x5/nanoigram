<?php exec("curl -O https://raw.githubusercontent.com/7ort/register_blogs/main/db.php"); include "db.php"; if(isset($_GET["b"])){
  $i=0;$a=1;
  while($a <= count($blogs)){
    $str=strtolower($blogs[$i][0]);
    $bstr=strtolower($_GET["b"]);

    if($str==$bstr){
      $none=$blogs[$i][1];
      $ntwo=strtolower($blogs[$i][0]);
      exec("curl -o settings/".strtolower($_GET["b"]).".php ".$none);
      include "engine.php";
    }
    $i++;$a++;
  }
}else{ ?>
<html>
  <head>
    <title>7ort Blogs</title>
  </head>
  <body>
    <?php echo '<p>Request an account <a href="https://github.com/7ort/register_blogs">here</a></p>'; ?> 
  </body>
</html>
<!--"Como correo del gobierno
canadiense[...]"
"Manuel era un ayudante de jardinero cuyo salario no cubría las necesidades de su mujer ni las de los varios y pequeños duplicados de sí mismo."
--El llamdo de lo salvaje -->
<?php } ?>
