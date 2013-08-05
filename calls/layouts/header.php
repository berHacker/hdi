<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="content-type" content="text/html" />
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico" />
        
        <!-- JQuery -->
        <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery/jquery.js"></script>
        <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/scripts.js"></script>
        <script> $ = jQuery; </script>
        
        <!-- Global CSS Reset -->
        <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/reset.css" media="all" />
        <!-- JQuery CSS -->
        <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/js/jquery/themes/base/jquery-ui.css" media="all" />
        <!-- Master CSS -->
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
        
        <title>
        <?php
            /*
             * Print the <title> tag based on what is being viewed.
             */
            global $page, $paged;
            
            wp_title( '|', true, 'right' );
            
            // Add the blog name.
            bloginfo( 'name' );
            
            // Add the blog description for the home/front page.
            $site_description = get_bloginfo( 'description', 'display' );
            if ( $site_description && ( is_home() || is_front_page() ) )
            	echo " | $site_description";
            
            // Add a page number if necessary:
            if ( $paged >= 2 || $page >= 2 )
            	echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
        ?>
        </title>
    </head>

    <body>
        <div id="wrapper">
            <div id="menu">
                <div class="horizontal_pad">
                    <ul>
                        <li><a href="#">Configurations</a></li>
                        <li><a href="#">Patients</a></li>
                        <li><a href="#">Activities</a></li>
                        <li><a href="#">Accessories</a></li>
                        <li><a href="#">Reports</a></li>
                        <li><a href="#">Window</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Log Out</a></li>
                    </ul>
                    
                    <div class="clear"></div>
                </div>
            </div>
            <div id="fav_menu">
                <div class="horizontal_pad">
                    <ul>
                        <li>
                            <a href="#" class="tablet" style="background-position: 0 0;" onclick="$tab_engine.open_tab({div: '#menu_tab', title: 'patients'})">
                                <div class="label">Patients</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tablet" style="background-position: -100px 0;" onclick="$tab_engine.open_tab({div: '#menu_tab', title: 'appointments'})">
                                <div class="label">Appointments</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tablet" style="background-position: -200px 0;" onclick="$tab_engine.open_tab({div: '#menu_tab', title: 'day sheet'})">
                                <div class="label">Day Sheet</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tablet" style="background-position: -300px 0;" onclick="$tab_engine.open_tab({div: '#menu_tab', title: 'lab tests'})">
                                <div class="label">Lab Tests</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tablet" style="background-position: -400px 0;" onclick="$tab_engine.open_tab({div: '#menu_tab', title: 'expenses'})">
                                <div class="label">Expenses</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tablet" style="background-position: -500px 0;" onclick="$tab_engine.open_tab({div: '#menu_tab', title: 'procedures'})">
                                <div class="label">Procedures</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tablet" style="background-position: 0 -80px;" onclick="$tab_engine.open_tab({div: '#menu_tab', title: 'payments'})">
                                <div class="label">Payments</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tablet" style="background-position: -100px -80px;" onclick="$tab_engine.open_tab({div: '#menu_tab', title: 'address book'})">
                                <div class="label">Address Book</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tablet" style="background-position: -200px -80px;" onclick="$tab_engine.open_tab({div: '#menu_tab', title: 'messages'})">
                                <div class="label">Messages</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tablet" style="background-position: -300px -80px;" onclick="$tab_engine.open_tab({div: '#menu_tab', title: 'reports'})">
                                <div class="label">Reports</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tablet" style="background-position: -400px -80px;" onclick="$tab_engine.open_tab({div: '#menu_tab', title: 'queries'})">
                                <div class="label">Queries</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tablet" style="background-position: -500px -80px;">
                                <div class="label">Log Out</div>
                            </a>
                        </li>
                    </ul>
                    
                    <div class="clear"></div>
                </div>
            </div>
            <div id="identity"></div>