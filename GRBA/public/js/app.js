$(document).ready(function(){
	$('.your-class').slick({
	  dots: true,
	infinite: false,
	speed: 300,
	slidesToShow: 4,
	slidesToScroll: 4,
	responsive: [
	  {
		breakpoint: 1424,
		settings: {
		  slidesToShow: 3,
		  slidesToScroll: 3,
		  infinite: true,
		  dots: true
		}
	  },
	  {
		breakpoint: 1100,
		settings: {
		  slidesToShow: 2,
		  slidesToScroll: 2
		}
	  },
	  {
		breakpoint: 800,
		settings: {
		  slidesToShow: 1,
		  slidesToScroll: 1
		}
	  }
	  // You can unslick at a given breakpoint now by adding:
	  // settings: "unslick"
	  // instead of a settings object
	]
	});
  }); 
  
  $(function(){ 

	$("#filtro").keyup(function(){
	  var texto = $(this).val();
	  
	  $(".bloc").each(function(){
		var resultado = $(this).text().toUpperCase().indexOf(' '+texto.toUpperCase());
		
		if(resultado < 0) {
		  $(this).fadeOut();
		}else {
		  $(this).fadeIn();
		}
	  }); 
  
	});
  
  });

  var btn = $('#top');

  $(window).scroll(function() {
	if ($(window).scrollTop() > 300) {
	  btn.addClass('show');
	} else {
	  btn.removeClass('show');
	}
  });
  
  btn.on('click', function(e) {
	e.preventDefault();
	$('html, body').animate({scrollTop:0}, '300');
  });
  
  