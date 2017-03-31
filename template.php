<?php

/**
 * @file
 * template.php
 */





/*


function commerce_embed_view($view_id, $display_id, $arguments, $override_url = '') {
  // Load the specified View.
  $view = views_get_view($view_id);
  $view->set_display($display_id);

  // Set the specific arguments passed in.
  $view->set_arguments($arguments);

  // Override the view url, if an override was provided.
  if (!empty($override_url)) {
	$view->override_url = $override_url;
  }

  // Prepare and execute the View query.
  $view->pre_execute();
  $view->execute();

  // Return the rendered View.
  return $view->render();
}



*/






function nanobarrier_preprocess_taxonomy_term (&$variables) {
	// dpm($variables);
}


function nanobarrier_preprocess_menu_link(&$variables) {

	
	if( $variables['element']['#href'] === 'news') {

		if(arg(0) === 'node' && is_numeric( arg(1) ) ) {
			$node = node_load( (int) arg(1) );
			if($node->type === 'news') $variables['element']['#attributes']['class'][] = 'active';
		}

		elseif ( arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric( arg(2) )  ) {

			$term = taxonomy_term_load(arg(2));
			if($term->vid == 1) $variables['element']['#attributes']['class'][] = 'active';
		}

		elseif ( arg(0) === 'news' && is_numeric( arg(1) ) ) $variables['element']['#attributes']['class'][] = 'active';
	}

	elseif( $variables['element']['#href'] === 'products' ) {

        if(arg(0) === 'node' && is_numeric( arg(1) ) ) {
            $node = node_load( (int) arg(1) );
            if($node->type === 'product') $variables['element']['#attributes']['class'][] = 'active';
        }

	
      	elseif ( arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric( arg(2) )  ) {

            $term = taxonomy_term_load(arg(2));
            if($term->vid == 3) $variables['element']['#attributes']['class'][] = 'active';
        }

        elseif ( arg(0) === 'faq' && is_numeric( arg( 1 ) )  ) {
            $variables['element']['#attributes']['class'][] = 'active';
        } 

	}
	 
}

	 



function nanobarrier_css_alter (&$css) {
	unset($css[drupal_get_path('theme', 'bootstrap') . '/css/overrides.css']);
	unset($css[drupal_get_path('module', 'locale') . '/locale.css']);
}


function nanobarrier_preprocess_page(&$vars, $hook) {
	if (isset($vars['node']->type)) {
		// If the content type's machine name is "my_machine_name" the file
		// name will be "page--my-machine-name.tpl.php".


        if( arg(0) === 'node' ) {
            $vars['theme_hook_suggestions'][] = 'page__' . $vars['node']->type;        
            
            $vars['is_preordered'] = true;

            if( $vars['node']->type === 'product') {
                $vars['node_wrapper'] = entity_metadata_wrapper('node', $vars['node']); 
                $vars['is_preordered'] = __product_is_preordered( $vars['node_wrapper'] );

                // if( $product =  $vars['node_wrapper']->field_product->value() ) {
                //     $prod_wrapper = entity_metadata_wrapper('commerce_product', $product); 
                //     $vars['is_preordered'] = !empty( $prod_wrapper->field_preorder_status->value() );                 
                // }  
            
                $breadcrumb = array();
                $breadcrumb[] = l(t('Front page'), '<front>');
                $breadcrumb[] = l(t('Products'), 'products');
                $breadcrumb[] = drupal_get_title();

                drupal_set_breadcrumb($breadcrumb);

            }

        }
	}
}




function __show_block ($module, $delta, $with_title = FALSE, $context_links = FALSE, $html_class = '') {

	$block = block_load($module, $delta);
	if( empty( $block ) ) return '';

	$r_block = _block_render_blocks(array($block));

	$block_ids = array_keys($r_block);

	if( empty( $block_ids ) ) return '';

	$block_id = array_shift($block_ids);

	if(!$with_title) $r_block[$block_id]->subject = '';  
	$rend_arr = _block_get_renderable_array($r_block);
	if(!$context_links) unset($rend_arr[$block_id]['#contextual_links'] );

	if(! empty($html_class) ) {       
		$rend_arr[$block_id]['#block']->classes = $html_class;
	}

	return drupal_render($rend_arr);
}


function __show_views($name = '', $display_id = 'default', $is_page = true) {

	// http://xandeadx.ru/blog/drupal/178
	// http://drupalcontrib.org/api/drupal/contributions%21views%21views.module/function/views_get_view_result/7
	// http://www.trellon.com/content/blog/contextual-links-views

	// if($is_page) return views_page($name, $display_id);  

	return views_embed_view($name, $display_id);

	// views_page()
	// theme('contextual', contextual_get_links('node', node_load($item->nid)));
}




function __show_menu ($menu_name) {
	$tree = menu_tree_all_data($menu_name);
	menu_tree_add_active_path($tree);
	return drupal_render(menu_tree_output($tree));
}


function nanobarrier_preprocess_block(&$variables) {
	if( property_exists( $variables['block'], 'classes' ) ) {
		$variables['classes_array'][] = $variables['block']->classes;
	}
}