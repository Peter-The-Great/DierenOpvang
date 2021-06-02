<?php
session_start();
require('../php/database.php');
if (!isset($_SESSION["loggedin"])) {
    header("Location: ../index.php");
    exit();
}

$sql = "SELECT id, name FROM cat;";
$result = $conn->query($sql);

$token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] =  $token;

if($stmt = $conn->prepare("SELECT titel,subtext,text,image,video,leerlijn FROM subject WHERE id = ?")) {
    $stmt->bind_param("s", $_GET["id"]);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($title, $subtext, $text, $image, $video, $leerlijn);
        $stmt->fetch();
    }
}
if($stmt2 = $conn->prepare("SELECT name FROM cat WHERE id = ?")) {
    $stmt2->bind_param("s", $leerlijn);
    $stmt2->execute();
    $stmt2->store_result();

    if ($stmt2->num_rows > 0) {
        $stmt2->bind_result($leerlijnnaam);
        $stmt2->fetch();
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require("components/style.php"); ?>
    <!-- Script Tiny MCE -->
    <script src="https://cdn.tiny.cloud/1/swq7hpikkqwjjze9ad6mykwgy37w7e1mlvbbslqdqokoedyw/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    	//this is for the tiny mce configuration for both textarea's 
        tinymce.init({
            selector: '#subtext',
            height: '200',
            plugins: ['wordcount help'],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic ' +
                '| link unlink | bullist numlist outdent indent | ' +
                'removeformat'  + '| help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>
    <script>
        tinymce.init({
            selector: '#text',
            height: '480',
            file_picker_types: 'image',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic forecolor backcolor | alignleft aligncenter ' +
                'alignright alignjustify | link unlink | bullist numlist outdent indent | ' +
                'removeformat | help',
            file_picker_types: 'image',
            /* enable title field in the Image dialog*/
              image_title: true,
              /* enable automatic uploads of images represented by blob or data URIs*/
              automatic_uploads: true,
              /*
                URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
                images_upload_url: 'postAcceptor.php',
                here we add custom filepicker only to Image dialog
              */
              file_picker_types: 'image',
              /* and here's our custom image picker*/
              file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                /*
                  Note: In modern browsers input[type="file"] is functional without
                  even adding it to the DOM, but that might not be the case in some older
                  or quirky browsers like IE, so you might want to add it to the DOM
                  just in case, and visually hide it. And do not forget do remove it
                  once you do not need it anymore.
                */

                input.onchange = function () {
                  var file = this.files[0];

                  var reader = new FileReader();
                  reader.onload = function () {
                    /*
                      Note: Now we need to register the blob in TinyMCEs image blob
                      registry. In the next release this part hopefully won't be
                      necessary, as we are looking to handle it internally.
                    */
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    /* call the callback and populate the Title field with the file name */
                    cb(blobInfo.blobUri(), { title: file.name });
                  };
                  reader.readAsDataURL(file);
                };

                input.click();
              },
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>
    

    <title><?php echo $open; ?> - Verander lesstof</title>
</head>

<body>
<?php require("components/navbar.php"); ?>
    <div class="container mt-2">
        <form method="POST" enctype="multipart/form-data" action="../php/changepost.php?id=<?php echo $_GET['id']; ?>">
            <input type="hidden" style="visibility: hidden;" name="token" value="<?php echo $token;?>">
            <div class="form-group">
                <label for="titel">Titel</label>
                <input name="title" id="titel" class="form-control" placeholder="Titel" type="text" value="<?php echo $title;?>" required>
            </div>
            <div class="form-group">
                <label for="video">Video</label>
                <input name="video" id="video" class="form-control" placeholder="video" type="text" value="https://www.youtube.com/watch?v=<?php echo $video;?>" required>
            </div>
            <div class="form-group">
                <label for="subtext">Sub Tekst</label>
                <textarea name="subtext" id="subtext"><?php echo $subtext;?></textarea required>
            </div>
            <div class="form-group">
                <label for="text">Tekst</label>
                <textarea name="text" id="text"><?php echo $text;?></textarea required>
            </div>
            <div class="form-group">
                <label for="Huidige_Afbeelding">Huidige Achtergrond Foto</label><br>
                <input hidden="1" readonly="1" name="Huidige_Afbeelding" value="<?php echo $image;?>"><img src="../<?php echo "" . $image . "";?>" width="120" height="110">
            </div>
            <div class="form-group">
                <label for="foto">Achtergrond Foto</label>
                <input name="image" type="file">
            </div>
            <div class="form-group">
                <label for="leerlijn">Leerlijn</label>
                <select required name="leer">
                <?php
                echo "<option selected value'". $leerlijn ."' >". $leerlijnnaam ."</option>";
                //Hier loopen we door alle leerlijnen die dan vervolgens worden laten zien
                foreach ($result as $item) {
                    echo "<option value='".$item['id']."'>". $item['name'] ."</option>";
                }
                ?>
                </select>
            </div>
            <div class="form-group">
            <label for="uit">Uitgelicht</label>
            <div class="form-check">
                <input class="form-check-input" checked type="radio" value="0" name="uit" id="nee">
                <label class="form-check-label" for="nee">
                Nee
                </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" value="1" name="uit" id="ja">
            <label class="form-check-label" for="ja">
            Ja
            </label>
            </div>
        </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-dark">
            </div>
            <?php
                if (isset($_GET['error=mysql'])) {
                    echo "<span style='color: rgb(0,185,255);'>The post wasn't send correctly.</span>";
                }
                if (isset($_GET['error=fields'])) {
                    echo "<span style='color: rgb(0,185,255);'>The post wasn't send correctly.</span>";
                }
                ?>
        </form>
    </div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php require("components/scripts.php"); ?>
</body>
</html>