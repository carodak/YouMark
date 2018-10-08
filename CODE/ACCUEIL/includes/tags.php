<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
</head>

<body>



<div id='tag-cloud'></div> 
   




<script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
<script src="jquery.svg3dtagcloud.min.js"></script>
<script>

    	$( document ).ready( function() {

            var entries = [ 
                { label: 'Musique',url: "clic_tag.php?label_tag=Musique", target: '_top' },
                { label: 'Humour', url: "clic_tag.php?label_tag=Humour", target: '_top' },
                { label: 'Science', url: "clic_tag.php?label_tag=Science", target: '_top' },
                { label: 'Culture',url: "clic_tag.php?label_tag=Culture", target: '_top' },
                { label: 'Cuisine', url: "clic_tag.php?label_tag=Cuisine", target: '_top' },
                { label: 'Journalisme', url: "clic_tag.php?label_tag=Journalisme", target: '_top' },
                { label: 'Gaming',url: "clic_tag.php?label_tag=Gaming", target: '_top' },
                { label: 'Medecine', url: "clic_tag.php?label_tag=Medecine", target: '_top' },
                { label: 'Fiction', url: "clic_tag.php?label_tag=Fiction", target: '_top' },
                { label: 'Tutoriels',url: "clic_tag.php?label_tag=Tutoriels", target: '_top' },
                { label: 'Droit', url: "clic_tag.php?label_tag=Droit", target: '_top' },
                { label: 'High-Tech', url: "clic_tag.php?label_tag=High-Tech", target: '_top' },
                { label: 'Android',url: "clic_tag.php?label_tag=Android", target: '_top' },
                { label: 'Tour de magie', url: "clic_tag.php?label_tag=magie", target: '_top' },
                { label: 'Sport', url: "clic_tag.php?label_tag=Sport", target: '_top' },
                { label: 'Loisirs', url: "clic_tag.php?label_tag=Loisirs", target: '_top' }

            ];

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
