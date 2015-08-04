<?php

/*
Tema: vis Kalender
*/

?>
    <section id="kalender">
    <div class="wrap-960">
        <article>
        	<h1 class="page-dark">Kalender<span class="cal-print"></span></h1>
            <div id="cal-top-3">
				<?php echo do_shortcode('[eo_events numberposts=3 showpastevents=false]'); ?>
            </div>
            <div id="cal-full" class="hidden">
				<?php echo do_shortcode('[eo_events numberposts=-1 showpastevents=false]'); ?>
            </div>
            <div id="cal-expand">Vis hele kalenderen</div>
        </article>
 	</div>
    </section>