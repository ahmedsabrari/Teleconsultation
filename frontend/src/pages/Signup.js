import { useState } from 'react';
import { Button, Card, Form, Row, Col, Tabs, Tab } from 'react-bootstrap';

export default function TeleconsultationSignup() {
  const [userType, setUserType] = useState('patient');
  const [firstName, setFirstName] = useState('');
  const [lastName, setLastName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [consultationType, setConsultationType] = useState('');
  const [specialization, setSpecialization] = useState('');
  const [licenseNumber, setLicenseNumber] = useState('');
  const [yearsOfExperience, setYearsOfExperience] = useState('');
  const [agreeTerms, setAgreeTerms] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log('Form submitted:', {
      userType,
      firstName,
      lastName,
      email,
      consultationType,
      specialization,
      licenseNumber,
      yearsOfExperience,
      agreeTerms,
    });
  };

  return (
    <div className="container mt-5">
      <div className="row justify-content-center">
        <div className="col-md-8">
          <h1 className="text-center mb-4">Sign Up for Teleconsultation</h1>

          {/* Tabs for switching between Patient and Doctor sign-ups */}
          <Tabs
            activeKey={userType}
            onSelect={(key) => setUserType(key)}
            id="signup-tabs"
            className="mb-3"
          >
            <Tab eventKey="patient" title="Patient">
              <Card>
                <Card.Header>Create Your Account as Patient</Card.Header>
                <Card.Body>
                  <Form onSubmit={handleSubmit}>
                    <Row>
                      <Col md={6}>
                        <Form.Group controlId="firstName">
                          <Form.Label>First Name</Form.Label>
                          <Form.Control
                            type="text"
                            value={firstName}
                            onChange={(e) => setFirstName(e.target.value)}
                            required
                          />
                        </Form.Group>
                      </Col>
                      <Col md={6}>
                        <Form.Group controlId="lastName">
                          <Form.Label>Last Name</Form.Label>
                          <Form.Control
                            type="text"
                            value={lastName}
                            onChange={(e) => setLastName(e.target.value)}
                            required
                          />
                        </Form.Group>
                      </Col>
                    </Row>

                    <Form.Group controlId="email" className="mt-3">
                      <Form.Label>Email</Form.Label>
                      <Form.Control
                        type="email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        required
                      />
                    </Form.Group>

                    <Form.Group controlId="password" className="mt-3">
                      <Form.Label>Password</Form.Label>
                      <Form.Control
                        type="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                      />
                    </Form.Group>

                    <Form.Group controlId="confirmPassword" className="mt-3">
                      <Form.Label>Confirm Password</Form.Label>
                      <Form.Control
                        type="password"
                        value={confirmPassword}
                        onChange={(e) => setConfirmPassword(e.target.value)}
                        required
                      />
                    </Form.Group>

                    <Form.Group controlId="consultationType" className="mt-3">
                      <Form.Label>Consultation Type</Form.Label>
                      <Form.Control
                        as="select"
                        value={consultationType}
                        onChange={(e) => setConsultationType(e.target.value)}
                        required
                      >
                        <option value="">Select Consultation Type</option>
                        <option value="general">General Consultation</option>
                        <option value="specialist">Specialist Consultation</option>
                        <option value="followup">Follow-up Consultation</option>
                      </Form.Control>
                    </Form.Group>

                    <Form.Check
                      type="checkbox"
                      label="I agree to the terms and conditions"
                      checked={agreeTerms}
                      onChange={(e) => setAgreeTerms(e.target.checked)}
                      required
                      className="mt-3"
                    />

                    <Button variant="dark" type="submit" className="w-100 mt-4">
                      Sign Up
                    </Button>
                  </Form>
                </Card.Body>
              </Card>
            </Tab>

            <Tab eventKey="doctor" title="Doctor">
              <Card>
                <Card.Header>Create Your Account as Doctor</Card.Header>
                <Card.Body>
                  <Form onSubmit={handleSubmit}>
                    <Row>
                      <Col md={6}>
                        <Form.Group controlId="firstName">
                          <Form.Label>First Name</Form.Label>
                          <Form.Control
                            type="text"
                            value={firstName}
                            onChange={(e) => setFirstName(e.target.value)}
                            required
                          />
                        </Form.Group>
                      </Col>
                      <Col md={6}>
                        <Form.Group controlId="lastName">
                          <Form.Label>Last Name</Form.Label>
                          <Form.Control
                            type="text"
                            value={lastName}
                            onChange={(e) => setLastName(e.target.value)}
                            required
                          />
                        </Form.Group>
                      </Col>
                    </Row>

                    <Form.Group controlId="email" className="mt-3">
                      <Form.Label>Email</Form.Label>
                      <Form.Control
                        type="email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        required
                      />
                    </Form.Group>

                    <Form.Group controlId="password" className="mt-3">
                      <Form.Label>Password</Form.Label>
                      <Form.Control
                        type="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                      />
                    </Form.Group>

                    <Form.Group controlId="confirmPassword" className="mt-3">
                      <Form.Label>Confirm Password</Form.Label>
                      <Form.Control
                        type="password"
                        value={confirmPassword}
                        onChange={(e) => setConfirmPassword(e.target.value)}
                        required
                      />
                    </Form.Group>

                    <Form.Group controlId="specialization" className="mt-3">
                      <Form.Label>Specialization</Form.Label>
                      <Form.Control
                        as="select"
                        value={specialization}
                        onChange={(e) => setSpecialization(e.target.value)}
                        required
                      >
                        <option value="">Select Specialization</option>
                        <option value="general">General Practitioner</option>
                        <option value="pediatrics">Pediatrics</option>
                        <option value="cardiology">Cardiology</option>
                        <option value="dermatology">Dermatology</option>
                        <option value="psychiatry">Psychiatry</option>
                      </Form.Control>
                    </Form.Group>

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


                    <Form.Group controlId="yearsOfExperience" className="mt-3">
                      <Form.Label>Years of Experience</Form.Label>
                      <Form.Control
                        type="number"
                        value={yearsOfExperience}
                        onChange={(e) => setYearsOfExperience(e.target.value)}
                        required
                      />
                    </Form.Group>

                    <Form.Check
                      type="checkbox"
                      label="I agree to the terms and conditions"
                      checked={agreeTerms}
                      onChange={(e) => setAgreeTerms(e.target.checked)}
                      required
                      className="mt-3"
                    />

                    <Button variant="dark" type="submit" className="w-100 mt-4">
                      Sign Up
                    </Button>
                  </Form>
                </Card.Body>
              </Card>
            </Tab>
          </Tabs>

          {/* Common Benefits and How It Works Section */}
          <Card className="mt-4">
            <Card.Header>Benefits of Teleconsultation</Card.Header>
            <Card.Body>
              <ul>
                <li>24/7 Access to Healthcare Services</li>
                <li>Secure and Confidential Consultations</li>
                <li>High-Quality Video Consultations</li>
                <li>Instant Chat Support</li>
                {userType === 'doctor' && (
                  <li>Expand Your Practice Online</li>
                )}
              </ul>
            </Card.Body>
          </Card>

          <Card className="mt-4">
            <Card.Header>How It Works</Card.Header>
            <Card.Body>
              <ol>
                {userType === 'patient' ? (
                  <>
                    <li>Sign up and create your account</li>
                    <li>Choose your preferred consultation type</li>
                    <li>Schedule an appointment or get an instant consultation</li>
                    <li>Connect with a healthcare professional via video or chat</li>
                    <li>Receive diagnosis, treatment plan, or prescription if necessary</li>
                  </>
                ) : (
                  <>
                    <li>Register as a healthcare provider</li>
                    <li>Complete your profile and verification process</li>
                    <li>Set your availability for consultations</li>
                    <li>Receive and accept consultation requests</li>
                    <li>Conduct video consultations and provide medical advice</li>
                  </>
                )}
              </ol>
            </Card.Body>
          </Card>
        </div>
      </div>
    </div>
  );
}
