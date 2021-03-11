import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import MainHeader from './mainHeader';

class Header extends Component
{
    render()
    {
        return(
            <MainHeader />
        );
    }
}

ReactDOM.render(<Header />, document.getElementById('app'));
