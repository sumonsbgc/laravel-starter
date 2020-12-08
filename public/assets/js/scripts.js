;(function($){
    jQuery.datetimepicker.setLocale('en');

    $('.timepicker').datetimepicker({
        datepicker:false,
        format:'H:i:s'
    });
    
    $('.datepicker').datetimepicker({
        timepicker:false,
        datepicker:true,
        format:'Y-m-d',
        mask: true,
    });

    function toggleSidebar(element, status){
        var selector = $(element)
        selector.animate({
            width: status ? '0px' : "240px",
            left: status ? "-400px" : 0,
        }, 700 )
    }
    
    var sidebarDisplay = false;
    $("body").on("click", "#toggle-sidebar", function(e){
        e.preventDefault();
        if(sidebarDisplay){
            toggleSidebar("#left-sidebar", sidebarDisplay);
            sidebarDisplay = false;
        }else{
            toggleSidebar("#left-sidebar", sidebarDisplay);
            sidebarDisplay = true;
        }
    });

    $(".sidebar-menu > li > a").on("click", function(e){
        // if($(this).siblings('#sub-menu').length === 1){}
        $(".sidebar-menu").find(".active").not($(this)).removeClass("active").siblings("#sub-menu").slideUp(400);
        $(this).addClass("active").siblings("#sub-menu").slideToggle(500);
    });

    $(".top-menu > li").on("click", function (e) {
        $(this).siblings().find('.option-dropdown').slideUp();
        $(this).find('.option-dropdown').slideToggle();
    });

    function krTab($filter, $content){
        $('.tab-content').children().not(':first').hide()
        $($filter).children('li').children('a').on('click', function(e){            
            e.preventDefault();
            var _target = $(this).data('target');
            $(this).addClass('active').parent().siblings().find('a').removeClass('active');
            $($content).find('#'+_target).slideDown().siblings().slideUp();
        });
    }

    krTab('.tab-filter', '.tab-content');

    function selectOption(ele, placeholder) {
        $(ele).select2({
            width: 'resolve',
            tags: "true",
            placeholder: placeholder,
            allowClear: true
        });
    }


}(jQuery));