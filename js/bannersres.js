$(document).ready(function(){
  $('#carousel').carouFredSel({
      circular: false,
      infinite: true,
      responsive: true,
      items: {
        visible: 1,
        width: 698,
        height: 200
      },
      scroll: {
        duration: 550,
        timeoutDuration: 4200,
        fx: 'undercover',
        easing: "linear",
      },
      swipe: {
        onTouch: true,
        items: 1
      }
  });
});