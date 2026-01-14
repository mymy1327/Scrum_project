function sanitize(input) {
    return String(input)
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .trim();
}

module.exports = sanitize;