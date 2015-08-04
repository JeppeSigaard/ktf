<!-- paste this right before `</head>` -->
    <!-- (Load Jquery) --><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- (load fbAlbum2) --><script>(function(e){e.fn.fbAlbum=function(t){var n=this,r="https://graph.facebook.com/",i={albumID:"10150302289698306",limit:100,limitThumbs:false,ulClass:"album",rel:"group",callback:"",title:true,thumbSize:0,fullSize:0,caption:false};if(t){e.extend(i,t)}r+=i.albumID+"/photos?fields=name,picture,images,source&limit="+i.limit+"&callback=?";e.getJSON(r,function(t){var r=[],s=0,o=e("<ul>");e.each(t.data,function(){if(typeof this.picture!=="undefined"){var t=i.thumbSize===0?this.picture:this.images[9-i.thumbSize].source,n=i.fullSize===0?this.source:this.images[9-i.fullSize].source,r=i.title&&this.name?this.name:"",u=i.limitThumbs&&(s+=1)>=i.limitThumbs,a=u?null:e("<img>").attr({src:t,alt:r}),f=!i.caption||r===""?null:e("<p>").addClass("caption").text(r),l=e("<a>").attr({"class":"imageLink",rel:i.rel,title:r,href:n}),c=e("<li>").addClass(u?"noThumb":"fbThumb");o.append(c.append(l.append(a,f)))}});n.append(o.addClass(i.ulClass));if(i.callback){i.callback()}});return n}})(jQuery);</script>

    <script>$(document).ready(function(){

        $('#myAlbum').fbAlbum({ // 'myAlbum' is the id of the html element your album will go into
            albumID: '10154117098705078' // Change the AlbumID to be that of your Facebook album
        });

    });</script>

<section id="billeder">
	<div class="wrap-960">
    	<div class="wrap-940">
        	<h1 style="margin-left:10px;">Billeder</h1>
            <div id="myAlbum"></div>
            <div class="pic-more">+</div>
        </div>
    </div>
</section>