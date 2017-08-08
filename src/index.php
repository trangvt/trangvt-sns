<!DOCTYPE html>
<html>
<head>
<title>Upload photos</title>
</head>
<body>

<div>    
    <p>Upload multiple photos</p>
    <form action="photos.php" method="POST" multipart="" enctype="multipart/form-data">
        <div style="display: none">
            <div>
                <h4>Facebook</h4>
                API Version: <input type="text" name="fb_api_version" placeholder="Your API Version">
                </br>
                App ID: <input type="text" name="fb_app_id" placeholder="Your App ID">
                </br>
                App Secret: <input type="text" name="fb_app_secret" placeholder="App SecretD">
                </br>
            </div>
            <div>
                <h4>Twitter</h4>
            </div>
            <div>
                <h4>Instagram</h4>
            </div>
            </br>
        </div>
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
