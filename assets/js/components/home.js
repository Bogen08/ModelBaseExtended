// ./assets/js/components/Home.js

import React, {Component} from 'react';
import axios from 'axios';
import {Route, Switch,Redirect, Link, withRouter} from 'react-router-dom';


class Home extends Component {
    constructor() {
        super();
        this.state = { featured: [], loading: true};
    }
    componentDidMount() {
        this.getFeatured();
    }

    getFeatured() {
        axios.get(`http://localhost:8000/api/featured`).then(featured => {
            this.setState({ featured: featured.data, loading: false})
        })
    }

    render() {
        const loading = this.state.loading;
        return (
        <main>
            Categories
            <div>
                <nav>
                    <ul class="category-list">

                        <li>
                            <a href="/model">
                            Tools
                            </a>
                        </li>

                        <li>
                            <a href="/model">
                            Gadgets
                            </a>
                        </li>

                        <li>
                            <a href="/model">
                            Hobby
                            </a>
                        </li>

                        <li>
                            <a>
                                Your Files
                            </a>
                        </li>

                    </ul>
                </nav>
                <div class="featured">
                    Featured
                    <div class="showcase">
                        {this.state.featured.map(post =>

                            <div>

                                    <div class="short-description">
                                        <a href="/model" style={{ textDecoration: 'none' }}>
                                            {post.title}<br/>
                                        </a>
                                        by <b>{post.owner}</b>
                                    </div>
                                <Link to="/model" style={{ textDecoration: 'none' }}>
                                        <img src={post.img1}/>
                                </Link>
                            </div>

                        )}
                    </div>
                </div>
            </div>
        </main>
        )
    }
}

export default Home;