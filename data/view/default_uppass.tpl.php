<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<div class="wrapper mt10 clearfix">
    
<? include template('user_menu'); ?>
    <div class="user-content">
        <div class="my-answerbox">
            <div class="title">个人信息</div>
            <div id="qa-tabcard">
                <ul>
                    <li><a href="<?=SITE_URL?>?user/profile.html">个人资料</a></li>
                    <li  class="on">修改密码</li>
                    <li><a href="<?=SITE_URL?>?user/editimg.html">修改头像</a></li>
                </ul>
            </div>
            <div class="loginform">
                <form  action="<?=SITE_URL?>?user/uppass.html" method="post">
                    <div class="input-bar">
                        <h2>当前密码:</h2>
                        <input type="password" id="oldpwd" name="oldpwd" class="normal-input" value="" />
                    </div>
                    <div class="clr"></div>
                    <div class="input-bar">
                        <h2>新密码:</h2>
                        <input type="password" id="newpwd"  name="newpwd" class="normal-input" value="" />
                    </div>
                    <div class="clr"></div>
                    <div class="input-bar">
                        <h2>确认密码:</h2>
                        <input type="password" id="confirmpwd"  name="confirmpwd" class="normal-input" value="" />
                    </div>
                    <div class="clr"></div>
                    <div class="input-bar">
                        <h2>验证码</h2>
                        <input type="text" class="code-input" id="code" name="code" onblur="check_code();"/><span id="codetip"></span>
                    </div>
                    <div class="clr"></div>
                    <div class="code-bar">
                        <span class="verifycode"><img  src="<?=SITE_URL?>?user/code.html" onclick="javascript:updatecode();" id="verifycode"></span><a class="changecode" href="javascript:updatecode();">&nbsp;看不清?</a>
                    </div>
                    <div class="clr"></div>
                    <div class="auto-login">
                        <input type="submit" name="submit" class="normal-button" value="保&nbsp;存" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<? include template('footer'); ?>
