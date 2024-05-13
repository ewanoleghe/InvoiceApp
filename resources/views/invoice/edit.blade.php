@extends('layouts.app')
  
  
@section('contents')
   

  <div class="new-invoice hide invoice-form" id="form-container" >
    @if(session('success'))
      <div class="alert alert-success" style="background-color: #ffffff; text-align: center;">
        {{ session('success') }}
      </div>
     @endif    </div>
 
    <div class="form-wrapper">
      <div class="form-content">

    <form action="{{ route('invoice.update', ['invoice' => $invoice->id]) }}" class="form new-form" method="POST">
      @csrf
      @method('PATCH')
    <div class="form-padding-wrapper">

        <div class="form-group form-group-title">
            <h2 class="form-group-title-name">Edit #{{ $invoice->invoice_id }} <span class="form-group-title-span">All Fields Must Be Filled</span></h2>
        </div>

        <!-- Bill From Section -->
        <div class="form-group">
            <p class="input-headers">Bill From</p>
            <div class="label-wrap">
                <label class="input-label" for="street">Street Address </label>
                <span class="input-label-msg">can't be empty</span>
            </div>
            <input id="street" type="text" class="input-text" name="senderAddress_street" placeholder="Street Address" value="{{ $invoice->senderAddress_street ?? '' }}">
        </div>
        @error('senderAddress_street')
          <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 15px; color: red; font-size: 10px;">
          {{ $message }}
          </div>
        @enderror
       <!-- Auto Grid for Bill From Address -->
          <div class="auto-grid">
        <!-- City -->
        <div class="form-group">
            <div class="label-wrap">
                <label class="input-label" for="city">City </label>
                <span class="input-label-msg">can't be empty</span>
            </div>
            <input id="city" type="text" class="input-text" name="senderAddress_city" placeholder="City" value="{{ $invoice->senderAddress_city ?? '' }}" >
            @error('senderAddress_city')
            <div class="d-block text-danger" style="margin-top: -2px; margin-bottom: 15px; color: red; font-size: 10px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Zipcode -->
        <div class="form-group">
            <div class="label-wrap">
                <label class="input-label" for="zipcode">Zipcode </label>
                <span class="input-label-msg">can't be empty</span>
            </div>
            <input id="zipcode" type="text" class="input-text" name="senderAddress_postCode" placeholder="Zipcode" value="{{ $invoice->senderAddress_postCode ?? '' }}" >
            @error('senderAddress_postCode')
            <div class="d-block text-danger" style="margin-top: -2px; margin-bottom: 15px; color: red; font-size: 10px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Country -->
        <div class="form-group">
            <div class="label-wrap">
                <label class="input-label" for="country">Country </label>
                <span class="input-label-msg">can't be empty</span>
            </div>
            <input id="country" type="text" class="input-text" name="senderAddress_country" placeholder="Country"  value="{{ $invoice->senderAddress_country ?? '' }}" >
            @error('senderAddress_country')
            <div class="d-block text-danger" style="margin-top: -2px; margin-bottom: 15px; color: red; font-size: 10px;">{{ $message }}</div>
            @enderror
        </div>
    </div>
        <!-- End Bill From Section -->

        <!-- Bill To Section -->
        <div class="form-group">
            <p class="input-headers">Bill To</p>
            <!-- Client Name -->
            <div class="label-wrap">
                <label class="input-label" for="clientName">Client Name </label>
                <span class="input-label-msg">can't be empty</span>
            </div>
            <input id="client-name" type="text" class="input-text" name="clientName" placeholder="Client Name"  value="{{ $invoice->clientName ?? '' }}" >
        </div>
        @error('clientName')
          <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 15px; color: red; font-size: 10px;">
          {{ $message }}
          </div>
        @enderror
        <!-- Client Email -->
        <div class="form-group">
            <div class="label-wrap">
                <label class="input-label" for="clientEmail">Client Email </label>
                <span class="input-label-msg">can't be empty</span>
            </div>
            <input id="client-email" type="text" class="input-text" name="clientEmail" placeholder="Client Email"  value="{{ $invoice->clientEmail ?? '' }}" >
        </div>
        @error('clientEmail')
          <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 15px; color: red; font-size: 10px;">
          {{ $message }}
          </div>
        @enderror
        <!-- Client Address -->
        <div class="form-group">
            <div class="label-wrap">
                <label class="input-label" for="client-address">Street Address </label>
                <span class="input-label-msg">can't be empty</span>
            </div>
            <input id="client-address" type="text" class="input-text" name="clientAddress_street" placeholder="Client Address"  value="{{ $invoice->clientAddress_street ?? '' }}" >
        </div>
        @error('clientAddress_street')
          <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 15px; color: red; font-size: 10px;">
          {{ $message }}
          </div>
        @enderror
        <!-- Auto Grid for Client Address -->
        <div class="auto-grid">
    <!-- Client City -->
    <div class="form-group">
        <div class="label-wrap">
            <label class="input-label" for="client-city">Client City </label>
            <span class="input-label-msg">can't be empty</span>
        </div>
        <input id="client-city" type="text" class="input-text" name="clientAddress_city" placeholder="Client City"  value="{{ $invoice->clientAddress_city ?? '' }}" >
        @error('clientAddress_city')
        <div class="d-block text-danger" style="color: red; font-size: 10px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Client Zipcode -->
    <div class="form-group">
        <div class="label-wrap">
            <label class="input-label" for="client-zipcode">Client Zipcode </label>
            <span class="input-label-msg">can't be empty</span>
        </div>
        <input id="client-zipcode" type="text" class="input-text" name="clientAddress_postCode" placeholder="Client Zipcode"  value="{{ $invoice->clientAddress_postCode ?? '' }}" >
        @error('clientAddress_postCode')
        <div class="d-block text-danger" style="color: red; font-size: 10px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Client Country -->
    <div class="form-group">
        <div class="label-wrap">
            <label class="input-label" for="client-country">Client Country </label>
            <span class="input-label-msg">can't be empty</span>
        </div>
        <input id="client-country" type="text" class="input-text" name="clientAddress_country" placeholder="Client Country"  value="{{ $invoice->clientAddress_country ?? '' }}" >
        @error('clientAddress_country')
        <div class="d-block text-danger" style="color: red; font-size: 10px;">{{ $message }}</div>
        @enderror
    </div>
</div>

        <!-- End Bill To Section -->

        <!-- Invoice Details -->
        <div class="form-col-1">
            <!-- Invoice Date -->
            <div class="form-group">
                <div class="label-wrap">
                    <label class="input-label" for="invoice-date">Invoice Date </label>
                    <span class="input-label-msg">can't be empty</span>
                </div>
                <input type="date" class="input-text" name="createdAt"  value="{{ $invoice->createdAt ?? '' }}" >
            </div>
            @error('createdAt')
          <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 15px; color: red; font-size: 10px;">
          {{ $message }}
          </div>
        @enderror
        <!-- Payment Terms -->
            <div class="form-group">
                <div class="label-wrap">
                    <label class="input-label" for="payment-terms">Payment Terms </label>
                    <span class="input-label-msg">can't be empty</span>
                </div>
                <select name="paymentTerms" id="payment-terms" class="input-text">
                    <option value="1" {{ $invoice->paymentTerms == 1 ? 'selected' : '' }}>Net 1 Day</option>
                    <option value="7" {{ $invoice->paymentTerms == 7 ? 'selected' : '' }}>Net 7 Days</option>
                    <option value="14" {{ $invoice->paymentTerms == 14 ? 'selected' : '' }}>Net 14 Days</option>
                    <option value="30" {{ $invoice->paymentTerms == 30 ? 'selected' : '' }}>Net 30 Days</option>
                </select>
            </div>
        </div>
        <!-- End Invoice Details -->

        <!-- Project Description -->
        <div class="form-group">
            <div class="label-wrap">
                <label class="input-label" for="project-description">Project Description </label>
                <span class="input-label-msg">can't be empty</span>
            </div>
            <input id="project-description" type="text" class="input-text" name="description" placeholder="Project Description"  value="{{ $invoice->description ?? '' }}" >
        </div>
        @error('clientAddress_country')
          <div class="d-block text-danger" style="margin-top: -25px; margin-bottom: 15px; color: red; font-size: 10px;">
          {{ $message }}
          </div>
        @enderror
        
        <!-- Item List -->
        <h2 class="form-group new-form-item-desc">Item List</h2>
<!-- Line Items Wrapper -->
<div class="line-items-wrapper">
    @foreach ($invoice->items as $index => $item)
    <!-- Start New Item -->
    <div class="form-col-5-mod">
        <input type="hidden" name="line-item-id[]" value="{{ $item->id }}">
        <!-- Item Name -->
        <div class="form-group">
            <div class="label-wrap">
                <label class="input-label" for="item-name">Item Name </label>
                <span class="input-label-msg">can't be empty</span>
            </div>
            <input class="input-text line-item-item line-item-name" type="text" name="line-item-name[]" placeholder="Add Item Name" value="{{ $item->name }}">
        </div>
        <!-- Quantity -->
        <div class="form-group">
            <div class="label-wrap">
                <label class="input-label" for="quantity">Qty. </label>
            </div>
            <input value="{{ $item->quantity }}" class="input-text line-item-item line-item-qty" type="number" name="line-item-qty[]" id="quantity" placeholder="1">
        </div>
        <!-- Price -->
        <div class="form-group">
            <div class="label-wrap">
                <label class="input-label" for="price">Price </label>
                <span class="input-label-msg">can't be empty</span>
            </div>
            <input class="input-text line-item-item line-item-price" type="text" name="line-item-price[]" id="price" placeholder="Add Price" value="{{ $item->price }}">
        </div>
        <!-- Line Total -->
        <div class="form-group">
            <div class="label-wrap">
                <label class="input-label" for="line-total">Line Total </label>
                <span class="input-label-msg">can't be empty</span>
            </div>
            <p class="line-item-total">$0.00</p>
        </div>

        <!-- Hidden input for line total -->
        <input type="hidden" name="line_total[]" class="line-total">
        <!-- Trash Icon -->
        <div class="form-group form-group-trash">
            <img class="line-item-delete" src="{{ asset('assets/icon-delete.svg') }}" alt="">
        </div>
    </div>
    <!-- End New Item -->
    @endforeach
</div>
<!-- End Line Items Wrapper -->



<!-- Add New Item Button -->
<div class="form-group">
    <button type="button" class="btn btn-4-dark btn-full add-item">+ Add New Item</button>
</div>

    <!-- New Form Button Container -->
    <div class="form-group">
        <div class="new-form-button-container">
            <!-- Discard Button -->
            <a href="{{ route('welcome') }}" class="form-btn btn-discard" id="data-discard" data-action="data-discard" style="text-decoration: none;">Discard</a>
            <!-- Save as Draft Form -->
            
        <form action="your_action_route" method="POST">
          <!-- Other form fields -->

          <button type="submit" class="form-btn btn-draft" data-action="data-draft" onclick="setAction('saveasdraft')">
              Save As Draft
          </button>

          <button type="submit" class="form-btn btn-send" data-action="data-save" onclick="setAction('savesend')">
              Save & Send
          </button>

          <input type="hidden" name="action" id="action" value="">
      </form>

      <script>
          function setAction(action) {
              document.getElementById('action').value = action;
          }
      </script>


        </div>
    </div>
</form>


  @endsection