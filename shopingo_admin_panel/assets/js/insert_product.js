// FORM VALIDATION STARTS
document.getElementById('insert_products_form').addEventListener('submit', function (e) {
    e.preventDefault();
    let valid = true;
    // Reset error messages
    document.querySelectorAll('.error-msg').forEach(function (error) {
        error.textContent = '';
    });
    //Validate Name
    const name = document.getElementById('product_name').value;
    if (!name) {
        document.getElementById('nameError').textContent = '*Enter Product Name';
        valid = false;
    }
    // Validate Description
    const description = document.getElementById('product_desc').value;
    if (!description) {
        document.getElementById('descError').textContent = '*Enter Product Description';
        valid = false;
    }
    // Validate Category
    const category = document.getElementById('product_category').value;
    if (!category) {
        document.getElementById('categoryError').textContent = '*Select Product Category';
        valid = false;
    }
     // Validate Product Size
     const size = document.getElementById('product_size').value;
     if (!size) {
         document.getElementById('sizeError').textContent = '*Select Product Size';
         valid = false;
     }
    // Validate Price
    const price = document.getElementById('product_price').value;
    if (!price) {
        document.getElementById('priceError').textContent = '*Enter Product Price';
        valid = false;
    }
    // Validate stock
    const stock = document.getElementById('product_stock').value;
    if (!stock) {
        document.getElementById('stockError').textContent = '*Enter Product Stock';
        valid = false;
    }
    // // Validate Image
    // const product_image = document.getElementById('filebutton').value;
    // if (!product_image) {
    //     document.getElementById('imageError').textContent = '*Please Select Image';
    //     valid = false;
    // }
    if (valid) {
        this.submit();
    }
});
// FORM VALIDATION ENDS



// MULTIPLE SUB-IMAGES OF PRODUCT FUNCTIONs
function insertAtCursor() {
    let num = parseInt(document.getElementById("filebutton1").value, 10);
    if (!isNaN(num) && num > 0) {
        let altContainer = document.getElementById("alt");

        // Remove existing input elements
        while (altContainer.firstChild) {
            altContainer.removeChild(altContainer.firstChild);
        }
        // Create and append new input elements with preview divs
        for (let i = 1; i <= num; i++) {
            let input = document.createElement("input");
            input.setAttribute("name", `alt${i}`);
            input.setAttribute("type", "file");
            input.setAttribute("class", "input-file");
            input.setAttribute("onchange", `previewImage(this, 'alt${i}_preview')`);

            let previewDiv = document.createElement("div");
            previewDiv.setAttribute("id", `alt${i}_preview`);
            altContainer.appendChild(input);
            altContainer.appendChild(previewDiv);
        }
    }
}
// MULTIPLE SUB-IMAGES OF PRODUCT FUNCTION ENDS



// PRODUCT IMAGE PREVIEW STARTS
function previewImage(input, previewId) {
    let preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        let reader = new FileReader();

        reader.onload = function (e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview" width="100"/>`;
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        preview.innerHTML = "";
    }
}
// PRODUCT IMAGE PREVIEW ENDS