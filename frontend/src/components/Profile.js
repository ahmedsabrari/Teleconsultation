// Purpose: User profile display.
import React from 'react';

const Profile = ({ user }) => {
    return (
        <div style={{ padding: '10px', border: '1px solid #ccc' }}>
            <h2>User Profile</h2>
            <p>Name: {user.name}</p>
            <p>Email: {user.email}</p>
            <p>Phone: {user.phone}</p>
            <p>Joined: {user.joinedDate}</p>
        </div>
    );
};

export default Profile;
