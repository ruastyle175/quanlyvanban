<?php
/**
 * Created by PhpStorm.
 * User: radic
 * Date: 1/2/2019
 * Time: 11:05 AM
 */

$this->title = 'Home';
?>

<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-3 dashboard_col">
                <div class="dashboard_container">
                    <ul class="db_col1_row1 dashboard_ul">
                        <li>
                            <div>Rooms Booked Today</div>
                            <div>0</div>
                        </li>
                        <li>
                            <div>Pending Rooms Today</div>
                            <div>0</div>
                        </li>
                        <li>
                            <div>Available Rooms Today</div>
                            <div>34</div>
                        </li>
                    </ul>

                    <hr>

                    <h5 class="db_title_col1 text-uppercase">AVAILABLE ROOMS BY TYPE</h5>
                    <ul class="db_col1_row2 dashboard_ul">
                        <li>
                            <div>Apartment</div>
                            <div>4</div>
                        </li>
                        <li>
                            <div>Double Room</div>
                            <div>8</div>
                        </li>
                        <li>
                            <div>Family Room</div>
                            <div>8</div>
                        </li>
                        <li>
                            <div>Single Room</div>
                            <div>6</div>
                        </li>
                        <li>
                            <div>Studio</div>
                            <div>8</div>
                        </li>
                    </ul>
                    <h5 class="db_calendar"><a href="#"><span class="mt-icon"><i class="glyphicon glyphicon-calendar"></i></span> View Calendar</a></h5>

                    <hr>

                    <h5 class="db_title_col1 text-uppercase">GUESTS</h5>
                    <ul class="db_col1_row3 db_tree">
                        <li>
                            <div class="db_tree_parent">
                                <div>Staying tonight</div>
                                <div>0</div>
                            </div>
                            <ul class="db_tree_child">
                                <li>
                                    <div>Adults</div>
                                    <div>0</div>
                                </li>
                                <li>
                                    <div>Children</div>
                                    <div>0</div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="db_tree_parent">
                                <div>Arriving today</div>
                                <div>0</div>
                            </div>
                            <ul class="db_tree_child">
                                <li>
                                    <div>Adults</div>
                                    <div>0</div>
                                </li>
                                <li>
                                    <div>Children</div>
                                    <div>0</div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="db_tree_parent">
                                <div>Leaving today</div>
                                <div>0</div>
                            </div>
                            <ul class="db_tree_child">
                                <li>
                                    <div>Adults</div>
                                    <div>0</div>
                                </li>
                                <li>
                                    <div>Children</div>
                                    <div>0</div>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="col-lg-5 dashboard_col">
                <div class="portlet-body portlet_body">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1_1" data-toggle="tab" aria-expanded="true"> Arrivals </a>
                        </li>
                        <li class="">
                            <a href="#tab_1_2" data-toggle="tab" aria-expanded="false"> Departures </a>
                        </li>
                        <li class="">
                            <a href="#tab_1_3" data-toggle="tab" aria-expanded="false"> Latest </a>
                        </li>
                    </ul>
                    <div class="tab-content tab_content">
                        <div class="tab-pane fade active in" id="tab_1_1">
                            Content Arrivals
                        </div>
                        <div class="tab-pane fade" id="tab_1_2">
                            Content Departures
                        </div>
                        <div class="tab-pane fade" id="tab_1_3">
                            <span>Content Latest</span>
                            <hr>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 dashboard_col">
                <div class="dashboard_container">
                    <h2>Menu Management</h2>
                    <p>View, add, edit, delete menus</p>
                </div>
            </div>
        </div>
    </div>
</div>

