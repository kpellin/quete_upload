<!DOCTYPE html>
<html>
<head>
	<title>Formulaire</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

<!--Formulaire-->

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleFormControlFile1">Choisissez un fichier</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" multiple="multiple" name="fichier[]">
    <input type="submit" value="Send" />
  </div>
</form>


<?php 


if (isset($_POST))
{


  if (!empty($_FILES)) 
  {

    foreach ($_FILES['fichier']['name'] as $key => $value) 
    {

       
  
      $fileName = $_FILES['fichier']['name'][$key];
      $fileType = $_FILES['fichier']['type'][$key];
      $fileTmpName = $_FILES['fichier']['tmp_name'][$key];
      $fileError = $_FILES['fichier']['error'][$key];
      $fileSize = $_FILES['fichier']['size'][$key];

      $extention = explode('.', $fileName);
      $fileActualExt = strtolower(end($extention));
      $permission = array('jpg', 'png', 'gif');


      
          if (in_array($fileActualExt, $permission)) 
          {
            if ($fileError === 0) 
            {
              if ($fileSize < 1000000) 
              {
                $fileNameNew = uniqid('image', true).".".$fileActualExt;
                $fileDestination = "upload/".$fileNameNew;

                move_uploaded_file($fileTmpName, $fileDestination);

              }
              else
              {
                echo "Votre fichier est trop lourd";
              }
            }
            else
            {
              echo 'Il y a eu une erreur lors du téléchargement, veuillez recommencer.';
            }
          }
          else
          {
            echo "Vous ne pouvez pas télécharger un fichier de ce type. Seuls les fichier jpg, png et gif sont valides";
          }
      }
 
  }
  else
  {
    echo '<h1> Pas de fichier à afficher. </h1>';
  }

} 
else
{
  echo 'error';
}
    

?>


<figure class="container figure">
<?php

$filesToDisplay = scandir('upload');

if (!empty($filesToDisplay)) 
{


      foreach ( $filesToDisplay as $key => $file) 
      {
        if ($file !== '.' && $file !== '..') 
        {
             
          ?>
          <img src="upload/<?= $file; ?>" class="img-thumbnail col figure-img" alt="...">
          <figcaption><?php echo $file; ?></figcaption>

          <form method="POST" action="delete.php">
            <button type="submit" id="submit" value="upload/<?= $file; ?>" name="submit" class="btn btn-danger">Supprimer</button>
           </form> 
          <?php

        }

      }
}

 ?>


</figure>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>