<?php

if ( comments_open() || get_comments_number() ) {	
	
?>

    <div id="comments" class="single-blog-post-comments">

	<h5 class="comments-heading"><?php comments_number('0 ' . engage_translate( 'comments' ), '1 '  . engage_translate( 'comment' ), '% ' . engage_translate( 'comments' ) ); ?></h5>

		
		<ul class="comments">
		<?php 
			wp_list_comments( array(
				'callback' => 'engage_comment',
				'type' => 'all',
			) );
		?>				
		</ul>
		
		<div class="pagination">
		
			<div class="pagination-inner">
			<?php
			 
			paginate_comments_links(array(
				'prev_text' => '',
				'next_text' => ''
			)); 
			
			?>
			</div>
			
		</div>	
	
	</div>		
	
	<?php } // Comments list end ?>		
	
	<?php if ( comments_open() ) { ?>
	
	<div class="leave-comment">
		
		<h5 class="comments-heading"><?php echo engage_translate( 'leave-comment' ); ?></h5>
		
		<div class="comment-form">
			
		<?php

        // GDPR related
        $commenter = wp_get_current_commenter();
        $consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

        // Required
        $req = get_option( 'require_name_email' );

        $cookies_field = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
            '<label for="wp-comment-cookies-consent">' . engage_translate( 'comment-form-consent' ) . '</label></p>';

        // Comment form args
		$args = array(
			 'title_reply'	=> '',
			 'fields' => apply_filters( 'comment_form_default_fields', array(
			 	'author' 	=> '<div class="row comment-name-email"><div class="col-md-6"><input id="author" name="author" placeholder="' . engage_translate( 'name' ) . ( $req ? ' *' : '' ) . '" type="text" required="required" class="input-lg form-control"></div>',
			 	'email' 	=> '<div class="col-md-6"><input id="email" name="email" type="email" placeholder="' . engage_translate( 'email' ) . ( $req ? ' *' : '' ) . '" required="required" class="input-lg form-control"></div></div>'
			   )),
			   'comment_field' =>  '<div class="comment-form-text"><textarea name="comment" id="comment" placeholder="' . engage_translate( 'comment' ) . '..." class="form-control" rows="10" aria-required="true"></textarea></div>',

		);

		if ( engage_option('comments_website') !== false ) {
		    $args['fields']['url'] = '<div class="row comment-url-row"><div class="col-md-12 comment-form-url"><input id="url" name="url" type="text" placeholder="' . engage_translate( 'website' ) . '" class="input-lg form-control"></div></div>';
		}

        $args['fields']['cookies'] = $cookies_field;

        // Notes before
        if ( has_filter( 'engage-comment-notes-before' ) ) {
            $comment_notes_before = apply_filters( 'engage-comment-notes-before', '' );
            $args['comment_notes_before'] = '<p class="comment-notes">' .$comment_notes_before . '</p>';
        }

        // Notes after
        if ( has_filter( 'engage-comment-notes-after' ) ) {
            $comment_notes_after = apply_filters( 'engage-comment-notes-a', '' );
            $args['comment_notes_after'] = '<p class="comment-notes-after">' .$comment_notes_after . '</p>';
        }
					
		comment_form( $args );
		
		?>			   

		</div>
		
	</div>
	
	<?php } ?>