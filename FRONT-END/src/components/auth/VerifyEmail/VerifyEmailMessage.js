import React from 'react';

const VerifyEmailMessage = ({ email, resendVerification }) => {
  return (
    <div>
      <h2>Verify Your Email</h2>
      <p>We've sent a verification link to: <strong>{email}</strong></p>
      <p>Please check your inbox and click the link to verify your email address.</p>
      <button 
        
        onClick={resendVerification}
      >
        Resend Verification Email
      </button>
    </div>
  );
};

export default VerifyEmailMessage; 