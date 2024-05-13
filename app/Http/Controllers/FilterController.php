<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Items;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index($status = null)
    {
        // If there's a status filter applied, filter the invoices by that status
        if ($status) {
            $invoices = Invoice::with('items')->where('status', $status)->orderBy('created_at', 'DESC')->get();
        } else {
            // If no status filter is applied, load all invoices without filtering
            $invoices = Invoice::with('items')->orderBy('created_at', 'DESC')->get();
        }
    
        // Pass the invoices and status to the view
        return view('welcome', compact('invoices', 'status'));
    }
    
}
