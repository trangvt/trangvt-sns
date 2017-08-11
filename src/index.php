<!DOCTYPE html>
<html>
<head>
<title>Upload photos</title>
</head>
<body>

<div>    
    <p>Upload multiple photos</p>
    <form action="photos.php" method="POST" multipart="" enctype="multipart/form-data">
        <input type="text" name="caption" placeholder="Your caption">
        </br>
        </br>
        <input type="file" name="imgs[]" multiple>
        </br>
        </br>
        <input type="submit" value="Upload">
    </form>
</div>

</body>
</html>
