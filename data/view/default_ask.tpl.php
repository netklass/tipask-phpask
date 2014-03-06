<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<script src="<?=SITE_URL?>js/editor/ueditor.config.js" type="text/javascript"></script> 
<script src="<?=SITE_URL?>js/editor/ueditor.all.js" type="text/javascript"></script> 
<div class="nav-line"><a class="first" href="<?=SITE_URL?>"><?=$setting['site_name']?></a> &gt; <span>提问</span></div>
<div class="wrapper clearfix">
    <div class="content-left">
        <form enctype="multipart/form-data" method="POST" action="<?=SITE_URL?>?question/add.html" name="askform" id="askform" onsubmit="return check_form();" >
            <div class="askbox">
                <div class="title"><div id="limitNum" class="tips">还可输入 <span>50</span> 字</div><? if(isset($touser)) { ?>您正在向<a href="<?=SITE_URL?>?u-<?=$touser['uid']?>.html"><?=$touser['username']?></a>提问<? } else { ?>请将您的问题告诉我们<? } ?>：</div>
                <div class="inputbox">
                    <textarea class="qtitle" name="title" id="qtitle" value="<?=$word?>"></textarea>
                    <div class='clearfix'></div>
                    <h3>问题补充(选填)</h3>
                    <div id="introContent">
                        <script type="text/plain" id="editor" name="description" style="height: 122px;"></script>
                        <script type="text/javascript">UE.getEditor('editor');</script>
                    </div>
                </div>
                <div class="ask-input-bar clearfix">
                    <div class="bar_l">
                        <span id="selectedcate" class="selectedcate"></span>
                        <span><a id="changecategory" href="javascript:void(0)">选择分类</a>
                    </div>
                    <div class="bar_r">
                        <span>悬赏&nbsp;<select name="givescore" id="scorelist"><option selected="selected" value="0">0</option><option value="3">3</option><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="30">30</option><option value="50">50</option><option value="80">80</option><option value="100">100</option></select></span>
                        <? if($user['uid']) { ?>                        <span><input type="checkbox" name="hidanswer" id="hidanswer" value="1" />&nbsp;匿名</span>
                        <? } ?>                    </div>
                </div>
                <div class="ask-input-bar clearfix">
                    <? if($setting['code_ask']) { ?>                    <h2>验证码</h2>
                    <input type="text" class="code-input" id="code" name="code" onblur="check_code()">&nbsp;<span class="verifycode"><img src="http://localhost/tipask-phpask/tipask2.5/?user/code.html" onclick="javascript:updatecode();" id="verifycode"></span><a href="javascript:updatecode();" class="changecode">&nbsp;换一个</a>
                    <span id="codetip"></span>
                    <? } ?>                    <input type="hidden" name="cid" id="cid"/>
                    <input type="hidden" value="<?=$askfromuid?>" name="askfromuid" />  
                    <input type="submit" value="提交问题" class="normal-button flright"  name="submit" />
                    <div class="toweibo"><label style="padding:0;"><input type="checkbox" value="1" name="tobbs" />同步到微博</label></div>
                </div>
            </div>	
        </form>
    </div>
    <div class="aside-right">
        <? if($touser) { ?>        <div class="modbox">
            <div class="userinfo-box">
                <div class="userinfo clearfix">
                    <a class="pic" href="<?=SITE_URL?>?u-<?=$touser['uid']?>.html" target="_blank"><img width="50" height="50" src="<?=$touser['avatar']?>"></a>
                    <h3><a href="<?=SITE_URL?>?u-<?=$touser['uid']?>.html" target="_blank"><?=$touser['username']?></a></h3>
                    <p><?=$touser['grouptitle']?></p>
                    <p><?=$touser['answers']?>回答<span>33赞同</span></p>
                </div>
            </div>
        </div>
        <? } ?>    </div>
</div>
<div id="catedialog" title="选择分类" style="display: none">
    <div id="dialogcate">
        <table border="0" cellpadding="0" cellspacing="0" width="460px">
            <tr valign="top">
                <td width="125px">
                    <select  id="category1" class="catselect" size="8" name="category1" ></select>
                </td>
                <td align="center" valign="middle" width="25px"><div style="display: none;" id="jiantou1">>></div></td>
                <td width="125px">                                        
                    <select  id="category2"  class="catselect" size="8" name="category2" style="display:none"></select>                                        
                </td>
                <td align="center" valign="middle" width="25px"><div style="display: none;" id="jiantou2">>>&nbsp;</div></td>
                <td width="125px">
                    <select id="category3"  class="catselect" size="8"  name="category3" style="display:none"></select>
                </td>
            </tr>
            <tr>
                <td colspan="5"><span><input type="button" class="normal-button" value="确&nbsp;认" onclick="selectcate();"/></span></td>
            </tr>
        </table>
    </div>
</div>
<script type="text/javascript">
            var category1 = <?=$categoryjs['category1']?>;
            var category2 = <?=$categoryjs['category2']?>;
            var category3 = <?=$categoryjs['category3']?>;
            $(document).ready(function() {
                initcategory(category1);
                $("#qtitle").keyup(function() {
                    var qbyte = bytes($.trim($(this).val()));
                    var limit = 100 - qbyte;
                    if (limit % 2 == 0) {
                        $("#limitNum span").html((limit / 2));
                    } else {
                        $("#limitNum span").html(((limit + 1) / 2));
                    }

                });
            });

            function selectcate() {
                var selectedcatestr = '';
                var category1 = $("#category1 option:selected").val();
                var category2 = $("#category2 option:selected").val();
                var category3 = $("#category3 option:selected").val();
                if (category1 > 0) {
                    selectedcatestr = $("#category1 option:selected").html();
                    $("#cid").val(category1);
                }
                if (category2 > 0) {
                    selectedcatestr += " > " + $("#category2 option:selected").html();
                    $("#cid").val(category2);
                }
                if (category3 > 0) {
                    selectedcatestr += " > " + $("#category3 option:selected").html();
                    $("#cid").val(category3);
                }
                $("#selectedcate").html(selectedcatestr);
                $("#changecategory").html("更改");
                $("#catedialog").dialog("close");
            }

            function  check_form() {
                var qtitle = $("#qtitle").val();
                if (bytes($.trim(qtitle)) < 8 || bytes($.trim(qtitle)) > 50) {
                    alert("问题标题长度不得少于4个字，不能超过50字！");
                    $("#qtitle").focus();
                    return false;
                }
                if ($("#selectedcate").html() == '') {
                    initcategory(category1);
                    $("#catedialog").dialog("open");
                    return false;
                }
                <? if($user['uid']) { ?>                //检查财富值是否够用
                var offerscore = 0;
                var selectsocre = $("#givescore").val();
                if ($("#hidanswer:selected").val() == 1) {
                    offerscore += 10;
                }
                offerscore += parseInt(selectsocre);
                if (offerscore > <?=$user['credit2']?>) {
                    alert("你的财富值不够!");
                    return false;
                }
                <? } ?>   
            }

</script>
<? include template('footer'); ?>
