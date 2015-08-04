<?php
/**
 * Event List Widget: Standard List
 */
global $eo_event_loop,$eo_event_loop_args;

//Date % Time format for events
$date_format = get_option('date_format');
$time_format = get_option('time_format');

//The list ID / classes
$id = ( $eo_event_loop_args['id'] ? 'id="'.$eo_event_loop_args['id'].'"' : '' );
$classes = $eo_event_loop_args['class'];

?>

<?php if( $eo_event_loop->have_posts() ): 

$dName = 'D';
$dNum = 'd';
$mName = 'M';
$tnum = 'H:i';

?>

		<?php while( $eo_event_loop->have_posts() ): $eo_event_loop->the_post();
		
				//For non-all-day events, include time format
				if(eo_is_all_day()){$cal_time = 'Hele dagen';}
				else{$cal_time = eo_get_the_start($tnum) .' - '. eo_get_the_end($tnum);}
			?>

			<div class="cal-entry" >
                <div class="date-box">
                    <span class="dname"><?php echo eo_get_the_start($dName); ?></span>
                    <span class="dnum"><?php echo eo_get_the_start($dNum); ?></span>
                    <span class="mname"><?php echo eo_get_the_start($mName); ?></span>
                </div>
                <div class="img-box"><?php the_post_thumbnail('feed-size'); ?></div>
                <div class="title-box">
                    <h4><?php the_title(); ?></h4>
                    <span><?php echo $cal_time ?></span>
                    <span class="desc-meta">
                    <?php echo get_the_term_list( get_the_ID(),'event-category', '', '', '' ); ?>
               		</span>
                    <span class="title-exp-ind"></span>
                </div>
                <div class="descr-box">
                	<?php the_content(); ?>
                </div>
            </div>

		<?php endwhile; ?>

    
<?php endif; ?>

