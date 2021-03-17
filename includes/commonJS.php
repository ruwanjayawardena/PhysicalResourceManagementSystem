<script type="text/javascript">
    function goDashboard() {
        window.location.href = "index.php";
    }


    function loadBackendLoggedUserInfo() {
        var loggedinfoDiv = "";
        $.post('controllers/userController.php', {action: 'loggedUsersInfo'}, function (info) {
            $.each(info, function (index, qdt) {
                loggedinfoDiv += '<ul class="list-group list-group-flush">';
//                3 - assign division, 2 - assign zome, 3 - assign province
                if (parseInt(qdt.inst_selection_key) == 3) {
                    loggedinfoDiv += '<li class="list-group-item"><strong>Province : </strong> ' + qdt.prov_name + '</li>';
                    loggedinfoDiv += '<li class="list-group-item"><strong>Zonal : </strong> ' + qdt.zol_name + '</li>';
                    loggedinfoDiv += '<li class="list-group-item"><strong>Division : </strong> ' + qdt.div_name + '</li>';
                } else if (parseInt(qdt.inst_selection_key) == 2) {
                    loggedinfoDiv += '<li class="list-group-item"><strong>Province : </strong> ' + qdt.prov_name + '</li>';
                    loggedinfoDiv += '<li class="list-group-item"><strong>Zonal : </strong> ' + qdt.zol_name + '</li>';
                } else if (parseInt(qdt.inst_selection_key) == 1) {
                    loggedinfoDiv += '<li class="list-group-item"><strong>Province : </strong> ' + qdt.prov_name + '</li>';
                }
                loggedinfoDiv += '<li class="list-group-item"><strong>Institute Type : </strong> ' + qdt.insttype_name + '</li>';
                loggedinfoDiv += '<li class="list-group-item"><strong>Institute : </strong> ' + qdt.inst_name + '</li>';
                loggedinfoDiv += '<li class="list-group-item"><strong>User Category : </strong> ' + qdt.usrcat_name + '</li>';
                loggedinfoDiv += '<li class="list-group-item"><strong>Username : </strong> ' + qdt.usr_username + '</li>';
                loggedinfoDiv += '</ul>';
            });
            $('.loggedinfoDiv').html('').append(loggedinfoDiv)
        }, "json");
    }


    function chosenRefresh() {
        $('select').trigger("chosen:updated");
    }

    function madeCheckBoxString(chkClassName, stringStoreID) {
        var ar = [];
        var es;
        var v;
        if ($(this).is(':checked')) {
            es = $(chkClassName + ':checked');
            es.each(function (index) {
                ar.push($(this).val());
            });
        } else {
            es = $(chkClassName + ':checked');
            es.each(function (index) {
                ar.push($(this).val());
            });
        }
        v = ar.join(',');
        $(stringStoreID).val(v);
    }


    $(document).ready(function () {

        $('select').chosen();

        $('body').append('<button id="toTop" class="btn btn-outline-dark" hidden><i class="fas fa-arrow-circle-up"></i></button>');
        $(window).on('scroll', function () {
            if ($(this).scrollTop() != 0) {
                $('#toTop').prop('hidden', false);
            } else {
                $('#toTop').prop('hidden', true);
            }
        });

        $('#toTop').click(function () {
            $("html, body").animate({scrollTop: 0}, 600);
            return false;
        });

        $('.logout').click(function () {
            swal({
                title: "Alert !",
                text: "Do you need to log out ?",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                cancelButtonClass: "btn-light",
                confirmButtonText: "Yes, Sign out",
                closeOnConfirm: false

            }, function () {
                $.post('controllers/userController.php', {action: 'logout'}, function (x) {
                    if (parseInt(x.msgType) == 1) {
                        swal({
                            title: "Please Wait...",
                            text: x.msg,
                            timer: 1700,
                            showConfirmButton: false
                        });
                        setTimeout(function () {
                            window.location.href = "index.php";
                        }, 2300);
                    } else {
                        swal("Alert !", x.msg, "warning");
                    }
                }, "json");
            });
        });

    });

</script>