$(function() {

    var checked = $('input[type="checkbox"]:checked');
    $('#support_num').text(checked.length);

    $("#voteBtn").click(function () {
        var checked = $('input[type="checkbox"]:checked');
        var  post = true;
        if (checked.length < 5) {
            post = false;
            alert('至少选择5位候选人投票!');
        }
        if (checked.length > 10) {
            post = false;
            alert('最多只能选择10位投票!');
        }
        if (post) {
            document.getElementById('postVoteForm').submit();
        }

    });

    $('input[type="checkbox"]').click(function() {
        var checked = $('input[type="checkbox"]:checked');
        $('#support_num').text(checked.length);
    });
});
