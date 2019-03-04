<?php

ob_start(); ?>

var qpLang = {
	cancel  : '<?php _e('Cancel', 'qpages'); ?>',
	check   : '<?php _e('Verifying fields...', 'qpages'); ?>',
	notitle : '<?php _e('You must provide a title for this page!', 'qpages'); ?>',
	ok      : '<?php _e('Ok', 'qpages'); ?>',
	nourl   : '<?php _e('You must provide an url for this page!', 'qpages'); ?>',
	saving  : '<?php _e('Saving page data', 'qpages'); ?>',
	done    : '<?php _e('Close', 'qpages'); ?>',
}

<?php

$thelang = ob_get_clean();

return $thelang;
