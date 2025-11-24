function updateProductsInput() {
    // Stop if cart is empty
    if (!cart || cart.length === 0) {
        console.warn("Cart is empty!");
        return;
    }

    // Cart items for form submission
    const products = cart.map(item => ({
        name: item.product_name || item.name || '',
        price: parseFloat(item.product_price) || parseFloat(item.price) || 0,
        quantity: parseInt(item.quantity) || 1,
        image: item.product_image || item.picture || ''
    }));

    // Store as JSON in hidden input
    document.getElementById("products").value = JSON.stringify(products);
    console.log("Products hidden input updated:", document.getElementById("products").value);
}