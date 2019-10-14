$(document).ready(function(){
    $('#brand').change(function(){
        var id=$(this).val();
        $.ajax({
            url : "http://code.com/admin/products/subCategory",
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