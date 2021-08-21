// Image Preview
function readURL(input, $element) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $($element).attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}
renderHtmlFromUrl();
function renderHtmlFromUrl() 
{
  $template_container = `<div id="snippet-link" data-url="${$url}"></div>`;
  $url = $("#snippet-link").attr('data-url');
  if($url != '') {
    $.getJSON(`${_uri}/frontend/v1/post_list/render_html`, {url: $url}, function(response) {
      $template_inner = ` 
        <div class="p-2 border my-2 mx-0">
          <b class="text-danger">Baca Juga :</b> <a href="${$url}" target="self">${response.title}</a>
        </div>
       `;
       $template_container.html($template_inner);
    });
  }
}