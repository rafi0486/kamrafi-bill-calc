/* -----------------------------------------------------------------------------



File:           JS Core
Version:        1.0
Last change:    00/00/00 
-------------------------------------------------------------------------------- */
(function() {

	"use strict";

	var Wizard = {
		init: function() {
			this.Basic.init();  
		},

		Basic: {
			init: function() {

				this.preloader();
				this.countDown();
				
			},
			preloader: function (){
				jQuery(window).on('load', function(){
					jQuery('#preloader').fadeOut('slow',function(){jQuery(this).remove();});
				});
			},
			countDown:  function (){
				if ($('.quiz-countdown').length > 0) {

					var countdownHours = document.querySelector('.hours .count-down-number');
					var timerDiv = document.querySelector('.timer-div');
					setInterval(function () {

						quizStartTime=quizStartTime+1000;
						var distance = quizFinishTime-quizStartTime;

						if(distance>0){
							var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
							var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
							var seconds = Math.floor((distance % (1000 * 60)) / 1000);
							if (hours < 10) hours = '0' + hours;
							if (minutes < 10) minutes = '0' + minutes;
							if (seconds < 10) seconds = '0' + seconds;

							countdownHours.innerHTML = hours+":"+minutes+":"+seconds;
						}else{
							if(TIMER_PAGE=="question"){
								switch (quizTimeType){
									case "quiz":window.location=HOST_URL+"exam/quiz/confirm_submit";break;
									case "quizsingle":window.location=HOST_URL+"exam/quizsingle/confirm_submit";break;
								}

							}else{
								$("#back_to_exam").attr("disabled",true);
								timerDiv.innerHTML="";
							}
						}

					}, 1000);

				};
			},
		}
	}
	jQuery(document).ready(function (){
		Wizard.init();
	});

})();
