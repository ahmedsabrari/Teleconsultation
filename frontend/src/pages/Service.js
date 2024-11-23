import React from 'react';
import { Row, Col, Card, Button } from 'react-bootstrap';
import { Ambulance, Brain, Heart, Bone} from 'lucide-react';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Link } from 'react-router-dom';

export default function HospitalServices() {
  const services = [
    {
      icon: <Ambulance className="h-12 w-12 text-primary" />,
      title: 'Emergency Care',
      description: '24/7 emergency services with state-of-the-art equipment and skilled staff.',
    },
    {
      icon: <Heart className="h-12 w-12 text-danger" />,
      title: 'Cardiology',
      description: 'Comprehensive heart care including diagnostics, treatment, and rehabilitation.',
    },
    {
      icon: <Brain className="h-12 w-12 text-warning" />,
      title: 'Neurology',
      description: 'Advanced neurological care for brain, spine, and nervous system disorders.',
    },
    {
      icon: <Bone className="h-12 w-12 text-success" />,
      title: 'Orthopedics',
      description: 'Specialized care for bones, joints, ligaments, tendons, and muscles.',
    },
  ];

  return (
    <div className="container my-5">
      {/* Header Section */}
      <header className="text-center mb-5">
        <h1 className="display-4 text-primary fw-bold">MedCare Hospital Services</h1>
        <p className="lead text-secondary">
          Providing compassionate care and cutting-edge medical solutions for our community.
        </p>
      </header>

      {/* Specialized Services Section */}
      <section className="mb-5">
        <h2 className="text-center mb-4 text-dark">Our Specialized Services</h2>
        <Row className="g-4">
          {services.map((service, index) => (
            <Col key={index} xs={12} md={6} lg={3}>
              <Card className="shadow-sm border-0 h-100 hover-card">
                <Card.Body className="text-center">
                  <div className="bg-light p-3 rounded-circle d-inline-block mb-3">
                    {service.icon}
                  </div>
                  <Card.Title className="text-dark fw-bold">{service.title}</Card.Title>
                  <Card.Text className="text-secondary">{service.description}</Card.Text>
                  
                </Card.Body>
              </Card>
            </Col>
          ))}
        </Row>
      </section>

      {/* Why Choose MedCare Section */}
      <section className="bg-light p-5 rounded mb-5 shadow-sm">
        <div className="text-center">
          <h2 className="h3 mb-4 text-dark fw-bold">Why Choose MedCare?</h2>
          <p className="lead text-secondary mb-4">
            At MedCare, we combine advanced medical technology with compassionate care to provide the best possible outcomes for our patients.
          </p>
          <Link to="/Signup">
                <Button variant="primary" size="lg" className="px-4">
                 lets begin your journey whit us
                </Button>
              </Link>
        </div>
      </section>
    </div>
  );
}
