<?php
    include("common.php");
    include("functions.php");
    $auth = array(
        'username' => strtolower($_POST['txtUsername']),
        'credential' => strtolower($_POST['txtSharephrase']),
    );
    $error_message = null;
    if ($_FILES['frmImage']) {
        $newImageItem = upload_share_file($auth['username'], $auth['credential'], $_FILES['frmImage'], 'gracefuldeath_later');
        if ($newImageItem) {
            $imageThumb = make_url_from_contentid($newImageItem->guid, $auth['username'], "ithumb");
            $imagePreview = make_url_from_contentid($newImageItem->guid, $auth['username'], "i");
            $imageDownload = make_url_from_contentid($newImageItem->guid, $auth['username'], "download");
        }
    }
?>

<html>
<head>
    <title>webOS Share</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="style.css">
    <?php include("web-meta.php") ?>
</head>
<body class="login">
<div class="login-header"><a href="index.php">Cancel</a>&nbsp;</div>
<table width="100%" height="95%" border="0" id="tableLayout">
    <tr>
        <td width="100%" height="100%" border="0" id="tdLayout" align="center">
        <?php
        if ((isset($imagePreview) && isset($imageDownload)) || isset($error_message)) {
        ?>
            <table class="tableBorder">
                <tr>
                    <td>
                        <table width="100%" height="100%" bgcolor="white" border="0" class="tableOption">
                            <tr>
                                <td colspan="3" align="center">
                                    <p>      
                                    <?php
                                    if (isset($error_message)) {
                                        echo "<span style='color:red;'>Error: " . $error_message . "</span>";
                                    }
                                    else {
                                        echo "<a href='" . $imageDownload . "'>";
                                        echo "<img src='" . $imageThumb . "' style='height: 64px; margin-top:8px; vertical-align:middle;'>";  
                                        echo "</a>";
                                        $imagePreview = str_replace("i.php", "image.php", $imagePreview);
                                    
                                        echo "&nbsp;<b>Image Shared!</b></p>";
                                        echo "<table style='margin: 18px;font-size: smaller;'>";
                                        echo "<tr>";
                                        echo "<td>Public View Link:</td><td> <span class='shareLinks'><a href='" . $imagePreview . "' target='_blank'>" . $imagePreview . "</a></span></tr>";
                                        echo "</tr><tr>";
                                        echo "<td>Public Download Link:</td><td> <span class='shareLinks'><a href='" . $imageDownload . "'>" . $imageDownload . "</a></span></td>";
                                        echo "</tr>";
                                        echo "</table>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        <?php
        }
        ?>
            <table class="tableBorder">
                <tr>
                    <td>
                        <table width="100%" height="100%" bgcolor="white" border="0" class="tableOption">
                            <tr>
                                <td colspan="3" align="center">
                                    <p><img src="images/share-image.png" style="height: 64px; width: 64px; margin-top:8px; vertical-align:middle;" id="imgIcon"/>
                                    &nbsp;<b>Share an Image</b></p>
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="pageExplainer">
                                        Enter the info for the person or service you want to share with, then pick an image to share with them...<br>
                                        </div>
                                        <table style="margin: 18px;">
                                            <tr><td>User Name: </td><td><input type="text" name="txtUsername" id="txtUsername" value="<?php echo $_POST['txtUsername']?>"></td></tr>
                                            <tr><td>Share Phrase:  </td><td><input type="text" id="txtSharephrase" name="txtSharephrase" value="<?php echo $_POST['txtSharephrase']?>"></td></tr>
                                            <tr><td>Photo: </td><td><input type="file" name="frmImage" accept="image/gif, image/jpeg, image/png" /></td></tr>
                                        </table>
                                        <input type="submit" value="Share">
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html> 