// Purpose: Dashboard for patients to view appointments.
import React from 'react';
import { useTheme } from 'styled-components';

const PatientDashboard = () => {
    const theme = useTheme();

    return (
        <div style={{ background: theme.background, color: theme.color }}>
            <h1>Patient Dashboard</h1>
            {/* Add components to view appointments here */}
        </div>
    );
};

export default PatientDashboard; 