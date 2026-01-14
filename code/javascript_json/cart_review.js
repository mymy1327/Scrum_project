function updateProductsInput(cartParam, inputParam) {
    // käytä parametreja jos annettu, muuten selaimen globaaleja
    const currentCart = cartParam || cart;
    const inputElement = inputParam || document.getElementById("products");

    // Stop if cart is empty
    if (!currentCart || currentCart.length === 0) {
        console.warn("Cart is empty!");
        return;
    }

    // Cart items for form submission
    const products = currentCart.map(item => ({
        name: item.product_name || item.name || '',
        price: parseFloat(item.product_price) || parseFloat(item.price) || 0,
        quantity: parseInt(item.quantity) || 1,
        image: item.product_image || item.picture || ''
    }));

    // Store as JSON in hidden input
    inputElement.value = JSON.stringify(products);
    console.log("Products hidden input updated:", inputElement.value);
}

// Export for unit testing
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { updateProductsInput };
}
