$(document).ready(function() {
// $(".js-nipnama").mask('00000000 000000 0 000');
                       // 19610202 199003 1 014
$.typeahead({
    input: '.js-nipnama',
    minLength: 12,
    maxLength: false,
    order: "asc",
    maxItem: 1,
    cache: false,
    offset: false,
    hint: true,
    searchOnFocus: true,
    dynamic: true,
    delay: 500,
    backdrop: {
        "background-color": "#000"
    },
    emptyTemplate: "Data PNS \"<b>{{query}}</b>\" tidak ditemukan ",
    debug: true,
    template: function(item) {
    	return `<span class='mr-3 pull-left'><img class='img-rounded' src='{{photo}}' width='30' alt='{{nama}}'></span> {{nama}} - {{nip}}`;
    	// return `{{nip}} - {{nama}}`;
    },
    source: {
        pegawai: {
        	display: ["nip"],
            ajax: function (query) {
            	return {
	                type: "POST",
	                url: "http://silka.bkppd-balangankab.info/api/filternipnama",
					dataType: "json",
					data: {
			 			q: "{{query}}",
					}
				}
            }
        }
    }
});
})