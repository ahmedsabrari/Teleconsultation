import React from 'react';
import InputField from '../../common/InputField';
import Button from '../../common/Button';

const ChangePasswordForm = ({ onSubmit, formData, setFormData }) => {
  return (
    <form onSubmit={onSubmit}>
      <InputField 
        label="Current Password"
        type="password"
        value={formData.currentPassword}
        onChange={(e) => setFormData({...formData, currentPassword: e.target.value})}
      />
      <InputField 
        label="New Password"
        type="password"
        value={formData.newPassword}
        onChange={(e) => setFormData({...formData, newPassword: e.target.value})}
      />
      <InputField 
        label="Confirm New Password"
        type="password"
        value={formData.confirmPassword}
        onChange={(e) => setFormData({...formData, confirmPassword: e.target.value})}
      />
      <Button text="Change Password" type="submit" />
    </form>
  );
};

export default ChangePasswordForm;
