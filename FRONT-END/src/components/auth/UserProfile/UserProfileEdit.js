import React, { useState } from 'react';
import InputField from '../../common/InputField';

const UserProfileEdit = ({ user, onSave, onCancel }) => {
  const [formData, setFormData] = useState({
    username: user.username,
    email: user.email,
    fullName: user.fullName
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    onSave(formData);
  };

  return (
    <form onSubmit={handleSubmit}>
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
        label="Full Name"
        type="text"
        value={formData.fullName}
        onChange={(e) => setFormData({...formData, fullName: e.target.value})}
      />
      <div >
        <button type="submit">Save Changes</button>
        <button type="button" onClick={onCancel}>Cancel</button>
      </div>
    </form>
  );
};

export default UserProfileEdit; 