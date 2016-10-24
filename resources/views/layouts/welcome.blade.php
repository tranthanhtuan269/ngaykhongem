<!DOCTYPE html>
<html>
	<head>
		<title>chodatso.com</title>
		<style type="text/css">
			html{
			    min-height:100%;/* make sure it is at least as tall as the viewport */
			    position:relative;
			}
			body{
			    height:100%; /* force the BODY element to match the height of the HTML element */
			    background-image:url('../../../images/wooden_houses_lakes_mountains.jpg');
				background-repeat:no-repeat;
				background-position:center;
				background-size: 100%;
			}
			.welcome-panel{
				position:absolute;
			    top:0;
			    bottom:0;
			    right:0;
			    overflow:hidden;
			}
			.left-panel{
			    left:0;
			    background-color: #ccc;
			}

			.right-panel{
			    left:50%;
			    background-color: #ccc;
			}

			.alpha30 {
			    /* Fallback for web browsers that don't support RGBa */
			    background-color: rgb(0, 0, 0);
			    /* RGBa with 0.25 opacity */
			    background-color: rgba(0, 0, 0, 0.25);
			    /* For IE 5.5 - 7*/
			    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
			    /* For IE 8*/
			    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
			}
			.nn{
				position: absolute;
				top: 40%;
				font-size: 36px;
				color: #fff;
				border: 1px solid;
			    border-radius: 4px;
			    padding: 6px;
			    cursor: context-menu;
			}
			.nb{
				right: 60%;
			}
			.sp{
			    position: absolute;
			    top: 50%;
			    font-size: 28px;
			    color: #fff;
			    border: 1px solid;
			    border-radius: 4px;
			    padding: 5px;
			    cursor: pointer;
			}
			.nb-sp1{
				right: 68%;
			}
			.nb-sp2{
				right: 52%;
			}
			.nm{
				left: 18%;
			}
			.nm-sp1{
				left: 4%;
			}
			.nm-sp2{
				left: 32%;
			}
			.sp a{
				text-decoration: none;
				color: #fff;
			}
		</style>
	</head>
	<body>
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                ga('create', 'UA-86220808-1', 'auto');
                ga('send', 'pageview');

              </script>
            <div class="welcome-panel left-panel alpha30">
                    <div class="nn nb">Muốn bán</div>
                    <div class="sp nb-sp1"><a href="{{URL::to('/')}}/tinbds/create">Đăng bán nhà</a></div>
                    <div class="sp nb-sp2"><a href="{{URL::to('/')}}/timnguoimua">Tìm người mua</a></div>
            </div>
            <div class="welcome-panel right-panel alpha30">
                    <div class="nn nm">Muốn mua</div>
                    <div class="sp nm-sp1"><a href="{{URL::to('/')}}/yeucaunha/create">Đăng nhu cầu</a></div>
                    <div class="sp nm-sp2"><a href="{{URL::to('/')}}/timnhaban">Tìm nhà bán</a></div>
            </div>
	</body>
</html>