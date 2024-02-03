import React from 'react';

export const  Breadcrumbs = () => {
    const apiURL = process.env.REACT_APP_API_URL;
    return(
        <div className="h-8 text-xs text-white breadcrumbs ml-2">
        <ul>
          <li>
            <a href={`${apiURL}`}>Home</a>
          </li>
          <li>
            <a href={`${apiURL}/app/dashboard`}>Dashboard</a>
          </li>
          <li>
            <a href={`${apiURL}/app/code`}>code</a>
          </li>
        </ul>
      </div>

    )
}