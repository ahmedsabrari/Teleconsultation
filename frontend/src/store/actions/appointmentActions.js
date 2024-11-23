// Functions to trigger state updates for appointments.

export const ADD_APPOINTMENT = 'ADD_APPOINTMENT';
export const REMOVE_APPOINTMENT = 'REMOVE_APPOINTMENT';

export const addAppointment = (appointment) => ({
    type: ADD_APPOINTMENT,
    payload: appointment,
});

export const removeAppointment = (id) => ({
    type: REMOVE_APPOINTMENT,
    payload: id,
}); 