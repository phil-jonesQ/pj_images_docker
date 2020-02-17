var slideIndex;
var timer;
var slideTime;

function setup() {
  slideIndex = 1;
  timer = 0;
  slideTime=1000;
  showSlides(slideIndex);
}


//PS5.js infinite loop

function draw() {
	timer++;
	//console.log(timer);
	if (timer > slideTime) {
		showSlides(slideIndex += 1); //Increment slide display automatically based on timer
		timer=0;
	}
	
}

function plusSlides(n) {
  showSlides(slideIndex += n);
  this.timer=0; //reset timer if user selected image
}

function currentSlide(n) {
  showSlides(slideIndex = n);
  this.timer=0; //reset timer if user selected image
}

function showSlides(n) {
  var i; //Increment
  var slides = document.getElementsByClassName("mySlides"); //Get the slides
  var dots = document.getElementsByClassName("dot"); //Get the buttons
  if (n > slides.length) {slideIndex = 1} // wrap around
  if (n < 1) {slideIndex = slides.length} // wrap around
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"; //display slide
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", ""); //replace slide
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";

}
