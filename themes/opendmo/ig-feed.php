<?php

$igtoken = "ig_token_here";
/* IF YOU GET A NEW TOKEN THEN REPLACE THIS! */

$ig = "https://api.instagram.com/v1/users/self/media/recent/?access_token=".$igtoken."&count=12";
$ig = json_decode(file_get_contents($ig));

$igcode = $ig->meta->code;

?>

<?php if($igcode == 200): ?>

	<?php foreach($ig->data as $igp): ?>

		<?php $igl = $igp->link; $igi = $igp->images->standard_resolution->url; $igt = $igp->caption->text; ?>

		<div class="igwrapper">
 
		<a href="<?php echo $igl; ?>" target="_blank" class="igcrop">
			
		<div title="Instagram Photo: <?php echo($igt); ?>" style="background-image: url('<?php echo($igi); ?>');"></div>
	
		</a>	
		
		</div>

	<?php endforeach; ?>

<?php else: ?>

	<span>There was a problem loading the Instagram feed.</span>

<?php endif; ?>
