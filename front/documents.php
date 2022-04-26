<?php
require ("../back/ModelDoc.php");
ini_set("xdebug.var_display_max_children", '-1');
ini_set("xdebug.var_display_max_data", '-1');
ini_set("xdebug.var_display_max_depth", '-1');
$docs = new Docs();
$getDocs = $docs->getAllDoc();
//var_dump($getDocs);
$id = $getDocs[0]['id'];
?>

<html>
<?php 
     require 'header.php'; ?>
<link rel="stylesheet" href="./css/styleOrdi.css">
<body>
<div class="blockrg"></div>
<div class="blockrg2"></div>
<div class="containerrg">
    <div class="titredoc"><?php 
    $titre = $getDocs[0]['titre'];
    echo $titre;?>
    </div>
    <div class="textarea">
    <textarea class=<?php if($id == "8") { echo "texterg2";} else{echo "texterg";}?> readonly >
    <?php
    $document = $getDocs[0]['text'];
    echo stripslashes($document); 

    //print_r($getDocs[0]['text']);
    ?>
    </textarea>

    </div>
</div>
</body>
</html>

<?php 
     require 'footer.php'; ?>