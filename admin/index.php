<?php
    require_once( '..'.DIRECTORY_SEPARATOR.'calls'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'init.php' );
    
    // Class instances
    $session = new Session();
    $menu    = new Menu();
    
    // If user is not logged in, Redirect
    $page = dirname('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    if( !$session->is_logged_in() ) $session->redirect_to( $page );
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta content="utf-8" http-equiv="encoding" />
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="../calls/images/favicon.ico" />
        
        <!-- Google Font -->
        <!-- <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open Sans" /> -->
        
        <!-- JQuery -->
        <script type="text/javascript" src="../calls/scripts/jquery/jquery.js"></script>
        <script type="text/javascript" src="../calls/scripts/jquery/jquery-ui.js"></script>
        <script> $ = jQuery; </script>
        <script type="text/javascript" src="../calls/scripts/javascript/master.js"></script>
        
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
                },
                
                backup_blocker = function ()
                {
                    $ui_engine.block({title:'Backup',file:'backup',width:'350',height:'210',buttons:'NYY'});
                };
        </script>
        
        <!-- Global CSS Reset -->
        <link rel="stylesheet" href="../calls/stylesheets/reset.min.css" media="all" />
        <!-- JQuery CSS -->
        <link rel="stylesheet" href="../calls/scripts/jquery/themes/base/jquery-ui.css" media="all" />
        <!-- Master CSS -->
        <link rel="stylesheet" href="../calls/stylesheets/master.css" media="all" />
        
        <title>.: Hope+lus</title>
    </head>

    <body>
        <div id="wrapper">
            <div id="menu">
            <?php
            $menu_obj = $menu->query(array(
                'select' => '*',
                'from'   => 'menu',
                'format' => 'Object'
            ));
            if (!empty($menu_obj))
            { ?>
                <ul>
                    <?php
                    foreach($menu_obj as $each_item)
                    { ?>
                        <li>
                            <a href="#" onclick="$operator.call({div: '#menu_tab', title: '<?php echo $each_item->name; ?>', is_tab: '<?php echo $each_item->is_tab; ?>', is_shortcut: '<?php echo $each_item->is_shortcut; ?>', has_child: '<?php echo $each_item->has_child; ?>'})" > <?php echo $each_item->name; ?></a>
                            <?php
                            if ($each_item->has_child == 'Y')
                            { ?>
                                <?php
                                $menu_obj2 = $menu->query(array(
                                    'select' => '*',
                                    'from'   => 'menu_child',
                                    'where'  => "menu_id='{$each_item->id}'",
                                    'format' => 'Object'
                                ));
                                if (!empty($menu_obj2))
                                { ?>
                                    <ul class="hide">
                                        <?php
                                        foreach($menu_obj2 as $each_item2)
                                        { ?>
                                            <li>
                                                <a href="#" onclick="$operator.call({div: '#menu_tab', title: '<?php echo $each_item2->name; ?>', is_tab: '<?php echo $each_item2->is_tab; ?>', is_shortcut: '<?php echo $each_item2->is_shortcut; ?>', has_child: '<?php echo $each_item2->has_child; ?>'})" > <?php echo $each_item2->name; ?></a>
                                                <?php
                                                if ($each_item2->has_child == 'Y')
                                                { ?>
                                                    <?php
                                                    $menu_obj3 = $menu->query(array(
                                                        'select' => '*',
                                                        'from'   => 'menu_grand_child',
                                                        'where'  => "menu_child_id='{$each_item2->id}'",
                                                        'format' => 'Object'
                                                    ));
                                                    if (!empty($menu_obj3))
                                                    { ?>
                                                        <ul class="hide">
                                                            <?php
                                                            foreach($menu_obj3 as $each_item3)
                                                            { ?>
                                                                <li>
                                                                    <a href="#" onclick="$operator.call({div: '#menu_tab', title: '<?php echo $each_item3->name; ?>', is_tab: '<?php echo $each_item3->is_tab; ?>', is_shortcut: '<?php echo $each_item3->is_shortcut; ?>', has_child: '<?php echo $each_item3->has_child; ?>'})" > <?php echo $each_item3->name; ?></a>
                                                                </li>
                                                            <?php
                                                            } ?>
                                                        </ul>
                                                    <?php
                                                    } ?>
                                                <?
                                                }
                                                ?>
                                            </li>
                                        <?php
                                        } ?>
                                    </ul>
                                <?php
                                } ?>
                            <?
                            }
                            ?>
                        </li>
                    <?php
                    } ?>
                </ul>
            <?php
            }
            ?>
            <div class="clear"></div>
            </div>
            <div id="shortcut_menu">
                <div class="horizontal_pad">
                    <ul>
                        <!-- Child Menu Shortcut -->
                        <?php
                        $cms_obj = $menu->query(array(
                            'select' => '*',
                            'from'   => 'menu_child',
                            'where'  => "(is_shortcut='Y')",
                            'format' => 'Object'
                        ));
                        if (!empty($cms_obj))
                        {
                            foreach($cms_obj as $each_cms_obj)
                            { ?>
                                <li>
                                    <a href="#" title="<?php echo $each_cms_obj->name; ?>" class="tablet" style="background-position: <?php echo $each_cms_obj->bg_pos; ?>;" onclick="$operator.call({div: '#menu_tab', title: '<?php echo $each_cms_obj->name; ?>', is_tab: '<?php echo $each_cms_obj->is_tab; ?>', is_shortcut: '<?php echo $each_cms_obj->is_shortcut; ?>', has_child: '<?php echo $each_cms_obj->has_child; ?>'})" >
                                        <div class="label">
                                        <?php
                                            if (strlen($each_cms_obj->name) > 12)
                                            {
                                                $name = explode(' ', $each_cms_obj->name);
                                                if (strlen($name[0]) > 12)
                                                {
                                                    echo substr($name[0], 0, 10).'...';
                                                } else {
                                                    echo $name[0];
                                                }
                                                
                                            } else {
                                                echo $each_cms_obj->name;
                                            }
                                        ?>
                                        </div>
                                    </a>
                                </li>
                            <?php
                            }
                        }
                        ?>
                        
                        <!-- Grand Child Menu Shortcut -->
                        <?php
                        $gcms_obj = $menu->query(array(
                            'select' => '*',
                            'from'   => 'menu_grand_child',
                            'where'  => "(is_shortcut='Y')",
                            'format' => 'Object'
                        ));
                        if (!empty($gcms_obj))
                        {
                            foreach($gcms_obj as $each_gcms_obj)
                            { ?>
                                <li>
                                    <a href="#" title="<?php echo $each_gcms_obj->name; ?>" class="tablet" style="background-position: <?php echo $each_gcms_obj->bg_pos; ?>;" onclick="$operator.call({div: '#menu_tab', title: '<?php echo $each_gcms_obj->name; ?>', is_tab: '<?php echo $each_gcms_obj->is_tab; ?>', is_shortcut: '<?php echo $each_gcms_obj->is_shortcut; ?>', has_child: '<?php echo $each_gcms_obj->has_child; ?>'})" >
                                        <div class="label">
                                        <?php
                                            if (strlen($each_gcms_obj->name) > 12)
                                            {
                                                $name = explode(' ', $each_gcms_obj->name);
                                                if (strlen($name[0]) > 12)
                                                {
                                                    echo substr($name[0], 0, 10).'...';
                                                } else {
                                                    echo $name[0];
                                                }
                                                
                                            } else {
                                                echo $each_gcms_obj->name;
                                            }
                                        ?>
                                        </div>
                                    </a>
                                </li>
                            <?php
                            }
                        }
                        ?>
                        
                        <!-- Menu Shortcut -->
                        <?php
                        $ms_obj = $menu->query(array(
                            'select' => '*',
                            'from'   => 'menu',
                            'where'  => "(is_shortcut='Y')",
                            'format' => 'Object'
                        ));
                        if (!empty($ms_obj))
                        {
                            foreach($ms_obj as $each_ms_obj)
                            { ?>
                                <li>
                                    <a href="#" title="<?php echo $each_ms_obj->name; ?>" class="tablet" style="background-position: <?php echo $each_ms_obj->bg_pos; ?>;" onclick="$operator.call({div: '#menu_tab', title: '<?php echo $each_ms_obj->name; ?>', is_tab: '<?php echo $each_ms_obj->is_tab; ?>', is_shortcut: '<?php echo $each_ms_obj->is_shortcut; ?>', has_child: '<?php echo $each_ms_obj->has_child; ?>'})" >
                                        <div class="label">
                                        <?php
                                            if (strlen($each_ms_obj->name) > 12)
                                            {
                                                $name = explode(' ', $each_ms_obj->name);
                                                if (strlen($name[0]) > 12)
                                                {
                                                    echo substr($name[0], 0, 10).'...';
                                                } else {
                                                    echo $name[0];
                                                }
                                                
                                            } else {
                                                echo $each_ms_obj->name;
                                            }
                                        ?>
                                        </div>
                                    </a>
                                </li>
                            <?php
                            }
                        }
                        ?>
                    </ul>
                    
                    <div class="clear"></div>
                </div>
            </div>
            
            <div style="position: relative;">
                <div id="identity">
                    <div class="horizontal_pad">
                        <div id="logo"><img src="../calls/images/logo.png" /></div>
                    </div>
                </div>
            </div>
            
            <div class="tab">
                <div id="menu_tab"><ul></ul></div>
            </div>
            
            <div id="footer" class="gray">
            
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