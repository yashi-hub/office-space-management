<?php 
session_start();
if(!isset($_SESSION["usertype"]))
{
	header("location:autherror.php");
	die();
}
$ut=$_SESSION["usertype"];
$e1=$_SESSION["enrollmentno"];
if($ut!="admin")
{
	header("location:autherror.php");
	die();
}
?>

<html>
<head>

<title>Globalshala</title><link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/javascript" href="https://code.jquery.com/jquery-3.4.1.min.js">
<link rel="stylesheet" type="text/javascript" href="https://cdn.jsdelivr.net/npm/chart.js@2.8.0">
<link rel="stylesheet" type="text/css" href="kota.css">
<link rel="stylesheet" type="text/javascript" href="kota.js">
<link rel="stylesheet" type="text/css" 
href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>
<aside class="side-nav" id="show-side-navigation1">
  <i class="fa fa-bars close-aside hidden-sm hidden-md hidden-lg" data-close="show-side-navigation1"></i>
  <div class="heading">


<?php 
require_once("mylib.php");

$photo=check_photo($e1);
if($photo=="no")
{
	?>
    <form method="post" enctype="multipart/form-data" action="uploadphoto1.php">
    <p>Photo<input type="file" name="F1"  /></p>
       <p><input style="color:#000;" type="submit" name="B1"  /></p>
    </form>
    <?php
}
else
{
	?>
    <p>
    <img src="<?php echo $photo; ?>" width="100" height="123"   />
    </p>
   <a href="changephoto1.php">Change</a>
    <?php
}
?>





    <div class="info">

<?php 
$cn=mysqli_connect("localhost","root","","globalshala");
if(!$cn)
{
	echo "Unable to connect";
	die();
}
$sql="select * from admindata where enrollmentno='$e1'";

//Fetch data
$result=mysqli_query($cn,$sql);

//Check number of rows
$n=mysqli_num_rows($result);

if($n>0)
{
	//show data
	$rw=mysqli_fetch_array($result);
	$a=$rw["name"];
	$b=$rw["branch"];
	$c=$rw["contact"];
	?>
	<p>
    	<h3><?php echo $a; ?> <br/></h3>
     
	</p>

	<?php
	
}
else
{
	?>
	<h2>No data found</h2>
	<?php
}
?>



      
    </div>
  </div>
  
  <ul class="categories">
    <li><i class="fa fa-home fa-fw" aria-hidden="true"></i><a href="aboutus.php"> About us</a>
          </li>
    <li><i class="fa fa-address-book fa-fw"></i><a href="admintodolist.php">Update To Do list</a>
          </li>
	<li><i class="fa fa-support fa-fw"></i><a href="adminsubmissions.php"> Submissions</a>
          </li>

    <li><i class="fa fa-envelope fa-fw"></i><a href="adminquery.php"> Query/Answer</a>
      
      
    </li>
    
    <li><i class="fa fa-institution fa-fw"></i><a href="addemployee.php"> Add/Remove Employee</a>
      
    </li>
    <li><i class="fa fa-recycle fa-fw"></i><a href="adminrating.php"> Feedback</a>
      
    </li>
    
    
    
  </ul>
</aside>
<section id="contents">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <i class="fa fa-align-right"></i>
        </button>
        <a class="navbar-brand" href="adminhome.php">my<span class="main-color">Dashboard</span></a>
      </div>
      <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="adminprofile.php" class="dropdown-toggle"  role="button" aria-haspopup="true" 
            aria-expanded="false">My profile <span class="caret"></span></a>
          <li><a href="logout.php"><i class="fa fa-power-off"></i><span>logout</span></a></li>
         
        </ul>
      </div>
    </div>
  </nav>

  <div class="welcome">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="content">
                        <h2>Welcome to Feedback</h2>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="welcome">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="content">
            <h2>Ratings </h2>
<?php 
$cn=mysqli_connect("localhost","root","","globalshala");
if(!$cn)
{
	echo "Unable to connect";
	die();
}
$sql="select * from feedback where enrollmentno='$e1'";
//Fetch data
$q1="select * from feedback";
$result=mysqli_query($cn,$sql);
$result1=mysqli_query($cn,$q1);

//Check number of rows
$n=mysqli_num_rows($result);
if($n>0)
{
	echo "You have already Submitted";
}
else if($e1=='420@gmail.com')
{
	while($rw=mysqli_fetch_array($result1))
	{
		$a=$rw["name"];
		$b=$rw["branch"];
		$c=$rw["employee"];
		$d=$rw["details"];
		
		?>
        <p style="font-size:24px; font-family:'MS Serif', 'New York', serif;">
        	Hr Name : <?php echo $a; ?> <br/>
            Branch : <?php echo $b;?></a> <br/>
            Employee name : <?php echo $c; ?> <br/>
            Details : <?php echo $d; ?> <br/>
            
            
            
        </p>
        <hr/><?php
	}

	
}
else
{
	?>	
			
  			<form id="form1" name="form1" method="post" action="adminfeedback1.php">
  <table style="border-collapse: separate;
    border-spacing: 0 1em;">
  <tr>
  <th style="color:#FFF; font-family:'MS Serif', 'New York', serif;">Enrollment No</th>
    <td><label for="t1"></label>
    <input readonly value="<?php echo $e1; ?>" type="text" name="t1" required/></td>
    </tr>
    <tr>
  <th style="color:#FFF; font-family:'MS Serif', 'New York', serif;">Hr Name</th>
    <td><label for="t1"></label>
    <input readonly value="<?php echo $a; ?>" type="text" name="t2" required/></td>
    </tr>
    <tr>
  <th style="color:#FFF; font-family:'MS Serif', 'New York', serif;">Hr branch</th>
    <td><label for="t1"></label>
    <input readonly value="<?php echo $b; ?>" type="text" name="t3" required/></td>
    </tr>
    <tr>
  <th style="color:#FFF; font-family:'MS Serif', 'New York', serif;">Hr Contact</th>
    <td><label for="t1"></label>
    <input readonly value="<?php echo $c; ?>" type="text" name="t4" required/></td>
    </tr>
   <tr>
           <th style="color:#FFF; font-family:'MS Serif', 'New York', serif;"> 
		  Name</th><td><input type="text" name="t5" id="t5" 
          required/></td></tr>
		  <tr>
           <th style="color:#FFF; font-family:'MS Serif', 'New York', serif;"> 
		  
          Details</th><td><textarea cols="30" rows="10" input 
          type="text" name="t6" id="t6" required/></textarea></td>
          </tr>         
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
              <tr>
  <td>
    <input type="submit" name="b1" id="b1" value="Submit" />
  </td></tr>
</form>
</table>
<?php
}
?>
</div>
        </div>
      </div>
    </div>
  </div>
	  <div class="welcome">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="content">
          
  	
	</p>
</div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>