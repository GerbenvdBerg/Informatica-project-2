<!doctype html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content="">
  <meta property="og:image" content="">

  <link rel="icon" href="/favicon.ico" sizes="any">
  <link rel="icon" href="/icon.svg" type="image/svg+xml">
  <link rel="apple-touch-icon" href="icon.png">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">

  <link rel="manifest" href="site.webmanifest">
  <meta name="theme-color" content="#fafafa">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>	
</head>

<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="https://inloggen.somtoday.nl/login?0" target="_blank">Navbar/Somtoday</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li  class="nav-item">
          <a class="nav-link" href="https://maken.wikiwijs.nl/96699/Enigma__Informatica_hv456#!page-3025155" target=”_blank”>Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target=”_blank”>Suprise</a>
        </li>
        <div class="dropdown">
	        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
		        Dropdown 
	       </button>
	        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
		        <li><a class="dropdown-item" href="https://www.wikipedia.org/" target="_blank">Wikipedia</a></li>
		        <li><a class="dropdown-item" href="https://www.wikipedia.org/" target="_blank">Another action</a></li>
		        <li><a class="dropdown-item" href="https://pcpartpicker.com/" target="_blank">Pcpartpicker</a></li>
	       </ul>
	      </div>
      </ul>
    </div>
  </div>
</nav>

<!-- creates table-->
    <h1>Task list</h1>
    <table class="table">
        <thead>
            <tr>
                <th width= 100>Task</th>
                <th>Task description</th>
                <th width= 25>Task id </th>
                <th width= 250>Categorie</th>
                <th>Finished?</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "to-do2";

            // Create connection
            $connection = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($connection->connect_error) {
                die("connection failed: " . $connection->connect_error);
            }
            // read selected rows from database table
            $sql = "SELECT Categorie_name, Task_name, Task_description, Task_id, Finished
            FROM tasks LEFT JOIN categories ON tasks.Categories_id = categories.Categorie_id
            ORDER BY Finished DESC;";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }
            $resultcheck = mysqli_num_rows($result);
            
          ?>
            <!--read data of each row -->
            <?php while($row = $result->fetch_assoc()): ?>
              <tr>
                <!-- Edit here for extra rows --> 
                <td width="30"><?php echo $row['Task_name'] ?></td>
                <td width="100"><?php echo $row['Task_description']?></td>
                <td width="25"><?php echo $row['Task_id'] ?></td>
                <td><?php echo $row['Categorie_name']?></td>
                <td width="10">
                  <form method="POST" action="/informatica2/Includes/Javascript.php" onsubmit="">
                    <input type="hidden"   value="0_<?php echo $row['Task_id']?>" name="status">
                    <input type="checkbox" value="1_<?php echo $row['Task_id']?>" name="status" <?php if($row['Finished'] == 0) print("checked")?> onchange="this.form.submit()"/>           
                  </form>      
                </td>
                <!-- inbetween this -->
              </tr>
            <?php endwhile;?>
    </table>
  <!--add new task area-->
<h3>Create new task:</h3>
<table class="table table-bordered">
  <form action="includes/create.php" method="post">
    <thead class="table-dark">
      <tr>
        <!-- more columns here--> 
        <th>Task name</th>
        <th>Task description</th>
        <th>Categorie</th>
        <!-- more columns above -->
      </tr>
    </thead>
      <!-- more rows --> 
      <td><input type="text" name="Task_name"/></td>
      <td><input type="text" name="Task_description"/></td>
      <td><select name="Categories_id">
            <option value="">None</option>
            <option value="5  ">Homework</option>
            <option value="2">Housework</option>
            <option value="3">Job</option>
            <option value="4">Other</option>
      </select><br/></td>
      <!-- more rows above -->
      <tr>
        <td></td>
        <td></td>
        <td><input type="submit" value="Voeg nieuwe taak toe"/></td>      
      </tr>
  </form>
</table>


<?php
//Shows first and last name in first select clause
$sql6= "SELECT Task_id, Task_name, Task_description FROM tasks ORDER BY Task_id;";
$result3 = mysqli_query($connection,$sql6);
$resultcheck3 = mysqli_num_rows($result3);
?>

<!-- Creates select area for delete area -->
<h3>Delete task:</h3>
<table class="table table-bordered">   
  <form action="includes/delete.php" method="post">
    <thead class="table-dark">
      <tr>
        <th>task to delete</th>
      </tr>
    </thead>
      <td>
        <select name="task_del">
          <?php if ($result3->num_rows > 0):?>
            <?php while($row3 = $result3->fetch_assoc()):?>
              <option value="<?php echo $row3['Task_id']?>"><?php echo $row3['Task_name'].": ".$row3['Task_description'] ?></option>
            <?php endwhile;?>  
          <?php endif;?>
        </select>
        <input type="submit" value="Delete task"/>
      </td>  
  </form>
</table> 
</body>
</html>