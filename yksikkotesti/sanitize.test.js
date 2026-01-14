const sanitize = require('./sanitize');

test('poistaa HTML-tagit ja välilyönnit', () => {
    expect(sanitize('  <b>Hello>  ')).toBe('&lt;b&gt;Hello&gt;');
});