<div class="sub_wrapper">
    <div class="sub_menu patient">
        
        <div class="l_float percent15">
            <ul>
                <li class="percent100">
                    <a href="javascript:new_patient();" title="New Patient" style="padding-left: 25px;">
                        <table>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <span class="sub_menu32x32" style="background-position: 0 -32px;">&nbsp;</span>
                                </td>
                                <td style="vertical-align: middle;">
                                    New Patient
                                </td>
                            </tr>
                        </table>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="l_float" style="margin-left: -1px;">
            <ul>
                <li>
                    <table>
                        <tr>
                            <td style="vertical-align: middle;">
                                <span class="sub_menu32x32" style="background-position: center -256px; width: 2px;">&nbsp;</span>
                            </td>
                        </tr>
                    </table>
                </li>
                <li>
                    <a href="javascript:edit_patient();" title="Edit Patient">
                        <table>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <span class="sub_menu32x32" style="background-position: 0 -96px;">&nbsp;</span>
                                </td>
                                <td style="vertical-align: middle;">
                                    Edit Patient
                                </td>
                            </tr>
                        </table>
                    </a>
                </li>
                <li>
                    <a href="#" title="Delete Patient">
                        <table>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <span class="sub_menu32x32" style="background-position: 0 -160px;">&nbsp;</span>
                                </td>
                                <td style="vertical-align: middle;">
                                    Delete Patient
                                </td>
                            </tr>
                        </table>
                    </a>
                </li>
                <li>
                    <table>
                        <tr>
                            <td style="vertical-align: middle;">
                                <span class="sub_menu32x32" style="background-position: center -256px; width: 2px;">&nbsp;</span>
                            </td>
                        </tr>
                    </table>
                </li>
                <li>
                    <table>
                        <tr>
                            <td style="vertical-align: middle; padding-left: 10px;">
                                <input name="alias_search" id="alias_search" class="txtbox" />
                            </td>
                            <td style="vertical-align: middle; padding-right: 10px;">
                                <a href="javascript:alias_search();" id="alias_search_btn" title="Search Patient" style="padding: 0;">
                                    <span class="sub_menu32x32" style="background-position: 0 -224px;">&nbsp;</span>
                                </a>
                            </td>
                        </tr>
                    </table>
                </li>
            </ul>
        </div>
        
        <div class="clear"></div>
    </div>
    
    <div class="sub_content">
        <div class="side_kick">
            <div>
                <ul>
                    <li><a href="#">Today</a></li>
                    <li><a href="#">This Week</a></li>
                    <li><a href="#">This Month</a></li>
                    <li><a href="#">This Quarter</a></li>
                    <li><a href="#">This Year</a></li>
                </ul>
            </div>
        </div>
        <div class="component">
                <div class="inner_pad">
                    This is the Patients Interface
                </div>
                
                <div class="clear"></div>
        </div>
        <div class="tips">
            <div>
                &nbsp;
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
        // .sub_menu bar display
        $('.patient a').on('mouseover', function(){
            $(this).css('color','#000');
            var $span   = $(this).find('span'),
                $bg_pos = $span.css('backgroundPosition').split(" "),
                $y_pos  = parseInt($bg_pos[1]) + 32;
                $span.css('background-position', $bg_pos[0] + ' ' + $y_pos + 'px');
        });
        $('.patient a').on('mouseout', function(){
            $(this).css('color','#777');
            var $span   = $(this).find('span'),
                $bg_pos = $span.css('backgroundPosition').split(" "),
                $y_pos  = parseInt($bg_pos[1]) - 32;
                $span.css('background-position', $bg_pos[0] + ' ' + $y_pos + 'px');
        });
        
        // .sub_menu bar search
        $('#alias_search_btn').on('click', function()
        {
            // Init.
            var $search = $('#alias_search');
            
            if ($search.val() == '')
            {
                $search.css({'border-color':'red'});
                $search.focus();
            }
        })
        
        // Load the Side kick
        $file_loader.load_side_kick('patients/default_side_menu');
        
        // Balance the height
        $init.height_balance();
    });
    
    var alias_search = function()
    {
        // Storing the content of the Patient Search box
        var $alias = $('#alias_search').val()
        
        // Fetch records based on the Patient search criteria
        if ('' != $alias)
        {
            $.ajax({
                url: "../calls/includes/switch.php",
                type: "POST",
                data: {'alias':$alias,'opt':'alias_search'},
                dataType: "json",
                success: function($json)
                {
                    if($json.status == "true")
                    {
                        //$ui_engine.block({title:'Alert!',file:'alert_successful',width:'200',height:'120',buttons:'NNY'});
                        $file_loader.load_component('patients/fetch_patient');
                        $file_loader.load_side_kick('patients/patient_side_menu');
                    }else{
                        $ui_engine.block({title:'Alert!',file:'alert_failure',width:'200',height:'120',buttons:'NNY'});
                    }
                },
                error: function(request, status, error)
                {
                    //alert(request.responseText);
                    $('#login_msg').html("<span class='red_bg white msg'><b>LOGIN ERROR:</b> Please, Try Again.</span>");
                }
            });
        }
    },
        
    // Set the interface to accept new Patient details
    new_patient = function()
    {
        $file_loader.load_component('patients/new_patient');
        $file_loader.load_side_kick('patients/default_side_menu');
    }
    
    // Set the interface to edit existing Patient details
    edit_patient = function()
    {
        $file_loader.load_component('patients/edit_patient');
        $file_loader.load_side_kick('patients/default_side_menu');
    }
</script>