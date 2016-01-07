var createDoughnutChart = function(elementID, data) {    
    var ctx = document.getElementById(elementID).getContext("2d");
    var myDoughnutChart = new Chart(ctx).Doughnut(data, {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke : true,

        //String - The colour of each segment stroke
        segmentStrokeColor : "#fff",

        //Number - The width of each segment stroke
        segmentStrokeWidth : 2,

        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout : 50, // This is 0 for Pie charts

        //Number - Amount of animation steps
        animationSteps : 100,

        //String - Animation easing effect
        animationEasing : "easeOutBounce",

        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate : true,

        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale : false,
    });

    return myDoughnutChart;
} 

function getMetricsHelp(item) {
    var html;

    if(item == 3) {
        html = '<h4>循環複雜度（Cyclomatic Complexity）</h4>' +
            '<p><div class="green_block"></div>低風險 0 - 10</p><p><div class="yellow_block"></div>適當風險 11 - 20</p><p><div class="orange_block"></div>高風險 21 - 50</p><p><div class="red_block"></div>極度不穩定 50 以上</p>' +
            '<p><br/>循環複雜度又稱為迴圈複雜度或圈複雜度，主要是用來描述一個程式「條件分支」的複雜度，因為愈單純的 If-condition 愈容易讀懂，除錯時也較好發現問題，所以複雜度的數值，愈低愈好。因此當程式碼遇到以下保留字時，複雜度的值都會加一：「if、for、while、case、default、continue、&&、||、&、|」</p>';
    } else if(item == 2) {                    
        html = '<h4>霍爾斯特德複雜度（Halstead Complexity）</h4>' +
            '<p>霍爾斯特德的目標是識別軟體中可量測的性質以及各性質間的關係。</p>' +
            '<p>n1 = the number of distinct operators (不同運算子的個數)<br/>n2 = the number of distinct operands (不同運算元的個數)<br/>N1 = the total number of operators (所有運算子合計出現的次數)<br/>N2 = the total number of operands (所有運算元合計出現的次數)<br/>' +
            '* 上述的運算子包括傳統的運算子及保留字；運算元包括變數及常數<br/><br/>' +
            '依上述數值，可以計算以下的量測量：<br/><br/>' +
            '程式詞彙數（Program vocabulary）：n = n 1 + n 2<br/>' +
            '程式長度（Program length）：N = N 1 + N 2<br/>' +
            '計算程式長度（Calculated program length）： = n 1 log2 n 1 + n 2 log2 n 2<br/>' +
            '容量（Volume）：V = N × log2 n<br/>' +
            '難度（Difficulty）：D = n1 / 2 x N2 / n2<br/>' +
            '精力（Effort）：E = D × V<br/>' +
            '程式撰寫時間：T = E / 18<br/>' +
            '霍爾斯特德交付錯誤（Halstead\'s delivered bugs）：B = V / 3000 能估計在實現過程中會產生的錯誤</p>';
    } else {
        html = '<h4>程式碼行數（Source Lines of Code）</h4>' +
            '<p>簡稱SLOC又稱LOC。此軟體度量藉由計算程式碼的行數來衡量電腦程式的大小。當一個程式被要求開發時，SLOC常用於預測其工作量；而程式開始生產時將會拿來測量其生產量及維護性。</p>' +
            '<p>以下片段程式碼為例：</p>' +
            '<pre><code class="java">public class Foo {<br/>public static void main() { } }</code></pre>' +
            '<p>從以上程式碼將測出<br/>1 Physical Line of Code (LOC)<br/>2 Logical Lines of Code (LLOC)  (for statement and printf statement)<br/>1 Comment Line<br/><br/></p>' +
            '<h4>註解密度（Density of Comments）</h4>' +
            '<p>輔以註解的說明可以讓別人對於程式的內容更有效的了解。程式註解密度(DC)為註解行數(CLOC)和全部行數(LOC)之比率，因此，註解密度DC = CLOC / LOC。註解密度的值介於0～1之間，可將此列為品質的指標，密度越接近1代表程式碼品質越好。</p>' +
            '<p>以下片段程式碼為例：</p>' +
            '<p><img src="images/dc.jpg" style="width:500px;height:320px;"/></p>' +
            '<p>以上程式碼LOC為12；CLOC(綠色字)為 4<br/>DC = 4 / 12 ≒ 0.33</p>';
    }

    return html;
}

function getTree(res) {
    var nodes = [];
    
    res.forEach(function(f, i) {
        
        var node = {"text": f["filename"], "i": i, "level": "1", "icon": "glyphicon glyphicon-file"};
        var nodes_ii = [];
        
        $.parseJSON(f["result"])["cyclomatic"].forEach(function(cls, ii) {
            
            var node_ii = {"text": cls["class_name"], "i": i, "ii": ii, "level": "2", "icon": "glyphicon glyphicon-copyright-mark"};
            var nodes_iii = [];

            cls["values"].forEach(function(m, iii) {
                var node_iii = {"text": m["method_name"], "i": i, "ii": ii, "iii": iii,"level": "3"};
                nodes_iii.push(node_iii);
            });
            node_ii["nodes"] = nodes_iii;
            
            nodes_ii.push(node_ii);
        });
        node["nodes"] = nodes_ii;

        nodes.push(node);
    });
    
    return nodes;
}

function updateResult(res, data) {
    $("#area_chart").html('<div class="area_title"><p class="panel_title">圖表分析</p><p class="panel_subtitle">Analysis Chart</p></div>');
    $("#area_metrics").html('<div class="area_title"><p class="panel_title">度量指標</p><p class="panel_subtitle">Metrics</p></div>');

    if(data.level == 1) {
        var chart_data = [];
        var score = 255;
        var rate = "";
        var suggestion = "";
        res.forEach(function(v, i) {
            var cls_count = 0;
            var cls_value = 0; // cc
            var cls_value2 = 0; // difficulty
            var cls_value3 = 0; // volume
            var cls_value4 = 0; // time

            $.parseJSON(v["result"])["halstead"].forEach(function(cls, ii) {
                cls_value2 += cls["values"]["difficulty"];
                cls_value3 += cls["values"]["volume"];
                cls_value4 += cls["values"]["time"];
            });
            $.parseJSON(v["result"])["cyclomatic"].forEach(function(cls, ii) {
                var m_count = 0;
                var m_value = 0;
                cls_count++;
                cls["values"].forEach(function(m, iii) {
                    m_count++;
                    m_value += m["cc"];
                });
                if(m_count == 0) m_count = 1;
                cls_value += m_value / m_count;
            });
            chart_data.push({f_name: v["filename"], cc_avg: cls_value / cls_count});
            if(i == data.i && cls_count >= 1) {
                var lvl_v = cls_value / cls_count;
                var lvl_d = cls_value2 / cls_count;
                var lvl_volume = cls_value3 / cls_count;
                var lvl_time = cls_value4 / cls_count;

                score -= lvl_volume * 0.015;
                if(lvl_volume >= 5000) {
                    suggestion += '<p class="fullBrick_sug">＊過多重複的運算子及運算元可能導致程式碼產生邏輯錯誤。</p>';
                }

                score -= lvl_time * 0.002;
                if(lvl_time >= 50000) {
                    suggestion += '<p class="fullBrick_sug">＊類別平均估計開發時間過高，建議您進行程式碼的重構，以減少日後維護的成本。</p>';
                } else if(lvl_time >= 100000) {
                    suggestion += '<p class="fullBrick_sug">＊類別平均估計開發時間偏高，建議您減少重複出現的運算子、運算元，並將程式中的邏輯部分抽象化。</p>';
                }

                score -= lvl_v * 10;
                if (lvl_v >= 50) {
                    suggestion += '<p class="fullBrick_sug">＊循環複雜度極高，強烈建議您減少程式的分支程度以降低錯誤風險。</p>';
                } else if (lvl_v >= 31) {
                    suggestion += '<p class="fullBrick_sug">＊循環複雜度偏高，建議您減少程式的分支程度以降低錯誤風險。</p>';
                }

                score -= lvl_d * 0.3;
                if (lvl_d >= 200) {
                    suggestion += '<p class="fullBrick_sug">＊出現過多重複的運算子及運算元，建議進行Refactoring以提升程式品質。</p>';
                } else if (lvl_d >= 100) {
                    suggestion += '<p class="fullBrick_sug">＊建議減少重複的運算子及運算元以提升程式品質</p>';
                }
            }
        });
    
        var dc = $.parseJSON(res[data.i]["result"])["dc"]["dcp"];
        var cloc = $.parseJSON(res[data.i]["result"])["dc"]["cloc"];
        var loc = $.parseJSON(res[data.i]["result"])["dc"]["loc"];
        var f_name = res[data.i]["filename"];
        
        if (dc > 0.4) {
            suggestion += '<p class="fullBrick_sug">＊建議註解密度應介於 20% 與 40% 之間。</p>';
            score -= (dc - 0.4) * 50;
        } else if (dc < 0.2) {
            suggestion += '<p class="fullBrick_sug">＊建議註解密度應介於 20% 與 40% 之間。</p>';
            score -= (0.2 - dc) * 250;
        }

        if(score > 210) {
            rate = "優良";
        } else if(score > 130) {
            rate = "良好";
        } else if(score > 0) {
            rate = "尚可";
        } else {
            rate = "待加強";
        }
        $("#area_chart").append('<div class="fullBrick"><div class="fullBrick_left"><div style="font-size:13pt;">品質</div><div class="rateblock" style="font-size:30pt;text-align:center;">' + rate + '</div></div><div class="fullBrick_right"><p class="fullBrick_filename">最大值：255<br/>換算分數：' + score.toFixed(4) + '<br/>優良：210以上 ｜ 良好：130 至 210 ｜ 尚可：0 至 130 ｜ 待加強：0以下</p>' + suggestion + '</div><div class="clean"></div></div>');
        $("#area_chart").append('<div class="vBrick_small blue3_brick"><div class="brick_left"></div><div class="data_counter">JAVA</div><div class="brick_title">語言</div><div class="brick_subtitle">Language</div></div>');
        $("#area_chart").append('<div class="vBrick blue_brick"><div class="brick_left"></div><div id="counter_sloc" class="data_counter"></div><div class="brick_title">程式碼行數</div><div class="brick_subtitle">Physical Line</div></div>');
        $("#area_chart").append('<div class="vBrick blue2_brick"><div class="brick_left"></div><div id="counter_dc" class="data_counter"></div><div class="brick_title">註解密度</div><div class="brick_subtitle">DC = CLOC / LOC</div></div>');
        $("#area_chart").append('<div class="clean"></div>');
        $("#area_chart").append('<div id="chartContainer" style="margin-top: 20px; margin-left:10px; width:650px; height:500px;"></div>');

        if($(".fullBrick").children(".fullBrick_left").height() > $(".fullBrick").children(".fullBrick_right").height() + 30) {
            $(".fullBrick").children(".fullBrick_right").height($(".fullBrick").children(".fullBrick_left").height() - 30);
        } else {
            $(".fullBrick").children(".fullBrick_left").height($(".fullBrick").children(".fullBrick_right").height() + 30);
        }
        $(".fullBrick").children(".fullBrick_left").children(".rateblock").css("line-height", ($(".fullBrick").children(".fullBrick_left").height() - 30) + "px");

        $('#counter_sloc').jQuerySimpleCounter({
            end: loc,
            unit: "<span style='font-size:10pt'>行</span>"
        });
        $('#counter_dc').jQuerySimpleCounter({
            end: dc * 100,
            unit: "<span style='font-size:10pt'>%</span>"
        });

        var settings = {
            title: "各檔案之程式碼複雜度比較圖",
            description: "",
            showLegend: true,
            enableAnimations: true,
            padding: { left: 30, top: 5, right: 30, bottom: 30 },
            titlePadding: { left: 0, top: 15, right: 0, bottom: 15 },
            source: chart_data,
            xAxis:
            {
                dataField: 'f_name',
                displayText: '檔名',
                gridLines: { visible: true },
                flip: false
            },
            valueAxis:
            {
                flip: true,
                labels: {
                    visible: true
                }
            },
            colorScheme: 'scheme05',
            seriesGroups:
                [
                    {
                        type: 'column',
                        orientation: 'horizontal',
                        columnsGapPercent: 50,
                        toolTipFormatSettings: { thousandsSeparator: ',' },
                        series: [
                            { dataField: 'cc_avg', displayText: '平均複雜度' }
                        ]
                    }
                ]
            };
            
        $('#chartContainer').jqxChart(settings);

    } else if (data.level == 2) {
        var n1 = $.parseJSON(res[data.i]["result"])["halstead"][data.ii]["values"]["n1"];
        var n2 = $.parseJSON(res[data.i]["result"])["halstead"][data.ii]["values"]["n2"];
        var N1 = $.parseJSON(res[data.i]["result"])["halstead"][data.ii]["values"]["N1"];
        var N2 = $.parseJSON(res[data.i]["result"])["halstead"][data.ii]["values"]["N2"];
        var vocabulary = $.parseJSON(res[data.i]["result"])["halstead"][data.ii]["values"]["vocabulary"];
        var length = $.parseJSON(res[data.i]["result"])["halstead"][data.ii]["values"]["length"];
        var calculated = $.parseJSON(res[data.i]["result"])["halstead"][data.ii]["values"]["calculated"];
        var volume = $.parseJSON(res[data.i]["result"])["halstead"][data.ii]["values"]["volume"];
        var difficulty = $.parseJSON(res[data.i]["result"])["halstead"][data.ii]["values"]["difficulty"];
        var effort = $.parseJSON(res[data.i]["result"])["halstead"][data.ii]["values"]["effort"];
        var time = $.parseJSON(res[data.i]["result"])["halstead"][data.ii]["values"]["time"];
        var bugs = $.parseJSON(res[data.i]["result"])["halstead"][data.ii]["values"]["bugs"];
        var c_name = $.parseJSON(res[data.i]["result"])["halstead"][data.ii]["class_name"];

        $("#area_chart").append('<div class="vBrick blue2_brick"><div class="brick_left"></div><div id="counter_calculated" class="data_counter"></div><div class="brick_title">計算程式長度</div><div class="brick_subtitle">Calculated Program Length</div></div>');
        $("#area_chart").append('<div class="vBrick blue_brick"><div class="brick_left"></div><div id="counter_volume" class="data_counter"></div><div class="brick_title">程式容量</div><div class="brick_subtitle">Volume</div></div>');
        $("#area_chart").append('<div class="vBrick_small blue3_brick"><div class="brick_left"></div><div id="counter_difficulty" class="data_counter"></div><div class="brick_title">難度</div><div class="brick_subtitle">Difficulty</div></div>');
        $("#area_chart").append('<div class="vBrick blue2_brick"><div class="brick_left"></div><div id="counter_effort" class="data_counter"></div><div class="brick_title">耗費精力</div><div class="brick_subtitle">Effort</div></div>');
        $("#area_chart").append('<div class="vBrick blue_brick"><div class="brick_left"></div><div id="counter_time" class="data_counter"></div><div class="brick_title">撰寫時間</div><div class="brick_subtitle">Time required to program</div></div>');
        $("#area_chart").append('<div class="vBrick_small blue3_brick"><div class="brick_left"></div><div id="counter_bugs" class="data_counter"></div><div class="brick_title">預估錯誤</div><div class="brick_subtitle">Delivered bugs</div></div>');
        $("#area_chart").append('<div class="gBrick"><div class="gBrick_bar">相異運算子的個數</div><div class="gBrick_data"><p class="gBrick_help">n1 = the number of distinct operators</p><div id="counter_n1" class="data_counter2"></div></div></div>');
        $("#area_chart").append('<div class="gBrick"><div class="gBrick_bar">相異運算元的個數</div><div class="gBrick_data"><p class="gBrick_help">n2 = the number of distinct operands</p><div id="counter_n2" class="data_counter2"></div></div></div>');
        $("#area_chart").append('<div class="gBrick"><div class="gBrick_bar2">程式詞彙數</div><div class="gBrick_data" style="text-align:center"><canvas id="vocabulary_doughnut" width="135" height="135"></canvas><div id="counter_vocabulary" class="doughnut_value">' + vocabulary + '</div></div></div>');
        $("#area_chart").append('<div class="gBrick"><div class="gBrick_bar">所有運算子的個數</div><div class="gBrick_data"><p class="gBrick_help">N1 = the total number of operators</p><div id="counter_N1" class="data_counter2"></div></div></div>');
        $("#area_chart").append('<div class="gBrick"><div class="gBrick_bar">所有運算元的個數</div><div class="gBrick_data"><p class="gBrick_help">N2 = the total number of operands</p><div id="counter_N2" class="data_counter2"></div></div></div>');
        $("#area_chart").append('<div class="gBrick"><div class="gBrick_bar2">程式長度</div><div class="gBrick_data" style="text-align:center"><canvas id="length_doughnut" width="135" height="135"></canvas><div id="counter_length" class="doughnut_value">' + length + '</div></div></div>');
        $("#area_chart").append('<div class="clean"></div>');

        $('#counter_n1').jQuerySimpleCounter({
            end: n1
        });
        $('#counter_n2').jQuerySimpleCounter({
            end: n2
        });
        $('#counter_N1').jQuerySimpleCounter({
            end: N1
        });
        $('#counter_N2').jQuerySimpleCounter({
            end: N2
        });
        $('#counter_vocabulary').jQuerySimpleCounter({
            end: vocabulary
        });
        $('#counter_length').jQuerySimpleCounter({
            end: length
        });
        $('#counter_calculated').jQuerySimpleCounter({
            end: calculated
        });
        $('#counter_volume').jQuerySimpleCounter({
            end: volume
        });
        $('#counter_difficulty').jQuerySimpleCounter({
            end: difficulty
        });
        $('#counter_effort').jQuerySimpleCounter({
            end: effort
        });
        $('#counter_time').jQuerySimpleCounter({
            end: time,
            unit: "<span style='font-size:10pt'>秒</span>"
        });
        $('#counter_bugs').jQuerySimpleCounter({
            end: bugs,
            unit: "<span style='font-size:10pt'>個</span>"
        });

        var doughnut_data1 = [
            {
                value: n1,
                color: "#9393FF",
                highlight: "#7D7DFF",
                label: "n1"
            },
            {
                value: n2,
                color: "#81C0C0",
                highlight: "#4F9D9D",
                label: "n2"
            }
        ]
        var doughnut_data2 = [
            {
                value: N1,
                color: "#9393FF",
                highlight: "#7D7DFF",
                label: "N1"
            },
            {
                value: N2,
                color: "#81C0C0",
                highlight: "#4F9D9D",
                label: "N2"
            }
        ]
        var chart1 = createDoughnutChart("vocabulary_doughnut", doughnut_data1);
        var chart2 = createDoughnutChart("length_doughnut", doughnut_data2);

    } else if(data.level == 3) {
        var cc = $.parseJSON(res[data.i]["result"])["cyclomatic"][data.ii]["values"][data.iii]["cc"];
        var m_name = $.parseJSON(res[data.i]["result"])["cyclomatic"][data.ii]["values"][data.iii]["method_name"];

        $("#area_chart").append('<div class="gauge_brick"><div class="gauge_brick_bar">循環複雜度 Cyclomatic Complexity</div><div class="gaugeFrame" style="padding:0 10px;">' + m_name + '<div id="gaugeContainer"></div><div class="gaugeValue"></div></div>');
        $("#area_chart").append('<div class="gauge_legend_brick"><p><div class="green_block"></div>低風險 0 - 10</p><p><div class="yellow_block"></div>適當風險 11 - 20</p><p><div class="orange_block"></div>高風險 21 - 50</p><p><div class="red_block"></div>極度不穩定 50 以上</p></div><div class="clean"></div>');

        $('#gaugeContainer').jqxGauge({
            value: 0,
            max: 60,
            ranges: [{ startValue: 0, endValue: 10, style: { fill: '#4bb648', stroke: '#4bb648' }, endWidth: 5, startWidth: 1 },
                     { startValue: 10, endValue: 20, style: { fill: '#fbd109', stroke: '#fbd109' }, endWidth: 10, startWidth: 5 },
                     { startValue: 20, endValue: 50, style: { fill: '#ff8000', stroke: '#ff8000' }, endWidth: 13, startWidth: 10 },
                     { startValue: 50, endValue: 60, style: { fill: '#e02629', stroke: '#e02629' }, endWidth: 16, startWidth: 13 }],
            ticksMinor: { interval: 5, size: '5%' },
            ticksMajor: { interval: 10, size: '8%' },
            caption: { offset: [0, -50], value: '複雜度', position: 'bottom' },
            style: { stroke: '#FFF', 'stroke-width': '0px', fill: '#FFF'},
            border: { visible: false },
            labels: { interval: 10 },
            easing: "easeOutBack",
            colorScheme: 'scheme06',
            animationDuration: 1000
        });
        
        $('#gaugeContainer').jqxGauge('value', cc);
        $(".gaugeValue").html(cc);
    }
    
    // 度量指標說明
    $("#area_metrics").append(getMetricsHelp(data.level));
}

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
    $(".bar_btn").removeClass("bar_btn_active");
    $(this).addClass("bar_btn_active");
    $(".panel").css("display", "none");
    $("#" + $(this).data("panel")).fadeIn();
    $(".indicator").remove();
    $(".result_area").prepend('<div class="indicator"></div>');
    $(".indicator").css("margin-top", 0).css("left", $(this).position().left);
    $(".indicator").animate({
        "marginTop": -50 - $(window).height() * 0.01
    }, "300", "easeOutCirc");
});

// 圖表分析
//("#bar_btn_chart").click(function() {});

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
//$("#bar_btn_metrics").click(function() { });