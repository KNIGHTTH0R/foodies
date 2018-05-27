<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../media/img/favicon.ico">

    <title>Foodies Dashboard</title>


  </head>

  <body data-spy="scroll" data-target=".sidebar-sticky" data-offset="50">

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
                        <span data-feather="home"></span>
                        View homepage</>
                </a>
                </li>
              <li class="nav-item">
                <a class="nav-link active" href="#viewreservations">
                  <span data-feather="activity"></span>
                  View Reservations  <span class="sr-only">(current)</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#reservation">
                  <span data-feather="shopping-cart"></span>
                  Make a Reservation
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#registeredusers">
                  <span data-feather="users"></span>
                  Registered Users
                </a>
              </li><li class="nav-item">
                <a data-toggle="modal" data-target="#logout" class="nav-link" href="#">
                  <span data-feather="feather"></span>
                 Log out
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>

    </div>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Foodies Dashboard</h1>

          </div>

            <h2>Reservations made</h2>
           <div class="reservations" id="viewreservations">
               <?php
               ////ΤΥΠΩΝΕΙ RESERVATIONS

               mysqli_select_db($mysqli,"reservations");
               $sql="SELECT * FROM reservations ";
               $result = mysqli_query($mysqli,$sql);?>

               <form action="delete.php" method="POST">
                   <div class="form-group">
               <?php
               echo" <table class='table'>
                              <tr> 
                                  <th>Reservation ID</th>
                                  <th>Name</th>
                                  <th>Last Name</th>
                                  <th>Date</th>
                                  <th>Time</th>
                                  <th>Phone</th>
                                  <th>User ID</th>
                                  <th>SELECT</th>
                                  
                              </tr>
                            </div>";

               while($row = mysqli_fetch_array($result) and !empty($result)) {
                   echo "<tr>";
                   echo "<td>" . $row['res_id'] . "</td>";
                   echo "<td>" . $row['Name'] . "</td>";
                   echo "<td>" . $row['lname'] . "</td>";
                   echo "<td>" . $row['date'] . "</td>";
                   echo "<td>" . $row['TIME'] . "</td>";
                   echo "<td>" . $row['phone'] . "</td>";
                   echo "<td>" . $row['id'] . "</td>";
                   echo "<td> <input type='checkbox' name=res[] value=". $row['res_id']." </td>";


                   echo "</tr>";

               }
               echo "</table>";

               ?>
                   </div>
                   <!-- Modal footer class για το button position-->
                   <div class="modal-footer">
                   <input type="submit" class="btn btn-danger" value="Delete" ></div>
               </form>
           </div>


            <hr>
            <br>
            <h2>Make a reservation</h2>
            <hr>

                <!-- FORM ΓΙΑ RESERVATION-->
            <div class="modal-body" id="reservation">
                <form action="reservation.php" method="POST">
                        <label for="number" class="col-form-label">Tables:</label>
                        <input type="number" class="form-control" name="tables" id="tables">

                    <div class="form-group">
                        <label for="time" class="col-form-label">Date:</label>
                        <input type="date" class="form-control" name="date"  id="date">
                    </div>
                    <div class="form-group">
                        <label for="time" class="col-form-label">Time:</label>
                        <input type="time" class="form-control" name="time" id="time">
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="text" class="col-form-label">Last Name:</label>
                        <input type="text" class="form-control" name="lname" id="lname">
                    </div>
                    <div class="form-group">
                        <label for="number" class="col-form-label">Phone:</label>
                        <input type="number" class="form-control" name="phone" id="phone">
                    </div>
                </div>



            <!-- Modal footer class για το button position-->
            <div class="modal-footer">

                <input type="submit" class="btn btn-success" value="Submit">
            </div>

                    <hr>
                    <br>
                    <h2>Registered Users</h2>
                    <hr>

                    <?php
                    //ΤΥΠΩΝΕΙ USERS
                    mysqli_select_db($mysqli,"users");
                    $sql="SELECT * FROM users ";
                    $result = mysqli_query($mysqli,$sql);?>

                                <div class="body" id="registeredusers">
                                    <?php
                                    echo" <table class='table'>
                              <tr> 
                                  <th>User ID</th>
                                  <th>Email</th>
                                  <th>Name</th>
                                  <th>Last Name</th>
                                  <th>Phone</th>
                                  <th>Address</th>
                                 
                              </tr>
                                         ";

                                    while($row = mysqli_fetch_array($result) and !empty($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['lname'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";

                                        echo "</tr>";

                                    }
                                    echo "</table>";

                                    ?>






                                </div>

            </form>
            </div>








    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="Logout form" aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginform">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="log_out.php" method="post">
                        <div class="form-group">
                            Are you sure you want to Log out?
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-success" value="Yes">
                </div>
            </form>
            </div>
            </div>
        </div>


    </main>

  </body>
</html>
