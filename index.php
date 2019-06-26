<?php
//LLamando a la bd
include "admin/db.php";

$db=con();
error_reporting (0);
//LLamando archivo
include 'Cart.php';
$cart = new Cart; 
$varsesion = $_SESSION['user'];
$encabezados=get_sec_encabezados();
$noticias=get_noticias();
$slide=get_sliders();
$footer=get_footers();




$query="select * from users where user='$varsesion'";
$result=mysqli_query($db,$query);
       
     


?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/superslides.css">
     <link rel="icon" type="image/png" href="images/iconobad.ico" />
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
   
<title>Dragon Table Tennis</title>
  
</head>

<body>

   <header id="headmain">
   <div class="logohead">

           <img src="images/logo.png" alt="">

       </div>
   <nav id="menu">
 
     <ul class="no_list">

     <?php foreach($encabezados as $img):?>

         <li><a href="<?php echo $img->url_enc; ?>"><?php echo $img->nom_enc; ?></a></li>
         <?php endforeach;?>

         <?php if($varsesion == null || $varsesion == ''){ ?>
         <li  class="carrito"><a href="logusuario.php"><i class="fas fa-user-tie"></i>Ingresar</a></li>
         <li style="display:none;"  class="carrito"><a href="miperfil.php"><i class="fas fa-user-tie"></i> Perfil</a></li>
         <?php }else{ ?>
          <li  style="display:none;" class="carrito"><a href="logusuario.php"><i class="fas fa-user-tie"></i>Ingresar</a></li>
       
         <li  class="carrito"><a href="admin/logoutpage.php"><i class="fas fa-sign-out-alt"></i> Salir</a></li>
         <li  class="carrito"><a href="miperfil.php"><i class="fas fa-user-tie"></i> Perfil</a></li>
         <?php }?>
         <li class="carrito"><a  href="compra.php"><i class="fas fa-shopping-cart"></i> <?php echo $cart->total_items() ?></a></li>

     </ul>
     
 </nav>
  


   </header>

   <div class="ms_grandiet">
    <div id="slides">
  <ul class="slides-container">


  <?php foreach($slide as $img): ?>
    <li>

      <img src="<?php echo 'admin/'.$img->folder.$img->src ?>" alt="">
    
    </li>

    <?php endforeach;?>
  </ul>


  <nav class="slides-navigation">

    <a href="#" class="next">></a>
    <a href="#" class="prev"><</a>

  </nav>
</div>
</div>
<div id="medle"></div>
<div class="medio_body">
  <div class="title_medio_body">
  <h2 id="notic">Tennis para todos</h2>
  <p style="    margin: 0.2em 0 0.2em 0;
    text-align: center;     color: #948d94;  font-family: 'Comfortaa', cursive;">noticias</p>
  </div>
  <div class="search">
<form action="" method="post">

<label for="Noticia"></label>
<input  name="PalabraClave" required  type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Ingrese titulo">
<input name="buscar" type="hidden" class="form-control mb-2" id="inlineFormInput" value="v">
<input type="date" required name="fecha1" id="fecha1">
<input type="date" required name="fecha2" id="fecha2">
      <button type="submit" name="submit" id="submit" class="btn btn-primary mb-2">Buscar Ahora</button>

    </form>
</div>

<div class="content_card REX">
<?php foreach($noticias as $img):
    $link = 'detallenoticia.php?nom_noticia='.  $img->nom_noticia;?>
  <div class="cards">
  <div class="card_images">  <img src="<?php echo 'admin/'.$img->folder.$img->src ?>" alt="noticia" ></div>

    <div class="title_card">
    <a href="<?php echo $link; ?>"> <h2><?php echo $img->nom_noticia; ?></h2> </a>
      <p><?php  setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
           $d =  $img->created_at;
           $fecha = strftime("%d de %B de %Y", strtotime($d)); echo $fecha ?></p>
      <div class="info_card">
      <span class="fh5co-metae tile_cord"  data-truncate-lines="3" data-truncate-position="end" data-auto-line-height="true"><?php echo $img->contenido_noticia; ?></span>
      </div>
      </div>
      


  </div>
  <?php endforeach;?>

 
 
 
</div>
</div>
<?php
 
 if(!empty($_POST)){
   
  $aKeyword =  $_POST['PalabraClave'];
       $fecha1=$_POST['fecha1'];
       $fecha2=$_POST['fecha2'];
       $query ="select * FROM noticias WHERE  DATE(created_at) BETWEEN '".$fecha1."' AND '".$fecha2."'  AND nom_noticia like '%" .  $aKeyword[0] . "%'";

      $result = $db->query($query);
      if(mysqli_num_rows($result) > 0) {
        $row_count=0;
        While($row = $result->fetch_assoc()) {   
          $row_count++;       
           $link2= 'detallenoticia.php?nom_noticia='.$row["nom_noticia"];
           setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
           $d = $row["created_at"];
           $fecha = strftime("%d de %B de %Y", strtotime($d));
         echo ' 
         <div class="content_card">
         
           <div class="cards">
           <div class="card_images" style="height: 310px;">  <img src="admin/'. $row["folder"]. $row["src"].'" alt="noticia" ></div>
         
             <div class="title_card">
             <a href="'. $link2.'"> <h2>'.$row["nom_noticia"].' </h2> </a>
               <p>'.  $fecha.'</p>
               <div class="info_card">
               <span class="fh5co-metae tile_cord"  data-truncate-lines="3" data-truncate-position="end" data-auto-line-height="true">'.  $row["contenido_noticia"].'</span>
               </div>
               </div>
               
         
         
           </div>
           </div>
           </div>';
           echo '<style> .REX{display:none;} </style>';
          
         }
         
   
     }
     else {
         echo "<br> <p style='text-align:center; font-size:20px; color:red;'>No hay Resultados encontrados</p>";
         echo '<style> .REX{display:none;} </style>';
       
     }
 

    
 }
  
 ?>


<footer>

<?php foreach($footer as $img):?>
<li>

  <p>Dirección : <br> <?php echo $img->direccion_footer; ?>  </p>
  <p>Celular : <br> <?php echo $img->cel_footer; ?> </p>
  <p>Telefono : <br> <?php echo $img->tel_footer; ?> </p>
  <p>Horario : <br> <?php echo $img->horarios_footer; ?> </p>

</li>

<li>

<p>Facebook : <br> <?php echo $img->facebook_footer; ?> </p>

<p>email : <br><?php echo $img->email_footer; ?> </p>
</li>

<?php endforeach;?>

</footer>


<!----ZONA DE JS ------------------------------------------------->


<script src="js/jquery.superslides.min.js"></script>
<script src="js/truncate.min.js"></script>
<script>

$(document).ready(function(){

$(".tile_cord").each(function(){

var currentElement=$(this);

var config ={

  lines:currentElement.data('truncate-lines'),

  position:currentElement.data('truncate-position')

}



if(!currentElement.data('auto-line-height')){

  config.lineHeight =currentElement.css("line-height");

}

currentElement.truncate(config);

});

});

</script>
<script>

function countChars(obj){
  
    var maxLength = 500;
    var strLength = obj.value.length;
    
    if(strLength > maxLength){
       
        document.getElementById("charNum").innerHTML = '<span style="color: red;">Superaste el limite de  caracteres</span>';
        $('#comentar').attr('disabled', true);
    }
 
   else if(strLength == 0)
    {
      document.getElementById("charNum").innerHTML = '<span style="color: red;">Debes tener mas de un caracter</span>';
      $('#comentar').attr('disabled', true);
    }
    else{
        document.getElementById("charNum").innerHTML = strLength+' out of '+maxLength+' characters';
        $('#comentar').attr('disabled', false);
    }
}
</script>
</body>
</html>