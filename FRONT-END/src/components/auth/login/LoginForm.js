import React from 'react';
import InputField from '../../common/InputField';
import Button from '../../common/Button';


const LoginForm = ({ onSubmit, formData, setFormData }) => {
  return (
    <form onSubmit={onSubmit}>
      <InputField 
        label="Email"
        type="email"
        value={formData.email}
        onChange={(e) => setFormData({...formData, email: e.target.value})}
      />
      <InputField 
        label="Password"
        type="password"
        value={formData.password}
        onChange={(e) => setFormData({...formData, password: e.target.value})}
      />
      <Button text="Login" type="submit" />
    </form>
  );
};

export default LoginForm; 