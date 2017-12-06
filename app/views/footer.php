<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Footer Layout
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.09
* @license MIT - https://opensource.org/licenses/MIT
* @link https://docs.jabalicms.org/views/footer/
*/ ?>
</main>
<script src="<?php echo _SCRIPTS; ?>particles.js"></script>
<script type="text/javascript">
	particlesJS('particles-js', 
  {
    "particles": {
      "number": {
        "value": 250,
        "density": {
          "enable": true,
          "value_area": 800
        }
      },
      "color": {
        "value": "#008080"
      },
      "shape": {
        "type": "circle",
        "stroke": {
          "width": 0,
          "color": "#008080"
        },
        "polygon": {
          "nb_sides": 5
        },
        "image": {
          "src": "img/github.svg",
          "width": 100,
          "height": 100
        }
      },
      "opacity": {
        "value": 0.9,
        "random": true,
        "anim": {
          "enable": true,
          "speed": 2,
          "opacity_min": 0.3,
          "sync": false
        }
      },
      "size": {
        "value": 5,
        "random": true,
        "anim": {
          "enable": false,
          "speed": 40,
          "size_min": 0.1,
          "sync": false
        }
      },
      "line_linked": {
        "enable": true,
        "distance": 150,
        "color": "#ffffff",
        "opacity": 0.4,
        "width": 1
      },
      "move": {
        "enable": true,
        "speed": 6,
        "direction": "none",
        "random": false,
        "straight": false,
        "out_mode": "out",
        "attract": {
          "enable": false,
          "rotateX": 600,
          "rotateY": 1200
        }
      }
    },
    "interactivity": {
      "detect_on": "canvas",
      "events": {
        "onhover": {
          "enable": true,
          "mode": "repulse"
        },
        "onclick": {
          "enable": true,
          "mode": "push"
        },
        "resize": true
      },
      "modes": {
        "grab": {
          "distance": 400,
          "line_linked": {
            "opacity": 1
          }
        },
        "bubble": {
          "distance": 400,
          "size": 40,
          "duration": 2,
          "opacity": 8,
          "speed": 3
        },
        "repulse": {
          "distance": 200
        },
        "push": {
          "particles_nb": 4
        },
        "remove": {
          "particles_nb": 2
        }
      }
    },
    "retina_detect": true,
    "config_demo": {
      "hide_card": false,
      "background_color": "#b61924",
      "background_image": "",
      "background_position": "50% 50%",
      "background_repeat": "no-repeat",
      "background_size": "cover"
    }
  }

);
</script>
<script type="text/javascript">
	$('#alert_close').click(function(){
    $( "#alert_box" ).fadeOut( "slow", function() {
    });
  }); 
</script>
<script src="<?php echo _SCRIPTS ?>d3.js"></script>
<script src="<?php echo _SCRIPTS ?>getmdl-select.min.js"></script>
<script src="<?php echo _SCRIPTS ?>material.js"></script>
<script src="<?php echo _SCRIPTS ?>materialize.js"></script>
<script src="<?php echo _SCRIPTS ?>nv.d3.js"></script>
</div>
</body>
</div>
</html>