// $(document).ready(function () {
// 	$(".menu ul.list li a").on('click', function (e) {
// 		e.preventDefault();
// 		var _init = $(this);
// 		var _link = _init.attr('data-href');
// 		var container = $("body");
// 		if (_link != 'javascript:void(0);' ? _link : '#');
// 		$.ajax({
// 			url: _link,
// 			method: 'POST',
// 			dataType: 'HTML',
// 			cache: false,
// 			contantType: false,
// 			processData: false,
// 			success: function (r) {
// 				window.history.pushState({}, 'title', _link);
// 				// container.fadeIn('slow');
// 				container.load(_link + '?sid=' + Math.random(), true);
// 			}
// 		});
// 	});
// });
