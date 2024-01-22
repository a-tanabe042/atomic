import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { RecoilRoot } from 'recoil';
import CodingInterface from './pages/coding/index';
import EducationalMaterials from './api/EducationalMaterials';
import 'tailwindcss/tailwind.css';

function App() {
  return (
    <RecoilRoot>
      <Router>
        <Routes>
          <Route path="/" element={<CodingInterface />} />
          <Route path="/:parameter" element={<EducationalMaterialsWrapper />} />
        </Routes>
      </Router>
    </RecoilRoot>
  );
}
export default App;

function EducationalMaterialsWrapper() {
  return (
    <>
      <EducationalMaterials />
      <CodingInterface />
    </>
  );
}
