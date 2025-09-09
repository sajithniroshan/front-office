  $(document).ready(function(){

  	var gn_id = $('#gn').val();
  	var village_hidden = $('#village_hidden').val();

  	load_village(gn_id, village_hidden);

  	function load_village(gn_id ='', village_hidden = '')
    {
      $.ajax({
        url:"ajax/set-village.php",
        method:"POST",
        data:{gn_id:gn_id, village_hidden:village_hidden},
        success:function(data)
        {
          $('#village').html(data);
        }
      });
    }


    $('#gn').change(function(){

      var gn_id = $('#gn').val();
      load_village(gn_id);
      
    });

  

  });