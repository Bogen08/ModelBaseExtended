// ./assets/js/components/Category.js

import React, {Component} from 'react';
import axios from 'axios';
import {Route, Switch,Redirect, Link, withRouter} from 'react-router-dom';
import { Helmet } from 'react-helmet'
import load from '../../img/load.png'


class User extends Component {
    constructor() {
        super();
        this.state = { models: [],user: [], loading: true};
    }
    componentDidMount() {
        this.getModels();
    }

    getModels() {
        axios.get(`http://localhost:8000/api/userModels/`+id).then(models => {
            this.setState({ models: models.data, loading:false});
        });
        axios.get(`http://localhost:8000/api/userget/`+id).then(user => {
            this.setState({ user: user.data, loading:false});
        });

    }

    render() {
        const loading = this.state.loading;
        return (
            <main>
                <Helmet>
                    <title>{this.state.user.username}</title>
                </Helmet>
                <div>
                    {loading ? (
                    <div className="featured-category">
                        Loading...
                        <div className="showcase-category">
                                <div>

                                    <div className="short-description">
                                            Loading<br/>
                                    </div>
                                    <Link style={{textDecoration: 'none'}}>
                                        <img src={load}/>
                                    </Link>
                                </div>

                        </div>

                    </div>
                    ):(
                        <div className="featured-category">
                        {this.state.user.username}'s files
                        <div className="showcase-category">
                            {this.state.models.map(model =>
                                <div>

                                    <div className="short-description">
                                        <a href={"/model/" + model.id} style={{textDecoration: 'none'}}>
                                            {model.title}<br/>
                                        </a>
                                        by <b>{model.owner_id}</b>
                                    </div>
                                    <Link to="/model" style={{textDecoration: 'none'}}>
                                        <img
                                            src={'/uploads/' + model.owner_id + "/" + model.title + "/img/" + model.img1}/>
                                    </Link>
                                </div>
                            )}

                        </div>

                    </div>
                    )}
                </div>
            </main>
        )
    }
}

export default User;