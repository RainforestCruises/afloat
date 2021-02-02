<div class="header__main__nav__list">
                    <?php foreach ($menu_toplevel as $toplevelItem) : ?>
                        <li>
                        <a href="<?php echo $toplevelItem->url ?>" class="nav-link"><?php echo $toplevelItem->title ?></a>
                        </li>
                    <?php endforeach; ?>
                </div>



                <?php $destinationsArray = $destination_group->destinations; ?>
                            <?php foreach ($destinationsArray as $destinationMenuItem) : ?>
                                <li class="header__main__nav__list__item">
                                    <a href="<?php echo $destinationMenuItem->url ?>" class="nav-link"><?php echo $destinationMenuItem->title ?></a>
                                </li>
                            <?php endforeach; ?>

                            <li class="nav-mega__nav__sub-group__item">
                                <a href="#" class="nav-mega__nav__sub-group__link">Amazon River</a>
                            </li>
