// JS file for show elder list both admin and officer.
  
  $(document).ready(function(){

      //load_data(1);

      var search = $('#search').val();
      var dateFrom = $('#dateFrom').val();
      var dateTo = $('#dateTo').val();
      var status = $('#searchStatus').val();

      load_data(1, search, dateFrom, dateTo, status);


    function load_data(page, search = '', dateFrom='', dateTo ='', status = '')
    {
      $.ajax({
        url:"ajax/user-list.php",
        method:"POST",
        dataType: "json",
        data:{page:page, search:search, dateFrom:dateFrom, dateTo:dateTo, status:status},
        success:function(response)
        {
          if( response.status === "success" ){
            $('#data_about').text(response.data);
            $('#job_list').html(response.output);
          }
          
        }
      });
    }


    // nav link click
    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var search = $('#search').val();
      var dateFrom = $('#dateFrom').val();
      var dateTo = $('#dateTo').val();
      var status = $('#searchStatus').val();
      load_data(page, search, dateFrom, dateTo, status);
    });

    // search box change
    $('#search').keyup(function(){
      var search = $('#search').val();
      var dateFrom = $('#dateFrom').val();
      var dateTo = $('#dateTo').val();
      var status = $('#searchStatus').val();
      load_data(1, search, dateFrom, dateTo, status);
    });

    // dd dateFrom change
    $('#dateFrom').change(function(){
      var search = $('#search').val();
      var dateFrom = $('#dateFrom').val();
      var dateTo = $('#dateTo').val();
      var status = $('#searchStatus').val();
      load_data(1, search, dateFrom, dateTo, status);
    });

    // dd dateTo change
    $('#dateTo').change(function(){
      var search = $('#search').val();
      var dateFrom = $('#dateFrom').val();
      var dateTo = $('#dateTo').val();
      var status = $('#searchStatus').val();
      load_data(1, search, dateFrom, dateTo, status);
    });

    // dd searchStatus change
    $('#searchStatus').change(function(){
      var search = $('#search').val();
      var dateFrom = $('#dateFrom').val();
      var dateTo = $('#dateTo').val();
      var status = $('#searchStatus').val();
      load_data(1, search, dateFrom, dateTo, status);
    });

    $(document).on('click', '#search_reset', function(){
      $('#search').val('').trigger('change');
      $('#dateFrom').val('').trigger('change');
      $('#dateTo').val('').trigger('change');
      $('#searchStatus').val('').trigger('change');
      load_data(1);
    });

  });
