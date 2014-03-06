<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<script src="<?=SITE_URL?>js/editor/ueditor.config.js" type="text/javascript"></script> 
<script src="<?=SITE_URL?>js/editor/ueditor.all.js" type="text/javascript"></script> 
<div class="nav-line">
    <a class="first" href="<?=SITE_URL?>?c-all.html">全部分类</a>
    
<? if(is_array($navlist)) { foreach($navlist as $nav) { ?>
    &gt; <a href="<?=SITE_URL?>?c-<?=$nav['id']?>.html"><?=$nav['name']?></a> 
    
<? } } ?>
</div>
<div class="wrapper clearfix">
    <div class="content-left">
        <div class="questionbox">
            <div class="title pd40">
                <span class="ico ico-closed"></span>
                <h1><?=$question['title']?> </h1>
                <i class="q-ico"></i>
                <div class="same-q-mod">
                    <input type="button" class="button_attention" value="关注" />
                </div>
            </div>
            <div class="tags">
                
<? if(is_array($taglist)) { foreach($taglist as $tag) { ?>
                <a target="_blank" title="<?=$tag?>" href="<?=SITE_URL?>?question/search/tag:<?=$tag?>/1.html"><?=$tag?></a>
                
<? } } ?>
            </div>
            <div class="user-label">
                <div class="user-label-info">
                    <? if($question['price']) { ?>                    <span class="gold"><img src="<?=SITE_URL?>css/default/gold.gif"><?=$question['price']?></span>
                    <span class="span-line">|</span>                    
                    <? } ?>                    <span><a  href="<?=SITE_URL?>?u-<?=$question['authorid']?>.html" target="_blank" onmouseover="pop_user_on(this, '<?=$question['authorid']?>', 'text');"  onmouseout="pop_user_out();"><?=$question['author']?></a></span><span class="span-line">|</span>
                    <span>浏览<?=$question['views']?>次</span>
                </div>
                <div class="timeright"><span><a href="#">检举</a></span><span class="span-line">|</span><span><a href="<?=SITE_URL?>?favorite/add/<?=$question['id']?>.html">收藏</a></span><span class="span-line">|</span><?=$question['format_time']?></div>                    
            </div>
            <div class="description"><?=$question['description']?></div> 
            <div class="mainbox mt10">
                <ul>
                    
<? if(is_array($supplylist)) { foreach($supplylist as $supply) { ?>
                    <li><span class="time">问题补充 : <?=$supply['format_time']?></span><?=$supply['content']?></li>
                    
<? } } ?>
                </ul>
            </div>
            <? if(0!=$question['authorid'] && ($question['authorid']==$user['uid'])) { ?>            <div class="managebox mt10">
                <h3>处理问题：</h3>
                <p> 如果已获得满意的回答，请及时采纳，感谢回答者。若还没有满意的回答，可以尝试以下操作：</p>
                <span><input type="button" title="补充提问细节，以得到更准确的答案" class="button_4" name="supply_question" value="问题补充" onclick="javascript:document.location = '<?=SITE_URL?>?question/supply/<?=$question['id']?>.html'"/></span>
                <span><input type="button" title="提高悬赏，以提高问题的关注度" class="button_4" name="append_score" onclick="append_score();" value="提高悬赏" /></span>
                <span><input type="button" class="button_4" value="添加标签" title="修改问题标签" onclick="edittag();" /></span>
                <span><input type="button" title="无满意答案的回答，可以直接结束提问，关闭问题" class="button_4" name="close_question" value="关闭问题"  onclick="close_question();"/></span>
            </div>
            <? } ?>        </div>
        <div class="share-content"><?=$setting['question_share']?></div>
        <? if(!$already && $user['uid']!= $question['authorid']) { ?>        <div id="replyArea" class="your-answer-mod clearfix">
            <div class="title">我来回答</div>
            <form name="answerForm" action="<?=SITE_URL?>?question/answer.html" method="post">
                <input type="hidden" value="<?=$question['id']?>" name="qid">
                <input type="hidden" value="<?=$question['title']?>" name="title">
                <div  class="your-answer">
                    <script type="text/plain" id="anscontent" name="content" style="height: 122px;"></script>
                    <script type="text/javascript">UE.getEditor('anscontent');</script>
                </div>
                <div class="input-bar">
                    <? if($setting['code_ask']) { ?>                    <h2>验证码</h2>
                    <input type="text" onblur="check_code()" name="code" id="code" class="code-input">&nbsp;<span class="verifycode"><img id="verifycode" onclick="javascript:updatecode();" src="<?=SITE_URL?>?user/code.html"></span><a class="changecode" href="javascript:updatecode();">&nbsp;换一个</a>
                    <span id="codetip"></span>
                    <? } ?>                    <input type="submit" name="submit" class="normal-button flright" class='float:right' value="提&nbsp;交">
                </div>
            </form>
        </div>
        <? } ?>        
        <div id="customerList" class="net-answer mt10">
            <div class="title">全部回答(<?=$question['answers']?>)</div>
            <ul class="net-answer-list">
                
<? if(is_array($answerlist)) { foreach($answerlist as $index => $answer) { ?>
                <li id="comment_<?=$index?>">
                    <div class="mainBox">
                        <div class="avatar">
                            <div  class="avarta-img">
                                <div class="avarta-name"><a target="_blank" href="<?=SITE_URL?>?u-<?=$answer['authorid']?>.html"><img width="50" height="50" alt="<?=$answer['author']?>" src="<?=$answer['author_avartar']?>" onmouseover="pop_user_on(this, '<?=$answer['authorid']?>', 'img');"  onmouseout="pop_user_out();"></a></div>
                            </div>
                            <div class="avarta-name"><a target="_blank" title="<?=$answer['author']?>" href="<?=SITE_URL?>?u-<?=$answer['authorid']?>.html" onmouseover="pop_user_on(this, '<?=$answer['authorid']?>', 'text');"  onmouseout="pop_user_out();"><? echo cutstr($answer['author'],7,''); ?></a></div>                           
                        </div>
                        <div class="anscontent"><?=$answer['content']?></div>
                        <? if(0!=$question['authorid'] && ($question['authorid']==$user['uid']) ) { ?>                        <div class="anscontent mt15">
                            <input type="button" class="button_7" value="采纳为满意回答" onclick="adoptanswer(<?=$answer['id']?>);" />
                            <? if(!$answer['tags']) { ?>                            <input type="button" class="button_4" value="继续追问" onclick="javascript:document.location = '<?=SITE_URL?>?question/appendanswer/<?=$question['id']?>/<?=$answer['id']?>.html'" />
                            <? } ?>                        </div>
                        <? } ?>                        <? if($answer['status'] && ($answer['authorid']==$user['uid']) ) { ?>                        <div class="anscontent mt15">
                            <input type="button" class="button_4" value="修改答案"  onclick="javascript:document.location = '<?=SITE_URL?>?question/editanswer/<?=$answer['id']?>.html'" />
                            <? if(!$answer['tags']) { ?>                            <input type="button" class="button_4" value="继续追问" />
                            <? } ?>                        </div>
                        <? } ?>                    </div>
                    <div class="clr"></div>
                    <div class="comment-box mt10">
                        <div class="comments-hd">
                            <div class="function">
                                <span class="number"><a onclick="show_comment('<?=$answer['id']?>');" href="javascript:;">评论(<?=$answer['comments']?>)</a></span>
                                <input type="button" class="button_agree" value="<?=$answer['supports']?>" />                                
                            </div>
                            <span class="time">回答于 <?=$answer['time']?></span>
                            <? if($user['grouptype']==1) { ?>                            <span class="admin"><a href="javascript:void(0);" onclick="adoptanswer(<?=$answer['id']?>);">采纳为最佳答案</a><span class="span-line">|</span><a href="<?=SITE_URL?>?question/editanswer/<?=$answer['id']?>.html">编辑内容</a><span class="span-line">|</span><a href="javascript:void(0);" onclick="delete_answer('<?=$answer['id']?>', '<?=$question['id']?>')">删除</a></span>
                            <? } ?>                        </div>

                        <div class="comments-mod" style="display: none;" id="comment_<?=$answer['id']?>">
                            <div class="areabox clearfix">
                                <input type="text"  class="comment-input" name="content" />
                                <input type="button" value="评论"  class="normal-button" name="submit" onclick="addcomment(<?=$answer['id']?>);"/>
                            </div>
                            <ul class="comments-list">
                                <li class="loading"><img src='<?=SITE_URL?>css/default/loading.gif' align='absmiddle' />&nbsp;加载中...</li>
                            </ul>
                        </div>
                    </div>
                </li>
                
<? } } ?>
            </ul>

        </div>
        <div class="pages"><?=$departstr?></div>
        <? if($solvelist) { ?>        <div class="module mt10">
            <div class="title">相关已解决</div>
            <ul class="list">
                
<? if(is_array($solvelist)) { foreach($solvelist as $solve) { ?>
                <li><span class="answer-number"><?=$solve['answers']?>个回答</span><a title="<?=$solve['title']?>" href="<?=SITE_URL?>?q-<?=$solve['id']?>.html"><?=$solve['title']?></a></li>
                
<? } } ?>
            </ul>
        </div>
        <? } ?>    </div>

    <div class="aside-right">
        <? if(1==$user['grouptype']) { ?>        <div class="modbox mb10">
            <div class="userinfo-box">
                <div class="title">问题管理</div>
                <div class="userinfo clearfix">
                    <p class="control">
                        <span><input type="button" class="button_4" value="编辑内容" onclick="javascript:document.location = '<?=SITE_URL?>?question/edit/<?=$question['id']?>.html'"/></span>
                        <span><input type="button" class="button_4" value="修改标签" onclick="edittag();" /></span>
                        <span><input type="button" class="button_4" value="移动分类" id="changecategory" /></span>
                        <span><input type="button" class="button_4" value="关闭问题" id="close_question"/></span>
                        <span><input type="button" class="button_4" value="删除问题" id="delete_question"/></span>
                    </p>

                </div>
            </div>
        </div>
        <? } ?>        <? if($expertlist) { ?>        <div class="modbox mt10">

            <div class="title">可能帮助到你的专家</div>
            <ul class="left-expert-list">
                
<? if(is_array($expertlist)) { foreach($expertlist as $expert) { ?>
                <li>
                    <div class="pic"><a title="<?=$expert['name']?>" target="_blank" href="<?=SITE_URL?>?u-<?=$expert['uid']?>.html"><img width="50" height="50" alt="<?=$expert['username']?>" src="<?=$expert['avatar']?>"  onmouseover="pop_user_on(this, '<?=$expert['uid']?>', '');"  onmouseout="pop_user_out();"/></a></div>
                    <h3><a title="<?=$expert['name']?>" target="_blank" href="<?=SITE_URL?>?u-<?=$expert['uid']?>.html" onmouseover="pop_user_on(this, '<?=$expert['uid']?>', 'text');"  onmouseout="pop_user_out();"><?=$expert['username']?></a></h3>
                    <span><?=$expert['answers']?>回答</span>
                    <span>300赞同</span>
                    <p><a href="#" class="invite">邀请TA回答</a></p>
                </li>
                
<? } } ?>
            </ul>
        </div>
        <? } ?>    </div>
</div>
<div id="catedialog" title="修改分类" style="display: none">
    <div id="dialogcate">
        <form name="editcategoryForm" action="<?=SITE_URL?>?question/movecategory.html" method="post">
            <input type="hidden" name="qid" value="<?=$question['id']?>" />
            <input type="hidden" name="category" id="categoryid" />
            <input type="hidden" name="selectcid1" id="selectcid1" value="<?=$question['cid1']?>" />
            <input type="hidden" name="selectcid2" id="selectcid2" value="<?=$question['cid2']?>" />
            <input type="hidden" name="selectcid3" id="selectcid3" value="<?=$question['cid3']?>" />
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
                    <td colspan="5"><span><input  type="button" class="normal-button" value="确&nbsp;认" onclick="change_category();"/></span></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div id="dialogadopt" title="采纳回答" style="display: none">
    <form name="editanswerForm"  action="<?=SITE_URL?>?question/adopt.html" method="post" >
        <input type="hidden"  value="<?=$question['id']?>" name="qid"/>
        <input type="hidden" id="adopt_answer" value="0" name="aid"/>
        <table border="0" cellpadding="0" cellspacing="0" width="450px">
            <tr valign="top">
                <td>向帮助了您的知道网友说句感谢的话吧!</td>
            </tr>
            <tr>            
                <td>
                    <div class="inputbox mt15">
                        <textarea class="adopt_text" name="content">非常感谢!</textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <td><input type="submit" class="normal-button flright mt15" value="确&nbsp;认" /></td>
            </tr>
        </table>
    </form>
</div>
<div id="dialog_tag" title="编辑标签" style="display: none">
    <form name="edittagForm"  action="<?=SITE_URL?>?question/edittag.html" method="post" >
        <input type="hidden"  value="<?=$question['id']?>" name="qid"/>
        <input type="hidden" id="adopt_answer" value="0" name="aid"/>
        <table border="0" cellpadding="0" cellspacing="0" width="470px">
            <tr>            
                <td>
                    <div class="inputbox mt15">
                        <input type="text" class="tag-input" name="qtags" value="<? echo implode(' ',$taglist) ?>"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td><input type="submit" class="normal-button flright mt15" value="确&nbsp;认" /></td>
            </tr>
        </table>
    </form>
</div>
<div id="append_score" title="提高悬赏" style="display: none">
    <form name="addscoreForm"  action="<?=SITE_URL?>?question/addscore.html" method="post" >
        <input type="hidden" value="<?=$question['id']?>" name="qid">
        <table border="0" cellpadding="0" cellspacing="0" width="450px">
            <tr valign="top">
                <td>提问期内，追加悬赏一次，可延长问题的有效期3天。悬赏越高，会吸引到越多的关注。</td>
            </tr>
            <tr>            
                <td>
                    <div class="inputbox mt15">
                        追加悬赏:&nbsp;<select name="score" id="addscore" class="normal_select">
                            <option value="5" selected="selected">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                            <option value="50">50</option>
                        </select>&nbsp;分
                    </div>
                </td>
            </tr>
            <tr>
                <td><input type="submit" class="normal-button flright mt15" value="确&nbsp;认" /></td>
            </tr>
        </table>
    </form>
</div>
<div id="dialog_inform" title="我来检举" style="display: none">
    <form name="edittagForm"  action="<?=SITE_URL?>?question/edittag.html" method="post" >
        <input type="hidden"  value="<?=$question['id']?>" name="qid"/>
        <input type="hidden" id="adopt_answer" value="0" name="aid"/>
        <table border="0" cellpadding="0" cellspacing="0" width="470px">
            <tr>            
                <td>
                    <div class="inputbox mt15">
                        <input type="text" class="tag-input" name="qtags" value="<? echo implode(' ',$taglist) ?>"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td><input type="submit" class="normal-button flright mt15" value="确&nbsp;认" /></td>
            </tr>
        </table>
    </form>
</div>
<link rel="stylesheet" href="<?=SITE_URL?>js/lightbox/lightbox.css"/>
<script src="<?=SITE_URL?>js/lightbox/lightbox.js" type="text/javascript"></script>
<script type="text/javascript">
                        var category1 = <?=$categoryjs['category1']?>;
                        var category2 = <?=$categoryjs['category2']?>;
                        var category3 = <?=$categoryjs['category3']?>;
                        var selectedcid = "<?=$question['cid1']?>,<?=$question['cid2']?>,<?=$question['cid2']?>";
                        $(document).ready(function() {
                            initcategory(category1);
                            fillcategory(category2, $("#category1 option:selected").val(), "category2");
                            fillcategory(category3, $("#category2 option:selected").val(), "category3");
                            //关闭问题
                            $("#close_question").click(function() {
                                if (confirm('确定关闭该问题?') === true) {
                                    document.location.href = "<?=SITE_URL?>?question/close/<?=$question['id']?>.html";
                                }
                            });
                            //删除问题
                            $("#delete_question").click(function() {
                                if (confirm('确定删除问题？该操作不可返回！') === true) {
                                    document.location.href = "<?=SITE_URL?>?question/delete/<?=$question['id']?>.html";
                                }
                            });
                            $(".anscontent img,.description img").each(function(i) {
                                var img = $(this);
                                $.ajax({
                                    type: "POST",
                                    url: "<?=SITE_URL?>?index/ajaxchkimg.html",
                                    async: true,
                                    data: "imgsrc=" + img.attr("src"),
                                    success: function(status) {
                                        if ('1' == status) {
                                            img.wrap("<a href='" + img.attr("src") + "' title='" + img.attr("title") + "' data-lightbox='comment'></a>");
                                        }
                                    }
                                });
                            });
                        });
                        function show_comment(answerid) {
                            if ($("#comment_" + answerid).css("display") === "none") {
                                $("#comment_" + answerid + " .comments-list").load("<?=SITE_URL?>" + query + "answer/viewcomment/" + answerid);
                                $("#comment_" + answerid).slideDown();
                            } else {
                                $("#comment_" + answerid).slideUp();
                            }
                        }

                        function change_category() {
                            var category1 = $("#category1 option:selected").val();
                            var category2 = $("#category2 option:selected").val();
                            var category3 = $("#category3 option:selected").val();
                            if (category1 > 0) {
                                $("#categoryid").val(category1);
                            }
                            if (category2 > 0) {
                                $("#categoryid").val(category2);
                            }
                            if (category3 > 0) {
                                $("#categoryid").val(category3);
                            }
                            $("#catedialog").dialog("close");
                            $("form[name='editcategoryForm']").submit();
                        }

                        function adoptanswer(aid) {
                            $("#dialogadopt").dialog({
                                autoOpen: false,
                                width: 480,
                                modal: true,
                                resizable: false
                            });
                            $("#adopt_answer").val(aid);
                            $("#dialogadopt").dialog("open");
                        }
                        function edittag() {
                            $("#dialog_tag").dialog({
                                autoOpen: false,
                                width: 500,
                                modal: true,
                                resizable: false
                            });
                            $("#dialog_tag").dialog("open");
                        }

                        //提高悬赏
                        function append_score() {
                            $("#append_score").dialog({
                                autoOpen: false,
                                width: 480,
                                modal: true,
                                resizable: false
                            });
                            $("#append_score").dialog("open");
                        }
                        function close_question() {
                            if (confirm('确定关闭该问题?') === true) {
                                document.location.href = "<?=SITE_URL?>?question/close/<?=$question['id']?>.html";
                            }
                        }

                        //添加评论
                        function addcomment(answerid) {
                            var content = $("#comment_" + answerid + " input[name='content']").val();
                            $.ajax({
                                type: "POST",
                                url: "<?=SITE_URL?>?answer/addcomment.html",
                                data: "content=" + content + "&answerid=" + answerid,
                                success: function(status) {
                                    if (status == '1') {
                                        $("#comment_" + answerid + " input[name='content']").val("");
                                        $("#comment_" + answerid + " .comments-list").load("<?=SITE_URL?>" + query + "answer/viewcomment/" + answerid);
                                    }
                                }
                            });
                        }

                        //删除评论
                        function deletecomment(commentid, answerid) {
                            if (!confirm("确认删除该评论?")) {
                                return false;
                            }
                            $.ajax({
                                type: "POST",
                                url: "<?=SITE_URL?>?answer/deletecomment.html",
                                data: "commentid=" + commentid + "&answerid=" + answerid,
                                success: function(status) {
                                    if (status == '1') {
                                        $("#comment_" + answerid + " .comments-list").load("<?=SITE_URL?>" + query + "answer/viewcomment/" + answerid);
                                    }
                                }
                            });
                        }
                        //检举
                        function inform(name, type) {
                            var content = name + '的回答';
                            if (type == 1) {
                                content = name + '的提问';
                            }

                            $("#append_score").dialog({
                                autoOpen: false,
                                width: 480,
                                modal: true,
                                resizable: false
                            });
                            $("#append_score").dialog("open");
                        }

</script>
<? include template('footer'); ?>
