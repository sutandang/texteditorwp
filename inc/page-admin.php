<?php
add_action( 'admin_menu', 'tonjoo_editor_options_page' );
function tonjoo_editor_options_page() 
{		
	add_options_page( 
		__("Tonjoo Text Editor",TONJOO_TEXT_EDITOR), 
		'Tonjoo Text Editor', 
		'moderate_comments', 
		'tonjoo_tte', 
		'tonjoo_tte_options_do_page' );
}
function tonjoo_tte_options_do_page() 
{
	?>
	<div class="wrap">
		<h2>Tonjoo Text Editor</h2>	
		<?php
		if($_POST){
			if(!is_numeric($_POST['maks_file_size']))
			{
				echo '<div class="error">
		            	 <p>Max File Size must integer value</p>
		      	</div>';
			}elseif ((file_upload_max_size() / 1000000) < $_POST['maks_file_size']) {
				echo '<div class="error">
		            	 <p>Max file size is '.(file_upload_max_size() / 1000000).' Mb</p>
		      	</div>';
			}else{
				$data = array(	'extensions_allowed' => htmlspecialchars($_POST['extensions_allowed']),	
							'maks_file_size' => htmlspecialchars($_POST['maks_file_size'])
						);
				$option = get_option( 'tj_text_editor_option' );
				if($option)
				{
					update_option( 'tj_text_editor_option', $data );
				}else{
					
					add_option( 'tj_text_editor_option', $data );
				}
				echo '<div class="updated">
		            	 <p>Setting saved</p>
		      	</div>';
			}
			
		}
		$option = get_option( 'tj_text_editor_option' );
		?>
		<form action="" method="post">	
			<table class="form-table">
				<tr>
					<th>Extensions Allowed</th>
					<td><input type="text" value="<?php echo $option['extensions_allowed'] ? $option['extensions_allowed'] : 'image'?>" placeholder="Extensions Allowed" name="extensions_allowed"></td>
				</tr>
				<tr>
					<th>Max File Size</th>
					<td><input type="text" value="<?php echo $option['maks_file_size'] ? $option['maks_file_size'] : (file_upload_max_size() / 1000000)?>" name="maks_file_size" placeholder="Max File Size"> &nbsp;Mb</td>
				</tr>
				<tr>
					<th colspan="2">
						<button type="submit" class="button button-primary">Save</button>
					</th>
				</tr>
			</table>
		</form>
	</div>
	<?php
}