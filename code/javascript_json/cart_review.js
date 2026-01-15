function updateProductsInput(cartParam, inputParam) {
    const currentCart = cartParam || (typeof cart !== 'undefined' ? cart : []);
    const inputElement = inputParam || 
        (typeof document !== 'undefined' ? document.getElementById("products") : null);

    if (!currentCart || currentCart.length === 0 || !inputElement) {
        return;
    }

    const products = currentCart.map(item => ({
        name: item.product_name || item.name || '',
        price: parseFloat(item.product_price) || parseFloat(item.price) || 0,
        quantity: parseInt(item.quantity) || 1,
        image: item.product_image || item.picture || ''
    }));

    inputElement.value = JSON.stringify(products);
}

if (typeof module !== 'undefined') {
    module.exports = { updateProductsInput };
}