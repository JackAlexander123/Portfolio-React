<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);

add_filter('query_vars', function (array $qvars) {
    $qvars[] = 'term_company';
    $qvars[] = 'term_project_foundation';
    $qvars[] = 'term_plugin';
    $qvars[] = 'term_project_tool';
    $qvars[] = 'term_project_type';
    return $qvars;
});

add_action('pre_get_posts', function (\WP_Query $query) {
    if(is_admin() || ! $query->is_main_query()) {
        return $query;
    }

    if (isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'project' ) {
        $query->set('meta_key', 'year_published');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'DESC');
    }

    $tax_query = $query->get('tax_query');

    if (! is_array( $tax_query)) {
        $taxquery = [];
    }

    $term_company = get_query_var('term_company');
    if (! empty($term_company) && '*' !== $term_company) {
        $taxquery[] = [
            'taxonomy' => 'company',
            'terms' => $term_company
        ];
    }

    $term_project_foundation = get_query_var('term_project_foundation');
    if (! empty($term_project_foundation) && '*' !== $term_project_foundation) {
        $taxquery[] = [
            'taxonomy' => 'project_foundation',
            'terms' => $term_project_foundation
        ];
    }

    $term_plugin = get_query_var('term_plugin');
    if (! empty($term_plugin) && '*' !== $term_plugin) {
        $taxquery[] = [
            'taxonomy' => 'plugin',
            'terms' => $term_plugin
        ];
    }

    $term_project_tool = get_query_var('term_project_tool');
    if (! empty($term_project_tool) && '*' !== $term_project_tool) {
        $taxquery[] = [
            'taxonomy' => 'project_tool',
            'terms' => $term_project_tool
        ];
    }

    $term_project_type = get_query_var('term_project_type');
    if (! empty($term_project_type) && '*' !== $term_project_type) {
        $taxquery[] = [
            'taxonomy' => 'project_type',
            'terms' => $term_project_type
        ];
    }


    $query->set('tax_query', $taxquery);

    return $query;
});
