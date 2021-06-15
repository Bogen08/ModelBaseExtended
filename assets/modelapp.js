/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (featured.html.twig).
 */

// ./src/modelapp.js

import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from 'react-router-dom';
import './css/style.css';
import './css/model.css';
import Model from './js/components/model.js';


ReactDOM.render(<Router><Model /></Router>, document.getElementById('root'));