<div class="outter_pad">
<div id="access" class="inner_pad">
<form name="frm_getaccess" id="frm_getaccess" method="post">
    <div id="access_msg" class="center gray">(You are allowed to select multiple User types.)</div>
    
    <p class="bold pad15px">How would you like to test this System?</p>
    
    <table class="invisible_table">
        <tr>
            <td class="gray percent1"><input name="chk_agtbro" id="chk_agtbro" type="checkbox" class="l_float" /></td>
            <td style="vertical-align: middle;"><label class="cursor_pointer blue" for='chk_agtbro'>As an Agent / Broker</label></td>
        </tr>
        <tr>
            <td class="gray"><input name="chk_staff" id="chk_staff" type="checkbox" class="l_float" /></td>
            <td style="vertical-align: middle;"><label class="cursor_pointer blue" for='chk_staff'>As Staff</label></td>
        </tr>
        <tr>
            <td class="gray"><input name="chk_client" id="chk_client" type="checkbox" class="l_float" /></td>
            <td style="vertical-align: middle;"><label class="cursor_pointer blue" for='chk_client'>As a Client</label></td>
        </tr>
        <tr>
            <td class="gray"><input name="chk_mgt" id="chk_mgt" type="checkbox" class="l_float" /></td>
            <td style="vertical-align: middle;"><label class="cursor_pointer blue" for='chk_mgt'>As Management</label></td>
        </tr>
    </table>
    
    <p class="bold pad15px">Other details:</p>
    
    <table class="visible_table">
        <tr>
            <td class="percent30">Surname:</td>
            <td><input name="csurname" id="csurname" class="txtbox" /></td>
        </tr>
        <tr>
            <td>Other Names:</td>
            <td><input name="cothname" id="cothname" class="txtbox" /></td>
        </tr>
        <tr>
            <td>Company:</td>
            <td><input name="ccompany" id="ccompany" class="txtbox" /></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input name="cemail" id="cemail" class="txtbox" /></td>
        </tr>
        <tr>
            <td>Phone:</td>
            <td>
                <table>
                    <tr>
                        <td class="l_align" style="padding: 0 6px 0 0;"><input name="cgsm" id="cgsm" class="txtbox" /></td>
                        <td class="r_align dark_gray" style="padding: 0 0 0 6px;"> <b>e.g:</b>&nbsp;23480xxxxxxxx</td>
                    </tr>
                </table>
        </tr>
        <tr>
            <td class="l_align">&nbsp;</td>
            <td class="r_align"><button name="getaccess_btn" id="getaccess_btn" type="button" onclick="javascript:$get_access(document.forms.frm_getaccess,'preview');">&nbsp; Preview &#9658;</button></td>
        </tr>
        <tr>
            <td class="l_align" colspan="2">
                <div class="font11 dark_gray">Already have your Login details? <a href="#get_access" onclick="javascript:login_blocker();" class="orange bold">Click here</a> to Login</div>
            </td>
        </tr>
    </table>
</form>
</div>
</div>