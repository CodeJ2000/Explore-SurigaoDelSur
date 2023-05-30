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
            <?php if(empty($data = Destination::action()->get_by_deleteId_destination(0))): ?>
            <div class="text-center border rounded p-5">
                <h3 class="text-muted">Nothing to display!</h3>
            </div>
            <?php else: ?>
            <?php foreach($data = Destination::action()->get_order_by("destination", "RAND()", 3) as $d) :
                  $cat_id = $d->cat_id;
                  $category = Category::action()->get_by_id_category($cat_id);
              ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="package-item">
                    <div class="overflow-hidden card-img">
                        <img class="img-fluid" src="img/tourist-spot/<?=$d->image1;?>" alt="" />
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
            <?php endif; ?>
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
            <?php  
              ?>
            <?php if(empty(Destination::action()->get_by_deleteId_destination(0))): ?>
            <div class="text-center border rounded p-5">
                <h3 class="text-muted">Nothing to display!</h3>
            </div>
            <?php else: 
              $gallery = Destination::action()->get_order_by("destination", "RAND()", 1);  
            ?>
            <div class="col-lg-7 col-md-6">
                <div class="row g-3">
                    <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                        <a class="position-relative d-block overflow-hidden"
                            href="singletour.php?id=<?=$gallery[0]->id;?>">
                            <img class="img-fluid" src="img/tourist-spot/<?=$gallery[0]->image1;?>" alt="" />

                            <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                                <?=$gallery[0]->name;?>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                        <a class="position-relative d-block overflow-hidden"
                            href="singletour.php?id=<?=$gallery[0]->id;?>">
                            <img class="img-fluid" src="img/tourist-spot/<?=$gallery[0]->image2;?>" alt="" />
                            <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                                <?=$gallery[0]->name;?>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                        <a class="position-relative d-block overflow-hidden"
                            href="singletour.php?id=<?=$gallery[0]->id;?>">
                            <img class="img-fluid" src="img/tourist-spot/<?=$gallery[0]->image3;?>" alt="" />

                            <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                                <?=$gallery[0]->name;?>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px">
                <a class="position-relative d-block h-100 overflow-hidden"
                    href="singletour.php?id=<?=$gallery[0]->id;?>">
                    <img class="img-fluid position-absolute w-100 h-100"
                        src="img/tourist-spot/<?=$gallery[0]->image4;?>" alt="" style="object-fit: cover" />
                    <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                        <?=$gallery[0]->name;?>
                    </div>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Footer Start -->
<?php
  include "partials/footer.php"
?>