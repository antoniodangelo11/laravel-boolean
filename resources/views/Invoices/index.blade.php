@extends('layout.base')

@section('content')
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Number</th>
        <th scope="col">Paid</th>
        <th scope="col">Issue date</th>
        <th scope="col">Collection date</th>
        <th scope="col">Buyer name</th>
        <th scope="col">Buyer surname</th>
        <th scope="col">Buyer street</th>
        <th scope="col">Amount</th>
        <th scope="col">Details</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    
    <tbody>
      @foreach($invoices as $invoice)
        <tr>
          <th scope="row">{{$invoice->number}}</th>
          <td>{{$invoice->paid ? 'yes' : 'no'}}</td>
          <td>{{$invoice->issue_date}}</td>
          <td>{{$invoice->collection_date}}</td>
          <td>{{$invoice->buyer_name}}</td>
          <td>{{$invoice->buyer_surname}}</td>
          <td>{{$invoice->buyer_street}}</td>
          <td>{{$invoice->amount}} $</td>
          <td><a href="{{route('invoices.show', ['invoice' => $invoice->id])}}" class="btn btn-primary">Mostra</a></td>
          <td><a href="{{route('invoices.edit', ['invoice' => $invoice->id])}}" class="btn btn-warning">Edit</a></td>
          <td>
            <form class="d-inline-block" method="POST" action="{{ route('invoices.destroy', ['invoice' => $invoice->id]) }}">
              @csrf
              @method('delete')
              <button class="btn btn-danger">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {{ $invoices->links() }}
@endsection