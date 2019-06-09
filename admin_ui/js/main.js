    $(document).ready(function () {
        // mobile nav toggle
        $('.navbar-toggler').click(function () {
            $('.navbar-toggler').addClass('show');
        });
        // tabs active class
        $('.nav-tabs li').click(function () {
            $(this).siblings('li').removeClass('active-tab');
            $(this).addClass('active-tab');

        });
        $('.main-title').click(function () {
            $('.nav-tabs li').siblings('li').removeClass('active-tab');
            $('.notShow').removeClass('active show');
            $('#menu0').addClass('active show');
        });
    });