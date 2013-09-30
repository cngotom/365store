$(function () {
    $('#searchPanel').hide();
    $('.searchopbox').click(function () {
        $('#searchPanel').show();
        $('.search_select').click(function () {
            $('#searchcont').html($(this).html());
            var title = $(this).attr('title');
            if (title == 'ttt_user') {
                $('#search_input').removeClass('inputsearh').addClass('inputsearh_add');
            }
            else {
                $('#search_input').removeClass('inputsearh_add').addClass('inputsearh');
            } 
            $('#search_type_input').val($(this).attr("id"));
            $('#searchPanel').hide();
        });

    });
    $('#search_btn').click(function () {
        $('#search_form').submit();
        return false;
    });
});

$(function () {
    $('#brandPanel').hide();
    $('.brandopbox').click(function () {
        var actname = $(".brandopbox").attr("title");

        if (actname == "open") {
            $('#brandPanel').show();
            $('.brandopbox').attr("title", "close");
        } else {
            $('#brandPanel').hide();
            $('.brandopbox').attr("title", "open");
        }
    });

});

function setTab(name, cursel, n) {
        for (i = 1; i <= n; i++) {
            var menu = document.getElementById(name + i);
            var con = document.getElementById("con_" + name + "_" + i);
            menu.className = i == cursel ? "tab_active" : "";
            con.style.display = i == cursel ? "block" : "none";
        }
}