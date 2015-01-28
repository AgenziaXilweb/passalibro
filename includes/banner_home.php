<?php
tep_active_status('1', '<div id="promo">');

  if ($banner = tep_banner_exists('dynamic', 'primo')) {
$banner_image1=file_exists(DIR_WS_IMAGES.$banner['banners_image'])?DIR_WS_IMAGES.$banner['banners_image']:DIR_WS_IMAGES.'nopic.png';
?>

<div class="home_banner">
<div class="ui-widget-header infoBoxHeading"><?php echo $banner['banners_title']; ?></div>
<div class="BannerBoxContents" style="width:210px; text-align: justify; padding: 4px 4px 4px 4px;">
  <?php echo substr(tep_display_banner('static', $banner),0,600).str_ireplace(substr(tep_display_banner('static', $banner),690,693),'...',substr(tep_display_banner('static', $banner),690,693)); ?>
</div>
</div>

<?php
  }
  if ($banner = tep_banner_exists('dynamic', 'secondo')) {
$banner_image2=file_exists(DIR_WS_IMAGES.$banner['banners_image'])?DIR_WS_IMAGES.$banner['banners_image']:DIR_WS_IMAGES.'nopic.png';    
?>

<div class="home_banner">
<div class="ui-widget-header infoBoxHeading"><?php echo $banner['banners_title']; ?></div>
<div class="BannerBoxContents" style="width:210px; text-align: justify; padding: 4px 4px 4px 4px;">
  <?php echo substr(tep_display_banner('static', $banner),0,600).str_ireplace(substr(tep_display_banner('static', $banner),690,693),'...',substr(tep_display_banner('static', $banner),690,693)); ?>
</div>
</div>

<?php
  }
  if ($banner = tep_banner_exists('dynamic', 'terzo')) {
$banner_image3=file_exists(DIR_WS_IMAGES.$banner['banners_image'])?DIR_WS_IMAGES.$banner['banners_image']:DIR_WS_IMAGES.'nopic.png';    
?>

<div class="home_banner">
<div class="ui-widget-header infoBoxHeading"><?php echo $banner['banners_title']; ?></div>
<div class="BannerBoxContents" style="width:210px; text-align: justify; padding: 4px 4px 4px 4px;">
  <?php echo substr(tep_display_banner('static', $banner),0,600).str_ireplace(substr(tep_display_banner('static', $banner),690,693),'...',substr(tep_display_banner('static', $banner),690,693)); ?>
</div>
</div>

<?php
  }
tep_active_status('1', '</div>');
