// Mengijinkan cors origin dari https ke http
if (window.location.protocol.indexOf('https') == 0) {
    var el = document.createElement('meta')
    el.setAttribute('http-equiv', 'Content-Security-Policy')
    el.setAttribute('content', 'upgrade-insecure-requests')
    document.head.append(el)
}

// Uri Segement
var _uri = `${window.location.origin}/smartsite`;
var _uriSegment = window.location.pathname.split('/');