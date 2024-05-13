@extends('layouts.app')
  
  
@section('contents')
   

  <div class="site-content">
      <!-- INJECT ME WITH CONTENT!!!! -->
    <div id="invoice-header" class="invoice-header">
      <div class="invoice-header-wrapper">
        <div class="invoice-header-container">
          <h2 class="invoice-header-title__title">Invoices</h2>
          <p class="invoice-header-title__amt"><span>@if ($invoices->count() > 1)  There are {{ $invoices->count() }} total Invoices
@elseif ($invoices->count() === 1) There is {{ $invoices->count() }} total Invoice
@else  No Invoices </span> 
@endif</p>
        </div>

        
        <div class="invoice-header-filter-container">
    <a href="#" id="filter-dropdown-toggle" style="text-decoration: none;">
        <h3>Filter <span class="invoice-header-span">by status</span><img id="filter-dropdown-arrow" src="{{ asset('assets/icon-arrow-down.svg') }}" alt="arrow"></h3>
    </a>
    <div class="dropdown-container" id="filter-dropdown">
        <div class="dropdown">
            <div class="dropdown-content">
                <div class="checkbox-container">
                    <input class="filter-checkbox" id="draft-check" type="checkbox" name="draft-check" onclick="filterInvoices(this, 'Draft')">
                    <label for="draft-check">Draft</label>
                </div>
                <div class="checkbox-container">
                    <input class="filter-checkbox" id="draft-pending" type="checkbox" name="draft-pending" onclick="filterInvoices(this, 'Pending')">
                    <label for="draft-pending">Pending</label>
                </div>
                <div class="checkbox-container">
                    <input class="filter-checkbox" id="draft-paid" type="checkbox" name="draft-paid" onclick="filterInvoices(this, 'Paid')">
                    <label for="draft-paid">Paid</label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="invoice-header-button-container">
        <a href="{{ route('invoice.create') }}" class="btn btn-1" style="text-decoration: none;">
  <span>+</span>New Invoice
</a>

        </div>
  </div></div>

          @if(session('success'))
              <div class="alert alert-success" style="background-color: #ffffff; text-align: center;">
                  {{ session('success') }}
              </div>
          @endif

          @if($invoices->count() > 0)
          @foreach($invoices as $rs)
            <a href="{{ route('invoice.show', $rs->id) }}" style="text-decoration: none;">
            <div class="single-invoice" >
              <h2  class="single-invoice__id show_invoice"><span>#</span>{{ $rs['invoice_id'] }}</h2>
              <p  class="single-invoice__date show_invoice">Due {{ $rs['paymentDue'] }}</p>
              <p  class="single-invoice__vendor-name show_invoice">{{ $rs['clientName'] }}</p>
              <h3  class="single-invoice__amt show_invoice">${{ $rs['total'] ?? 0.00}}</h3>
              <p  class="single-invoice__status {{ $rs['status'] }}  show_invoice">{{ $rs['status'] }}</p>
          </div></a>
          @endforeach

        @else
          <div class="pt-5"></div>
          <div id="no-items" class="no-items-container pt-5">
            <div class="no-items-msg">
              <img src="{{ asset('assets/illustration-empty.svg') }}" alt="empty">
              <h2>There Is Nothing Here</h2>
              <p>Create an invoice by clicking the <span>New </span>button to get started</p>
            </div>
          </div>
        @endif

    </div>

  </div>
  @endsection