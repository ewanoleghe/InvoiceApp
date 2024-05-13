<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Items $items)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Items $items)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Items $items)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */

        public function destroy(Request $request, $id)
        {
            // Find the item
            $item = Items::findOrFail($id);
            
            // Get the invoice ID from the request
            $invoiceId = $request->input('invoice_id');

            // Delete the item
            $item->delete();

            // Redirect back to the edit page of the specific invoice
            return redirect()->route('invoice.edit', $invoiceId);
        }



    
}
