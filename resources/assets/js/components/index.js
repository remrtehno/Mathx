import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MathJax from 'react-mathjax';

const tex = `f(x) = \\int_{-\\infty}^\\infty
    \\hat f(\\xi)\\,e^{2 \\pi i \\xi x}
    \\,d\\xi`

function App() {
    return (
        <div>
            {jsonTests.map(x=>x.uslovie)}
            <MathJax.Provider>
                <div>
                    This is an inline math formula: <MathJax.Node inline formula={'a = b'} />
                    And a block one:

                    <MathJax.Node formula={tex} />
                </div>
            </MathJax.Provider>
        </div>
    );
}
if (document.getElementById('testContainer')) {
    ReactDOM.render(<App />, document.getElementById('testContainer'));
}

