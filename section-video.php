<?php

/*
Tema: vis videosektion
*/

?>
    <section id="filmgalleri">
        <div class="wrap-960 page-dark">
            <article style="padding:20px 0px;">
            <h3 class="page-dark" style="padding:0px 20px;">Film</h3>
            <div id="embed"></div>
            <div id="meta" class="noshow">
            	<div id="meta-kolofon"></div>
            	<div id="meta-description"></div>
            </div>
            <div id="thumbs">
                <ul>
                <?php
                
                // The Simple API URL
                $api_endpoint = 'http://vimeo.com/api/v2/';
                
                // Curl helper function
                function curl_get($url) {
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
                    $return = curl_exec($curl);
                    curl_close($curl);
                    return $return;
                	}
                    // Vimeo bruger
                    $vimeo_user_name = 'user26361887';
                
                    // Hent videoer
                    $videos = simplexml_load_string(curl_get($api_endpoint.$vimeo_user_name . '/videos.xml'));
                
                
                 foreach ($videos->video as $video): ?>
                    <li>
                        <a href="<?php echo $video->url ?>">
                            <span class="image"><img src="<?php echo $video->thumbnail_large ?>" class="thumb" /></span>
                            <span class="image-overlay"></span>
                            <span class="video-title"><?=$video->title?></span>
                            <span class="hidden-desc hidden"><?=nl2br($video->description)?></span>
                        </a>
                    </li>
                <?php endforeach ?>
                </ul>
            </div>
            <div id="mov-expand">Vis flere film</div>
            </article>
        </div>
    </section>