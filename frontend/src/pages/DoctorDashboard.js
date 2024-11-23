// Purpose: Dashboard for doctors to manage appointments.
import React from 'react';
import { useTheme } from 'styled-components';

const DoctorDashboard = () => {
    const theme = useTheme();

    return (
        <div style={{ background: theme.background, color: theme.color }}>
            <h1>Doctor Dashboard</h1>
            {/* Add components to manage appointments here */}
        </div>
    );
};

export default DoctorDashboard; 