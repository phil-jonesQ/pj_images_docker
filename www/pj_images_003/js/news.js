(function($) {
  $.fn.list_ticker = function(options) {

    var defaults = {
      speed: 8000,
      effect: 'slide',
      run_once: true,
      random: true
    };

    var options = $.extend(defaults, options);

    return this.each(function() {

      var obj = $(this);
      var list = obj.children();
      var count = list.length - 1;

      list.not(':first').hide();

      var interval = setInterval(function() {

        list = obj.children();
        list.not(':first').hide();

        var first_li = list.eq(0)
        var second_li = options.random ? list.eq(Math.floor(Math.random() * list.length)) : list.eq(1)

        if (first_li.get(0) === second_li.get(0) && options.random) {
          second_li = list.eq(Math.floor(Math.random() * list.length));
        }
        first_li.fadeOut(function() {
          obj.css('height', second_li.height());
          second_li.fadeIn(0);
          first_li.remove().appendTo(obj);
        });

        count--;
        console.log("count is " +count);

	$( ".lines" ).click(function() {
  	   console.log("Clicked... and");
	   first_li.fadeOut(function() {
	   list.not(':first').hide();
           obj.css('height', second_li.height());
           second_li.fadeIn(0);
           first_li.remove().appendTo(obj);
        });	   
	});

	
        if (count == 0 && options.run_once) {
          clearInterval(interval);
        }

      }, 8000)
    });
  };
})(jQuery);


$('.lines').list_ticker({
  speed: 80,
  effect: "slide"
});


// TNewsAPI.org API url used to get the JSON data frpm file on server side

$.getJSON("/includes/news.json", function(json) {
  var i;
  for (i = 0; i < json.articles.length; i++) {
    //Fetch title
    var title = json.articles[i].title;

    //Fetch description
    var description = json.articles[i].description;

    //Fetch URL
    var articleURL = json.articles[i].url;
    //console.log("Article URLs: " + articleURL);

    //Override HTML text 
    $('#ArticleTitle' + i).html('').append('<li><a href="'+articleURL+'">'+title+'</li>');
    console.log("override article number " + i);
       
  }

});