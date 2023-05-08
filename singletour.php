<?php
  require_once "config/init.php";
  include "partials/header.php";
//This is for displaying single data from destination database table.
$data = Destination::action()->get_by_id_destination($_GET['id']);
?>

<div class="container-fluid bg-primary py-5 mb-5 hero-header"></div>
</div>
<!-- Navbar & Hero End -->
<div class="container">
    <div class="main-body">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="destination.php"><i class="fa fa-solid fa-arrow-left"></i> Back</a>
                </li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->

        <div id="tour-page" class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-start">
                            <p></p>
                            <div class="mt-3">
                                <h4><?=$data[0]->name;?></h4>
                                <p class="text-primary mb-1">Beaches</p>
                                <div style="max-height: 240px" class="tour-container">
                                    <p class="tour-desc text-muted font-size-sm">
                                        <?=$data[0]->description;?>
                                    </p>
                                </div>
                                <p id="toggleBtn" class="text-dark">Read More</p>
                                <!-- <button class="btn btn-primary">Follow</button> -->
                                <!-- <button class="btn btn-outline-primary">Message</button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg>
                            </h6>
                            <span class="text-secondary">https://britaniaisland.com</span>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="ratio ratio-16x9">
                            <iframe width="853" height="480"
                                src="https://www.youtube.com/embed/<?=isYoutubeVideoLink($data[0]->youtube_url);?>"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>

                <div class="row gutters-sm">
                    <div class="col-sm-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3">
                                    <i class="material-icons text-info mr-2"></i>Where to find
                                    us
                                </h6>
                                <hr style="height: 3px" class="bg-primary" />
                                <small class="text-primary">Purok:</small>
                                <div class="loc-details">
                                    <p><?=$data[0]->purok;?></p>
                                </div>
                                <hr />
                                <small class="text-primary">Barangay:</small>
                                <div class="loc-details">
                                    <p><?=$data[0]->barangay;?></p>
                                </div>
                                <hr />
                                <small class="text-primary">municipality/City:</small>
                                <div class="loc-details">
                                    <p><?=$data[0]->city_mun;?></p>
                                </div>
                                <hr />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3">
                                    <i class="material-icons text-info mr-2"></i>Things to
                                    know
                                </h6>
                                <hr style="height: 3px" class="bg-primary" />

                                <small class="text-primary">Entrance Fee:</small>
                                <div class="loc-details">
                                    <p class="fs-5"><?=$data[0]->guides;?></p>
                                </div>
                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Destination Start -->
            <div class="container-xxl py-5 destination">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-lg-7 col-md-6">
                            <div class="row g-3">
                                <?php $gallery = Gallery::action()->get_by_touristId_gallery($data[0]->id);?>
                                <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                                    <div class="position-relative d-block overflow-hidden" href="">
                                        <img class="img-fluid" src="img/tourist-spot/<?=$gallery[0]->image1;?>"
                                            alt="" />


                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                                    <div class="position-relative d-block overflow-hidden" href="">
                                        <img class="img-fluid" src="img/tourist-spot/<?=$gallery[0]->image2;?>"
                                            alt="" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                                    <div class="position-relative d-block overflow-hidden" href="">
                                        <img class="img-fluid" src="img/tourist-spot/<?=$gallery[0]->image3;?>"
                                            alt="" />

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px">
                            <div class="position-relative d-block h-100 overflow-hidden" href="">
                                <img class="img-fluid position-absolute w-100 h-100"
                                    src="img/tourist-spot/<?=$gallery[0]->image4;?>" alt="" style="object-fit: cover" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Destination Start -->
        </div>
    </div>
</div>
</div>
<!-- Footer Start -->
<?php
  include "partials/footer.php"
?>