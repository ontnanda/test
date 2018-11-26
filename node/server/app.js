import express from 'express';
import routes from './routes';
import bodyParser from 'body-parser';

// Check alternative_db.js for localhost connection

var Memcached   = require('memcached');
var memcached = new Memcached('127.0.0.1:11211');

const app = express();

// Middelware
app.use(bodyParser.json());
app.use('/api', routes);

export default app;

console.log('Executing Server: app.js ...');
