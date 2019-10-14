$(document).ready(function() {
    $('.ajax_form').on('submit' , (evt) => {
        evt.preventDefault();
        var $form = $(evt.target);
        var values = $form.serializeArray();
        var data = {};
        values.map(item => {
            data[item.name] = item.value
        });
        var product_id = data.product_id;
        var error = '#error_' + product_id;
        $.ajax({
            url: "http://code.com/member/products/buy",
            method: 'post',
            data: data,
            success: (data) => {
                var respons = JSON.parse(data);
                if (respons['success'] = true){
                    $(error).append(respons['message'])
                }
            }
        });
    });

    $(document).ready(function(){
        $('#brand').change(function(){
            var id=$(this).val();
            $.ajax({
                url : "http://code.com/member/products/subCategory",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                success: function(data){
                    console.log(data)
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].id+'>'+data[i].name+'</option>';
                    }
                    $('#model').html(html);
                }
            });
            return false;
        });

    });
});
