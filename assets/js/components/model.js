// ./assets/js/components/model.js

import React, {Component} from 'react';
import axios from 'axios';
import {Route, Switch, Redirect, Link, withRouter, useParams} from 'react-router-dom';
import STLViewer from 'stl-viewer'


class Model extends Component {
    constructor() {
        super();
        this.state = { model: [], loading: true};
    }
    componentDidMount() {
        this.getModel();
        //STLViewer('/uploads/' + this.state.model.owner + "/" + this.state.model.title + "/stl/" + this.state.model.model,"model")
    }

    getModel() {
        axios.get(`http://localhost:8000/api/model`).then(model => {
            this.setState({ model: model.data, loading: false})
        })
    }

    render() {
        const loading = this.state.loading;
        return (
            <main>
                <div className="model-box">
                    <div className="model-description-box">
                        {this.state.model.title}
                        <br/>
                        by <b>{this.state.model.owner}</b>
                        {loading ? (
                        <div>
                            <img id="bigimg" src='img/load.png' alt='Loading...'/>
                            <div className="model-images">
                                <img id="imga" className="active" src='img/load.png' alt='Loading...'/>
                                <img id="imgb" src='img/load.png' alt='Loading...'/>
                            </div>
                            <div className="model-description">
                                <div>
                                    Summary
                                    <br/>
                                    {this.state.model.description}
                                    <br/>
                                    uploads/{this.state.model.owner}/{this.state.model.title}/stl/{this.state.model.model}
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
                                <img id="bigimg" src={'/uploads/' + this.state.model.owner + "/" + this.state.model.title + "/img/" + this.state.model.img1} alt='Loading...'/>
                                <div className="model-images">
                                    <img id="imga" className="active" src={'/uploads/' + this.state.model.owner + "/" + this.state.model.title + "/img/" + this.state.model.img1} alt='Loading...'/>
                                    <img id="imgb" src={'/uploads/' + this.state.model.owner + "/" + this.state.model.title + "/img/" + this.state.model.img2} alt='Loading...'/>
                                </div>
                                <div className="model-description">
                                    <div>
                                        Summary
                                        <br/>
                                        {this.state.model.description}
                                        <br/>
                                        uploads/{this.state.model.owner}/{this.state.model.title}/stl/{this.state.model.model}
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
                                <img id="imgb" src='img/load.png' alt='Loading...'/>):
                            (
                                <STLViewer
                                    model={'/uploads/' + this.state.model.owner + "/" + this.state.model.title + "/stl/" + this.state.model.model}
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
                            <Link to={'/uploads/' + this.state.model.owner + "/" + this.state.model.title + "/stl/" + this.state.model.model}  target="_blank" download>
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