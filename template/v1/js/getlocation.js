$(document).ready(function(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);
    }else{ 
        alert('Geolocation is not supported by this browser.');
    }
});

function showLocation(position){
    var uri = _uri;
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    $.ajax({
        type:'POST',
        url:`${uri}/frontend/v1/beranda/update_location_visitor`,
        data: {
           latitude: latitude,
           longitude: longitude 
        },
        dataType: 'json',
        success:function(res){
            if(res.status){
               console.log("Location :", res.pesan);
            }else{
                console.log('Not Available');
            }
        }
    });
}