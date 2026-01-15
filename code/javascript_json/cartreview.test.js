const { updateProductsInput } = require('./cart_review');

describe('updateProductsInput', () => {

    test('updates the hidden input', () => {
        const mockCart = [
            {
                name: 'Guitar',
                price: '500',
                quantity: 2,
                picture: 'guitar.png'
            }
        ];

        const mockInput = { value: '' };

        updateProductsInput(mockCart, mockInput);

        const parsed = JSON.parse(mockInput.value);

        expect(parsed).toEqual([
            {
                name: 'Guitar',
                price: 500,
                quantity: 2,
                image: 'guitar.png'
            }
        ]);
    });
});