<?php
session_start();
require('../php/database.php');
if (!isset($_SESSION["loggedin"])) {
    header("Location: ../index.php");
    exit();
}
$token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] =  $token;
$sql = "SELECT id, name FROM cat;";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require("components/style.php"); ?>
    <!-- Script Tiny CME -->
    <script src="https://cdn.tiny.cloud/1/swq7hpikkqwjjze9ad6mykwgy37w7e1mlvbbslqdqokoedyw/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#subtext',
            height: '200',
            plugins: ['wordcount help'],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic ' +
                '| link unlink | bullist numlist outdent indent | ' +
                'removeformat' + '| help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>
    <script>
        tinymce.init({
            selector: '#text',
            height: '480',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic forecolor backcolor | alignleft aligncenter ' +
                'alignright alignjustify | link unlink | bullist numlist outdent indent | ' +
                'removeformat | help',
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
    

    <title><?php echo $open; ?>- Maak post</title>
</head>

<body>
<?php require("components/navbar.php"); ?>
<!-- Hier hebben we het formulier gemaakt voor het toevoegen van een post -->
<!-- Bij addpost staat de query voor het toevoegen dat we bij action hebben gezet. -->
    <div class="container mt-2">
        <form method="POST" enctype="multipart/form-data" action="../php/addpost.php">
            <input type="hidden" style="visibility: hidden;" name="token" value="<?php echo $token;?>">
            <div class="form-group">
                <label for="titel">Titel</label>
                <input name="title" id="titel" class="form-control" placeholder="Titel" type="text" required>
            </div>
            <div class="form-group">
                <label for="video">Video (Youtube Link)</label>
                <input name="video" id="video" class="form-control" placeholder="https://youtube.com/watch?v=swWJjuBDKDg" type="text" required>
            </div>
            <div class="form-group">
                <label for="subtext">Sub Tekst</label>
                <textarea name="subtext" id="subtext"></textarea required>
            </div>
            <div class="form-group">
                <label for="text">Tekst</label>
                <textarea name="text" id="text"></textarea required>
            </div>
            <div class="form-group">
                <label for="foto">Achtergrond Foto</label>
                <input name="image" type="file" required>
            </div>
            <div class="form-group">
                <label for="leerlijn">Leerlijn</label>
                <select required name="leer">
                <option selected disabled>-- selecteer leerlijn --</option>
                <?php
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
                <input class="form-check-input" checked type="radio" name="uit" value="0" id="nee">
                <label class="form-check-label" for="nee">
                Nee
                </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="uit" value="1" id="ja">
            <label class="form-check-label" for="ja">
            Ja
            </label>
            </div>
        </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-dark">
            </div>
            <?php
            //Wanneer de post niet goed is uitgevoerd krijg je een error
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