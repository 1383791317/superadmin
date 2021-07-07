(function ($) {

    var superAdmin = {
        /**
         * 初始化
         * @param option
         */
        render :function(option){
            superAdmin.renderHome();
        },

        globalTable :function (url, columns,extend = {}, tableId = '#exampleTableEvents') {
            var b = {
                method : 'GET',
                url : url,//请求路径
                striped : false, //是否显示行间隔色
                bordered: false,
                pageNumber : 1, //初始化加载第一页
                pagination : true,//是否分页
                sidePagination : 'server',//server:服务器端分页|client：前端分页
                pageSize : 12,//单页记录数
                pageList : [ 5, 10, 20, 30 ],//可选择单页记录数
                toolbar: '#exampleTableEventsToolbar',
                showRefresh : true,//刷新按钮
                showToggle: true,
                showColumns: true,
                buttonsClass:false,
                iconSize: 'outline-secondary',
                columns : columns
            };
            $(tableId).bootstrapTable($.extend(b, extend));
        },
        /**
         * 生成随机ID
         */
        randID :function(){
            return Number(Math.random().toString().substr(3,length) + Date.now()).toString(36);
        },
    };
})(jQuery);

function ajaxRequest(url, data , success  = '', error= '', method = 'POST', request = {}) {
    if (success == ''){ success = function (e) { toastrAlert(e.code,e.message); }}
    var d = {
        type: method,
        dataType: "json",
        url: url,
        data: data,
        success: success,
        error:function (er) {
            if (error != '') { error();}
            toastr.error(er.responseJSON.message,'系统异常');
        }
    };
    $.ajax($.extend(d, request))
}

function layer_open_iframe(title,url,width = '80%' ,height = '90%') {
    layer.open({
        type: 2,
        title: title,
        shadeClose: true,
        shade: 0.8,
        area: [width, height],
        content: url //iframe的url
    });
}

function toastrAlert(code, message='', describe = '') {
    switch (code) {
        case 1:
            window.parent.parentToastr.success(message,describe);
            break;
        case 0:
            toastr.error(message,describe);
            break;
        case 2:
            toastr.info(message,describe);
            break;
        case 3:
            toastr.warning(message,describe);
            break;
        default:
            toastr.error('未知异常',message ? message :'异常原因不明');
    }
}

function confirmOperation(alertMsg, func, icon = null,title= null,offset = 'auto') {
    var t = {
        btn: ['确定','取消'], //按钮
        offset:offset,
        title:title
    };
    if (icon !== false) { t = $.extend(t,{icon: icon}); }
    layer.confirm(alertMsg, t, func);
}

/*单条删除*/
function deleteData(title, url, id, tableId = '#exampleTableEvents') {
    confirmOperation(title,function (index) {
        ajaxRequest(url, {id:id},function (e) {
            layer.close(index);
            $(tableId).bootstrapTable('refresh');
            if (e.code == 1){ toastr.success(e.message); }else{ toastr.error(e.message,e.describe); }
        },'','DELETE')
    })
}
/*批量删除*/
function tableBatchDelete(confirmMsg, url, tableId = "#exampleTableEvents") {
    var rows = $(tableId).bootstrapTable('getSelections');
    if (rows.length == 0)  {
        toastr.warning('请先选择删除的数据');
        return false;
    }
    var ids = new Array();
    $(rows).each(function() {// 通过获得别选中的来进行遍历
        ids.push(this.id);
    });
    return deleteData(confirmMsg,url,ids,tableId)
}
function SearchData(tableId = '#exampleTableEvents') {
    $(tableId).bootstrapTable('refresh',true);
}