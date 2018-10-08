<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
</head>

<body>



<div id='tag-cloud' style="display: inline-block; vertical-align: bottom;">
     
      <div class="voir_plus" style="display:none;">
                           <a href="tags_list.php" class="btn btn-xs btn-success pull-right"><span class="glyphicon glyphicon-plus-sign"></span></a>
    
</div>       


</div> 
   




<script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
<script src="jquery.svg3dtagcloud.min.js"></script>
<script>

    	$( document ).ready( function() {

            var entries=[];


            <?php
                          $tag = $managerTag->count_occurrence();
                              $max= 200;
                              $compt=0;

                              foreach ($tag as $key => $value) {
                                if($compt+strlen($value['label'])<=$max){
                                     $res = $value['label'];

                                     ?>
            var info = { label: <?php echo json_encode($res);; ?>,url: "clic_tag.php?label_tag="+<?php echo json_encode($res);; ?>, target: '_top' };                                    
            entries.push(info);


            <?php

                                     $compt += strlen($value['label']);

                                    }
                                   
                                 }

                         ?>

            var settings = {

                entries: entries,
                width: 217,
                height: 250,
                radius: '65%',
                radiusMin: 75,
                bgDraw: true,
                bgColor: '#FFFFFF',
                opacityOver: 1.00,
                opacityOut: 0.05,
                opacitySpeed: 4,
                fov: 800,
                speed: 0.5,
                fontFamily: 'Oswald, Arial, sans-serif',
                fontSize: '15',
                fontColor: '#000000',
                fontWeight: 'normal',//bold
                fontStyle: 'normal',//italic 
                fontStretch: 'normal',//wider, narrower, ultra-condensed, extra-condensed, condensed, semi-condensed, semi-expanded, expanded, extra-expanded, ultra-expanded
                fontToUpperCase: true

            };

            //var svg3DTagCloud = new SVG3DTagCloud( document.getElementById( 'holder'  ), settings );
            $( '#tag-cloud' ).svg3DTagCloud( settings );

		} );
        
    </script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
