<div class="destination-main__intro__lists">
            <div class="destination-main__intro__lists__locations">
                <div class="destination-main__intro__lists__locations__title">
                    Destinations
                </div>
                <ul class="destination-main__intro__lists__locations__list">
                    <?php if ($locations) : ?>
                        <?php foreach ($locations as $l) : ?>
                            <?php $location =  $l['location']; ?>
                            <li>
                                <a href="#"><?php echo $location; ?></a>
                            </li>
                    <?php endforeach;
                    endif; ?>

                </ul>

            </div>
            <div class="destination-main__intro__lists__experiences">
                <div class="destination-main__intro__lists__experiences__title">
                    Things to do
                </div>
                <ul class="destination-main__intro__lists__experiences__list">
                    <?php if ($activities) : ?>
                        <?php foreach ($activities as $a) : ?>
                            <?php $activity =  $a['activity']; ?>
                            <li>
                                <a href="#"><?php echo ($activity->navigation_title); ?></a>
                            </li>
                    <?php endforeach;
                    endif; ?>
                </ul>
            </div>

        </div>