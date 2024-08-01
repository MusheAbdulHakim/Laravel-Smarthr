import React from 'react'
import { createRoot } from 'react-dom/client';
import ExcalidrawApp from './ExcalidrawApp'




export default function ExApp() {
    return (
        <ExcalidrawApp />
    );
}

const root = createRoot(document.getElementById('ExcalidrawApp')).render(<ExApp />); // createRoot(container!) if you use TypeScript

