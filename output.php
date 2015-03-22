<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="Jeremy Baker">
		<meta name="author" content="Josh Hammock">
		<title>Ciphers</title>

		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
		<link href="css/crypto.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Rosario|Open+Sans' rel='stylesheet' type='text/css'>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	</head>
	<body>
		<h1 id="title">Swiss Army Cipher Tool</h1>

		<form action="output.php" method="post">
			<div class="row" id="mainBody">
				<div class="col-md-4 box">
					<div id="cipherTypes">
						<label class="selectLabel">Select Cipher Type:</label>
						<div class="col-xs-12 noMarPad">
							<div class="col-sm-6 radio noMarPad">
								<label class="radio"><input type="radio" name="cipherOption" value="0" checked>Caesar</label>
								<label class="radio"><input type="radio" name="cipherOption" value="1">Substitution</label>
								<!-- <label class="radio"><input type="radio" name="cipherOption" value="2">Additive</label> -->
								<label class="radio"><input type="radio" name="cipherOption" value="3">Multiplicative</label>
								<label class="radio"><input type="radio" name="cipherOption" value="4">Affine</label>
							</div>
							<div class="col-sm-6 radio">
								<label class="radio"><input type="radio" name="cipherOption" value="5">Viginere</label>
								<label class="radio"><input type="radio" name="cipherOption" value="6">Playfair</label>
								<label class="radio"><input type="radio" name="cipherOption" value="7">Homophone</label>
								<label class="radio"><input type="radio" name="cipherOption" value="8">Standard DES</label>
							</div>
						</div>
						<br>

						<label class="selectLabel">Select Operation:</label>
						<div class="radio">
							<label class="radio"><input type="radio" name="encdecOption" value="enc" checked>Encrypt</label>
							<label class="radio"><input type="radio" name="encdecOption" value="dec">Decrypt</label>
							<label class="radio"><input type="radio" name="encdecOption" value="crk" disabled>Crack</label>
						</div>

						<div class="form-group">
							<div id="caesarOpt">
								<label for="" class="selectLabel">Enter Shift Value:</label>
								<input type="text" class="form-control" name="keyCaesar" placeholder="(-inf,inf) mod 26">
							</div>

							<div id="subOpt">
								<label for="" class="selectLabel">Enter Key:</label>
								<input type="text" class="form-control" id="" placeholder="abcdefghijklmonpqrstuvwxyz">
							</div>

							<div id="multOpt">
								<label for="" class="selectLabel">Enter Multiplicative Value:</label>
								<input type="text" class="form-control" id="" placeholder="[0,inf) mod 26">
							</div>

							<div id="affineOpt">
								<label for="" class="selectLabel">Enter Additive Value:</label>
								<input type="text" class="form-control" id="" placeholder="(-inf,inf) mod 26">
								<label for="" class="selectLabel">Enter Multiplicative Value:</label>
								<input type="text" class="form-control" id="" placeholder="[0,inf) mod 26">
							</div>

							<div id="viginereOpt">
								<label for="" class="selectLabel">Enter Key:</label>
								<input type="text" class="form-control" id="" placeholder="Key">
							</div>
						</div>

						<div class="hidden-xs hidden-sm">
							<br>
							<button class="btn btn-success btn-block" type="submit" id="execute">Execute</button>
							<br>
							<button class="btn btn-danger btn-block">Help</button>
							<br>
						</div>
					</div>
				</div>
				<div class="col-md-4 box">
					<?php						
						//default values
						$cipherType = 0;			//the encryption type chosen by the user
						$operationType = 'enc';		//the operation performed on the plaintext
						$inputText = "";			//string of the user's input text
						$outputText = "";			//string of the computed output text
						$inputLength = 0;			//number of characters in the input field


						//echo "a=".ord('a')." and z=".ord('z')." and A=".ord('A')." and Z=".ord('Z');
						//echo "<br>Testing: chr(91)=".chr(91);


						//set the user-selected cipher type
						if(isset($_POST['cipherOption'])) {
							$cipherType = $_POST['cipherOption'];
						}

						//set the user-selected cipher operation
						if(isset($_POST['inputText'])) {
							$inputText = $_POST['inputText'];
						}
						$inputLength = strlen($inputText);

						//set whether this file encrypts, decrypts, or cracks the input
						if(isset($_POST['encdecOption'])) {
							$operationType = $_POST['encdecOption'];
						}

						//draw the Input textarea with the user-given input
						echo "<textarea class=\"form-control\" name=\"inputText\" required rows=\"8\" cols=\"40\" placeholder=\"Input\">".$inputText."</textarea></div><div class=\"col-md-4\">";

						//parse the input variables
						switch($cipherType) {
							case(0): //CAESAR CIPHER
								if($operationType=="enc") {
									$shiftValue = 0;
									if(isset($_POST['keyCaesar'])) {
										$shiftValue = $_POST['keyCaesar'] % 26;
									}

									for($i=0; $i<$inputLength; $i++) {
										if((ord($inputText[$i])>=65 && ord($inputText[$i])<=90) || (ord($inputText[$i])>=97 && ord($inputText[$i])<=122)) {
											$outputText[$i] = chr(ord($inputText[$i])+$shiftValue);
										}
										else {
											$outputText[$i] = $inputText[$i];
										}
									}
								}
								else if($operationType=="dec") {
									$shiftValue = 0;
									if(isset($_POST['keyCaesar'])) {
										$shiftValue = $_POST['keyCaesar'] % 26;
									}

									for($i=0; $i<$inputLength; $i++) {
										if((ord($inputText[$i])>=65 && ord($inputText[$i])<=90) || (ord($inputText[$i])>=97 && ord($inputText[$i])<=122)) {
											$outputText[$i] = chr(ord($inputText[$i])-$shiftValue);
										}
										else {
											$outputText[$i] = $inputText[$i];
										}
									}
								}
								else {
									//crack Caesar
								}

								break;
							case(1):

								break;
							case(2):
								//ADDITIVE CIPHER - UNUSED
								break;
							case(3):

								break;
							case(4):

								break;
							case(5):

								break;
							case(6):

								break;
							case(7):

								break;
							case(8):

								break;
						}

						echo "<textarea class=\"form-control\" name=\"outputText\" rows=\"8\" cols=\"40\" placeholder=\"Output\">".implode("",$outputText)."</textarea>";
					?>
					<!-- <textarea class="form-control" name="inputText" required rows="8" cols="40" placeholder="Input"></textarea></div><div class="col-md-4">
					<textarea class="form-control" name="outputText" rows="8" cols="40" placeholder="Output"></textarea> -->
					

					<div class="hidden-md hidden-lg">
						<br>
						<button class="btn btn-success btn-block" type="submit" id="execute">Execute</button>
						<br>
						<button class="btn btn-danger btn-block">Help</button>
						<br>
					</div>
				</div>
			</div>
		</form>

		<br><br>
	</body>
</html>