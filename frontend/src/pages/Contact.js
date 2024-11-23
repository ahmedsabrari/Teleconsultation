import React, { useState } from 'react';
import { Container, Row, Col, Form, Button, Toast } from 'react-bootstrap';
import { Send, Phone } from 'react-bootstrap-icons';
import 'bootstrap/dist/css/bootstrap.min.css';

export default function ContactPage() {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [subject, setSubject] = useState('');
  const [message, setMessage] = useState('');
  const [showToast, setShowToast] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log('Form submitted:', { name, email, subject, message });

    // Show toast notification
    setShowToast(true);

    // Reset form fields
    setName('');
    setEmail('');
    setSubject('');
    setMessage('');
  };

  return (
    <Container className="py-5">
      <Row className="justify-content-center">
        <Col md={8} lg={6}>
          <div className="card shadow">
            <div className="card-body">
              <h1 className="card-title text-center mb-4 text-dark">Contact Us</h1>
              <div className="d-flex justify-content-center align-items-center mb-4">
                <Phone className="text-dark me-2" size={20} />
                <span>Contact us: <a href="tel:+1234567890" className="text-decoration-none text-dark">(123) 456-7890</a></span>
              </div>
              <Form onSubmit={handleSubmit}>
                <Form.Group className="mb-3" controlId="formName">
                  <Form.Label className="text-dark">Name</Form.Label>
                  <Form.Control
                    type="text"
                    placeholder="Your name"
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                    required
                  />
                </Form.Group>
                <Form.Group className="mb-3" controlId="formEmail">
                  <Form.Label className="text-dark">Email</Form.Label>
                  <Form.Control
                    type="email"
                    placeholder="your@email.com"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required
                  />
                </Form.Group>
                <Form.Group className="mb-3" controlId="formSubject">
                  <Form.Label className="text-dark">Subject</Form.Label>
                  <Form.Control
                    type="text"
                    placeholder="What is this regarding?"
                    value={subject}
                    onChange={(e) => setSubject(e.target.value)}
                    required
                  />
                </Form.Group>
                <Form.Group className="mb-3" controlId="formMessage">
                  <Form.Label className="text-dark">Message</Form.Label>
                  <Form.Control
                    as="textarea"
                    rows={4}
                    placeholder="Your message here..."
                    value={message}
                    onChange={(e) => setMessage(e.target.value)}
                    required
                  />
                </Form.Group>
                <Button variant="dark" type="submit" className="w-100">
                  <Send className="me-2" /> Send Message
                </Button>
              </Form>
            </div>
          </div>
        </Col>
      </Row>

      <Toast
        onClose={() => setShowToast(false)}
        show={showToast}
        delay={3000}
        autohide
        style={{
          position: 'fixed',
          top: 20,
          right: 20,
        }}
      >
        <Toast.Header>
          <strong className="me-auto">Message Sent</strong>
        </Toast.Header>
        <Toast.Body>
          We've received your message and will get back to you soon.
        </Toast.Body>
      </Toast>
    </Container>
  );
}
