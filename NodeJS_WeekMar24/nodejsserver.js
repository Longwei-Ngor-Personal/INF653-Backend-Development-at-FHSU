//Importing the HTTP module
const http = require('http');
const fs = require('fs');
const path = require('path');
const { fileURLToPath } = require('url');

const contentTypes = {
    '.html' : 'text/html', '.css': 'text/css', 
    '.js' : 'text/javascript', '.json': 'application/json',
    '.txt' : 'text/plain', '.jpeg' : 'image/jpeg', '.png' : 'image.png'
};

//create server
const server = http.createServer((req, res) => {
    console.log(`Request received for URL: ${req.url}`);

    let filePath;

    if (req.url === '/'){
        filePath = path.join(__dirname, '/view/index.html');
    } else if (req.url.startsWith('/assets')) {
        filePath = path.join(__dirname, req.url);
    } else if (req.url.endsWith('.json')) {
        filePath = path.join(__dirname, '/data', path.basename(req.url));
    } else {
        filePath = path.join(__dirname, '/views', req.url);
    }

    res.statusCode = 200; //200 ok response
    res.setHeader('Content-Type', 'text/plain'); //Plain text response
    res.end('Hello World from Node.js Server!'); // Response body

    const extname = path.extname(filePath);
    const contentType = contentTypes[extname] || 'text.html';

    const encoding = ['.png', '.jpeg'].includes(extname) ? null : 'utf8';

    fs.readFile(filePath, encoding, (err, data) => {
        if (err) {
            fs.readFile(path.join(__dirname, '/views/404.html'), (_, errorData) => {
                res.writeHead(err.code === 'ENOENT' ? 404 : 500, {'Content-Type': 'text/html'});
                res.end(errorData || 'Server Error');
            });
        } else {
            res.writeHead(200, {'Content-Type':contentType});
            res.end(data);
        }
    });
});

//start the server
const PORT = 3000;
server.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});