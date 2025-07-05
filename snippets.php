            <!-- Search Button -->
            <?php if (!is_page_template('template-search.php')) : ?>
                <div class="header__main__right__search">
                    <a class="nav-search-button" href="<?php echo get_field('top_level_search_page', 'option'); ?>">
                        Search
                    </a>
                </div>
            <?php endif; ?>