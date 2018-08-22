<!-- SIDE NAV THAT APPEARS ON GUIDE AND ITS CHILDREN PAGES -->


<!-- <ul>
  <li>
    <h2>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">About This Guideline</a>
    </h2>
  </li>
</ul> -->
<?php $args = array(
	'sort_order' => 'asc',
	'sort_column' => 'menu_order',
	'parent' => '264',
  'exclude' => '43',
	//'post_type' => 'page',
	//'post_status' => 'publish'
);
$pages = get_pages($args);
//print_r($pages);


foreach($pages as $page){
  $parent = '<a href="#">';
  $parent .= $page->post_title;
  $parent .= '</a>';
  // foreach($children as $child){
  //   $child = '<a href="#">';
  //   $child .= $page->post_title;
  //   $child .= '</a>';
  // }
?>

<ul class="guide-nav">
  <li>
    <?php echo $parent; ?>
    <ul class="nu__children">
      <?php wp_list_pages('title_li=&depth=0&child_of='.$page->ID.''); ?>
    </ul>
  </li>
</ul>
<?php } ?>
