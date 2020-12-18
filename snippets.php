<?php
                        $count = 0;
                        if ($countries) {
                            foreach ($countries as $country) {
                                $title = get_the_title($country->ID);
                                if ($count != 0) {
                                    echo " / " . $title;
                                } else {
                                    echo $title;
                                }
                                $count++;
                            }
                        }
                        ?>