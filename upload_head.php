<!-- <!DOCTYPE html>
<html>

<head>
	<title>Image Upload</title>
</head>

<body>
	<h1>Upload an Image</h1>
	<form action="upload.php" method="POST" enctype="multipart/form-data">
		<label>book_name</label>
		<input type="file" name="image-file">
		<button type="submit" name="upload">Upload</button>
	</form>

	<h1>Uploaded Image</h1>
        <img src="image.php" alt="Uploaded Image">

</body>

</html> -->

<head>
	<link rel="stylesheet" href="css/credentials.css">
</head>

<form action="upload.php" method="POST" enctype="multipart/form-data" autocomplete="on">
	<div class="form form-signup">
		<div class="title">Upload stock details</div>
		<div class="subtitle">Down below</div>
		<div class="input-container ic1">
			<input name="idbook" id="book" class="input" type="text" placeholder=" " />
			<div class="cut cut-short"></div>
			<label for="book" class="placeholder">Book name</label>
		</div>
		<div class="input-container ic2">
			<input name="idauthor" id="author" class="input" type="text" placeholder=" " />
			<div class="cut"></div>
			<label for="author" class="placeholder">author</label>
		</div>
		<div class="input-container ic2">
			<input name="idpub" id="publiser" class="input" type="text" placeholder=" " />
			<div class="cut"></div>
			<label for="publiser" class="placeholder">publiser</label>
		</div>
		<div class="input-container ic2">
			<input name="iddop" id="dop" class="input" type="date" placeholder=" " />
			<div class="cut"></div>
			<label for="dop" class="placeholder">Date of publish</label>
		</div>
		<div class="input-container ic2">
			<input name="idcategory" id="category" class="input" type="text" placeholder=" " />
			<div class="cut"></div>
			<label for="category" class="placeholder">category</label>
		</div>
		<div class="input-container ic2">
			<input name="idabout" id="about" class="input" type="text" placeholder=" " />
			<div class="cut"></div>
			<label for="about" class="placeholder">about author</label>
		</div>
		<div class="input-container ic2">
			<input name="iddescription" id="description" class="input" type="text" placeholder=" " />
			<div class="cut"></div>
			<label for="description" class="placeholder">description</label>
		</div>
		<div class="input-container ic2">
			<input name="idprice" id="price" class="input" type="number" placeholder=" " />
			<div class="cut"></div>
			<label for="price" class="placeholder">price</label>
		</div>
		<div class="input-container ic2">
			<input name="idlang" id="lang" class="input" type="text" placeholder=" " />
			<div class="cut"></div>
			<label for="lang" class="placeholder">language</label>
		</div>
		<div class="input-container ic2">
			<input name="idtype" id="type" class="input" type="text" placeholder=" " />
			<div class="cut"></div>
			<label for="type" class="placeholder">type</label>
		</div>
		<div class="input-container ic2">
			<input name="idavailable" id="available" class="input" type="number" placeholder=" " />
			<div class="cut"></div>
			<label for="available" class="placeholder">available</label>
		</div>
		<div class="input-container ic2">
			<input name="image-file" id="image" class="input" type="file" placeholder=" " />
			<div class="cut"></div>
			<label for="image" class="placeholder">image</label>
		</div>
		<div class="input-container ic2">
			<input name="idsuggest" id="suggest" class="input" type="number" min="0" max="1" placeholder=" " />
			<div class="cut"></div>
			<label for="suggest" class="placeholder">suggestion catalog</label>
		</div>
		<button type="submit" name="upload" class="submit">Upload</button>
	</div>
</form>