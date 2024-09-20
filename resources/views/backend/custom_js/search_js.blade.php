<script>

    // Search Form Request to Controller and Receive Result
    function search_func() {
        var query = $('#search_query').val();

        $.ajax({
            type: "get",
            url: "",
            data: {
                "_token": "{{ csrf_token() }}",
                query: query
            },
            success:function(response) {
                if (response.success) {

                    $('.search_result').empty();
                    $('.search_result').html(response.code);
                }
            }
        })
    }
    function searchForDriver() {
        var query = $('#search_query_driver').val();

        $.ajax({
            type: "get",
            url: "",
            data: {
                "_token": "{{ csrf_token() }}",
                query: query
            },
            success:function(response) {
                if (response.success) {

                    $('.search_result_driver').empty();
                    $('.search_result_driver').html(response.code);
                }
            }
        })
    }

</script>
