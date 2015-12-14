$(function(){
    $('#suggest').on('click', function(){
        $('.payment .loading').removeClass('hidden');
        setTimeout(function(){
            $('.payment .loading').addClass('hidden');
            $('.payment .suggestion').removeClass('hidden');
        }, 1000);
    });       
});
