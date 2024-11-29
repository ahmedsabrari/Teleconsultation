import React from 'react';
import InputField from '../../common/InputField';
import Button from '../../common/Button';
const RegisterForm = ({ onSubmit, formData, setFormData }) => {
  return (
    <form onSubmit={onSubmit}>
      <InputField 
        label="Username"
        type="text"
        value={formData.username}
        onChange={(e) => setFormData({...formData, username: e.target.value})}
      />
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
      <Button text="Register" type="submit" />
    </form>
  );
};

export default RegisterForm;
