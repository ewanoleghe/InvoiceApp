document.addEventListener('DOMContentLoaded', function() {
  // Function to calculate and update line total for a specific item
  function updateLineTotalForItem(itemIndex) {
      // Get quantity and price inputs for the item
      var quantityInput = document.getElementsByName('line-item-qty[]')[itemIndex];
      var priceInput = document.getElementsByName('line-item-price[]')[itemIndex];
      var lineTotalInput = document.getElementsByClassName('line-total')[itemIndex];

      if (!quantityInput || !priceInput || !lineTotalInput) {
          console.error('Error: Inputs not found for item index', itemIndex);
          return;
      }

      var lineItemQty = parseInt(quantityInput.value);
      var lineItemPrice = parseFloat(priceInput.value);
      var lineTotal = lineItemQty * lineItemPrice;

      // Update the line total element for the item
      var lineTotalElement = document.querySelectorAll('.line-item-total')[itemIndex];
      if (!lineTotalElement) {
          console.error('Error: Line total element not found for item index', itemIndex);
          return;
      }
      lineTotalElement.textContent = '$' + lineTotal.toFixed(2);

      // Update the hidden input field with line total value for the item
      lineTotalInput.value = lineTotal.toFixed(2);
  }

  // Add event listeners to all quantity and price inputs
var quantityInputs = document.getElementsByName('line-item-qty[]');
var priceInputs = document.getElementsByName('line-item-price[]');
quantityInputs.forEach(function(input, index) {
    input.addEventListener('input', function() {
        updateLineTotalForItem(index);
    });
});
priceInputs.forEach(function(input, index) {
    input.addEventListener('input', function() {
        updateLineTotalForItem(index);
    });
});

// Call the function initially for all items to set the initial line totals
var totalItems = Math.min(quantityInputs.length, priceInputs.length);
for (var i = 0; i < totalItems; i++) {
    updateLineTotalForItem(i);
}

// Add event listener for deleting items
function addDeleteEventListeners() {
    var deleteButtons = document.querySelectorAll('.line-item-delete');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var itemWrapper = button.closest('.form-col-5-mod');
            var itemId = itemWrapper.querySelector('input[name="line-item-id[]"]').value;
            var itemIndex = Array.from(itemWrapper.parentNode.children).indexOf(itemWrapper);
            itemWrapper.remove();
            // Recalculate line totals after deletion
            updateLineTotalsAfterDeletion();
        });
    });
}

// Call the function initially to add delete event listeners to existing items
addDeleteEventListeners();

// Add New Item Button functionality
var addItemButton = document.querySelector('.add-item');
if (!addItemButton) {
    console.error('Error: Add item button not found');
} else {
    addItemButton.addEventListener('click', function() {
        var lineItemsWrapper = document.querySelector('.line-items-wrapper');
        if (!lineItemsWrapper) {
            console.error('Error: Line items wrapper not found');
        } else {
            var newItemHTML = `
            <!-- Start New Item -->
            <div class="form-col-5-mod">
                <input type="hidden" name="line-item-id[]" value="">
                <!-- Item Name -->
                <div class="form-group">
                    <div class="label-wrap">
                        <label class="input-label" for="item-name">Item Name </label>
                        <span class="input-label-msg">can't be empty</span>
                    </div>
                    <input class="input-text line-item-item line-item-name" type="text" name="line-item-name[]" placeholder="Add Item Name">
                </div>
                <!-- Quantity -->
                <div class="form-group">
                    <div class="label-wrap">
                        <label class="input-label" for="quantity">Qty. </label>
                    </div>
                    <input class="input-text line-item-item line-item-qty" type="number" name="line-item-qty[]" id="quantity" placeholder="1">
                </div>
                <!-- Price -->
                <div class="form-group">
                    <div class="label-wrap">
                        <label class="input-label" for="price">Price </label>
                        <span class="input-label-msg">can't be empty</span>
                    </div>
                    <input class="input-text line-item-item line-item-price" type="text" name="line-item-price[]" id="price" placeholder="Add Price">
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
                <img class="line-item-delete" src="${baseUrl}assets/icon-delete.svg" alt="">
                </div>
            </div>
            <!-- End New Item -->
            `;
            lineItemsWrapper.insertAdjacentHTML('beforeend', newItemHTML);

            // Add event listener for deleting the newly added item
var newDeleteButton = lineItemsWrapper.querySelector('.line-item-delete:last-of-type');
newDeleteButton.addEventListener('click', function() {
    var itemWrapper = newDeleteButton.closest('.form-col-5-mod');
    itemWrapper.remove();
    // Recalculate line totals after deletion
    updateLineTotalsAfterDeletion();
});


            // Update event listeners for quantity and price inputs after adding a new item
            var newQuantityInputs = document.getElementsByName('line-item-qty[]');
            var newPriceInputs = document.getElementsByName('line-item-price[]');
            var newItemIndex = newQuantityInputs.length - 1; // Index of the newly added item
            newQuantityInputs[newItemIndex].addEventListener('input', function() {
                updateLineTotalForItem(newItemIndex);
            });
            newPriceInputs[newItemIndex].addEventListener('input', function() {
                updateLineTotalForItem(newItemIndex);
            });

            // Add event listener for deleting the newly added item
            var newDeleteButton = lineItemsWrapper.querySelector('.line-item-delete:last-of-type');
            newDeleteButton.addEventListener('click', function() {
                var itemWrapper = newDeleteButton.closest('.form-col-5-mod');
                var itemId = itemWrapper.querySelector('input[name="line-item-id[]"]').value;
                var itemIndex = Array.from(itemWrapper.parentNode.children).indexOf(itemWrapper);
                itemWrapper.remove();
                // Recalculate line totals after deletion
                updateLineTotalsAfterDeletion();
            });

            // Add event listeners for all delete buttons
            addDeleteEventListeners();
        }
    });
}

});
