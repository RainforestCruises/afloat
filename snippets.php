<?php
                            $destinations = $result->destinations;
                            if ($destinations) :
                                echo comma_separate_list($destinations, 1);
                            endif; ?>