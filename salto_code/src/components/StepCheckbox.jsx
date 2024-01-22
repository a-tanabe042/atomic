import React from 'react';
import { useRecoilValue } from 'recoil';
import { howToStepsState } from '../state';

export const StepCheckbox = ({ stepId }) => {
  const steps = useRecoilValue(howToStepsState);

  return (
    <input
      type="checkbox"
      checked={!!steps[stepId]}
      readOnly
      className="checkbox checkbox-success pointer-events-none" 
    />
  );
};
