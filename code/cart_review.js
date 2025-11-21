function updateProductsInput() {
    // Update hidden form field with shopping cart products in JSON format
    const products = cart.map(item => ({
        name: item.product_name,
        price: item.product_price,
        quantity: item.quantity,
        image: item.product_image
    }));

    document.getElementById("products").value = JSON.stringify(products);
}

// Perform product update when Checkout button is clicked
document.getElementById("Checkout").addEventListener("click", () => {
    updateProductsInput();
});