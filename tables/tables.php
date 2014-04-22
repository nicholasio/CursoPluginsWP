<?php
/*
Plugin Name: Tables
Description: Este plugin exemplifica a criação de tabelas no WordPress
Author: Nícholas André
Version: 1.0
Author URI: http://nicholasandre.com.br
*/



// Aula 8.1
register_activation_hook( __FILE__ , 'tables_install');

function tables_install() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'test_table';

	$sql = 'CREATE TABLE ' . $table_name .' (
		id INT NOT NULL AUTO_INCREMENT,
		time bigint(11) DEFAULT "0" NOT NULL,
		name tinytext NOT NULL,
		text text NOT NULL,
		url VARCHAR(55) NOT NULL,
		UNIQUE KEY id (id)

	);';

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php');

	dbDelta($sql);

	$tables_version = '1.0.0';

	update_option('tables_version', $tables_version);
}

// Aula 8.2
add_action('wp_dashboard_setup', 'stw_add_dashboard_widget_wpdb');

function stw_add_dashboard_widget_wpdb() {
	wp_add_dashboard_widget( 
		'stw_dashboard_widget_wpdb', 
		'$wpdb',
		'stw_create_dashboard_widget_wpdb'
	);
}

function stw_create_dashboard_widget_wpdb() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'test_table';

	/*
		Um pequeno guia dos métodos visto na aula
		*****************************************
		$wpdb->insert( $table, $data, $format );
		$wpdb->update( $table, $data, $where, $format = null, $where_format = null );
		$wpdb->delete( $table, $where, $where_format = null );
		$wpdb->query('query'); 
		$wpdb->get_row('query', output_type, row_offset);
		$wpdb->get_var( 'query', column_offset, row_offset )
		$wpdb->get_results( 'query', output_type );
	*/

	/*$wpdb->insert( 
		$table_name, 
		array(
			'time' => time(),
			'name' => 'Nícholas André',
			'text' => 'Lorem ipsum',
			'url'  => 'http://www.nicholasandre.com.br'
 		),
 		array(
 			'%d',
 			'%s',
 			'%s',
 			'%s'
 		)
	);
	echo $wpdb->insert_id;*/

	/*$rows_updated = $wpdb->update(
		$table_name,
		array(
			'name' => 'Pelé',
			'text' => 'Alterando via $wpdb'
		),
		array(
			'id' => 2
		),
		array(
			'%s',
			'%s'
		),
		array(
			'%d'
		)
	);

	echo '<br />' . $rows_updated;*/

	/*$rows_deleted = $wpdb->delete(
		$table_name,
		array(
			'id' => 2
		),
		array(
			'%d'
		)
	);

	echo '<br />' . $rows_deleted;*/

	/*
		As variáveis estão sendo definida aqui por fins didáticos,
		mas considere que elas chegam via $_POST ou $_GET
	*/
	/*$name = 'Pelé';
	$id   = 2;
	$wpdb->query( 
		$wpdb->prepare(
			"UPDATE {$table_name} SET name = '%s' WHERE id = %d",
			array(
				$name,
				$id
			)
		)
	);*/

	$row = $wpdb->get_row("SELECT * FROM $table_name WHERE id = 2");
	var_dump($row);

	$count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
	echo "<br /> Total de Registros: " . $count;

	$all = $wpdb->get_results("SELECT * FROM $table_name");
	var_dump($all);


}

