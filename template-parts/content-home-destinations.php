<?php 
$destinations = get_field('destinations');

?>

<div class="home-destinations">
            <div class="home-destinations__header">
                <div class="home-destinations__header__title page-divider">
                    Exotic Destinations
                </div>
                <div class="home-destinations__header__sub-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero aperiam nostrum eum excepturi et quas neque soluta iusto quae, eligendi cumque dicta dolore sed reprehenderit iure ex, blanditiis nesciunt eos.
                </div>
            </div>

            <div class="home-destinations__destinations-area">

                <div class="home-destinations__destinations-area__slider" id="destinations-slider">
                    <?php if ($destinations) : ?>
                        <?php foreach ($destinations as $d) :
                            $destinationPost = $d['destination'];
                            $image = $d['image'];
                        ?>
                            <a href="<?php echo $d['page_link'] ?>" class="home-destination-card">
                                <img src="<?php echo esc_url($image['url']); ?>">
                                <div class="home-destination-card__title-area">
                                    <div class="home-destination-card__title-area__title">
                                        <?php echo get_field('navigation_title', $destinationPost) ?>
                                    </div>
                                    <div class="home-destination-card__title-area__subtitle">
                                        <?php echo $d['sub_title'] ?>
                                    </div>
                                </div>
                            </a>

                    <?php endforeach;
                    endif; ?>

                    <div class="home-destination-card">
                        <h3>2</h3>
                    </div>
                    <div class="home-destination-card">
                        <h3>3</h3>
                    </div>
                    <div class="home-destination-card">
                        <h3>4</h3>
                    </div>
                    <div class="home-destination-card">
                        <h3>5</h3>
                    </div>
                    <div class="home-destination-card">
                        <h3>6</h3>
                    </div>
                    <div class="home-destination-card">
                        <h3>7</h3>
                    </div>
                    <div class="home-destination-card">
                        <h3>8</h3>
                    </div>
                    <div class="home-destination-card">
                        <h3>9</h3>
                    </div>
                    <div class="home-destination-card">
                        <h3>10</h3>
                    </div>
                    <div class="home-destination-card">
                        <h3>11</h3>
                    </div>
                    <div class="home-destination-card">
                        <h3>12</h3>
                    </div>
                    <div class="home-destination-card">
                        <h3>13</h3>
                    </div>
                    <div class="home-destination-card">
                        <h3>14</h3>
                    </div>
                    <div class="home-destination-card">
                        <h3>15</h3>
                    </div>
                    <div class="home-destination-card">
                        <h3>16</h3>
                    </div>
                    <div class="home-destination-card">
                        <h3>17</h3>
                    </div>


                </div>
            </div>

        </div>