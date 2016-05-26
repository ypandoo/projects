<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>Upload Form</title>
</head>
<body>


<?php echo form_open_multipart('Pic/updateImage');?>
<form>
<input type="file" name="file" size="20" enctype="multipart/form-data" />
<br /><br />
<input type="text" name="projectId" size="20"/>
<br /><br />

<input type="text" name="FID" size="20"/>
<br /><br />


<input type="submit" value="upload" />

</form>

</body>
</html>

