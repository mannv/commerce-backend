const p1 = new Promise((resolve, reject) => {
    setTimeout(() => {
        resolve(1)
        // reject(new Error('co loi roi'));
    }, 100);
});
const p2 = new Promise((resolve, reject) => {
    setTimeout(() => {
        resolve(2)
    }, 500);
});

// p.then(res => console.log('Resolve: ' + res)).catch(err => console.error('ERR: ' + err.message));
Promise.race([p1, p2]).then(res => console.log(res)).catch(err => console.log('ERROR: ' + err.message));