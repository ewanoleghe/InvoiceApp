<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Items;
use Illuminate\Http\Request;
// use Illuminate\Support\Str;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * e
     */
    public function index()
    {
        $invoices = Invoice::with('Items')->orderBy('created_at', 'DESC')->get();
    
        return view('welcome', compact('invoices'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $invoices = Invoice::with('Items')->orderBy('created_at', 'DESC')->get();
    
        return view('invoice.create', compact('invoices'));
        //return view('invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Determine the action from the hidden input field
        $action = $request->input('action');

        // Initialize an array to hold fields to be saved without validation
        $fieldsToSaveWithoutValidation = [];

        // If action is "saveasdraft", set 'createdAt' to current date
        if ($action === 'saveasdraft') {
            $fieldsToSaveWithoutValidation['createdAt'] = now();
        } else {
            // Validate the incoming request data conditionally based on action
            $validatedData = $request->validate([
                'createdAt' => 'required|date',
                'description' => 'required|string',
                'paymentTerms' => 'required|integer',
                'clientName' => 'required|string',
                'clientEmail' => 'required|email',
                'senderAddress_street' => 'required|string',
                'senderAddress_city' => 'required|string',
                'senderAddress_postCode' => 'required|string',
                'senderAddress_country' => 'required|string',
                'clientAddress_street' => 'required|string',
                'clientAddress_city' => 'required|string',
                'clientAddress_postCode' => 'required|string',
                'clientAddress_country' => 'required|string',
                // Add more validation rules as needed...
            ]);
            
            // Assign validated data to the invoice model instance
            $fieldsToSaveWithoutValidation = $validatedData;
        }

        // Create a new Invoice instance
        $invoice = new Invoice($fieldsToSaveWithoutValidation);

        // Set status based on the action
        $invoice->status = ($action === 'saveasdraft') ? 'draft' : 'pending';

        // Calculate 'paymentDue' date based on 'createdAt' and 'paymentTerms'
        $paymentDueDate = date('Y-m-d', strtotime($invoice->createdAt . ' +' . $invoice->paymentTerms . ' days'));
        $invoice->paymentDue = $paymentDueDate;

        // Generate random invoice ID
        do {
            $randomLetters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2); // Generate 2 random uppercase letters
            $randomNumbers = rand(1000, 9999); // Generate 4 random numbers
            $invoiceId = strtoupper($randomLetters . $randomNumbers);
        } while (Invoice::where('invoice_id', $invoiceId)->exists());

        $invoice->invoice_id = $invoiceId;

        // Save the invoice
        $invoice->save();

        // Calculate 'total' for invoice
        $invoiceTotal = 0;

        // Process line items
        if ($request->filled('line-item-name') && $request->filled('line-item-qty') && $request->filled('line-item-price')) {
            $lineItemNames = $request->input('line-item-name');
            $lineItemQtys = $request->input('line-item-qty');
            $lineItemPrices = $request->input('line-item-price');

            foreach ($lineItemNames as $key => $itemName) {
                $quantity = $lineItemQtys[$key];
                $price = $lineItemPrices[$key];

                // Validate item fields if not empty
                if (!empty($itemName) && $quantity > 0 && $price > 0) {
                    $total = $quantity * $price; // Calculate total for the item
                    $item = new Items([
                        'invoice_id' => $invoice->invoice_id, // Assign invoice_id from the created invoice
                        'name' => $itemName,
                        'quantity' => $quantity,
                        'price' => $price,
                        'total' => $total // Assign the calculated total to the total field
                    ]);
                    $item->save();
                    $invoiceTotal += $total; // Add item total to invoice total
                }
            }
        }

        // Update total for the invoice
        $invoice->total = $invoiceTotal;
        $invoice->save();

        // Redirect if successful
        return redirect()->route('welcome')->with('success', 'New Invoice Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $invoice_id)
    {
        // Retrieve the invoice
        $invoice = Invoice::with(['Items'])->findOrFail($invoice_id);
        
        // Return the view with the invoice data
        return view('invoice.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $invoice_id)
    {
        $invoice = Invoice::with('items')->findOrFail($invoice_id);
        return view('invoice.edit', compact('invoice'));
    }
        /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, Invoice $invoice)
    {
        // Determine the action from the hidden input field
        $action = $request->input('action');

        // Validate the incoming request data conditionally based on action
        if ($action !== 'saveasdraft') {
            $validatedData = $request->validate([
                'createdAt' => 'required|date',
                'description' => 'required|string',
                'paymentTerms' => 'required|integer',
                'clientName' => 'required|string',
                'clientEmail' => 'required|email',
                'senderAddress_street' => 'required|string',
                'senderAddress_city' => 'required|string',
                'senderAddress_postCode' => 'required|string',
                'senderAddress_country' => 'required|string',
                'clientAddress_street' => 'required|string',
                'clientAddress_city' => 'required|string',
                'clientAddress_postCode' => 'required|string',
                'clientAddress_country' => 'required|string',
                // Add more validation rules as needed...
            ]);
        } else {
            // If action is 'saveasdraft', save all values without validation
            $validatedData = $request->all();
        }

        // Update invoice fields
        $invoice->fill($validatedData);

        // Set status based on the action
        $invoice->status = ($action === 'saveasdraft') ? 'draft' : 'pending';

        // Calculate 'paymentDue' date based on 'createdAt' and 'paymentTerms'
        $paymentDueDate = date('Y-m-d', strtotime($invoice->createdAt . ' +' . $invoice->paymentTerms . ' days'));
        $invoice->paymentDue = $paymentDueDate;

        // Save the invoice
        $invoice->save();

        // Process existing line items
        if ($request->filled('line-item-id')) {
            foreach ($request->input('line-item-id') as $key => $itemId) {
                $item = Items::find($itemId);
                if ($item) {
                    // Update existing item
                    $item->name = $request->input('line-item-name')[$key];
                    $item->quantity = $request->input('line-item-qty')[$key];
                    $item->price = $request->input('line-item-price')[$key];
                    $item->total = $request->input('line-item-qty')[$key] * $request->input('line-item-price')[$key];
                    $item->save();
                } else {
                    // Create new item
                    Items::create([
                        'invoice_id' => $invoice->invoice_id, // Use invoice_id from invoices table
                        'name' => $request->input('line-item-name')[$key],
                        'quantity' => $request->input('line-item-qty')[$key],
                        'price' => $request->input('line-item-price')[$key],
                        'total' => $request->input('line-item-qty')[$key] * $request->input('line-item-price')[$key],
                    ]);
                }
            }
        }

        // Delete items that are not present in the submitted form request
        $submittedItemIds = $request->input('line-item-id');
        $itemsToDelete = null;

        // Check if $submittedItemIds is not null and has items
        if ($submittedItemIds !== null && count($submittedItemIds) > 0) {
            // Find items that are not present in the submitted form request
            $itemsToDelete = $invoice->items()->whereNotIn('id', $submittedItemIds)->pluck('id');
        }

        // If $itemsToDelete is null, delete all items in the database
        if ($itemsToDelete === null) {
            Items::where('invoice_id', $invoice->id)->delete();
        } elseif (count($itemsToDelete) > 0) {
            // Delete only items that are not present in the submitted form request
            Items::whereIn('id', $itemsToDelete)->delete();
        }

        // Calculate 'total' for the invoice
        $invoice->total = $invoice->items()->sum('total');
        $invoice->save();

        // Redirect if successful
        return redirect()->route('invoice.show', $invoice->id)->with('success', 'Invoice Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyid($id)
    {
        // Find the invoice
        $invoice = Invoice::findOrFail($id);

        // Find all items related to this invoice and delete them
        Items::where('invoice_id', $invoice->invoice_id)->delete();

        // Delete the invoice
        $invoice->delete();

        return redirect()->route('welcome')->with('success', 'Invoice and related items deleted successfully');
    }

    public function payed($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->status = 'paid';
        $invoice->save();

        return redirect()->back()->with('success', 'Invoice marked as paid successfully');
    }

    
}
