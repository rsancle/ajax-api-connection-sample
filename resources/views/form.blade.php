<div id="result">

</div>
<form id="idForm" class="form">

    <div class="form-group">
        <label for="shipment_code">{{ __('Introduce del còdigo de seguimiento') }}</label>
        <input id="shipment_code" name="shipment_code" type="text" class="form-control">
    </div>
    <button id="formButton" class="btn btn-primary">{{ __('Enviar') }}</button>
</form>

<script>
    //load script when document is ready
    $(document).ready(function(){

        //Click on submit button event
        $("#formButton").click(function(e) {
            //avoid default event
            e.preventDefault();
            //laravel route
            const url = '{{ route('send-shipment-code') }}';
            const shipment_code = $('#shipment_code').val();
            //add laravel form header (using csrf-token)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //send data by ajax
            $.ajax({
                type: "POST",
                url: url,
                data: { shipment_code: shipment_code },
                success: function(data)
                {
                    $('#result').empty();
                    $('#result').append(data.view);
                },
            });
        });
    });
</script>