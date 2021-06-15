// ./assets/js/components/Home.js

import React, {Component} from 'react';
import axios from 'axios';
import {Route, Switch,Redirect, Link, withRouter} from 'react-router-dom';


class Home extends Component {
    constructor() {
        super();
        this.state = { featured: [],categories: [], loading: true};
    }
    componentDidMount() {
        this.getFeatured();
    }

    getFeatured() {
        axios.get(`http://localhost:8000/api/categorylist`).then(category_list => {
            this.setState({ categories: category_list.data});
        });
        axios.get(`http://localhost:8000/api/featured`).then(featured => {
            this.setState({ featured: featured.data, loading: false});
        });

    }

    render() {
        const loading = this.state.loading;
        return (
        <main>
            Categories
            <div>
                <nav>
                    <ul class="category-list">

                        {this.state.categories.map(category =>
                            <li>
                                <a href={"/category/"+category.id}>
                                    {category.name}
                                </a>
                            </li>
                            )}

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
                                        <a href={"/model/"+post.id} style={{ textDecoration: 'none' }}>
                                            {post.title}<br/>
                                        </a>
                                        by <b>{post.owner_id}</b>
                                    </div>
                                <Link to="/model" style={{ textDecoration: 'none' }}>
                                        <img src={'/uploads/' + post.owner_id + "/" + post.title + "/img/" + post.img1}/>
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