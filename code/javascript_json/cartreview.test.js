// javascript_json/cartreview.test.js
const { updateProductsInput } = require('./cart_review');

describe('updateProductsInput', () => {
    let inputElement;

    beforeEach(() => {
        inputElement = { value: '' };
    });

    it('updates the input with a single product', () => {
        const cart = [
            { name: 'Guitar', price: '500', quantity: 2, picture: 'pictures/guitar.png' }
        ];
        updateProductsInput(cart, inputElement);
        expect(inputElement.value).toBe(JSON.stringify([
            { name: 'Guitar', price: 500, quantity: 2, image: 'pictures/guitar.png' }
        ]));
    });

    it('does not change the input when the cart is empty', () => {
        const cart = [];
        updateProductsInput(cart, inputElement);
        expect(inputElement.value).toBe('');
    });
});
