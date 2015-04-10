<?php 
/**
* @package   Widgetkit
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

	$widget_id  = $widget->id.'-'.uniqid();
	$settings   = $widget->settings;
	$navigation = array();
	$captions   = array();

	$i = 0;
?>

<div id="slideshow-<?php echo $widget_id; ?>" class="wk-slideshow wk-slideshow-feature" data-widgetkit="slideshow" data-options='<?php echo json_encode($settings); ?>'>
	<div class="bg" style="background-image: url(<?php echo $settings['bgimage'];?>)">
		<ul class="slides">

			<?php foreach ($widget->items as $key => $item) : ?>
			<?php
				$navigation[] = '<li><span></span></li>';
				$captions[]   = '<li>'.(isset($item['caption']) ? $item['caption']:"").'</li>';
			
				/* Lazy Loading */
				$item["content"] = ($i==$settings['index']) ? $item["content"] : $this['image']->prepareLazyload($item["content"]);
			?>
			<li>
				<article class="wk-content clearfix"><?php echo $item['content']; ?></article>
			</li>
			<?php $i=$i+1;?>
			<?php endforeach; ?>
		</ul>
		<?php if ($settings['buttons']): ?><div class="next"></div><div class="prev"></div><?php endif; ?>
		<div class="caption <?php echo $settings["position"];?> <?php echo $settings["background"];?>"></div><ul class="captions"><?php echo implode('', $captions);?></ul>
	</div>
	<?php echo ($settings['navigation'] && count($navigation)) ? '<ul class="nav">'.implode('', $navigation).'</ul>' : '';?>
</div>