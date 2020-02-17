$(document).ready(function() {
  $('#box').keyup(function() {
    var search = this.value.toLowerCase();
    //console.log(search);
    $('div', '.searchElement').each(function(index) {
      
      var pID = $(this).attr('id');
      console.log(pID);
      var text = document.getElementsByClassName("searchElement")[index].innerHTML;
      var textL = text.toLowerCase();
      var textLp = textL.substring(textL.indexOf(":") + 1);
      var textLp2 = textLp.split('<')[0];
     // console.log(textLp2);
      if (textLp2.indexOf(search) >= 0) {
        $('#' + pID).show();
      } else {
        $('#' + pID).hide();
      }
    });
  })
});