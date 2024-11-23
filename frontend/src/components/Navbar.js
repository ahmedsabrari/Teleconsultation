import React from 'react';
import { Navbar, Nav, Button, Container } from 'react-bootstrap';
import { Link } from 'react-router-dom';

const Navigation = () => {
  return (
    <Navbar expand="lg" bg="light" className="shadow-sm">
      <Container>
        <Navbar.Brand as={Link} to="/" className="text-dark">
          Appointment System
        </Navbar.Brand>
        <Navbar.Toggle aria-controls="navbar-nav" />
        <Navbar.Collapse id="navbar-nav">
          <Nav className="ms-auto">
            <Nav.Link as={Link} to="/" className="text-dark">Home</Nav.Link>
            <Nav.Link as={Link} to="/Service" className="text-dark">Services</Nav.Link>
            <Nav.Link as={Link} to="/contact" className="text-dark">Contact</Nav.Link>
            <Button as={Link} to="/login" variant="outline-dark" className="me-2">
              Login
            </Button>
            <Button as={Link} to="/signup" variant="dark">Sign Up</Button>
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
};

export default Navigation;
