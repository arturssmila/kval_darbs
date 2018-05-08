// leanModal v1.1 by Ray Stone - http://finelysliced.com.au
// Dual licensed under the MIT and GPL

(function($){$.fn.extend({leanModal:function(options){var defaults={top:100,overlay:0.5,closeButton:null};var overlay=$("<div id='lean_overlay'></div>");$("body").append(overlay);options=$.extend(defaults,options);return this.each(function(){var o=options;$(this).click(function(e){var modal_id=$(this).attr("href");$("#lean_overlay").click(function(){close_modal(modal_id)});$(o.closeButton).click(function(){close_modal(modal_id)});var modal_height=$(modal_id).outerHeight();var modal_width=$(modal_id).outerWidth();
$("#lean_overlay").css({"display":"block",opacity:0});$("#lean_overlay").fadeTo(200,o.overlay);$(modal_id).css({"display":"block","position":"fixed","opacity":0,"z-index":11000,"left":50+"%","margin-left":-(modal_width/2)+"px","top":o.top+"px"});$(modal_id).fadeTo(200,1);e.preventDefault()})});function close_modal(modal_id){$("#lean_overlay").fadeOut(200);$(modal_id).css({"display":"none"})}}})})(jQuery);

$(document).ready(function() {
	$("body").on("click", ".modal_trigger", function(event) {
		event.preventDefault();

		var target = $(this).attr("href");

		if (target.length == 0) {
			target = $(this).data("target");
		} else {
			$(this).data("target", target);
			$(this).attr("href", "");
		}

		location.hash = target;

		if (target.length > 0) {
			$("body").addClass("modal_active");
			$(target).css({"top": $(window).scrollTop() + "px"});
			$(target).fadeIn();
		}

		$(target).find("input, textarea").each(function( index ) {
			if ($(this).val().length > 0) {
				$(this).addClass("active");
			}
		});
	});

    $(".modal, .modal > .container, .modal .modal_cell, .modal .modal_center_block, .modal .close").click(function(event){
			//event.preventDefault();
		if (event.target == this) {
			if ($(this).hasClass("modal")) {
				$(this).fadeOut("fast");
			} else {
				$(this).closest(".modal").fadeOut("fast");
			}

			history.pushState('', document.title, window.location.pathname);

			if ($("#youtube_iframe").length > 0) {
				$("#youtube_iframe")[0].contentWindow.postMessage('{"event":"command","func":"' + "pauseVideo" + '","args":""}', '*');
			}

			$("body").removeClass("modal_active");
   		}
    });
});

/* - CSS ----

.modal {
    position: fixed;
    z-index: 100;
    left: 0px;
    top: 0px;
    height: 100%;
    width: 100%;
    background: rgba(0,0,0,0.4);
    display: none;
}

.modal > .container {
	height: 100%;
	display: -webkit-flexbox;
	display: -ms-flexbox;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-align: center;
	-ms-flex-align: center;
	-webkit-align-items: center;
	align-items: center;
}

.modal .closer {
	display: block;
	position: absolute;
	width: 100%;
	height: 100%;
	top: 0;
	bottom: 0;
	right: 0;
	top: 0;
	cursor: default;
}

.modal .modal_close {
	display: block;
	width: 16px;
	height: 16px;
	position: absolute;
	background-image: url("svg/close.svg");
	z-index: 100;
	right: -16px;
	top: -16px;
}

.modal .title {
	font-size: 1.250em;
	padding-bottom: 34px;
}

.modal .modal_block {
	background-color: white;
	padding-bottom: 68px;
	padding-top: 116px;
	top: 5%;
	max-height: 90%;
	position: relative;
	overflow: auto;
	margin-top: -116px;
}

.modal .modal_block:before {
	width: 124px;
	height: 82px;
	background-image: url("svg/logo.svg");
	background-repeat: no-repeat;
	background-size: contain;
	top: 22px;
	left: 0;
	right: 0;
	margin: auto;
	content: "";
	position: absolute;
}

.modal_block .contents {
	padding: 0 26px;
	padding-bottom: 20px;
	color: black;
}

*/

/* - HTML ----
	<a href="#reset_password" class="modal_trigger">modal_trigger</a>

	<div id="reset_password" class="modal">
		<div class="container">
			<div class="four columns offset-by-four">
				<span class="close">&#x2716;</span>

				<div class="modal_block">
					<div class="contents">
						<h2 class="title">{$attr.reset_modal.name}</h2>
						<span class="subtitle">{$attr.reset_modal.teaser}</span>

						<form class="contents">
							<input type="text" name="email" placeholder="{$lg.email}">

							<div class="center">
								<a href="javascript:void(0)" id="recover_password_button" class="button">{$lg.send}</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
*/