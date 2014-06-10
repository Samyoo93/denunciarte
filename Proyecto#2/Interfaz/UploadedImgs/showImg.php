<?php
    $url = $_POST['evidencia'];
    echo "<div>
        <object src='../UploadedImgs/" . $url . "'>
        <embed class='img' src='../UploadedImgs/" . $url . "'>
        </embed>    
        </object>
        </div>";
?>
