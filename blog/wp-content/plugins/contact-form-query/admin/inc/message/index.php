<?php
defined( 'ABSPATH' ) || die();

global $wpdb;

$current_page = 1;
require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/message/query.php';
?>

<div class="wrap stcfq stcfq-list-view">
	<?php require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/partials/pro.php'; ?>

	<table class="stcfq-table">
		<caption>
			<div class="stcfq-table-heading"><?php esc_html_e( 'Contact Form Messages', 'contact-form-query' ); ?></div>
			<div class="stcfq-table-filter">
				<?php require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/message/filter.php'; ?>
			</div>
			<div class="stcfq-align-left">
				<div class="stcfq-bulk-action">
					<select name="bulk_action" class="stcfq-bulk-select">
						<option value=""><?php esc_html_e( 'Select Action', 'contact-form-query' ); ?></option>
						<option value="delete" data-message-confirm="<?php esc_attr_e( 'Are you sure to delete selected messages?', 'contact-form-query' ); ?>" data-message-select="<?php esc_attr_e( 'Please select atleast one message.', 'contact-form-query' ); ?>"><?php esc_html_e( 'Delete Selected', 'contact-form-query' ); ?></option>
					</select>
					<button type="button" class="button stcfq-bulk-apply" data-action-select="<?php esc_attr_e( 'Please select a bulk action.', 'contact-form-query' ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'bulk-action' ) ); ?>">
						<?php esc_html_e( 'Bulk Apply', 'contact-form-query' ); ?>
					</button>
				</div>
			</div>
		</caption>
		<thead>
			<tr>
				<th scope="col">
					<input type="checkbox" name="select_all" id="stcfq-select-all" value="1">
					<label for="stcfq-select-all" class="stcfq-thead-label"><?php esc_html_e( 'Bulk Select', 'contact-form-query' ); ?></label>
				</th>
				<th scope="col"><?php esc_html_e( 'S.No', 'contact-form-query' ); ?></th>
				<th scope="col"><?php esc_html_e( 'Subject', 'contact-form-query' ); ?></th>
				<th scope="col"><?php esc_html_e( 'Message', 'contact-form-query' ); ?></th>
				<th scope="col"><?php esc_html_e( 'Name', 'contact-form-query' ); ?></th>
				<th scope="col"><?php esc_html_e( 'Email', 'contact-form-query' ); ?></th>
				<th scope="col"><?php esc_html_e( 'Answered', 'contact-form-query' ); ?></th>
				<th scope="col"><?php esc_html_e( 'Timestamp', 'contact-form-query' ); ?></th>
				<th scope="col"><?php esc_html_e( 'Action', 'contact-form-query' ); ?></th>
			</tr>
		</thead>
		<tbody class="stcfq-table-body">
			<?php require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/message/load.php'; ?>
		</tbody>
	</table>
</div>

<?php ob_start(); ?>
(function($) {
	'use strict';
	var cpage = 2;
	var lastPage = false;
	$(document).ready(function() {
		$(window).on('scroll', function() {
			if($(window).scrollTop() + $(window).height() > $(document).height() - 1) {
				var data = {
					'action': 'stcfq-load-more-messages',
					'cpage': cpage,
					'security': '<?php echo esc_attr( wp_create_nonce( 'paginate-messages' ) ); ?>'
				};

				<?php if ( $filter_items_count ) { ?>
					data.search_key = [];
					data.search_value = [];
					<?php foreach ( $search_key as $key => $value ) { ?>
						data.search_key[<?php echo esc_attr( $key ); ?>] = '<?php echo esc_attr( $value ); ?>';
						data.search_value[<?php echo esc_attr( $key ); ?>] = '<?php echo esc_attr( $_POST['search_value'][ $key ] ); ?>';
					<?php } ?>
				<?php } ?>

				$.post('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', data, function(response) {
					if($.trim(response) != '') {
						$('.stcfq-table-body').append(response);
						cpage++;
					} else {
						$(window).unbind('scroll');
						if(!lastPage) {
							$('.stcfq-table-body').append('' +
							'<tr class="stcfq-no-more-records-row">' +
								'<td colspan="9">' +
									'<div class="stcfq-no-more-records">' +
										'<?php echo esc_html__( 'No more messages.', 'contact-form-query' ); ?>' +
									'</div>' +
								'</td>' +
							'</tr>' +
							'');
							lastPage = true;
						}
					}
				});
			}
		});
	});
})(jQuery);
<?php
$js = ob_get_clean();
wp_add_inline_script( 'stcfq-admin', $js );
