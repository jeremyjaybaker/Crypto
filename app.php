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
		<title>Swiss Army Cipher Tool</title>

		<link rel="icon" type="image/png" href="favicon.png">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
		<link href="css/crypto.css" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<!-- Test string: abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ -->



	<!--==========================================================-->
	<!--                      NOTES AND BUGS                      -->
	<!--==========================================================-->
	<!--
	* our code has trouble handling single-character input?
	* formatting issues are occuring on the right hand side of the page, especially on smaller screen sized
	* fix the margin problems that the Autokey radio is having
	* right now, mobile version does not have the histogram. add it in!
	* the Default case for the cipherType switch statement does not have an error statement
	-->



	</head>
	<body>
		<h1 id="title">Swiss Army Cipher Tool</h1>
		<h2 id="subtitle">
			By <a href="mailto:ironclad00@gmail.com?Subject='Swiss%20Army%20Cipher%20Tool'" target='_blank'>Jeremy Baker</a>
			 and <a href="mailto:joshammock@gmail.com?Subject='Swiss%20Army%20Cipher%20Tool'" target='_blank'>Josh Hammock</a>
		</h2>

		<form action="app.php" method="post" novalidate>
			<div class="row" id="mainBody">
				<div class="col-md-4 box">
					<b>Options and Help:</b>
					<div id="helpOptionsBox">
						<br>
						<div role="tabpanel">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#" id='optionsTab'>Options</a></li>
								<li role="presentation"><a href="#" id='helpTab'>Help</a></li>
							</ul>
						</div>

						<div id="helpTabContent">
							<br>
							<!--==========================================================-->
							<!--                        General Help                      -->
							<!--==========================================================-->
							<a class="btn btn-sm btn-primary btn-block helperToggle" id="generalHelp">Show General Help</a>
							<div id="generalHelpContent" class="helpBox">
								<p>This web app is intended to be used as a pedagogical tool for students studying cryptology.</p>
								
								<b>How to use this site:</b>
									<nl>In the Options column:</nl>
									<nl>&nbsp;&#9658; select your desired cipher type</nl>
									<nl>&nbsp;&#9658; select whether you want to encrypt or decrypt</nl>
									<p>&nbsp;&#9658; fill out the remaining options such as keyword or shift value</p>
									<nl>In the Input column:</nl>
									<p>&nbsp;&#9658; type or paste the text you want to encrypt or decrypt in the text boxes</p>
									<nl>Finally, hit the green Execute button and the results of the operation will be displayed under the Input and Output text boxes.</nl>
								
								<br><b>Misc notes about this site's algorithms:</b>
									<nl>&nbsp;&#9658; In general, cryptographic operations will only be performed on ASCII letters (codes ranging from [65-90] and [97-122]) and all other characters will either be removed from the output or remain unchanged.</nl>
									<nl>&nbsp;&#9658; Some algorithms completely remove any letter that is not a part of the standard alphabet (or in the case of homophonic, the user-specified alphabet) so that encryption and decryption are easier to perform.</nl>
									<p>&nbsp;&#9658; The input text area will except any ASCII character strings EXCEPT when using S-DES. When using S-DES, the input field will only accept binary in ASCII string form.</p>
							</div>
							<!--==========================================================-->
							<!--                       Additive Help                      -->
							<!--==========================================================-->
							<a class="btn btn-sm btn-primary btn-block helperToggle" id="additiveHelp">Show Additive Cipher Info</a>
							<div id="additiveHelpContent" class="helpBox">
								<b>Cipher Definition:</b>
									<nl>An additive cipher simply "shifts" each plaintext character according to the given key. Each letter is represented by it's location in the alphabet starting at zero, so a=0, b=1,..., z=25.</nl>
									<p>For example, the character 'a' shifted using a value of 2 is 'c'.</p>

								<b>Cipher Implementation Notes:</b>
									<nl>&nbsp;&#9658; The key should be a positive integer greater than or equal to zero.</nl>
									<p>&nbsp;&#9658; The algorithm only modifies ASCII letters. Non-letter ASCII characters, including spaces, are preserved in the output.</p>
								
								<b>Formulas:</b>
									<nl>C<sub>i</sub> = (p<sub>i</sub> + k) % a</nl>
									<nl>p<sub>i</sub> = (C<sub>i</sub> - k) % a</nl>
									<nl>Given:
									<nl>&nbsp;&#9658; a = alphabet size (standard is 26)</nl>
									<nl>&nbsp;&#9658; k = shift value (key)</nl>
									<nl>&nbsp;&#9658; C<sub>i</sub> = the ith ciphertext letter</nl>
									<p>&nbsp;&#9658; p<sub>i</sub> = the ith plaintext letter</p>
							</div>
							<!--==========================================================-->
							<!--                    Substitution Help                     -->
							<!--==========================================================-->
							<a class="btn btn-sm btn-primary btn-block helperToggle" id="substitutionHelp">Show Substitution Cipher Info</a>
							<div id="substitutionHelpContent" class="helpBox">
								<b>Cipher Definition:</b>
									<nl>A substitution cipher maps each plaintext letter uniquely to a single, different letter in the same alphabet.</nl>
									<p>For example, the plaintext 'test' becomes 'QYTQ' given the mappings t->Q, e->Y, and s->T.</p>

								<b>Cipher Implementation Notes:</b>
									<nl>&nbsp;&#9658; The key should be a string of 26 unique letters. The first letter in the string represents the mapping for a, the second, the mapping for b, and so on.</nl>
									<p>&nbsp;&#9658; The algorithm only modifies ASCII letters. Non-letter ASCII characters, including spaces, are preserved in the output.</p>
								
								<b>Formulas:</b>
									<nl>Formulas are not used for this cipher, but rather tables:</nl>
									<table>
										<tr>
											<td>a</td>
											<td>b</td>
											<td>c</td>
											<td>d</td>
											<td>e</td>
											<td>f</td>
											<td>g</td>
											<td>h</td>
											<td>i</td>
											<td>j</td>
											<td>k</td>
											<td>l</td>
											<td>m</td>
										</tr>
										<tr>
											<td>k<sub>0</sub></td>
											<td>k<sub>1</sub></td>
											<td>k<sub>2</sub></td>
											<td>k<sub>3</sub></td>
											<td>k<sub>4</sub></td>
											<td>k<sub>5</sub></td>
											<td>k<sub>6</sub></td>
											<td>k<sub>7</sub></td>
											<td>k<sub>8</sub></td>
											<td>k<sub>9</sub></td>
											<td>k<sub>10</sub></td>
											<td>k<sub>11</sub></td>
											<td>k<sub>12</sub></td>
										</tr>
									</table>
									<table>
										<tr>
											<td>n</td>
											<td>o</td>
											<td>p</td>
											<td>q</td>
											<td>r</td>
											<td>s</td>
											<td>t</td>
											<td>u</td>
											<td>v</td>
											<td>w</td>
											<td>x</td>
											<td>y</td>
											<td>z</td>
										</tr>
										<tr>
											<td>k<sub>13</sub></td>
											<td>k<sub>14</sub></td>
											<td>k<sub>15</sub></td>
											<td>k<sub>16</sub></td>
											<td>k<sub>17</sub></td>
											<td>k<sub>18</sub></td>
											<td>k<sub>19</sub></td>
											<td>k<sub>20</sub></td>
											<td>k<sub>21</sub></td>
											<td>k<sub>22</sub></td>
											<td>k<sub>23</sub></td>
											<td>k<sub>24</sub></td>
											<td>k<sub>25</sub></td>
										</tr>
									</table>
							</div>
							<!--==========================================================-->
							<!--                   Multiplicative Help                    -->
							<!--==========================================================-->
							<a class="btn btn-sm btn-primary btn-block helperToggle" id="multiplicativeHelp">Show Multiplicative Cipher Info</a>
							<div id="multiplicativeHelpContent" class="helpBox">
								<b>Cipher Definition:</b>
									<nl>A multiplicative cipher "multiplies" each plaintext character according to the given key. Each letter is represented by it's location in the alphabet starting at zero, so a=0, b=1,..., z=25.</nl>
									<nl>For example, the character 'd' multiplied using a value of 2 is 'g'.</nl>
									<p>If the given key is not relatively prime to the alphabet size, then character mappings will NOT be unique and decryption will more than likely be illegible. This can be seen more easily by applying the formula given below.</p>

								<b>Cipher Implementation Notes:</b>
									<nl>&nbsp;&#9658; The key should be a positive integer greater than but NOT equal to zero.</nl>
									<p>&nbsp;&#9658; The algorithm only modifies ASCII letters. Non-letter ASCII characters, including spaces, are preserved in the output.</p>
								
								<b>Formula:</b>
									<nl>Plaintext characters are usually recovered with a character mapping instead of a formula due to the fact that information is lost when the modulus operation is used. In other words, simple division will not allow recovery of the original plaintext. However, ciphertext can be generated using: </nl>
									<nl>C<sub>i</sub> = (p<sub>i</sub> * k) % a</nl>
									<nl>Given:
									<nl>&nbsp;&#9658; a = alphabet size (standard is 26)</nl>
									<nl>&nbsp;&#9658; k = shift value (key)</nl>
									<nl>&nbsp;&#9658; C<sub>i</sub> = the ith ciphertext letter</nl>
							</div>
							<!--==========================================================-->
							<!--                       Affine Help                        -->
							<!--==========================================================-->
							<a class="btn btn-sm btn-primary btn-block helperToggle" id="affineHelp">Show Affine Cipher Info</a>
							<div id="affineHelpContent" class="helpBox">
								<b>Cipher Definition:</b>
									<nl>The affine cipher is a combination of the additive and multiplicative cipher types. There are two keys, one that shifts and one that multiplies.</nl>
									<p>Similarly with multiplicative ciphers, if the given key is not relatively prime to the alphabet size, then character mappings will NOT be unique and decryption will more than likely be illegible. This can be seen more easily by applying the formula given below.</p>

								<b>Cipher Implementation Notes:</b>
									<nl>&nbsp;&#9658; The additive key should be a positive integer greater than or equal to zero.</nl>
									<nl>&nbsp;&#9658; The multiplicative key should be a positive integer greater than but NOT equal to zero.</nl>
									<p>&nbsp;&#9658; The algorithm only modifies ASCII letters. Non-letter ASCII characters, including spaces, are preserved in the output.</p>
								
								<b>Formula:</b>
									<nl>Plaintext characters are usually recovered with a character mapping instead of a formula due to the fact that information is lost when the modulus operation is used in conjunction with multiplication. However, ciphertext can be generated using: </nl>
									<nl>C<sub>i</sub> = ((p<sub>i</sub> * m) + d) % a</nl>
									<nl>Given:
									<nl>&nbsp;&#9658; a = alphabet size (standard is 26)</nl>
									<nl>&nbsp;&#9658; m = multiplicative value</nl>
									<nl>&nbsp;&#9658; d = additive value</nl>
									<nl>&nbsp;&#9658; C<sub>i</sub> = the ith ciphertext letter</nl>
							</div>
							<!--==========================================================-->
							<!--                       Vigenere Help                      -->
							<!--==========================================================-->
							<a class="btn btn-sm btn-primary btn-block helperToggle" id="vigenereHelp">Show Vigenere Cipher Info</a>
							<div id="vigenereHelpContent" class="helpBox">
								<b>Cipher Definition:</b>
									<nl>The vigenere cipher uses a keyword to apply a series of different shifts based on said keyword. Since the keyword will almost always be longer than the plaintext, the keyword repeats itself until the end of the plaintext.</nl>
									<nl>Vigenere ciphers can also use what is called an autokey. When autokey is used, the plaintext is used as a key after the last letter of the keyword is exhaused instead of having the keyword simply repeat.</nl>
									<nl>Here is an example of the decryption of the word 'construction' using the keyword 'deceptive' with autokey:</nl>
									<table>
										<tr>
											<td>d</td>
											<td>e</td>
											<td>c</td>
											<td>e</td>
											<td>p</td>
											<td>t</td>
											<td>i</td>
											<td>v</td>
											<td>e</td>
											<td>c</td>
											<td>o</td>
											<td>n</td>
										</tr>
										<tr>
											<td>c</td>
											<td>o</td>
											<td>n</td>
											<td>s</td>
											<td>t</td>
											<td>r</td>
											<td>u</td>
											<td>c</td>
											<td>t</td>
											<td>i</td>
											<td>o</td>
											<td>n</td>
										</tr>
										<tr>
											<td>F</td>
											<td>S</td>
											<td>P</td>
											<td>W</td>
											<td>I</td>
											<td>K</td>
											<td>C</td>
											<td>X</td>
											<td>X</td>
											<td>K</td>
											<td>C</td>
											<td>A</td>
										</tr>
									</table><br>

								<b>Cipher Implementation Notes:</b>
									<nl>&nbsp;&#9658; The key should be string containing only ASCII letters. Case does not matter.</nl>
									<p>&nbsp;&#9658; The algorithm only modifies ASCII letters. Non-letter ASCII characters, including spaces, are REMOVED from the output.</p>
								
								<b>Formulas:</b>
									<nl>C<sub>i</sub> = (p<sub>i</sub> + k<sub>i%m</sub>) % a</nl>
									<nl>p<sub>i</sub> = (C<sub>i</sub> - k<sub>i%m</sub>) % a</nl>
									<nl>Given:
									<nl>&nbsp;&#9658; a = alphabet size (standard is 26)</nl>
									<nl>&nbsp;&#9658; k<sub>i</sub> = the ith letter of the keyword</nl>
									<nl>&nbsp;&#9658; m = the length of the keyword</nl>
									<nl>&nbsp;&#9658; p<sub>i</sub> = the ith plaintext letter</nl>
									<nl>&nbsp;&#9658; C<sub>i</sub> = the ith ciphertext letter</nl>
							</div>
							<!--==========================================================-->
							<!--                       Playfair Help                      -->
							<!--==========================================================-->
							<a class="btn btn-sm btn-primary btn-block helperToggle" id="playfairHelp">Show Playfair Cipher Info</a>
							<div id="playfairHelpContent" class="helpBox">
								<b>Cipher Definition:</b>
									<nl>The Playfair cipher operates using a 5x5 table generated by choosing a keyword, then taking the first unique letter in the keyword and populating the 5x5 table with these letters, starting left-to-right and top-to-bottom. An example of such a table using the keyword 'testable':</nl>
									<table>
										<tr>
											<td>T</td>
											<td>E</td>
											<td>S</td>
											<td>A</td>
											<td>B</td>
										</tr>
										<tr>
											<td>L</td>
											<td>C</td>
											<td>D</td>
											<td>F</td>
											<td>G</td>
										</tr>
										<tr>
											<td>H</td>
											<td>I/J</td>
											<td>K</td>
											<td>M</td>
											<td>N</td>
										</tr>
										<tr>
											<td>O</td>
											<td>P</td>
											<td>Q</td>
											<td>R</td>
											<td>U</td>
										</tr>
										<tr>
											<td>V</td>
											<td>W</td>
											<td>X</td>
											<td>Y</td>
											<td>Z</td>
										</tr>
									</table>
									<nl>Playfair ciphertext is formatted in pairs. Plaintext letters are encrypted two letters at a time using the following rules:</nl>
									<nl>1. Repeating letters that are in the same pair are separated by a filler letter, usually X.</nl>
									<nl>2. Two letters that fall in the same row are each replaced by the letter to the right of each letter. For example, ab is encrypted to BT.</nl>
									<nl>3. Two letters that fall in the same column are each replaced by the letter below each letter. For example, fr is encrypted to MY.</nl>
									<p>4. Two letters that are not in the same row nor column are replaced by the letter in the same row but column occupied by the other. For example, cr becomes FP.</p>

								<b>Cipher Implementation Notes:</b>
									<nl>&nbsp;&#9658; The key should be string containing only ASCII letters. Case does not matter.</nl>
									<p>&nbsp;&#9658; The algorithm only modifies ASCII letters. Non-letter ASCII characters, including spaces, are removed in the output.</p>
								
								<b>Formulas:</b>
									<nl>Formulas are not used for this cipher, but rather tables.</nl>
									
							</div>
							<!--==========================================================-->
							<!--                     Homophonic Help                      -->
							<!--==========================================================-->
							<a class="btn btn-sm btn-primary btn-block helperToggle" id="homophonicHelp">Show Homophonic Cipher Info</a>
							<div id="homophonicHelpContent" class="helpBox">
								<b>Cipher Definition:</b>
									<nl>A homophonic cipher is essentially an extended substitution cipher. The difference between the two is that homophonic ciphers use an extended alphabet such that a plaintext letter may map to more than one character in the extended ciphertext alphabet, but each ciphertext character maps uniquely to a plaintext character.</nl>
									<p>For example, a plaintext letter 'e' can map '1','2','0','$', and '#', and each of these characters map back to only 'a'. If a character has multiple mappings, then the specific ciphertext character will be chosen randomly from among these mappings.</p>

								<b>Cipher Implementation Notes:</b>
									<nl>&nbsp;&#9658; There are two ways to specify a key for this cipher. The first is the most complex: A scramble function has provided in order to establish a foundation for a key using the standard alphabet. The user may then fill in as many extended characters as he/she desires.</nl>
									<nl>&nbsp;&#9658; The second way to enter a key is using a single-line string. To construct this string, make a list of character mappings with each plaintext character's mapping separated by a space. For example, the string 'B C D E123 F G H I J K L M N O P Q R S T U V W X Y Z' will map a->B, b->C, c->D, d->E,1,2, or 3, and so on.</nl>
									<p>&nbsp;&#9658; The algorithm only modifies ASCII letters and letters added to the extended alphabet by the user. Any character that does not exist in this extended alphabet will be removed, excluding spaces.</p>
								
								<b>Formulas:</b>
									<nl>Formulas are not used for this cipher, but rather tables.</nl>
							</div>
							<!--==========================================================-->
							<!--                         S-DES Help                       -->
							<!--==========================================================-->
							<a class="btn btn-sm btn-primary btn-block helperToggle" id="S-DESHelp">Show S-DES Cipher Info</a>
							<div id="S-DESHelpContent" class="helpBox">
								<b>Cipher Definition:</b>
									<p>S-DES (Simplified-Data Encryption Standard) is a simplified, pedantic version of DES. DES is a complicated, multi-step encryption algorithm that manipulates binary numbers (ie, the encodings of letters) instead of the actual letters themselves. The full version of DES was developed by IBM in the early 1970s and is now considered to be insecure for many applications. A full description of the S-DES protocol can be found <a target="_blank" href="http://mercury.webster.edu/aleshunas/COSC%205130/G-SS-DES.pdf">here</a>.</p>
							
								<b>Cipher Implementation Notes:</b>
									<nl>&nbsp;&#9658; This algorithm uses exclusively binary for input and output. The key should be a 10-bit binary string and the input should only contain the ASCII representations of '1' and '0'.</nl>
							</div>

							<br>

						</div>
						<div id="optionsTabContent">
							<label class="selectLabel">Select Cipher Type:</label>
							<div class="col-xs-12 noMarPad">
								<div class="col-sm-6 radio noMarPad cipherOption">
									<label class="radio"><input type="radio" name="cipherOption" class="cipherOption" id="additiveRadio" value="Additive" checked>Additive</label>
									<label class="radio"><input type="radio" name="cipherOption" class="cipherOption" id="substitutionRadio" value="Substitution">Substitution</label>
									<label class="radio"><input type="radio" name="cipherOption" class="cipherOption" id="multiplicativeRadio" value="Multiplicative">Multiplicative</label>
									<label class="radio"><input type="radio" name="cipherOption" class="cipherOption" id="affineRadio" value="Affine">Affine</label>
								</div>
								<div class="col-sm-6 radio noMarPad cipherOption">
									<label class="radio"><input type="radio" name="cipherOption" class="cipherOption" id="vigenereRadio" value="Vigenere">Vigenere</label>
									<label class="radio"><input type="radio" name="cipherOption" class="cipherOption" id="playfairRadio" value="Playfair">Playfair</label>
									<label class="radio"><input type="radio" name="cipherOption" class="cipherOption" id="homophonicRadio" value="Homophonic">Homophonic</label>
									<label class="radio"><input type="radio" name="cipherOption" class="cipherOption" id="s-desRadio" value="S-DES">S-DES</label>
								</div>
							</div><br>

							<label class="selectLabel">Select Operation:</label>
							<div class="radio">
								<label class="radio"><input type="radio" id="encryptOpt" name="encdecOption" value="enc" checked>Encrypt</label>
								<label class="radio"><input type="radio" id="decryptOpt" name="encdecOption" value="dec">Decrypt</label>
							</div>

							<!-- ====================== -->
							<!-- ALL CIPHER DATA FIELDS -->
							<!-- ====================== -->
							<div class="form-group">
								<!-- additive data fields -->
								<div class="cipherKey" id="additiveOpt">
									<label for="" class="selectLabel">Enter Shift Value:</label>
									<input type="text" class="form-control" name="keyAdditive" id='additiveField' placeholder="Positive Integer">
									<nl><i>Note: An additive cipher with a shift of 3 is a Caesar cipher.</i></nl>
								</div>

								<!-- substitution data fields -->
								<div class="cipherKey" id="substitutionOpt">
									<label for="" class="selectLabel">Enter Key:</label>
									<input type="text" class="form-control" name="keySub" id='substitutionField' placeholder="abcdefghijklmonpqrstuvwxyz">
								</div>

								<!-- multiplicative data fields -->
								<div class="cipherKey" id="multiplicativeOpt">
									<label for="" class="selectLabel">Enter Multiplicative Value:</label>
									<input type="text" class="form-control" name="keyMult" id='multiplicativeField' placeholder="Positive Integer">
								</div>

								<!-- affine data fields -->
								<div class="cipherKey" id="affineOpt">
									<label for="" class="selectLabel">Enter Additive Value:</label>
									<input type="text" class="form-control" name="keyAddAff" id='affineFieldAdd' placeholder="Positive Integer">
									<label for="" class="selectLabel">Enter Multiplicative Value:</label>
									<input type="text" class="form-control" name="keyMultAff" id='affineFieldMult' placeholder="Positive Integer">
								</div>

								<!-- vigenere data fields -->
								<div class="cipherKey" id="vigenereOpt">
									<label for="" class="selectLabel">Enter Key:</label>
									<input type="text" class="form-control" name="keyVig" id="vigenereField" placeholder="Keyword">
									<label for="" class="selectLabel">Use Autokey?</label>
									<div class="form-inline">
										<label class="radio optionLabel"><input type="radio" name="autokey" id="autokeyYes" value="true">Yes</label>
										<label class="radio optionLabel"><input type="radio" name="autokey" id="autokeyNo" value="false" checked>No</label>
									</div>
								</div>

								<!-- playfair data fields -->
								<div class="cipherKey" id="playfairOpt">
									<label for="" class="selectLabel">Enter Key:</label>
									<input type="text" class="form-control" name="keyPlay" id="playfairField" placeholder="Keyword">
								</div>

								<!-- homophonic data fields -->
								<div class="cipherKey" id="homophonicOpt">
									<label for="" class="selectLabel">Enter Alternate Alphabet:</label>
									<a class="btn btn-sm btn-primary btn-block" id="scramble">Scramble The Standard Alphabet</a>
									<br>
									<table>
										<tr>
											<td>a=</td>
											<td><input type="text" class="form-control" id="homoA" name="homoA" placeholder="a,"></td>
											<td>n=</td>
											<td><input type="text" class="form-control" id="homoN" name="homoN" placeholder="n,"></td>
										</tr>
										<tr>
											<td>b=</td>
											<td><input type="text" class="form-control" id="homoB" name="homoB" placeholder="b,"></td>
											<td>o=</td>
											<td><input type="text" class="form-control" id="homoO" name="homoO" placeholder="o,"></td>
										</tr>
										<tr>
											<td>c=</td>
											<td><input type="text" class="form-control" id="homoC" name="homoC" placeholder="c,"></td>
											<td>p=</td>
											<td><input type="text" class="form-control" id="homoP" name="homoP" placeholder="p,"></td>
										</tr>
										<tr>
											<td>d=</td>
											<td><input type="text" class="form-control" id="homoD" name="homoD" placeholder="d,"></td>
											<td>q=</td>
											<td><input type="text" class="form-control" id="homoQ" name="homoQ" placeholder="q,"></td>
										</tr>
										<tr>
											<td>e=</td>
											<td><input type="text" class="form-control" id="homoE" name="homoE" placeholder="e,"></td>
											<td>r=</td>
											<td><input type="text" class="form-control" id="homoR" name="homoR" placeholder="r,"></td>
										</tr>
										<tr>
											<td>f=</td>
											<td><input type="text" class="form-control" id="homoF" name="homoF" placeholder="f,"></td>
											<td>s=</td>
											<td><input type="text" class="form-control" id="homoS" name="homoS" placeholder="s,"></td>
										</tr>
										<tr>
											<td>g=</td>
											<td><input type="text" class="form-control" id="homoG" name="homoG" placeholder="g,"></td>
											<td>t=</td>
											<td><input type="text" class="form-control" id="homoT" name="homoT" placeholder="t,"></td>
										</tr>
										<tr>
											<td>h=</td>
											<td><input type="text" class="form-control" id="homoH" name="homoH" placeholder="h,"></td>
											<td>u=</td>
											<td><input type="text" class="form-control" id="homoU" name="homoU" placeholder="u,"></td>
										</tr>
										<tr>
											<td>i=</td>
											<td><input type="text" class="form-control" id="homoI" name="homoI" placeholder="i,"></td>
											<td>v=</td>
											<td><input type="text" class="form-control" id="homoV" name="homoV" placeholder="v,"></td>
										</tr>
										<tr>
											<td>j=</td>
											<td><input type="text" class="form-control" id="homoJ" name="homoJ" placeholder="j,"></td>
											<td>w=</td>
											<td><input type="text" class="form-control" id="homoW" name="homoW" placeholder="w,"></td>
										</tr>
										<tr>
											<td>k=</td>
											<td><input type="text" class="form-control" id="homoK" name="homoK" placeholder="k,"></td>
											<td>x=</td>
											<td><input type="text" class="form-control" id="homoX" name="homoX" placeholder="x,"></td>
										</tr>
										<tr>
											<td>l=</td>
											<td><input type="text" class="form-control" id="homoL" name="homoL" placeholder="l,"></td>
											<td>y=</td>
											<td><input type="text" class="form-control" id="homoY" name="homoY" placeholder="y,"></td>
										</tr>
										<tr>
											<td>m=</td>
											<td><input type="text" class="form-control" id="homoM" name="homoM" placeholder="m,"></td>
											<td>z=</td>
											<td><input type="text" class="form-control" id="homoZ" name="homoZ" placeholder="z,"></td>
										</tr>
									</table>
									<nl><b>OR</b> enter the key as a single-line string. The guidelines for formatting this string can be found in the "Help" tab under "Show Homophonic Cipher Info".</nl>
									<input type="text" class="form-control" name="homoString" id="homophonicField" placeholder="A B C D E F G H I J K L M N O P Q R S T U V W X Y Z">
									<br><nl><i>Note: All non-word symbols and numbers will be scrubbed from plaintext since symbols may be used as letter replacements.</i></nl>
								</div>

								<!-- S-DES data fields -->
								<div class="cipherKey" id="s-desOpt">
									<label for="" class="selectLabel">Enter Key:</label>
									<input type="text" class="form-control" name="keyS-DES" id="s-desField" placeholder="10-bit Binary">
								</div>
							</div>

							<!-- Execute button -->
							<div class="hidden-xs hidden-sm">
								<br>
								<button class="btn btn-success btn-block" type="submit" id="execute">Execute</button>
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 box">
					<?php				
						require 'helper_functions.php';

						$cipherType = 0;				//the encryption type chosen by the user
						$operationType = 'enc';			//the operation performed on the plaintext
						$inputText = "";				//string of the user's input text
						$outputText = "";				//string of the computed output text
						$inputLength = 0;				//number of characters in the input field
						$key = "";						//global variable that stores the value of the key so that it can be output when the user executes a cipher
						$lowMap = array();				//array of lowercase chars used to display character mapping for several cipher types (all substitution ciphers)
						$isAutokey = false;				//used for displaying whether the user has specified the autokey option

						//S-DES global variables for displaying steps:
						$numIterations = 0;
						$subKey1_g = "";
						$subKey2_g  = "";
						$PC10_g = "";
						$subKey1_LS1_g = "";
						$subKey1_PC8_g = "";
						$subKey2_LS2_g = "";
						$subKey2_PC8_g = "";
						$IP_g = array();
						$EP_g = array();
						$XOR1_g = array();
						$XOR1Comp_g = array();
						$sBox0_g = array();
						$sBox1_g = array();
						$P4_g = array();
						$XOR2_g = array();
						$XOR2Comp_g = array();
						$swap_g = array();
						$invIP_g = array();

						//global constants
						$defaultAlphabetLength = 26;	//number of characters in the default alphabet (ASCII letters)
						$capitalOffset = 65;			//capital letters in ASCII have values in the range [65,90]
						$lowercaseOffset = 97;			//lowercase letters in ASCII have values in the range [97,122]


						//set the user-selected cipher type
						if(isset($_POST['cipherOption'])) {
							$cipherType = $_POST['cipherOption'];
						}
						//TO-DO: does a default need to be set??


						//set the user-selected cipher operation
						if(isset($_POST['inputText'])) {
							$inputText = $_POST['inputText'];
						}
						$inputLength = strlen($inputText);


						//set the encryption or decryption option
						if(isset($_POST['encdecOption'])) {
							$operationType = $_POST['encdecOption'];
						}


						//redraw the Input textarea with the user-given input. it will be empty if the user did not specify any input text
						echo "<b><div id='inputBoxTitle'>Input:</div></b>";
						echo "<textarea class=\"form-control\" name=\"inputText\" required rows=\"8\" cols=\"40\" placeholder=\"Input Text (or binary if using S-DES)\">";
						echo $inputText;
						echo "</textarea>";


						//display the Execute button here if on a mobile display
						echo "<div class='hidden-md hidden-lg'><br>";
						echo "<button class='btn btn-success btn-block' type='submit' id='execute'>Execute</button>";
						echo "<br></div>";
						

						/*==========================================================*/
						/*               Display Histogram (desktop)                */
						/*==========================================================*/
						//note: this is NOT good coding practice to have two chunks of code that do the same thing
						echo "<div id='desktopHistogram' class='hidden-sm hidden-xs'>";
						if(isset($_POST['inputText'])) {
							if($cipherType!='S-DES') {
								echo "<br><br><b><span id='histogramTitle'>Frequency Histogram of Output (Default Alphabet):</span></b><br>";
								echo "<canvas id=\"myChart\" width=\"400\" height=\"400\"></canvas><br>";
								echo "<span class=\"red\">&diams;</span> Standard Letter Frequency<br>";
								echo "<span class=\"blue\">&diams;</span> Output Letter Frequency";
							}
						}
						echo "</div>";


						//this switch statement contains all logic for parsing the input variables in the option
						switch($cipherType) {
							/*==========================================================*/
							/*                      Additive Cipher                     */
							/*==========================================================*/
							case('Additive'):
								$shiftValue = 0;
								if(isset($_POST['keyAdditive'])) {
									$shiftValue = $_POST['keyAdditive'] % $defaultAlphabetLength;
								}
								$key = $shiftValue;

								/* the following loop generates an array ($lowmap) containing a map of plaintext characters to ciphertext characters.
								   for example, the first element of this array contains the char that plaintext A will map to. the second element
								   contains the char that plaintext B will map to, and so on. this variable is used to output the character map
								   for the user. */
								for($i=0; $i<$defaultAlphabetLength; $i++) {
									$shiftCharASCII = ($i + $shiftValue) % $defaultAlphabetLength;
									$shiftChar = chr($shiftCharASCII + $lowercaseOffset);
									
									array_push($lowMap, $shiftChar);
								}


								if($operationType=="enc") {
									for($i=0; $i<$inputLength; $i++) {
										if(isALetter($inputText[$i])) {
											$offset = getAsciiOffset($inputText[$i]);
											$oldASCII = ord($inputText[$i]);
											$valLetter = ($oldASCII - $offset + $shiftValue) % $defaultAlphabetLength;
											$newASCII = chr($valLetter + $offset);

											$outputText[$i] = toUpper($newASCII);
										}
										else { //all non-letter characters are simply added to the output text
											$outputText[$i] = $inputText[$i];
										}
									}
								}
								else if($operationType=="dec") {
									for($i=0; $i<$inputLength; $i++) {
										if(isALetter($inputText[$i])) {
											$offset = getAsciiOffset($inputText[$i]);
											$oldASCII = ord($inputText[$i]);
											$valLetter = $oldASCII - $offset - $shiftValue;
											
											if($valLetter>=0) { //php doesn't compute negative modulus correctly. example: -5 % x = -5, regardless of what x equals
												//if $mod is greater than zero, then the modulus function works
												$valLetter = $valLetter % $defaultAlphabetLength;
											}
											else {
												//if $mod is negative, addition will give the correct value instead of modulus
												$valLetter = $valLetter + $defaultAlphabetLength;
											}

											$newASCII = chr($valLetter + $offset);
											$outputText[$i] = toLower($newASCII);
										}
										else {
											$outputText[$i] = $inputText[$i];
										}
									}
								}
								break;
							/*==========================================================*/
							/*                    Substitution Cipher                   */
							/*==========================================================*/
							case('Substitution'):
								$keySub = "abcdefghijklmnopqurstuvwxyz";
								if(isset($_POST['keySub'])){
									$keySub = $_POST['keySub'];
								}
								$key = $keySub;

								$keyArray = str_split($keySub);	 //convert the key to an array so array_search can be used
								$lowMap = $keyArray;	//set the global variable so the mapping can be displayed

								if($operationType=="enc") {
									for($i=0; $i<$inputLength; $i++) {
										if(isALetter($inputText[$i])) {
											$offset = getAsciiOffset($inputText[$i]);
											$oldASCII = ord($inputText[$i]);
											$valLetter = $oldASCII - $offset;

											$cipherLetter = $keyArray[$valLetter];
											$outputText[$i] = toUpper($cipherLetter);
										}
										else {
											$outputText[$i] = $inputText[$i];
										}
									}
								}
								else if($operationType=="dec") {
									for($i=0; $i<$inputLength; $i++) {
										if(isALetter($inputText[$i])) {
											$offset = getAsciiOffset($inputText[$i]);
											$indexOfCipher = array_search(toLower($inputText[$i]), $keyArray);
											//echo "Trying to find ".toLower($inputText[$i])." in ".implode("",$keyArray).": ".$indexOfCipher."<br>";
											$newASCII = chr($indexOfCipher + $lowercaseOffset);

											$outputText[$i] = $newASCII;
										}
										else {
											$outputText[$i] = $inputText[$i];
										}
									}
								}
								break;
							/*==========================================================*/
							/*                   Multiplicative Cipher                  */
							/*==========================================================*/
							case('Multiplicative'):
								//set default value for the mult value
								$multValue = 1;
								if(isset($_POST['keyMult'])) {
									$multValue = $_POST['keyMult'];
								}
								$key = $multValue;
								
								//this loop generates both a lowmap for displaying mapping and a highmap. These two arrays are used anytime
								//a multiplicative cipher decryption is done (including Affine) since it is easier to use a map that a formula to decrypt
								$highMap = array();
								for($i=0; $i<$defaultAlphabetLength; $i++) {
									$valLetter = ($i * $multValue) % $defaultAlphabetLength;
									$newASCII = chr($valLetter + $capitalOffset);
									array_push($highMap, $newASCII);

									$newASCII = chr($valLetter + $lowercaseOffset);
									array_push($lowMap, $newASCII);
								}

								if($operationType=="enc") {
									for($i=0; $i<$inputLength; $i++) {
										if(isALetter($inputText[$i])) {
											$offset = getAsciiOffset($inputText[$i]);
											$oldASCII = ord($inputText[$i]);
											$valLetter = ($oldASCII - $offset) * $multValue % $defaultAlphabetLength;
											$newASCII = chr($valLetter + $offset);

											$outputText[$i] = toUpper($newASCII);
										}
										else {
											$outputText[$i] = $inputText[$i];
										}
									}
								}
								else if($operationType=="dec") {
									for($i=0; $i<$inputLength; $i++) {
										if(isALetter($inputText[$i])) {
											$offset = getAsciiOffset($inputText[$i]);

											//this decryption process is done by searching through a character mapping instead of using a mathematical formula
											$searchIndex = 0;
											if($offset==$capitalOffset) {
												$searchIndex = array_search($inputText[$i], $highMap);
											} else {
												$searchIndex = array_search($inputText[$i], $lowMap);
											}

											$newASCII = chr($searchIndex + $offset);
											$outputText[$i] = toLower($newASCII);
										}
										else {
											$outputText[$i] = $inputText[$i];
										}
									}
								}
								break;
							/*==========================================================*/
							/*                       Affine Cipher                      */
							/*==========================================================*/
							case('Affine'):
								//set default values for the mult value
								$multValue = 1;
								if(isset($_POST['keyMultAff'])) {
									$multValue = $_POST['keyMultAff'];
								}
								$keyMult = $multValue;
								//affine has 2 global variables for keys - $keyAdd and $keyMult

								//set default values for the shift value
								$shiftValue = 0;
								if(isset($_POST['keyAddAff'])) {
									$shiftValue = $_POST['keyAddAff'] % $defaultAlphabetLength;
								}
								$keyAdd = $shiftValue;
								//affine has 2 global variables for keys - $keyAdd and $keyMult
								
								//create lowMap and highMap for decrypting and mapping output
								$highMap = array();
								for($i=0; $i<$defaultAlphabetLength; $i++) {
									$valLetter = ($i*$multValue+$shiftValue) % $defaultAlphabetLength;
									$newASCII = chr($valLetter + $capitalOffset);
									array_push($highMap,$newASCII);

									$newASCII = chr($valLetter + $lowercaseOffset);
									array_push($lowMap,$newASCII);
								}

								if($operationType=="enc") {
									for($i=0; $i<$inputLength; $i++) {
										if(isALetter($inputText[$i])) {
											$offset = getAsciiOffset($inputText[$i]);
											$oldASCII = ord($inputText[$i]);
											$varLetter = (($oldASCII - $offset) * $multValue + $shiftValue) % $defaultAlphabetLength;
											$newASCII = chr($varLetter + $offset);

											$outputText[$i] = toUpper($newASCII);
										}
										else {
											$outputText[$i] = $inputText[$i];
										}
									}
								}
								else if($operationType=="dec") {
									for($i=0; $i<$inputLength; $i++) {
										if(isALetter($inputText[$i])) {
											$offset = getAsciiOffset($inputText[$i]);

											//this decryption process is done by searching through a character mapping instead of using a mathematical formula
											$searchIndex = 0;
											if($offset==$capitalOffset) {
												$searchIndex = array_search($inputText[$i], $highMap);
											} else {
												$searchIndex = array_search($inputText[$i], $highMap);
											}

											$newASCII = chr($searchIndex + $offset);
											$outputText[$i] = toLower($newASCII);
										}
										else {
											$outputText[$i] = $inputText[$i];
										}
									}
								}
								break;
							/*==========================================================*/
							/*                      Vigenere Cipher                     */
							/*==========================================================*/
							case('Vigenere'):
								$keyVig = "";
								if(isset($_POST['keyVig'])) {
									$keyVig = $_POST['keyVig'];
								}
								//remove non-word characters and digits from the key
								$keyVig = preg_replace('/[\d\W]/', '', $keyVig);
								$key = $keyVig;

								//determine whether the user asked to use autokey or not
								$isAutokey = "false";
								if($_POST['autokey']=='true') {	//php hates isset, cant use it here either
									$isAutokey = "true";
								}

								$autoKey = "";	//the variable that stores in scrubbed plaintext so that it can be used to encrypt/decrypt
								if($isAutokey=="true") { //create an autokey by removing all unnecessary characters from the input string
									//remove non-word characters and digits from string
									$autoKey = preg_replace('/[\d\W]/', '', $inputText);
								}
								$keyVigLen = strlen($keyVig);	//length of the user-entered key
								$autoKeyLen = strlen($autoKey);	//length of the autokey length (which is also the scrubbed plaintext)

								//completely scrub the input text of non-letter characters (except spaces) since they are derailing the decryption process
								//preg_replace does not have an easy way to do this using regular expressions, so a for-loop is used instead
								$newInputText = [];
								for($i=0; $i<strlen($inputText); $i++) {
									if(isALetter($inputText[$i]) || isASpace($inputText[$i])) {
										$newInputText[$i]=$inputText[$i];
									}
								}
								$inputText = implode("",$newInputText);
								$inputLength = strlen($inputText);


								if($operationType=="enc") {
									$keyIndex = 0;	//this variable keeps track of where the en/decryption process is in the key since this index may not match the index of the input text

									for($i=0; $i<$inputLength; $i++) {
										if(isALetter($inputText[$i])) {
											$offset = getAsciiOffset($inputText[$i]);
											$oldASCII = ord($inputText[$i]);
											$shiftValue = 0;

											//determine which letter in the key will be used to create the next shift value
											if($isAutokey=="false" || ($isAutokey=="true" && $keyIndex<$keyVigLen)){
												$keyLetter = $keyVig[$keyIndex%$keyVigLen];
											}
											else {
												$keyLetter = $autoKey[$keyIndex-$keyVigLen];
											}

											//determine the rest of the variables needed to calculate the next letter of the output
											$shiftValue = ord(toLower($keyLetter))-$lowercaseOffset;
											$valLetter = ($oldASCII-$offset+$shiftValue) % $defaultAlphabetLength;
											$newASCII = chr($valLetter + $offset);
											$outputText[$i] = toUpper($newASCII);

											$keyIndex++;
										}
										else {
											$outputText[$i] = $inputText[$i];
										}
									}
								}
								else if($operationType=="dec") {
									$keyIndex = 0;	//stores the index that currentKey is using to decrypt the input text (it is different from the index $i used for processing the input text)
									$keyChunk = 0;	//stores the ith current string of size $keyVigLen that is being used to decrypt the input text
									$currentKey = $keyVig;	//keeps track of the current key. a new one is made once every strlen($keyVig) letters when autokey is enabled
									
									for($i=0; $i<$inputLength; $i++) {
										if(isALetter($inputText[$i])) {
											$offset = getAsciiOffset($inputText[$i]);
											$oldASCII = ord($inputText[$i]);
											$shiftValue = 0;

											if($isAutokey=="false"){	//calculate which key letter to use when autokey is NOT enabled
												$keyLetter = $currentKey[$keyIndex%$keyVigLen];
											}
											else {	//calculate which key letter to use when autokey IS enabled.
												if($keyIndex%$keyVigLen==0 and $keyIndex!=0) {	//a new key is made every $keyVigLen letters
													$keyIndex=0;
													
													//the following two lines are needed to format the last $keyVigLen decrypted characters so that they can be used as a key
													$outputString = implode("",$outputText); //turns a copy of the current state of $outputText from and array to a string
													$partiallyDecOutput = preg_replace('/\s/', '', $outputString);	//removes all of the spaces from the this new string so that a new chunk of length $keyVigLen can be made from it

													$currentKey = substr($partiallyDecOutput, $keyChunk*$keyVigLen, $keyVigLen);
													$keyChunk++;
												}

												$keyLetter = $currentKey[$keyIndex%$keyVigLen];
											}

											//determine the rest of the variables needed to calculate the next letter of the output
											$shiftValue = ord(toLower($keyLetter))-$lowercaseOffset;
											$valLetter = $oldASCII-$offset-$shiftValue;
											if($valLetter>=0) { //php doesn't do negative modulus correctly...
												//if $mod is greater than zero, then the modulus function works
												$valLetter = $valLetter % $defaultAlphabetLength;
											}
											else {
												//if $mod is negative, addition will give the correct value instead of modulus
												$valLetter = $valLetter + $defaultAlphabetLength;
											}
											$newASCII = chr($valLetter + $offset);
											$outputText[$i] = toLower($newASCII);
											
											$keyIndex++;
										}
										else {
											$outputText[$i] = $inputText[$i];
										}
									}
								}
								break;
							/*==========================================================*/
							/*                      Playfair Cipher                     */
							/*==========================================================*/
							case('Playfair'):
								if(isset($_POST['keyPlay'])){
									$subValue = "abcdefghijklmnopqurstuvwxyz";
									$subValue = $_POST['keyPlay'];
								}
								$key = $subValue;

								$pfMatrix = array(); //playfair matrix array declared
								$alphaArray = array();//array that contains the alphabet
								$spaceIndex = array();//array for holding space indexes of initial input
								$pfMatrix = str_split($subValue, 1);//stores keyword string into the playfair matrix

								for($i = 1; $i<=26; $i++){//loop to put alphabet into the elements of the alphabet array
									$ins = chr($i + 96);
									if((ord($ins) != 106))//excludes j from the matrix
										array_push($alphaArray, $ins);
								}

								$row1 = 0;//row of first letter in digram
								$row2 = 0;//row of second leter in digram
								$col1 = 0;//column of first letter in digram
								$col2 = 0;//column of second letter of digram
								$index = 0;//used for digram indexing and ouput array indexing
								$pfMatrix = array_unique($pfMatrix);//removes any duplicate letters from keyword
								$pfMatrix = array_merge($pfMatrix, $alphaArray);//creates one array from alphabet and keyword
								$pfMatrix = array_unique($pfMatrix);//removes any duplicate letters from the keyword and alphabet
								$pfMatrix = array_chunk($pfMatrix, 5);//turns one dimentional array into two dimentinoal array (5x5 matrix)


								for($i=0; $i<$inputLength; $i++){//records spaces in the input string
									if((ord($inputText[$i])) == 106)
										$inputText[$i] = "i";
								}


								$inputText = preg_replace('/[\W]/', '', $inputText);//removes all spaces from input text
								//echo $inputText;
								$inputLength = strlen($inputText);
								if(($inputLength % 2) != 0){//if input text is of odd length then an "x" is appended to the end 
									$inputText[$inputLength] = "x";
									echo $inputText;
								}


								if($operationType=="enc") {
									for($i=0; $i<$inputLength; $i++) {	//loop over input
										if( ((ord($inputText[$i])>=65 && ord($inputText[$i])<=90) || ((ord($inputText[$i])>=97 && ord($inputText[$i])<=122))) && ($index + 1)<=$inputLength ) {//check to see if character is in the alphabet

											if(($index +1) < $inputLength) {
												$row1 = findRow(toLower($inputText[$index]), $pfMatrix);//get row of first input character
												$col1 = findCol(toLower($inputText[$index]), $pfMatrix);//get column of first input character
											//check to see if we are not outside the input string length
												$row2 = findRow(toLower($inputText[$index + 1]), $pfMatrix);//get row of second input character
												$col2 = findCol(toLower($inputText[$index + 1]), $pfMatrix);//get column of second input character
											}


											if(($row1 == $row2) && ($col1 != $col2)){//if the characters are in the same row
												//case1 same row
												if($col1 == 4){//if first character is in the final column of the matrix
													//wrap to frist column
													$outputText[$index] = $pfMatrix[$row1][0];
													$outputText[$index + 1] = $pfMatrix[$row2][$col2 + 1];
												}

												else if($col2 == 4){//if second character is in the final column of the matrix
													//wrap to first column
													$outputText[$index] = $pfMatrix[$row1][$col1 + 1];
													$outputText[$index + 1] = $pfMatrix[$row2][0];
												}

												else{
													
													$outputText[$index] = $pfMatrix[$row1][$col1 + 1];//choose charater in next column to the right
													$outputText[$index + 1] = $pfMatrix[$row2][$col2 + 1];//choose character in the next column to the right
												}

											}

											if(($col1 == $col2) && ($row1 != $row2)){//if the characters are in the same column
												//case2 same column
												if($row1 == 4){//if the first character is in the last row
													//wrap to first row
													$outputText[$index] = $pfMatrix[0][$col1];
													$outputText[$index + 1] = $pfMatrix[$row2 + 1][$col2];
												}

												else if($row2 == 4){//if the second character is in the last row
													//wrap to the first row
													$outputText[$index] = $pfMatrix[$row1 + 1][$col1];
													$outputText[$index + 1] = $pfMatrix[0][$col2];
												}

												else{
													$outputText[$index] = $pfMatrix[$row1 + 1][$col1];//choose character in the row below
													$outputText[$index + 1] = $pfMatrix[$row2 + 1][$col2];//choose character in the row below
												}

											}

											if(($col1 != $col2) && ($row1 != $row2)){//if the characters are in different rows and columns
												//case3 different row different column
												$outputText[$index] = $pfMatrix[$row1][$col2];//choose character across matrix in the same column as the second character
												$outputText[$index + 1] = $pfMatrix[$row2][$col1];//choose character across matrix in the same column as the first character
											}

											if(($row1 == $row2) && ($col1 == $col2)){//if the digram contains identical letters ex: "ss"
												//if the digram is the same letter duplicated
												//will encrypt like same row and increment column
												if($col1 == 4) {//if character is in the last column of the matrix
													$col1 = 0;//wrap to first column character
													$col2 = 0;//wrap to first column character
													$outputText[$index] = $pfMatrix[$row1][$col1];
													$outputText[$index + 1] = $pfMatrix[$row2][$col2];
												}
												else {
													$outputText[$index] = $pfMatrix[$row1][$col1 + 1];//choose character one column to the right
													$outputText[$index + 1] = $pfMatrix[$row2][$col2 + 1];//choose character one column to the right
												}
											}
										}

										$index = $index + 2;//increase index by two, chooses next digram and inputs in proper outputText location		
									}

									for($i = 2; $i<(sizeof($outputText)); $i+=3){
										array_splice($outputText, $i, 0, " ");
									}

								}
								else if($operationType == "dec") {
									if(isset($_POST['keyPlay'])) {
										$subValue = "abcdefghijklmnopqurstuvwxyz";
										$subValue = $_POST['keyPlay'];
									}

									$pfMatrix = array();//playfair matrix array declared
									$alphaArray = array();//array that contains the alphabet
									$pfMatrix = str_split($subValue, 1);//stores keyword string into the playfair matrix

									for($i = 1; $i<=26; $i++){//loop to put alphabet into the elements of the alphabet array
										$ins = chr($i + 96);
										if((ord($ins) != 106))//excludes j from the matrix
											array_push($alphaArray, $ins);
									}
									$row1 = 0;//row of first letter of digram
									$row2 = 0;//row of second letter of digram
									$col1 = 0;//column of first letter of digram 
									$col2 = 0;//column of second letter of digram
									$index = 0;//used for digram indexing and ouput array indexing
									$pfMatrix = array_unique($pfMatrix);//removes any duplicate letters from keyword
									$pfMatrix = array_merge($pfMatrix, $alphaArray);//creates one array from alphabet and keyword
									$pfMatrix = array_unique($pfMatrix);//removes any duplicate letters from the keyword and alphabet
									$pfMatrix = array_chunk($pfMatrix, 5);//turns one dimentional array into two dimentinoal array (5x5 matrix)



									$inputText = preg_replace('/[\W]/', '', $inputText);//removes all spaces from input text
									$inputLength = strlen($inputText);
									

									for($i=0; $i<$inputLength; $i++) {
										if(((ord($inputText[$i])>=65 && ord($inputText[$i])<=90) || (ord($inputText[$i])>=97 && ord($inputText[$i])<=122)) && ($index + 1)<$inputLength) {

											$row1 = findRow(toLower($inputText[$index]), $pfMatrix);//get row of first character in input string
											$col1 = findCol(toLower($inputText[$index]), $pfMatrix);//get column of first character in input string
											$row2 = findRow(toLower($inputText[$index + 1]), $pfMatrix);//get row of second character in input string
											$col2 = findCol(toLower($inputText[$index + 1]), $pfMatrix);//get column of second character in input string

											if(($row1 == $row2) && ($col1 != $col2)){//if the characters are in the same row
												if($col1 == 0){//if the first character is in the first column of the matrix
													//set to last column of the matrix
													$outputText[$index] = $pfMatrix[$row1][4];
													$outputText[$index + 1] = $pfMatrix[$row2][$col2 -1];

												}
												else if($col2 == 0){//if the second character is in the first column of the matrix
													//set to last column
													$outputText[$index] = $pfMatrix[$row1][$col1-1];
													$outputText[$index + 1] = $pfMatrix[$row2][4];
												}
												else{//chooses the character one column to the left as output character
													$outputText[$index] = $pfMatrix[$row1][$col1 - 1];
													$outputText[$index +1] = $pfMatrix[$row2][$col2 -1];
												}
											}

											if(($col1 == $col2) && ($row1 != $row2)){//if the input characters are in the same column
												if($row1 == 0){//if first character in in the first row of the matrix
													//set to last row
													$outputText[$index] = $pfMatrix[4][$col1];
													$outputText[$index + 1] = $pfMatrix[$row2 - 1][$col2];
												}
												else if($row2 == 0){//if second character is in the first row of the matrix
													//set to last row
													$outputText[$index] = $pfMatrix[$row1 - 1][$col1];
													$outputText[$index + 1] = $pfMatrix[4][$col2];
												}
												else{//chooses the character one row above as the output character
													$outputText[$index] = $pfMatrix[$row1 - 1][$col1];
													$outputText[$index + 1] = $pfMatrix[$row2 -1][$col2];
												}
											}

											if(($col1 != $col2) && ($row1 != $row2)){//if the characters are in different rows and columns
												$outputText[$index] = $pfMatrix[$row1][$col2];//choose character across matrix in the same column as the second character
												$outputText[$index + 1] = $pfMatrix[$row2][$col1];//choose character across matrix in the same column as the first character
											}

											if(($row1 == $row2) && ($col1 == $col2)){//if the digram contains identical letters ex: "ss"
												//if the digram is the same letter duplicated
												//will encrypt like same row and increment column
												if($col1 == 0){//if character is in the last column of the matrix
													$col1 = 4;//wrap to first column character
													$col2 = 4;//wrap to first column character
													$outputText[$index] = $pfMatrix[$row1][$col1];
													$outputText[$index + 1] = $pfMatrix[$row2][$col2];
												}
												else{
													$outputText[$index] = $pfMatrix[$row1][$col1 - 1];//choose character one column to the left
													$outputText[$index + 1] = $pfMatrix[$row2][$col2 - 1];//choose character one column to the left
												}
											}
										}

										$index = $index + 2;//increase index by two, chooses next digram and inputs in proper outputText location
									}
									
									for($i = 2; $i<(sizeof($outputText)); $i+=3){
										array_splice($outputText, $i, 0, " ");
									}

								}
								break;
							/*==========================================================*/
							/*                      Homophonic Cipher                   */
							/*==========================================================*/
							case('Homophonic'):	//HOMOPHONE
								$spaceAsciiVal = 32;	//the ascii value associated with the space character
								$keyArray = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
								//generate a key using the table layout
								for($i=0; $i<$defaultAlphabetLength; $i++) {	//there are 26 input fields with the name 'homo' plus the field's respective letter name
									$curLetterInputName = 'homo'.chr($i+$capitalOffset);	//instead of listing each field name, this line generates each name automatically
									if(isset($_POST[$curLetterInputName]) && strlen($_POST[$curLetterInputName])>0) {	//make sure letter is set and mapping isn't empty
										$keyArray[$i] = $_POST[$curLetterInputName];
										$keyArray[$i] = preg_replace("/,/", "", $keyArray[$i]);	//remove any user-entered commas
									}
								}
								if(isset($_POST["homoString"])) {	//generate a key using the single-string input field
									if($_POST["homoString"]!='') {	
										$keyArray = explode(" ", $_POST["homoString"]);
									}
								}

								//generates the key as a single-line string where each letter's character set is delimited by a space
								//this should be done regardless of how the user chose to enter the key
								$key = implode(" ", $keyArray);

								if($operationType=="enc") {
									for($i=0; $i<strlen($inputText); $i++) {
										if(isALetter($inputText[$i])) {
											$offset = getAsciiOffset($inputText[$i]);
											$numAlias = strlen($keyArray[ord($inputText[$i])-$offset]);	//number of aliases (mappings) that a letter has
											
											if($numAlias>1) {
												$getRand = rand(0,$numAlias-1);	//generate random index to select an alias, if aliases exist
												$outputText[$i] = $keyArray[ord($inputText[$i])-$offset][$getRand];
											}
											else {
												$outputText[$i] = toUpper($keyArray[ord($inputText[$i])-$offset]);
											}
										}
										else if(ord($inputText[$i])==$spaceAsciiVal){	//only letters, user-specified symbols, and spaces are allowed in the output text
											$outputText[$i] = $inputText[$i];
										}

										//echo "At index ".$i.", outputText =".$outputText[$i]."<br>";
									}
								}
								else if($operationType=="dec") {
									for($i=0; $i<strlen($inputText); $i++) {
										$searchIndex = array_search($inputText[$i], $keyArray);	//this search does not discover characters nested inside strings, ie, it won't decode letters that have more than one mapping since mappings are represented as a string, not as individual characters
										
										if($searchIndex === false) {	//if a plaintext symbol was not found, try looking through all letters which have multiple mappings individually (this reuquires further string parsing)
											for($j=0; $j<$defaultAlphabetLength; $j++) {
												if(strlen($keyArray[$j])>1) {	//if $keyArray at a given index has more than 1 value, it must represent a letter with at least one alias
													$tempStringToArray = str_split($keyArray[$j]);	//this line takes the string at $keyArray[$j] and turns it into an array such that each item in this array represents one alias
													$doesExistInMultiMapping = array_search($inputText[$i], $tempStringToArray);	//search the aliases for the given character and see if a match is found
													if(!($doesExistInMultiMapping === false)) {	//if the character is found, then the character and all of it's aliases exist at index $j
														$searchIndex = $j;
													}
												}
											}
										}

										if(!($searchIndex === false)) {	//instead of checking to see if the input character is a letter, this algorithm checks to see if the symbol exists in the input text
											$newASCII = chr($searchIndex + $lowercaseOffset);
											$outputText[$i] = $newASCII;
										}
										else if(ord($inputText[$i])==$spaceAsciiVal){	//only letters, user-specified symbols, and spaces are allowed in the output text
											$outputText[$i] = $inputText[$i];
										}
									}
								}
								break;
							/*==========================================================*/
							/*                        S-DES Cipher                      */
							/*==========================================================*/
							case('S-DES'):
								$keySize = 10;	//defined by S-DES standards
								$blockSize = 8;	//defined by S-DES standards
								$numRounds = 2;	//defined by S-DES standards

								$keyDest = "";
								if(isset($_POST['keyS-DES'])) {
									$keyDes = $_POST['keyS-DES'];
								}

								//if user entered invalid key, then set the key to zero
								if(strlen($keyDes)!=10 || !isBinaryString($keyDes)) {
									$keyDes = "0000000000";
								}
								$key = $keyDes;

								$binaryInput = preg_replace("/[\a\s]/", "", $inputText);	//this should scrub the input of all alphabetical characters

								while(strlen($binaryInput)%$blockSize!=0) {	//this loop pads the binary conversion of the input so that it is a multiple of blocksize (8) and thus consists entirely of full blocks
									$binaryInput = $binaryInput."0";
								}

								//generate the first subkey
								$PC10_subKey1 = PC10($keyDes);
								$PC10_g = $PC10_subKey1; //global variable for display
								$LS_firstHalf = LS(1,array_slice($PC10_subKey1,0,5));
								$LS_secondHalf = LS(1,array_slice($PC10_subKey1,5,5));
								$LScombined = chainArray($LS_firstHalf, $LS_secondHalf);
								$subKey1_LS1_g = $LScombined; //global variable for display
								$subKey1 = PC8($LScombined);		//this global version is used for displaying the subkey1
								$subKey1_g = implode("", $subKey1);	//this local version is used for calculations and may change
								$subKey1_PC8_g = $subKey1; //global variable for display

								//generate the second subkey
								$LS2_firstHalf = LS(2,$LS_firstHalf);
								$LS2_secondHalf = LS(2,$LS_secondHalf);
								$LS2combined = chainArray($LS2_firstHalf, $LS2_secondHalf);
								$subKey2_LS2_g = $LS2combined; //global variable for display
								$subKey2 =PC8($LS2combined);		//this global version is used for displaying the subkey2
								$subKey2_g = implode("", $subKey2);	//this local version is used for calculations and may change
								$subKey2_PC8_g = $subKey2;

								//make an array of the subkeys so they can be processed in a loop
								$subKeyArray = [$subKey1, $subKey2];

								//switch the functional order of the keys if decryption is used
								if($operationType=='dec') {	//IF YOU GIVE THE USER THE ABILITY TO CHANGE ROUND NUMBERS, THESE CONSTANTS NEED TO BE CHANGED
									$temp = $subKeyArray[0];
									$subKeyArray[0] = $subKeyArray[1];
									$subKeyArray[1] = $temp;
								}

								//the following loop runs the f sub k function for $numIterations rounds per each block of input text
								$numIterations = strlen($binaryInput)/$blockSize;	//should be an integer unless the padding wasn't done right
								$binaryInput = str_split($binaryInput); //covert the input to an array for easier manipulation
								for($i=0; $i<$numIterations; $i++) {
									$currentBlockIndex = $blockSize*$i;
									$currentBlock = array_slice($binaryInput, $currentBlockIndex, $blockSize);

									$IP = IP($currentBlock);
									$IP_g[$i] = $IP;
									$leftHalf = array_slice($IP,0,4);
									$rightHalf = array_slice($IP,4,4);

									//this for-loop is the f sub k function that is run for $numRounds times
									for($j=0; $j<$numRounds; $j++) {
										$EP = EP($rightHalf);
										$EP_g[$i][$j] = $EP; //global variable for display

										$epAndKeyXor = arrayXOR($EP,$subKeyArray[$j]);
										$leftHalf2 = array_slice($epAndKeyXor,0,4);
										$rightHalf2 = array_slice($epAndKeyXor,4,4);
										$XOR1Comp_g[$i][$j][0] = $EP;
										$XOR1Comp_g[$i][$j][1] = $subKeyArray[$j];
										$XOR1_g[$i][$j] = chainArray($leftHalf2,$rightHalf2); //global variable for display

										$sBox0 = sBox0($leftHalf2);
										$sBox0_g[$i][$j] = $sBox0; //global variable for display
										$sBox1 = sBox1($rightHalf2);
										$sBox1_g[$i][$j] = $sBox1; //global variable for display
										$sBoxCombined = chainArray($sBox0,$sBox1);
										//echo "Post-sbox word=".implode("",$sBoxCombined)." on round# ".$j."<br>";

										$P4 = P4($sBoxCombined);
										$P4_g[$i][$j] = $P4;
										$XOR2Comp_g[$i][$j][0] = $leftHalf;
										$XOR2Comp_g[$i][$j][1] = $P4;
										$leftHalf = arrayXOR($leftHalf,$P4);
										$XOR2_g[$i][$j] = $leftHalf;

										if($j<$numRounds-1) {	//swap function occurs on all rounds except for the last one
											$temp = $leftHalf;
											$leftHalf = $rightHalf;
											$rightHalf = $temp;

											$swap_g[$i][$j] = chainArray($leftHalf, $rightHalf);
										}
									}

									//finally, run the inverse IP function
									$finalCombine = chainArray($leftHalf,$rightHalf);
									$invIP = invIP($finalCombine);
									$invIP_g[$i] = $invIP;

									$outputText = $outputText.implode("",$invIP);
								}

								$outputText = str_split($outputText);	//turns it into an array so it will be displayed in the output

								break;
							//default case should be an error statement
							default:

								break;
						}


						/*==========================================================*/
						/*                    Display S-DES Steps                     */
						/*==========================================================*/
						if(isset($_POST['cipherOption'])) {	//display steps for generating output instead of a histogram
							if($cipherType=="S-DES") {
								echo "<br><br>";
								echo "<b>ALL S-DES STEPS:</b>";

								echo "<div id='S-DESSteps'>";
								echo "<b>Subkey Generation Steps:</b><br>";
								echo "Subkey1 after PC10: ".implode("",$PC10_g)."<br>";
								echo "Subkey1 after LS1: ".implode("",$subKey1_LS1_g)."<br>";
								echo "Subkey1 after PC8: ".implode("",$subKey1_PC8_g)."<br>";
								
								echo "Subkey2 after LS2: ".implode("",$subKey2_LS2_g)."<br>";
								echo "Subkey2 after PC8: ".implode("",$subKey2_PC8_g);

								echo "<br><br><b>Output Generation Steps:</b><br>";
								for($i=0; $i<$numIterations; $i++) {	//number of blocks to display info for
									echo "IP for Block ".($i+1).": ".implode("",$IP_g[$i])."<br>"; //IP
									for($j=0; $j<$numRounds; $j++) {	//number of rounds per block
										echo "Block ".($i+1).", Round ".($j+1).":<br>";
										
										echo "- EP: ".implode("",$EP_g[$i][$j])."<br>"; //EP
										echo "- ".implode("",$XOR1Comp_g[$i][$j][0])." XOR ".implode("",$XOR1Comp_g[$i][$j][1])." = ".implode("",$XOR1_g[$i][$j])."<br>"; //XOR1
										echo "- First sBox output: ".implode("",$sBox0_g[$i][$j])."<br>"; //sBox0
										echo "- Second sBox output: ".implode("",$sBox1_g[$i][$j])."<br>"; //sBox1
										echo "- P4: ".implode("",$P4_g[$i][$j])."<br>"; //P4
										echo "- ".implode("",$XOR2Comp_g[$i][$j][0])." XOR ".implode("",$XOR2Comp_g[$i][$j][1])." = ".implode("",$XOR2_g[$i][$j])."<br>"; //XOR2
										
										if($j<$numRounds-1) {
											echo "- Swap: ".implode("",$swap_g[$i][$j])."<br>"; //swap
										}
									}
									echo "Inverse IP: ".implode("",$invIP_g[$i])."<br><br><br>"; //invIP
								}
								
								echo "</div>"; //ends devSteps div
							}
						}


						echo "</div>";	//ends the middle column
						echo "<div class=\"col-md-4\">";	//beginning of the right column




						/*==========================================================*/
						/*                      Display Output                      */
						/*==========================================================*/
						//create and write to the output textarea
						echo "<b>Output:</b><br><div id=\"output\">";
						if(count($outputText)>1){
							echo implode("",$outputText); //implode turns an array into a string
						}
						echo "</div><br>";


						/*==========================================================*/
						/*               Metrics and Notifications                  */
						/*==========================================================*/
						if(isset($_POST['inputText']) && strlen($inputText)>0) { //only display metrics if the user has filled out the input

							//Metrics
							echo "<br><b>Metrics:</b><br>";
							if(isset($_POST['cipherOption'])) { //display the cipher type and the dec/enc option
								echo "<span id='operationType'>Function: ";
								if($operationType=='enc') {
									echo "Encryption";
								}
								else {
									echo "Decryption";
								}
								echo "</span>"; //end the operation type div

								echo "<div id=\"cipherTypeDisplay\">Cipher Type: ";
								echo $cipherType;
								echo "</div>"; //end the cipherTypeDisplay div
							}
							//display key based on what cipher was used
							echo "<div id=\"keyOutput\">";
							if($cipherType=="Affine"){
								echo "</div>";	//make a new div that doesn't use the id keyOutput so JS can parse it differently
								echo "<div id='multKeyDisplay'>Multiplicative Key: ".$keyMult."</div>";
								echo "<div id='addKeyDisplay'>Additive Key: ".$keyAdd;	//the ending div tag is at the end of this if/else statement
							}
							else if($cipherType=="S-DES") {
								echo "Key: ".$key."</div>";
								echo "<div id='subKeyDisplay'>SubKey1: ".$subKey1_g."<br>";
								echo "SubKey2: ".$subKey2_g;
							}
							else {	
								echo "Key: ".$key;
							}
							echo "</div>";

							//if viginere is used, make a new line solely for autokey usage display
							if($cipherType=='Vigenere') {
								echo "<nl id='autoKeyDisplay'>Autokey: ";

								if($isAutokey) {
									echo "Used";
								}
								else {
									echo "Not Used";
								}

								echo "</nl>";
							}

							//display standard dev of the output
							if($cipherType!="S-DES") {
								echo "Std Deviation of Output: <span id=\"stddev\"></span>";
								echo "<br>Std Deviation of Regular Alphabet (26 letters): 3.24<br>";
							}
							echo "<br><br>";

							//display character mappings
							if($cipherType=='Additive' || $cipherType=='Substitution' || $cipherType=='Multiplicative' || $cipherType=='Affine') {
								//display character mappings in table form
								echo "<b>Character Mapping:</b>";
								echo "<table><tr><td>Plaintext: </td>";
								for($i=0; $i<$defaultAlphabetLength; $i++) {
									echo "<td>".chr($i+$lowercaseOffset)."</td>";
								}
								echo "</tr><tr><td>Ciphertext: </td>";
								for($i=0; $i<$defaultAlphabetLength; $i++) {
									echo "<td>".$lowMap[$i]."</td>";
								}
								echo "</tr><table><br><br>";
							}
							else {
								echo "<b>Character mapping for this cipher type is not available.<br><br><br></b>";
							}

							//NOTIFICATIONS
							echo "<label class='notification'>Notification(s):</label>";
							if($cipherType=="Vigenere") {
								echo "<nl>&#9658; Input text has been scrubbed of all punctuation and numbers.</nl>";
							} 
							else if($cipherType=="Homophonic") {
								echo "<nl>&#9658; Input text has been scrubbed of all characters outside of the user-specified alphabet (excluding spaces).</nl>";
								echo "<nl id='decryptWarning'></nl>";	//this is populated by JS and only if the user has specified an alphabet with redundant mappings
							}
							else if($cipherType=="Substitution") {
								echo "<nl id='decryptWarning'>None.</nl>";	//this is populated by JS and only if the user has specified an alphabet with redundant mappings
							}
							else if($cipherType=='Multiplicative' || $cipherType=='Affine') {
								if($cipherType=='Affine')
									$key=$keyMult;
								if(gcd($defaultAlphabetLength,$key)!=1) {
									echo "<nl>&#9658; The multiplicative value entered is not relatively prime to the alphabet size (26). Legible decryption may not be possible.</nl>";
								}
								else {
									echo "<nl>None.</nl>";
								}
							}
							else {
								echo "<nl>None.</nl>";
							}

							//mobile histogram
						}
					?>
				</div>
			</div>
		</form>

		<br><br>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/Chart.js"></script>
		<script src="js/crypto.js"></script>
	</body>
</html>