<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Codefine</title>
		<link rel="stylesheet" href="css/style.css" />
		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<script src="js/circle-progress.js"></script>
	</head>
	<body>
		<div class="dropArea">
			<div class="content">
				<a href="index.html"><img width="200" class="ic_logo" src="images/ic_logo.png"></a>
				<div class="cloud_block">
					<div class="ic_cloud">
						<img width="100%" src="images/ic_cloud.png">
						<form id="upload_form" method="post" enctype="multipart/form-data" onsubmit="ajaxupload(this); return false;">
							<input id="javafile" name="javafiles[]" type="file" multiple accept=".java" onchange="$('#upload_form').submit();" hidden>
						</form>
					</div>
				</div>
				<div class="slogan">點擊或拖曳至此就能立即分析！</div>
				
				<div class="analysis_block">
					<!-- chart -->
					<article id="chart" class="panel">
						<header>
							<h2>圖表分析</h2> 
							<p>Chart Analysis</p>
						</header>
						<p>...</p>
					</article>

					<!-- report -->
					<article id="report" class="panel">
						<header>
							<h2>數據分析</h2>
							<p>Code Analysis</p>
						</header>
						<p>...</p>								
					</article>
						
					<!-- diagram -->
					<article id="diagram" class="panel">
						<header>
							<h2>類別圖</h2>
							<p>Class Diagram</p>
						</header>
						<p>...</p>
					</article>

					<!-- help -->
					<article id="help" class="panel">
						<header>
							<h2>如何定義</h2>
							<p>How to Define</p>
						</header>
					</article>
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
		var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
		if(!is_chrome) alert("很抱歉，目前只支援Chrome瀏覽器！");
		
		//anim initialization
		function animInit() {
			//$(".content").css("width", $(".dropArea").width());
			//$(".content").css("height", $(".dropArea").height());
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
			animInit();
			
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
			animInit();	
		});

		//upload file by ajax
		function ajaxupload(form) {
			var deferred = $.Deferred();
			
			$(".dropArea").append('<div class="circle">' +
				'<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="250" height="250">' +
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
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'http://hinx-codefine.daoapp.io/uploader.php', true);
			//xhr.open('POST', 'http://192.168.99.100/uploader.php', true);
			xhr.setRequestHeader('Cache-Control', 'no-cache');
			xhr.onload = function() {
				if(xhr.status === 200) {
					var res = JSON.parse(xhr.responseText);
					
					if(Boolean(res[0]["exterror"])) { 
						alert("上傳失敗！副檔名需為.java");
						
					} else if (Boolean(res[0]["success"])) { //先暫時只測第一個檔案，之後再加
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
								//跑內頁
								


								//$(".analysis_block").css("display", "block");
								$(".analysis_block").fadeIn();
								
								$(".ic_cloud").animate({
									opacity: 0,
								}, 300, function(){
									$(this).hide();
								})
								$(".slogan").animate({
									opacity: 0,
								}, 300, function(){
									$(this).hide();
								})
							});
						});
					} else { // success == false
						alert("檔案上傳失敗！請重試");
						animChecksvg(false);
						$('.circle').remove();
						hasDropped = false;
					}
				} else {
					alert("檔案上傳失敗：" + xhr.status);
					$('.circle').remove();
					hasDropped = false;
				}
			}
			xhr.onprogress = function(event) {
				if(event.lengthComputable) {
					var percentComplete = (event.loaded / event.total) * 100;
					$(".circle").circleProgress({
						value: percentComplete,
						size: circle_width,
						startAngle: -Math.PI / 2,
						fill: { gradient: ["#2F5A99", "#0681c4"], gradientAngle: 0 }
					}).on("circle-animation-progress", function(event, progress) {
						$(this).find('strong').html(parseInt(100 * progress) + "<i>%</i>");
					}).on("circle-animation-end", function(event) {						
						$(this).find('strong').animate({
							opacity: 0
						}, 500);
						animChecksvg(true);
						deferred.resolve();
					});
				}
			}
			xhr.onerror = function(event) {
				alert("無法連接伺服器！");
			}
			xhr.send(formData);
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
    
</html>