<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Codefine</title>
		
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/result.css" />
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-treeview.min.css" />
		<link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" />

		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/circle-progress.js"></script>
		<script src="js/bootstrap-treeview.min.js"></script>
    	<script src="jqwidgets/jqxcore.js"></script>
    	<script src="jqwidgets/jqxdraw.js"></script>
    	<script src="jqwidgets/jqxgauge.js"></script>

    	<style type="text/css">
	        .gaugeValue {
		        padding: 10px;
		        position: absolute;
		        top: 230px;
		        left: 129px;
		        text-align: center;
		        font-size: 16pt;
		        width: 90px;
		    }
		    .green_block {
		    	width: 30px;
		    	height: 30px;
		    	background-color: rgb(75,182,72);
		    }
		    .yellow_block {
		    	width: 30px;
		    	height: 30px;
		    	background-color: rgb(251,209,9);
		    }
		    .orange_block {
		    	width: 30px;
		    	height: 30px;
		    	background-color: rgb(255,188,0);
		    }
		    .red_block {
		    	width: 30px;
		    	height: 30px;
		    	background-color: rgb(224,38,31);
		    }
		    .gaugeFrame {
		    	position: relative;
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
						<!-- <a id="bar_btn_report" class="bar_btn" data-panel="area_report"><img width="40" src="images/ic_doc.png"></a>-->
						<a id="bar_btn_metrics" class="bar_btn" data-panel="area_metrics"><img width="40" src="images/ic_help.png"></a>
					</nav>
					<div class="tree_area">
						<div id="treeview" class="treeview"></div>
					</div>
					<div class="result_area">
						<div id="area_chart" class="panel">
							
						</div>
						<!--<div id="area_report" class="panel">
							<p class="panel_title">分析報告</p>
							<p class="panel_subtitle">Analysis Report</p>
							<h3>建置中</h3>
						</div>-->
						<div id="area_metrics" class="panel">
							<p class="panel_title">度量指標</p>
							<p class="panel_subtitle">Metrics</p>
							<div>
								<h4>程式碼行數(Source Lines of Code)</h4>
								<p><br/>簡稱SLOC又稱LOC。此軟體度量藉由計算程式碼的行數來衡量電腦程式的大小。當一個程式被要求開發時，SLOC常用於預測其工作量；而程式開始生產時將會拿來測量其生產量及維護性。</p>
								<p>以下片段程式碼為例：</p>
								<p>
									從以上程式碼將測出<br/>
									1 Physical Line of Code (LOC)<br/>
									2 Logical Lines of Code (LLOC)  (for statement and printf statement)<br/>
									1 Comment Line<br/><br/>
								</p>
								<h4>註解密度(Density of Comments)</h4>
								<p>輔以註解的說明可以讓別人對於程式的內容更有效的了解。程式註解密度(DC)為註解行數(CLOC)和全部行數(LOC)之比率，因此，註解密度DC = CLOC / LOC。註解密度的值介於0～1之間，可將此列為品質的指標，密度越接近1代表程式碼品質越好。</p>
								<p>以下片段程式碼為例：</p>
								<p>
									以上程式碼LOC為12；CLOC(綠色字)為 4<br/>
									DC = 4 / 12 ≒ 0.33<br/><br/>
								</p>

								<h4>霍爾斯特德複雜度(Halstead Complexity)</h4>
								<p>霍爾斯特德的目標是識別軟體中可量測的性質以及各性質間的關係。</p>
								<p>
									n1 = the number of distinct operators (不同運算子的個數)<br/>
									n2 = the number of distinct operands (不同運算元的個數)<br/>
									N1 = the total number of operators (所有運算子合計出現的次數)<br/>
									N2 = the total number of operands (所有運算元合計出現的次數)<br/>
									* 上述的運算子包括傳統的運算子及保留字；運算元包括變數及常數<br/><br/>
									依上述數值，可以計算以下的量測量：<br/><br/>
									程式詞彙數（Program vocabulary）：n = n 1 + n 2<br/>
									程式長度（Program length）：N = N 1 + N 2<br/>
									計算程式長度（Calculated program length）： = n 1 log2 n 1 + n 2 log2 n 2<br/>
									容量（Volume）：V = N × log2 n<br/>
									難度（Difficulty）：D = n1 / 2 x N2 / n2<br/>
									精力（Effort）：E = D × V<br/>
									程式撰寫時間：T = E / 18<br/><br/>
								</p>
								<h4>循環複雜度(Cyclomatic Complexity)</h4>
								<p>又稱為迴圈複雜度或圈複雜度，主要是用來描述一個程式「條件分支」的複雜度，因為愈單純的 If-condition 愈容易讀懂，除錯時也較好發現問題，所以複雜度的數值，愈低愈好。因此當程式碼遇到以下保留字時，複雜度的值都會加一：「if、for、while、case、default、continue、&&、||、&、|」</p>
							</div>
						</div>
					</div>
					<div style="clear:both"></div>
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

		function getTree(res) {
			var nodes = [];
			
			res.forEach(function(f, i) {
				
				var node = {"text": f["filename"], "i": i, "level": "1", "icon": "glyphicon glyphicon-file"};
				var nodes_ii = [];
				
				$.parseJSON(f["result"])["cyclomatic"].forEach(function(cls, ii) {
					
					var node_ii = {"text": cls["class_name"], "i": i, "ii": ii, "level": "2", "icon": "glyphicon glyphicon-copyright-mark"};
					var nodes_iii = [];

					cls["values"].forEach(function(m, iii) {
						var node_iii = {"text": m["method_name"], "i": i, "ii": ii, "iii": iii,"level": "3", "icon": "glyphicon glyphicon-th-list"};
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
			if(data.level == 2) {

			} else if(data.level == 3) {
				$("#area_chart").append('<p class="panel_title">圖表分析</p><p class="panel_subtitle">Analysis Chart</p>');
      			$("#area_chart").append('<div class="gaugeFrame"><div id="gaugeContainer"></div><div class="gaugeValue"></div></div>');
				$("#area_chart").append('<div><h4>循環複雜度分級</h4><p><div class="green_block"></div>低風險</p><p><div class="yellow_block"></div>適當風險</p><p><div class="orange_block"></div>高風險</p><p><div class="red_block"></div>極度不穩定</p></div>');
			    $('#gaugeContainer').jqxGauge({
			        value: 0,
			        max: 60,
			        ranges: [{ startValue: 0, endValue: 10, style: { fill: '#4bb648', stroke: '#4bb648' }, endWidth: 5, startWidth: 1 },
			                 { startValue: 10, endValue: 20, style: { fill: '#fbd109', stroke: '#fbd109' }, endWidth: 10, startWidth: 5 },
			                 { startValue: 20, endValue: 50, style: { fill: '#ff8000', stroke: '#ff8000' }, endWidth: 13, startWidth: 10 },
			                 { startValue: 50, endValue: 60, style: { fill: '#e02629', stroke: '#e02629' }, endWidth: 16, startWidth: 13 }],
			        ticksMinor: { interval: 5, size: '5%' },
			        ticksMajor: { interval: 10, size: '8%' },
			        caption: { offset: [0, -30], value: '循環複雜度', position: 'bottom' },
			        style: { stroke: '#FFF', 'stroke-width': '0px', fill: '#FFF' },
			        border: { visible: false },
			        labels: { interval: 10 },

			        easing: "easeOutBack",
			        colorScheme: 'scheme06',
			        animationDuration: 1000
			    });
				
				var cc = $.parseJSON(res[data.i]["result"])["cyclomatic"][data.ii]["values"][data.iii]["cc"];
			    $('#gaugeContainer').jqxGauge('value', cc);
			    $(".gaugeValue").html(cc);
			}
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
				//if (file.type.indexOf("image") == 0 && file.size < 300000) {
				//for (var i = 0, file; file = files[i]; i++) {
					//alert(file.name);
				//}	
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
							
							alert(resFile["filename"] + "檔案上傳失敗！請重試：" + resFile["success"]);
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
									//$(".analysis_block").css("display", "block");

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
											levels: 3,
											selectedBackColor: "#317ACA",
							          		expandIcon: 'glyphicon glyphicon-chevron-right',
							          		collapseIcon: 'glyphicon glyphicon-chevron-down',
							          		onNodeSelected: function(event, data) {
							          			$("#area_chart").html("");
										    	updateResult(res, data);
										    },
										});
									})
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