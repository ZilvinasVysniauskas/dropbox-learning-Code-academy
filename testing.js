[1, 2, 3, 4, 5].forEach(v => {
    if (v > 3) {
        // SyntaxError: Illegal break statement
        break;
    }
});