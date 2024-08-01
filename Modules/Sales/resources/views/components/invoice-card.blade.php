@props(['invoice' => $invoice])
<div class="card">
    <div class="card-body">
        <div class="row">
            @php
                $company = app(\App\Settings\CompanySettings::class);
            @endphp
            <div class="col-sm-6 m-b-20">
                <img src="{{ appLogo() }}" class="inv-logo" alt="Logo">
                 <ul class="list-unstyled">
                    <li>{{ $company->name }}</li>
                    <li>{{ $company->address }}</li>
                    <li>{{ !empty($company->city) ? $company->city.' , ':'' }}{{ !empty($company->province) ? $company->province.' ,' :''.$company->postal_code}}</li>
                </ul>
            </div>
            <div class="col-sm-6 m-b-20">
                <div class="invoice-details">
                    <h3 class="text-uppercase">{{ __('Invoice') }} {{ $invoice->inv_id }}</h3>
                    <ul class="list-unstyled">
                        <li>{{ __('Create Date') }}: <span>{{ format_date($invoice->created_at) }}</span></li>
                        <li>{{ __('Start Date') }}: <span>{{ format_date($invoice->startDate) }}</span></li>
                        <li>{{ __('Expiry date') }}: <span>{{ format_date($invoice->expiryDate) }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-12 m-b-20">
                <h5>{{ __('Invoice to') }}:</h5>
                @php
                    $client = $invoice->client;
                @endphp
                 <ul class="list-unstyled">
                    <li><h5><strong>{{ $client->fullname }}</strong></h5></li>
                    <li>{{ $client->address }}</li>
                    <li>
                        {!! $invoice->client_address !!}
                    </li>
                    <li>
                        {!! $invoice->billing_address !!}
                    </li>
                    <li>{{ $client->phoneNumber }}</li>
                    <li><a href="@can('show-Clientprofile') {{ route('clients.show',['client' => \Crypt::encrypt($client->id)]) }} @else # @endcan">{{ $client->email }}</a></li>
                </ul>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('ITEM') }}</th>
                    <th class="d-none d-sm-table-cell">{{ __('DESCRIPTION') }}</th>
                    <th>{{ __('UNIT COST') }}</th>
                    <th>{{ __('QUANTITY') }}</th>
                    <th class="text-end">{{ __('TOTAL') }}</th>
                </tr>
            </thead>
            <tbody>
                
                @if (!empty($invoice->items) && $invoice->items->count() > 0)
                    @foreach ($invoice->items as $i => $item)
                    <tr>
                        <td>{{ ++$i}}</td>
                        <td>{{ $item->name }}</td>
                        <td class="d-none d-sm-table-cell">
                            {{ $item->description }}
                        </td>
                        <td>{{ LocaleSettings('currency_symbol') }} {{ $item->unit_cost }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td class="text-end">{{ LocaleSettings('currency_symbol') }} {{ $item->total }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div>
            <div class="row invoice-payment">
                <div class="col-sm-7">
                </div>
                <div class="col-sm-5">
                    <div class="m-b-20">
                        <div class="table-responsive no-border">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>{{ __('Subtotal') }}:</th>
                                        <td class="text-end">{{ LocaleSettings('currency_symbol') }} {{ $invoice->subtotal }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Tax') }}: <span class="text-regular">({{ $invoice->tax->percentage }}%)</span></th>
                                        <td class="text-end">{{ LocaleSettings('currency_symbol') }}{{ $invoice->tax_amount }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Discount') }}: <span class="text-regular">({{ $invoice->discount }}%)</span></th>
                                        <td class="text-end">{{ LocaleSettings('currency_symbol') }}{{ $invoice->discount }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td class="text-end text-primary"><h5>{{ LocaleSettings('currency_symbol') }} {{ $invoice->grand_total }}</h5></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="invoice-info">
                <h5>{{ __('Other information') }}</h5>
                <p class="text-muted">
                    {{ $invoice->note }}
                </p>
            </div>
        </div>
    </div>
</div>