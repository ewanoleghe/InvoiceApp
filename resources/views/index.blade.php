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
          <h3>Filter <span class="invoice-header-span">by status</span><img src="{{ asset('assets/icon-arrow-down.svg') }}" alt="arrow"></h3>
          <div class="dropdown-container">
          <div class="dropdown">
            <div class="dropdown-content">
            <div class="checkbox-container">
              <input class="filter-checkbox" id="draft-check" type="checkbox" name="draft-check">
              <label for="draft-check">Draft</label>
            </div>
            <div class="checkbox-container">
              <input class="filter-checkbox" id="draft-pending" type="checkbox" name="draft-pending">
              <label for="draft-pending">Pending</label>
            </div>
            <div class="checkbox-container">
              <input class="filter-checkbox" id="draft-paid" type="checkbox" name="draft-paid">
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

  <section class="mobile-status-controls" style="display: none;">
    <div class="mobile-status-edit-bar__edit flex">
      <button id="item-edit-mobile" class="btn btn-3-dark">Edit</button>
      <button id="item-delete-mobile" class="btn btn-5-danger">Delete</button>
      <button id="mark-paid-mobile" class="btn btn-2">Mark as Paid</button>
    </div>
  </section>

  <div class="delete-modal-container hide">
    <div class="delete-wrapper">
      <div class="delete-content flex">
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete invoice <span class="delete-span-id">#XM914</span>? This action cannot be
          undone.</p>
        <div class="delete-btn-container flex">
          <button data-action="cancel" class="btn btn-3-dark">Cancel</button>
          <button data-action="delete" class="btn btn-5-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>


  <!-- FORM -->
  <section id="form-container" class="new-invoice hide invoice-form" data-type="new-invoice">
    <div class="form-wrapper">
      <div class="form-content">

        <form action="index.html" class="form new-form" method="POST">
          <div class="form-padding-wrapper">


            <div class="form-group form-group-title">
              <h2 class="form-group-title-name">New Invoice <span class="form-group-title-span">All Fields Must Be
                  Filled</span></h2>
            </div>

            <div class="form-group">
              <p class="input-headers">Bill From</p>
              <div class="label-wrap">
                <label class="input-label" for="street">Street Address </label>
                <span class="input-label-msg">can't be empty</span>
              </div>
              <input id="street" type="text" class="input-text" name="senderAddress-street" placeholder="Street Address">
            </div>

            <div class="auto-grid">
              <div class="form-group">
                <div class="label-wrap">
                  <label class="input-label" for="city">City </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <input id="city" type="text" class="input-text" name="senderAddress-city" placeholder="City">
              </div>
              <div class="form-group">
                <div class="label-wrap">
                  <label class="input-label" for="zipcode">Zipcode </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <input id="zipcode" type="text" class="input-text" name="senderAddress-postCode" placeholder="Zipcode">
              </div>
              <div class="form-group full-length">
                <div class="label-wrap">
                  <label class="input-label" for="country">Country </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <input id="country" type="text" class="input-text" name="senderAddress-country" placeholder="Country">
              </div>
            </div>

            <div class="form-group">
              <p class="input-headers">Bill To</p>
              <div class="label-wrap">
                <label class="input-label" for="clientName">Client Name </label>
                <span class="input-label-msg">can't be empty</span>
              </div>
              <input id="client-name" type="text" class="input-text" name="clientName" placeholder="Client Name">
            </div>

            <div class="form-group">
              <div class="label-wrap">
                <label class="input-label" for="clientEmail">Client Email </label>
                <span class="input-label-msg">can't be empty</span>
              </div>
              <input id="client-email" type="text" class="input-text" name="clientEmail" placeholder="Client Email">
            </div>

            <div class="form-group">
              <div class="label-wrap">
                <label class="input-label" for="client-address">Street Address </label>
                <span class="input-label-msg">can't be empty</span>
              </div>
              <input id="client-address" type="text" class="input-text" name="clientAddress-street" placeholder="Client Address">
            </div>

            <div class="auto-grid">
              <div class="form-group">
                <div class="label-wrap">
                  <label class="input-label" for="client-city">Client City </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <input id="client-city" type="text" class="input-text" name="clientAddress-city" placeholder="Client City">
              </div>
              <div class="form-group">
                <div class="label-wrap">
                  <label class="input-label" for="client-zipcode">Client Zipcode </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <input id="client-zipcode" type="text" class="input-text" name="clientAddress-postCode" placeholder="Client Zipcode">
              </div>
              <div class="form-group full-length">
                <div class="label-wrap">
                  <label class="input-label" for="client-country">Client Country </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <input id="client-country" type="text" class="input-text" name="clientAddress-country" placeholder="Client Country">
              </div>
            </div>

            <div class="form-col-1">
              <div class="form-group">
                <div class="label-wrap">
                  <label class="input-label" for="street-address">Invoice Date </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <input type="date" class="input-text" name="paymentDue">
              </div>
              <div class="form-group">
                <div class="label-wrap">
                  <label class="input-label" for="street-address">Payment Terms </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <select name="paymentTerms" id="select-input-1" class="input-text">
                  <option value="1">Net 1 Day</option>
                  <option value="7">Net 7 Days</option>
                  <option value="14">Net 14 Days</option>
                  <option value="30">Net 30 Days</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="label-wrap">
                <label class="input-label" for="project-description">Project Description </label>
                <span class="input-label-msg">can't be empty</span>
              </div>
              <input id="project-description" type="text" class="input-text" name="description" placeholder="Project Description">
            </div>
            <h2 class="form-group new-form-item-desc">Item List</h2>
            <!-- MAYBE CONTAINER HERE -->

            <!-- START NEW ITEM -->
            <div class="line-items-wrapper">
              <div class="form-col-5-mod">
                <div class="form-group">
                  <div class="label-wrap">
                    <label class="input-label" for="project-description">Item Name </label>
                    <span class="input-label-msg">can't be empty</span>
                  </div>
                  <input class="input-text line-item-item line-item-name" type="text" name="line-item-name" placeholder="Add Item Name">
                </div>
                <div class="form-group">
                  <div class="label-wrap">
                    <label class="input-label" for="project-description">Qty. </label>
                  </div>
                  <input value="1" class="input-text line-item-item line-item-qty" type="number" name="line-item-qty" placeholder="1">
                </div>
                <div class="form-group">
                  <div class="label-wrap">
                    <label class="input-label" for="project-description">Price </label>
                    <span class="input-label-msg">can't be empty</span>
                  </div>
                  <input class="input-text line-item-item line-item-price" type="text" name="line-item-price" placeholder="Add Price">
                </div>
                <div class="form-group">
                  <div class="label-wrap">
                    <label class="input-label" for="project-description">Line Total </label>
                    <span class="input-label-msg">can't be empty</span>
                  </div>
                  <p class="line-item-total">$0.00</p>
                </div>
                <div class="form-group form-group-trash">
                  <img id="trash-constant" class="line-item-delete" src="{{ asset('assets/icon-delete.svg') }}" alt="">
                </div>
              </div>
            </div>
            <!-- END NEW ITEM -->

            <div class="form-group">
              <button class="btn btn-4-dark btn-full add-item">+ Add New Item</button>
            </div>

          </div>
          <div class="form-group">
            <div class="new-form-button-container">
              <button class="form-btn btn-discard" id="data-discard" data-action="data-discard">Discard</button>
              <div>
                <button class="form-btn btn-draft" id="data-draft" data-action="data-draft">Save As Draft</button>
                <button class="form-btn btn-send" id="data-save" data-action="data-save">Save &amp;
                  Send</button>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </section>

  <section id="edit-form-container" class="new-invoice hide invoice-form" data-type="new-invoice">
    <div class="form-wrapper">
      <div class="form-content">

        <form action="index.html" class="form new-form" method="POST">
          <input class="edit-status" id="edit-status" type="hidden" name="status" value="">
          <div class="form-padding-wrapper">


            <div class="form-group form-group-title">
              <h2 class="form-group-title-name ">Edit <span class="form-group-title-span">All Fields Must Be
                  Filled</span></h2>
            </div>

            <div class="form-group">
              <p class="input-headers">Bill From</p>
              <div class="label-wrap">
                <label class="input-label" for="street">Street Address </label>
                <span class="input-label-msg">can't be empty</span>
              </div>
              <input id="edit-street" type="text" class="edit-input-text edit-street" name="senderAddress-street" placeholder="Street Address">
            </div>

            <div class="auto-grid">
              <div class="form-group">
                <div class="label-wrap">
                  <label class="input-label" for="city">City </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <input id="edit-city" type="text" class="edit-input-text edit-city" name="senderAddress-city" placeholder="City">
              </div>
              <div class="form-group">
                <div class="label-wrap">
                  <label class="input-label" for="zipcode">Zipcode </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <input id="edit-zipcode" type="text" class="edit-input-text edit-zipcode" name="senderAddress-postCode" placeholder="Zipcode">
              </div>
              <div class="form-group full-length">
                <div class="label-wrap">
                  <label class="input-label" for="country">Country </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <input id="edit-country" type="text" class="edit-input-text edit-country" name="senderAddress-country" placeholder="Country">
              </div>
            </div>

            <div class="form-group">
              <p class="input-headers">Bill To</p>
              <div class="label-wrap">
                <label class="input-label" for="clientName">Client Name </label>
                <span class="input-label-msg">can't be empty</span>
              </div>
              <input id="edit-client-name" type="text" class="edit-input-text edit-client-name" name="clientName" placeholder="Client Name">
            </div>

            <div class="form-group">
              <div class="label-wrap">
                <label class="input-label" for="clientEmail">Client Email </label>
                <span class="input-label-msg">can't be empty</span>
              </div>
              <input id="edit-client-email" type="text" class="edit-input-text edit-client-email" name="clientEmail" placeholder="Client Email">
            </div>

            <div class="form-group">
              <div class="label-wrap">
                <label class="input-label" for="client-address">Street Address </label>
                <span class="input-label-msg">can't be empty</span>
              </div>
              <input id="edit-client-address" type="text" class="edit-input-text edit-client-address" name="clientAddress-street" placeholder="Client Address">
            </div>

            <div class="auto-grid">
              <div class="form-group">
                <div class="label-wrap">
                  <label class="input-label" for="client-city">Client City </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <input id="edit-client-city" type="text" class="edit-input-text edit-client-city" name="clientAddress-city" placeholder="Client City">
              </div>
              <div class="form-group">
                <div class="label-wrap">
                  <label class="input-label" for="client-zipcode">Client Zipcode </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <input id="edit-client-zipcode" type="text" class="edit-input-text edit-client-zipcode" name="clientAddress-postCode" placeholder="Client Zipcode">
              </div>
              <div class="form-group full-length">
                <div class="label-wrap">
                  <label class="input-label" for="client-country">Client Country </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <input id="edit-client-country" type="text" class="edit-input-text edit-client-country" name="clientAddress-country" placeholder="Client Country">
              </div>
            </div>

            <div class="form-col-1">
              <div class="form-group">
                <div class="label-wrap">
                  <label class="input-label" for="street-address">Invoice Date </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <input id="edit-payment-due" type="date" class="edit-input-text edit-payment-due" name="paymentDue">
              </div>
              <div class="form-group">
                <div class="label-wrap">
                  <label class="input-label" for="street-address">Payment Terms </label>
                  <span class="input-label-msg">can't be empty</span>
                </div>
                <select name="paymentTerms" id="select-input-2" class="edit-input-text">
                  <option value="1">Net 1 Day</option>
                  <option value="7">Net 7 Days</option>
                  <option value="14">Net 14 Days</option>
                  <option value="30">Net 30 Days</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="label-wrap">
                <label class="input-label" for="project-description">Project Description </label>
                <span class="input-label-msg">can't be empty</span>
              </div>
              <input id="edit-project-description" type="text" class="edit-input-text" name="description" placeholder="Project Description">
            </div>
            <h2 class="form-group new-form-item-desc">Item List</h2>
            <div class="edit-line-items-wrapper">
              <!-- FILL ME UP BUTTERCUP -->
            </div>


            <div class="form-group">
              <button class="btn btn-4-dark btn-full edit-add-item">+ Add New Item</button>
            </div>

          </div>
          <div class="form-group">
            <div class="new-form-button-container-2">
              <button class="form-btn edit-btn-cancel" id="data-cancel" data-action="data-cancel">Cancel</button>
              <button class="form-btn edit-btn-update" id="data-update" data-action="data-update">Save
                Changes</button>
            </div>
          </div>
      </form></div>
      
    </div>
    
  </section>

  @endsection