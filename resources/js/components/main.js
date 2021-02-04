import React, {Component} from 'react';
import ReactDOM from 'react-dom';

class Principal extends Component
{
    constructor(props)
    {
        super(props);
        this.state = {
            valor: 'Valor de muestra'
        };
    }
    render()
    {
        return(
            <div>
                <div className="container">
                    <div className="row justify-content-center">
                        <div className="col-md-8">
                            <div className="card">
                                <div className='card-header'>TITULO 1</div>
                                <div className='card-body'>
                                    <h2>{this.state.valor}</h2>
                                    <h3>Nada especial</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

ReactDOM.render(<Principal />, document.getElementById('root'));
