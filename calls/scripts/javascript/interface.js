jQuery(document).ready(function($)
{
    //////////
    /* TABS */
    //////////
    
    $( "#users_tab" ).tabs();
    
    ///////////////////
    /* DROPDOWN MENU */
    ///////////////////
    
    var $menu             = $('div#menu > ul > li'),
        $child_menu       = $('div#menu > ul > li > ul > li'),
        $grand_child_menu = $('div#menu > ul > li > ul > li > ul > li'),
        
        $down_arrow  = "&#9660;",
        $up_arrow    = "&#9650;",
        $left_arrow  = "&#9668;",
        $right_arrow = "&#9658;";
    
    $menu.find('ul').hide();
    
    /* First List */
    $menu.has('ul').children('a').append('&nbsp;&nbsp;' + $down_arrow);
    $menu.on('mouseenter',function(){
        $(this).children('a').css({'background-color':'#777','color':'#FFF'});
        $(this).children('ul').show();
    });
    $menu.on('mouseleave',function(){
        $(this).children('a').css({'background-color':'transparent','color':'#777'});
        $(this).children('ul').hide();
    });
    
    /* Second List */
    $child_menu.has('ul').children('a').append("&nbsp;&nbsp;<span class='r_float'>" + $right_arrow + '</span>');
    $child_menu.on('mouseenter',function(){
        $(this).children('a').css({'background-color':'#777','color':'#FFF'});
        $(this).children('ul').show();
    });
    $child_menu.on('mouseleave',function(){
        $(this).children('a').css({'background-color':'transparent','color':'#E2E2E2'});
        $(this).children('ul').hide();
    });
    
    ///////////////////
    /* SEARCH BUTTON */
    ///////////////////
    
    $('#search .search_box #txt_search').on('focus', function(){
        $(this).animate({'width':'155px'});
    })
    
    $('#search .search_box #txt_search').on('blur', function(){
        $(this).animate({'width':'55px'});
    })
    
    ////////////////
    /* UI BLOCKER */
    ////////////////
    
    //$ui_engine.preload_ui();
    
    ////////////////////////
    /* General Formatting */
    ////////////////////////
    
    $('#ui li a').on('mouseenter', function()
    {
        $(this).css({
            'background-image':'images/interface/prelogin/blind.png',
            'background-repeat':'repeat'
        });
    });
    
    // Repositioning the UI Blocker
    $(window).on('resize', function()
    {
        // Don't reposition if the ui blocker is maximized
        if($ui_engine.config.status != 'maximized')
        {
            // Reposition the ui blocker
            clearTimeout($.data(this, "scrollTimer"));
            $.data(this, "scrollTimer", setTimeout(function()
            {
                $ui_engine.preload_ui();
            }, 250));
        }
        
        if($ui_engine.config.status == 'maximized')
        {
            // Resize the UI
            clearTimeout($.data(this, "scrollTimer"));
            $.data(this, "scrollTimer", setTimeout(function()
            {
                $('#ui').animate({
                    'width'  :$('#ui_bg').width(),
                    'height' :$('#ui_bg').height(),
                    'top'    :'0',
                    'left'   :'0'
                });
            }, 250));
        }
    });
    
    $(window).on('scroll', function()
    {
        // Don't reposition if the ui blocker is maximized
        if($ui_engine.config.status != 'maximized')
        {
            clearTimeout($.data(this, "scrollTimer"));
            $.data(this, "scrollTimer", setTimeout(function()
            {
                $ui_engine.preload_ui();
            }, 250));
        }
    });
});

var $ui_engine =
{
    block: function($settings)
    {
        $.extend(this.config,$settings);
        
        $('#ui_title').html(this.config.title);
        $( "#ui_content" ).height(this.config.height - 30);
        $('#ui_content').load('calls/includes/ui_blocker/' + this.config.file + '.php');
        
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
        // Deactivate the Maximize button
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

$user_auth = function($form)
{
    // Form
    var $id        = $form.login_id.value,
        $pass      = $form.passcode.value,
        $form_data = $($form).serialize(),
        $data      = 'opt=auth&' + $form_data;
    
    if ($id != "")
    {
        if ($pass != "")
        {
            // Assigning values back to form
            $form.login_id.value   = $id;
            $form.passcode.value = $pass;
            
            $.ajax({
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
                    alert(request.responseText);
                    $('#login_msg').html("<span class='red_bg white msg'><b>LOGIN ERROR:</b> Please, Try Again.</span>");
                }
            });
        } else {
            $('#login_msg').html("<span class='red_bg white msg'><b>ERROR:</b> Please, Enter Your Password.</span>");
            $form.passcode.focus();
        }
    } else {
        $('#login_msg').html("<span class='red_bg white msg'><b>ERROR:</b> Please, Enter Your Login ID.</span>");
        $form.login_id.focus();
    }
},

$get_access = function($form, $mode)
{
    // Init.
    var $chk_agtbro = (($form.chk_agtbro.checked) || ($form.chk_agtbro.value == 'checked')) ? 'checked': '',
        $chk_staff  = (($form.chk_staff.checked)  || ($form.chk_staff.value  == 'checked')) ? 'checked': '',
        $chk_client = (($form.chk_client.checked) || ($form.chk_client.value == 'checked')) ? 'checked': '',
        $chk_mgt    = (($form.chk_mgt.checked)    || ($form.chk_mgt.value    == 'checked')) ? 'checked': '',
        $csurname   = $form.csurname.value,
        $cothname   = $form.cothname.value,
        $ccompany   = $form.ccompany.value,
        $cemail     = $form.cemail.value,
        $cgsm       = $form.cgsm.value;
    
    // User Type (At least one must be selected)
    if (($chk_agtbro == '') && ($chk_staff == '') && ($chk_client == '') && ($chk_mgt == ''))
    {
        $('#access_msg').html("<span class='red_bg white msg'><b>ERROR:</b> Please, Select at least, one User Type.</span>");
        return false;
    }
    // Surname (Must not be empty)
    else if ($csurname == '')
    {
        $('#access_msg').html("<span class='red_bg white msg'><b>ERROR:</b> Please, Enter Your Surname.</span>");
        $form.csurname.focus();
        return false;
    }
    // Other Names (Must not be empty)
    else if ($cothname == '')
    {
        $('#access_msg').html("<span class='red_bg white msg'><b>ERROR:</b> Please, Enter Your Other Names.</span>");
        $form.cothname.focus();
        return false;
    }
    // Email (Must not be empty)
    else if ($cemail == '')
    {
        $('#access_msg').html("<span class='red_bg white msg'><b>ERROR:</b> Please, Enter Your Email Address.</span>");
        $form.cemail.focus();
        return false;
    }
    // Phone (Must not be empty)
    else if ($cgsm == '')
    {
        $('#access_msg').html("<span class='red_bg white msg'><b>ERROR:</b> Please, Enter Your Phone Number.</span>");
        $form.cgsm.focus();
        return false;
    }
    
    // Company (Set a defaul value if it is empty)
    if ($ccompany == '')
    {
        $ccompany = '- -';
    }
    
    $.ajax({
        url: "prelogin_utils/switch.php",
        type: "GET",
        data: {
            'opt':        'access',
            'access_opt': $mode,
            'chk_agtbro': $chk_agtbro,
            'chk_staff':  $chk_staff,
            'chk_client': $chk_client,
            'chk_mgt':    $chk_mgt,
            'csurname':   $csurname,
            'cothname':   $cothname,
            'ccompany':   $ccompany,
            'cemail':     $cemail,
            'cgsm':       $cgsm
        },
        dataType: "html",
        success: function($html)
        {
            $('#access').html($html);
        },
        error: function(request, status, error)
        {
            //alert(request.responseText);
            $('#access').html("<span class='red_bg white msg'><b>ACCESS ERROR:</b> Please, Try Again.</span>");
        }
    });
};