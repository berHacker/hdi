<div class="outter_pad">
<div class="inner_pad">
<form name="frm_logout" id="frm_logout" method="post">
    <div class="center gray" style="padding-bottom: 10px;">
        <table>
            <tr>
                <td style="vertical-align:middle;">
                    <div class="alert_icon" style="background-position: -280px -39px;margin-right:15px;"></div>
                </td>
                <td class="font15" style="vertical-align:middle;color:#888;">
                    Always backup your database
                </td>
            </tr>
        </table>
    </div>
    <table class="visible_table">
        <tr>
            <td class="bold coy_color percent1">
                Backup&nbsp;Location:
            </td>
            <td>
                <input type="text" name="txt_backup_url" id="loginid" value="C:\backup" class="txtbox" />
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
            <td>
                <button name="backup_btn" id="backup_btn" value="backup" type="button" onclick="javascript:$safe_logout.backup(document.forms.frm_logout);">Backup</button>
                <button name="logout_btn" id="logout_btn" value="logout" type="button" onclick="javascript:$safe_logout.exit(document.forms.frm_logout);">Log Out</button>
            </td>
        </tr>
    </table>
</form>
</div>
</div>