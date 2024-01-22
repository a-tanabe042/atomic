import React from 'react';

export const  Breadcrumbs = () => {
    return(
        <div className="h-8 text-xs text-white breadcrumbs ml-2">
        <ul>
          <li>
            <a href="http://localhost:3000">Home</a>
          </li>
          <li>
            <a href="http://localhost:3000/app/dashboard">Dashboard</a>
          </li>
          <li>
            <a href="http://localhost:3000/app/code">code</a>
          </li>
        </ul>
      </div>

    )
}