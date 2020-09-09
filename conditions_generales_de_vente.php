<?php
 require_once('includes/header.php');


?>
<head>
	<style type="text/css">
          body{  background: url("style/cgvAZD.png") no-repeat; background-size: 100%;}
          
        </style>
         <link rel="icon" type="image/x-icon" href="style/1111.png">
	<title>C.G.V</title>
  <meta charset="utf-8">
</head>
<br/>
<h1>Conditions générales de vente </h1>
  </br></br>
<ul  style="font-size: 20px;font-family: Britannic Bold">
<li>Site web 100% sécurisé
<li>Livraison rapide en 2-3 jours
<li>Plus de 5,000,000 clients satisfaits
<li>Garantie de remboursement sous 7 jours
<li>Garantie de remplacement sous 15 jours
<li>100% prix le plus bas garanti
</ul>

   <div id="main-slider">
  <div class="slider-wrapper">
    <img src="style/mangeoire-pour-oiseau-design-eva-solo-bird-standing.jpg" alt="First" class="slide" />
    <img src="style/838_gettyimages-1194700824.jpg" alt="Second" class="slide" />
    <img src="style/faire-ses-besoins-sur-commande.jpg" alt="Third" class="slide" />
    <img src="style/Sauvons-les-oiseaux.jpg" alt="forth" class="slide" />
  </div>
</div>  
<style type="text/css">
  html,body {
  margin: 0;
  padding: 0;
}
.slider {
  width: 500px;
  margin: 2em auto;
  border-radius: 10px;
  
}

.slider-wrapper {
  width: 800px;
  height: 300px;
  position:relative;
    border-radius: 10px;
}

.slide {
	margin-left: 500px; margin-top: -280px;
  float: right;
  position: absolute;
  width: 100%;
  height: 100%;
  opacity: 0;
  transition: opacity 3s linear;
    border-radius: 10px;
}

.slider-wrapper > .slide:first-child {
  opacity: 1;
}

</style>
<script type="text/javascript">
  (function() {
  
  function Slideshow( element ) {
    this.el = document.querySelector( element );
    this.init();
  }
  
  Slideshow.prototype = {
    init: function() {
      this.wrapper = this.el.querySelector( ".slider-wrapper" );
      this.slides = this.el.querySelectorAll( ".slide" );
      this.previous = this.el.querySelector( ".slider-previous" );
      this.next = this.el.querySelector( ".slider-next" );
      this.index = 0;
      this.total = this.slides.length;
      this.timer = null;
      
      this.action();
      this.stopStart(); 
    },
    _slideTo: function( slide ) {
      var currentSlide = this.slides[slide];
      currentSlide.style.opacity = 1;
      
      for( var i = 0; i < this.slides.length; i++ ) {
        var slide = this.slides[i];
        if( slide !== currentSlide ) {
          slide.style.opacity = 0;
        }
      }
    },
    action: function() {
      var self = this;
      self.timer = setInterval(function() {
        self.index++;
        if( self.index == self.slides.length ) {
          self.index = 0;
        }
        self._slideTo( self.index );
        
      }, 3000);
    },
    stopStart: function() {
      var self = this;
      self.el.addEventListener( "mouseover", function() {
        clearInterval( self.timer );
        self.timer = null;
        
      }, false);
      self.el.addEventListener( "mouseout", function() {
        self.action();
        
      }, false);
    }
    
    
  };
  
  document.addEventListener( "DOMContentLoaded", function() {
    
    var slider = new Slideshow( "#main-slider" );
    
  });
  
  
})();

</script>


<?php

require_once('includes/footer.php');

?>