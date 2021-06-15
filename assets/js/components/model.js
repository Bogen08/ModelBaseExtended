// ./assets/js/components/model.js

import React, {Component} from 'react';
import axios from 'axios';
import {Route, Switch, Redirect, Link, withRouter, useParams} from 'react-router-dom';
import STLViewer from 'stl-viewer'
import load from '../../img/load.png'
import { Helmet } from 'react-helmet'


class Model extends Component {
    constructor() {
        super();
        this.state = { model: [], owner: [], loading: true};
    }
    componentDidMount() {
        this.getModelAndOwner();
        //STLViewer('/uploads/' + this.state.model.owner + "/" + this.state.model.title + "/stl/" + this.state.model.model,"model")
    }

    getModelAndOwner() {
        axios.get(`http://localhost:8000/api/models/`+id).then(model => {
            this.setState({ model: model.data})
            axios.get(`http://localhost:8000/api/userget/`+model.data.owner_id).then(owner => {
                this.setState({ owner: owner.data, loading: false})
            })
        })

    }

    render() {
        const loading = this.state.loading;
        return (
            <main>
                <Helmet>
                    <title>{this.state.model.title}</title>
                </Helmet>
                <div className="model-box">
                    <div className="model-description-box">
                        {this.state.model.title}
                        <br/>
                        <a href={"/user/"+this.state.owner.id}>
                        by <b>{this.state.owner.username}</b>
                        </a>
                        {loading ? (
                        <div>
                            <img id="bigimg" src={load} alt='Loading...'/>
                            <div className="model-images">
                                <img id="imga" className="active" src={load} alt='Loading...'/>
                                <img id="imgb" src={load} alt='Loading...'/>
                            </div>
                            <div className="model-description">
                                <div>
                                    Summary
                                    <br/>
                                    {this.state.model.description}
                                    <br/>

                                </div>
                                <div>
                                    Recommended print settings
                                    <br/>
                                    Rafts: <b>{this.state.model.rafts}</b><br/>
                                    Supports: <b>{this.state.model.supports}</b><br/>
                                    Resolution: <b>{this.state.model.resolution}</b><br/>
                                    Infill: <b>{this.state.model.infill}</b>
                                </div>
                            </div>
                        </div>
                        ) : (
                            <div>
                                <img id="bigimg" src={'/uploads/' + this.state.model.owner_id + "/" + this.state.model.title + "/img/" + this.state.model.img1} alt='Loading...'/>
                                <div className="model-images">
                                    <img id="imga" className="active" src={'/uploads/' + this.state.model.owner_id + "/" + this.state.model.title + "/img/" + this.state.model.img1} alt='Loading...'/>
                                    <img id="imgb" src={'/uploads/' + this.state.model.owner_id + "/" + this.state.model.title + "/img/" + this.state.model.img2} alt='Loading...'/>
                                </div>
                                <div className="model-description">
                                    <div>
                                        Summary
                                        <br/>
                                        {this.state.model.description}
                                    </div>
                                    <div>
                                        Recommended print settings
                                        <br/>
                                        Rafts: <b>{this.state.model.rafts}</b><br/>
                                        Supports: <b>{this.state.model.supports}</b><br/>
                                        Resolution: <b>{this.state.model.resolution}</b><br/>
                                        Infill: <b>{this.state.model.infill}</b>
                                    </div>
                                </div>
                            </div>
                        )}
                    </div>
                    <div className="model-menu">
                        <div>
                            3D View
                        </div>
                        {loading ? (
                                <img id="imgb" src={load} alt='Loading...'/>):
                            (
                                <STLViewer
                                    model={'/uploads/' + this.state.model.owner_id + "/" + this.state.model.title + "/stl/" + this.state.model.model}
                                    width={400}
                                    height={300}
                                    backgroundColor='#992348'
                                    rotate={true}
                                    orbitControls={true}
                                    lights={[1, 1, 1]}
                                    lightColor='#344b59'
                                />)}
                        <div>
                            {loading ? (
                            <strike>Save</strike>
                            ) :
                                (
                            <Link to={'/uploads/' + this.state.model.owner_id + "/" + this.state.model.title + "/stl/" + this.state.model.model}  target="_blank" download>
                                Save
                            </Link>)}
                        </div>
                        <div>
                            Download for:
                            <br/>
                            <b>Free</b>
                        </div>
                    </div>
                </div>
            </main>
        )
    }
}

export default Model;