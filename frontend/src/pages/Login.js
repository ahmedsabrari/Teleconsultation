import React, { useState } from 'react';
import { Button, Card, Form, Row, Col, Tabs, Tab } from 'react-bootstrap';

const Login = () => {
  const [userType, setUserType] = useState('patient');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [firstName, setFirstName] = useState('');
  const [lastName, setLastName] = useState('');
  const [licenseNumber, setLicenseNumber] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log('Email:', email);
    console.log('Password:', password);
    console.log('First Name:', firstName);
    console.log('Last Name:', lastName);
    console.log('License Number:', licenseNumber);
    // Handle login logic here
  };

  return (
    <div className="container mt-5">
      <div className="row justify-content-center">
        <div className="col-md-8">
          <h1 className="text-center mb-4">Login to Teleconsultation</h1>

          {/* Tabs for switching between Patient and Doctor login */}
          <Tabs
            activeKey={userType}
            onSelect={(key) => setUserType(key)}
            id="login-tabs"
            className="mb-3"
          >
            <Tab eventKey="patient" title="Patient">
              <Card>
                <Card.Header>Login as Patient</Card.Header>
                <Card.Body>
                  <Form onSubmit={handleSubmit}>
                    {/* Nom (First Name) and Prenom (Last Name) */}
                    <Row>
                      <Col md={6}>
                        <Form.Group controlId="firstName">
                          <Form.Label>Nom (First Name)</Form.Label>
                          <Form.Control
                            type="text"
                            placeholder="Enter your first name"
                            value={firstName}
                            onChange={(e) => setFirstName(e.target.value)}
                            required
                          />
                        </Form.Group>
                      </Col>
                      <Col md={6}>
                        <Form.Group controlId="lastName">
                          <Form.Label>Prenom (Last Name)</Form.Label>
                          <Form.Control
                            type="text"
                            placeholder="Enter your last name"
                            value={lastName}
                            onChange={(e) => setLastName(e.target.value)}
                            required
                          />
                        </Form.Group>
                      </Col>
                    </Row>

                    {/* Email Input */}
                    <Form.Group controlId="email">
                      <Form.Label>Email</Form.Label>
                      <Form.Control
                        type="email"
                        placeholder="Enter your email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        required
                      />
                    </Form.Group>

                    {/* Password Input */}
                    <Form.Group controlId="password" className="mt-3">
                      <Form.Label>Password</Form.Label>
                      <Form.Control
                        type="password"
                        placeholder="Enter your password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                      />
                    </Form.Group>

                    {/* Submit Button */}
                    <div className="d-grid mt-4">
                      <Button variant="dark" type="submit" className="w-100">
                        Login
                      </Button>
                    </div>
                  </Form>
                </Card.Body>
              </Card>
            </Tab>

            <Tab eventKey="doctor" title="Doctor">
              <Card>
                <Card.Header>Login as Doctor</Card.Header>
                <Card.Body>
                  <Form onSubmit={handleSubmit}>
                    {/* License Number (for Doctor) */}
                    <Form.Group controlId="licenseNumber">
  <Form.Label>License Number</Form.Label>
  <Form.Control
    type="text"
    placeholder="Enter your license number (e.g., A12345678)"
    value={licenseNumber}
    onChange={(e) => {
      const value = e.target.value.toUpperCase(); // Convert input to uppercase
      // Regular expression to match one uppercase letter followed by 8 digits
      const regex = /^[A-Z]\d{0,8}$/;
      if (regex.test(value) || value === '') {
        setLicenseNumber(value);
      }
    }}
    required
  />
</Form.Group>


                    {/* Email Input */}
                    <Form.Group controlId="email" className="mt-3">
                      <Form.Label>Email</Form.Label>
                      <Form.Control
                        type="email"
                        placeholder="Enter your email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        required
                      />
                    </Form.Group>

                    {/* Password Input */}
                    <Form.Group controlId="password" className="mt-3">
                      <Form.Label>Password</Form.Label>
                      <Form.Control
                        type="password"
                        placeholder="Enter your password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                      />
                    </Form.Group>

                    {/* Submit Button */}
                    <div className="d-grid mt-4">
                      <Button variant="dark" type="submit" className="w-100">
                        Login
                      </Button>
                    </div>
                  </Form>
                </Card.Body>
              </Card>
            </Tab>
          </Tabs>
        </div>
      </div>
    </div>
  );
};

export default Login;
