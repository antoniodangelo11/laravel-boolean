<?php

namespace App\Http\Controllers\Guest;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    private $validation = [
        'number' => 'integer',
        'paid' => 'boolean',
        'issue_date' => 'date',
        'collection_date' => 'date',
        'buyer_name' => 'string|max:50',
        'buyer_surname' => 'string|max:50',
        'buyer_street' => 'string',
        'amount' => 'decimal:2',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $invoices = Invoice::paginate(20);
        // $comics = Comic::all();  // SELECT * FROM `comics`
        // dd($comics)
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validation);

        $data = $request->all(); //estrae i dati inseriti nel form e li inserisce in un array associativo

        // salvare i dati nel database

        $newInvoice = new Invoice();

        $newInvoice->number = $data['number'];
        $newInvoice->paid = $data['paid'];
        $newInvoice->issue_date = $data['issue_date'];
        $newInvoice->collection_date = $data['collection_date'];
        $newInvoice->buyer_name = $data['buyer_name'];
        $newInvoice->buyer_surname = $data['buyer_surname'];
        $newInvoice->buyer_street = $data['buyer_street'];
        $newInvoice->amount = $data['amount'];

        $newInvoice->save();

        return redirect()->route('invoices.show', ['invoice' => $newInvoice->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
        return view('invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
        $request->validate($this->validation);

        $data = $request->all();


        //aggiornare i dati nel database

        $invoice->number = $data['number'];
        $invoice->paid = $data['paid'];
        $invoice->issue_date = $data['issue_date'];
        $invoice->collection_date = $data['collection_date'];
        $invoice->buyer_name = $data['buyer_name'];
        $invoice->buyer_surname = $data['buyer_surname'];
        $invoice->buyer_street = $data['buyer_street'];
        $invoice->amount = $data['amount'];

        $invoice->update();

        return to_route('invoices.show', ['invoice' => $invoice->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return to_route('invoices.index')->with('delete_success', $invoice);
    }

    public function restore($id)
    {
        Invoice::withTrashed()->where('id', $id)->restore();

        $invoice = Invoice::find($id);

        return to_route('invoices.index')->with('restore_success', $invoice);
    }

    public function trashed()
    {
        $trashedInvoices = Invoice::onlyTrashed()->paginate(6);

        return view('invoices.trashed', compact('trashedInvoices'));
    }

    public function harddelete($id)
    {
        $invoice = Invoice::withTrashed()->find($id);
        $invoice->forceDelete();

        return to_route('invoices.trashed')->with('delete_success', $invoice);
    }
}
