<script>
	$(document).ready(function(e) {

		$('#rev_slider_1').show().revolution({
			parallax: {
				type: 'mouse+scroll',
				origo: 'slidercenter',
				speed: 400,
				levels: [5,10,15,20,25,30,35,40,45,46,47,48,49,50,51,55],
				disable_onmobile: 'on'
			},
			/* options are 'auto', 'fullwidth' or 'fullscreen' */
			sliderLayout: 'fullwidth',
			responsiveLevels: [1240, 1024, 778, 480],
        //gridwidth: [1240, 1024, 778, 480],
        gridwidth: [940, 940, 940, 940],
        gridheight: [261, 261, 261, 261],
        navigation: {
        	arrows: {
        		enable: true,
        		style: 'hesperiden',
        		hide_onleave: true
        	},
        	bullets: {
        		enable: false,
        		style: 'hermes',
        		hide_onleave: false,
        		h_align: 'center',
        		v_align: 'bottom',
        		h_offset: 0,
        		v_offset: 20,
        		space: 5
        	}
        }
    });
	});

</script>
