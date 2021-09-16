<?php
$url = add_query_arg(
	array(
		'page'   => 'biodrop-portal',
		'action' => 'new',
	),
	admin_url( 'admin.php' )
);
?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php esc_html_e( 'Sponsor Protocol', 'sponsor-protocol' ); ?></h1>
	<a class="page-title-action" href="<?php echo esc_url_raw( $url ); ?>"><?php echo esc_html__( 'Add new', 'sponsor-protocol' ); ?></a>
    <?php if ( isset( $_GET['updated'] ) ) { ?>
        <div class="notice notice-success"><p>Protocol has been updated successfully. </p></div>
	<?php } ?>

	<form action="" method="POST">
		<table class="form-table">
			<tbody>
				<tr class="row<?php echo $this->has_error( 'name' ) ? ' form-invalid' : ''; ?>">
					<th scope="row">
						<label for="name"><?php esc_html_e( 'Name', 'sponsor-protocol' ); ?></label>
					</th>
					<td>
						<input type="text" name="name" id="name" class="regular-text form-required" value="<?php echo esc_attr( $protocol->name ); ?>">

						<?php if ( $this->has_error( 'name' ) ) : ?>
							<p class="description error"><?php echo $this->get_error( 'name' ); ?></p>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="address"><?php esc_html_e( 'Address', 'sponsor-protocol' ); ?></label>
					</th>
					<td>
						<textarea name="address" id="address" class="regular-text"><?php echo esc_textarea( $protocol->address ); ?></textarea>
					</td>
				</tr>
				<tr class="row<?php echo $this->has_error( 'phone' ) ? ' form-invalid' : ''; ?>">
					<th scope="row">
						<label for="phone"><?php esc_html_e( 'Phone', 'sponsor-protocol' ); ?></label>
					</th>
					<td>
						<input type="text" name="phone" id="phone" class="regular-text form-required" value="<?php echo esc_attr( $protocol->phone ); ?>">
						<?php if ( $this->has_error( 'phone' ) ) : ?>
							<p class="description error"><?php echo $this->get_error( 'phone' ); ?></p>
						<?php endif; ?>
					</td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="id" value="<?php echo esc_attr( $protocol->id ); ?>">
		<?php wp_nonce_field( 'new-protocol' ); ?>
		<?php submit_button( __( 'Update Protocol', 'sponsor-protocol' ), 'primary', 'submit_protocol' ); ?>
	</form>
</div>
