<?php
    require_once( 'calls'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'init.php' );
    
    // Class instance
    $session = new Session();
    
    // If user is logged in, Redirect
    $page = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if( $session->is_logged_in() ) $session->redirect_to( $page . 'admin' );
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta content="utf-8" http-equiv="encoding" />
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="calls/images/favicon.ico" />
        
        <!-- Google Font -->
        <!-- <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open Sans" /> -->
        
        <!-- JQuery -->
        <script type="text/javascript" src="calls/scripts/jquery/jquery.js"></script>
        <script type="text/javascript" src="calls/scripts/jquery/jquery-ui.js"></script>
        <script> $ = jQuery; </script>
        <script type="text/javascript" src="calls/scripts/javascript/interface.js"></script>
    
        <script>
            var login_blocker = function ()
                {
                    $ui_engine.block({title:'Login',file:'login',width:'400',height:'240',buttons:'NYY'});
                },
                
                get_access_blocker = function ()
                {
                    $ui_engine.block({title:'Get Access',file:'get_access',width:'400',height:'480',buttons:'NYY'});
                },
                
                product_blocker = function ($title,$file)
                {
                    $ui_engine.block({title:$title,file:$file,width:'850',height:'500',buttons:'NYY'});
                };
        </script>
        
        <!-- Global CSS Reset -->
        <link rel="stylesheet" href="calls/stylesheets/reset.min.css" media="all" />
        <!-- JQuery CSS -->
        <link rel="stylesheet" href="calls/scripts/jquery/themes/base/jquery-ui.css" media="all" />
        <!-- Interface CSS -->
        <link rel="stylesheet" href="calls/stylesheets/interface.css" media="all" />
        
    	<title>.: Hope+lus</title>
    </head>
    <body>
    
        <div id="wrapper">
            <div id="header_bg">
                <div id="header">
                    <div id="identity">
                        <div id="logo"><img src="calls/images/logo-company.png" alt="Company Logo" /></div>
                        <div id="search">
                            <ul>
                                <li>
                                    <div class="contact_box">
                                        <b>+234-1-8928297</b> | 08188386840 | <a href="#" class="coy_color">Contact</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="search_box">
                                        <input type="text" name="txt_search" id="txt_search" />
                                        <button type="submit"><img src="calls/images/search-form-btn-gray.png" alt="Search" /></button>
                                    </div>
                                </li>
                                <li>
                                    <div class="button_box">
                                        <a href='#' class="coy_bg white bold" onclick="javascript:login_blocker();">Login</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="button_box">
                                        <a href='#' class="dark_gray_bg white bold" onclick="javascript:get_access_blocker();">Free Trial</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="menu">
                        <ul>
                            <li>
                                <a href='#'>Products</a>
                                <ul class="hide">
                                    <li><a href='#'>Individual Life</a></li>
                                    <li>
                                        <a href='#'>Group Life</a>
                                        <ul class="hide">
                                            <li><a href="#">Heaven Assured</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href='#'>Community</a></li>
                            <li><a href='#'>Industries</a></li>
                            <li>
                                <a href='#'>Services</a>
                                <ul class="hide">
                                    <li><a href='#'>Life Package</a></li>
                                    <li><a href='#'>Non-Life Package</a></li>
                                    <li><a href='#'>Non-Life Package</a></li>
                                    <li><a href='#'>Non-Life Package</a></li>
                                    <li>
                                        <a href='#'>Non-Life Package</a>
                                        <ul class="hide">
                                            <li><a href='#'>Life Package</a></li>
                                            <li><a href='#'>Non-Life Package</a></li>
                                        </ul>
                                    </li>
                                    <li><a href='#'>Non-Life Package</a></li>
                                    <li><a href='#'>Non-Life Package</a></li>
                                </ul>
                            </li>
                            <li><a href='#'>Customers</a></li>
                            <li><a href='#'>Events</a></li>
                            <li><a href='#'>About Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="content_bg">
                <div id="content">
                    <div class="bold center" style="padding: 20px 0;"><h2 class="dark_gray">Priceless. User friendly. Secure. Up to 99.9% uptime.</h2></div>
                    <div id="screen">
                        <div class="screen_msg">
                            <h3 class="white">GREAT CUSTOMERS</h3>
                            <h1 class="white bold">DESERVE</h1>
                            <h3 class="white">GREAT CUSTOMER SERVICE</h3>
                            <h5 class="white">Salesforce.com Positioned as a Leader in the 2013 Gartner Magic Quadrant for CRM Customer Engagement Centers</h5>
                            <div class="pad15px">
                                <button>Get it Now!</button>
                            </div>
                        </div>
                        
                        <ul>
                            <li>
                                <a href="#" class="coy_bg"><b>View</b> demos &rsaquo;</a>
                            </li>
                            <li>
                                <a href="#" class="coy_bg"><b>Editions</b> &amp; pricing &rsaquo;</a>
                            </li>
                            <li>
                                <a href="#" class="coy_bg"><b>Free</b> trial &rsaquo;</a>
                            </li>
                        </ul>
                    </div>
                    <div class="pad20px tablets">
                        
                        <div class="l_float percent65">
                            <div class="percent50 l_float">
                                <div style="padding: 0 20px 20px 0;">
                                    <div class="tablet_belt coy_bg pad5px"></div>
                                    <div class="tablet">
                                       <div class="tablet_img l_float coy_bg" style="margin-top:-1px;"><img src="calls/images/ind.png" alt='Private Hospitals'/></div>
                                        <div class="l_float">
                                            <h3 class="dark_gray">Private Hospitals</h3>
                                            <ul>
                                                <?php
                                                // Call
                                                $ind_plans = ''; /*$obj->query(array(
                                                    'select' => 'itemdesc,itemclass',
                                                    'from'   => 'generalinfo',
                                                    'where'  => "itemid = '21' AND itemsub = 'I'",
                                                    //'order'  => 'RAND()',
                                                    'format' => 'Array'
                                                ));*/
                                                
                                                // Fetching
                                                if(!empty($ind_plans))
                                                {
                                                    // Init.
                                                    $len      = 25;
                                                    $itemdesc = '';
                                                    $file     = '';
                                                    $i        = 1;
                                                    
                                                    foreach($ind_plans as $ind_plan)
                                                    {
                                                        $itemdesc = $title = $ind_plan['itemdesc'];
                                                        $file     = strtolower($ind_plan['itemclass']);
                                                        
                                                        // Crop length
                                                        if (strlen($itemdesc) > $len)
                                                        {
                                                            // Reformat appearance
                                                            $itemdesc = ucfirst(substr($itemdesc, 0, $len).'...');
                                                        } ?>
                                                        <li><a  href="#<?php echo $file; ?>" onclick="javascript:product_blocker('<?php echo $title; ?>','<?php echo $file; ?>');" title="<?php echo $title; ?>">&#9658;&nbsp;&nbsp;<?php echo $itemdesc; ?></a></li>
                                                    <?php
                                                        $i++;
                                                        if ($i > 5) break;   
                                                    }
                                                } ?>
                                            </ul>
                                        </div>
                                        <div class="tablet_footer coy_bg fade" style="position:absolute;bottom:0;left:0;padding:10px 0;width:100%;color:#FFF;">
                                            <div class="horizontal_pad" style="position: relative;">
                                                <?php if (count($ind_plans) > 5){ ?>
                                                    <div style="position: absolute; top: -30px; right: 20px;"><a class="blue bold" href="#">more...</a></div>
                                                <?php } ?>
                                                <b>Where are you?</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="percent50 l_float">
                                <div style="padding: 0 20px 20px 0;">
                                    <div class="tablet_belt coy_bg pad5px"></div>
                                    <div class="tablet">
                                        <div class="tablet_img l_float coy_bg" style="margin-top:-1px;"><img src="calls/images/grp.png" alt='Public Hospitals'/></div>
                                        <div class="l_float">
                                            <h3 class="dark_gray">Public Hospitals</h3>
                                            <ul>
                                                <?php
                                                // Call
                                                $grp_plans = ''; /*$obj->query(array(
                                                    'select' => 'itemdesc,itemclass',
                                                    'from'   => 'generalinfo',
                                                    'where'  => "itemid = '21' AND itemsub = 'G'",
                                                    //'order'  => 'RAND()',
                                                    'format' => 'Array'
                                                ));*/
                                                
                                                // Fetching
                                                if(!empty($grp_plans))
                                                {
                                                    // Init.
                                                    $len      = 25;
                                                    $itemdesc = '';
                                                    $file     = '';
                                                    $g        = 1;
                                                    
                                                    foreach($grp_plans as $grp_plan)
                                                    {
                                                        $itemdesc = $title = $grp_plan['itemdesc'];
                                                        $file     = strtolower($grp_plan['itemclass']);
                                                        
                                                        // Crop length
                                                        if (strlen($itemdesc) > $len)
                                                        {
                                                            // Reformat appearance
                                                            $itemdesc = ucfirst(substr($itemdesc, 0, $len).'...');
                                                        } ?>
                                                        <li><a href="#<?php echo $file; ?>" onclick="javascript:product_blocker('<?php echo $title; ?>','<?php echo $file; ?>');" title="<?php echo $title; ?>">&#9658;&nbsp;&nbsp;<?php echo $itemdesc; ?></a></li>
                                                    <?php
                                                        $g++;
                                                        if ($g > 5) break;
                                                    }
                                                } ?>
                                            </ul>
                                        </div>
                                        <div class="tablet_footer coy_bg fade" style="position:absolute;bottom:0;left:0;padding:10px 0;width:100%;color:#FFF;">
                                            <div class="horizontal_pad" style="position: relative;">
                                                <?php if (count($grp_plans) > 5){ ?>
                                                    <div style="position: absolute; top: -30px; right: 20px;"><a class="blue bold" href="#">more...</a></div>
                                                <?php } ?>
                                                <b>Where are you?</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="l_float percent35">
                            <div id="sidebar" class="percent100 l_float white_bg">
                                <div class="tab">
                                    <div id="users_tab">
                                        <ul>
                                            <li><a href="#tabs-1">AGENT/BROKER</a></li>
                                            <li><a href="#tabs-2">CLIENT</a></li>
                                            <li><a href="#tabs-3">MANAGEMENT</a></li>
                                            <li><a href="#tabs-4">STAFF</a></li>
                                        </ul>
                                        <div id="tabs-1">
                                            <h5 class="dark_gray">You can login to test this Application as an Agent/Broker</h5>
                                            <div class="tab_img l_float" style="background-position: -81px 0;"></div>
                                            <p><h5>Information:</h5>To access this site as an Agent/Broker, you must have an Agent/Broker Login ID &amp; Password. If you don't currently have one, then you might want to <a href="#">Click Here</a> to get it.</p>
                                            <p>With your Login ID &amp; Password, you can then access this application.</p>
                                            <p class="italics dark_gray">These are some of the actions you can perform once you successfully log into this Application:</p>
                                            <ul class="ablilities">
                                                <li>You can check the status of all your policies with us</li>
                                                <li>You can request for policy changes such as:</li>
                                                    <ul>
                                                        <li>- Sum Assured/Premium Adjustments.</li>
                                                        <li>- Changes in renewal period etc.</li>
                                                    </ul>
                                                <li>You can report claims on any of your policies and check the status of existing claims.</li>
                                                <li>You can check your statement of account and report any observation.</li>
                                                <li>You can make payment on premiums.</li>
                                                <li>You can check your commission statements.</li>
                                            </ul>
                                            <div class="clear"></div>
                                        </div>
                                        <div id="tabs-2">
                                            <h5 class="dark_gray">You can login to test this Application as a Client</h5>
                                            <div class="tab_img l_float" style="background-position: -243px 0;"></div>
                                            <p><h5>Information:</h5>If you do not currently have a policy with us, you can now take a policy online. When you take a policy, will be given a Login ID &amp; Password.</p>
                                            <p>With your Login ID &amp; Password you can access this application.</p>
                                            <p>Also, if you already have a policy but don't have a Login ID &amp; Password Click Here to get one.</p>
                                            <p class="italics dark_gray">Once you're logged in to the system, you can do the following:</p>
                                            <ul class="ablilities">
                                                <li>You can check your policy information and status.</li>
                                                <li>You report and submit claim information</li>
                                                <li>Check your claim status (if any)</li>
                                                <li>Print your certificate of insurance</li>
                                                <li>Print your policy document</li>
                                                <li>Send mail to your agent or us.</li>
                                            </ul>
                                        </div>
                                        <div id="tabs-3">
                                            <h5 class="dark_gray">You can login to test this Application as Management</h5>
                                            <div class="tab_img l_float" style="background-position: 0 0;"></div>
                                            <p><h5>Information:</h5>With your Management Login ID &amp; Password you can access the system from anywhere within or outside the company or country. If you don't currently have one, then please Click Here to get it.</p>
                                            <p class="italics dark_gray">Once you're logged in to the system, you can do the following:</p>
                                            <ul class="ablilities">
                                                <li>View or print management reports such as:</li>
                                                    <ul>
                                                        <li>- Production Summary/details.</li>
                                                        <li>- Revenue details/summaries.</li>
                                                        <li>- Loss ratios and statistics.</li>
                                                        <li>- Agency performance reports.</li>
                                                        <li>- Risk management and exposure summaries/details.</li>
                                                        <li>- commission statements.</li>
                                                        <li>- Cash flow position.</li>
                                                        <li>- Bank balances.</li>
                                                        <li>- Trial balance and balance sheet reports etc.</li>
                                                    </ul>
                                                <li>You can send SMS and emails to agencies and clients.</li>
                                                <li>You can authorize/sign requests (leave, loans, vouchers etc).</li>
                                                <li>You can approve/sign requests (leave, loans, vouchers etc).</li>
                                                <li>You can fund vouchers.</li>
                                                <li>You can also send memos, notes, queries etc. to staff and management.</li>
                                            </ul>
                                            <div class="clear"></div>
                                        </div>
                                        <div id="tabs-4">
                                            <h5 class="dark_gray">You can login to test this Application as a Staff</h5>
                                            <div class="tab_img l_float" style="background-position: -324px 0;"></div>
                                            <p><h5>Information:</h5>Before you can access this application as a staff, you must have a staff Login ID &amp; Password.</p>
                                            <p>If you don't currently have one, then please Click Here to Register.</p>
                                            <p>With your Login ID &amp; Password you can login to both the Internet (information uploaded for clients and brokers to interact with) and Intranet (actual data from the office).</p>
                                            <p>When logged into the intranet you have access to the following modules:- Underwriting, Claims, Human Resources, Legal, Marketing Interface and Financial Module.</p>
                                            <p>Also once you're logged in you can make contact with other staff, agencies or clients online through: SMS to their GSM/Cell lines, Email or Internal Messaging System.</p>
                                            <p class="italics dark_gray">Once you're logged in to the system, you can do the following:</p>
                                            <ul class="ablilities">
                                                <li>Check your personal/salary information.</li>
                                                <li>Update your personal information.</li>
                                                <li>Raise non-cheque requisition vouchers.</li>
                                                <li>Authorize requests (if you are on the Authorizing List).</li>
                                                <li>Approve requests (if you are on the Approval List).</li>
                                                <li>You can report grievances.</li>
                                                <li>You can send memos and application letters (leave, loans etc).</li>
                                            </ul>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <!-- footer_bg START -->
            <div id="footer_bg">
                <!-- footer START -->
                <div id="footer">
                    <div class="div100">
                        <div class="signature percent65">
                            <h4 class="coy_color">Hope+lus Ltd.</h4>
                            <div class="pad5px">
                                <b>Head Office:</b>
                                Hope+lus Ltd.
                            </div>
                            <div class="pad5px">
                                14c, Estaport Avenue,
                                Soluyi, Gbagada,
                                Lagos.
                            </div>
                        </div>
                        <div class="socials percent35">
                            <div style="padding-left: 20px;">
                                <div class="social_stone" style="background-position: 0 0;">&nbsp;</div>
                                <div class="social_stone" style="background-position: -32px 0;">&nbsp;</div>
                                <div class="social_stone" style="background-position: -64px 0;">&nbsp;</div>
                                <div class="social_stone" style="background-position: -96px 0;">&nbsp;</div>
                                <div class="social_stone" style="background-position: -128px 0;">&nbsp;</div>
                                <div class="social_stone" style="background-position: -160px 0;">&nbsp;</div>
                                <div class="social_stone" style="background-position: -192px 0;">&nbsp;</div>
                                <div class="clear pad15px"></div>
                            </div>
                            <div style="padding-left: 20px;">
                                <table class="carbon_copy">
                                    <tr>
                                        <td class="percent75" style="vertical-align: top;">
                                            <div class="text_box">
                                                <input type="text" name="txt_subscribe" id="txt_subscribe" class="text" />
                                            </div>
                                        </td>
                                        <td class="percent25" style="vertical-align: top;">
                                            <div class="button_box">
                                                <a href='#' class="coy_bg white bold" onclick="javascript:;">Subscribe</a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                <!-- footer END -->
                </div>
                
                <div class="pad10px copyright_belt_bg">
                    <div class="copyright_belt font12" style="color: #888;">
                        &copy; Copyright <?php echo date('Y'); ?>. <span class="white bold text_shadow font14">Hope+lus Ltd.</span> | All rights reserved.
                    </div>
                </div>
            <!-- footer_bg END -->
            </div>
        </div>
        
        <!-- Screen Blocker -->
        <div id="ui_bg" class="hide">
            <div id="ui" class="hide">
                <div class="coy_bg fade" id="ui_header">
                    <div class="r_float">
                        <ul>
                            <li><a href="#" title="Minimize" style="background-position: 0 0;" onclick="javascript:$ui_engine.toggle_fold();"></a></li>
                            <li><a href="#" title="Maximize" style="background-position: -33px 0;" onclick="javascript:$ui_engine.toggle_size();"></a></li>
                            <li><a href="#" title="Close" style="background-position: -66px 0;" onclick="javascript:$ui_engine.close();"></a></li>
                        </ul>
                    </div>
                    <div id="ui_title" class="title"></div>
                </div>
                <div id="ui_content"></div>
            </div>
        </div>
                
    </body>
</html>