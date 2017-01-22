var site = window.location.hostname;
var address = {};

$(function () {

  $('#find-address').click(function(){
      var postcode = $('input[name=postcode]').val();
      $.ajax({
        url: '/houses/ajax/address',
        method: 'GET',
        data: {'postcode':postcode},
        success : function(data){
          address = JSON.parse(data);
          if(address.Message){
            $('.modal-body').append(address.Message);
          }else{
            var select = document.getElementById('addresses');
            select.innerHTML = '';
            $.each(address.Addresses, function(index, value){
              var option = document.createElement('option');
              option.text = value;
              option.value = index;
              select.add(option);
            });
          }
          $('#myModal').modal('toggle');
        },
        error : function(data, error){
          console.log(data, error);
        }
      })
  });

  $('#set-address').click(function(){
    add = address.Addresses[$('#addresses').val()];
    addParts = add.split(',');
    console.log(address);
    $('input[name=lat]').val(address.Latitude);
    $('input[name=lng]').val(address.Longitude);
    $('input[name=address_first_line]').val(addParts[0]);
    $('input[name=address_second_line]').val(addParts[1]);
    $('input[name=address_third_line]').val(addParts[2]);
    $('input[name=address_town]').val(addParts[5]);
    $('input[name=address_county]').val(addParts[6]);
  });
});
