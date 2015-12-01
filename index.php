<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Codefine</title>
		
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap-treeview.min.css" />
		<link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/result.css" />

		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/circle-progress.js"></script>
		<script src="bootstrap/js/bootstrap-treeview.min.js"></script>
    	<script src="jqwidgets/jqxcore.js"></script>
    	<script src="jqwidgets/jqxdraw.js"></script>
    	<script src="jqwidgets/jqxdata.js"></script>
    	<script src="jqwidgets/jqxgauge.js"></script>
    	<script src="jqwidgets/jqxchart.core.js"></script>
		<script src="js/Chart.min.js"></script>
    	<script src="js/jQuerySimpleCounter.js"></script>

    	<style type="text/css">
	    	#gaugeContainer {
	    		margin: 0 auto;
	    	}
		    .gaugeFrame {
		    	position: relative;
		    }
	        .gaugeValue {
		        position: absolute;
		        top: 65%;
		        left: 39%;
		        text-align: center;
		        font-weight: bold;
		        font-size: 16pt;
		        width: 21%;
		        color: rgba(44, 83, 138, 0.9);
		    }
		    .green_block {
		    	width: 30px;
		    	height: 30px;
		    	background-color: rgb(75,182,72);
		    	display: inline-block;
				vertical-align: middle;
				margin-right: 10px;
		    }
		    .yellow_block {
		    	width: 30px;
		    	height: 30px;
		    	background-color: rgb(251,209,9);
		    	display: inline-block;
				vertical-align: middle;
				margin-right: 10px;
		    }
		    .orange_block {
		    	width: 30px;
		    	height: 30px;
		    	background-color: rgb(255,188,0);
		    	display: inline-block;
				vertical-align: middle;
				margin-right: 10px;
		    }
		    .red_block {
		    	width: 30px;
		    	height: 30px;
		    	background-color: rgb(224,38,31);
		    	display: inline-block;
				vertical-align: middle;
				margin-right: 10px;		    	
		    }
		    .vBrick {
				width: 230px;
				height: 140px;
				padding: 5px;
				color: #FFF;
				box-shadow: 1px 3px 5px #BBB;
				margin: 0 10px 10px 10px;
				float: left;
		    }
		    .vBrick_small {
				width: 150px;
				height: 140px;
				padding: 5px;
				color: #FFF;
				box-shadow: 1px 3px 5px #BBB;
				margin: 0 10px 10px 10px;
				float: left;
		    }
		    .green_brick {
		    	background-color: rgba(71, 190, 65, 0.9);
		    }
		    .gray_brick {
		    	background-color: rgba(200, 200, 200, 0.9);
		    }
		    .blue_brick {
		    	background-color: rgba(67, 113, 183, 0.9);
		    }
		    .blue2_brick {
		    	background-color: rgba(44, 83, 138, 0.9);
		    }
		    .blue3_brick {
		    	background-color: #37589E;
		    }
		   	.red_brick {
		    	background-color: rgba(225, 47, 65, 0.9);
		    }
		   	.data_counter {
		    	font-size: 20pt;
		    	font-weight: bold;
		    	letter-spacing: 2px;
		    	color: #FFF;
		    	display: inline-block;
		    	margin-top: 10px;
		    	margin-bottom: 5px;
		    }
		    .data_counter2 {
		    	font-size: 25pt;
		    	font-weight: bold;
		    	letter-spacing: 2px;
		    	text-align: right;
		    }
		    .gBrick {
		    	width: 200px;
		    	height: 210px;
		    	box-shadow: 1px 3px 5px #BBB;
		    	float: left;
		    	margin: 10px;
		    	background-color: #FFF;
		    }
		    .gBrick .gBrick_bar {
		    	height: 80px;
		    	line-height: 80px;
		    	font-size: 14pt;
		    	letter-spacing: 1px;
		    	padding-left: 10px;
		    	margin-bottom: 20px;
		    	background-color: #2C69A0;
		    	color: #FFF;
		    }
		    .gBrick .gBrick_bar2 {
		    	height: 45px;
		    	line-height: 45px;
		    	font-size: 14pt;
		    	letter-spacing: 1px;
		    	padding-left: 10px;
		    	margin-bottom: 20px;
		    	background-color: #2C69A0;
		    	color: #FFF;
		    }
		    .gBrick .gBrick_data {
		    	padding: 0 10px 10px 10px;
		    	color: #2C69A0;
		    }
		    .gBrick_data .doughnut_value {
		    	margin-top: -50%;
		    	font-size: 180%;
		    	width: 100%;
		    	height: 100%;
		    	text-align: center;
		    }
		    .gBrick_data .gBrick_help {
				font-size: 13pt;
				line-height: 20px;
		    }
		    .vBrick .brick_left {
		    	width: 40px;
		    	height: 95px;
		    	margin-top: 10px;
		    	margin-right: 10px;
		    	border-right: 2px solid #FFF;
		    	float: left;
		    }
		    .vBrick_small .brick_left {
		    	width: 25px;
		    	height: 95px;
		    	margin-top: 10px;
		    	margin-right: 10px;
		    	border-right: 2px solid #FFF;
		    	float: left;
		    }
		    .brick_title {
				font-size: 15pt;
		    }
		    .brick_subtitle {
				font-size: 10.5pt;
		    }
		    .area_title {
		    	margin-bottom: 20px;
		    }
		    .fullBrick {
		    	width: 650px;
				height: 220px;
				margin-bottom: 15px;
				box-shadow: 1px 3px 5px #BBB;
				margin-left: 10px;
		    }
		    .fullBrick_left {
		    	width: 23%;
		    	height: 100%;
		    	float: left;
		    	color: #FFF;
		    	background-color: rgba(26, 102, 162, 0.9);
		    	padding: 5px;
		    }
		    .fullBrick_right {
		    	width: 77%;
		    	height: 100%;
		    	float: left;
		    	line-height: 30px;
		    	background-color: #FFF;
		    	padding: 20px 10px;
		    }
		    .fullBrick_right .fullBrick_filename {
		    	font-size: 11pt;
				color: #777;
				margin-bottom: 10px;
		    }
		    .fullBrick_right .fullBrick_sug {
		    	font-size: 13pt;
				color: #2C69A0;
				margin-top: 0px;
				margin-bottom: 0px;
		    }
		    .gauge_brick {
		    	width: 400px;
		    	height: 380px;
		    	overflow-y: hidden;
				box-shadow: 1px 3px 5px #BBB;
				background-color: #FFF;
				margin-left: 10px;
				margin-bottom: 10px;
				font-size: 11pt;
				color: #555;
				float: left;
		    }
		   	.gauge_brick .gauge_brick_bar {
		    	width: 100%;
		    	height: 60px;
		    	line-height: 60px;
		    	font-size: 15pt;
		    	letter-spacing: 1px;
		    	padding-left: 10px;
		    	margin-bottom: 20px;
		    	margin-right: 20px;
		    	background-color: rgba(67, 113, 183, 0.9);
		    	color: #FFF;
		    }
		   	.gauge_legend_brick {
		    	width: 200px;
		    	overflow-y: hidden;
		    	margin-top: 200px;
				margin-left: 10px;
				margin-bottom: 10px;
				font-size: 11pt;
				color: #777;
				float: left;
				padding-left: 20px;
		    }
		    .jqx-chart-title-text {
		    	font-size: 16pt;
		    	fill: rgba(44, 83, 138, 0.9);
		    }
		    .clean {
		    	clear: both;
		    }
		</style>
	</head>
	<body>
		<div class="dropArea">
			<div class="content">
				<a href="/"><img width="200" class="ic_logo" src="images/ic_logo.png"></a>
				<div class="cloud_block">
					<div class="ic_cloud">
						<img width="100%" src="images/ic_cloud.png">
						<form id="upload_form" method="post" enctype="multipart/form-data" onsubmit="ajaxupload(this); return false;">
							<input id="javafile" name="javafiles[]" type="file" multiple accept=".java" onchange="$('#upload_form').submit();" hidden style="display:none;">
						</form>
					</div>
				</div>
				<div class="slogan">拖曳檔案至此馬上分析你的程式碼！</div>
				
				<div class="analysis_block">
					<nav class="menubar">
                    	<a id="bar_btn_chart" class="bar_btn" data-panel="area_chart"><img width="40" src="images/ic_barchart.png"></a>
						<!-- <a id="bar_btn_report" class="bar_btn" data-panel="area_report"><img width="40" src="images/.png"></a> -->
						<a id="bar_btn_metrics" class="bar_btn" data-panel="area_metrics"><img width="40" src="images/ic_help.png"></a>
					</nav>
					<div class="tree_area">
						<div id="treeview" class="treeview"></div>
					</div>
					<div class="result_area">
						<div id="area_chart" class="panel"></div>
						<!-- <div id="area_report" class="panel"></div> -->
						<div id="area_metrics" class="panel"></div>
					</div>
					<div class="clean"></div>
				</div>
				<div class="copyright">Codefine © 2015</div>
			</div>
			<div class="anim_mask"></div>
			<div class="anim_frame">
				<div class="anim_content">
					<div class="ic_uploadcode"><img src="images/ic_uploadcode.png"></div>
				</div>
			</div>
		</div>
	</body>
	
	<script>
		// config and vars
		var anim_counter = 0;
		var anim_width = 300;
		var anim_height = 300;
		var circle_width = 250;
		var circle_height = 250;
		var hasDropped = false;
		//var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
		//if(!is_chrome) alert("很抱歉，目前只支援Chrome瀏覽器！");
		
		// anim initialization
		function animInit() {
			$(".content").css("width", $(".dropArea").width());
			$(".content").css("height", $(".dropArea").height());
			$(".content").css("left", $(".dropArea").offset().left);
			$(".content").css("top", $(".dropArea").offset().top);
			$(".anim_mask").css("width", $(".dropArea").width());
			$(".anim_mask").css("height", $(".dropArea").height());
			$(".anim_mask").css("left", $(".dropArea").offset().left);
			$(".anim_mask").css("top", $(".dropArea").offset().top);
			$(".anim_frame").css("width", anim_width);
			$(".anim_frame").css("height", anim_height);
			$(".anim_frame").css("left", $(".dropArea").offset().left + $(".dropArea").width() / 2 - anim_width / 2);
			$(".anim_frame").css("top", $(".dropArea").offset().top + $(".dropArea").height() / 2 - anim_height / 1.5);
			$(".anim_content").css("width", $(".anim_frame").width() / 1.414);
			$(".anim_content").css("height", $(".anim_frame").height() / 1.414);
			$(".anim_content").css("margin-left", -$(".anim_content").width() / 2);
			$(".anim_content").css("margin-top", -$(".anim_content").height() / 2);
		}

		$(document).ready(function(){
			$("body").height($(window).height());
			$(".result_area").height($(window).height() * 0.7);
			$(".tree_area").height($(window).height() * 0.7);
			animInit();

			//$(".analysis_block").fadeIn();
			//$(".bar_btn").first().trigger("click");
			
			//var ans = '{"cyclomatic":{"HalsteadKeys":[{"Cyclomatic Complexity":1,"Risk Level":"Low risk program","Method Name":"public HalsteadKeys (String, HashMap<String, Integer>, HashMap<String, Integer>, int, int, int, int)"},{"Cyclomatic Complexity":1,"Risk Level":"Low risk program","Method Name":"public String getClassName ()"},{"Cyclomatic Complexity":1,"Risk Level":"Low risk program","Method Name":"public HashMap<String, Integer> getOperators ()"},{"Cyclomatic Complexity":1,"Risk Level":"Low risk program","Method Name":"public HashMap<String, Integer> getOperands ()"},{"Cyclomatic Complexity":1,"Risk Level":"Low risk program","Method Name":"public int getN1 ()"},{"Cyclomatic Complexity":1,"Risk Level":"Low risk program","Method Name":"public int getN2 ()"},{"Cyclomatic Complexity":1,"Risk Level":"Low risk program","Method Name":"public int getn1 ()"},{"Cyclomatic Complexity":1,"Risk Level":"Low risk program","Method Name":"public int getn2 ()"}],"Halstead":[{"Cyclomatic Complexity":20,"Risk Level":"Moderate risk","Method Name":"public Halstead ()"},{"Cyclomatic Complexity":4,"Risk Level":"Low risk program","Method Name":"public void getname (String)"},{"Cyclomatic Complexity":60,"Risk Level":"Most complex and highly unstable method","Method Name":"public void readLine (String)"},{"Cyclomatic Complexity":7,"Risk Level":"Low risk program","Method Name":"public JSONObject getValue ()"},{"Cyclomatic Complexity":2,"Risk Level":"Low risk program","Method Name":"public static double log2 (int)"}]}}';
			//var obj = $.parseJSON(ans);

			$(".dropArea").on('dragenter', anim_start).on('dragleave', anim_stop).on('dragover', function(event){
				event.preventDefault();
				event.stopPropagation();
			}).on('drop', function(event){
				event.preventDefault();
				event.stopPropagation();
				var files = event.originalEvent.target.files || event.originalEvent.dataTransfer.files;
				$("#javafile").prop("files", files);
				$(".dropArea").trigger("dragleave");
			});
			
			$(".ic_cloud").hover(function(){
				$(this).finish().animate({
					width: "+=20",
					height: "+=20",
					marginTop: "-=10",
					marginLeft: "-=3"
				}, 100);
			}, function(){
				$(this).finish().animate({
					width: "-=20",
					height: "-=20",
					marginTop: "+=10",
					marginLeft: "+=3"
				}, 100);
			});
			$(".ic_cloud").mousedown(function(event){
				if(event.which == 1) {
					$(this).finish().animate({
						width: "-=5",
						height: "-=5",
						marginTop: "+=2"
					}, 30);
				}
			}).mouseup(function(event){
				if(event.which == 1) {
					$(this).finish().animate({
						width: "+=5",
						height: "+=5",
						marginTop: "-=2"
					}, 30);
					$('#javafile').val("");
					$("#javafile").trigger("click");
				}
			});
		});	
		$(window).resize(function(){
			$("body").height($(window).height());
			$(".result_area").height($(window).height() * 0.7);
			$(".tree_area").height($(window).height() * 0.7);
			animInit();
		});

		//upload file by ajax
		function ajaxupload(form) {
			var deferred = $.Deferred();
			
			$(".dropArea").append('<div class="circle">' +
				'<svg version="1.1" xmlns="//www.w3.org/2000/svg" xmlns:xlink="//www.w3.org/1999/xlink" width="250" height="250">' +
					'<path class="checkmark" fill="none" stroke-width="20" d="m17,83.53182c0,0 0.68744,0.44249 1.33906,0.57446c1.45706,0.29514 9.39214,6.43057 23.43348,22.40424c16.21688,18.44859 29.35876,34.70825 38.83261,47.10632c4.28115,5.60254 4.9703,8.17516 6.02575,7.46806c2.17587,-1.45766 2.20424,-5.37236 9.37339,-17.23401c11.31656,-18.72369 26.7757,-45.95977 44.18884,-75.25523c16.73299,-28.15118 26.78111,-45.95739 31.4678,-55.72334l1.33907,-2.87234"/>' +
					'<line class="crossmark crossmark1" y2="175" x2="15" y1="15" x1="175" stroke-miterlimit="10" stroke-width="10" stroke="#2F5A99" fill="none"/> ' +
					'<line class="crossmark crossmark2" y1="15" x1="15" y2="175" x2="175" stroke-miterlimit="10" stroke-width="10" stroke="#2F5A99" fill="none"/>' +
				'</svg>' +
				'<strong>100<i>%</i></strong>' +
				'<div class="filedisplay"></div>' +
			'</div>');
			
			// circle progress init		
			$(".circle").css("width", circle_width);
			$(".circle").css("height", circle_height);
			$(".circle").css("left", $(".dropArea").offset().left + $(".dropArea").width() / 2 - circle_width / 2);
			$(".circle").css("top", $(".dropArea").offset().top + $(".dropArea").height() / 2 - circle_height / 1.5);
			
			var formData = new FormData(form);
			$.ajax({
				type: "POST",
				cache: false,
				contentType: false,
				processData: false,
				url: "uploader.php?callback=?",
				dataType: "jsonp",
				data: formData,
				success: function(res) {

					res.forEach(function(resFile, index) {

						if(Boolean(resFile["exterror"])) { 

							alert(resFile["filename"] + "上傳失敗！副檔名需為.java");
							animChecksvg(false);
							$('.circle').remove();
							hasDropped = false;

						} else if(!Boolean(resFile["success"])) {
							
							alert(resFile["filename"] + "檔案上傳失敗！請重試");
							animChecksvg(false);
							$('.circle').remove();
							hasDropped = false;
						}

						if(index == res.length - 1) {
							$(".circle").css("display", "inline-block");
							deferred.done(function() {
								$(".anim_mask").delay(600).animate({
									"opacity": 0
								}, 400);
								$(".circle").delay(500).animate({
									opacity: 0
								}, 600, function(){
									$('.circle').remove();
									hasDropped = false;
									//$("#javafile").prop("files", null);
									$("#javafile").val(null);
									
									// 跑內頁

									$(".ic_cloud").animate({
										opacity: 0,
									}, 300, function(){
										$(this).hide();
									})
									$(".slogan").animate({
										opacity: 0,
									}, 300, function(){
										$(this).hide();
										$(".analysis_block").fadeIn();
										$(".bar_btn").first().trigger("click");

										$('#treeview').treeview({
											data: getTree(res),
											showBorder: false,
											color: "#444",
											backColor: "rgb(250, 250, 250)",
											levels: 3,
											selectedBackColor: "#317ACA",
							          		expandIcon: 'glyphicon glyphicon-chevron-right',
							          		collapseIcon: 'glyphicon glyphicon-chevron-down',
							          		onNodeSelected: function(event, data) {
										    	if(!$("#bar_btn_chart").hasClass("bar_btn_active"))
										    		$("#bar_btn_chart").trigger("click");
										    	updateResult(res, data);
										    },
										});
										$(".list-group-item").first().trigger("click");
									});
								});
							});
						}
					});
				},
				error: function(xhr, status, err) {
					alert("連線失敗：" + xhr.responseText);
					$('.circle').remove();
					hasDropped = false;
				},
				xhr: function() {
			        var xhr = $.ajaxSettings.xhr();
			        xhr.upload.onprogress = function(event) {
			        	var percentComplete = (event.loaded / event.total) * 100;
						$(".circle").circleProgress({
							value: percentComplete,
							size: circle_width,
							startAngle: -Math.PI / 2,
							animation: {duration: 200, easing: "easeOutCirc"},
							fill: { gradient: ["#2F5A99", "#0681c4"], gradientAngle: 0 }
						}).on("circle-animation-progress", function(event, progress) {
							$(this).find('strong').html(parseInt(100 * progress) + "<i>%</i>");
						}).on("circle-animation-end", function(event) {
			        		$(this).find('strong').animate({
								opacity: 0
							}, 300, function(){
								animChecksvg(true);
								deferred.resolve();
							});
						});
			        };
			        // xhr.upload.onload = function() {};
			        return xhr;
			    }				
			});

			$(".filedisplay").text("");
			for(i = 0; i < $("#javafile").prop("files").length; i++) {
				$(".filedisplay").append($("#javafile").prop("files")[i]["name"] + "<br/>");
			}
		}
		
		//stretch looping
		function anim_loop(obj) {
			if(obj.hasClass("animating")) {
				obj.animate({
					width: "-=10px",
					height: "-=10px",
					marginTop: "+=5px",
					marginLeft: "+=5px"
				}, 400, function(){
					obj.animate({
						width: "+=10px",
						height: "+=10px",
						marginTop: "-=5px",
						marginLeft: "-=5px"
					}, 400, "easeOutQuad", function(){
						anim_loop(obj);
					});
				});
			}
		};
		
		//start animation when dragging over
		function anim_start() {
			anim_counter++;
			if(anim_counter === 1) {
				$(".anim_mask").finish().animate({
					"opacity": 0.4
				}, 400);
				$(".anim_frame").addClass("animating").finish().animate({
					width: anim_width + 50,
					height: anim_height + 50,
					marginTop: -25,
					marginLeft: -25
				}, {
					duration: 500,
					queue: false,
					easing: "easeOutQuad",
					complete: function(){
						anim_loop($(this));
					}
				});
				$(".anim_frame").animate({
					opacity: 1
				}, 500);
			}
		}
		
		//stop animation when dragging leave
		function anim_stop() {
			anim_counter--;
			if(anim_counter === 0) {
				if(!hasDropped) {
					$(".anim_mask").animate({
						"opacity": 0
					}, 400);
				}
				$(".anim_frame").removeClass("animating").finish().animate({
					width: anim_width - 50,
					height: anim_height - 50,
					marginTop: 25,
					marginLeft: 25
				}, {
					duration: 500,
					queue: false,
					easing: "easeOutQuad",
				});
				$(".anim_frame").animate({
					opacity: 0
				}, 500);
			}
		}
		
		//active svg anim
		function animChecksvg(isSuccess) {
			if(isSuccess) {
				$(".checkmark").css("display", "block");
			} else {
				$(".crossmark").css("display", "block");
			}
		}
	</script>
	<script src="js/result.js"></script>
</html>