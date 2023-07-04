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
            <th scope="col">Dettagli</th>
            <th scope="col">Edit</th>
          </tr>
        </thead>
        
        <tbody>
          @foreach($trashedInvoices as $invoice)
            <tr>
              <th scope="row">{{$invoice->number}}</th>
              <td>{{$invoice->paid ? 'yes' : 'no'}}</td>
              <td>{{$invoice->issue_date}}</td>
              <td>{{$invoice->collection_date}}</td>
              <td>{{$invoice->buyer_name}}</td>
              <td>{{$invoice->buyer_surname}}</td>
              <td>{{$invoice->buyer_street}}</td>
              <td>{{$invoice->amount}} $</td>
              <td>
                <form class="d-inline-block" method="POST" action="{{ route('invoices.harddelete', ['invoice' => $invoice->id]) }}">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger hard_delete">Hard Delete</button>
                </form>
              </td>
              <td>
                <form class="d-inline-block" method="POST" action="{{ route('invoices.restore', ['invoice' => $invoice->id]) }}">
                    @csrf
                    <button class="btn btn-warning">Restore</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $trashedInvoices->links() }}
@endsection