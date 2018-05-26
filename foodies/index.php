<?php 
include_once 'register.php';
include_once 'inc/functions.php';
//ξεκιναει session
sec_session_start();
//error report off για τα notices
error_reporting(0);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="media/img/favicon.ico">


  <?php 
  
  $msg= "";
  $error= "";
 //τσεκαρει αν υπαρχει καποιο μυνημα
  if (isset( $_GET['msg'])){
    $msg= filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_STRING);
    echo <<< ALERT
    <div id="message">
    <div style=" position:fixed; 
    top: 0; 
    left: 0; 
    width: 100%;
    z-index:9999; 
    border-radius:0"><div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> $msg
    </div></div></div>
ALERT;
  }  
  if (isset( $_GET['error'])){
    $error= filter_input(INPUT_GET, 'error', FILTER_SANITIZE_STRING);
    echo <<< ALERT
    <div id="message">
    <div style=" position:fixed; 
    top: 0; 
    left: 0; 
    width: 100%;
    z-index:9999; 
    border-radius:0"><div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> $error
    </div></div></div>
ALERT;
  }  
  
  ?>
  <title>FOODIES RESTAURANT</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">

 <link href="css/carousel.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">




  <header id="Home">

    <nav class="navbar navbar-expand-md navbar-dark fixed-top foodies-custom ">

      <a class="navbar-brand" id="logo" href="index.php">
        <img src="media/img/burger.png"> </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link" href="#Home">Home


            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#Menu">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#Reservation">Make a reservation</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#Location">Location</a>
          </li>
          

        </ul>

          <?php if(login_check($mysqli) == true and $_SESSION['admin_val']== 1){
            //τσεκαρει αν εισαι αντμιν
              echo <<<admin
              
              <button type="button" data-toggle="modal" data-target="#myreservations" class=" btn btn-outline-danger btn-custom ">My Reservations</button>
              <a type="button" href="dashboard.php"  class=" btn btn-outline-danger btn-custom ">Admin Dashboard</a>
              <button type="button" data-toggle="modal" data-target="#logout" class=" btn btn-outline-warning btn-custom">Log out</button>
              

admin;


          }
          //τσεκαρει αν εισαι user και εχεις κανει login
          else if(login_check($mysqli) == true) {
          echo <<< loggedin
     <button type="button" data-toggle="modal" data-target="#myreservations" class=" btn btn-outline-danger btn-custom ">My Reservations</button>
    <button type="button" data-toggle="modal" data-target="#logout" class=" btn btn-outline-warning btn-custom">Log out</button>
    
loggedin;
         } else {
             echo <<< loggedout
<button type="button" data-toggle="modal" data-target="#login" class=" btn btn-outline-warning btn-custom">Log in</button>
 <button type="button" data-toggle="modal" data-target="#register" class=" btn btn-outline-danger btn-custom ">Register</button>
loggedout;
} ?>






      </div>
    </nav>

  </header>


  <main role="main">

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner ">
        <div class="carousel-item active">
          <video class="second-slide" width="100%" height="auto"  autoplay loop>

            <source src="media/PATTY_1800x760.mp4" type="video/mp4">
            <source src="media/PATTY_1800x760.ogg" type="video/ogg">

          </video>
          <div class="container">
            <div class="carousel-caption text-left">
              <h1>Come and taste!</h1>
              <p>Our mouth watering burgers, click the button below and register to our website in order to make a reservation</p>
              <p>
                <a class="btn btn-lg btn-warning" data-toggle="modal" data-target="#register" href="#" role="button">Sign up today</a>
              </p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img class="second-slide" src="media/img/2.gif" alt="">


          <div class="container">
            <div class="carousel-caption">
              <h1>Make a reservation NOW</h1>
              <p>to enjoy our best quality meats cooked by great chefs in an amazing and warm environment.</p>
              <p>
                <a class="btn btn-lg btn-warning"  data-toggle="modal" data-target="#reservation" href="#" role="button">Make a reservation</a>
              </p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img class="third-slide" src="media/img/esoteriko.jpg" alt="Inside our restaurant">
          <div class="container">
            <div class="carousel-caption text-right">
              <h1>Amazing location and great  atmosphere</h1>
              <p>Come and see for yourself check out our location by clicking below.</p>
              <p>
                <a class="btn btn-lg btn-warning" href="#Location" role="button">Location</a>
              </p>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>


    <!-- Marketing messaging and featurettes
      ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row" id="Menu">
        <div class="col-lg-4">
          <img class="rounded-circle" src="media/img/burger.jpg" alt="Burgers" width="140" height="140">
          <h2>Burgers & Steaks</h2>

          <p>
            <a class="btn btn-secondary" data-toggle="modal" data-target="#menuburgers" href="#" role="button">View menu &raquo;</a>
          </p>
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="rounded-circle" src="media/img/drinks.jpg" alt="Drinks" width="140" height="140">
          <h2>Drinks</h2>

          <p>
            <a class="btn btn-secondary" data-toggle="modal" data-target="#menudrinks" href="#" role="button">View menu &raquo;</a>
          </p>
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="rounded-circle" src="media/img/sweets.jpg" alt="Sweets" width="140" height="140">
          <h2>Sweets</h2>

          <p>
            <a class="btn btn-secondary" href="#"data-toggle="modal" data-target="#menusweets" role="button">menu &raquo;</a>
          </p>
        </div>
        <!-- /.col-lg-4 -->
      </div>
      <!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette" id="Reservation">
        <div class="col-md-7">
          <h2 class="featurette-heading">Book a table now!<br>
            <span class="text-muted">Make a reservation now  </span>
          </h2>
          <p class="lead">enjoy the premium service that you deserve. </p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-fluid mx-auto rounded-circle " data-src="holder.js/500x500/auto" src="media/img/book-a-table.gif"
            alt="make a reservation!">

        </div>
        <button type="button" data-toggle="modal" data-target="#reservation" class=" btn btn-warning btn-custom">Make a reservation</button>
      </div>



      <hr class="featurette-divider">
        <div class="row featurette" id="Location">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">Oh yeah, it's that good.
                    <span class="text-muted">See for yourself.</span>
                </h2>
                <p class="lead">Our address is 351 N 78th St, Omaha, NE 68114, USA <br> we expect to see you soon.</p>
            </div>
            <div class="col-md-5 order-md-1">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2999.1270386595197!2d-96.03845228417015!3d41.262569779275914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87938d129b9579c3%3A0x120307d78b83352e!2sFoodies!5e0!3m2!1sen!2sgr!4v1527268921574" width="400" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>


      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->

    </div>
    <!-- /.container -->


    <!-- FOOTER -->
    <footer class="container">
      <p class="float-right">
        <a href="#">Back to top</a>
      </p>
      <p>&copy; 2018 Foodies &middot;

      </p>
    </footer>
  </main>





  <!--- Modal για το Login -->


  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="Login form" aria-hidden="true">

    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginform">Login Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="inc/process_login.php" method="post">
            <div class="form-group">
              <label for="email" class="col-form-label">E-mail:</label>
              <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
              <label for="password" class="col-form-label">Password:</label>
              <input type="password" class="form-control" name="password"id="password">
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" value="Sign in">
        </div>
        </form>
      </div>
    </div>

  </div>



  <!--- Modal για το Log out -->


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


  <!--- Modal για το Register -->


  <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="Registration form" aria-hidden="true">

    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registration-title">Registration Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="POST">
            <div class="form-group">
              <label for="email" class="col-form-label">E-mail:</label>
              <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
              <label for="password" class="col-form-label">Password:</label>
              <input type="password" class="form-control" name="password"  id="password">
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Name:</label>
              <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
              <label for="lastname" class="col-form-label">Last name:</label>
              <input type="text" class="form-control" name="lname" id="lname">
            </div>
            <div class="form-group">
              <label for="number" class="col-form-label">Phone number:</label>
              <input type="number" class="form-control" name="phone" id="phone">
            </div>
            <div class="form-group">
              <label for="Address" class="col-form-label">Address:</label>
              <input type="text" class="form-control" name="address" id="address">
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" value="Register">
        </div>
      </form>
      </div>
    </div>
  </div>

  <!-- Modal για myreservations -->
  <?php
                        //κανει select τα reservations με το userid του χρηστη
                          $user_id =$_SESSION['user_id'];
                          mysqli_select_db($mysqli,"reservations");
                          $sql="SELECT * FROM reservations WHERE id = '".$user_id."'";
                          $result = mysqli_query($mysqli,$sql);?>

  <div class="modal fade bd-example-modal-lg" id="myreservations" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="myreservations title">My Reservations</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                        <?php
                        //τυπώνει τα reservations με το user id του χρηστη
                          echo" <table class='table'>
                              <tr> 
                                  <th>Reservation ID</th>
                                  <th>Tables</th>
                                  <th>Name</th>
                                  <th>Last Name</th>
                                  <th>Date</th>
                                  <th>Time</th>
                                  <th>User ID</th>
                              </tr>
                            </div>";

                        while($row = mysqli_fetch_array($result) and !empty($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['res_id'] . "</td>";
                            echo "<td>" . $row['tables'] . "</td>";
                            echo "<td>" . $row['Name'] . "</td>";
                            echo "<td>" . $row['lname'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['TIME'] . "</td>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "</tr>";

                        }
                        echo "</table>";

                          ?>




              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

              </div>

          </div>
      </div>

  </div>
  </div>

  <!-- Modal για Μενου -->
  <div class="modal fade bd-example-modal-lg" id="menuburgers" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="myreservations title">Burgers & Steaks</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <div class="modal-body ">

                  <table class='table'>
                  <tr>
                      <th> Burgers & Steaks</th>
                      <th>Prices</th>


                    <tr>
                        <td> Foodies Special Burger</td><td>$10</td>
                    </tr>
                      <tr>  <td> Bacon Burger</td> <td>$5</td></tr>
                      <tr> <td> Triple Onion Burger</td><td>$10</td></tr>
                      <tr>  <td> BBQ Ribs</td><td>$15</td></tr>
                      <tr> <td> Green Pepper Steak </td><td>$14</td></tr>
                      <tr>  <td> Foodies Special Steak </td><td>$20</td></tr>
                      </tr>
                      <tr>




                  </table>

                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                  </div>

              </div>
          </div>

      </div>
  </div>


  <!-- Modal για Μενου -->
  <div class="modal fade bd-example-modal-lg" id="menudrinks" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="myreservations title">Drinks</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <div class="modal-body ">

                  <table class='table'>
                      <tr>
                          <th> Drinks</th>
                          <th>Prices</th>


                      <tr>
                          <td> Beers variety</td><td>$10</td>
                      </tr>
                      <tr>  <td> Local Whine rose</td> <td>$10</td></tr>
                      <tr> <td> Local Whine red</td><td>$10</td></tr>
                      <tr>  <td> Coca cola</td><td>$5</td></tr>
                      <tr> <td> Sprite </td><td>$5</td></tr>
                      <tr>  <td> Water bottle </td><td>$3</td></tr>
                      </tr>
                      <tr>




                  </table>

                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                  </div>

              </div>
          </div>

      </div>
  </div>

  <!-- Modal για Μενου -->
  <div class="modal fade bd-example-modal-lg" id="menusweets" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="myreservations title">Sweets</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <div class="modal-body ">

                  <table class='table'>
                      <tr>
                          <th> Sweets</th>
                          <th>Prices</th>


                      <tr>
                          <td>Moist Chocolate cake</td><td>$7</td>
                      </tr>
                      <tr>  <td> Queen of Pudding</td> <td>$7</td></tr>
                      <tr> <td>  Panna Cotta</td><td>$5</td></tr>
                      <tr>  <td> Caramel cream</td><td>$5</td></tr>
                      <tr> <td> IceCream variety  </td><td>$3</td></tr>
                      <tr>  <td>  Milkshakes variety</td><td>$4</td></tr>
                      </tr>
                      <tr>




                  </table>

                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                  </div>

              </div>
          </div>

      </div>
  </div>



  <!-- Modal για reservation -->

<?php
//τσεκαρει αν εχεις κανει login ωστε να κανεις reservation
if(login_check($mysqli) == true) { echo <<< res
 <div class="modal fade" id="reservation" tabindex="-1" role="dialog" aria-labelledby="Reservation form" aria-hidden="true">

          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="reservation-title">Reservation Form</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="reservation.php" method="POST">
                          <div class="form-group">
                              <label for="number" class="col-form-label">Tables:</label>
                              <input type="number" class="form-control" name="tables" id="tables">
                          </div>
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
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-success" value="Submit">
                  </div>
                  
                    </form>
              </div>
          </div>
      </div>
res;

}else {echo <<< res
<div class="modal fade" id="reservation" tabindex="-1" role="dialog" aria-labelledby="Reservation form" aria-hidden="true">

          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="reservation-title">Reservation Form</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <p>You have to log in in order to make a reservation</p>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      
                  </div>

              </div>
          </div>
      </div>
res;


}?>

























    <!-- Custom JavaScript
    ================================================== -->



    <!-- Bootstrap core JavaScript
    ================================================== -->



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
      crossorigin="anonymous">
    </script>
</body>

</html>