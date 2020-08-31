$(function() {
    function genStr(length) {
        var result = '';
        // var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
    $('.btn-gen').off('click');
    $('.btn-gen').on('click', function() {
        var target = $('#' + $(this).attr('gen-for'));
        target.val(genStr(8));
    });
})