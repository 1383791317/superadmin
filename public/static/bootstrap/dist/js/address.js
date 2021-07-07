$(document).on('change','#input_province',function () {
    ajaxRequest('/manage/address',{id:$('#input_province').val()},function (e) {
        var html = '<option value="">--请选择市级--</option>';
        $.each(e.data,function(idx,item){
            html += "<option value="+item.id+" >"+ item.ext_name +"</option> ";
        });
        $('#input_city').html(html);
        $('#input_area').html('<option value="">--请选择县区--</option>');
    },'','GET')
})
$(document).on('change','#input_city',function () {
    ajaxRequest('/manage/address',{id:$('#input_city').val()},function (e) {
        var html = '<option value="">--请选择县区--</option>';
        $.each(e.data,function(idx,item){
            html += "<option value="+item.id+" >"+ item.ext_name +"</option> ";
        });
        $('#input_area').html(html);
    },'','GET')
})