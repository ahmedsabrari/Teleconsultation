import React from 'react';
import { Link } from 'react-router-dom';

const Footer = () => {
  return (
    <footer className="py-4 border-top bg-light">
      <div className="container">
        <div className="row align-items-center">
         
          <div className="col-md-4 text-center text-md-start mb-3 mb-md-0">
            <p className="mb-0 small text-muted">© 2024 Appointment System. All rights reserved.</p>
          </div>

          <div className="col-md-4 text-center">
            <nav className="d-flex justify-content-center gap-3">
              <Link className="small text-muted hover:underline" to="/terms">
                Terms of Service
              </Link>
              <Link className="small text-muted hover:underline" to="/privacy">
                Privacy Policy
              </Link>
              <Link className="small text-muted hover:underline" to="/contact">
                Contact Us
              </Link>
            </nav>
          </div>

        
          <div className="col-md-4 text-center text-md-end">
            <div className="d-flex justify-content-center justify-content-md-end gap-2">
              <a
                href="https://www.facebook.com"
                className="text-muted small"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Facebook"
              >
                Facebook
              </a>
              <a
                href="https://www.twitter.com"
                className="text-muted small"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Twitter"
              >
                Twitter
              </a>
              <a
                href="https://www.linkedin.com"
                className="text-muted small"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="LinkedIn"
              >
                LinkedIn
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
