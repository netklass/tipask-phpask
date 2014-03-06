<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<script src="<?=SITE_URL?>js/editor/ueditor.config.js" type="text/javascript"></script> 
<script src="<?=SITE_URL?>js/editor/ueditor.all.js" type="text/javascript"></script> 
<div class="nav-line">
    <a class="first" href="<?=SITE_URL?>"><?=$setting['site_name']?></a>
    &gt; <a href="<?=SITE_URL?>?note/list.html">公告列表</a> &gt; <span>查看公告</span>
</div>
<div class="wrapper clearfix">
    <div class="content-left">
        <div class="notebox">
            <div class="title">
                <h1><?=$note['title']?> </h1>
            </div>
            <div class="time">
                <span>作者 : <?=$note['author']?></span>
                <span class="span-line">|</span>
                <span>发布时间 : <?=$note['format_time']?></span>
                <span class="span-line">|</span>
                <span>浏览<?=$note['views']?>次</span>
            </div>
            <div class="description"><?=$note['content']?></div> 
        </div>
        <div class="share-content"><?=$setting['question_share']?></div>
        <div class="your-answer-mod clearfix">
            <div class="title">我要评论</div>
            <form name="commentForm" action="<?=SITE_URL?>?note/addcomment.html" method="post">
                <input type="hidden" value="<?=$note['id']?>" name="noteid">
                <div class="your-answer">
                    <script type="text/plain" id="content" name="content" style="height: 122px;"></script>
                    <script type="text/javascript">UE.getEditor('content');</script>
                </div>
                <div class="input-bar">
                    <h2>验证码</h2>
                    <input type="text" onblur="check_code()" name="code" id="code" class="code-input">&nbsp;<span class="verifycode"><img id="verifycode" onclick="javascript:updatecode();" src="<?=SITE_URL?>?user/code.html"></span><a class="changecode" href="javascript:updatecode();">&nbsp;换一个</a>
                    <span id="codetip"></span>
                    <input type="submit" name="submit" class="normal-button flright" class='float:right' value="提&nbsp;交">
                </div>
            </form>
        </div>
        <div id="customerList" class="net-answer mt10">
            <div class="title">全部评论(<?=$rownum?>)</div>
            <ul class="net-answer-list">
                
<? if(is_array($commentlist)) { foreach($commentlist as $index => $comment) { ?>
                <li>
                    <div class="mainBox">
                        <div class="avatar">
                            <div  class="avarta-img">
                                <div class="avarta-name"><a target="_blank" href="<?=SITE_URL?>?u-<?=$comment['authorid']?>.html"><img width="50" height="50" alt="<?=$comment['author']?>" src="<?=$comment['avatar']?>" onmouseover="pop_user_on(this, '<?=$comment['authorid']?>', 'img');"  onmouseout="pop_user_out();"></a></div>
                            </div>
                            <div class="avarta-name"><a target="_blank" title="<?=$comment['author']?>" href="<?=SITE_URL?>?u-<?=$comment['authorid']?>.html" onmouseover="pop_user_on(this, '<?=$comment['authorid']?>', 'text');"  onmouseout="pop_user_out();"><?=$comment['author']?></a></div>                           
                        </div>
                        <div class="anscontent"><?=$comment['content']?></div>
                    </div>
                    <div class="clr"></div>
                    <div class="comment-box mt10">
                        <div class="comments-hd">
                            <span class="time">评论于 <?=$comment['format_time']?></span>
                            <? if(($comment['authorid']==$user['uid']) || ($user['grouptype']==1)) { ?>                            <span class="admin"><a href="javascript:void(0);" onclick="delete_comment('<?=$note['id']?>', '<?=$comment['id']?>')">删除</a></span>
                            <? } ?>                        </div>
                    </div>
                </li>
                
<? } } ?>
            </ul>

        </div>
        <div class="pages"><?=$departstr?></div>
    </div>

    <div class="aside-right">
        <div class="modbox hot-problem">
            <!-- 热门问题 -->
            <div class="title">最新公告</div>
            <ul class="list">
                <? $notelist=$this->fromcache('notelist'); ?>                
<? if(is_array($notelist)) { foreach($notelist as $note) { ?>
                <li><a target="_blank" title="<?=$note['title']?>" <? if($note['url']) { ?>href="<?=$note['url']?>"<? } else { ?>href="<?=SITE_URL?>?note/view/<?=$note['id']?>.html"<? } ?>><? echo cutstr($note['title'],28); ?></a></li>
                
<? } } ?>
            </ul>
        </div>	
    </div>
</div>
<link rel="stylesheet" href="<?=SITE_URL?>js/lightbox/lightbox.css"/>
<script src="<?=SITE_URL?>js/lightbox/lightbox.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
        $(".anscontent img,.description img").each(function(i){
            var img = $(this);
            $.ajax({
                type: "POST",
                url: "<?=SITE_URL?>?index/ajaxchkimg.html",
                async: true,
                data: "imgsrc="+img.attr("src"),
                success: function(status){
                    if('1' == status){
                        img.wrap("<a href='"+img.attr("src")+"' title='"+img.attr("title")+"' data-lightbox='comment'></a>");
                    }
                }
            });
        });
});
function delete_comment(noteid, commentid) {
    if (confirm('确定删除改评论？') === true) {
        document.location.href = g_site_url + '' + query + 'note/deletecomment/' + noteid + '/' + commentid + g_suffix;
    }
}
</script>
<? include template('footer'); ?>
