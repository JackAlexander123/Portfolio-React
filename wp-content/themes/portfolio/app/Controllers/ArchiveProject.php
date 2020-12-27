<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class ArchiveProject extends Controller
{
    public static function getProjectData(int $post_id = 0): array
    {
        $post_id = $post_id ?? get_the_ID();

        return [
            'title' => get_the_title($post_id),
            'permalink' => get_permalink($post_id),
            'key_page_1' => get_field('key_page_1', $post_id),
            'year_published' => get_field('year_published', $post_id),
        ];
    }

    public function searchTerms(): array
    {
        return [
            [
                'title' => 'Companies',
                'tax' => 'company',
                'terms' => get_terms(['taxonomy' => 'company', 'hide_empty' => false,'orderby' => 'count','order' => 'DESC']),
            ],
            [
                'title' => 'Project Foundations',
                'tax' => 'project_foundation',
                'terms' => get_terms(['taxonomy' => 'project_foundation', 'hide_empty' => false,'orderby' => 'count','order' => 'DESC']),
            ],
            [
                'title' => 'Plugins Foundations',
                'tax' => 'plugin',
                'terms' => get_terms(['taxonomy' => 'plugin', 'hide_empty' => false,'orderby' => 'count','order' => 'DESC']),
            ],
            [
                'title' => 'Project Tools',
                'tax' => 'project_tool',
                'terms' => get_terms(['taxonomy' => 'project_tool', 'hide_empty' => false,'orderby' => 'count','order' => 'DESC']),
            ],
            [
                'title' => 'Project Types',
                'tax' => 'project_type',
                'terms' => get_terms(['taxonomy' => 'project_type', 'hide_empty' => false,'orderby' => 'count','order' => 'DESC']),
            ],
        ];
    }
}
