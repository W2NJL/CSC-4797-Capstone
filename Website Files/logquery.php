<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Villanova Climatological Data Project</title>
<!-- 

Highway Template

https://templatemo.com/tm-520-highway

-->
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/fontAwesome.css">
        <link rel="stylesheet" href="css/light-box.css">
        <link rel="stylesheet" href="css/templatemo-style.css">

        <link href="https://fonts.googleapis.com/css?family=Kanit:100,200,300,400,500,600,700,800,900" rel="stylesheet">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>

<body>

    <nav>
        <div class="logo">
            <a href="index.html">Villanova <em>Climatological Data Project</em></a>
        </div>
      <div class="menu-icon">
        <span></span>
      </div>
    </nav>

    <?php
 include 'database.php';
 

 if($_SERVER["REQUEST_METHOD"] == "POST"){

  if(isset($_POST["Record"])){
    $record = $_POST["Record"];
    
      
    
  }

  else{
    $record = ""; 
  $year = $_POST["Year"];
  $month = $_POST["Month"];
  if(isset($_POST["Day"])){
      $day = $_POST["Day"];
    }
}

if(!isset($_POST["Record"])){
if(isset($_POST["Day"])){
  $date = "$month $day, $year";
    }
    else
    $date = "$month $year";

  if($month=='January')
    $month="1";
  
  if($month=='February')
    $month="2";

    if($month=='March')
    $month="3";

    if($month=='April')
    $month="4";

    if($month=='May')
    $month="5";

    if($month=='June')
    $month="6";

    if($month=='July')
    $month="7";

    if($month=='August')
    $month="8";

    if($month=='September')
    $month="9";

    if($month=='October')
    $month="10";

    if($month=='November')
    $month="11";

    if($month=='December')
    $month="12";
  }
  

    if((isset($_POST["Day"]))){
      $sql = "SELECT * FROM `philadelphia` WHERE Year ='$year' AND Month ='$month' AND Day ='$day'";
      if($result = mysqli_query($link, $sql)){
        $row = mysqli_fetch_array($result);
        if($row['Snowfall']>0){
        echo "<div class='phillysnow-page-heading'>";
      }
        else if
        ($row['Precip']>0){
          echo "<div class='phillyrain-page-heading'>";
        }       

          else
        echo "<div class='philly-page-heading'>";}
    }
       else if((isset($_POST["Record"]))){
        if($record=="snow"){
          echo "<div class='phillysnow-page-heading'>";
        }
        else if 
        ($record=="rain"){
          echo "<div class='phillyrain-page-heading'>";
       }
       
       else
       echo "<div class='philly-page-heading'>";}
       else 
       echo "<div class='philly-page-heading'>";
        }
        ?>
        <div class="container">
            <div class="heading-content">
                    
                <h1>Philadelphia <em>Climate Data</em></h1>
            </div>
        </div>
    </div>
    <div class="services"><div class="joe">
            <center>
              <?php
              
                
                ?>
              <?php
                            

                     

                           

                        if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  
                        }
                        if(isset($_POST["Day"])){
                      $sql = "SELECT * FROM `philadelphia` WHERE Year ='$year' AND Month ='$month' AND Day ='$day'";

              
                      if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                          echo "<table>";
                                echo "<tr>";
                                    echo "<th><h4>High Temperature&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Low Temperature&nbsp;&nbsp</h4></th>";
                                    echo "<th><h4>Average Temperature&nbsp;&nbsp</h4></th>";
                                    echo "<th><h4>Departure from normal&nbsp;&nbsp</h4></th>";
                                    echo "<th><h4>Total precipitation&nbsp;&nbsp</h4></th>";
                                    echo "<th><h4>Total snowfall&nbsp;&nbsp</h4></th>";
                                echo "</tr>";
                                echo "<h2>$date</h2>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                
                                    echo "<td>" . "<h2>" . $row['Max']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['Min']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['Avg']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['AvgDeparture']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['Precip']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['Snowfall']. "</h2>" . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            // Close result set
                            mysqli_free_result($result);
                        } else{
                            echo "No records matching your query were found.";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }}
                    
                    if(isSet($_POST["Record"])){
                      if($record=="max"){
                      $sql = "SELECT * FROM `philadelphia` ORDER BY Max DESC LIMIT 10";

                      
                      if($result = mysqli_query($link, $sql)){
                        
                        if(mysqli_num_rows($result) > 0){
                          
                          
                          echo "<table>";
                                echo "<tr>";
                                echo "<th><h4>Month&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Day&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Year of occurrence&nbsp;&nbsp;&nbsp;&nbsp;</h4></th>";                                    
                                    echo "<th><h4>High Temperature&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Low Temperature&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Average Temperature&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Departure from normal&nbsp;&nbsp;</h4></th>";
                                    
                                echo "</tr>";
                                echo "<h2>Top 10 hottest max temperatures</h2>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td>" . "<h2>" . $row['Month']. "</h2>" . "</td>";
                                echo "<td>" . "<h2>" . $row['Day']. "</h2>" . "</td>";
                                echo "<td>" . "<h2>" . $row['Year']. "</h2>" . "</td>";
                                    
                                    echo "<td>" . "<h2>" . $row['Max']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['Min']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['Avg']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['AvgDeparture']. "</h2>" . "</td>";
                                    
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

                    if($record=="min"){
                      $sql = "SELECT * FROM `philadelphia` ORDER BY Min ASC LIMIT 10";

                      
                      if($result = mysqli_query($link, $sql)){
                        
                        if(mysqli_num_rows($result) > 0){
                          
                          
                          echo "<table>";
                                echo "<tr>";
                                echo "<th><h4>Month&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Day&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Year of occurrence&nbsp;&nbsp;&nbsp;&nbsp;</h4></th>";                                    
                                    echo "<th><h4>High Temperature&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Low Temperature&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Average Temperature&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Departure from normal&nbsp;&nbsp;</h4></th>";
                                    
                                echo "</tr>";
                                echo "<h2>Top 10 coldest min temperatures</h2>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td>" . "<h2>" . $row['Month']. "</h2>" . "</td>";
                                echo "<td>" . "<h2>" . $row['Day']. "</h2>" . "</td>";
                                echo "<td>" . "<h2>" . $row['Year']. "</h2>" . "</td>";
                                    
                                    echo "<td>" . "<h2>" . $row['Max']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['Min']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['Avg']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['AvgDeparture']. "</h2>" . "</td>";
                                    
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

                    if($record=="snow"){
                      $sql = "SELECT * FROM `philadelphia` ORDER BY Snowfall DESC LIMIT 10";

                      
                      if($result = mysqli_query($link, $sql)){
                        
                        if(mysqli_num_rows($result) > 0){
                          
                          
                          echo "<table>";
                                echo "<tr>";
                                echo "<th><h4>Month&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Day&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Year of occurrence&nbsp;&nbsp;&nbsp;&nbsp;</h4></th>";                                    
                                    echo "<th><h4>High Temperature&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Low Temperature&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Average Temperature&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Departure from normal&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Total snowfall&nbsp;&nbsp;</h4></th>";
                                    
                                echo "</tr>";
                                echo "<h2>Top 10 snowiest days</h2>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td>" . "<h2>" . $row['Month']. "</h2>" . "</td>";
                                echo "<td>" . "<h2>" . $row['Day']. "</h2>" . "</td>";
                                echo "<td>" . "<h2>" . $row['Year']. "</h2>" . "</td>";
                                    
                                    echo "<td>" . "<h2>" . $row['Max']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['Min']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['Avg']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['AvgDeparture']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['Snowfall']. "</h2>" . "</td>";
                                    
                                    
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

                    if($record=="rain"){
                      $sql = "SELECT * FROM `philadelphia` ORDER BY Precip DESC LIMIT 10";
  
                      
                      if($result = mysqli_query($link, $sql)){
                        
                        if(mysqli_num_rows($result) > 0){
                          
                          
                          echo "<table>";
                                echo "<tr>";
                                echo "<th><h4>Month&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Day&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Year of occurrence&nbsp;&nbsp;&nbsp;&nbsp;</h4></th>";                                    
                                    echo "<th><h4>High Temperature&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Low Temperature&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Average Temperature&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Departure from normal&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Total precipitation&nbsp;&nbsp;</h4></th>";
                                    
                                echo "</tr>";
                                echo "<h2>Top 10 days with most precipitation</h2>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td>" . "<h2>" . $row['Month']. "</h2>" . "</td>";
                                echo "<td>" . "<h2>" . $row['Day']. "</h2>" . "</td>";
                                echo "<td>" . "<h2>" . $row['Year']. "</h2>" . "</td>";
                                    
                                    echo "<td>" . "<h2>" . $row['Max']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['Min']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['Avg']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['AvgDeparture']. "</h2>" . "</td>";
                                    echo "<td>" . "<h2>" . $row['Precip']. "</h2>" . "</td>";
                                    
                                    
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
                  
                  }

                  
                 

                    else if(!isset($_POST["Day"])){
                      $sql = "SELECT * FROM `philadelphia` WHERE Year ='$year' AND Month ='$month'";

              
                      if($result = mysqli_query($link, $sql)){
                        $row_cnt = mysqli_num_rows($result); 
                        
                        if(mysqli_num_rows($result) > 0){
                            echo "<table>";                            
                                echo "<tr>";
                                echo "<th><h4>Day of Month&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>High Temperature&nbsp;&nbsp;</h4></th>";
                                    echo "<th><h4>Low Temperature&nbsp;&nbsp</h4></th>";
                                    echo "<th><h4>Average Temperature&nbsp;&nbsp</h4></th>";
                                    echo "<th><h4>Departure from normal&nbsp;&nbsp</h4></th>";
                                    echo "<th><h4>Total precipitation&nbsp;&nbsp</h4></th>";
                                    echo "<th><h4>Total snowfall&nbsp;&nbsp</h4></th>";
                                echo "</tr>";
                                echo "<h2>$date</h2>";
                                $max=0;
                                $min=0;
                                $avg=0;
                                $avgdept=0;
                                $precip=0;
                                $snowfall=0; 

                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td>" . "<h2>" . $row['Day']. "</h2>" . "</td>";
                                echo "<td>" . "<h2>" . $row['Max']. "</h2>" . "</td>";
                                echo "<td>" . "<h2>" . $row['Min']. "</h2>" . "</td>";
                                echo "<td>" . "<h2>" . $row['Avg']. "</h2>" . "</td>";
                                echo "<td>" . "<h2>" . $row['AvgDeparture']. "</h2>" . "</td>";
                                echo "<td>" . "<h2>" . $row['Precip']. "</h2>" . "</td>";
                                echo "<td>" . "<h2>" . $row['Snowfall']. "</h2>" . "</td>";
                                echo "</tr>";
                                
                                $max+= $row['Max'];
                                $min+= $row['Min'];
                                $avg+= $row['Avg'];
                                $avgdept+= $row['AvgDeparture'];
                                $precip+= $row['Precip'];
                                $snowfall+= $row['Snowfall'];
                            }
                            echo "<tr>";
                            echo "<td>" . "<br/>"; 
                            echo "</tr>";  
                            echo "<tr>";
                            echo "<td>" . "<h3>Totals</h3>";
                            echo "<td class='avg'>" . "<h2>" . number_format((float)$max/$row_cnt, 1, '.', ''). "</h2>" . "</td>";
                            echo "<td class='avg'>" . "<h2>" . number_format((float)$min/$row_cnt, 1, '.', ''). "</h2>" . "</td>";
                            echo "<td class='avg'>" . "<h2>" . number_format((float)$avg/$row_cnt, 1, '.', ''). "</h2>" . "</td>";
                            echo "<td class='avg'>" . "<h2>" . number_format((float)$avgdept/$row_cnt, 1, '.', ''). "</h2>" . "</td>";
                            echo "<td class='avg'>" . "<h2>" . number_format((float)$precip, 2, '.', ''). "</h2>" . "</td>";
                            echo "<td class='avg'>" . "<h2>" . number_format((float)$snowfall, 1, '.', ''). "</h2>" . "</td>";
                            echo "</tr>";
                            echo "</table>";
                            
                            // Close result set
                            mysqli_free_result($result);
                        } else{
                            echo "No records matching your query were found.";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }}

                     
                    // Close connection
                    mysqli_close($link);
               
        ?>

        


      
            </center>
                  </div>
            </div>
        
                    
                


    <footer>
        <div class="container-fluid">
            <div class="col-md-12">
                <p>Copyright &copy; 2019 Sam Rizzo & Nick Langan CSC 2053
    
    | All data collected from <a href="http://scacis.rcc-acis.org/">SC ACIS</a></p>
            </div>
        </div>
    </footer>


     <!-- Modal button -->
     <div class="popup-icon">
      <button id="modBtn" class="modal-btn"><img src="img/contact-icon.png" alt=""></button>
    </div>  

    <!-- Modal -->
    <div id="modal" class="modal">
      <!-- Modal Content -->
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h3 class="header-title">Say hello to <em>Villanova Climatological Data</em></h3>
          <div class="close-btn"><img src="img/close_contact.png" alt=""></div>    
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <div class="col-md-6 col-md-offset-3">
            <form id="contact" action="contact.php" method="post">
                <div class="row">
                    <div class="col-md-12">
                      <fieldset>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Your name..." required="">
                      </fieldset>
                    </div>
                    <div class="col-md-12">
                      <fieldset>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Your email..." required="">
                      </fieldset>
                    </div>
                    <div class="col-md-12">
                      <fieldset>
                        <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your message..." required=""></textarea>
                      </fieldset>
                    </div>
                    <div class="col-md-12">
                      <fieldset>
                        <button type="submit" id="form-submit">Send Message Now</button> 
                        <!-- 120519: Is the above correct?-->
                      </fieldset>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    

    <section class="overlay-menu">
      <div class="container">
        <div class="row">
          <div class="main-menu">
              <ul>
                  <li>
                      <a href="index.html">Home</a>
                  </li>
                  <li>
                        <a href="philly.php">Philadelphia</a>
                    </li>
                  <li>
                        <a href="cleveland.php">Cleveland</a>
                    </li>
                    <li>
                        <a href="tampa.php">Tampa</a>
                    </li>
                  <li>
                        <a href="dallas.php">Dallas</a>
                    </li>
                    <li>
                        <a href="boulder.php">Boulder</a>
                    </li>
                  <li>
                        <a href="grandforks.php">Grand Forks</a>
                    </li>
                    <li>
                        <a href="seattle.php">Seattle</a>
                    </li>
                  <li>
                        <a href="losangeles.php">Los Angeles</a>
                    </li>
                    <li>
                        <a href="anchorage.php">Anchorage</a>
                    </li>
                  <li>
                      <a href="about.html">About</a>
                  </li>
                                   
              </ul>
             
          </div>
        </div>
      </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="js/vendor/bootstrap.min.js"></script>
    
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

      </div>
</body>
</html>

