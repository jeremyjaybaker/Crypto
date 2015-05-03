<?php
//Determines whether the character passed in is a lowercase or capital and returns its respecive offset value.
//These offset values are used to turn ASCII letter values into values between 0 (a) and 25 (z)
function getAsciiOffset($a) {
	$lowercaseOffset = 97;
	$capitalOffset = 65;

	if (strlen($a)>1) {	//input strings should only be 1 character long
		return -1;
	}
	else if(ord($a[0])>=65 && ord($a[0])<=90) {	//65-90 are capital ACSII values
		return $capitalOffset;
	}
	else if(ord($a[0])>=97 && ord($a[0])<=122) {	//97-122 are lowercase ASCII values
		return $lowercaseOffset;
	}
	else {	//error
		return 0;
	}
}

//calculates the greatest common denominator of two numbers
function gcd($a, $b) {
	$c=0;
	while($a != 0) {
		$c = $a;
		$a = $b%$a;
		$b = $c;
	}
	return $b;
}

//returns true if the two letters lie in the same column of the input array. the input array is a 1D representation of a 5x5 2D array.
//used for the playfair cipher
function isSameColumn($a, $b, $array) {
	$indexOfFirst = array_search($a, $array);
	$indexOfSecond = array_search($b, $array);

	$getCol1 = $indexOfFirst % 5;
	$getCol2 = $indexOfSecond % 5;

	if($getCol1 == $getCol2) {
		return true;
	}
	else {
		return false;
	}
}

//returns true if the two letters lie in the same row of the input array. the input array is a 1D representation of a 5x5 2D array.
//used for the playfair cipher
function isSameRow($a, $b, $array) {
	$indexOfFirst = array_search($a, $array);
	$indexOfSecond = array_search($b, $array);

	$getRow1 = floor($indexOfFirst/5);
	$getRow2 = floor($indexOfSecond/5);

	if($getRow1 == $getRow2) {
		return true;
	}
	else {
		return false;
	}
}

//converts the given char to lower case
function toLower($a) {
	if (strlen($a)>1) {	//input strings should only be 1 character long
		return -1;
	}
	else if(ord($a[0])>=65 && ord($a[0])<=90) {	//65-90 are capital ACSII values
		return chr(ord($a[0])+32);
	}
	else if(ord($a[0])>=97 && ord($a[0])<=122) {	//97-122 are lowercase ASCII values
		return $a[0];
	}
	else {	//error
		return 0;
	}
}

//converts the given char to upper case
function toUpper($a) {
	if (strlen($a)>1) {	//input strings should only be 1 character long
		return -1;
	}
	else if(ord($a[0])>=65 && ord($a[0])<=90) {	//65-90 are capital ACSII values
		return $a[0];
	}
	else if(ord($a[0])>=97 && ord($a[0])<=122) {	//97-122 are lowercase ASCII values
		return chr(ord($a[0])-32);
	}
	else {	//error
		return 0;
	}
}

//determines if the input character is an ASCII letter (includes lowercase and capital) or not
function isALetter($a) {
	if((ord($a[0])>=65 && ord($a[0])<=90) || (ord($a[0])>=97 && ord($a[0])<=122)) {
		return true;
	}
	else {	//error
		return false;
	}
}

//determines if the input character is an ASCII space or not
function isASpace($a) {
	if(ord($a[0])==32) {
		return true;
	}
	else {	//error
		return false;
	}
}

//permuted choice 10 function for S-DES
function PC10($orig) {
	$new[0] = $orig[2];
	$new[1] = $orig[4];
	$new[2] = $orig[1];
	$new[3] = $orig[6];
	$new[4] = $orig[3];
	$new[5] = $orig[9];
	$new[6] = $orig[0];
	$new[7] = $orig[8];
	$new[8] = $orig[7];
	$new[9] = $orig[5];

	return $new;
}

//permuted choice 8 function for S-DES
function PC8($orig) {
	$new[0] = $orig[5];
	$new[1] = $orig[2];
	$new[2] = $orig[6];
	$new[3] = $orig[3];
	$new[4] = $orig[7];
	$new[5] = $orig[4];
	$new[6] = $orig[9];
	$new[7] = $orig[8];

	return $new;
}

//chains two arrays together by converting the from array to string then back to array
function chainArray($a, $b) {
	$x = implode("", $a);
	$y = implode("", $b);
	$z = $x.$y;

	return str_split($z);
}

//rotate original array to the left by $s bits for S-DES
function LS($s,$orig) {
	$new[0] = $orig[$s%5];
	$new[1] = $orig[($s+1)%5];
	$new[2] = $orig[($s+2)%5];
	$new[3] = $orig[($s+3)%5];
	$new[4] = $orig[($s+4)%5];

	return $new;
}

//IP function for S-DES
function IP($orig) {
	$new[0] = $orig[1];
	$new[1] = $orig[5];
	$new[2] = $orig[2];
	$new[3] = $orig[0];
	$new[4] = $orig[3];
	$new[5] = $orig[7];
	$new[6] = $orig[4];
	$new[7] = $orig[6];

	return $new;
}

//inverse IP function for S-DES. this COULD be calculated given IP, but for simplicities sake, it's hardcoded here
function invIP($orig) {
	$new[0] = $orig[3];
	$new[1] = $orig[0];
	$new[2] = $orig[2];
	$new[3] = $orig[4];
	$new[4] = $orig[6];
	$new[5] = $orig[1];
	$new[6] = $orig[7];
	$new[7] = $orig[5];

	return $new;
}

//expansion permutation for S-DES
function EP($orig) {
	$new[0] = $orig[3];
	$new[1] = $orig[0];
	$new[2] = $orig[1];
	$new[3] = $orig[2];
	$new[4] = $orig[1];
	$new[5] = $orig[2];
	$new[6] = $orig[3];
	$new[7] = $orig[0];

	return $new;
}

//the 0th sbox function for S-DES
function sBox0($orig) {
	//format: array[row][column]
	$orig = implode("",$orig);
	$rowSelect = substr($orig,0,1).substr($orig,3,1);	//first and fourth elements of the array
	$colSelect = substr($orig,1,2);						//second and third elements of the array

	$sBox["00"]["00"] = [0,1];
	$sBox["00"]["01"] = [0,0];
	$sBox["00"]["10"] = [1,1];
	$sBox["00"]["11"] = [1,0];
	$sBox["01"]["00"] = [1,1];
	$sBox["01"]["01"] = [1,0];
	$sBox["01"]["10"] = [0,1];
	$sBox["01"]["11"] = [0,0];
	$sBox["10"]["00"] = [0,0];
	$sBox["10"]["01"] = [1,0];
	$sBox["10"]["10"] = [0,1];
	$sBox["10"]["11"] = [1,1];
	$sBox["11"]["00"] = [1,1];
	$sBox["11"]["01"] = [0,1];
	$sBox["11"]["10"] = [1,1];
	$sBox["11"]["11"] = [1,0];

	return $sBox[$rowSelect][$colSelect];
}

//the 1st sbox function for S-DES
function sBox1($orig) {
	//format: array[row][column]
	$orig = implode("",$orig);
	$rowSelect = substr($orig,0,1).substr($orig,3,1);	//first and fourth elements of the array
	$colSelect = substr($orig,1,2);						//second and third elements of the array

	$sBox["00"]["00"] = [0,0];
	$sBox["00"]["01"] = [0,1];
	$sBox["00"]["10"] = [1,0];
	$sBox["00"]["11"] = [1,1];
	$sBox["01"]["00"] = [1,0];
	$sBox["01"]["01"] = [0,0];
	$sBox["01"]["10"] = [0,1];
	$sBox["01"]["11"] = [1,1];
	$sBox["10"]["00"] = [1,1];
	$sBox["10"]["01"] = [0,0];
	$sBox["10"]["10"] = [0,1];
	$sBox["10"]["11"] = [0,0];
	$sBox["11"]["00"] = [1,0];
	$sBox["11"]["01"] = [0,1];
	$sBox["11"]["10"] = [0,0];
	$sBox["11"]["11"] = [1,1];

	return $sBox[$rowSelect][$colSelect];
}

//the P4 function for S-DES
function P4($orig) {
	$new[0] = $orig[1];
	$new[1] = $orig[3];
	$new[2] = $orig[2];
	$new[3] = $orig[0];

	return $new;
}

//takes two arrays of chars that represent binary numbers ("1" and "0") and returns the result of bitwise OR between them
function arrayXOR($a, $b) {
	$length = count($a);
	$result = [];
	for($i=0; $i<$length; $i++) {
		if($a[$i]!=$b[$i]) {
			array_push($result,"1");
		}
		else {
			array_push($result,"0");
		}
	}

	return $result;
}

//this function returns true if the argument is a string of only 1s and 0s, false if otherwise
function isBinaryString($str) {
	$str = str_split($str);
	for($i=0; $i<count($str); $i++) {
		if($str[$i]!='1' && $str[$i]!='0') {
			return false;
		}
	}

	return true;
}

?>