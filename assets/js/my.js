$(document).ready(function(){
    $('.slectAllcheclbox').click(function(){
        var getval = $(this).attr('data-getval');
        $(".slectAllcheclbox_"+getval).prop('checked', $(this).prop('checked'));
    });
    $('.submitButton').click(function(){
        if($('[type="text"]').val() == ''){
            $('[type="text"]').css({'border':'1px solid red'});
            alert('Please add URL.');
            return false;
        }
    });
    $('.continueBtnSet').click(function(){
        if($('input:checkbox:checked'). length == 0){
            alert('Please checked atleast one checkbox.');
            return false;
        }
    });
    var editor1 = new RichTextEditor("#div_editor1", { editorResizeMode: "height" });
});