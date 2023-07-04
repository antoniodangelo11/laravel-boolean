@extends('layout.base')
@section('content')
<div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">{{$invoice->buyer_name}} {{$invoice->buyer_surname}} - {{$invoice->number}}</h5>
      <h6 class="card-subtitle mb-2 text-body-secondary">Issue date: {{$invoice->issue_date}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary">Paid: {{$invoice->paid ? 'yes' : 'no'}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary">Collection date: {{$invoice->collection_date}}</h6>
      <p class="card-text">Street location: {{$invoice->buyer_street}}</p>
      <p class="card-text">{{$invoice->amount}} $</p>
      
      {{-- <a href="#" class="card-link">Another link</a> --}}
    </div>
  </div>
@endsection