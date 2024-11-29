import React from 'react';
import InputField from '../../common/InputField';
import Button from '../../common/Button';
const ResetPasswordForm = ({ onSubmit, email, setEmail }) => {
  return (
    <form onSubmit={onSubmit}>
      <InputField 
        label="Email"
        type="email"
        value={email}
        onChange={(e) => setEmail(e.target.value)}
      />
      <Button text="Reset Password" type="submit" />
    </form>
  );
};

export default ResetPasswordForm;
