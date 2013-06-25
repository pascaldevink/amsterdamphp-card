<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<style type="text/css">
		body {
			padding-top: 40px;
			padding-bottom: 40px;
			background-color: #f5f5f5;
		}

		.copy {
			max-width: 500px;
			padding: 19px 29px 29px;
			margin: 0 auto 20px;
			background-color: #fff;
			border: 1px solid #e5e5e5;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
			-moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
			box-shadow: 0 1px 2px rgba(0,0,0,.05);
		}

		.intro {
		}

		.howto {
			margin-top: 20px;
		}

		.form-message {
			max-width: 300px;
			padding: 19px 29px 29px;
			margin: 0 auto 20px;
			background-color: #fff;
			border: 1px solid #e5e5e5;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
			-moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
			box-shadow: 0 1px 2px rgba(0,0,0,.05);
		}
	</style>
</head>
<body>

<div class="container">

<?php
if ($_POST)
{
	$unsafeName = $_POST['name'];
	$unsafeName = str_replace(' ', '-', $unsafeName);
	$unsafeName = strtolower($unsafeName);

	$uploadDir = dirname(__FILE__) . '/uploads';
	$realBase = realpath($uploadDir);

	$uploadFile = $uploadDir . '/' . $unsafeName . '_' . basename($_FILES['photo']['name']);
	$realUploadPath = realpath(dirname($uploadFile));

	if ($realUploadPath === false || strcmp($realUploadPath, $realBase) !== 0 || strpos($realBase . DIRECTORY_SEPARATOR, $realUploadPath) !== 0)
	{
		echo 'Bad name';
		exit();
	}

	if ( ! move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile))
	{
		echo 'Bad file';
		exit();
	}
}
?>

<?php if (!$_POST):?>
	<div class="copy">
		<div class="intro">
			You might have heard about what happened to Tiscilla, Rafael Dohms' wife (if not, talk to johnydoe on IRC).
			We, as AmsterdamPHP, wanted to let them know we think about them and support them through these difficult times.<br>
			One of the things we want to do is sent them a nice, big, personalized card, with a little message from each member.<br>
			Of course, it's hard to get everybody to write a message on the card in person, and we know PHP, so we thought up
			this little form.
		</div>

		<div class="howto">
			Here's how you can add your own little message:
			<ol>
				<li>Write down your message on a piece of paper (preferably white, blank)</li>
				<li>Make a photo of it (with your phone or camera)</li>
				<li>Upload it here, with your name, so we can add it to the card</li>
			</ol>
		</div>
	</div>

	<form class="form-message" action="index.php" method="post" enctype="multipart/form-data">
		<input type="text" class="input-block-level" name="name" placeholder="Your name">
		<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
		<input type="file" class="input-block-level" name="photo">
		<button class="btn btn-large btn-primary" type="submit">Upload</button>
	</form>
<?php else: ?>
	<div class="copy">
		<div class="intro">
			Thank you very much! We know Tiscilla and Rafael will appreciate your support!
		</div>
	</div>
<?php endif; ?>

</div>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>

