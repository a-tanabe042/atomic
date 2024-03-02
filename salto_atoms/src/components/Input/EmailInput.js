// FirstNameInput.js
import React from 'react';

const EmailInput = ({ email}) => {
  return (
    <div>
       <label className="label" htmlFor="email">
            Email
           </label>
          <input
             type="text"
             id="email"
             value={email}
             className="input input-bordered  w-full border border-gray-300  rounded-lg bg-slate-100 text-black"
             placeholder="Email"
             readOnly
           />
    </div>
    
  );
};

export default EmailInput;
