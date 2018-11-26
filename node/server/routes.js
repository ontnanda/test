import express from 'express';

// Controller imports
import testController from './controllers/testController';
const routes = express();

// Basic routes
routes.get('/:id/:n', testController.get);


export default routes;

console.log('Executing Server: routes.js ...');
