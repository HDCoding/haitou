var height = 0;

$("ul li").each(function () {
    height += $(this).outerHeight(true); // to include margins
});

$('#chatlist').animate({
    scrollTop: height
});

load_data = {
    'fetch': 1
};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('input[name=_token]').val()
    }
});

window.setInterval(function () {
    $('.chat-box .chat-list');
    $.ajax({
        url: "messages",
        type: 'post',
        data: load_data,
        dataType: 'json',
        success: function (data) {
            $('.chat-box .chat-list').html(data.data);
        }
    });
}, 3000);

$("#submit").click(function () {

    let message = document.getElementById("message").value;

    $.ajax({
        url: "send",
        type: 'post',
        data: {'message': message},
        dataType: 'json',
        success: function (data) {
            $(data.data).hide().appendTo('.chat-box .chat-list').fadeIn();
            $('#chat-error').addClass('hidden');
            $('#message').removeClass('invalid');
            $("#message").val("");
            $('#chatlist').animate({
                scrollTop: height
            });
        },
        error: function (data) {
            $('#message').addClass('invalid');
            $('#chat-error').removeClass('hidden');
            //$('#chat-error').text(data.responseText);
        }
    });

});
