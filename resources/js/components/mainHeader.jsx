import React, {useState, useEffect } from 'react';
import {BrowserRouter, Switch, Route} from 'react-router-dom';

class MainHeader extends Component
{
    render()
    {
        return(
            <BrowserRouter>
                <Switch>
                    <Route path='/' exact />
                    <Route path='/index' exact />
                    <Route path='/post/:id' />
                </Switch>
            </BrowserRouter>
        );
    }

}

export default MainHeader;
