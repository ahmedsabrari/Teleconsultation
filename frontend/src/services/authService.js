export const loginUser = async (credentials) => {
    // Replace with actual API call
    const response = await fetch('/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(credentials),
    });

    if (!response.ok) {
        throw new Error('Login failed');
    }

    const data = await response.json();
    return data; // Return user data or token
};

// Simulated API call for user logout
export const logoutUser = async () => {
    // Replace with actual API call
    const response = await fetch('/api/logout', {
        method: 'POST',
    });

    if (!response.ok) {
        throw new Error('Logout failed');
    }

    return true; 
};

