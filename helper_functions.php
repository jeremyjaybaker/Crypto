<?php
function getAsciiOffset($a) {
	if (strlen($a)>1) {
		return -1;
	}
	else if(ord($a[0])>=65 && ord($a[0])<=90) {
		return 65;
	}
	else if(ord($a[0])>=97 && ord($a[0])<=122) {
		return 97;
	}
	else {
		return 0;
	}
}
?>