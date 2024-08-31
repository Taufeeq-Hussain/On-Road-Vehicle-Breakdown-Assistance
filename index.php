<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    echo '<div>You are logged in as, ' . $_SESSION['username'] . '!</div>';
}

// Service Request Php Code

include 'config_request.php';

      if(isset($_POST['submit'])) {
          $name = mysqli_real_escape_string($conn, $_POST['name']);
          $email = mysqli_real_escape_string($conn, $_POST['email']);
          $phone = mysqli_real_escape_string($conn, $_POST['phone']);
          $pickup = mysqli_real_escape_string($conn, $_POST['pickup']);
          $vehicle_no = mysqli_real_escape_string($conn, $_POST['vehicle_no']);
          $vehicle_type = $_POST['vehicle_type'];
          $message = mysqli_real_escape_string($conn, $_POST['message']);

          $insert = "INSERT INTO request_form(name, email, phone, pickup, vehicle_no, vehicle_type, message) VALUES('$name','$email','$phone','$pickup','$vehicle_no','$vehicle_type','$message')";
          mysqli_query($conn, $insert);
          header('location:index.php');
          exit();
      }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./CSS/style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
    integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
    crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


  <title>vehiCare</title>

<style>
.bg { 
    background-image:url("./images/car.png");
    height: 90vh;
    width: 100%;
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    /* opacity: 0.7; */
    margin-bottom:1px;
}


div.bg h1{
    text-align: center;
    font-size: 2rem;
    padding-top: 300px;
    color: darkred;
    font-weight: bolder;
}

div.bg p{
    text-align: center;
    font-size: 1.5rem;
    padding-top: 15px;
    padding-bottom: 10px;
    color: darkred;
    font-weight: bolder;
}


a.btn{
    background-color: antiquewhite;
    color: black;
    border: 2px solid black;
    border-radius: 5px;
    padding: 6px;
    margin-top:15px;
}


a.btn:hover{
    background-color: rgb(209, 193, 171);
    color: black;
    border: 2px solid black;
    border-radius: 5px;
    padding: 7px;
}



</style>
</head>

<body>

<!--Nav Bar Left Elements -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
            <a class="navbar-brand" href="#" id="logo">
              <img src="./images/caricon.png" alt="" width="60" height="50">
              vehi<span>Care</span>
            </a>
                <!-- <a class="navbar-brand" href="./index.php">ORVBA</a> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">AboutUs</a>
                        </li>
                        
                    </ul>
                    <!-- Nav Bar Right Elements -->
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item1 dropdown d-flex">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            LogIn
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="./admindashboard/welcome.php">Admin</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="./login.php">User</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="./Mechanic Registration/mechanic_login.php">Mechanic</a></li>
                            </ul>
                        </li>
                        <li class="nav-item2 dropdown d-flex">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            SignUp
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- <li><a class="dropdown-item" href="#">Admin</a></li> -->
                                <!-- <li><hr class="dropdown-divider"></li> -->
                                <li><a class="dropdown-item" href="./register.php">User</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="./Mechanic Registration/mechanic_reg.php">Mechanic</a></li>
                            </ul>
                            <ul class="navbar-nav ml-auto">
                              <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                                <li class="nav-item active">
                                  <a class="nav-link" href="#"><img src="https://img.icons8.com/metro/26/000000/guest-male.png"> Welcome <?php echo $_SESSION['username']; ?></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="./logout.php">Logout</a>
                                </li>
                              <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>




        <!--  Home Page Bg  -->
        <!-- <div class="container"> -->
        <div class="bg text-center">
            <h1>On-Road Vehicle Breakdown Assistance</h1>
            <p>We will take care of your vehicle</p>
            <!-- <a class="btn" href="#">Send Service Request</a> -->

                         <!-- Hero Section -->
            <section class="hero">
                <div class="hero-content">
                    <!-- <h1>Welcome to vehiCare</h1>
                    <p>Your one-stop solution for all vehicle-related services.</p> -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceRequestModal">
                        Send Service Request
                    </button>
                </div>
            </section>
      </div>

    <!-- Service Request Modal -->
    
    

      <div class="modal fade" id="serviceRequestModal" tabindex="-1" role="dialog" aria-labelledby="serviceRequestModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="serviceRequestModalLabel">Service Request Form</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <!-- Form fields go here -->
                      <form action="" method="post">
                          <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                          </div>
                          <div class="form-group">
                              <label for="email">Email address</label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                          </div>
                          <div class="form-group">
                              <label for="phone">Phone number</label>
                              <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                          </div>
                          <div class="form-group">
                              <label for="pickup">PickUp Location</label>
                              <input type="text" class="form-control" id="pickup" name="pickup" placeholder="Enter Pickup Location" required>
                          </div>
                          <div class="form-group">
                              <label for="vehicle_type">Vehicle Type</label>
                              <div class="dropdown d-inline-flex p-2 bd-highlight">
                                  <select name="vehicle_type">
                                      <option value="">Choose</option>
                                      <option value="2 Wheeler">2 Wheeler</option>
                                      <option value="3 Wheeler">3 Wheeler</option>
                                      <option value="4 Wheeler">4 Wheeler</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="vehicle_no">Vehicle Number</label>
                              <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" placeholder="Enter your Vehicle Number" required>
                          </div>
                          <div class="form-group">
                              <label for="message">Message</label>
                              <textarea class="form-control" id="message" name="message" rows="3" placeholder="Enter your message"></textarea>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>

      <!-- Scripts -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>



        <!-- </div> -->
        <!-- </div> -->




<!-- Carousel  -->

  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">

      <div id="grad" class="carousel-item active">
        <div id="grad1" class="carousel-caption d-none d-md-block">
          <h1 id="ar">Engine Repair <span></span></h1>
          <p id="carousel">Your engine light is an indication that something on your car needs attention. Your car may
            have some issues, and it’s time to call a service center.</p>
          <button id="cta">Send Service Request</button>
        </div>
      </div>
      <div id="grad2" class="carousel-item">
        <div class="carousel-caption d-none d-md-block">

          <h1 id="ar">Accidental Repair <span></span></h1>
          <p id="carousel">vehiCare is an expert in car body repair and collision repair for all types of cars. Our body
            shop guarantees the best professional services in town.</p>
          <a href="#services"><button id="cta">Our Services</button></a>
        </div>
      </div>
      <div id="grad3" class="carousel-item">
        <div class="carousel-caption d-none d-md-block">
          <h1 id="ar">Dent and Paint <span></span></h1>
          <p id="carousel">All products and services used by us are of the highest quality to ensure the proper paint
            texture, gloss, and finish is rendered to your car. We go out of our way to make sure the process is smooth
            and hassle-free, keeping your satisfaction as our top priority.</p>
          <button id="cta">More..</button>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <section id="services">
    <div class="service container">
      <div class="service-top">
        <h1 class="section-title">SERV<span>i</span>CES</h1>
      </div>
      <div class="service-bottom">
        <div class="item">
          <img src="./images/maintainance.png" id="maintainance" alt="">
          <h3>Periodic Maintainance Service</h3>
          <p>Periodic maintenance requires maintenance tasks to be performed at set time intervals while your vehicle is
            operational. Periodic maintenance services are planned ahead of time and are performed regardless of whether
            signs of deterioration show up or not.</p>
        </div>
        <div class="item1">
          <img src="./images/engineRepair(i).png" alt="">
          <h3>Engine Repairs</h3>
          <p>Your engine light is an indication that something on your car needs attention. Your car may have some
            issues, and it’s time to take it to a service center.</p>
        </div>
        <div class="item2">
          <img src="./images/car_crash.png" alt="">
          <h3>Accidental Repairs</h3>
          <p>vehiCare is an expert in car body repair and collision repair for all types of cars. Our body shop
            guarantees the best professional services in town. We have established a reputation, and many insurers
            respect us. Call or visit our service center at vehiCare for a free estimate on any accident repair or auto
            body repair.</p>
        </div>
        <div class="item3">
          <img src="./images/electric(i).png" alt="">
          <h3>Electrical Repairs</h3>
          <p>It’s extremely important to get your car’s electrical problem professionally diagnosed to avoid causing any
            electrical problems.Whether it’s your car’s built-in electrical system warning light, or if you have noticed
            problems like smoke, or any of your vehicle’s lights stopped working we can help. At vehiCare, we can
            diagnose what the problem is and offer electrical repair solutions.</p>
        </div>
        <div class="item4">
          <img src="./images/car-battery.png" alt="">
          <h3>Battery Replacement</h3>
          <p>A dead car battery is a result of failing to turn off electrical accessories in your vehicle, or if its old
            and needs a replacement Our technicians are trained to replace the battery within minutes. They are fast and
            professional experts.Call us if you need a professional car battery replacement service in the Hyderabad
            area.
          </p>
        </div>
        <div class="item5">
          <img src="./images/tyre.png" alt="">
          <h3>Tyre Replacement</h3>
          <p>We are committed to providing top-quality auto repairs and services. If you want the best deal on tyres,
            vehicare is the place to come. We offer the best prices in town on tyres, brakes, wheel alignment, and
            balancing, suspension, tune-ups, and all other auto services.</p>
        </div>
      </div>
    </div>
    </div>
  </section>
  <div class="section" id="abot">
    <div class="container">
      <div class="content-section">
        <div class="title">
          <h1>ABOUT <span>US</span></h1>
        </div>
        <div class="content">
          <p>vehiCare’s mission is to enable premium quality care for your luxury car service at affordable
            pricing
            .
            We ensure real time updates for complete car care needs with a fair and transparent pricing mechanism.
            Skilled
            technicians, working at our state of the art German technology workshop further ensure that only genuine OEM
            parts
            are used for your car care needs.

            Customer satisfaction is the core of all initiatives at vehiCare. Online appointment scheduling with
            door-step,
            same day pick-up and drop anywhere in Hyderabad is our constant endeavor to maximize customer convenience.
            Our
            commitment stands for reliability and unequalled professionalism to provide dealer quality auto-service at a
            fair
            price.</p>
          <div class="button">
            <a href="">Read More</a>
          </div>
        </div>
      </div>
      <div class="image-section">
        <img src="./images/Auto_Mechanic.jpg" alt="">
      </div>
    </div>
  </div>
  <section id="faq">
    <h2 class="faqtitle">FAQs</h2>
    <div class="faqs">
      <div class="question">
        <h4>What is vehiCare?</h4>
        <span class="arrow">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 42 25">

        <path id="arrow-down" d="M3 3L21 21L39 3"></path>
                <path id="arrow-up" d="M3 3L21 21L39 3"></path>
          <!-- <path id="arrow" d="M3 3L21 21L39 3" stroke="white" stroke-width="4" stroke-linecap="round" /> -->
        </svg>
    </span>
      </div>
      <div class="answer">
        <p>vehicare is your best friend when it comes to any vehicle services! With efficient pricing, highly skilled
          experts, the latest equipment and technology and genuine parts, we bring you a range of services designed to
          keep your car in the best shape.

        </p>
      </div>

      <div class="question">
        <h4>Why should I choose vehiCare?</h4>
        <span class="arrow" >
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 42 25">
        <path id="arrow-down" d="M3 3L21 21L39 3"></path>
                <path id="arrow-up" d="M3 3L21 21L39 3"></path>
          <!-- <path id="arrow" d="M3 3L21 21L39 3" stroke="white" stroke-width="4" stroke-linecap="round" /> -->
        </svg>
    </span>
      </div>
      <div class="answer">
        <p>vehicare brings to your doorstep the best car services and solutions with fast delivery and fair
          pricing. What's more, you can save up to a whopping 40% as compared to what you will spend at Authorised
          Service Centres and Multi-brand workshops

        </p>
      </div>

      <div class="question">
        <h4>How is vehiCare different from other platforms out there?</h4>
        <span class="arrow">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 42 25">

        <path id="arrow-down" d="M3 3L21 21L39 3"></path>
                <path id="arrow-up" d="M3 3L21 21L39 3"></path>
          <!-- <path id="arrow" d="M3 3L21 21L39 3" stroke="white" stroke-width="4" stroke-linecap="round" /> -->
        </svg>
    </span>
      </div>
      <div class="answer">
        <p>At vehicare, we’re not a lead generation focused business – you and your car are our first priorities.
          Satisfied, happy customers with smoothly functioning cars are our goals, and so we believe in being hands-on
          for the complete experience right from procurement of spare parts to the actual servicing, ensuring quality
          control. We send you prompt personalized updates about your car and are completely transparent about the
          pricing and quality of our services.

        </p>


      </div>
      <div class="question">
        <h4>How do I book a service on vehiCare website?</h4>
        <span class="arrow">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 42 25">

        <path id="arrow-down" d="M3 3L21 21L39 3"></path>
                <path id="arrow-up" d="M3 3L21 21L39 3"></path>
          <!-- <path id="arrow" d="M3 3L21 21L39 3" stroke="white" stroke-width="4" stroke-linecap="round" /> -->
        </svg>
    </span>
      </div>
      <div class="answer">
        <p>
          You can call the available service providers, and we will have our experts call you back in no time.
        </p>
      </div>
    </div>
  </section>
  <!-- <script src="/JS/app.js"></script> -->
  <br>
  <!-- <footer class="footer" style="padding: 5%;background-color: #ddd;">
    <div class="footer-left">
      <a href="#" id="logo"><img src="./images/caricon.png" alt="">
        vehi<span>Care</span></a>
    </div>
    <p>vehicare’s mission is to enable premium quality care for your luxury car service at affordable pricing . We
      ensure real-time updates for complete car care needs with a fair and transparent pricing mechanism.</p>
    <div class="socials">
      <a href=""><i class="fab fa-facebook-f fa-2x text-info"></i></a>
      <a href=""><i class="fab fa-twitter fa-2x text-info"></i></a>
      <a href=""><i class="fab fa-instagram fa-2x text-info"></i></a>
      <a href=""><i class="fab fa-linkedin fa-2x text-info"></i></a>
      <a href=""><i class="fab fa-youtube fa-2x text-info"></i></a>
    </div>
    </div>
    <div>
  <div class="footer-left">
    <h2>Services</h2>
    <ul class="box">
      <li><a href="">Periodic Maintenance</a></li>
      <li><a href="">Dent &amp; Paint</a></li>
      <li><a href="">Bumper Repair</a></li>
      <li><a href="">Accidental Repair</a></li>
      <li><a href="">Scratch Removal</a></li>
    </ul>
  </div>
  <div class="footer-right">
    <h2>Links</h2>
    <ul class="box">
      <li><a href="">Home</a></li>
      <li><a href="">About</a></li>
      <li><a href="">FAQ</a></li>
      <li><a href="">Blog</a></li>
      <li><a href="">Contact Us</a></li>
      <li><a href="">Privacy Policy</a></li>
    </ul>
  </div>
</div>

    <div class="footer-bottom">
      <p>Copyright &copy 2023 vehiCare. All rights reserved</p>
    </div>
  </footer> -->




<!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Get connected with us on social networks:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>Company name
          </h6>
          <p>
            Here you can use rows and columns to organize your footer content. Lorem ipsum
            dolor sit amet, consectetur adipisicing elit.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Products
          </h6>
          <p>
            <a href="#!" class="text-reset">Angular</a>
          </p>
          <p>
            <a href="#!" class="text-reset">React</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Vue</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Laravel</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="#!" class="text-reset">Pricing</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Settings</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Orders</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Help</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            info@example.com
          </p>
          <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
          <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2021 Copyright:
    <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->





  <script>
    var prevScrollPos = window.pageYOffset;
    var navbar = document.querySelector(".navbar");

    window.onscroll = function () {
      var currentScrollPos = window.pageYOffset;

      if (prevScrollPos > currentScrollPos) {
        navbar.style.top = "0";
      } else {
        navbar.style.top = "-100px";
      }

      prevScrollPos = currentScrollPos;
    };

// Get all the question elements
const questions = document.querySelectorAll('.question');

// Add click event listener to each question
questions.forEach(question => {
  const arrow = question.querySelector('svg');
  const answer = question.nextElementSibling;

  // Toggle the answer when clicked on the arrow
  arrow.addEventListener('click', () => {
    answer.classList.toggle('active');
  });
});


  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

</body>

</html>