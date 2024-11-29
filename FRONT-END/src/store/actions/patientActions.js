// Functions to trigger state updates for patients.

export const ADD_PATIENT = 'ADD_PATIENT';
export const REMOVE_PATIENT = 'REMOVE_PATIENT';

export const addPatient = (patient) => ({
    type: ADD_PATIENT,
    payload: patient,
});

export const removePatient = (id) => ({
    type: REMOVE_PATIENT,
    payload: id,
}); 