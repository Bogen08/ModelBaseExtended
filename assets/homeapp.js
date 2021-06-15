/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (featured.html.twig).
 */

// ./src/homeapp.js

import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from 'react-router-dom';
import './css/style.css';
import Home from './js/components/home.js';

ReactDOM.render(<Router><Home /></Router>, document.getElementById('root'));
