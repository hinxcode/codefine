$(".bar_btn").mouseenter(function() {
    $(this).stop();
    $(this).animate( {
        "opacity": 0.6
    }, 500, "easeOutCirc");
});

$(".bar_btn").mouseleave(function() {
    $(this).stop();
    $(this).animate( {
        "opacity": 1
    }, 500, "easeOutCirc");
});

$(".bar_btn").click(function() {
    $(".bar_btn").addClass("bar_btn_active");
    $(".panel").css("display", "none");
    $("#" + $(this).data("panel")).fadeIn();
    $(".result_area").prepend('<div class="indicator"></div>');
    $(".indicator").css("margin-top", 0).css("left", $(this).position().left);
    $(".indicator").animate({
        "marginTop": -55
    }, "300", "easeOutCirc");
});

// 圖表分析
$("#bar_btn_chart").click(function() {

});

// 分析報告
$("#bar_btn_report").click(function() {
    /*
    var plot1 = $.jqplot('pie1', [[['a',25],['b',14],['c',7]]], {
        gridPadding: {top:0, bottom:38, left:0, right:0},
        seriesDefaults:{
            renderer:$.jqplot.PieRenderer, 
            trendline:{ show:false }, 
            rendererOptions: { padding: 8, showDataLabels: true }
        },
        legend:{
            show:true, 
            placement: 'outside', 
            rendererOptions: {
                numberRows: 1
            }, 
            location:'s',
            marginTop: '15px'
        }
    });
    */
});

// 度量指標
$("#bar_btn_metrics").click(function() {

});