<?php
/*Template Name: Search*/
get_header();

$posts = get_posts(array(
    'post_type' => 'properties',
    'posts_per_page' => 8,

));

?>
<img class="img-fluid" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
<div class="bg-gray-04">
<div class="container ">
    <!-- Breadcrumb -->
    <ul class="breadcrumb breadcrumb-style-02 py-7">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item">Search All Travel</li>
    </ul>

    <!-- Page Container -->
    <div class="page-container row">

        <!-- Sidebar -->
        <div class="sidebar col-lg-4 order-1 order-lg-0 mb-8 mb-lg-0">

            <div class="card search bg-white mb-6 border-0 rounded-0 px-6" style="background-color: #FFF !important;">
                <div class="card-header bg-transparent border-0 pt-4 pb-0 px-0">
                    <h5 class="card-title mb-0">Travel Selection</h5>
                </div>
                <div class="card-body px-0">
                    <div class="form-filter">

                        <!-- Form Start filter -->
                        <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
                            <!-- Destinations -->
                            <div class="form-group category">
                                <div class="select-custom">
                                    <?php
                                    if ($terms = get_posts(array(
                                        'post_type' => 'destinations',
                                        'posts_per_page' => -1, // to make it simple I use default categories
                                        'orderby' => 'name'
                                    ))) :
                                        // if categories exist, display the dropdown
                                        echo '<select name="destinationFilter" class="form-control"><option value="">Destination</option>';
                                        foreach ($terms as $term) :
                                            echo '<option value=' . $term->ID . '>' . get_the_title($term->ID) . '</option>'; // ID of the category as an option value
                                        endforeach;
                                        echo '</select>';
                                    endif;
                                    ?>
                                </div>
                            </div>
                            <!-- End Destinations -->
                            <!-- Styles -->
                            <div class="form-group category">
                                <div class="select-custom">
                                    <?php
                                    if ($terms = get_posts(array(
                                        'post_type' => 'styles',
                                        'posts_per_page' => -1, // to make it simple I use default categories
                                        'orderby' => 'name'
                                    ))) :
                                        // if categories exist, display the dropdown
                                        echo '<select name="styleFilter" class="form-control"><option value="">Travel Style</option>';
                                        foreach ($terms as $term) :
                                            echo '<option value=' . $term->ID . '>' . get_the_title($term->ID) . '</option>'; // ID of the category as an option value
                                        endforeach;
                                        echo '</select>';
                                    endif;
                                    ?>
                                </div>
                            </div>
                            <!-- End Styles -->
                            <!-- Countries -->
                            <div class="form-group category">
                                <div class="select-custom">
                                    <?php
                                    if ($terms = get_posts(array(
                                        'post_type' => 'countries',
                                        'posts_per_page' => -1, // to make it simple I use default categories
                                        'orderby' => 'name'
                                    ))) :
                                        // if categories exist, display the dropdown
                                        echo '<select name="countryFilter" class="form-control"><option value="">Country</option>';
                                        foreach ($terms as $term) :
                                            echo '<option value=' . $term->ID . '>' . get_the_title($term->ID) . '</option>'; // ID of the category as an option value
                                        endforeach;
                                        echo '</select>';
                                    endif;
                                    ?>
                                </div>
                            </div>
                            <!-- End Coutnries -->
                            <!-- Prices -->
                            <div class="card-header bg-transparent border-0 pt-4 pb-0 px-0">
                                <h5 class="card-title mb-0">Price Options</h5>
                            </div>
                            <div class="card-body px-0">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="price_min" placeholder="Min price" />

                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="price_max" placeholder="Max price" />
                                </div>
                            </div>

                            <div>
                                <button class="btn btn-primary">Search <i class="fal fa-search"></i></button>
                                <input type="hidden" name="action" value="searchFilter">
                                <input type="hidden" name="form-type" value="all">
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Sidebar -->
        <?php //First time load all
        $posts = get_posts(array(
            'post_type' => 'properties',
            'posts_per_page' => 8
        ));
        ?>
        <!-- Results Area -->
        <div class="page-content col-lg-8 order-0 order-lg-1">
            <!-- Top Controls -->
            <div class="explore-filter d-lg-flex align-items-center d-block">
                <div class="text-dark font-weight-semibold font-size-md mb-4 mb-lg-0">Results</div>
                <div class="form-filter d-flex align-items-center ml-auto">
                    <div class="form-group row no-gutters align-items-center">
                        <label for="sort-by" class="col-sm-3 text-dark font-size-md font-weight-semibold mb-0">Sort
                            by</label>
                        <div class="select-custom col-sm-9">
                            <select id="sort-by" class="form-control" name="extraFilter" form="filter">
                                <option value="">All</option>
                                <option value="DESC">High to Low</option>
                                <option value="ASC">Low to High</option>
                            </select>
                        </div>
                    </div>
                    <div class="format-listing ml-auto">
                        <a href="#" class="active"><i class="fas fa-th"></i></a>
                        <a href="explore-full-map-list.html"><i class="fal fa-bars"></i></a>
                    </div>
                </div>
            </div>
            <!-- End Top Controls -->
            <!-- Results -->
            <div class="row equal-height" id="response">

                <?php
                if ($posts) :
                    foreach ($posts as $post) : //loop and render the properties
                        setup_postdata($post);
                        get_template_part('template-parts/content', 'search-travel');
                    endforeach;
                    wp_reset_postdata();
                endif; ?>
            </div>

            <!-- Pagination -->
            <ul class="pagination pagination-style-02 justify-content-center pb-12 mt-8">
                <li class="page-item"><a href="#" class="page-link"><i class="fal fa-chevron-left"></i></a>
                </li>
                <li class="page-item"><a href="#" class="page-link current">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item"><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link">...</a></li>
                <li class="page-item"><a href="#" class="page-link">10</a></li>
                <li class="page-item"><a href="#" class="page-link"><i class="fal fa-chevron-right"></i></a>
                </li>
            </ul>
            <!-- End Pagination -->
        </div>
        <!-- End Results Area -->
    </div>
    <!-- End Page Container -->
</div>
</div>

<!-- End Container -->
<?php get_footer(); ?>

<script>
    jQuery(function($) {
        $('#filter').submit(function() {
            var filter = $('#filter');
            $.ajax({
                url: filter.attr('action'),
                data: filter.serialize(), // form data
                type: filter.attr('method'), // POST
                beforeSend: function(xhr) {
                    filter.find('button').text('Processing...'); // changing the button label
                    $('#response').html('<div class="lds-dual-ring" style="margin:auto; margin-top: 80px; margin-bottom: 660px;"></div>'); //loading spinner
                },
                success: function(data) {
                    filter.find('button').text('Apply filter'); // changing the button label back
                    $('#response').html(data); // insert data
                    //resultCount
                }
            });
            return false;
        });

        $(document).ready(function() {
            console.log("ready!");
        });


    });
</script>