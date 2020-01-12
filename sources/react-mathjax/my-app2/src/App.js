import React, {useEffect} from 'react';
import logo from './logo.svg';
import './App.css';
//import MathJax from 'react-mathjax';
import MathJax from 'react-mathjax2';
import axios from 'axios';

const ascii = "$2^2\cdot3^2\cdot5$";//'U = 1/(R_(si) + sum_(i=1)^n(s_n/lambda_n) + R_(se))'

// const tex = `f(x) = \\int_{-\\infty}^\\infty
//     \\hat f(\\xi)\\,e^{2 \\pi i \\xi x}
//     \\,d\\xi`;



function App() {
    window.persons = [];
    axios.get(`http://mathx:8887/go-on`)
        .then(res => {
         window.persons = res.data;
    })

  return (
    <div className="App">

      <header className="App-header">
        <ul>
        { window.persons.map(person => <li>{person}</li>)}
        </ul>

        <div>
            <MathJax.Context input='ascii'>
            <div>

            This is an inline formula written in AsciiMath: <MathJax.Node inline>{ ascii }</MathJax.Node>
        </div>
        </MathJax.Context>
        </div>


      </header>
    </div>
  );
}

export default App;
