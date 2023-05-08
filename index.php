<?php
  require_once "config/init.php";
  include "partials/header.php";
?>
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">
                    Enjoy Your Vacation With Us
                </h1>
                <p class="fs-4 text-white mb-4 animated slideInDown">
                    "Discover Surigao del Sur's best tourist attractions from
                    beaches to waterfalls, caves to mountains on our website.
                    Explore Surigao del Sur with us today!"
                </p>
                <div class="position-relative w-75 mx-auto animated slideInDown">
                    <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                        placeholder="Eg: Waterfalls, beaches, caves, mountains" />
                    <button type="button"
                        class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2"
                        style="margin-top: 7px">
                        Search
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Navbar & Hero End -->

<!-- About Start -->
<div id="about" class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px">
                <div class="position-relative h-100">
                    <img class="img-fluid position-absolute w-100 h-100" src="img/about.jpg" alt=""
                        style="object-fit: cover" />
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <h6 class="section-title bg-white text-start text-primary pe-3">
                    About Us
                </h6>
                <h2 class="mb-4">
                    Welcome to <span class="text-primary">Surigao Del Sur</span>
                </h2>
                <p class="mb-4">
                    Surigao del Sur is a province in the Caraga Region of the
                    Philippines, known for its stunning natural attractions and rich
                    cultural heritage.
                </p>
                <p class="mb-4">
                    Our website aims to showcase the best tourist spots in Surigao del
                    Sur, including its picturesque beaches, majestic waterfalls,
                    enchanting rivers, and fascinating caves. We also provide useful
                    information about the province's history, culture, and local
                    delicacies, as well as practical tips for travelers who want to
                    explore this hidden gem in Mindanao. Whether you're a nature
                    lover, an adventure seeker, or a curious traveler, Surigao del Sur
                    has something to offer that will leave a lasting impression on
                    you.
                </p>
                <a class="btn btn-primary py-3 px-5 mt-2" href="">Read More</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Package Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">
                Packages
            </h6>
            <h1 class="mb-5">Awesome Destination</h1>
        </div>
        <div class="row g-4 justify-content-center">
            <!-- This loop is going loop the data randomly and limit the data to 3 -->
            <?php foreach($data = Destination::action()->get_order_by("destination", "RAND()", 3) as $d) :
                  $cat_id = $d->cat_id;
                  $category = Category::action()->get_by_id_category($cat_id);
                  $gallery = Gallery::action()->get_by_touristId($d->id);
                  pr($gallery);
              ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="package-item">
                    <div class="overflow-hidden card-img">
                        <img class="img-fluid" src="<?=$gallery[0]->image1;?>" alt="" />
                    </div>
                    <div class="d-flex border-bottom">
                        <small class="flex-fill text-center border-end py-2"><i
                                class="fa fa-map-marker-alt text-primary me-2"></i>Hinatuan</small>
                        <small class="flex-fill text-center border-end py-2"><i
                                class="fa fa-calendar-alt text-primary me-2"></i><?=ucwords($category[0]->name);?></small>
                        <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>Tour
                            Guide</small>
                    </div>
                    <div class="text-center p-4">
                        <h3 class="mb-0"><?=$d->name;?></h3>
                        <div class="mb-3">
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                        </div>

                        <div class="d-flex justify-content-center mb-2">
                            <a href="singletour.php?id=<?=$d->id;?>" class="btn btn-sm btn-primary px-3 rounded-pill"
                                style="border-radius: 30px 0 0 30px">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <a class="btn btn-primary py-3 px-5 mt-2" href="destination.php">See More</a>
            </div>
        </div>
    </div>
</div>
<!-- Package End -->

<!-- Destination Start -->
<div class="container-xxl py-5 destination">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">
                Gallery
            </h6>
            <h1 class="mb-5">Satisfied Tourists</h1>
        </div>
        <div class="row g-3">
            <div class="col-lg-7 col-md-6">
                <div class="row g-3">
                    <?php  
                    $gallery = Gallery::action()->select();  
                    $destination = Destination::action()->get_by_id_destination($gallery[0]->touristId);
                    ?>

                    <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                        <a class="position-relative d-block overflow-hidden"
                            href="singletour.php?id=<?=$destination[0]->id;?>">
                            <img class="img-fluid" src="<?=$gallery[0]->image1;?>" alt="" />

                            <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                                <?=$destination[0]->name;?>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                        <a class="position-relative d-block overflow-hidden"
                            href="singletour.php?id=<?=$destination[0]->id;?>">
                            <img class="img-fluid" src="<?=$gallery[0]->image2;?>" alt="" />
                            <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                                <?=$destination[0]->name;?>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                        <a class="position-relative d-block overflow-hidden"
                            href="singletour.php?id=<?=$destination[0]->id;?>">
                            <img class="img-fluid" src="<?=$gallery[0]->image3;?>" alt="" />

                            <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                                <?=$destination[0]->name;?>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px">
                <a class="position-relative d-block h-100 overflow-hidden"
                    href="singletour.php?id=<?=$destination[0]->id;?>">
                    <img class="img-fluid position-absolute w-100 h-100" src="<?=$gallery[0]->image4;?>" alt=""
                        style="object-fit: cover" />
                    <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                        <?=$destination[0]->name;?>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Destination Start -->

<!-- Service Start -->
<!-- <div class="container-xxl py-5">
      <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
          <h6 class="section-title bg-white text-center text-primary px-3">
            Services
          </h6>
          <h1 class="mb-5">Our Services</h1>
        </div>
        <div class="row g-4">
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                <h5>WorldWide Tours</h5>
                <p>
                  Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita
                  amet diam
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-hotel text-primary mb-4"></i>
                <h5>Hotel Reservation</h5>
                <p>
                  Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita
                  amet diam
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-user text-primary mb-4"></i>
                <h5>Travel Guides</h5>
                <p>
                  Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita
                  amet diam
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-cog text-primary mb-4"></i>
                <h5>Event Management</h5>
                <p>
                  Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita
                  amet diam
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                <h5>WorldWide Tours</h5>
                <p>
                  Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita
                  amet diam
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-hotel text-primary mb-4"></i>
                <h5>Hotel Reservation</h5>
                <p>
                  Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita
                  amet diam
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-user text-primary mb-4"></i>
                <h5>Travel Guides</h5>
                <p>
                  Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita
                  amet diam
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
            <div class="service-item rounded pt-3">
              <div class="p-4">
                <i class="fa fa-3x fa-cog text-primary mb-4"></i>
                <h5>Event Management</h5>
                <p>
                  Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita
                  amet diam
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
<!-- Service End -->

<!-- Process Start -->
<!-- <div class="container-xxl py-5">
      <div class="container">
        <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
          <h6 class="section-title bg-white text-center text-primary px-3">
            Process
          </h6>
          <h1 class="mb-5">3 Easy Steps</h1>
        </div>
        <div class="row gy-5 gx-4 justify-content-center">
          <div
            class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp"
            data-wow-delay="0.1s"
          >
            <div class="position-relative border border-primary pt-5 pb-4 px-4">
              <div
                class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow"
                style="width: 100px; height: 100px"
              >
                <i class="fa fa-globe fa-3x text-white"></i>
              </div>
              <h5 class="mt-4">Choose A Destination</h5>
              <hr class="w-25 mx-auto bg-primary mb-1" />
              <hr class="w-50 mx-auto bg-primary mt-0" />
              <p class="mb-0">
                Tempor erat elitr rebum clita dolor diam ipsum sit diam amet
                diam eos erat ipsum et lorem et sit sed stet lorem sit
              </p>
            </div>
          </div>
          <div
            class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp"
            data-wow-delay="0.3s"
          >
            <div class="position-relative border border-primary pt-5 pb-4 px-4">
              <div
                class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow"
                style="width: 100px; height: 100px"
              >
                <i class="fa fa-dollar-sign fa-3x text-white"></i>
              </div>
              <h5 class="mt-4">Pay Online</h5>
              <hr class="w-25 mx-auto bg-primary mb-1" />
              <hr class="w-50 mx-auto bg-primary mt-0" />
              <p class="mb-0">
                Tempor erat elitr rebum clita dolor diam ipsum sit diam amet
                diam eos erat ipsum et lorem et sit sed stet lorem sit
              </p>
            </div>
          </div>
          <div
            class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp"
            data-wow-delay="0.5s"
          >
            <div class="position-relative border border-primary pt-5 pb-4 px-4">
              <div
                class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow"
                style="width: 100px; height: 100px"
              >
                <i class="fa fa-plane fa-3x text-white"></i>
              </div>
              <h5 class="mt-4">Fly Today</h5>
              <hr class="w-25 mx-auto bg-primary mb-1" />
              <hr class="w-50 mx-auto bg-primary mt-0" />
              <p class="mb-0">
                Tempor erat elitr rebum clita dolor diam ipsum sit diam amet
                diam eos erat ipsum et lorem et sit sed stet lorem sit
              </p>
            </div>
          </div>
        </div>
      </div>
    </div> -->
<!-- Process Start -->

<!-- Team Start -->
<!-- <div class="container-xxl py-5">
      <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
          <h6 class="section-title bg-white text-center text-primary px-3">
            Travel Guide
          </h6>
          <h1 class="mb-5">Meet Our Guide</h1>
        </div>
        <div class="row g-4">
          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="team-item">
              <div class="overflow-hidden">
                <img class="img-fluid" src="img/team-1.jpg" alt="" />
              </div>
              <div
                class="position-relative d-flex justify-content-center"
                style="margin-top: -19px"
              >
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-twitter"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-instagram"></i
                ></a>
              </div>
              <div class="text-center p-4">
                <h5 class="mb-0">Full Name</h5>
                <small>Designation</small>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="team-item">
              <div class="overflow-hidden">
                <img class="img-fluid" src="img/team-2.jpg" alt="" />
              </div>
              <div
                class="position-relative d-flex justify-content-center"
                style="margin-top: -19px"
              >
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-twitter"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-instagram"></i
                ></a>
              </div>
              <div class="text-center p-4">
                <h5 class="mb-0">Full Name</h5>
                <small>Designation</small>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
            <div class="team-item">
              <div class="overflow-hidden">
                <img class="img-fluid" src="img/team-3.jpg" alt="" />
              </div>
              <div
                class="position-relative d-flex justify-content-center"
                style="margin-top: -19px"
              >
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-twitter"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-instagram"></i
                ></a>
              </div>
              <div class="text-center p-4">
                <h5 class="mb-0">Full Name</h5>
                <small>Designation</small>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
            <div class="team-item">
              <div class="overflow-hidden">
                <img class="img-fluid" src="img/team-4.jpg" alt="" />
              </div>
              <div
                class="position-relative d-flex justify-content-center"
                style="margin-top: -19px"
              >
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-twitter"></i
                ></a>
                <a class="btn btn-square mx-1" href=""
                  ><i class="fab fa-instagram"></i
                ></a>
              </div>
              <div class="text-center p-4">
                <h5 class="mb-0">Full Name</h5>
                <small>Designation</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
<!-- Team End -->

<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h6 class="section-title bg-white text-center text-primary px-3">
                Testimonial
            </h6>
            <h1 class="mb-5">Our Tourist Say!!!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel position-relative">
            <div class="testimonial-item bg-white text-center border p-4">
                <div class="overflow-hidden testimonial-img bg-white rounded-circle shadow p-1 mx-auto mb-3">
                    <img src="img/francine.jpg" class="rounded-circle bg-white" />
                </div>
                <h5 class="mb-0">Francine Diaz</h5>
                <p>Tandag, Philippines</p>
                <p class="mb-0">
                    Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam
                    amet diam et eos. Clita erat ipsum et lorem et sit.
                </p>
            </div>
            <div class="testimonial-item bg-white text-center border p-4">
                <div class="overflow-hidden testimonial-img bg-white rounded-circle shadow p-1 mx-auto mb-3">
                    <img src="img/team-2.jpg" class="rounded-circle bg-white" />
                </div>
                <h5 class="mb-0">Rose Godinez</h5>
                <p>Tandag, Philippines</p>
                <p class="mt-2 mb-0">
                    Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam
                    amet diam et eos. Clita erat ipsum et lorem et sit.
                </p>
            </div>
            <div class="testimonial-item bg-white text-center border p-4">
                <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="img/testimonial-3.jpg"
                    style="width: 80px; height: 80px" />
                <h5 class="mb-0">Jomar Godinez</h5>
                <p>Tandag, Philippines</p>
                <p class="mt-2 mb-0">
                    Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam
                    amet diam et eos. Clita erat ipsum et lorem et sit.
                </p>
            </div>
            <div class="testimonial-item bg-white text-center border p-4">
                <div class="overflow-hidden testimonial-img bg-white rounded-circle shadow p-1 mx-auto mb-3">
                    <img src="img/team-3.jpg" class="rounded-circle bg-white" />
                </div>
                <h5 class="mb-0">Will Smith</h5>
                <p>Tandag, Philippines</p>
                <p class="mt-2 mb-0">
                    Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam
                    amet diam et eos. Clita erat ipsum et lorem et sit.
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->
<!-- Booking Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="booking p-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-6 text-white">
                    <h6 class="text-white text-uppercase">Booking</h6>
                    <h1 class="text-white mb-4">Online Booking</h1>
                    <p class="mb-4">
                        Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.
                        Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit.
                    </p>
                    <p class="mb-4">
                        Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.
                        Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit,
                        sed stet lorem sit clita duo justo magna dolore erat amet
                    </p>
                    <a class="btn btn-outline-light py-3 px-5 mt-2" href="">Read More</a>
                </div>
                <div class="col-md-6">
                    <h1 class="text-white mb-4">Book A Tour</h1>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-transparent" id="name"
                                        placeholder="Your Name" />
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control bg-transparent" id="email"
                                        placeholder="Your Email" />
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating date" id="date3" data-target-input="nearest">
                                    <input type="text" class="form-control bg-transparent datetimepicker-input"
                                        id="datetime" placeholder="Date & Time" data-target="#date3"
                                        data-toggle="datetimepicker" />
                                    <label for="datetime">Date & Time</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select bg-transparent" id="select1">
                                        <option value="1">Destination 1</option>
                                        <option value="2">Destination 2</option>
                                        <option value="3">Destination 3</option>
                                    </select>
                                    <label for="select1">Destination</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control bg-transparent" placeholder="Special Request"
                                        id="message" style="height: 100px"></textarea>
                                    <label for="message">Special Request</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-outline-light w-100 py-3" type="submit">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Booking Start -->

<!-- Footer Start -->
<?php
  include "partials/footer.php"
?>