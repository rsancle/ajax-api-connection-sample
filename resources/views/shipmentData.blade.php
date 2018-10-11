@if(isset($shipmentData))
    <div class="alert alert-success" role="alert">
        <ul>
            <li><strong>{{ __('Empresa') }}:</strong> {{ $shipmentData->carrierName }}</li>
            <li><strong>{{ __('Origen') }}:</strong> {{ $shipmentData->from['name'] }}</li>
            <li><strong>{{ __('Destino') }}:</strong> {{ $shipmentData->to['name'] }}</li>
            <li><strong>{{ __('Fecha de envío') }}:</strong> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $shipmentData->shippingDate)->format('d-m-Y') }}</li>

        </ul>
    </div>
@endif