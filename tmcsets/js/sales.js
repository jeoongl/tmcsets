function updateDateTime() {
    const now = new Date();
    const date = now.toLocaleDateString();
    const time = now.toLocaleTimeString();

    document.getElementById('current-date').textContent = date;
    document.getElementById('current-time').textContent = time;
}

// Update the date and time immediately and then every second
updateDateTime();
setInterval(updateDateTime, 1000);

// Function to show the form
function showAddSaleForm() {
    document.getElementById("sale-form-container").style.display = "block";
}

// Function to hide the add expense form
function hideAddSaleForm() {
    document.getElementById("sale-form-container").style.display = "none";
}

// Function to show the delete confirmation modal
function showDeleteModal(expenseId) {
    document.getElementById("delete-confirm-modal").style.display = "block";
    // Set the expense id in a hidden field
    document.getElementById("sale-id").value = expenseId;
}

// Function to hide the delete modal form
function hideDeleteModal() {
    document.getElementById("delete-confirm-modal").style.display = "none";
}



// Function to handle delete button click
function deleteExpense() {
    // Get the expense id
    var expenseId = document.getElementById("sale-id").value;
    // Make an AJAX call to delete the expense
    fetch("delete_sale.php", {
        method: "POST",
        body: JSON.stringify({expenseId: expenseId})
    })
    .then(response => {
        if (response.ok) {
            return response.text();
        }
        throw new Error("Network response was not ok.");
    })
    .then(data => {
        // Close the modal
        hideDeleteModal();
        showSuccessDeleteModal();
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
}

// Function to show the update form and populate it with existing data
function showUpdateForm(expenseId) {
    // Get the row corresponding to the expenseId
    var row = document.querySelector('tr[data-id="' + expenseId + '"]');
    var cells = row.querySelectorAll("td");

    // Populate update modal form with data from the selected row
    document.getElementById("sale-id-update").value = expenseId;
    document.getElementById("product-update").value = cells[0].textContent;
    document.getElementById("quantity-update").value = cells[1].textContent;
    document.getElementById("price-update").value = parseFloat(cells[2].textContent.replace('₱', '').replace(/,/g, '')); // Remove currency symbol and commas
    document.getElementById("sold-date-update").value = cells[3].textContent;

    // Show the update modal form
    document.getElementById("update-sale-form-container").style.display = "block";
}

// Function to hide the update modal form
function hideUpdateModal() {
    document.getElementById("update-sale-form-container").style.display = "none";
}

// Function to handle update button click
function updateExpense() {
// Get the form data
var formData = new FormData(document.getElementById("update-sale-form"));

// Send the form data via AJAX
fetch("update_sale.php", {
    method: "POST",
    body: formData
})
.then(response => {
    if (response.ok) {
        return response.text();
    }
    throw new Error("Network response was not ok.");
})
.then(data => {
    // Close the modal form
    hideUpdateModal();
    showSuccessUpdateModal();
})
.catch(error => {
    console.error('There was a problem with the fetch operation:', error);
});
}

// Function to handle cancel button click
document.getElementById("update-cancel-button").addEventListener("click", function() {
    hideUpdateModal();
});

    // Function to validate the expense form before submission
    function validateExpenseForm() {
    var product = document.getElementById("product").value;
    var quantity = document.getElementById("quantity").value;
    var price = document.getElementById("price").value;
    var soldDate = document.getElementById("sold-date").value;

    // Check if any of the required fields are empty
    if (product === "" || quantity === "" || price === "" || soldDate === "") {
        // Display an alert message
        alert("Please fill in all required fields.");
        // Prevent form submission
        return false;
    }

    // If all required fields are filled, allow form submission
    return true;
}

// Function to show the success modal for 3 seconds
function showSuccessAddModal() {
    var modal = document.getElementById("add-success");

    // Show the modal
    modal.style.display = "block";

    // Hide the modal after 3 seconds
    setTimeout(function() {
        modal.style.display = "none";
        location.reload();
    }, 1000);
}

// Function to show the success modal for 3 seconds
function showSuccessUpdateModal() {
    var modal = document.getElementById("update-success");

    // Show the modal
    modal.style.display = "block";

    // Hide the modal after 3 seconds
    setTimeout(function() {
        modal.style.display = "none";
        location.reload();
    }, 1000);
}

// Function to show the success modal for 3 seconds
function showSuccessDeleteModal() {
    var modal = document.getElementById("delete-success");

    // Show the modal
    modal.style.display = "block";

    // Hide the modal after 3 seconds
    setTimeout(function() {
        modal.style.display = "none";
        location.reload();
    }, 1000);
}
// Form submission
document.getElementById("sale-form").addEventListener("submit", function(event) {
    // Prevent default form submission
    event.preventDefault();

    // Validate the expense form
    if (validateExpenseForm()) {
        // If validation passes, submit form data using AJAX
        var formData = new FormData(this);
        fetch("add_sale.php", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (response.ok) {
                return response.text();
            }
            throw new Error("Network response was not ok.");
        })
        .then(data => {
            // Close the modal form
            document.getElementById("sale-form-container").style.display = "none";
            // Show success modal
            showSuccessAddModal();
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }
});
// Function to handle SAVE button click
document.getElementById("save-button").addEventListener("click", function() {
// Define options for PDF generation
var options = {
    filename: 'sales.pdf', // Set the filename
    image: { type: 'jpeg', quality: 0.98 }, // Specify image quality
    html2canvas: { scale: 2 }, // Adjust scale for better quality
    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' } // Specify PDF format and orientation
};

// Select the element to be converted to PDF
var element = document.body;

// Use html2pdf to generate and save the PDF
html2pdf().from(element).set(options).save();
});

// Function to handle date filter and view expenses button click
document.getElementById("submit-filter").addEventListener("click", function() {
// Get the selected date from the date input
var selectedDate = document.getElementById("filter-date").value;
console.log(selectedDate); // Log the selected date to console (for debugging)

// AJAX request to fetch expenses data for the selected date
fetch("get_gross_by_date.php", {
    method: "POST",
    headers: {
        'Content-Type': 'application/json' // Ensure the content type is JSON
    },
    body: JSON.stringify({ selectedDate: selectedDate }) // Send the selected date in the request body
})
.then(response => {
    if (response.ok) {
        return response.text(); // If response is ok, return the text
    }
    throw new Error("Network response was not ok.");
})
.then(data => {
    // Update the expenses table with the response data
    document.querySelector(".sales-table tbody").innerHTML = data;

    // Store the filtered data in localStorage
    localStorage.setItem('filteredSale', data);
})
.catch(error => {
    console.error('There was a problem with the fetch operation:', error); // Log any errors that occur
});
});
