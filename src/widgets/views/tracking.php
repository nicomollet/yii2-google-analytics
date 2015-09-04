<?php
/**
 * @var boolean $omitScriptTag
 * @var string $trackingId
 * @var array $trackingParams
 * @var string $trackingFilename
 * @var string $trackingConfig
 * @var array $plugins
 * @var array $events
 */
?>
<?php if ( ! $omitScriptTag ) {
	echo '<script type="text/javascript">';
} ?>
<?= $trackingDebugTraceInit ?>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/<?= $trackingFilename ?>','ga');
ga('create', '<?= $trackingId ?>', <?= $trackingConfig ?>);
<?php foreach ( $fields as $field => $value ) : ?>
	ga('set', '<?= $field ?>', <?= $value ?>);
<?php endforeach ?>
<?php foreach ( $plugins as $plugin => $options ) : ?>
	ga('require', '<?= $plugin ?>', <?= $options ?>);
<?php endforeach ?>

<?php
$events_output = '';
if ( is_array( $events ) ) :
	foreach ( $events as $event ) :
		$events_output .= 'ga(';
		$cpt_array = 0;
		foreach ( $event as $options ) :
			$cpt_array ++;
			if ( $cpt_array != 1 ) {
				$events_output .= ', ';
			}
			if ( is_array( $options ) ) :
				$events_output .= json_encode( $options );
			else :
				$events_output .= "'" . $options . "'";
			endif;

		endforeach;

		$events_output .= ');' . "\n";
	endforeach;
	echo $events_output;
endif;
?>
ga('send', 'pageview');
<?php if ( ! $omitScriptTag ) {
	echo '</script>';
} ?>
