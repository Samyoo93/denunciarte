<?php
    $url = $_POST['file'];
    echo "<div id='openReport' class='modalDialog'>
            <div id='in' style='width:200px; height:500px;'>
                <object src='../UploadedImgs/" . $url . "'>
                <embed class='img' src='../UploadedImgs/" . $url . "'>
                </embed>
                </object>
            </div>
        </div>";
        //sirve con las 4 lineas de object y embed
?>
