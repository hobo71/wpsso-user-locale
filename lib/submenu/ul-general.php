<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2017 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) 
	die( 'These aren\'t the droids you\'re looking for...' );

if ( ! class_exists( 'WpssoUlSubmenuUlGeneral' ) && class_exists( 'WpssoAdmin' ) ) {

	class WpssoUlSubmenuUlGeneral extends WpssoAdmin {

		public function __construct( &$plugin, $id, $name, $lib, $ext ) {
			$this->p =& $plugin;
			$this->menu_id = $id;
			$this->menu_name = $name;
			$this->menu_lib = $lib;
			$this->menu_ext = $ext;

			if ( $this->p->debug->enabled )
				$this->p->debug->mark();
		}

		protected function add_meta_boxes() {
			add_meta_box( $this->pagehook.'_user_locale', 
				_x( 'User Locale Settings', 'metabox title', 'wpsso-user-locale' ),
				array( &$this, 'show_metabox_user_locale' ), $this->pagehook, 'normal' );
		}

		public function show_metabox_user_locale() {
			$metabox = 'ul';
			$key = 'general';
			$this->p->util->do_table_rows( apply_filters( $this->p->cf['lca'].'_'.$metabox.'_'.$key.'_rows', 
				$this->get_table_rows( $metabox, $key ), $this->form, false ), 'metabox-'.$metabox.'-'.$key );
		}

		protected function get_table_rows( $metabox, $key ) {
			$table_rows = array();
			switch ( $metabox.'-'.$key ) {
				case 'ul-general':

					$table_rows['ul_front_end'] = $this->form->get_th_html( _x( 'Select User Locale on Front-End',
						'option label', 'wpsso-user-locale' ), '', 'ul_front_end' ).
					'<td>'.$this->form->get_checkbox( 'ul_front_end' ).'</td>';

					break;
			}
			return $table_rows;
		}
	}
}

?>