 <!-- <video class="home-hero__bg" autoplay muted loop>
                <source
                    src="https://player.vimeo.com/external/295214306.sd.mp4?s=6feaa6e9c4619bb4993d2e10b1e05512ab4f098e&profile_id=165"
                    type="video/mp4" />
                Your browser is not supported
            </video> -->
            <div class="home-hero__caption">
                <h1 class="home-hero__caption__title">
                    Tailor-Made Experiences And <br> Authentic Travel
                </h1>
                <h2 class="home-hero__caption__subtitle">
                    See what sets us apart
                </h2>
                <div class="home-hero__caption__arrow">
                    <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="down-arrow-button" href="#intro">
                        <svg class="btn-circle--arrow-main">
                            <use xlink:href="<?php echo bloginfo('template_url')?>/css/img/sprite.svg#icon-arrow-down"></use>
                        </svg>
                        <svg class="btn-circle--arrow-animate">
                            <use xlink:href="<?php echo bloginfo('template_url')?>/css/img/sprite.svg#icon-arrow-down"></use>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="home-hero__search">
                <form action="#" class="home-hero__search__form" autocomplete="off">

                    <!-- Destination -->
                    <div class="home-hero__search__form__form-group">
                        <div class="home-hero__search__form__form-group__icon">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url')?>/css/img/sprite.svg#icon-map-pin"></use>
                            </svg>
                        </div>
                        <div class="home-hero__search__form__form-group__input-group">
                            <label for="destination" class="home-hero__search__form__form-group__input-group__label">Destination</label>
                            <input class="home-hero__search__form__form-group__input-group__input" id="destination" tabindex="1" placeholder="Where would you like to go?">

                            </input>
                        </div>

                    </div>

                    <!-- Dates -->
                    <div class="home-hero__search__form__form-group">
                        <div class="home-hero__search__form__form-group__icon">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url')?>/css/img/sprite.svg#icon-calendar"></use>
                            </svg>
                        </div>
                        <div class="home-hero__search__form__form-group__input-group">
                            <label for="dates" class="home-hero__search__form__form-group__input-group__label">Travel
                                Date</label>
                            <input type="text" class="home-hero__search__form__form-group__input-group__input" id="dates" tabindex="1" placeholder="When would you like to travel?" />
                        </div>
                    </div>


                    <button class="home-hero__search__form__btn" onClick="window.location='/page-search.html';">
                        Search
                    </button>

                </form>

            </div>