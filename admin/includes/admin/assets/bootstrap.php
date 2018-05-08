<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/database.inc");
	require_once(__DIR__ . "/common.php");
?>

<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="/admin/includes/admin/assets/css/libs/opentip.css">
<link rel="stylesheet" type="text/css" href="/admin/includes/admin/assets/css/main.css">

<script type="text/javascript" src="/admin/includes/admin/assets/vendor/tinymce/tinymce.js"></script>
<script type="text/javascript" src="/admin/includes/admin/assets/js/libs/opentip-jquery.min.js"></script>
<script type="text/javascript" src="/admin/includes/admin/assets/js/libs/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/admin/includes/admin/assets/js/main.js"></script>

<?php if (! empty($_POST) && 1 != 1): if (!is_action("export")): // post loading ?>
<style type='text/css'> 
body {
	background-color: #eee;
	display: flex;
	justify-content: center;
	align-items: center;
	height: 100%;
	overflow: hidden;
}
@-webkit-keyframes uilsquare {
  0% {
    background-color: #a3a8ac;
  }
  1% {
    background-color: #75aadb;
  }
  11% {
    background-color: #75aadb;
  }
  21% {
    background-color: #a3a8ac;
  }
  100% {
    background-color: #a3a8ac;
  }
}
@-webkit-keyframes uilsquare {
  0% {
    background-color: #a3a8ac;
  }
  1% {
    background-color: #75aadb;
  }
  11% {
    background-color: #75aadb;
  }
  21% {
    background-color: #a3a8ac;
  }
  100% {
    background-color: #a3a8ac;
  }
}
@-moz-keyframes uilsquare {
  0% {
    background-color: #a3a8ac;
  }
  1% {
    background-color: #75aadb;
  }
  11% {
    background-color: #75aadb;
  }
  21% {
    background-color: #a3a8ac;
  }
  100% {
    background-color: #a3a8ac;
  }
}
@-ms-keyframes uilsquare {
  0% {
    background-color: #a3a8ac;
  }
  1% {
    background-color: #75aadb;
  }
  11% {
    background-color: #75aadb;
  }
  21% {
    background-color: #a3a8ac;
  }
  100% {
    background-color: #a3a8ac;
  }
}
@-moz-keyframes uilsquare {
  0% {
    background-color: #a3a8ac;
  }
  1% {
    background-color: #75aadb;
  }
  11% {
    background-color: #75aadb;
  }
  21% {
    background-color: #a3a8ac;
  }
  100% {
    background-color: #a3a8ac;
  }
}
@-webkit-keyframes uilsquare {
  0% {
    background-color: #a3a8ac;
  }
  1% {
    background-color: #75aadb;
  }
  11% {
    background-color: #75aadb;
  }
  21% {
    background-color: #a3a8ac;
  }
  100% {
    background-color: #a3a8ac;
  }
}
@-o-keyframes uilsquare {
  0% {
    background-color: #a3a8ac;
  }
  1% {
    background-color: #75aadb;
  }
  11% {
    background-color: #75aadb;
  }
  21% {
    background-color: #a3a8ac;
  }
  100% {
    background-color: #a3a8ac;
  }
}
@keyframes uilsquare {
  0% {
    background-color: #a3a8ac;
  }
  1% {
    background-color: #75aadb;
  }
  11% {
    background-color: #75aadb;
  }
  21% {
    background-color: #a3a8ac;
  }
  100% {
    background-color: #a3a8ac;
  }
}
.uil-squares-css {
  background: none;
  position: relative;
  width: 200px;
  height: 200px;
}
.uil-squares-css div {
  position: absolute;
  z-index: 1;
  width: 40px;
  height: 40px;
  background-color: #a3a8ac;
}
.uil-squares-css div > div {
  position: absolute;
  top: 0;
  left: 0;
  -ms-animation: uilsquare 0.6s linear infinite;
  -moz-animation: uilsquare 0.6s linear infinite;
  -webkit-animation: uilsquare 0.6s linear infinite;
  -o-animation: uilsquare 0.6s linear infinite;
  animation: uilsquare 0.6s linear infinite;
  width: 40px;
  height: 40px;
}
.uil-squares-css > div:nth-of-type(1) {
  top: 30px;
  left: 30px;
}
.uil-squares-css > div:nth-of-type(1) > div {
  -ms-animation-delay: 0s;
  -moz-animation-delay: 0s;
  -webkit-animation-delay: 0s;
  -o-animation-delay: 0s;
  animation-delay: 0s;
}
.uil-squares-css > div:nth-of-type(2) {
  top: 30px;
  left: 80px;
}
.uil-squares-css > div:nth-of-type(2) > div {
  -ms-animation-delay: 0.075s;
  -moz-animation-delay: 0.075s;
  -webkit-animation-delay: 0.075s;
  -o-animation-delay: 0.075s;
  animation-delay: 0.075s;
}
.uil-squares-css > div:nth-of-type(3) {
  top: 30px;
  left: 130px;
}
.uil-squares-css > div:nth-of-type(3) > div {
  -ms-animation-delay: 0.15s;
  -moz-animation-delay: 0.15s;
  -webkit-animation-delay: 0.15s;
  -o-animation-delay: 0.15s;
  animation-delay: 0.15s;
}
.uil-squares-css > div:nth-of-type(4) {
  top: 80px;
  left: 130px;
}
.uil-squares-css > div:nth-of-type(4) > div {
  -ms-animation-delay: 0.22499999999999998s;
  -moz-animation-delay: 0.22499999999999998s;
  -webkit-animation-delay: 0.22499999999999998s;
  -o-animation-delay: 0.22499999999999998s;
  animation-delay: 0.22499999999999998s;
}
.uil-squares-css > div:nth-of-type(5) {
  top: 130px;
  left: 130px;
}
.uil-squares-css > div:nth-of-type(5) > div {
  -ms-animation-delay: 0.3s;
  -moz-animation-delay: 0.3s;
  -webkit-animation-delay: 0.3s;
  -o-animation-delay: 0.3s;
  animation-delay: 0.3s;
}
.uil-squares-css > div:nth-of-type(6) {
  top: 130px;
  left: 80px;
}
.uil-squares-css > div:nth-of-type(6) > div {
  -ms-animation-delay: 0.375s;
  -moz-animation-delay: 0.375s;
  -webkit-animation-delay: 0.375s;
  -o-animation-delay: 0.375s;
  animation-delay: 0.375s;
}
.uil-squares-css > div:nth-of-type(7) {
  top: 130px;
  left: 30px;
}
.uil-squares-css > div:nth-of-type(7) > div {
  -ms-animation-delay: 0.44999999999999996s;
  -moz-animation-delay: 0.44999999999999996s;
  -webkit-animation-delay: 0.44999999999999996s;
  -o-animation-delay: 0.44999999999999996s;
  animation-delay: 0.44999999999999996s;
}
.uil-squares-css > div:nth-of-type(8) {
  top: 80px;
  left: 30px;
}
.uil-squares-css > div:nth-of-type(8) > div {
  -ms-animation-delay: 0.525s;
  -moz-animation-delay: 0.525s;
  -webkit-animation-delay: 0.525s;
  -o-animation-delay: 0.525s;
  animation-delay: 0.525s;
}
 </style> <body><div class='uil-squares-css' style='transform:scale(0.64);'><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div></div></body>
<?php endif; endif; ?>