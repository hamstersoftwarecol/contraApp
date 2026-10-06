import { BrowserRouter, Routes, Route } from 'react-router-dom';
import PublicSearch from './pages/PublicSearch';

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<PublicSearch />} />
        <Route path="*" element={<PublicSearch />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
