<?php
require_once 'Uploads.php';

if (isset($_POST['kirim']))
{
	$upload = new uploads($_FILES['berkas'], "hasil/", "all", "off");
	echo "<pre>";
	print_r( $upload->single());
	echo "</pre>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Upload File</title>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
	<p>
		<label>Pilih File:</label>
		<input type="file" name="berkas">
	</p>
	<p>
		<input type="submit" name="kirim" value="Kirim">
	</p>
</form>
	
</body>
</html>
