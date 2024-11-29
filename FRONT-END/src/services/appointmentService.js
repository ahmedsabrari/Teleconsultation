const appointments = [];

export const createAppointment = (appointment) => {
    appointments.push(appointment);
    return appointment;
};

export const getAppointments = () => {
    return appointments;
};

export const updateAppointment = (id, updatedAppointment) => {
    const index = appointments.findIndex(app => app.id === id);
    if (index !== -1) {
        appointments[index] = { ...appointments[index], ...updatedAppointment };
        return appointments[index];
    }
    return null;
};

export const deleteAppointment = (id) => {
    const index = appointments.findIndex(app => app.id === id);
    if (index !== -1) {
        return appointments.splice(index, 1);
    }
    return null;
}; 