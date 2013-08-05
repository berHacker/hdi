/**
 * @author Hope Gates
 * @copyright 2012
 */

/**
 * $(document).ready()
 *
 * JQuery / Javascript file
 *
 */
$(document).ready(function()
{
    ////////////////////
    /* OPEN SOME TABS */
    ////////////////////
    
    $('#menu_tab').tabs(
    {
        // ui.ajaxSettings.url -> "../calls/includes/tabs/patients.php"
        // ui.panel.selector   -> "#ui-tabs-1"
        
        // Before a tab is loaded
        beforeLoad: function(event, ui)
        {
            // If the tab can not load it's content
			ui.jqXHR.error(function()
            {
                $( "#footer" ).css({"border-top":"none"});
				ui.panel.html( "<div class='outer_pad'><div class='inner_pad gray white_shadow text_light'><b>Oops!</b> Unable to load this page at the moment. Please, try again.</div></div>" );
			});
            
            var $selector = ui.panel.selector,
                $slice    = $selector.slice(1);
            
            // Find this tab that is a about to be loaded
            $( "ul.ui-tabs-nav li" ).each(function()
            {
                if( $(this).attr( "aria-controls" ) == $slice )
                {
                    // Remove the URL that loaded the tab's content
                    $(this).children( "a" ).attr( "href",$selector );
                }
            })
        }
    });
    
    // Array build for default tabs
    var $tab_arr =  [
                        {"title":"patients","file":"patients"},
                        {"title":"day sheet","file":"day_sheet"}
                    ];
                    
    // Launch default tabs
    $init.default_tabs($tab_arr);
    
    ///////////////////
    /* DROPDOWN MENU */
    ///////////////////
    
    var $menu        = $('div#menu > ul > li'),
        $menu_child  = $('div#menu > ul > li > ul > li'),
        $grand_child = $('div#menu > ul > li > ul > li > ul > li'),
        
        $down_arrow  = "&#9660;",
        $up_arrow    = "&#9650;",
        $left_arrow  = "&#9668;",
        $right_arrow = "&#9658;";
    
    $menu.find('ul').hide();
    
    /* First List */
    $('div#menu > ul > li').has('ul').children('a').append('&nbsp;&nbsp;' + $down_arrow);
    $menu.on('mouseenter',function(){
        $(this).children('a').css({'background-color':'#555','color':'#FFF'});
        $(this).children('ul').show();
    });
    $menu.on('mouseleave',function(){
        $(this).children('a').css({'background-color':'transparent','color':'#888'});
        $(this).children('ul').hide();
    });
    
    /* Second List */
    $menu_child.has('ul').children('a').append("&nbsp;&nbsp;<span class='r_float'>" + $right_arrow + '</span>');
    $menu_child.on('mouseenter',function(){
        $(this).children('a').css({'background-color':'#555','color':'#FFF'});
        $(this).children('ul').show();
    });
    $menu_child.on('mouseleave',function(){
        $(this).children('a').css({'background-color':'transparent','color':'#888'});
        $(this).children('ul').hide();
    });
    
    ////////////////
    /* UI BLOCKER */
    ////////////////
    
    //$ui_engine.preload_ui();
    
    ////////////////////////
    /* General Formatting */
    ////////////////////////
    
    // Prevent default behaviour in UI Blocker
    $( "#ui_header div ul li a" ).on('click', function($this)
    {
        $this.preventDefault();
    });
    
    // Repositioning the UI Blocker
    $(window).on('resize', function()
    {
        // Apply Standard height 
        $init.height_balance();
        
        // Don't reposition if the ui blocker is maximized
        if($ui_engine.config.status != 'maximized')
        {
            clearTimeout($.data(this, "delay"));
            $.data(this, "delay", setTimeout(function() {
                $ui_engine.preload_ui();
            }, 250));
        }
    });
    
    $(window).on('scroll', function()
    {
        // Don't reposition if the ui blocker is maximized
        if($ui_engine.config.status != 'maximized')
        {
            clearTimeout($.data(this, "delay"));
            $.data(this, "delay", setTimeout(function() {
                // Re-position the UI Blocker
                $ui_engine.preload_ui();
            }, 250));
        }
    });
});

// Engines

var $init = 
{
    height_balance: function()
    {
        var 
            // Fetch the "href" of the current active tab
            $href = $( "li.ui-state-active" ).children('a').attr( "href" ),
        
            // Standard height settings
            $win_height    = $(window).height(),
            $footer_height = $( "#footer" ).outerHeight(),
            $div_offset    = $( $href + " > .sub_wrapper"  ).offset().top,
            $height        = $win_height - $footer_height - $div_offset;
        
        // Reset Standard heights        
        $( ".side_kick, .component, .tips" ).height( $height - 44 ); // Actually, I don't know where this 44 came from :(
    },
    
    default_tabs: function($tab_arr)
    {        
        // Init.
        var $n = 0, $arr_len = $tab_arr.length;
        
        // Launch tab immediately
        $tab_engine.open_tab({div: "#menu_tab", title: $tab_arr[$n]['title'], file: $tab_arr[$n]['file']});
        
        // If array has other children
        if ( $arr_len > 1 )
        {
            // Increment
            $n++;
            
            // Init.
            var $interval = self.setInterval(function()
                {
                    // Launch other tabs
                    $tab_engine.open_tab({div: "#menu_tab", title: $tab_arr[$n]['title'], file: $tab_arr[$n]['file']});
                    
                    if ( ($arr_len - 1) > $n )
                    {
                        // Increment
                        $n++;
                    }
                    else
                    {
                        // Exit
                        $interval = window.clearInterval($interval);
                    }
                },800);
        }
    },
    
    equalize_heights: function($array)
    {
        var $len = $array.length;
        
        // Are there more than 1 set of records
        if ($len > 1)
        {
            // Init.
            var $max_len = 0, $new_len = 0;
            
            // Find the longest
            for (var $x = 0; $x < $len; $x++)
            {
                $new_len = $($array[$x]).height();
                
                if ($new_len > $max_len)
                {
                    $max_len = $new_len;
                }
            }
            
            // Qualize all
            for (var $y = 0; $y < $len; $y++)
            {
                $($array[$y]).height($max_len);
            }
        }
    }
},

$date_engine =
{
    // Fetch age
    get_age: function($date,$target)
    {
        // Incoming date
        if ($date != '')
        {
            var
                // Current date
                $new_curr_date = this.get_current_date(),
                $raw_in_date   = $date,
                $split_in_date = $raw_in_date.split("/"),
                $new_in_date   = $split_in_date[2] + '/' + $split_in_date[1] + '/' + $split_in_date[0],
                $curr_date     = new Date($new_curr_date),
                $in_date       = new Date($new_in_date),
                $year_diff     = this.year_diff($curr_date,$in_date);
            
            // Age
            $( $target ).val($year_diff);
        }
    },
    
    // Fetch date of birth
    get_dob: function($age,$target)
    {
        // Incoming date
        if ($age != '')
        {
            clearTimeout($.data(this, "delay"));
            $.data(this, "delay", setTimeout(function() {
                    var
                        // Current date
                        $new_curr_date = $date_engine.get_current_date(),
                        $curr_date     = new Date($new_curr_date),
                        $dob_year      = $curr_date.getFullYear() - $age;
                    
                    // Date
                    $( $target ).val('01/01/' + $dob_year);
            }, 800));
        }
    },
    
    // Current date
    get_current_date: function()
    {
        var curr_date = new Date(),
            day       = curr_date.getDate(),
            month     = curr_date.getMonth() + 1,
            year      = curr_date.getFullYear(),
            date      = '';
            
            // Padding Day and Month
            if ((month > 9) && (day < 10))
            {
                date = year + "-" + month + "-0" + day;
            }
            else if ((month < 10) && (day > 9))
            {
                date = year + "-0" + month + "-" + day;
            }
            else if ((month < 10) && (day < 10))
            {
                date = year + "-0" + month + "-0" + day;
            }
            else
            {
                date = year + "-" + month + "-" + day;
            }
            
            return date;
    },
    
    // First day of incoming date
    first_day: function($date)
    {
        var first_day = new Date($date.getFullYear(), $date.getMonth(), 1);
        
        return first_day.getDate();
    },
    
    // Last day of incoming date
    last_day: function($date)
    {
        var $last_day = new Date($date.getFullYear(), $date.getMonth() + 1, 0);
        
        return $last_day.getDate();
    },
    
    // Year diff with current date
    year_diff: function($current_date,$incoming_date)
    {
        var
            $current_year  = $current_date.getFullYear(),
            $incoming_year = $incoming_date.getFullYear(),
            $year_diff     = $current_year - $incoming_year;
        
        return $year_diff;
    },
    
    // Month diff with current date
    month_diff: function($current_date,$incoming_date)
    {
        var
            //$year_diff      = this.year_diff($current_date,$incoming_date),
            $current_month  = $current_date.getMonth() + 1,
            $incoming_month = $incoming_date.getMonth() + 1,
            $month_diff     = $current_month - $incoming_month;
        
        return $month_diff;
    },
    
    // Day diff with current date
    day_diff: function($current_date,$incoming_date)
    {
        var
            $current_day       = $current_date.getDate(),
            $current_last_day  = this.last_day($current_date),
            $incoming_day      = $incoming_date.getDate(),
            $incoming_last_day = this.last_day($incoming_date),
            $day_diff;
        
        if ($current_date.getMonth() == $incoming_date.getMonth())
        {
            $day_diff = $current_date.getDate() - $incoming_date.getDate();
        }
        else if ($current_date.getMonth() > $incoming_date.getMonth())
        {
            $day_diff = $current_day + ($incoming_last_day - $incoming_day);
        }
        else
        {
            $day_diff = ($current_day - $current_last_day) - $incoming_day;
        }
        
        //return $day_diff;
        return $day_diff;
    }
},

$ui_engine =
{
    block: function($settings)
    {
        $.extend(this.config,$settings);
        
        $('#ui_title').html(this.config.title);
        $( "#ui_content" ).height(this.config.height - 30);
        $('#ui_content').load('../calls/includes/ui_blocker/' + this.config.file + '.php');
        
        this.preload_ui();
        //this.draggable('#ui');
        
        $('#ui_bg').fadeIn('slow', function()
        {
            $('#ui').fadeIn('fast');
            //$ui_engine.preload_buttons();            
        });
    },
    
    config:
    {
        title:   'Application',
        file:    'default',
        width:   '600',
        height:  '400',
        status:  'default',
        buttons: 'YYY' //minimize_maximize_close
    },
    
    close: function()
    {
        // Hide the blinder
        $('#ui').fadeOut('slow', function()
        {
            $('#ui_bg').fadeOut('fast');
        
            // The resize method image (toggle_size())
            var $resize_btn = $('#ui ul li').eq(1).children('a');
                $resize_btn.css({'background-position':'-33px 0'});
                $resize_btn.attr('title', 'Maximize');
                
            $ui_engine.config.status = 'default';
        });
    },
        
    toggle_size: function()
    {
        if (this.config.status == 'default') // the "minimized" keyword is reserved
        {
            $('#ui').animate({
                'width'  :$('#ui_bg').width(),
                'height' :$('#ui_bg').height(),
                'top'    :'0',
                'left'   :'0'
                
            }, function() {
                    // Enlarge the screen
                    var $resize_btn = $('#ui ul li').eq(1).children('a');
                        $resize_btn.css({'background-position':'-99px 0'});
                        $resize_btn.attr('title', 'Restore Down');
                    
                    // Set status to "maximized"
                    $ui_engine.config.status = 'maximized';
               });
        }
        else if (this.config.status == 'maximized')
        {
            this.cleanup_size();
            
            var $w, $h;
            
            $w  = (($(window).width() / 2) - (this.config.width / 2)),
            $h  = (($(window).height() / 2) - (this.config.height / 2));
            
            $('#ui').animate({
                'width'  :this.config.width,
                'height' :this.config.height,
                'top'    :$h,
                'left'   :$w
                
            }, function() {
                    // Enlarge the screen
                    var $resize_btn = $('#ui ul li').eq(1).children('a');
                        $resize_btn.css({'background-position':'-33px 0'});
                        $resize_btn.attr('title', 'Maximize');
                    
                    // Set status to "maximized"
                    $ui_engine.config.status = 'default';
               });
        }
    },
    
    toggle_fold: function()
    {
        alert('minimize?');
    },
    
    cleanup_size: function()
    {
        // Width manager
        if(this.config.width < 400)
        {
            this.config.width = 400;
        }
        
        // Height manager
        if(this.config.height < 100)
        {
            this.config.height = 100;
        }
    },
    
    preload_ui: function()
    {
        
        // The resize method image (toggle_size())
        var $resize_btn = $('#ui ul li').eq(1).children('a');
            $resize_btn.css({'background-position':'-33px 0'});
            $resize_btn.attr('title', 'Maximize');
            
        $ui_engine.config.status = 'default';
            
        this.preload_buttons();
        
        var $w, $h, $ui = $('#ui');
        this.cleanup_size();
        
        // Centralize DIV
        $ui.css({
            'width'  :this.config.width  + 'px',
            'height' :this.config.height + 'px',
        });
            
        $w  = (($(window).width() / 2)  - ($ui.outerWidth() / 2)),
        $h  = (($(window).height() / 2) - ($ui.outerHeight() / 2)) + $(window).scrollTop();
        
        $ui.animate({
            'left'     :$w + 'px',
            'top'      :$h + 'px',
            'position' :'absolute'
        });
    },
    
    draggable: function(element)
    {
        element = $(element);
        
        // Move the element by the amount of change in the mouse position
        var $move = function(event)
        {
            if(element.data('mouseMove'))
            {
                var change_X = event.clientX - element.data('mouseX');
                var change_Y = event.clientY - element.data('mouseY');
                
                var new_X = parseInt(element.css('left')) + change_X;
                var new_Y = parseInt(element.css('top'))  + change_Y;
                
                element.css('left', new_X);
                element.css('top', new_Y);
                
                element.data('mouseX', event.clientX);
                element.data('mouseY', event.clientY);
            }
        }
        
        element.mousedown(function(event)
        {
            element.data('mouseMove', true);
            element.data('mouseX', event.clientX);
            element.data('mouseY', event.clientY);
        });
        
        element.parents(':last').mouseup(function()
        {
            element.data('mouseMove', false);
        });
        
        element.mouseout($move);
        element.mousemove($move);
    },
    
    preload_buttons: function()
    {
        // Fetch the button status
        var $btn = this.config.buttons;
        
        // Buttons
        $min   = $btn[0];     
        $max   = $btn[1];     
        $close = $btn[2];
        
        if ($min == 'N')
        // Deactivate the Minimize button
        {
            var $min_btn = $('#ui ul li').eq(0).children('a');
                $min_btn.css({
                    'background-position':'0 30px',
                    'cursor':'default'                    
                });
                $min_btn.attr({
                    'title':'',
                    'onclick':''
                });
        }
        
        if ($max == 'N')
        // Deactivate the Maximize button
        {
            var $max_btn = $('#ui ul li').eq(1).children('a');
                $max_btn.css({
                    'background-position':'-33px 30px',
                    'cursor':'default'
                });
                $max_btn.attr({
                    'title':'',
                    'onclick':'return false'
                });
        }
        
        if ($close == 'N')
        // Deactivate the Close button
        {
            var $close_btn = $('#ui ul li').eq(2).children('a');
                $close_btn.css({
                    'background-position':'-66px 30px',
                    'cursor':'default'
                });
                $close_btn.attr({
                    'title':'',
                    'onclick':''
                });
        }
    }
},

$tab_engine =
{
    open_tab: function($settings)
    {
        // Config
        $.extend(this.config,$settings);
        
        // Create tab
        this.create_tab();
    },
    
    init: function()
    {
        // Activating the Menu tab
        $tabs = $( this.config.div ).tabs();
        $tabs.tabs("refresh");
        
        return $tabs;
    },
                    
    config:
    {
        div:       '#div',
        title:     'New Title',
        content:   '',
        file:      '',
        id_number: 0,
        counter:   0
    },
    
    activate_tab: function($tab_position)
    {
        // Instantiate tab
        $tabs = this.init();
        
        // Activate tab
        $tabs.tabs( "option", "active", ( $tab_position - 1 ) );
    },
    
    close_tab: function($this)
    {
        // Decrement
        this.config.counter--;
        
        var $href     = $($this).parent('a').attr('href'),
            $href_arr = $href.split('-'),
            $href_num = $href_arr[$href_arr.length - 1],
            
            // Instantiate tab
            $tabs = this.init();
        
        // Close icon: removing the tab on click
        var $id = $( $this ).closest( "li" ).remove().attr( "aria-controls" );
        $( "#" + $id ).remove();
        
        // Instantiate tab
        this.activate_tab($href_num);
        
        // Apply Standard height 
        $init.height_balance();
    },
    
    create_tab: function()
    {
        var
            // Instantiate tab
            $tabs = this.init(),
                
            // Fetching tab title
            $label    = this.config.title.toUpperCase(),
            
            $x = 0, $create_tab = true;
        
        // Avoiding duplication
        $( "ul.ui-tabs-nav > li > a" ).each(function()
        {
            if ( $(this).children("span").eq(0).text() == $label )
            {
                var $href       = $(this).attr('href'),
                    $href_arr   = $href.split('-'),
                    $href_num   = $href_arr[$href_arr.length - 1];
                
                $tabs.tabs( "option", "active", ($x) );
                $tabs.tabs( "refresh" );
                $create_tab = false;
        
                // Apply Standard height 
                $init.height_balance();
            }
            $x++;
        });
        
        if ($create_tab)
        {
            var
                // External file
                $file_url = '../calls/includes/tabs/' + this.config.file + '.php',
                
                // Counter
                $counter  = this.config.counter;
            
                // Building the "li"
                $li       = "<li><a href='" + $file_url + "'><span>" + $label + "</span>&nbsp;&nbsp;<span class='close' title='Close this tab' onclick='javascript:$tab_engine.close_tab(this);' style='font-weight:bold;padding:2px 3px;cursor:pointer;'>&#215;</span></a></li>";
        
            // Find the "ul"
            $tabs.find( "ul.ui-tabs-nav" ).append( $li );
            
            // Refresh
            $tabs.tabs( "refresh" );
            
            // Active
            $tabs.tabs( "option", "active", $counter );
            
            // Load
            $tabs.tabs( "option", "load", $counter );
            
            // Increment
            this.config.counter++;
        
            //  Formatting the tab Close button
            $("#menu_tab .close").css({"color":"#333"});
            $("#menu_tab .close").on("mouseenter", function(){
                $(this).css({"color":"red"});
            });
            $("#menu_tab .close").on("mouseleave", function(){
                $(this).css({"color":"#333"});
            });
        }
    }
},

$file_loader =
{
    load_sub_wrapper: function($file)
    {
        var
            // Fetch the "href" of the current active tab
            $href     = $( "li.ui-state-active" ).children('a').attr( "href" ),
            
            // External file
            $file_url = '../calls/includes/tabs/' + $file + '.php';
            
        // Load Sub Content
        $( $href + " > .sub_wrapper"  ).load( $file_url );
    },
    
    load_sub_menu: function($file)
    {
        var
            // Fetch the "href" of the current active tab
            $href     = $( "li.ui-state-active" ).children('a').attr( "href" ),
            
            // External file
            $file_url = '../calls/includes/tabs/' + $file + '.php';
            
        // Load Sub Content
        $( $href + " > .sub_wrapper .sub_menu"  ).load( $file_url );
    },
    
    load_sub_content: function($file)
    {
        var
            // Fetch the "href" of the current active tab
            $href     = $( "li.ui-state-active" ).children('a').attr( "href" ),
            
            // External file
            $file_url = '../calls/includes/tabs/' + $file + '.php';
            
        // Load Sub Content
        $( $href + " > .sub_wrapper .sub_content"  ).load( $file_url );
    },
    
    load_side_kick: function($file)
    {
        var
            // Fetch the "href" of the current active tab
            $href     = $( "li.ui-state-active" ).children('a').attr( "href" ),
            
            // External file
            $file_url = '../calls/includes/tabs/' + $file + '.php';
            
        // Load Side Kick
        $( $href + " > .sub_wrapper .side_kick"  ).load( $file_url );
    },
    
    load_component: function($file)
    {
        var
            // Fetch the "href" of the current active tab
            $href     = $( "li.ui-state-active" ).children('a').attr( "href" ),
            
            // External file
            $file_url = '../calls/includes/tabs/' + $file + '.php';
            
        // Load Component
        $( $href + " > .sub_wrapper .component"  ).load( $file_url );
    },
    
    load_tips: function($file)
    {
        var
            // Fetch the "href" of the current active tab
            $href     = $( "li.ui-state-active" ).children('a').attr( "href" ),
            
            // External file
            $file_url = '../calls/includes/tabs/' + $file + '.php';
            
        // Load Tips
        $( $href + " > .sub_wrapper .tips"  ).load( $file_url );
    }
}

// Validation

$safe_logout =
{
    exit: function($form)
    {
        $.ajax({
            url: "../calls/includes/switch.php",
            type: "POST",
            data: {'opt':'exit'},
            dataType: "json",
            success: function($json)
            {
                if($json.status == "true")
                {
                    $('#login_msg').html("<span class='green_bg white msg'>" + $json.msg + "</span>");
                    $form.submit();
                }else{
                    $('#login_msg').html("<span class='red_bg white msg'>" + $json.msg + "</span>");
                }
            },
            error: function(request, status, error)
            {
                //alert(request.responseText);
                $('#login_msg').html("<span class='red_bg white msg'><b>LOGOUT ERROR:</b> Please, Try Again.</span>");
            }
        });
    },
    
    backup: function($form)
    {
        alert($($form).serialize());
        alert($form.logout_btn.value);
        /*$.ajax({
            url: "calls/includes/switch.php",
            type: "POST",
            data: $data,
            dataType: "json",
            success: function($json)
            {
                if($json.status == "true")
                {
                    $('#login_msg').html("<span class='green_bg white msg'>" + $json.msg + "</span>");
                    $form.action = "admin/";
                    $form.submit();
                }else{
                    $('#login_msg').html("<span class='red_bg white msg'>" + $json.msg + "</span>");
                }
            },
            error: function(request, status, error)
            {
                //alert(request.responseText);
                $('#login_msg').html("<span class='red_bg white msg'><b>LOGIN ERROR:</b> Please, Try Again.</span>");
            }
        });*/
    }
},

$validator =
{
    activate: function($validation_arr)
    {
        for (var $x = 0; $x < $validation_arr.length; $x++)
        {
            $($validation_arr[$x].name).prop("validate", $validation_arr[$x].type);
        }
    },
    
    show_tooltip: function($tt_arr)
    {
        // Positioning the tooltip
        $tt_arr[0].caller.closest(".fieldset").find(".tooltip").css({
            'position':'absolute',
            'display':'block',
            'top':$tt_arr[0].top,
            'left':$tt_arr[0].left
        });
        
        // Message to display
        $(".tooltip span").html($tt_arr[0].msg);
    },
    
    hide_tooltip: function()
    {
        // Switch-off the tooltip
        $(".tooltip").css({
            'position':'absolute',
            'display':'none',
            'top':0,
            'left':0
        })
    }
},

$ajax_loading = function ($target_id,$file_url,$data)
{
    $.ajax({
        type: "POST",  
        url:  $file_url,
        data: $data,
        
        /*beforeSend: function()
        {
            // Loading image
            $("#"+$target_id).html("<img src='ajax-loader.gif' />");
        },*/
        
        success: function( $msg )
        {
            // Successful request
            $( "#" + $target_id ).html( $msg );
        },
        
        error: function()
        {
            // Failed request
            $( "#" + $target_id ).html('<span class="red"><b>Oops!</b> Please, try again.</span>');
        }
    });
},

// Operator

$operator =
{
    call: function ( $incoming )
    {
        if (( $incoming['is_tab'] == 'N') && ($incoming['has_child'] == 'N' ))
        {
            if ( $incoming['title'] == 'Log Out' )
            {
                backup_blocker();
            }
            else if ($incoming['title'] == 'Toggle Shortcuts')
            {
                this.toggle_display('#shortcut_menu');
            }
        }
        else if (( $incoming['is_tab'] == 'Y' ) && ( $incoming['has_child'] == 'N' ))
        {
            $incoming['file'] = $incoming['title'].split(' ').join('_').toLowerCase();
            $tab_engine.open_tab($incoming);
        }
    },
    
    toggle_display: function($this)
    {
        if ( $( $this ).is( ':hidden' ) )
        {
            $( $this ).show();
        }
        else
        {
            $( $this ).hide();
        }
        
        // Apply Standard height 
        $init.height_balance();
    }
};