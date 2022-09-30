<?php

// Get Question info
$question_counter = $_SESSION['question_counter'] ?: 0;
$question_id      = $_SESSION['questions_ids'][$question_counter];
$question_options = array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D');

// Get User info
$current_user = wp_get_current_user();
$user_name    = $current_user->display_name ?: $current_user->first_name;
$user_email   = $current_user->user_email;

?>

<section class="quizzo_shortcode" id="<?php echo $question_id; ?>">
	<div>
		<div id="user">
			<p>
				<?php echo esc_html( get_the_title( $_SESSION['quiz_id'] ) ); ?><!--<br/>
				<?php echo esc_html( $user_name ); ?> @ <?php echo date("D j F, Y O T"); ?><br/>
				(<?php echo esc_html( $user_email ); ?>)-->
			</p>
		</div>

		<?php if ( $_SESSION['question_counter'] < count( $_SESSION['questions_ids'] ) ) : ?>

		<!--<div id="timer">20s</div>-->

		<div id="question">
			<p class="question_content"><span class="counter"><?php print $question_counter+1 ?>.</span><?php echo esc_html( get_the_title( $question_id ) ); ?></p>
			<ol>
				<?php foreach ( $question_options as $key => $value ) : ?>
				<li>
					<input type="radio" name="user_answer_<?php echo $question_id; ?>" value="<?php echo $key; ?>">
					<p><span><?php echo ucwords( esc_html( $value ) ); ?>.</span><?php echo esc_html( get_post_meta( $question_id, 'quizzo_option_' . $key, true ) ); ?></p>
				</li>
				<?php endforeach; ?>
			</ol>
			<span id="overlay"></span>
		</div>
		<div id="status"></div>
		<button type="button" id="answer">Check My Answer</button>

		<?php else: ?>

		<h2>Quiz Completed!<br/>Your total score is
			<span id="score"><?php echo esc_html( $_SESSION['percentage'] ?: 0 ); ?></span>%.
		</h2>
		<a href="<?php echo home_url(); ?>">Close Quiz Window</a>
		<?php
			// Clean up Session variables
			$_SESSION['quiz_id']          = '';
			$_SESSION['questions_ids']    = '';
			$_SESSION['question_counter'] = '';
			$_SESSION['percentage'] = 0;
		?>

		<?php endif; ?>
	</div>
</section>
