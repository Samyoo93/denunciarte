<html>
    <head>
    <script>
    function agregarReporte(){
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file
        var url = "uploader.php";
        var descripcion = document.getElementById("descripcion").value;
        var imgfile = document.getElementById("imgfile").value;

        var vars = 'descripcion='+descripcion+'&imgfile='+imgfile;
        hr.open("POST", url, true);
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
            if(hr.readyState == 4 && hr.status == 200) {
                var return_data = hr.responseText;
                document.getElementById("uploading").innerHTML = return_data;
            }
        }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
        document.getElementById("uploading").innerHTML = "procesando...";
	}
    </script>
    </head>

    <body>
        <div id='uploading'>
        </div>

           <!-- <input type="file" id='imgfile' name="imgfile"><br>

            <input type="text" id="descripcion" placeholder="descripcion">
          <!--  <button type='submit' onClick='agregarReporte()' value='Agregar'>Add</button>
           <input type='submit' value='a> -->

            <form method="post" action='uploader.php' enctype="multipart/form-data">
                File name:<input type="file" id='imgfile' name="imgfile"><br>
                <input type="submit" name="submit" value="upload">
            </form>
    </body>
</html>












