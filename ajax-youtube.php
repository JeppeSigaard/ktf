<?php
// funktion til at hente data via curl (don't ask)
function file_get_contents_curl($url) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $url);
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
}


// Youtube API
$apiKey = 'AIzaSyDy9XdLZMLGIIge_f23ZzYK7mU0q2c3-BA';
$apiUrl = 'https://www.googleapis.com/youtube/v3/';
$apiPart = 'snippet%2Cid';
$apiChannel = 'UCB17ObA6L5tQA2ZujA191gw';
$featured_id = 'PL9osYxYjKQy5jUqnX_nxgqFa3Ql0-8Wu7';
?>
            <div id="thumbs">
                <ul>
<?php 
// Hent film fra featured playliste
$get_featured = json_decode(file_get_contents_curl($apiUrl.'playlistItems?part='.$apiPart.'&playlistId='.$featured_id.'&key='.$apiKey.'&maxResults=9'),true);
foreach($get_featured['items'] as $video):?>
                    <li>
                        <a href="<?php echo 'https://youtu.be/'.$video['snippet']['resourceId']['videoId'];?>">
                            <span class="image"><img src="<?php echo $video['snippet']['thumbnails']['medium']['url']; ?>" class="thumb" /></span>
                            <span class="image-overlay"></span>
                            <span class="video-title"><?php echo $video['snippet']['title'];?></span>
                            <span class="hidden-desc hidden"><?php echo nl2br($video['snippet']['description']);?></span>
                        </a>
                    </li>

<?php endforeach; ?>
<div style="display:none;"><?php print_r($get_featured); ?></div>
</ul>
            </div>
            <div id="mov-expand">Vis flere film</div>
			<div class="yt-plists hidden">    
<?php 
// Hent playlister
$get_pl = json_decode(file_get_contents_curl($apiUrl.'playlists?part='.$apiPart.'&channelId='.$apiChannel.'&key='.$apiKey),true);
foreach($get_pl['items'] as $plist):if ($plist['id'] !== $featured_id) :
$get_pl_vids = json_decode(file_get_contents_curl($apiUrl.'playlistItems?part='.$apiPart.'&playlistId='.$plist['id'].'&key='.$apiKey),true); ?>

<div class="yt-plist">
	<div class="plist-head">
        <div class="plist-title"><?php echo $plist['snippet']['title']; ?></div>
    </div>
    <ul class="plist-videos">
    	<!--<li>
        <div class="plist-thumb"><img src="<?php echo $plist['snippet']['thumbnails']['medium']['url'] ?>"/></div>
        <a href="<?php echo $plist['id']; ?>" class="pl-image-overlay">Afspil alle</a>
        </li>-->
    	<?php foreach($get_pl_vids['items'] as $video):?>
                    <li>
                        <a href="<?php echo 'https://youtu.be/'.$video['snippet']['resourceId']['videoId'];?>">
                            <span class="image"><img src="<?php echo $video['snippet']['thumbnails']['medium']['url']; ?>" class="thumb" /></span>
                            <span class="image-overlay"></span>
                            <span class="video-title"><?php echo $video['snippet']['title'];?></span>
                            <span class="hidden-desc hidden"><?php echo nl2br($video['snippet']['description']);?></span>
                        </a>
                    </li>
		<?php endforeach; ?>
    </ul>
</div>

<?php endif; endforeach?>
			</div>