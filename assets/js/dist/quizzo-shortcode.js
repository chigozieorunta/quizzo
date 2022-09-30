jQuery(document).ready(function ($) {
	// User answered question
	$('.quizzo_shortcode #answer').click(function () {
		// Go to next question if button has changed
		if ($(this).text() == 'Continue') {
			location.reload(); return;
		}

		// Pause the timer
		/*$('.quizzo_shortcode #timer').attr('id', '');*/

		// Get answerID
		let questionID = $('.quizzo_shortcode').attr('id');
		let answerID = $('.quizzo_shortcode input[type="radio"]:checked').val();

		// Perform AJAX operation...
		$.ajax({
			type: 'post',
			dataType: 'json',
			url: '/wp-admin/admin-ajax.php',
			data: {
				action: 'save_user_answer',
				question_id: questionID,
				answer_id: answerID
			},
			success: function (msg) {
				console.log(msg.total);

				// Display feedback
				$('.quizzo_shortcode #status').slideDown('fast');

				// Disable question
				$('.quizzo_shortcode #overlay').fadeIn('fast');

				// Change button
				$('.quizzo_shortcode #answer').text('Continue');

				// Grab correct answer
				let answer = {1: 'A', 2: 'B', 3: 'C', 4: 'D'}

				// Display message
				if (parseInt(msg.status)) {
					$('.quizzo_shortcode #status').html('<span class="dashicons dashicons-yes"></span>That\'s correct!. ');
					$('.quizzo_shortcode #status').css({'background-color': 'rgb(51, 153, 69)', 'color': '#ffffff'});
				} else {
					$('.quizzo_shortcode #status').html('<span class="dashicons dashicons-no-alt"></span>The correct answer is ' + answer[msg.answer]);
					$('.quizzo_shortcode #status').css({
						'background-color': 'rgb(252, 228, 228)',
						'color': '#9f241c',
					});
				}
			}
		});

	})
	// Start Timer
	/*let counter = 20;
	setInterval(function () {
		// Reduce counter and change time
		counter = counter ? counter : 60; counter--;
		$('.quizzo_shortcode #timer').text(counter + 's');

		// End question session on 0s
		if (!counter) $('.quizzo_shortcode #answer').trigger('click');
	}, 1000);*/
})

