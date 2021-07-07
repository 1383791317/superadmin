$(function () {
    var locationHref = window.location.href
    var strStart = locationHref.indexOf('#');
    if (strStart>0){
        var controller = locationHref.substring(strStart +1);
        $('#AdminHomeTabIframe').attr('src',controller)
        $('.left-menu').find('.nav-link').each(function () {
            var url = $(this).attr('superadmin-href');
            if (url == controller){
                activeShow(this)
                return ;
            }
        });
    }
    $('body').on('click', '[superadmin-href]', function () {
        var loading = layer.load(0, {shade: false, time: 2 * 1000});
        var href = $(this).attr('superadmin-href'),
            title = $(this).attr('superadmin-title'),
            target = $(this).attr('target');
        $('#AdminHomeTabIframe').attr('src',href)
        if (strStart>0){
            locationHref = locationHref.substring(0,strStart);
        }
        var newUrl = locationHref + '#' + href
        history.pushState(null,title,newUrl);
        if (target === '_blank') {
            layer.close(loading);
            window.open(href, "_blank");
            return false;
        }
        activeShow(this)
        layer.close(loading);
        return  false;
    });
})

function activeShow(obj) {
    $('.left-menu').find('.active').each(function () {
        $(this).removeClass('active')
    });
    $(obj).addClass('active')
    var parent = $(obj).parents('.has-treeview');
    if (parent.length > 0){
        parent.children('a').addClass('active');
        parent.addClass('menu-open');
    }
    $('.left-menu').find('.has-treeview').each(function () {
        $(this).removeClass('menu-open')
        if (this !== parent[0]){
            $(this).find('ul').css('display','none')
        }
    })

}