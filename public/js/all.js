$(document).ready(function() {
//    $("#dropdown_change").on('click',function() {
    $(document).on('change', '#dropdown_change', function() {
        var blogid = $(this).prev("#blog_id").val();
        var permission = $(this).val();
        $.ajax({
            url: 'http://localhost:8000/blog/makepublic',
            type: "post",
            data: {'blog_id':blogid,'permission':permission}, //$("#myform").serialize(),
            success: function(response) {
            }
        });
    });
});