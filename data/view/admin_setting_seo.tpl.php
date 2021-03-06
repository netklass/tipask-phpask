<? if(!defined('IN_TIPASK')) exit('Access Denied'); include template(header,admin); ?>
<div style="width:100%; height:15px;color:#000;margin:0px 0px 10px;">
    <div style="float:left;"><a href="index.php?admin_main/stat<?=$setting['seo_suffix']?>" target="main"><b>控制面板首页</b></a>&nbsp;&raquo;&nbsp;SEO设置</div>
</div><? if(isset($message)) { $type=isset($type)?$type:'correctmsg';  ?><table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder">
    <tr>
        <td class="<?=$type?>"><?=$message?></td>
    </tr>
</table><? } ?><form action="index.php?admin_setting/seo<?=$setting['seo_suffix']?>" method="post">
    <a name="基本设置"></a>
    <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder">
        <tr class="header">
            <td colspan="2">全局设置</td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>开启URL静态化:</b><br><span class="smalltxt">对于Rewrite的设置站长需要先了解自己的服务器/虚拟主机环境是否有Rewrite支持</span></td>
            <td class="altbg2">
                <input class="radio"  type="radio"  <? if(1==$setting['seo_on'] ) { ?>checked<? } ?>  value="1" name="seo_on"><label for="yes">是</label>&nbsp;&nbsp;&nbsp;
                <input class="radio"  type="radio"  <? if(0==$setting['seo_on'] ) { ?>checked<? } ?> value="0" name="seo_on"><label for="no">否</label>
            </td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>页面地址后缀:</b><br><span class="smalltxt">不建议修改本参数，此参数目的是为了防止服务器全局rewrite开启，影响tipask的访问</span></td>
            <td class="altbg2"><input type="text" value="<?=$setting['seo_suffix']?>" name="seo_suffix" /></td>
        </tr>
        <tr>
            <td class="altbg1" width="45%"><b>其它头部信息:</b><br><span class="smalltxt">可以加入默认加载的js、样式或者其他任何的信息,如google分析</span></td>
            <td class="altbg2"><textarea class="area" name="seo_headers"  style="height:100px;width:300px;"><?=$setting['seo_headers']?></textarea></td>
        </tr>
    </table>
    <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder">
        <tr class="header">
            <td colspan="2">SEO优化设置</td>
        </tr>
        <tr>
            <td colspan="2">
                网页SEO优化设置规则：<br />
                1、网站名称:<?=wzmc?>（应用范围：所有位置）<br />
                2、分类名称:<?=flmc?>（应用范围：分类查看页和问题查看页）<br />
                3、问题标题:<?=wtbt?>（应用范围：问题查看页）<br />
                4、问题状态:<?=wtzt?>（应用范围：问题查看页）<br />
                5、问题标签:<?=wtbq?>（应用范围：问题查看页）<br />                
                6、最佳答案:<?=zjda?>（应用范围：问题查看页且仅对于已解决问题有效）<br />
                7、以上标签（必须包含大括号"{}"）可以通过添加在下面来优化页面SEO设置，多个标签之间可以用半角连字符"-"、半角","或半角空格隔开。留空为默认SEO设置，如果标签不再应用范围内则不显示此标签
            </td>
        </tr>
        <tr class="header">
            <td colspan="2">首页</td>
        </tr>
        <tr>
            <td width="45%"><b>Title:</b><br><span class="smalltxt">关键字将包含在每一个页面的title里面</span></td>
            <td><input type="text" size="60" value="<?=$setting['seo_index_title']?>" name="seo_index_title" /></td>
        </tr>
        <tr>
            <td width="45%"><b>Meta keywords:</b><br><span class="smalltxt">搜索引擎看的keywords</span></td>
            <td><input type="text" size="60" value="<?=$setting['seo_index_keywords']?>" name="seo_index_keywords"></td>
        </tr>
        <tr>
            <td width="45%"><b>Meta Description:</b><br><span class="smalltxt">给搜索引擎看的Description</span></td>
            <td><input type="text" size="60" value="<?=$setting['seo_index_description']?>" name="seo_index_description"></td>
        </tr>
        <tr class="header">
            <td colspan="2">问题查看页</td>
        </tr>
        <tr>
            <td width="45%"><b>标题关键字:</b><br><span class="smalltxt">关键字将包含在每一个页面的title里面</span></td>
            <td><input type="text" size="60" value="<?=$setting['seo_question_title']?>" name="seo_question_title" /></td>
        </tr>
        <tr>
            <td width="45%"><b>Meta keywords:</b><br><span class="smalltxt">搜索引擎看的keywords</span></td>
            <td><input type="text" size="60" value="<?=$setting['seo_question_keywords']?>" name="seo_question_keywords"></td>
        </tr>
        <tr>
            <td width="45%"><b>Meta Description:</b><br><span class="smalltxt">给搜索引擎看的Description</span></td>
            <td><input type="text" size="60" value="<?=$setting['seo_question_description']?>" name="seo_question_description"></td>
        </tr>
        <tr class="header">
            <td colspan="2">分类查看页</td>
        </tr>
        <tr>
            <td width="45%"><b>标题关键字:</b><br><span class="smalltxt">关键字将包含在每一个页面的title里面</span></td>
            <td><input type="text" size="60" value="<?=$setting['seo_category_title']?>" name="seo_category_title" /></td>
        </tr>
        <tr>
            <td width="45%"><b>Meta keywords:</b><br><span class="smalltxt">搜索引擎看的keywords</span></td>
            <td><input type="text" size="60" value="<?=$setting['seo_category_keywords']?>" name="seo_category_keywords"></td>
        </tr>
        <tr>
            <td  width="45%"><b>Meta Description:</b><br><span class="smalltxt">给搜索引擎看的Description</span></td>
            <td ><input type="text" size="60" value="<?=$setting['seo_category_description']?>" name="seo_category_description"></td>
        </tr>
    </table>
    <br>
    <center><input type="submit" class="button" name="submit" value="提 交"></center><br>
</form>
<br>
<? include template(footer,admin); ?>
