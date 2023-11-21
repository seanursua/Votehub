<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="css-icons/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" href="img/votehub-icon.png">
    <!-- plugin for text animation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title>votehub</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" style="color:white" href="#">votehub</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color:#fff; font-size:28px;"></i></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" style="color:white" href="#Home">home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color:white" href="#About">about</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color:white" href="#Contact">contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
  <!-- Slide/Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide d-flex justify-content-center align-items-center" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner" id="Home" data-bs-interval="7000">
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/img1.png" class="d-block w-100" alt="img1">
                <div class="carousel-caption justify-content-center align-items-center">
                    <h5 class="animate__animated animate__backInLeft">Election Made Easy</h5>
                    <p class="animate__animated animate__bounceInRight" style="animation-delay: .6s">Create an election for your your school or organization in minutes.</p>
                    <a href="registration" id="signupOrg" 
                    class="btn my-3 text-white rounded-pill btn-outline-primary shadow-sm animate__animated animate__fadeInUp"
                    style="animation-delay: .9s"> Create a Free Election</i></a>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/img2.jpg" class="d-block w-100" alt="img2">
                <div class="carousel-caption">
                    <h6 class="animate__animated animate__lightSpeedInLeft" style="animation-delay: .4s">Your Election. 
                        <span class="animate__animated animate__flipInX" style="animation-delay: 1.3s">Anywhere. </span>
                        <span class="animate__animated animate__flipInX" style="animation-delay: 1.7s"> Anytime.</span>
                    </h6>
                    <p class="animate__animated animate__fadeInUp"style="animation-delay: 1.7s">Already a Member?
                    <a href="login" id="loginOrg" class="btn my-3 text-white rounded-pill btn-outline-primary shadow-sm">Login as Organization <i class="fas fa-sign-in-alt"></i></a>
                    </p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/img4.jpg" class="d-block w-100" alt="img4">
                <div class="carousel-caption">
                    <h5 class="animate__animated animate__zoomInUp" style="animation-delay: .6s">Vote Without Regrets</h5>
                    <p class="animate__animated animate__fadeInUp" style="animation-delay: 1s">Ready to vote?
                    <a href="loginVoter" id="loginVoter" class="btn my-3 text-white rounded-pill btn-outline-primary shadow-sm">Login as Voter <i class="fas fa-sign-in-alt"></i></a>
                    </p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- About -->
    <section id="About">
        <div class="container" data-aos="fade-up" data-aos-duration="500">
            <h2 class="animate__animated animate__fadeInUp">About</h2>
            <hr class="animate__animated animate__fadeInUp" style="animation-delay: .6s">
            <div class="about-container">
                <div class="row about-content">
                    <div class="col-lg-4">
                        <p class="animate__animated animate__fadeInUp" style="animation-delay: .7s">
                        The VoteHub voting system was started by 5 IT student researchers from Polytechnic University
                        of the Philippines San Juan Campus as a requirement for the Capstone Project 1. 
                        The goal is to help the PUP San Juan Campus student organizations to have a better officer 
                        election for the next future candidates and voters.
                        </p>
                        <p class="animate__animated animate__fadeInUp" style="animation-delay: 1.3s">
                        The better and improved election will happen with the help of this new system that was 
                        developed by these 5 IT students. The organizations will be able to create a voting system 
                        via online for faster voting and releasing of result.
                        </p>
                    </div>
                    <div class="col-lg-8">
                        <div class="laptop" data-aos="fade-left" data-aos-duration="800">
                            <img src="img/overview-votehub.png" class="laptop-img" alt="Votehub-Dashboard"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Mission & Vision Section -->
    <section id="MAV">
        <div class="container" data-aos="fade-up" data-aos-duration="500">
            <h2 class="animate__animated animate__fadeInUp">Mission and Vision</h2>
            <hr class="animate__animated animate__fadeInUp" style="animation-delay: .6s">
            <div class="MAV-container">
                <div class="row MAV-content">
                    <div class="col-lg-6 mb-5">
                        <img src="img/it-team.jpg" data-aos="fade-right" class="mb-4 h-100 w-100" alt="IT-Team"/>
                    </div>
                    <div class="col-lg-6">
                        <h3 data-aos="fade-left">Mission</h3>
                        <p data-aos="fade-left" class="mb-4">   
                        Our mission is to create an online voting platform that promotes safe, 
                        secure, and trouble-free elections by incorporating extra security 
                        features and user-friendly functions into our website.
                        </p>
                        <h3 data-aos="fade-left">Vision</h3>
                        <p data-aos="fade-left">
                        Our vision is to be one of the pioneers of providing fair and open elections online.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Features Section-->
    <section id="Features">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <h2 class="animate__animated animate__fadeInUp d-flex justify-content-center mb-3" tyle="animation-delay: 0.4s">OUR WEBSITE FEATURES</h2>
            <div class="features-container">
                <div class="row features-content">
                    <div class="col-lg-4" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                            <i class="fas fa-key text-main fs-1 d-flex justify-content-center mb-2"></i>
                            <h4 class="text-main fw-bold d-flex justify-content-center">Secure Voting</h4>
                            <p class="text-main d-flex justify-content-center text-center">
                                Each voter has a unique "Voter ID" and "Voter Key" and can only vote once.
                            </p>
                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                            <i class="far fa-file-excel text-main fs-1 d-flex justify-content-center mb-2"></i>
                            <h4 class="text-main fw-bold d-flex justify-content-center">Import Voters</h4>
                            <p class="text-main d-flex justify-content-center text-center">
                                Save time by importing your voters from a CSV file.
                            </p>
                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="3000">
                            <i class="fas fa-chart-pie text-main fs-1 d-flex justify-content-center mb-2"></i>
                            <h4 class="text-main fw-bold d-flex justify-content-center">Results Tabulation</h4>
                            <p class="text-main d-flex justify-content-center text-center">
                                Election results are automatically calculated and presented with beautiful charts.
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section -->
    <section id="Team">
        <div class="container" data-aos="fade-up" data-aos-duration="500">
            <h2 class="animate__animated animate__fadeInUp d-flex justify-content-center mb-4">MEET OUR TEAM</h2>
            <div class="team-container">
                <div class="row team-content d-flex justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="my-card" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000"> 
                            <img class="my-card-img" src="img/Peter.png" />
                            <div class="my-card-body trainer-card-body">
                                <h5>Peter Jan Regala</h5>
                                <p class="text-muted">Quality Assurance and Team Leader</p>
                                <div class="social-icons">
                                    <a href="https://www.facebook.com/purge21.sss" target="__blank"><i class="fab fa-facebook"></i></a>
                                    <a href="https://github.com/Peter-031" target="__blank"><i class="fab fa-github"></i></a>
                                    <a href="https://www.linkedin.com/in/peter-regala-375bb8211/" target="__blank"><i class="fab fa-linkedin"></i></a>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="my-card" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1500"> 
                            <img class="my-card-img" src="img/Sean.jpg" />
                            <div class="my-card-body trainer-card-body">
                                <h5>Sean Martin Ursua</h5>
                                <p class="text-muted">Front-end Developer</p>
                                <div class="social-icons"> 
                                    <a href="https://www.facebook.com/seanursua/" target="__blank"><i class="fab fa-facebook"></i></i></a> 
                                    <a href="https://github.com/seanursua" target="__blank"><i class="fab fa-github"></i></a> 
                                    <a href="https://www.linkedin.com/in/sean-martin-ursua-aa5a2b1b9/" target="__blank"><i class="fab fa-linkedin"></i></a>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="my-card" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000"> 
                            <img class="my-card-img" src="img/Jericho.jpg" />
                            <div class="my-card-body trainer-card-body">
                                <h5>Jericho Vega</h5>
                                <p class="text-muted">Back-end Developer</p>
                                <div class="social-icons"> 
                                    <a href="https://www.facebook.com/jericho.vega.71" target="__blank"><i class="fab fa-facebook"></i></a> 
                                    <a href="https://github.com/No-Spacing" target="__blank"><i class="fab fa-github"></i></a> 
                                    <a href="https://www.linkedin.com/in/jericho-vega-3a636a223/" target="__blank"><i class="fab fa-linkedin"></i></a>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row team-content d-flex justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="my-card" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500"> 
                            <img class="my-card-img" src="img/Michael.jpg" />
                            <div class="my-card-body trainer-card-body">
                                <h5>Michael Angelo Regalado</h5>
                                <p class="text-muted">Co-Researcher</p>
                                <div class="social-icons"> 
                                    <a href="https://www.facebook.com/koyamaykel" target="__blank"><i class="fab fa-facebook"></i></a> 
                                    <a href="#"><i class="fab fa-github"></i></a> 
                                    <a href="https://www.linkedin.com/in/mapregalado/" target="__blank"><i class="fab fa-linkedin"></i></a>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="my-card" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="3000">  
                            <img class="my-card-img" src="img/Cedric.jpeg" />
                            <div class="my-card-body trainer-card-body">
                                <h5>Jason Cedric Suspiñe</h5>
                                <p class="text-muted">Co-Researcher</p>
                                <div class="social-icons"> 
                                    <a href="https://www.facebook.com/dio.burningcanyon.965" target="__blank"><i class="fab fa-facebook"></i></a> 
                                    <a href="#"><i class="fab fa-github"></i></a>
                                    <a href="https://www.linkedin.com/in/jason-cedric-suspine-b5387a224/" target="__blank"><i class="fab fa-linkedin"></i></a>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="section-image-background" style="background: url(/votehub/img/img6.jpg) 50% 50% no-repeat; background-size: cover">
    <section class="bg-accent-1-faded">
        <div class="container" style="padding:100px">
            <div class="row align-items-center">
                <div class="col-12 col-sm-9 text-white">
                    <h2 class="mt-0 font-weight-bold">Start building your first election</h2>
                    <p class="lead mb-0">Votehub is one the most easy to use online voting website available. Try it for free.</p>
                </div>
                <div class="col-12 col-sm-3 text-center mt-3 mt-sm-0">
                    <a href="/votehub/organization/login_organization.php" class="btn btn-lg text-white" 
                    style="background-color:#74b72e">Get Started <i class="fas fa-sign-in-alt"></i></a>
                </div>
            </div>
        </div>
    </section>
    </div>
     <!-- Contact Section-->
    <section id="Contact" data-aos="fade-up" data-aos-duration="500">
        <div class="container">
            <h2 class="animate__animated animate__fadeInUp">Contact</h2>
            <hr class="animate__animated animate__fadeInUp" style="animation-delay: .6s">
            <form action="" method="post">
                @csrf
                <div class="contact-container animate__animated animate__fadeInUp" style="animation-delay: .7s">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <h4 class="fw-bold text-uppercase">Drop us a message</h4>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" name="name" type="text" placeholder="Enter your name..." required/>
                                <label for="name">Full name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" required email />
                                <label for="email">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="messenger" name="messenger" type="text" placeholder="Enter your message here..." style="height: 10rem" required></textarea>
                                <label for="message">Message</label>
                            </div>
                            <button class="btn btn-primary btn-md shadow-sm" id="submit" name="submit" type="submit">Send</button>
                        </div>       
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Copyright Section -->
    <div class="copyright py-4 text-center text-white" id="copyright-section">
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-between">
                    <small>Copyright &copy; 2021 Votehub. All Rights Reserved.</small>
                    <small><a href="privacy-policy" target="blank" class="text-decoration-none text-white">Privacy Policy</a> | 
                    <a href="terms-of-service" target="blank" class="text-decoration-none text-white">Terms of Service</a></small>
                </div>
            </div>
        </div>
    </div>
        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
        <script>
            const navbar = document.querySelector('.navbar-dark');
                window.onscroll = () => {
                    if (window.scrollY > 600) {
                        navbar.classList.add('navbar-active');
                    } else {
                        navbar.classList.remove('navbar-active');
                    }
                };
        </script>
        <script>
        function InvalidMsgLetter(textbox) {

            if(textbox.validity.patternMismatch){
                textbox.setCustomValidity('Letters only, no numbers or special characters.');
            }    
            else {
                textbox.setCustomValidity('');
            }
            return true;
        }
        </script>
        <script>
        function InvalidMsgLetterNumberDash(textbox) {

            if(textbox.validity.patternMismatch){
                textbox.setCustomValidity('Letters, numbers and comma(,) only, no other special characters.');
            }    
            else {
                textbox.setCustomValidity('');
            }
            return true;
        }
        </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="text/javascript">
        AOS.init({
          easing: 'ease-in-out-sine'
        });
    </script>
    </body>
</html>