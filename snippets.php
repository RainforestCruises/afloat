 <!-- Main Panel -->
 <button class="nav-mobile__accordion nav-mobile__accordion--main">Destinations</button>
            <div class="nav-mobile__accordion__panel ">

                <!-- Sub Panel -->
                <div class="nav-mobile__accordion nav-mobile__accordion__sub-group nav-mobile__accordion--destinations">
                    Adventure Cruises</div>
                <ul class="nav-mobile__accordion__panel nav-mobile__accordion__list">
                    <li class="nav-mobile__accordion__panel__item">
                        <a href="#" class="nav-mobile__accordion__panel__link">Amazon River</a>
                    </li>
                    <li class="nav-mobile__accordion__panel__item">
                        <a href="#" class="nav-mobile__accordion__panel__link">Galapagos Islands</a>
                    </li>
                    <li class="nav-mobile__accordion__panel__item">
                        <a href="#" class="nav-mobile__accordion__panel__link">Indonesian Archipelago</a>
                    </li>
                    <li class="nav-mobile__accordion__panel__item">
                        <a href="#" class="nav-mobile__accordion__panel__link">Irrawaddy River</a>
                    </li>
                    <li class="nav-mobile__accordion__panel__item">
                        <a href="#" class="nav-mobile__accordion__panel__link">Mekong River</a>
                    </li>
                </ul>

            </div>
            </div>

            <button class="nav-mobile__accordion nav-mobile__accordion--main">Experiences</button>
            <div class="nav-mobile__accordion__panel">
                <ul class="nav-mobile__accordion__panel__list">
                    <li class="nav-mobile__accordion__panel__item">
                        <a href="#" class="nav-mobile__accordion__panel__link">AAA</a>
                    </li>
                  
                </ul>
            </div>

            <button class="nav-mobile__accordion nav-mobile__accordion--main">Deals</button>
            <div class="nav-mobile__accordion__panel">
                <ul class="nav-mobile__accordion__panel__list">
                    <li class="nav-mobile__accordion__panel__item">
                        <a href="#" class="nav-mobile__accordion__panel__link">Deal 1</a>
                    </li>
                   

                </ul>
            </div>
            <button class="nav-mobile__accordion nav-mobile__accordion--main">Contact</button>








            <?php foreach ($menu_destination_groups as $destination_group) : ?>
                <div class="nav-mobile__content-panel nav-mobile__content-panel--sub" parentItem="<?php echo $destination_group['parentId'] ?>">
                    <button class="nav-mobile__content-panel__button nav-mobile__content-panel__button--back">Destinations</button>

                    <?php $destinationsMenuArray = $destination_group['destinations']; ?>
                    <?php foreach ($destinationsMenuArray as $destinationMenuItem) : ?>
                        <button class="nav-mobile__content-panel__button"><?php echo $destinationMenuItem['title'] ?></button>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>