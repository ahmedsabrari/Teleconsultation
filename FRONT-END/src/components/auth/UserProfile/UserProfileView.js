import React from 'react';
const UserProfileView = ({ user, onEdit }) => {
  return (
    <div >
      <h2>User Profile</h2>
      <div >
        <p><strong>Username:</strong> {user.username}</p>
        <p><strong>Email:</strong> {user.email}</p>
        <p><strong>Full Name:</strong> {user.fullName}</p>
      </div>
      <button 
        
        onClick={onEdit}
      >
        Edit Profile
      </button>
    </div>
  );
};

export default UserProfileView;
