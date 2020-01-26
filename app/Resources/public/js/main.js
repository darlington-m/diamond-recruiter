/**
 * Created by darlington on 12/11/16.
 */


$('input:submit').addClass('btn btn-primary');
$('form[action="/login_check"]').addClass('marginT30');
$('input[name="_username"]').addClass('form-control marginB15');
$('input[name="_password"]').addClass('form-control marginB15');
$('input[name="_submit"]').addClass('show marginB15');
$('label[for="_remember_me"]').addClass('checkbox marginB15');
$('.pagination').addClass('m-b-5');


$(document).ready(function () {

    $('.delete-user-btn').on('click', function () {
        var v = confirm('Delete User?');
        return v;
    });




    $(".navbar-toggle").on("click", function () {
        $('.left-panel').toggleClass('collapsed');
    });

    //adding nicescroll to sidebar
    if ($.isFunction($.fn.niceScroll)) {
        $("aside.left-panel:not(.collapsed)").niceScroll({
            cursorcolor: '#8e909a',
            cursorborder: '0px solid #fff',
            cursoropacitymax: '0.5',
            cursorborderradius: '0px'
        });
    }


    $('#calendar').fullCalendar({

        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        navLinks: true
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })


    Morris.Donut({
        element: 'morris-donut',
        data: [
            {label: "Clients", value: 42},
            {label: "Vacancies", value: 15},
            {label: "Submissions", value: 3}
        ]
    });

    Morris.Area({
        element: 'morris-area',
        data: [
            { y: '2012', a: 100, b: 90 },
            { y: '2013', a: 75,  b: 65 },
            { y: '2014', a: 50,  b: 40 },
            { y: '2015', a: 75,  b: 65 },
            { y: '2016', a: 50,  b: 40 },
            { y: '2017', a: 75,  b: 65 },
        ],
        xkey: 'y',
        ykeys: ['a', 'b']
    });

});