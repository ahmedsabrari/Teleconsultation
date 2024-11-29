import React from 'react';

const LogoutButton = ({ onLogout }) => {
  const handleLogout = async () => {
    try {
      // Add your logout logic here
      await onLogout();
    } catch (error) {
      console.error('Logout failed:', error);
    }
  };

  return (
    <button 
      
      onClick={handleLogout}
    >
      Logout
    </button>
  );
};

export default LogoutButton; 