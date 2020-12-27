<?php
/*
Plugin Name: Post Types
Version: 1.0.0
Author: Jack Alexander
*/

require __DIR__ . '/../../vendor/autoload.php';

use PostTypes\PostType;
use PostTypes\Taxonomy;

$projects = new PostType([
    'name'     => 'project',
    'singular' => 'Project',
    'plural'   => 'Projects',
    'slug'     => 'projects',
], [
    'has_archive' => true,
	'show_in_rest' => true,
    'supports' => [
        'title',
        'revisions',
    ],
]);

$projects->columns()->add( [
    'year_published' => __('Year Published'),
]);

$projects->columns()->populate('year_published', function ($column, $post_id) {
    echo get_field('year_published', $post_id);
});

$projects->columns()->sortable([
    'year_published'  => ['year_published', true],
]);

$projects->register();

$type = new Taxonomy('project_type');
$type->posttype('project');
$type->register();

$project_tools = new Taxonomy('project_tool');
$project_tools->posttype('project');
$project_tools->register();

$plugins = new Taxonomy('plugin');
$plugins->posttype('project');
$plugins->register();

$project_foundations = new Taxonomy('project_foundation');
$project_foundations->posttype('project');
$project_foundations->register();

$company = new Taxonomy('company');
$company->posttype('project');
$company->register();

add_filter( 'rest_project_query', function ($query_vars, $request) {
	$query_vars["orderby"] = "meta_value_num";
	$query_vars["meta_key"] = "year_published";

	return $query_vars;
}, 10, 2);

add_image_size( 'project-box', 340, 9999, false );