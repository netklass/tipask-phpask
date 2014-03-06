<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template('header'); ?>
<div class="nav-line">
    <a class="first" href="<?=SITE_URL?>"><?=$setting['site_name']?></a>
    &gt; <span>用户财富排行榜Top 100</span>
</div>
<div class="wrapper clearfix">
    <div class="content-left">
        <div style="width:720px;" id="qa-tabcard">
            <ul>                
                <li <? if($type==1) { ?>class="on"<? } ?>><? if($type==1) { ?>本周排行<? } else { ?><a href="<?=SITE_URL?>?us-1.html">本周排行</a><? } ?></li> 
                <li <? if($type==0) { ?>class="on"<? } ?>><? if($type==0) { ?>总排行<? } else { ?><a href="<?=SITE_URL?>?us-0.html">总排行</a><? } ?></li> 
            </ul>
        </div>
        <div id="mod-answer-list" class="mod-answer-list mt10">
            <div class="bd">
                <div class="cls-qa-table">
                    <table>
                        <tbody>
                            <tr><th class="s1">排名</th><th class="s2">用户</th><th class="s1">财富</th><th class="s1">回答</th><th class="s1">被采纳</th><th class="s2">最后登录</th></tr>
                            
<? if(is_array($userlist)) { foreach($userlist as $index => $user) { ?>
                            <tr>
                                <td><strong><? echo(++$index); ?></strong></td>
                                <td><a href="<?=SITE_URL?>?u-<?=$user['uid']?>.html" target="_blank" onmouseover="pop_user_on(this, '<?=$user['uid']?>', 'text');"  onmouseout="pop_user_out();"><?=$user['username']?></a></td>
                                <td><?=$user['credit2']?></td>
                                <td><?=$user['answers']?></td>
                                <td><?=$user['adopts']?></td>
                                <td><?=$user['lastlogin']?></td>
                            </tr>
                            
<? } } ?>
                        </tbody>
                    </table>
                </div>
                <div class="pages"><?=$departstr?></div>
            </div>
        </div>
    </div>

    <div class="aside-right">
        <!-- 关注问题排行榜 -->
        <div class="modbox mt10">
            <div class="title">关注问题排行榜</div>
            <ul class="right-list">
                <? $attentionlist=$this->fromcache('attentionlist'); ?>                
<? if(is_array($attentionlist)) { foreach($attentionlist as $index => $question) { ?>
                <? $index++; ?>                <li>
                    <? if($index<4) { ?>                    <em class="n1"><?=$index?></em>
                    <? } else { ?>                    <em class="n2"><?=$index?></em>
                    <? } ?>                    <a  title="<?=$question['title']?>" target="_blank" href="<?=SITE_URL?>?q-<?=$question['id']?>.html"><? echo cutstr($question['title'],40,''); ?></a>
                </li>
                
<? } } ?>
            </ul>
        </div>	
    </div>
</div>
<? include template('footer'); ?>
