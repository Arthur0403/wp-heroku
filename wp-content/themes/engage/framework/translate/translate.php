<?php

function engage_translate( $string_slug ) {

    if ( engage_option( 't_enable' ) == '0' || engage_option( 't_' . $string_slug ) == '' ) {

        $default_strings = array(
            'name'      => esc_html__( 'Name', 'engage' ),
            'subject'   => esc_html__( 'Subject', 'engage' ),
            'email'     => esc_html__( 'Email', 'engage' ),
            'send'      => esc_html__( 'Send', 'engage' ),
            'message'   => esc_html__( 'Message', 'engage' ),
            'cf-success' => esc_html__( 'Send', 'engage' ),
            'by'        => esc_html__( 'By', 'engage' ),
            'in'        => esc_html__( 'in', 'engage' ),
            'on'        => esc_html__( 'on', 'engage' ),
            'previous-post' => esc_html__( 'Previous Post', 'engage' ),
            'next-post' => esc_html__( 'Next Post', 'engage' ),
            'reply'     => esc_html__( 'Reply', 'engage' ),
            'home'      => esc_html__( 'Home', 'engage' ),
            'page-not-found' => esc_html__( 'Page not found', 'engage' ),
            'read-more' => esc_html__( 'Read more', 'engage' ),
            'view-page' => esc_html__( 'View page', 'engage' ),
            'visit-site' => esc_html__( 'Visit site', 'engage' ),
            'comment'   => esc_html__( 'Comment', 'engage' ),
            'comments'  => esc_html__( 'Comments', 'engage' ),
            'reply'     => esc_html__( 'Reply', 'engage' ),
            'leave-comment' => esc_html__( 'Leave a comment', 'engage' ),
            'archives'  => esc_html__( 'Archives', 'engage' ),
            'search-results' => esc_html__( 'Search results', 'engage' ),
            'search-results-for' => esc_html__( 'Search results for', 'engage' ),
            'blog'      => esc_html__( 'Blog', 'engage' ),
            'search-big-placeholder' => esc_html__( 'Type and hit Enter...', 'engage' ),
            'search-placeholder' => esc_html__( 'Search...', 'engage' ),
            'about-project' => esc_html__( 'About Project', 'engage' ),
            'project-details' => esc_html__( 'Project Details', 'engage' ),
            'categories' => esc_html__( 'Categories', 'engage' ),
            'skills'    => esc_html__( 'Skills', 'engage' ),
            'project-url' => esc_html__( 'Project URL', 'engage' ),
            'client'    => esc_html__( 'Client', 'engage' ),
            'pdate'     => esc_html__( 'Date', 'engage' ),
            'budget'    => esc_html__( 'Budget', 'engage' ),
            'previous-project' => esc_html__( 'Previous Project', 'engage' ),
            'next-project' => esc_html__( 'Next Project', 'engage' ),
            'view-all'  => esc_html__( 'View All', 'engage' ),
            'view-details'  => esc_html__( 'View Details', 'engage' ),
            'default-order' => esc_html__( 'Default Order', 'engage' ),
            'sort-by' => esc_html__( 'Sort by', 'engage' ),
            'popularity' => esc_html__( 'Popularity', 'engage' ),
            'price' => esc_html__( 'Price', 'engage' ),
            'date' => esc_html__( 'Date', 'engage' ),
            'products' => esc_html__( 'Products', 'engage' ),
            'show' => esc_html__( 'Show', 'engage' ),
            'website' => esc_html__( 'Website', 'engage' ),
            'login' => esc_html__( 'Log in', 'engage' ),
            'password' => esc_html__( 'Password', 'engage' ),
            'username_or_email' => esc_html__( 'Username or Email Address', 'engage' ),
            'remember_me' => esc_html__( 'Remember me', 'engage' ),
            'comment-form-consent' => esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'engage' ),
            'consent-ask' => esc_html__( 'I consent to having this website store my submitted information so they can respond to my inquiry.', 'engage' )
        );

        return $default_strings[ $string_slug ];

    } else {
        if ( $string_slug == 'consent-ask' || $string_slug == 'comment-form-consent' ) {
            return wp_kses( engage_option( 't_' . $string_slug ), engage_kses() );
        } else {
            return esc_html( engage_option( 't_' . $string_slug ) );
        }
    }

}
