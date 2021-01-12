$(document).ready(function () {
  $(".lazy").lazy({
    threshold: 0,
    beforeLoad: function (element) {
      // var imageSrc = element.data('src');
      element.addClass('beforeLoaded');
    },
    afterLoad: function (element) {
      // var imageSrc = element.data('src');
      element.addClass('isLoaded').removeClass('lazy beforeLoaded');
    },
  });
});