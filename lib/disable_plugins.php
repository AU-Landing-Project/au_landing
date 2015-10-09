<html>
	<head>
		<title>Disable/enable plugins</title>
	</head>
	<body>
		<pre>	

<?php
	
	/*
	There should normally be a file called 'enabled' with 0660 permissions in the mod directory
	for this to work. If the web server can write to the mod directory already then
	it will attempt to create the 'disabled' file the first time it runs.
	
	*/	
	
		//should put disabled file in mod directory
		$filedisabled = '../../disabled';
		$fileenabled = '../../enabled';

		//change this to whatever...
		$password = "apple";

		// only allow from an AU address and with right password
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		echo "You are accessing this from: $hostname \n";
		
		if (substr($hostname, -13, 13)=='athabascau.ca' && $_POST['letmein']==$password){
			// all is fine - try to create or rename disabled file
			if ($_POST['action']=='disable'){		
				echo "Trying to disable plugins \n";
				
				//if the enabled file exists, rename it
				if(file_exists($fileenabled) && rename($filedisabled, $fileenabled)){
					echo "File successfullly renamed to 'disabled'\n";				
				}else{
						//if we have not done this before or rename failed
						// then file needs to be created
						// permissions may stop this -
					if(touch($filedisabled)){
						echo "Successfully created/changed the disabled file\n";
					} else {
						echo "Not created/changed the disabled file - this didn't work\n";
					}	
					// just in case, try to set permissions
					if(chmod($filedisabled, 0660)){
						echo "changed permissions to 660 \n";
					} else {
						echo "not changed permissions to 660 \n";
					}			

				}		
			} elseif ($_POST['action']=='enable'){
				//rename disabled file to enabled - should retain permissions so
				//no need for broader directory permissions			
				if (rename($filedisabled, $fileenabled)){
						echo "file renamed - all should work normally now\n";		
				}else {
					echo "not renamed\n ";
					// cannot rename it so try to delete disabled file
					if (unlink($filedisabled)){
						echo "'disabled' file deleted successfully - all should work normally now\n";
					}	else {
						if (file_exists($filedisabled)){
							echo "'disabled' file not deleted - this did not work\n";
						} else {
							echo "OK - there's nothing to delete! All should work normally \n";
						}
					}
		
				}

			}else {
				//user did not specify enable or disable - further safeguard against bad people
				echo "wrong action specified - if you are using this form you should know this! Check the docs \n";
			}
	
		}else{
			echo "wrong password/no password yet, or not in AU domain \n";
		}	
?>
		</pre>
		<form action="disable_plugins.php" method="post">
			Password: 
			<input type="password" name="letmein">
			Action:
			<input type="text" name="action">
			<input type="submit">
		</form>
	</body>
</html>	