<?php
// $Id: views-view-fields.tpl.php,v 1.6 2008/09/24 22:48:21 merlinofchaos Exp $
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->separator: an optional separator that may appear before a field.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
/* Had to remove white space per: http://drupal.org/node/315360. Otherwise when we use a comma as a deliminator between inline 
 * fields, the carriage returns adds a space before the comma (i.e. Organization name , City): 
 *  
 */
?>
<?php // foreach ($fields as $id => $field): ?>

	<?php
	  // $field->element_type is either SPAN or DIV depending upon whether or not
	  // the field is a 'block' element type or 'inline' element type.
	
	$image = '';
	$image_class = 'no-image';
	$content = '';

	if ( $fields['field_press_release_image_fid']->content ) {
		$image = $fields['field_press_release_image_fid']->content;
		$image_class = '';
	} else {
		$image = '<img src="' . $base_path . $directory . '/client_files/img/icons/investor-icon.svg" alt="icon">';
	}

	if ( $fields['path']->content ) {
		$path = $fields['path']->content;
	}

	if ( $fields['title']->content ) {
		$content .= '<h2 class="card__headline">' . $fields['title']->content . '</h2>';
	}

	if ( $fields['created']->content ) {
		$content .= '<p class="card__post-date">' . $fields['created']->content . '</p>';
	}

// endforeach; 
?>
<a href="<?php print $path; ?>" class="card <?php print $image_class; ?>">
	<div class="card__wrapper">
		<div class="card__img"><?php print $image; ?></div>
		<div class="card__text">
			<p class="card__type-title">Press Release</p>
			<?php print $content; ?>
		</div>
	</div>
</a>