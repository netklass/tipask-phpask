<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<script src="<?=SITE_URL?>js/editor/ueditor.config.js" type="text/javascript"></script> 
<script src="<?=SITE_URL?>js/editor/ueditor.all.js" type="text/javascript"></script> 
<div class="nav-line"><a class="first" href="<?=SITE_URL?>"><?=$setting['site_name']?></a> &gt; <a href="<?=SITE_URL?>?q-<?=$question['id']?>.html"><?=$question['title']?></a> &gt; <span>问题补充</span></div>
<div class="wrapper clearfix">
    <div class="content-left">
        <form name="askform" onsubmit="return check_form();" action="<?=SITE_URL?>?question/supply.html" method="post">
            <input type="hidden" value="<?=$qid?>" name="qid" />
            <div class="askbox">
                <div class="inputbox pdt15">
                    <div id="introContent">
                        <script type="text/plain" id="editor" name="content" style="height: 122px;"><?=$answer['content']?></script>
                        <script type="text/javascript">UE.getEditor('editor');</script>
                    </div>
                </div>
                <div class="ask-input-bar clearfix">
                    <? if($user['grouptype']!=1) { ?>                    <h2>验证码</h2>
                    <input type="text" class="code-input" id="code" name="code" onblur="check_code()">&nbsp;<span class="verifycode"><img src="http://localhost/tipask-phpask/tipask2.5/?user/code.html" onclick="javascript:updatecode();" id="verifycode"></span><a href="javascript:updatecode();" class="changecode">&nbsp;换一个</a>
                    <span id="codetip"></span>
                    <? } ?>                    <input type="submit" value="保存修改" class="normal-button flright"  name="submit" />
                </div>
            </div>	
        </form>
    </div>
    <div class="aside-right">法师打发似的</div>
</div>
<? include template('footer'); ?>
