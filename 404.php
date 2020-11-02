<?php get_header(); ?>
<img class="img-fluid" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
<div class="content-area">
    <main>
        <section class="middle-area">
        <div id="wrapper-content" class="wrapper-content pt-0 pb-0">
            <div class="container">
                <div class="page-container text-center">
                    <div class="mb-7">
                        <svg class="icon icon-map-marker-crossed">
                            <use xlink:href="#icon-map-marker-crossed"></use>
                        </svg>
                    </div>
                    <div class="mb-7">
                        <h3 class="mb-7">Ohh! Page Not Found</h3>
                        <div class="text-gray">It seems we can’t find what you’re looking for. Perhaps
                            searching
                            can help or go back to <a href="index.html"
                                                      class="text-primary text-decoration-underline">Homepage</a>.
                        </div>
                    </div>
                    <div class="form-search">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search again...">
                                <button class="btn btn-link input-group-append text-dark pr-3" type="submit"><i
                                        class="fal fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- #wrapper-content end -->
        </section>
        <section class="map">
            <div class="container">
                <div class="row">Map</div>
            </div>
        </section>
    </main>
</div>
<?php get_footer(); ?>