"use strict";

/*==========================================================*/
/* Functionality that is immediately executed upon page load*/
/*==========================================================*/
$(document).ready(function(){
	//global constants
	var capitalOffset = 65;
	var maxCapital = 90;
	var lowercaseOffset = 97;
	var maxLowercase = 122;
	var alphabetSize = 26;		//this can change if homophonic cipher is used
	var substitutionKey = ""; 	//this gets parsed to see 

	var isHomophonic = false;
	var isSubstitution = false;
	if($("#cipherTypeDisplay").html()==="Cipher Type: Homophonic") {
		isHomophonic = true;
	}
	else if($("#cipherTypeDisplay").html()==="Cipher Type: Substitution") {
		isSubstitution = true;
	}


	/*==========================================================*/
	/*          Initializing and display histogram              */
	/*==========================================================*/
	//initializing variables for displaying the chart
	var ctx;
	var std;
	if(document.getElementById("myChart")) {	//make sure the histogram exists before this ID is found
		ctx = $("#myChart").get(0).getContext("2d");
		std = [8.12, 1.49, 2.71, 4.32, 12.02, 2.30, 2.03, 5.92, 7.31, 0.10, 0.69, 3.98, 2.61, 6.95, 7.68, 1.82, 0.11, 6.02, 6.28, 9.10, 2.88, 1.11, 2.09, 0.17, 2.11, 0.07];
	}

	//parse the cipher key into an unbroken string so the mappings can be analyzed for redundancy
	if(isHomophonic || isSubstitution) {
		var key = $("#keyOutput").html();
		var removeExp = "/\s+[A-Za-z]/g";
		var keyParsed = key.substr(5, key.length);
		keyParsed = keyParsed.replace(/\s+/g, '');
		substitutionKey = keyParsed;
	}

	//set the graphs labels according to whether the user is using the homophonic cipher
	//also changes the alphabet size if homophonic is used
	var alphabetArray;
	alphabetArray = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
	if(isHomophonic) {
		keyParsed = substitutionKey.replace(/[A-Za-z]/g, '');	//remove the standard alphabet letters so the new characters can be seen

		for(i=0; i<keyParsed.length; i++) {
			alphabetArray.push(keyParsed[i].toString());
		}

		alphabetSize+=keyParsed.length;

		//change the title of the frequency histogram
		$("#histogramTitle").html("Frequency Histogram of Output (Extended Alphabet)");

	} 

	//check substitutionKey for repeated characters. if found, give the user a warning
	if(isHomophonic || isSubstitution) {
		//this double loop checks for redundant mappings in the user-specified alphabet. if found, the loops will be broken
		var hasRepeats = false;
		for(var i=0; i<substitutionKey.length; i++) {
			for(j=0; j<substitutionKey.length; j++) {
				if(i!=j && (substitutionKey.charAt(i)==substitutionKey.charAt(j))) {
					hasRepeats = true;
					break;
				}
			}
			if(hasRepeats) {
				break;
			}
		}

		//if the user has specified redundant mappings, this fact will be displayed under Notifications
		if(hasRepeats) {
			$("#decryptWarning").html("&#9658; User-specified alphabet contains redundant character mappings. Legible decryption may not be possible.");
		}
	}

	//get output text and initialize the frequency array
	var outputText = $("#output").html();
	var outputLength = $("#output").html().length;
	var freq = [];
	for(var i=0; i<alphabetSize; i++) {
		freq[i]=0;
	}

	//count how many of each letter exists in the output for the purpose of calculating the standard deviation
	var numLetters=0;
	for(var j=0; j<outputLength; j++) {
		var thisChar = (outputText.charAt(j)).toLowerCase();
		var indexOfOccurance = alphabetArray.indexOf(thisChar);
		if(indexOfOccurance!=-1) {
			freq[indexOfOccurance]+=1;
			numLetters++;
		}
	}

	//convert the letter count to an overall percentage
	for(var i=0; i<alphabetSize; i++) {
		freq[i]=((freq[i]/numLetters)*100).toFixed(2);
	}

	//calculate the std dev of the data set. a flat histogram results in std dev of zero
	var mean = 100/alphabetSize;	//this is the average computed by 100% divided by 26 characters (or more if homophonic cipher is used)
	var sum = 0;
	for(var i=0; i<alphabetSize; i++) {
		sum = sum + Math.pow((freq[i]-mean),2);
	}
	var stddev = Math.sqrt(sum/alphabetSize);
	$("#stddev").append(stddev.toFixed(2));

	//set up the properties of the graph
	var myBarChart;
	var data;
	if(document.getElementById("myChart")) {	//make sure the histogram exists before this ID is found
		data = {
		    labels: alphabetArray,
		    datasets: [
		        {
		            label: "Standard Letter Frequency",
		            fillColor: "rgba(255, 130, 130,0.5)",
		            strokeColor: "rgba(255, 130, 130,0.8)",
		            highlightFill: "rgba(220,220,220,0.75)",
		            highlightStroke: "rgba(220,220,220,1)",
		            data: std
		        },
		        {
		            label: "Output Letter Frequency",
		            fillColor: "rgba(151,187,205,0.5)",
		            strokeColor: "rgba(151,187,205,0.8)",
		            highlightFill: "rgba(151,187,205,0.75)",
		            highlightStroke: "rgba(151,187,205,1)",
		            data: freq
		        }
		    ]
		};
		myBarChart = new Chart(ctx).Bar(data);
	}
	/*==================End Histogram Code=====================*/


	/*==========================================================*/
	/*                 Repopulate User Input                    */
	/*==========================================================*/
	//NOTE: repopulation of user input was not finished because of the difficulty caused by parsing text from the Output and Metrics. this output text
	//varies a lot depending on which ciper is used which is why I could not think of a quick, elegant way to do it

	//set enc/dec option
	var opType = $("#operationType").html();
	if(opType=="Function: Encryption") {
		$("#encryptOpt").prop('checked', true);
		$("#decryptOpt").prop('checked', false);
	}
	else if(opType=="Function: Decryption") {
		$("#encryptOpt").prop('checked', false);
		$("#decryptOpt").prop('checked', true);
	} else {	//default for if the tag is not set for some reason
		$("#encryptOpt").prop('checked', true);
		$("#decryptOpt").prop('checked', false);
	}

	//set the cipher type
	var cipherType = $("#cipherTypeDisplay").html().toLowerCase()
	cipherType = cipherType.substring(13);	//removes the words "cipher type: " from the beginning so that the actual cipherType can be parsed into an id
	$(".cipherOption").prop('checked', false);
	$("#"+cipherType+"Radio").prop('checked', true);
	
	// //display the appropriate cipher data field
	$(".cipherKey").hide();
	$("#"+cipherType+"Opt").show();

	// //populate the cipher data field with the key
	if(cipherType=='affine') {	//affine has two fields so it's a special case
		var keyAdd = $("#addKeyDisplay").html().substring(14);		//removes the "Additive Key: " part of the string
		var keyMult = $("#multKeyDisplay").html().substring(20);	//removes the "Multiplicative Key: " part of the string

		$("#affineFieldAdd").val(keyAdd);
		$("#affineFieldMult").val(keyMult);
	}
	else if(cipherType!='vigenere'){
		var key = $("#keyOutput").html();
		key = key.substring(5);	//removes the "Key: " part of the string

		$("#"+cipherType+"Field").val(key);
	}
	else {	//vigenere cipher
		var key = $("#keyOutput").html();
		key = key.substring(5);	//removes the "Key: " part of the string
		$("#vigenereField").val(key);

		var isAutokey = $("#autoKeyDisplay").html();
		if(isAutokey=="Autokey: Used") {
			$("#autokeyYes").prop('checked', true);
		}
		else if(isAutokey=="Autokey: Not Used") {
			$("#autokeyNo").prop('checked', true);
		}
		else {
			alert("Autokey status is not displayed correctly. Cannot repopulate user input for this option.");
		}
	}

});



//set behavior for when the help tab is clicked
$("#helpTab").click(function(){
	$("#optionsTab").parent().removeClass("active");
	$("#helpTab").parent().addClass("active");

	$("#optionsTabContent").hide();
	$("#helpTabContent").show();
});



//set behavior for when the options tab is clicked
$("#optionsTab").click(function(){
	$("#optionsTab").parent().addClass("active");
	$("#helpTab").parent().removeClass("active");

	$("#optionsTabContent").show();
	$("#helpTabContent").hide();
});



//set behavior of each helper button in the Help tab
$(".helperToggle").click(function(){
	if($(this).hasClass("btn-primary")) {
		$(this).removeClass("btn-primary");
		$(this).addClass("btn-warning");

		var btnText = $(this).html();
		$(this).html(btnText.replace("Show","Hide"));

		var idOfContent=$(this).attr('id')+"Content";
		$("#"+idOfContent).show();
	}
	else {
		$(this).removeClass("btn-warning");
		$(this).addClass("btn-primary");

		var btnText = $(this).html();
		$(this).html(btnText.replace("Hide","Show"));

		var idOfContent=$(this).attr('id')+"Content";
		$("#"+idOfContent).hide();
	}
});



//set behavior for randomly scrambling homophonic fields
$("#scramble").click(function(){
	var letter = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
	var scramble = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
	scramble = shuffle(scramble);

	for(var i=0; i<26; i++) {
		$("#homo"+letter[i]).val(scramble[i]+",");
	}
});



//randomly shuffles the elements of an array. thank you stack overflow!
function shuffle(array) { 
  var currentIndex = array.length, temporaryValue, randomIndex ;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}



//set behavior for showing/hiding key options when different ciphers are selected
$(".cipherOption label input").click(function(){
	var type = $(this).val();
	var isVis = $("#"+type.toLowerCase()+"Opt").is(":visible"); //check to see of the option clicked on is already visible

	if(!isVis){	//if the selected option is not visible, hide all options and enable the selected one
		$(".cipherKey").hide(500);
		switch (type) {
			case 'Additive':
				$("#additiveOpt").show(500);
				break;
			case "Substitution":
				$("#substitutionOpt").show(500);
				break;
			case "Multiplicative":
				$("#multiplicativeOpt").show(500);
				break;
			case "Affine":
				$("#affineOpt").show(500);
				break;
			case "Vigenere":
				$("#vigenereOpt").show(500);
				break;
			case "Playfair":
				$("#playfairOpt").show(500);
				break;
			case "Homophonic":
				$("#homophonicOpt").show(500);
				break;
			case "S-DES":
				$("#s-desOpt").show(500);
				break;
			default:
				alert("Cipher type error. Please reload the page.");
		}
	}
});
