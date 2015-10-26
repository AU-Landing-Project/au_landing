define(['require', 'jquery'], function(require, $) {
    if ($('.au-messages').length) {
        $('.au-messages-new').removeClass('hidden').insertAfter('.au-messages');
    }
});