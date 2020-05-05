<!DOCTYPE HTML>
<!--
	Horizons by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Nick Langan's FM DX logs</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
	<body class="no-sidebar">

		<!-- Header -->
			<div id="header">
				<div class="container">
						
					<!-- Logo -->
						<h1><a href="index.html" id="logo">Nick Langan W2NJL FM DX</a></h1>
					
					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="index.html">Home</a></li>								
								<li><a href="loglist.html">Log List (2005-2020)</a></li>
								<li><a href="logdata.html">Log Graphs</a></li>
								<li><a href="logmap.html">Log Map</a></li>								
								<li><a href="eskip.html">15 Years of E-Skip Analysis</a></li>
								<li><a href="https://www.fmlist.org/fm_logmap.php?datum=2020&omid=3425">My latest logs at FMList</a></li>
							</ul>
						</nav>

				</div>
			</div>

		<!-- Main -->
			<div id="main" class="wrapper style1">
				<div class="container">
					<section>
						
						<p><?php
 include 'database.php';




 if(isset($_POST["Record"])){
	$record = $_POST["Record"];
	
	  
	
  }



  $year = $_POST["Year"];
				$month = $_POST["Month"];
				

				if(isset($_POST["State"])){
					$state = $_POST["State"];
					
					$sql = "SELECT * FROM `florencelog` WHERE State ='$state'";
				  
										
					if($result = mysqli_query($link, $sql)){

						echo "<header class='major'>";
							echo "<h2>Here are all of Nick's logs from $state</h2>";
							
						echo "</header>";
					  
					  if(mysqli_num_rows($result) > 0){

						
				
						echo "<table>";
						echo "<tr>";
						
							echo "<th><h4>Frequency</h4></th>";
							echo "<th><h4>Calls&nbsp;&nbsp;&nbsp;&nbsp;</h4></th>";                                    
							echo "<th><h4>City</h4></th>";
							echo "<th><h4>State/Province&nbsp;&nbsp;</h4></th>";
							echo "<th><h4>Date</h4></th>";
							echo "<th><h4>Miles</h4></th>";
							echo "<th><h4>Prop method</h4></th>";
							
						echo "</tr>";
						
					while($row = mysqli_fetch_array($result)){

					
						$filename = $row['Calls'];

						$filename = strtolower($filename);

						

						 

						
						$images = array_map('basename', glob('audio/{'.$filename.'}*', GLOB_BRACE)); 

						
							$filename = $images[0]; 
						

						echo "<tr>";
						echo "<td>" . "<h2>" . $row['Freq']. "</h2>" . "</td>";
						if(count($images) > 0) {
						
						// if (file_exists('audio/'.$filename)) 
						
						echo "<td><a href='audio/$filename'>"."<h2>" . $row['Calls']. "</h2>" . "</a>". "</td>";
						}
						else
						echo "<td>" . "<h2>" . $row['Calls']. "</h2>" . "</td>";
						
						echo "<td>" . "<h2>" . $row['City']. "</h2>" . "</td>";
							
							echo "<td>" . "<h2>" . $row['State']. "</h2>" . "</td>";
							echo "<td>" . "<h2>" . $row['Date']. "</h2>" . "</td>";
							echo "<td>" . "<h2>" . $row['Miles']. "</h2>" . "</td>";
							echo "<td>" . "<h2>" . $row['Prop']. "</h2>" . "</td>";
							
						echo "</tr>";
						
					}
					echo "</table>";
					// Close result set
					mysqli_free_result($result);
				} else{
					echo "No rekkids matching your query were found.";
				}
				} else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
				}}


				if(isSet($_POST["Record"])){
					

					if($record=="longes"){
						$sql = "SELECT * FROM `florencelog` ORDER BY Miles DESC LIMIT 50";
  
						
						if($result = mysqli_query($link, $sql)){

							echo "<header class='major'>";
							echo "<h2>Here are the 50 most distant logs Nick has heard</h2>";
							
						echo "</header>";
						  
						  if(mysqli_num_rows($result) > 0){

							echo "<table>";
							echo "<tr>";
							
								echo "<th><h4>Frequency</h4></th>";
								echo "<th><h4>Calls&nbsp;&nbsp;&nbsp;&nbsp;</h4></th>";                                    
								echo "<th><h4>City</h4></th>";
								echo "<th><h4>State/Province&nbsp;&nbsp;</h4></th>";
								echo "<th><h4>Date</h4></th>";
								echo "<th><h4>Miles</h4></th>";
								echo "<th><h4>Prop method</h4></th>";
								
							echo "</tr>";
							
							while($row = mysqli_fetch_array($result)){

					
								$filename = $row['Calls'];
		
								$filename = strtolower($filename);
		
								
		
								 
		
								
								$images = array_map('basename', glob('audio/{'.$filename.'}*', GLOB_BRACE)); 
		
								
									$filename = $images[0]; 
								
		
								echo "<tr>";
								echo "<td>" . "<h2>" . $row['Freq']. "</h2>" . "</td>";
								if(count($images) > 0) {
								
								// if (file_exists('audio/'.$filename)) 
								
								echo "<td><a href='audio/$filename'>"."<h2>" . $row['Calls']. "</h2>" . "</a>". "</td>";
								}
								else
								echo "<td>" . "<h2>" . $row['Calls']. "</h2>" . "</td>";
								
								echo "<td>" . "<h2>" . $row['City']. "</h2>" . "</td>";
									
									echo "<td>" . "<h2>" . $row['State']. "</h2>" . "</td>";
									echo "<td>" . "<h2>" . $row['Date']. "</h2>" . "</td>";
									echo "<td>" . "<h2>" . $row['Miles']. "</h2>" . "</td>";
									echo "<td>" . "<h2>" . $row['Prop']. "</h2>" . "</td>";
									
								echo "</tr>";
								
							}
							echo "</table>";
							// Close result set
							mysqli_free_result($result);
						} else{
							echo "No rekkids matching your query were found.";
						}
						} else{
						echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
						}}

			if($record=="shortes"){
				$sql = "SELECT * FROM `florencelog` WHERE Prop LIKE '%E%' > 0 ORDER BY Miles ASC LIMIT 50";

				
				if($result = mysqli_query($link, $sql)){

					echo "<header class='major'>";
							echo "<h2>Here are the 50 most shortest E-Skip logs Nick has heard</h2>";
							
						echo "</header>";
				  
				  if(mysqli_num_rows($result) > 0){

					echo "<table>";
					echo "<tr>";
					
						echo "<th><h4>Frequency</h4></th>";
						echo "<th><h4>Calls&nbsp;&nbsp;&nbsp;&nbsp;</h4></th>";                                    
						echo "<th><h4>City</h4></th>";
						echo "<th><h4>State/Province&nbsp;&nbsp;</h4></th>";
						echo "<th><h4>Date</h4></th>";
						echo "<th><h4>Miles</h4></th>";
						echo "<th><h4>Prop method</h4></th>";
						
					echo "</tr>";
					
					while($row = mysqli_fetch_array($result)){

					
						$filename = $row['Calls'];

						$filename = strtolower($filename);

						

						 

						
						$images = array_map('basename', glob('audio/{'.$filename.'}*', GLOB_BRACE)); 

						
							$filename = $images[0]; 
						

						echo "<tr>";
						echo "<td>" . "<h2>" . $row['Freq']. "</h2>" . "</td>";
						if(count($images) > 0) {
						
						// if (file_exists('audio/'.$filename)) 
						
						echo "<td><a href='audio/$filename'>"."<h2>" . $row['Calls']. "</h2>" . "</a>". "</td>";
						}
						else
						echo "<td>" . "<h2>" . $row['Calls']. "</h2>" . "</td>";
						
						echo "<td>" . "<h2>" . $row['City']. "</h2>" . "</td>";
							
							echo "<td>" . "<h2>" . $row['State']. "</h2>" . "</td>";
							echo "<td>" . "<h2>" . $row['Date']. "</h2>" . "</td>";
							echo "<td>" . "<h2>" . $row['Miles']. "</h2>" . "</td>";
							echo "<td>" . "<h2>" . $row['Prop']. "</h2>" . "</td>";
							
						echo "</tr>";
						
					}
					echo "</table>";
					// Close result set
					mysqli_free_result($result);
				} else{
					echo "No rekkids matching your query were found.";
				}
				} else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
				}}

	if($record=="longtrop"){
		$sql = "SELECT * FROM `florencelog` WHERE Prop LIKE '%T%' > 0 ORDER BY Miles DESC LIMIT 50";

		
		if($result = mysqli_query($link, $sql)){

			echo "<header class='major'>";
							echo "<h2>Here are the 50 most distant tropo logs Nick has heard</h2>";
							
						echo "</header>";
		  
		  if(mysqli_num_rows($result) > 0){

			echo "<table>";
			echo "<tr>";
			
				echo "<th><h4>Frequency</h4></th>";
				echo "<th><h4>Calls&nbsp;&nbsp;&nbsp;&nbsp;</h4></th>";                                    
				echo "<th><h4>City</h4></th>";
				echo "<th><h4>State/Province&nbsp;&nbsp;</h4></th>";
				echo "<th><h4>Date</h4></th>";
				echo "<th><h4>Miles</h4></th>";
				echo "<th><h4>Prop method</h4></th>";
				
			echo "</tr>";
			
			while($row = mysqli_fetch_array($result)){

					
				$filename = $row['Calls'];

				$filename = strtolower($filename);

				

				 

				
				$images = array_map('basename', glob('audio/{'.$filename.'}*', GLOB_BRACE)); 

				
					$filename = $images[0]; 
				

				echo "<tr>";
				echo "<td>" . "<h2>" . $row['Freq']. "</h2>" . "</td>";
				if(count($images) > 0) {
				
				// if (file_exists('audio/'.$filename)) 
				
				echo "<td><a href='audio/$filename'>"."<h2>" . $row['Calls']. "</h2>" . "</a>". "</td>";
				}
				else
				echo "<td>" . "<h2>" . $row['Calls']. "</h2>" . "</td>";
				
				echo "<td>" . "<h2>" . $row['City']. "</h2>" . "</td>";
					
					echo "<td>" . "<h2>" . $row['State']. "</h2>" . "</td>";
					echo "<td>" . "<h2>" . $row['Date']. "</h2>" . "</td>";
					echo "<td>" . "<h2>" . $row['Miles']. "</h2>" . "</td>";
					echo "<td>" . "<h2>" . $row['Prop']. "</h2>" . "</td>";
					
				echo "</tr>";
				
			}
			echo "</table>";
			// Close result set
			mysqli_free_result($result);
		} else{
			echo "No rekkids matching your query were found.";
		}
		} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}}

					if($record=="All"){
                      
					  $sql = "SELECT * FROM `florencelog`";
					 
					  
                      
                      if($result = mysqli_query($link, $sql)){

						$count = mysqli_num_rows($result); 

						echo "<header class='major'>";
							echo "<h2>Here are all $count logs Nick has heard since 2005</h2>";
							
						echo "</header>";
                        
                        if(mysqli_num_rows($result) > 0){
                          
                          
                          echo "<table>";
                                echo "<tr>";
                                
                                    echo "<th><h4>Frequency</h4></th>";
                                    echo "<th><h4>Calls&nbsp;&nbsp;&nbsp;&nbsp;</h4></th>";                                    
                                    echo "<th><h4>City</h4></th>";
                                    echo "<th><h4>State/Province&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Date</h4></th>";
									echo "<th><h4>Miles</h4></th>";
									echo "<th><h4>Prop method</h4></th>";
                                    
                                echo "</tr>";
                                
								while($row = mysqli_fetch_array($result)){

					
									$filename = $row['Calls'];
			
									$filename = strtolower($filename);
			
									
			
									 
			
									
									$images = array_map('basename', glob('audio/{'.$filename.'}*', GLOB_BRACE)); 
			
									
										$filename = $images[0]; 
									
			
									echo "<tr>";
									echo "<td>" . "<h2>" . $row['Freq']. "</h2>" . "</td>";
									if(count($images) > 0) {
									
									// if (file_exists('audio/'.$filename)) 
									
									echo "<td><a href='audio/$filename'>"."<h2>" . $row['Calls']. "</h2>" . "</a>". "</td>";
									}
									else
									echo "<td>" . "<h2>" . $row['Calls']. "</h2>" . "</td>";
									
									echo "<td>" . "<h2>" . $row['City']. "</h2>" . "</td>";
										
										echo "<td>" . "<h2>" . $row['State']. "</h2>" . "</td>";
										echo "<td>" . "<h2>" . $row['Date']. "</h2>" . "</td>";
										echo "<td>" . "<h2>" . $row['Miles']. "</h2>" . "</td>";
										echo "<td>" . "<h2>" . $row['Prop']. "</h2>" . "</td>";
										
									echo "</tr>";
									
								}
								echo "</table>";
								// Close result set
								mysqli_free_result($result);
							} else{
								echo "No rekkids matching your query were found.";
							}
							} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
							}}}
                     
                    // Close connection
                    mysqli_close($link);
               
        ?>

        


      
            </center></p>
					</section>
				</div>
			</div>

		<!-- Footer -->
			<!-- Footer -->
			<div id="footer">
				<div class="container">

					<center><a href="contact.html">Click here</a> to contact Nick with any questions.</center>

					<!-- Copyright -->
						<div class="copyright">
							Copyright 2020 Nick Langan CSC 4797 Villanova University.
						</div>

				</div>
			</div>

	</body>
</html>