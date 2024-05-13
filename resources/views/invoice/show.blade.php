@extends('layouts.app')
  
  
@section('contents')
   

<div class="site-wrapper">

    <div class="site-content"><section id="view-single">
        <div class="view-single-wrapper">
        <div class="view-single-container">  
          <div class="single-invoice-link">
          <h3 id="redirect-home" ><span><a href="{{ route('welcome') }}" style="text-decoration: none; color: white;">
          <img src="{{ asset('assets/icon-arrow-down.svg') }}" alt="arrow"></span>Go Back</a></h3>
          </div>
          <div class="status-edit-bar flex">
            <div class="status-edit-bar__status">
              <p class="single-invoice__status--text">Status</p>
              <p class="single-invoice__status {{ $invoice->status }}">{{ $invoice->status }}</p>
            </div>
            <div class="status-edit-bar__edit flex">
                @if ($invoice->status !== 'paid')
                <a href="{{ route('invoice.edit', $invoice->id) }}" style="text-decoration: none;">
                <button id="item-edit" class="btn btn-3-dark" >Edit</button></a>
                @endif

                <form id="delete-form" action="{{ route('invoice.destroyrecord', $invoice->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                  <button type="submit" id="item-delete" class="btn btn-5-danger delete-button" style="text-align: left;">Delete</button>
              </form>

              <div id="confirmation-dialog" class="delete-wrapper" style="display: none;">
                  <div class="delete-content flex">
                      <h2>Confirm Deletion</h2>
                      <p>Are you sure you want to delete invoice <span class="delete-span-id">#{{ $invoice->invoice_id }}</span>? This action cannot be undone.</p>
                      <div class="delete-btn-container flex">
                          <button id="cancel-delete" class="btn btn-3-dark">Cancel</button>
                          <button id="confirm-delete" class="btn btn-5-danger">Delete</button>
                      </div>
                  </div>
              </div>

              <script>
                  document.addEventListener('DOMContentLoaded', function () {
                      const deleteForm = document.getElementById('delete-form');
                      const confirmationDialog = document.getElementById('confirmation-dialog');
                      const cancelDeleteButton = document.getElementById('cancel-delete');
                      const confirmDeleteButton = document.getElementById('confirm-delete');

                      // Show confirmation dialog when delete button is clicked
                      deleteForm.addEventListener('submit', function (event) {
                          event.preventDefault();
                          confirmationDialog.style.display = 'block';
                      });

                      // Hide confirmation dialog when cancel button is clicked
                      cancelDeleteButton.addEventListener('click', function () {
                          confirmationDialog.style.display = 'none';
                      });

                      // Submit delete form when confirm button is clicked
                      confirmDeleteButton.addEventListener('click', function () {
                          deleteForm.submit();
                      });
                  });
              </script>
 
              @if ($invoice->status == 'paid')
                    <button id="mark-paid" data-id="{{ $invoice->id }}" class="btn btn-2 btn-fade">Invoice Paid</button>
              @elseif ($invoice->status == 'pending')

                <form id="mark-paid-form" action="{{ route('invoice.payed', $invoice->id) }}" method="POST">
                  @csrf
                  @method('PATCH') <!-- Corrected from 'patch' to 'PATCH' -->
                  <button id="mark-paid" data-id="{{ $invoice->id }}" class="btn btn-2 btn-fade">Mark as Paid</button>
                  </form>
              @elseif ($invoice->status == 'draft')
                  <button id="draft-mode" data-id="{{ $invoice->id }}" class="btn btn-2 btn-fade">Draft Mode</button>
              @endif



            </div>
          </div>
          @if(session('success'))
              <div class="alert alert-success" style="background-color: #ffffff; text-align: center;">
                  {{ session('success') }}
              </div>
          @endif

          <div class="invoice-summary-master-container">
            <div class="invoice-summary">
              <div class="invoice-summary__header">
                <h2 class="single-invoice__id"><span>#</span>{{ $invoice->invoice_id }}</h2>
                <p class="single-invoice__vendor-type">{{ $invoice->description }}</p>
              </div>
              <div class="invoice-summary__sender-address">
                <p class="sender-address">{{ $invoice->senderAddress_street }}</p> 
                <p class="sender-city">{{ $invoice->senderAddress_city }}</p> 
                <p class="sender-zip">{{ $invoice->senderAddress_postCode }}</p> 
                <p class="sender-country">{{ $invoice->senderAddress_country }}</p> 
              </div>
            </div>

            <div class="invoice-summary__details">
              <div class="invoice-summary__dates">
                <p class="invoice-summary__headers">Invoice Date</p>  
                <h2 class="invoice-summary__deats">{{ $invoice->createdAt }}</h2>
                <p class="invoice-summary__headers">Payment Due</p>  
                <h2 class="invoice-summary__deats">{{ $invoice->paymentDue }}</h2>
              </div>
              <div class="invoice-summary__bill--to">
                <p class="invoice-summary__headers">Bill To</p>  
                <h2 class="invoice-summary__deats">{{ $invoice->clientName }}</h2>
                <h3 class="invoice-summary__headers">{{ $invoice->clientAddress_street }}</h3> 
                <h3 class="invoice-summary__headers">{{ $invoice->clientAddress_city }}</h3> 
                <h3 class="invoice-summary__headers">{{ $invoice->clientAddress_postCode }}</h3> 
                <h3 class="invoice-summary__headers">{{ $invoice->clientAddress_country }}</h3> 
              </div>
              <div class="invoice-summary__sent--to">
                <p class="invoice-summary__headers">Sent to</p>  
                <h2 class="invoice-summary__deats">{{ $invoice->clientEmail }}</h2>
              </div>
            </div>
     

            @foreach ($invoice->items as $item)
             <div class="mobile-summary">
              <div class="mobile-summary-container">
              <div class="invoice-total-amounts-container">
                      <div class="invoice-left-items">
                        <h2 class="mobile-summary-name-price">{{ $item->name }}</h2>
                        <p class="mobile-summary-qty-times">{{ $item->quantity }} x ${{ $item->price }}</p>
                      </div>
                      <div class="invoice-right-totals">
                        <p class="mobile-summary-name-price">${{ $item->total }}</p>
                      </div>
                </div>
              </div>
            </div>
            @endforeach

            
            <div class="desktop-summary">
                <div class="desktop-summary-header">
                    <p>Item Name</p>
                    <p>Qty</p>
                    <p class="summary-price">Price</p>
                    <p class="summary-price">Total</p>
                </div>
                @foreach ($invoice->items as $item)
                <div class="desktop-summary-items-container" style="margin-bottom: 10px;">
                    <div class="desktop-summary-items">
                        <p>{{ $item->name }}</p>
                        <p>{{ $item->quantity }}</p>
                        <p class="summary-price">${{ $item->price }}</p>
                        <p class="summary-price">${{ $item->total }}</p>
                    </div>
                </div>
                @endforeach
            </div>




            <div class="invoice-summary__totals-bar flex">
              <p>Amount Due</p>
              <h2>${{ $invoice->total }}</h2>
            </div>
          </div> 
        </div>
      </div>     
  </section></div>

  </div>
    

  @endsection