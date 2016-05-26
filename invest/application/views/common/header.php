    <div id="header">
        <div class="g-wrap">
            <a id="logo" href="<?php echo site_url();?>"></a>
            <ul id="nav">
                <li class="n1"><a href="<?php echo site_url();?>#0" id="index1"><span>首页</span><span class="bkg"></span></a></li>
                <li class="n2 more"><a href="<?php echo site_url().'home/index/projectList?query=0#1';?>"><span>认购项目列表</span><span class="bkg"></span></a></li>
                <li class="n3 more"><a href="<?php echo site_url().'home/index/personalCenter#2';?>"><span>个人中心</span></span><span class="bkg"></span></a></li>
                <li class="n4 "><a href="<?php echo site_url().'home/index/followRules#3';?>"><span>跟投制度</span><span class="bkg"></span></a></li>
                <li class="n5 "><a onclick="checkback()"><span>后台管理</span><span class="bkg"></span></a></li>
            </ul>

            <div id="shop">
                <a class="btn-lang tmp-unselect"  href="<?php echo site_url()?>home\index\login" id="login" onclick="loginout()">登录</a>
                <!--a href="javascript:void(0);" onclick="check_login()"class="btn-search"></a-->
                <input type="text" style="display:none" id="uid" value="" />
            </div>
        </div>
    </div>
    
    <div id="content">
        <div id="subNav">
            <div class="g-wrap">
                <div class="item about">
                    <a href="<?php echo site_url().'home/index/projectList?query=0#1';?>">认购项目列表<span></a>
                    <a href="<?php echo site_url().'home/index/newsList#1';?>">动态新闻<span></a>
                </div>
                <div class="item news">
                    <a href="<?php echo site_url().'home/index/projectList?query=1#2';?>">我要认购<span></a>
                    <a href="<?php echo site_url().'home/index/projectList?query=2#2';?>">未完成认购<span></a>
                    <a href="<?php echo site_url().'home/index/completed#2';?>">已完成认购<span></a>
                    <a href="<?php echo site_url().'home/index/payInDetail#2';?>">缴款确认<span></a>
                    <a href="<?php echo site_url().'home/index/bonusDetail#2';?>">分红明细<span></a>
                    <a href="<?php echo site_url().'home/index/personalInfo#2';?>">个人信息<span></a>
                </div>
                <!--div class="item search">
                    <input id='searchbox' type="text" placeholder="请输入关键词" />
                </div>
                <!--div id="language-box" class="item langs">
                    <a id="on" href="../">中文简体</a>
                    <a href="/big5">中文繁体</a>
                    <a href="/en">EN</a>
                </div-->
            </div>
        </div>
        <div style="height:67px; width:100%">
        </div>
    </div>
<script type="text/javascript">
$('#login').text('登出:'+"<?php echo $username ?>");
$('#uid').attr('uid',"<?php echo $uid ?>");

function loginout() {
    var ctx= "<?php echo site_url() ?>";
        $.ajax({
            type:'post',
            url:ctx+'Login/logout',
            dataType:'json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
            success:function(msg){
                location.href = ctx+'home/index/login';
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                //alert(errorThrown); 
            }
        });
    }

function checkback()
{
    var back = "<?php echo $userRight ?>";
    if (back == '0') {
        alert('您没有后台管理的权限！');
    }
    else
    {
        var ctx= "<?php echo site_url() ?>";
        location.href = ctx+'back';
    }

}


</script>

