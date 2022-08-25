<select class="quizzo_select" name="quizzo_answer">
	<?php foreach ( $answers as $key => $value ) : ?>
		<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $quiz_answer, esc_attr( $key ) ); ?>>
			<?php echo esc_html( $value ); ?>
		</option>
	<?php endforeach; ?>
</select>