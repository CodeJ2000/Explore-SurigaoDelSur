<?php
  include "config/init.php";
  include "partials/header.php";
?>
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center pt-5">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">
                    "Discover Your Perfect Destination"
                </h1>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Navbar & Hero End -->

<!-- Package Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">
                Packages
            </h6>
            <h1 class="mb-5">Awesome Destination</h1>
        </div>
        <div id="destination-container" class="row g-4 justify-content-center">
            <!-- This loop is for displaying all data from destination table -->
            <?php foreach($data = Destination::action()->get_all() as $d): 
                    $cat_id = $d->cat_id;
                    $category = Category::action()->get_by_id_category($cat_id);
                    $gallery = Gallery::action()->get_by_touristId_gallery($d->id);                
                ?>
            <div class="col-lg-4 col-md-6 wow" data-wow-delay="0.1s">
                <div class="package-item">
                    <div class="overflow-hidden card-img">
                        <img class="img-fluid" src="<?=$gallery[0]->image1;?>" alt="" />
                    </div>
                    <div class="d-flex border-bottom">
                        <small class="flex-fill text-center border-end py-2"><i
                                class="fa fa-map-marker-alt text-primary me-2"></i>Cagwait</small>
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
            <?php endforeach;?>
        </div>
    </div>
</div>
<!-- Package End -->

<!-- Footer Start -->
<?php
  include "partials/footer.php"
?>