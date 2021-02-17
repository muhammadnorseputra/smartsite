$(document).ready(function() {

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
        href: `${_uri}/frontend/v1/pegawai/detail?filter[query]={{nip}}`,
        source: {
            pegawai: {
                display: ["nip"],
                ajax: function(query) {
                    return {
                        type: "POST",
                        url: "http://silka.bkppd-balangankab.info/api/filternipnama",
                        dataType: "jsonp",
                        crossDomain: true,
                        async: true,
                        data: {
                            q: "{{query}}",
                        }
                    }
                }
            }
        },
        callback: {
            onClickAfter: function(node, a, item, event) {
                event.preventDefault();
                window.open(item.href, '_self');
            },
        }
    });
})