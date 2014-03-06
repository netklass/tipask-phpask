<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<div class="nav-line"><a class="first" href="<?=SITE_URL?>"><?=$setting['site_name']?></a> &gt; <span>财富商城</span></div>
<div class="wrapper clearfix">
    <div class="content-left">
        <div class="modbox">
            <ul class="gift-list clearfix">
                
<? if(is_array($giftlist)) { foreach($giftlist as $gift) { ?>
                <li>
                    <img width="138" height="138" src="<?=SITE_URL?><?=$gift['image']?>" alt="<?=$gift['title']?>" />
                    <a class="name" title="<?=$gift['title']?>"  href="javascript:void(0);" onclick="show_desc('<?=$gift['title']?>', '<?=$gift['description']?>');"><?=$gift['title']?></a>
                    <span>(售价：<?=$gift['credit']?>财富）</span>
                    <span><input type="button" class="button_4_red" value="立即兑换" onclick="exchange();"/></span>
                </li>                
                
<? } } ?>
            </ul>
        </div>
        <div class="pages"><?=$departstr?></div>
        <div class="tipmod mt10">
            <h3>温馨提示：</h3>
            <div class="credit_note">
                <p>为了保证您所兑换的礼品能够及时送到，请您仔细阅读下列内容：</p>
                <p>1.请您填写详细的联系地址：省、市、区、县、村、路（街道号）、单位，注明您的邮编，真实姓名还有联系方式。</p>
                <div class="credit_note">
                    <p>详细地址示例： </p>
                    <p>a.单位地址</p>
                    <p>XX省XX市XX区XX路XX号 XX办公楼XX写字楼XX房间号XX公司<br>
                    </p>
                    <p>b.学校地址(请您一定要注明所在年级和班级)</p>
                    <p>XX省XX市XX区XX路XX号XX学校 XX年级XX班级<br>
                    </p>
                    <p>c.家庭地址(请您注明所在小区的楼号及门牌号)</p>
                    <p>XX省XX市XX区XX路XX号XX小区XX楼XX单元XX门牌号</p>
                </div>
                <p>2.由于快递公司所到地区有限，如果您的所在地快递不能到达，请在备注中注明，我们会为您转发EMS。</p> 
                <p>3.如有任何问题，请及时<a href="mailto:<?=$setting['admin_email']?>" target="_blank">联系我们</a>.</p> 
            </div>
        </div>        
    </div>
    <div class="aside-right">
        <div class="modbox">
            <div class="title">礼品公告</div>
            <div class="rcontent clearfix"><?=$setting['gift_note']?></div>
        </div>
        <div class="modbox mt15">
            <div class="title">兑换动态</div>
        </div>
        <div class="modbox mt10">
            <h3 class="title">财富榜</h3>
            <ul class="right-list" id="alltop">
                <? $weekuserlist=$this->fromcache('alluserlist'); ?>                
<? if(is_array($weekuserlist)) { foreach($weekuserlist as $index => $alluser) { ?>
                <? $index++; ?>                <li>
                    <? if($index<4) { ?>                    <em class="n1"><?=$index?></em>
                    <? } else { ?>                    <em class="n2"><?=$index?></em>
                    <? } ?>                    <a href="<?=SITE_URL?>?u-<?=$alluser['uid']?>.html" target="_blank" onmouseover="pop_user_on(this, '<?=$alluser['uid']?>', 'text');"  onmouseout="pop_user_out();"><?=$alluser['username']?></a>
                    <span class="credit"><?=$alluser['credit2']?></span>
                </li>
                
<? } } ?>
            </ul>
        </div>
    </div>
</div>
<div id="gift_desc" title="礼品详情" style="display: none"></div>
<div id="exchangeform" title="兑换礼品" style="display: none">
    <form name="loginform"  action="<?=SITE_URL?>?user/register.html" method="post">
        <div class="input-bar">
            <h2>真实姓名</h2>
            <input type="text" class="normal-input" id="username" name="username" onblur="check_username();"/>
            <span class="input_warming">请务必填入真实姓名</span>
        </div>
        <div class="clr"></div>
        <div class="input-bar">
            <h2>电子邮箱</h2>
            <input type="text" class="normal-input" id="password" name="password" onblur="check_passwd();" />
            <span class="input_warming">常用邮箱地址</span>
        </div>
        <div class="clr"></div>
        <div class="input-bar">
            <h2>联系电话</h2>
            <input type="password" class="normal-input" id="repassword" name="repassword"  onblur="check_repasswd();"/>
            <span id="repasswordtip" class="input_warming">您的联系电话</span>
        </div>
        <div class="clr"></div>
        <div class="input-bar">
            <h2>邮寄地址</h2>
            <input type="text" class="normal-input" id="email" name="email"  onblur="check_email();"/>
            <span id="emailtip" class="input_warming">您的联系地址</span>
        </div>
        <div class="clr"></div>
        <div class="input-bar">
            <h2>邮政编码</h2>
            <input type="text" class="normal-input" id="email" name="email"  onblur="check_email();"/>
        </div>
        <div class="clr"></div>
        <div class="input-bar">
            <h2>QQ</h2>
            <input type="text" class="normal-input" id="email" name="email"  onblur="check_email();"/>
        </div>
        <div class="clr"></div>
        <div class="auto-login">
            <input type="submit" value="提&nbsp;交" class="normal-button" name="submit" />
        </div>
    </form>
    <div class="clr mt15"></div>
</div>
<script type="text/javascript">
                        function show_desc(title, desc) {
                            $("#gift_desc").html(desc);
                            $("#gift_desc").attr("title", title + "详情");
                            $("#gift_desc").dialog({
                                autoOpen: false,
                                width: 500,
                                modal: false,
                                resizable: false
                            });
                            $("#gift_desc").dialog("open");
                        }
                        function exchange(id,credit) {
                            var uid = "<?=$user['uid']?>";
                            var usercredit = "<?=$user['credit2']?>";
                            if (uid == 0) {
                                alert("登陆之后才可以进行礼品兑换!");
                                return false;
                            }
                            $("#exchangeform").dialog({
                                autoOpen: false,
                                width: 560,
                                modal: false,
                                resizable: false
                            });
                            $("#exchangeform").dialog("open");

                        }
</script>
<? include template('footer'); ?>
