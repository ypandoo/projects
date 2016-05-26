var win = $(window),
    nav_on = null;
$( document ).ready(function () 
{
        var nav = $('#nav');
        var shop = $('#shop');
            // search_box = shop.find('#searchbox');
            // search_btn = shop.find('.btn-search')[0];
            var lis = nav.children();
            var lis_1 = lis.filter(':not(.more)');
            var lis_2 = lis.filter('.more');
            var links = lis.children();
            var links_1 = lis_1.children();
            var links_2 = lis_2.children();
            var subNav = $('#subNav');
            var subitem = $('#subNav').find('.item');
            var prev_item = $();
            var spans = links.children();
            var offs = spans.filter('.off');
            var ons = spans.filter('.on');
            var sbs = spans.filter('.slideBlock');

            var hei = links.eq(0).height();
            var len = lis.length;

            // 记录当前
            var link_page = null;
            var link_curr = null;

            var timeout = -1;

        // 初始化当前链接
        href = location.href.replace(/[_\d]{1,2}\./, '.');      // 静态页面用
        links_2.each(function (idx) {
            if (this === nav_on) return;
            this.setAttribute('idx', idx);
        });

        index_hash = getHash();
        //index_hash = parseInt(index_hash.substring(1,index_hash.Length));
        link_page = links.eq(index_hash)[0];
        if (typeof(link_page) == "undefined" || link_page == null) 
        {
        }
        else
        {
            control(nav_on = link_curr = link_page, false);
        }

        if (index_hash != 0)
            $("#index1").removeClass('on');



        win.on('load', function () {
            // 鼠标指向, 链接高亮
            links_1.hover(function () { control(this, false) }, none);
            links_2.hover(function () { control(this, true) }, none);
            // 鼠标离开导航栏, 恢复当前页面高亮
            nav.hover(none, function () {
                timeout = setTimeout(function () {
                    control(link_page, true);
                }, 10);
            });
            subNav.hover(function () {
                clearTimeout(timeout);
            }, function () {
                index_hash = getHash();
                link_page = links.eq(index_hash)[0];
                control(link_page, true);
                idx = parseInt(link_page.getAttribute('idx'));
                prev_item = subitem.eq(idx).removeClass('on');
            });
        });

        function control(elem, flag, idx) {
            link_curr.className = "";
            elem.className = "on";
            link_curr = elem;
            prev_item.removeClass('on');
            if (flag) {
                idx = parseInt(elem.getAttribute('idx'));
                prev_item = subitem.eq(idx).addClass('on');
                // search_box.hide();
                // search_btn.className = "btn-search";
            }
        }
        function none() { }


        // 2015.06.09 修改搜索, 添加语言
        /*var subitem_search = subitem.filter('.search'),
            subitem_langs = subitem.filter('.langs');
        shop.find('.btn-search').hover(function () {
            prev_item.removeClass('on');
            prev_item = subitem_search.addClass('on');
        }, none);
        shop.find('.btn-lang').hover(function () {
            prev_item.removeClass('on');
            prev_item = subitem_langs.addClass('on');
        }, none);
        shop.hover(none, function () {
            timeout = setTimeout(function () {
                prev_item.removeClass('on');
            }, 300);
        });*/
    });


function getHash()
{
    if ((window.location.href.indexOf("newsEditor") != -1) 
        ||(window.location.href.indexOf("paramsSetting") != -1) 
        ||(window.location.href.indexOf("payInConfirm") != -1) 
        ||(window.location.href.indexOf("permissionSet") != -1) 
        ||(window.location.href.indexOf("projectBasicInfo") != -1) 
        ||(window.location.href.indexOf("projectBonusInfo") != -1) 
        ||(window.location.href.indexOf("projectMange") != -1) 
        ||(window.location.href.indexOf("projectNewsInfo") != -1) 
        ||(window.location.href.indexOf("projectPics") != -1) 
        ||(window.location.href.indexOf("proListManage") != -1) 
        ||(window.location.href.indexOf("remissionSetting") != -1) 
        ||(window.location.href.indexOf("subscribeConfirm") != -1)
        ||(window.location.href.indexOf("back") != -1) )
        {return 4;}
    else if ((window.location.href.indexOf("subscribeApply") != -1) 
        ||(window.location.href.indexOf("projectList") != -1)
        ||(window.location.href.indexOf("newsList") != -1))
    {
        return 1;
    }
    else if ((window.location.href.indexOf("personalCenter") != -1) 
        ||(window.location.href.indexOf("personalInfo") != -1) )
    {
        return 2;
    }else if (window.location.href.indexOf("followRules") != -1) 
    {
        return 3;
    }else
    {
        return 0;
    }
}