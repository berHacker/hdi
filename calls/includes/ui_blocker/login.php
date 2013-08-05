<div class="outter_pad">
<div class="inner_pad">
<form name="frm_login" id="frm_login" method="post">
    <div id="login_msg" class="center dark_gray" style="padding-bottom: 20px;">Enter Your Login Details here.</div>
    <table class="visible_table">
        <tr>
            <td class="bold coy_color">
                Login ID:
            </td>
            <td>
                <input type="text" name="login_id" id="login_id" maxlength="32" class="txtbox" autocomplete="false" />
            </td>
        </tr>
        <tr>
            <td class="bold coy_color">
                Passcode:
            </td>
            <td>
                <input type="password" name="passcode"  id="passcode" maxlength="32" class="txtbox" autocomplete="false" />
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
            <td>
                <button name="login_btn" id="login_btn" type="button" onclick="javascript:$user_auth(document.forms.frm_login);">Login</button>
            </td>
        </tr>
        <tr>
            <td class="l_align" colspan="2">
                <div class="font11 dark_gray">Need a Login? <a href="#get_access" onclick="javascript:get_access_blocker();" class="orange bold">Click here</a> to get one</div>
            </td>
        </tr>
    </table>
</form>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
        // Delay target
        setTimeout(function()
        {
            $('#login_id').focus();
        }, 500);
    });
</script>