import React from 'react';
import { Button, Container, Row, Col } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import { CalendarDays, Clock, Users, Phone } from 'lucide-react';

export default function Home() {
  return (
    <div className="d-flex flex-column min-vh-100">
      <main className="flex-1">
        {/* Hero Section */}
        <section className="w-100 py-5">
          <Container className="text-center">
            <h1 className="display-4 fw-bold mb-3">Welcome to Our Appointment System</h1>
            <p className="lead text-muted mb-4">
              Your health is our priority. Book your appointments easily and take control of your wellness journey.
            </p>
            <div className="d-flex justify-content-center gap-3">
            <Link to="/Signup">
                <Button variant="primary" size="lg" className="px-4">
                  Book Appointment
                </Button>
              </Link>
              <Button variant="outline-dark" size="lg">
                Learn More
              </Button>
            </div>
          </Container>
        </section>

        <section className="w-100 py-5 bg-light">
          <Container>
            <h2 className="text-center fw-bold mb-5">Why Choose Us?</h2>
            <Row className="g-4">
              <Col xs={12} sm={6} lg={3}>
                <div className="text-center p-3 border rounded shadow-sm">
                  <CalendarDays size={40} className="text-dark mb-3" />
                  <h5 className="fw-bold">Easy Scheduling</h5>
                  <p className="text-muted">Book appointments anytime, anywhere.</p>
                </div>
              </Col>
              <Col xs={12} sm={6} lg={3}>
                <div className="text-center p-3 border rounded shadow-sm">
                  <Clock size={40} className="text-dark mb-3" />
                  <h5 className="fw-bold">24/7 Availability</h5>
                  <p className="text-muted">Access our services round the clock.</p>
                </div>
              </Col>
              <Col xs={12} sm={6} lg={3}>
                <div className="text-center p-3 border rounded shadow-sm">
                  <Users size={40} className="text-dark mb-3" />
                  <h5 className="fw-bold">Expert Staff</h5>
                  <p className="text-muted">Qualified professionals at your service.</p>
                </div>
              </Col>
              <Col xs={12} sm={6} lg={3}>
                <div className="text-center p-3 border rounded shadow-sm">
                  <Phone size={40} className="text-dark mb-3" />
                  <h5 className="fw-bold">Quick Support</h5>
                  <p className="text-muted">Get help when you need it most.</p>
                </div>
              </Col>
            </Row>
          </Container>
        </section>
      </main>
    </div>
  );
}
