<?php
// directories:
//	array of directories to run this script through. Relative to this file.
//
$directories = array("test");

// dry run:
// true: make subdirectory in each directory and put in rewrite results
// false: replace files content.
//
$dry_run = true;

$starttime = microtime(true);
foreach($directories as $directory){
	echo "Running directory: ".$directory."<br>\n";
	ifDirectoryExists(trim($directory),$dry_run);
}


function recursiveSearchForFiles($directory = "", $depth = 0, $dry_run){
	$files = scandir($directory);
	foreach($files as $file_name){
		if(mb_substr($file_name,0,1) == ".")continue; // ignore alle directories or files that starts with a "." 
		if($file_name == "Smarty_Compiler.class.php") continue; // the smarty compiler is known to have <? inside so this file we want to ignore
		echo "|";
		for($i=0;$i<=$depth;$i++){
			echo "-";
		}
		if(is_dir($directory.DIRECTORY_SEPARATOR.$file_name)){
			echo "DIRECTORY: ".$file_name;
			recursiveSearchForFiles($directory.DIRECTORY_SEPARATOR.$file_name,$depth+1, $dry_run);
		} else {
			if(strtolower(substr($file_name,-4)) == ".php"){
				echo "PHPFILE: ".$file_name;
				searchReplaceFileContent($directory.DIRECTORY_SEPARATOR.$file_name, $dry_run);
			} else {
				echo "FILE: ".$file_name;
			}
		}
		echo "\n<br>";
	}
	echo "\n<br>";
}

function ifDirectoryExists($directory,$dry_run){
	if(is_dir($directory)){
		echo "DIRECTORY EXISTS: ".$directory."\n<br>";
		recursiveSearchForFiles($directory, 0, $dry_run);
	} else {
		echo "DIRECTORY NOT EXISTS: ".$directory."\n<br>";
	}
	echo "\n\n<hr>";
}

function searchReplaceFileContent($file,$dry_run){

	$filecontent = file_get_contents($file);
	$filecontent_tmp = $filecontent;
	$filecontent = preg_replace("/<\?=/", "<?php echo ", $filecontent);
	$filecontent = preg_replace("/<\?([^php|^xml])/i", "<?php $1", $filecontent);

	if($filecontent != $filecontent_tmp){
		if($dry_run){
			@mkdir(dirname($file).DIRECTORY_SEPARATOR.".rewrite_result",0777,true); // @ to prevent warning if directory already exists
			$target_file =	dirname($file).DIRECTORY_SEPARATOR.".rewrite_result".DIRECTORY_SEPARATOR.basename($file);
		} else {
			$target_file = $file;
		}
		echo " CHANGED";
		file_put_contents($target_file,$filecontent);
	}
}

echo "\n\nDone in ".round(microtime(true)-$starttime,3)." seconds";