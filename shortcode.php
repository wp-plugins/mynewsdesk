<?php
function get_mynewsdesk() {

  $output = '';
  if(isset($_REQUEST['view_id']) && !empty($_REQUEST['view_id']) ){
  	$view_id = $_REQUEST['view_id'];
  }
  $output .= '<div id="view_id_" style="display:none;">'.$view_id.'</div>';
  
  $output .= '<div id="ajax_response" class="loading"></div>';
return $output;
}
add_shortcode('mynewsdesk', 'get_mynewsdesk');
add_action('wp_ajax_mnd_news', 'get_mnd_ajax');
add_action( 'wp_ajax_nopriv_mnd_news', 'get_mnd_ajax' ); 



function get_mnd_ajax() {
 $api_key = get_option('kkpo_quote');
  if(!isset($api_key) || empty($api_key)){
  	$output .= "Please enter unique key admin &raquo; setting &raquo; myNewsDesk If you don't have unique key then contact myNewsDesk.com to get one. For more information please read <a href='www.mynewsdesk.com/docs/webservice_pressroom' target='_blank'>www.mynewsdesk.com/docs/webservice_pressroom</a>";
	return $output;
  }  
  
  if(isset($_REQUEST['view_id']) && !empty($_REQUEST['view_id']) ){
	$view_id = $_REQUEST['view_id'];
	$service = 'view';	
	$parameters='item_id='.$view_id;	
	$url = 'http://www.mynewsdesk.com/services/pressroom/'.$service.'/'.$api_key.'/?'.$parameters;
	$dom_object = new DOMDocument(); 
	$dom_object->load($url);
	$item = $dom_object->getElementsByTagName("item");
	foreach($item as $ind_Release){
				$header = $ind_Release->getElementsByTagName("header");
				$body = $ind_Release->getElementsByTagName("body");
				$published_at = $ind_Release->getElementsByTagName("published_at");
				$image_thumbnail_large = $ind_Release->getElementsByTagName("image_thumbnail_large");

				$header_value = $header->item(0)->nodeValue;
				$body_value = $body->item(0)->nodeValue;
				$published_at_value = $published_at->item(0)->nodeValue;
				$image_thumbnail_large_value = $image_thumbnail_large->item(0)->nodeValue;
				
				$published_date = explode(":", $published_at_value);
				
				if(isset($image_thumbnail_large_value))
					$imgDiv = '<div><img src="'.$image_thumbnail_large_value.'"></div>';
				else
					$imgDiv = '';
				
				$output .= '<div class="row news_row mnd_rows">';
				$output .= '<div class="span12">
								<div><h1>'.$header_value.'</h1></div>
								<div class="news_date">'.$published_date[0].':'.$published_date[1].'</div>								
								<div>'.$body_value.'</div>
								'.$imgDiv.'
							</div>';				
				$output .= '</div>';				
		
	}
  }else{
	  $service = 'list';
	  $parameters='pressroom=se&limit=100';
	  $url = 'http://www.mynewsdesk.com/services/pressroom/'.$service.'/'.$api_key.'/?'.$parameters;
	  $dom_object = new DOMDocument(); 
	  $dom_object->load($url);
	  $i=0;
	  $items = $dom_object->getElementsByTagName("items");
		foreach( $items as $value ){
			$item = $value->getElementsByTagName("item");
			$output .= '<div class="news_block_parent" style="min-height:1100px;">';
			$output .= '<div id="block_'.$i.'" class="news_block">';
			foreach($item as $ind_Release){
				$i++;			
				$id = $ind_Release->getElementsByTagName("id");
				$header = $ind_Release->getElementsByTagName("header");
				$published_at = $ind_Release->getElementsByTagName("published_at");				
				$summary = $ind_Release->getElementsByTagName("summary");
				$image_thumbnail_small = $ind_Release->getElementsByTagName("image_thumbnail_small");
				
				$id_value = $id->item(0)->nodeValue;
				$header_value = $header->item(0)->nodeValue;
				$published_at_value = $published_at->item(0)->nodeValue;
				$summary_value = $summary->item(0)->nodeValue;
				$image_thumbnail_small_value = $image_thumbnail_small->item(0)->nodeValue;
				
				$published_date = explode(":", $published_at_value);
				
				$output .= '<div class="row news_row news_row_list mnd_rows">';
				$span_class = 'span12';
				if(isset($image_thumbnail_small_value)):
					$span_class = 'span9';
					$output .= '<div class="span3 news_thumb_block">
								<div class="news_thumb_block_inner inner">
									<img src="'.$image_thumbnail_small_value.'" alt="">
								</div>
								</div>';
				endif;
					$output .= '<div class="'.$span_class.'">
									<div class="inner">
									<div class="mnd-a"><a href="?view_id='.$id_value.'">'.$header_value.'</a></div>
									<div class="news_date">'.$published_date[0].':'.$published_date[1].'</div>
									<div>'.$summary_value.'</div>
									</div>
								</div>';							
				
				$output .= '</div>';
				if($i%10 == 0){ $output .= '</div><div id="block_'.$i.'" class="news_block" style="display:none;">';}
				
			}
			$output .= '</div>';
			$output .= '</div>';
			
		}
		$i=0;
		$output .= 	'<div class="pagination_mnd"><ul>';
		$output .= 	'<li><a href="#" class="page_href" id="k_0">&laquo;</a></li>';
			foreach($item as $ind_Release){
				if($i%10 == 0){
					$page_number = ($i/10)+1;
					$output .= '<li><a href="#" class="page_href" id="k_'.$i.'">'.$page_number.'</a></li>';
					$last_block = $i;
				}
				$i++;
			}
		$output .= 	'<li><a href="#" class="page_href" id="k_'.$last_block.'">&raquo;</a></li>';
		$output .= 	'</ul></div>';
  }//end of else
  echo $output;
die();
}