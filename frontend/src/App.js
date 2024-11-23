import React from 'react';
import { Routes, Route } from 'react-router-dom';
import Navbar from './components/Navbar'; // Import components
import Footer from './components/Footer';
import Home from './pages/Home'; // Import pages
import Login from './pages/Login';
import Signup from './pages/Signup';
import Contact from './pages/Contact';
import Service from './pages/Service';




const App = () => {
  return (
    <>
      <div className="App">
        <Navbar />
        <main>
          <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/login" element={<Login />} />
            <Route path="/signup" element={<Signup />} />
            <Route path="/contact" element={<Contact />} />
            <Route path="/service" element={<Service />} /> 
          </Routes>
        </main>
        <Footer />
      </div>

    </>
  );
};

export default App;
