@extends('currency::app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Kursy Walut') }}</div>

                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach($currencies as $currency)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @once active @endonce" id="{{ $currency->code }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $currency->code }}" type="button" role="tab" aria-controls="{{ $currency->code }}" aria-selected="true">{{ $currency->code }}</button>
                        </li>
                        @endforeach
                        
                      </ul>
                      <div class="tab-content pt-3" id="myTabContent">
                        @foreach($currencies as $currency)
                        <div class="tab-pane fade show @once active @endonce" id="{{ $currency->code }}" role="tabpanel" aria-labelledby="{{ $currency->code }}-tab">
                            <div class="row">
                                @foreach($headers as $header)
                                    <div class="col h5 text-uppercase">{{ $header }}</div>
                                @endforeach
                            </div>
                            <hr>    
                            @foreach($currency->details as $detail)
                                <div class="row">
                                    <div class="col">
                                        {{ $detail->date }}
                                    </div>
                                    <div class="col">
                                        {{ $detail->mid }}
                                    </div>
                                    <div class="col">
                                        {{ $detail->bid }}
                                    </div>
                                    <div class="col">
                                        {{ $detail->ask }}
                                    </div>
                                </div>
                                @endforeach
                            
                        </div>
                        @endforeach

                      </div>
                    
                
                </div>
            </div>
        </div>
    </div>
</div>
@stop