// Purpose: Form to book an appointment.
import React, { useState } from 'react';

const AppointmentBooking = () => {
    const [date, setDate] = useState('');
    const [time, setTime] = useState('');
    const [doctor, setDoctor] = useState('');

    const handleSubmit = (e) => {
        e.preventDefault();
        // Handle appointment booking logic here
    };

    return (
        <form onSubmit={handleSubmit}>
            <h1>Book an Appointment</h1>
            <input
                type="date"
                value={date}
                onChange={(e) => setDate(e.target.value)}
                required
            />
            <input
                type="time"
                value={time}
                onChange={(e) => setTime(e.target.value)}
                required
            />
            <input
                type="text"
                placeholder="Doctor's Name"
                value={doctor}
                onChange={(e) => setDoctor(e.target.value)}
                required
            />
            <button type="submit">Book Appointment</button>
        </form>
    );
};

export default AppointmentBooking; 